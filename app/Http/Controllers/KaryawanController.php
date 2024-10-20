<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKaryawanRequest;
use App\Models\Divisi;
use App\Models\Karyawan;
use App\Models\KaryawanHasDivision;
use App\Models\KaryawanShift;
use App\Models\Shift;
use DateTime;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class KaryawanController extends Controller
{
    public function index()
{
    $Data = [
        'Title' => "Daftar Karyawan"
    ];

    $karyawanData = DB::table('karyawan as k')
        ->join('karyawan_has_divisions as khd', 'k.id', '=', 'khd.karyawan_id')
        ->leftJoin('divisis as d', 'khd.divisi_id', '=', 'd.id') // Ubah join menjadi leftJoin
        ->join('karyawan_shifts as ks', 'k.id', '=', 'ks.karyawan_id')
        ->join('shifts as s', 'ks.shift_id', '=', 's.id')
        ->select(
            'k.id as karyawan_id',
            'k.k_nama as nama_karyawan',
            'k.k_contact as kontak_karyawan',
            'k.k_alamat as alamat_karyawan',
            'k.k_gender as gender_karyawan',
            'khd.khr_tgljoin as tanggal_bergabung',
            'khd.khr_isActive as status_karyawan',
            'khd.khr_tglOut as tanggal_keluar',
            DB::raw("COALESCE(d.d_nama, 'Divisi tidak tersedia') as nama_divisi"), // Tambahkan kondisi ini
            'd.d_deskripsi as deskripsi_divisi',
            's.s_nama as shift_karyawan',
            'k.k_pin as pin_karyawan'
        )
        ->get();

    return view('pegawai.data_karyawan', compact('karyawanData'), $Data);
}

    public function add()
    {
        $Data = [
            'Title' => "Tambah Karyawan"
        ];
        $divisis = Divisi::all();
        $karyawan = Karyawan::all();
        $shift = Shift::all();

        return view('pegawai.tambah_karyawan', compact('karyawan', 'divisis', 'shift'), $Data);
    }


    public function getShiftsByDivision(Request $request)
    {
        $shifts = Shift::where('id_divisi', $request->divisi_id)->get();

        return response()->json($shifts);
    }


    public function store(StoreKaryawanRequest $request)
    {

        $lastPin = Karyawan::max('k_pin');
        $newPin = $lastPin ? $lastPin + 1 : 1;

        $data_karyawan = [
            'k_nama' => $request->get('k_nama'),
            'k_contact' => $request->get('k_contact'),
            'k_gender' => $request->get('k_gender'),
            'k_email' => $request->get('k_email'),
            'K_alamat' => $request->get('K_alamat'),
            'k_nik' => $request->get('k_nik'),
            'k_pin' => $newPin,
            'k_divisi' => $request->get('k_divisi'),
            'k_biometric_status' => false,
        ];

        //  dd($data_karyawan);

        // Simpan data karyawan dan ambil instance yang baru dibuat
        $karyawan = Karyawan::create($data_karyawan);



        $data_has_division = [
            'karyawan_id' => $karyawan->id,
            'divisi_id' => $request->get('k_divisi'),
            'khr_tgljoin' => $request->get('khr_tgljoin') ?? Carbon::now(),
            'khr_isActive' => true,
            'khr_tglOut' => $request->get('khr_tglOut') ?? null,
        ];

        KaryawanHasDivision::create($data_has_division);

        $data_has_shift = [
            'karyawan_id' => $karyawan->id,
            'shift_id' => $request->get('shift_id')
        ];

        KaryawanShift::create($data_has_shift);

        Alert::success('success', 'Karyawan berhasil ditambahkan');
        return redirect()->route('daftar.karyawan');
    }

    public function edit($id)
    {
        $divisis = $divisis = Divisi::all();
        $karyawan = DB::table('karyawan as k')
            ->join('karyawan_has_divisions as khd', 'k.id', '=', 'khd.karyawan_id')
            ->join('divisis as d', 'khd.divisi_id', '=', 'd.id')
            ->join('karyawan_shifts as ks', 'k.id', '=', 'ks.karyawan_id')
            ->join('shifts as s', 'ks.shift_id', '=', 's.id')
            ->select(
                'k.id as karyawan_id',
                'k.k_nama as nama_karyawan',
                'k.k_nik as nik_karyawan',
                'k.k_email as email_karyawan',
                'k.k_contact as kontak_karyawan',
                'k.k_alamat as alamat_karyawan',
                DB::raw('CASE WHEN k.k_gender = "L" THEN "Laki-laki" ELSE "Perempuan" END as gender_karyawan_text'),
                'khd.khr_tgljoin as tanggal_bergabung',
                DB::raw('CASE WHEN khd.khr_isActive = 1 THEN "Active" ELSE "Non-Active" END as status_karyawan_text'),
                'khd.khr_tglOut as tanggal_keluar',
                'd.d_nama as nama_divisi',
                's.s_nama as shift_karyawan',
                'k.k_pin as pin_karyawan'
            )
            ->where('k.id', $id)
            ->first();

        if (!$karyawan) {
            abort(404);
        }

        return view('pegawai.edit_karyawan', compact('karyawan', 'divisis'));
    }

    

    public function update(Request $request, $id)
    {
        $request->validate([
            'k_nama' => 'required|string|max:255',
            'k_nik' => 'required',
            'k_contact' => 'required|string|max:15',
            'k_email' => 'required|email|max:255',
            'k_alamat' => 'required|string|max:255',
            'k_gender' => 'required',
            'khr_tgljoin' => 'required|date',
            'khr_tglOut' => 'nullable|date',
            'khr_isActive' => 'required|boolean',
            'd_nama' => 'required|exists:divisis,id',
            'shift_id' => 'nullable|exists:shifts,id',
            'k_pin' => 'required|string|max:6',
        ]);

        $karyawan = Karyawan::findOrFail($id);

        $karyawan->k_nama = $request->k_nama;
        $karyawan->k_nik = $request->k_nik;
        $karyawan->k_contact = $request->k_contact;
        $karyawan->k_email = $request->k_email;
        $karyawan->k_alamat = $request->k_alamat;
        $karyawan->k_gender = $request->k_gender;
        $karyawan->k_pin = $request->k_pin;

        $karyawan->save();

        $karyawanHasDivision = KaryawanHasDivision::where('karyawan_id', $id)->first();
        if ($karyawanHasDivision) {
            $karyawanHasDivision->divisi_id = $request->d_nama; 
            $karyawanHasDivision->khr_tgljoin = $request->khr_tgljoin;
            $karyawanHasDivision->khr_tglOut = $request->khr_tglOut;
            $karyawanHasDivision->khr_isActive = $request->khr_isActive;
            
            $karyawanHasDivision->save();
        }

        $karyawanShift = KaryawanShift::where('karyawan_id', $id)->first();
        if ($karyawanShift) {
            $karyawanShift->shift_id = $request->shift_id; // Atur ID shift
            
            $karyawanShift->save();
        }

        Alert::success('Success', 'Barang Berhasil Dihapus');
        return redirect()->route('daftar.karyawan');
    }

    function DetailKaryawan($karyawan_id) {
        $Karyawan = Karyawan::join('karyawan_has_divisions as khd', 'karyawan.id', '=', 'khd.karyawan_id')
                            ->join('divisis as d', 'khd.divisi_id', '=', 'd.id')
                            ->join('karyawan_shifts as ks', 'karyawan.id', '=', 'ks.karyawan_id')
                            ->join('shifts as s', 'ks.shift_id', '=', 's.id')
                            ->where('khd.khr_isActive', 1)
                            ->where('karyawan.id', $karyawan_id)
                            ->select(
                                'karyawan.id as karyawan_id',
                                'karyawan.k_nama as nama_karyawan',
                                'karyawan.k_nik as nik_karyawan',
                                'karyawan.k_email as email_karyawan',
                                'karyawan.k_contact as kontak_karyawan',
                                'karyawan.k_alamat as alamat_karyawan',
                                DB::raw('CASE WHEN karyawan.k_gender = "L" THEN "Laki-laki" ELSE "Perempuan" END as gender_karyawan_text'),
                                'khd.khr_tgljoin as tanggal_bergabung',
                                DB::raw('CASE WHEN khd.khr_isActive = 1 THEN "Active" ELSE "Non-Active" END as status_karyawan_text'),
                                'khd.khr_tglOut as tanggal_keluar',
                                'd.d_nama as nama_divisi',
                                's.s_nama as shift_karyawan',
                                'karyawan.k_pin as pin_karyawan',
                                's.s_clock_in',
                                's.s_clock_out'
                            )
                            ->first();
        $dataKaryawan = $Karyawan??null;
        return $dataKaryawan;
    }
    function DetailKaryawanByPIN($biometric_pin) {
        $Karyawan = Karyawan::join('karyawan_has_divisions as khd', 'karyawan.id', '=', 'khd.karyawan_id')
                            ->join('divisis as d', 'khd.divisi_id', '=', 'd.id')
                            ->join('karyawan_shifts as ks', 'karyawan.id', '=', 'ks.karyawan_id')
                            ->join('shifts as s', 'ks.shift_id', '=', 's.id')
                            ->where('khd.khr_isActive', 1)
                            ->where('karyawan.k_pin', $biometric_pin)
                            ->select(
                                'karyawan.id as karyawan_id',
                                'karyawan.k_nama as nama_karyawan',
                                'karyawan.k_nik as nik_karyawan',
                                'karyawan.k_email as email_karyawan',
                                'karyawan.k_contact as kontak_karyawan',
                                'karyawan.k_alamat as alamat_karyawan',
                                DB::raw('CASE WHEN karyawan.k_gender = "L" THEN "Laki-laki" ELSE "Perempuan" END as gender_karyawan_text'),
                                'khd.khr_tgljoin as tanggal_bergabung',
                                DB::raw('CASE WHEN khd.khr_isActive = 1 THEN "Active" ELSE "Non-Active" END as status_karyawan_text'),
                                'khd.khr_tglOut as tanggal_keluar',
                                'd.d_nama as nama_divisi',
                                's.s_nama as shift_karyawan',
                                'karyawan.k_pin as pin_karyawan',
                                's.s_clock_in',
                                's.s_clock_out'
                            )
                            ->first();
        $dataKaryawan = $Karyawan??null;
        return $dataKaryawan;
    }
    
}
