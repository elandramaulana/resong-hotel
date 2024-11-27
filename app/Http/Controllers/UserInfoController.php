<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Karyawan;
use App\Models\Kehadiran;
use App\Models\Payrolls;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserInfoController extends Controller
{
    public function profile()
    {
        $userId = Auth::id();

        // Ambil informasi user
        $userInfo = User::where('id', $userId)->first();
    
        // Ambil data karyawan berdasarkan user_id
        $karyawanData = Karyawan::join('karyawan_has_divisions', 'karyawan.id', '=', 'karyawan_has_divisions.karyawan_id')
        ->join('divisis', 'karyawan_has_divisions.divisi_id', '=', 'divisis.id')
        ->where('karyawan_has_divisions.user_id', $userId)
        ->select(
            'karyawan.*',
            'karyawan_has_divisions.khr_tgljoin',
            'karyawan_has_divisions.khr_tglOut',
            'divisis.d_nama as divisi_nama'
        )
        ->get();

        // dd($karyawanData);
    
        return view('profile.user_info', compact('userInfo', 'karyawanData'));
    }
    public function history_absensi()
    {
        $userId = Auth::id();

        // Ambil data absensi karyawan berdasarkan user_id
        $absensiData = Kehadiran::join('karyawan_has_divisions', 'kehadirans.khd_id', '=', 'karyawan_has_divisions.id')
            ->join('karyawan', 'karyawan_has_divisions.karyawan_id', '=', 'karyawan.id')
            ->where('karyawan_has_divisions.user_id', $userId)
            ->select(
                'kehadirans.*', 
                'karyawan.k_nama', 
                'karyawan_has_divisions.divisi_id',
                'karyawan_has_divisions.khr_tgljoin'
            )
            ->orderBy('kehadirans.kh_clock_in', 'desc')  // Urutkan berdasarkan waktu absen terbaru
            ->get();

        return view('profile.absent_info', compact('absensiData'));
    }




    public function get_available_years()
{
    $userId = Auth::id();

    // Ambil tahun-tahun yang tersedia dari data absensi
    $years = Kehadiran::join('karyawan', 'kehadirans.karyawan_id', '=', 'karyawan.id')
        ->join('karyawan_has_divisions', 'karyawan.id', '=', 'karyawan_has_divisions.karyawan_id')
        ->where('karyawan_has_divisions.user_id', $userId)
        ->selectRaw('YEAR(kehadirans.kh_clock_in) as year')
        ->groupBy('year')
        ->orderBy('year', 'desc')
        ->pluck('year');

    return response()->json($years);
}
    



    public function history_slip_gaji()
    {
        $userId = Auth::id();
        // Ambil data payroll berdasarkan user yang login
        $payrolls = Payrolls::join('detail_payrolls', 'detail_payrolls.payroll_id', '=', 'payrolls.id')
    ->join('karyawan', 'detail_payrolls.karyawan_id', '=', 'karyawan.id')
    ->leftJoin('komponen_detail_payrolls', 'komponen_detail_payrolls.id_detail_payroll', '=', 'detail_payrolls.id') // Menghubungkan dengan komponen_detail_payrolls untuk tunjangan, lembur, dan bonus
    ->where('karyawan.user_id', $userId) // Menggunakan auth() untuk mendapatkan user_id yang sedang login
    ->select(
        'karyawan.k_nama', 
        'karyawan.k_divisi', 
        'karyawan.k_norek',
        'payrolls.periode_payroll',
        'detail_payrolls.total_pendapatan AS gaji_pokok',
        DB::raw('SUM(CASE WHEN komponen_detail_payrolls.type_komponen_payroll = "pendapatan" THEN komponen_detail_payrolls.besaran_komponen_payroll ELSE 0 END) AS tunjangan'),
        DB::raw('SUM(CASE WHEN komponen_detail_payrolls.type_komponen_payroll = "pendapatan" AND komponen_detail_payrolls.nama_komponen_payroll = "lembur" THEN komponen_detail_payrolls.besaran_komponen_payroll ELSE 0 END) AS lembur'),
        DB::raw('SUM(CASE WHEN komponen_detail_payrolls.type_komponen_payroll = "pendapatan" AND komponen_detail_payrolls.nama_komponen_payroll = "bonus" THEN komponen_detail_payrolls.besaran_komponen_payroll ELSE 0 END) AS bonus'),
        'detail_payrolls.total_potongan AS potongan',
        'detail_payrolls.thp AS total_gaji',
        'payrolls.payroll_status',
        'payrolls.created_at AS tanggal_pembayaran'
    )
    ->groupBy(
        'payrolls.periode_payroll',
        'detail_payrolls.total_pendapatan',
        'detail_payrolls.total_potongan',
        'detail_payrolls.thp',
        'payrolls.payroll_status',
        'payrolls.created_at',
        'karyawan.k_nama',
        'karyawan.k_divisi',
        'karyawan.k_norek'
    )
    ->orderByDesc('payrolls.periode_payroll')
    ->get();

    


            // dd($payrolls);
        return view('profile.slipgaji_info', compact('payrolls'));
    }
}
