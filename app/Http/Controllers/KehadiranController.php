<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateLatePointRequest;
use App\Models\Divisi;
use App\Models\Karyawan;
use App\Models\LatePointSetting;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelIgnition\Http\Requests\UpdateConfigRequest;

class KehadiranController extends Controller
{
    public function index()
    {
        $divisis = Divisi::all();
        $shifts = Shift::all();
        $latePointSetting = LatePointSetting::first();
        
        return view('pegawai.absensi', compact('divisis', 'shifts', 'latePointSetting'));
    }

    public function postUpdateLatePoint(UpdateLatePointRequest $request){
        $getSettings = LatePointSetting::first();
        $getSettings->first_late = $request->first_late;
        $getSettings->first_latepoint = $request->first_latepoint;
        $getSettings->second_late = $request->second_late;
        $getSettings->second_latepoint = $request->second_latepoint;
        $getSettings->third_late = $request->third_late;
        $getSettings->third_latepoint = $request->third_latepoint;
        $getSettings->besar_potongan = $request->besar_potongan;
        $getSettings->besar_point = $request->besar_point;
        $getSettings->save();

        return response()->json(['status' => 'success', 'message' => 'Setting berhasil diperbarui']);
    }
    public function getKaryawanByDivisi($divisiId)
    {
        $karyawan = Karyawan::whereHas('karyawanHasDivisions', function ($query) use ($divisiId) {
            $query->where('divisi_id', $divisiId)->where('khr_isActive', 1);
        })->get(['id', 'k_nama']);
        return response()->json($karyawan);
    }

    public function getShiftsByDivisi($divisiId)
    {
        $shifts = Shift::where('id_divisi', $divisiId)->get(['id', 's_nama']);
        return response()->json($shifts);
    }

    public function filterAbsensi(Request $request)
    {
        $query = Karyawan::join('karyawan_has_divisions', 'karyawan_has_divisions.karyawan_id', '=', 'karyawan.id')
    ->join('divisis', 'divisis.id', '=', 'karyawan_has_divisions.divisi_id')
    ->leftJoin('karyawan_shifts', 'karyawan_shifts.karyawan_id', '=', 'karyawan.id')
    ->leftJoin('shifts', 'shifts.id', '=', 'karyawan_shifts.shift_id');

// Filter opsional berdasarkan request
if ($request->filled('id_divisi')) {
    $query->where('divisis.id', $request->id_divisi);
}
if ($request->filled('id_shift')) {
    $query->where('shifts.id', $request->id_shift);
}

// Tambahkan kondisi untuk mengambil data hanya dari karyawan yang ada di scan_logs
    $query->whereExists(function ($subquery) {
        $subquery->select(DB::raw(1))
            ->from('scan_logs')
            ->whereRaw('scan_logs.pin = karyawan.k_pin');
    });

   $tgl = $request->get('tanggal_absen');

     //$tgl = '2024-09-10';
    
    // Mengambil data absensi
    $absensi = $query->get();

    // dd($absensi);
    // Mengubah data absensi menjadi format yang diinginkan
    $transformedAbsensi = $absensi->map(function ($item) use ($tgl) {
        $AttController = New AttendanceController();    
        $checkin = $AttController->getPunchInnOut($item->karyawan_id, $tgl);
        $durasi = Durasi($checkin['punch_in'],$checkin['punch_out']);
        return [
            'nama' => $item->k_nama,
            'divisi' => $item->d_nama,
            'tanggal' => $item->scan_date,
            'punch_in'=>$checkin['punch_in'],
            'punch_out'=>$checkin['punch_out'],
            'shift_nama' => $item->s_nama, 
            'schedule_in' => $item->s_clock_in,
            'schedule_out' => $item->s_clock_out,
            'working_hour'=>$durasi
        ];
    });
    
    return response()->json(['absensi' => $transformedAbsensi]);
    }    
  
}
