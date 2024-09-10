<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKaryawanRequest;
use App\Models\Divisi;
use App\Models\Karyawan;
use App\Models\KaryawanHasDivision;
use DateTime;
use Illuminate\Http\Request;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class KaryawanController extends Controller
{
    public function index(){
        $Data = [
            'Title'=>"Daftar Karyawan"
        ];

        $karyawan = Karyawan::all();
        $divisis = Divisi::all();
        return view('pegawai.data_karyawan', compact('karyawan', 'divisis'), $Data);
    }

    public function add(){
        $Data = [
            'Title'=>"Tambah Karyawan"
        ];
        $divisis = Divisi::all();
        $karyawan = Karyawan::all();
        $has_division = KaryawanHasDivision::all();
        return view('pegawai.tambah_karyawan', compact('karyawan', 'divisis'), $Data);
    }

    public function store(StoreKaryawanRequest $request){
        
        $lastPin = Karyawan::max('k_pin');
        $newPin = $lastPin ? $lastPin + 1 : 1;

        $data_karyawan = [
            'k_nama' => $request->get('k_nama'),
            'k_contact' => $request->get('k_contact'),
            'k_email' => $request->get('k_email'),
            'K_alamat' => $request->get('K_alamat'),
            'k_nik' => $request->get('k_nik'),
            'k_pin' => $newPin,
            'k_divisi' => $request->get('k_divisi'),
            'k_biometric_status' => false,
        ];

        // dd($data_karyawan);
        
        // Simpan data karyawan dan ambil instance yang baru dibuat
        $karyawan = Karyawan::create($data_karyawan);
        
        
    
        $data_has_division = [
            'karyawan_id' => $karyawan->id,  
            'divisi_id' => $request->get('k_divisi'),
            'khr_tgljoin' => Carbon::now(), 
            'khr_isActive' => true,
            'khr_tglOut' => Carbon::now(),
        ];
    
        KaryawanHasDivision::create($data_has_division);

        Alert::success('success', 'Karyawan berhasil ditambahkan');
        return redirect()->route('daftar.karyawan');
    }
}
