<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Karyawan;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class KehadiranController extends Controller
{
    public function index()
    {
        $divisis = Divisi::all();
        $shifts = Shift::all();
        return view('pegawai.absensi', compact('divisis', 'shifts'));
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

    
    if ($request->filled('id_divisi')) {
        $query->where('divisis.id', $request->id_divisi);
    }
    if ($request->filled('id_shift')) {
        $query->where('shifts.id', $request->id_shift);
    }

    $query->whereExists(function ($subquery) {
        $subquery->select(DB::raw(1))
            ->from('scan_logs')
            ->whereRaw('scan_logs.pin = karyawan.k_pin');
    });

    $tgl = $request->get('tanggal_absen');
    
    
    $absensi = $query->get();

    
    $transformedAbsensi = $absensi->map(function ($item) use ($tgl) {
        $AttController = New AttendanceController();    
        $checkin = $AttController->getPunchInnOut($item->karyawan_id, $tgl);
        $durasi = Durasi($checkin['punch_in'], $checkin['punch_out']);
        
        $status = '';
        $status_class = '';
        if (is_null($checkin['punch_in'])) {
            $status = 'Undefined';
            $status_class = 'btn-secondary'; 
        } elseif ($checkin['punch_in'] <= $item->s_clock_in) {
            $status = 'Ontime';
            $status_class = 'btn-success';
        } else {
            $status = 'Late';
            $status_class = 'btn-danger'; 
        }

        $punch_in_time = is_null($checkin['punch_in']) ? '-' : Carbon::parse($checkin['punch_in'])->format('H:i');
        $punch_out_time = is_null($checkin['punch_out']) ? '-' : Carbon::parse($checkin['punch_out'])->format('H:i');

        return [
            'nama' => $item->k_nama,
            'divisi' => $item->d_nama,
            'tanggal' => $item->scan_date,
            'punch_in' => $punch_in_time,
            'punch_out' => $punch_out_time,
            'shift_nama' => $item->s_nama,
            'schedule_in' => $item->s_clock_in,
            'schedule_out' => $item->s_clock_out,
            'working_hour' => $durasi,
            'status_absensi' => $status,
            'status_class' => $status_class // untuk styling button status
        ];
    });
    
    return response()->json(['absensi' => $transformedAbsensi]);
}

    
  
}
