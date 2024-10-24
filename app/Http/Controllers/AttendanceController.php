<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\LatePoint;
use App\Models\ScanLog;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    public function ProsessLatePoint($karyawan_id, $date) {
        Log::info('Proccess Latepoint Executed');
        $dateObj = new DateTime($date);
        $month = $dateObj->format('m');
        //get shift check in from detail karyawan
        $KaryawanController = new KaryawanController();
        $Karyawan = $KaryawanController->DetailKaryawan($karyawan_id);
        $shift_clockin = $Karyawan->s_clock_in;
        $shift_clockout = $Karyawan->s_clock_out;

        $punch = $this->getPunchInnOut($karyawan_id, $date);
        $punch_in = $punch['punch_in'];
        $punchinTime = (new DateTime($punch_in))->format('H:i');
        $shift_in = (new DateTime($shift_clockin))->format('H:i');
        $shift_clockin_time = DateTime::createFromFormat('H:i', $shift_in);
        $punch_in_time_obj = DateTime::createFromFormat('H:i', $punchinTime);
        //setData for LatePoint
        if($shift_clockin_time < $punch_in_time_obj){
            $countLate = $this->countLateRecord($karyawan_id, $date);
            Log::info($countLate);
            if($countLate >= 3 ){
                $latePoint = 10;
            }else{
                $latePoint = 0;
            }
            $dataLate = [
                'karyawan_id'=>$karyawan_id,
                'date'=>$date,
                'month'=>$month,
                'late_point'=>$latePoint
            ];
            LatePoint::create($dataLate);
        }
        Log::info("Karyawan ID".$karyawan_id.'shift :'.$shift_clockin.'ckin:'.$punch_in);
    }
    public function countLateRecord($karyawan_id, $date) {
        $dateObj = new DateTime($date);
        $month = $dateObj->format('m');
        $lateRecord = LatePoint::where('karyawan_id', $karyawan_id)
                                ->where('month', $month)
                                ->count();
        return $lateRecord;
    }
}
