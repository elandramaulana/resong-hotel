<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\ScanLog;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function getPunchIn($karyawan_id, $punchin_date) {
        $Query = Karyawan::leftJoin('scan_logs', 'scan_logs.pin', '=', 'karyawan.k_pin')
                        ->whereDate('scan_logs.scan_date', $punchin_date)
                        ->where('karyawan.id', $karyawan_id)
                        ->orderBy('scan_logs.scan_date', 'asc')
                        ->first();
        $scan_date = $Query->scan_date ?? null;
        return $scan_date;
    }
    public function getPunchOut($karyawan_id, $punchin_date) {
        //check count data dengan tanggal yg sama > 1 = ada checkout =/ <1 = tidak ada checkout
        $cq = ScanLog::where('pin', $karyawan_id)->count();
        if ($cq > 1) {

        $Query = Karyawan::leftJoin('scan_logs', 'scan_logs.pin', '=', 'karyawan.k_pin')
                        ->whereDate('scan_logs.scan_date', $punchin_date)
                        ->where('karyawan.id', $karyawan_id)
                        ->latest('scan_logs.scan_date')
                        ->first();
        $scan_date = $Query->scan_date ?? null;
        return $scan_date;

        }else{
            return '-';
            
        }
    }
    public function getPunchInnOut($karyawan_id, $punch_date) {
        $punch_in = $this->getPunchIn($karyawan_id, $punch_date);
        $punch_out = $this->getPunchOut($karyawan_id, $punch_date);
        return ['punch_in'=>$punch_in, 'punch_out'=>$punch_out];
    }
}
