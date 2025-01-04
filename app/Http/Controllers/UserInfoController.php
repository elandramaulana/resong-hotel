<?php

namespace App\Http\Controllers;

use App\Models\DetailPayrolls;
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
        $dataKaryawan = Karyawan::where('user_id', Auth::id())->first();
        $dataSlipGaji = DetailPayrolls::join('payrolls', 'detail_payrolls.payroll_id', '=', 'payrolls.id')
                                        ->select('detail_payrolls.*', 'payrolls.*','detail_payrolls.id as detail_payroll_id')
                                        ->where('karyawan_id', $dataKaryawan->id)->get();
        return view('profile.slipgaji_info', compact('dataKaryawan', 'dataSlipGaji'));
    }
}
