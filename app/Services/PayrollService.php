<?php

namespace App\Services;

use App\Models\DetailPayrolls;
use App\Models\Karyawan;
use App\Models\KomponenDetailPayrolls;
use App\Models\KomponenGaji;
use App\Models\LatePoint;
use App\Models\LatePointSetting;
use App\Models\Payrolls;
use App\Models\ScanLog;
use Carbon\Carbon;

class PayrollService
{
    public function CountWorkdays() : array {
        $lastPayroll = Payrolls::latest('created_at')->first();
        if($lastPayroll){
            $startDate = Carbon::parse($lastPayroll->created_at)->addDay();
        }else{
            $startDate = ScanLog::orderBy('scan_date')->value('scan_date');
            $startDate = Carbon::parse($startDate);
        }
        $endDate = Carbon::yesterday();
        $workdays = $startDate->diffInDays($endDate);
        $countWeek = $startDate->diffInWeeks($endDate);
        $workdays = $workdays - $countWeek;
        if($workdays > 0){
            return [
                'workdays' => $workdays,
                'startDate' => $startDate,
                'endDate' => $endDate,
            ];
        }else{
            return false;
        }
    }

    public function KomponenGaji($karyawan_id, $payroll_id) {
        //create detail payroll with karyawan data
        $detailPayrolls = DetailPayrolls::create([
            'payroll_id'=> $payroll_id,
            'karyawan_id'=> $karyawan_id,
        ]);
        //call komponen gaji perkaryawan dan insert ke komponen detail payroll
        $KomponenGaji = KomponenGaji::where('karyawan_id', $karyawan_id)->get();
        $sumPendapatan = 0;
        $sumPotongan = 0;
        $komponenDetailPayrolls=[];
        foreach ($KomponenGaji as $komponen) {
            $komponenDetailPayrolls[] = [
                'id_detail_payroll'=>$detailPayrolls->id,
                'nama_komponen_payroll'=>$komponen->nama_komponen,
                'besaran_komponen_payroll'=>$komponen->besaran,
                'type_komponen_payroll'=>$komponen->tipe_komponen,
                'keterangan_komponen_payroll'=>$komponen->deskripsi_komponen,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ];
            if($komponen->tipe_komponen=='pendapatan'){
                $sumPendapatan += $komponen->besaran;
            }else if($komponen->tipe_komponen=='potongan'){
                $sumPotongan += $komponen->besaran;
            }
        }
        $detailPayrolls->total_pendapatan = $sumPendapatan;
        $detailPayrolls->total_potongan = $sumPotongan;
        $detailPayrolls->thp = $sumPendapatan-$sumPotongan;
        $detailPayrolls->save();
        if(KomponenDetailPayrolls::insert($komponenDetailPayrolls)){
            return ['status'=>'success', 'detail_payroll_id'=>$detailPayrolls->id];
        }else{
            return ['status'=>'failed'];
        }
    }

    public function insertLatePoint($karyawan_id, $id_detail_payroll, $startDate, $endDate) {
        //call point and sumarize that in payroll period
        
        $callLate = LatePoint::whereBetween('date', [$startDate, $endDate])
                            ->where('karyawan_id', $karyawan_id)
                            ->selectRaw('karyawan_id, SUM(late_point) as total_late_points, count(id) kali_late')
                            ->groupBy('karyawan_id')
                            ->first();
       
        // call besar potongan dari latepoint settings
        $lateSettings = LatePointSetting::first();
        if($callLate->kali_late> 0 ){
            $devideBy = $callLate->total_late_points/$lateSettings->besar_point;
            $besarPotongan = $devideBy*$lateSettings->besar_potongan;
            //insert into KomponenDetailPayroll
            $KomponenDetailPayroll = [
                'id_detail_payroll'=>$id_detail_payroll,
                'nama_komponen_payroll'=>"Potongan Keterlambatan (".$callLate->kali_late." Kali / ".$callLate->total_late_points." Point)",
                'besaran_komponen_payroll'=>$besarPotongan,
                'type_komponen_payroll'=>"potongan",
                'keterangan_komponen_payroll'=>"Potongan Otomatis dari point keterlambatan",
            ];
            if(KomponenDetailPayrolls::create($KomponenDetailPayroll)){
                //update detail payroll
                $detailPayroll = DetailPayrolls::find($id_detail_payroll);
                $detailPayroll->total_potongan += $besarPotongan;
                $detailPayroll->thp = $detailPayroll->total_pendapatan-$detailPayroll->total_potongan;
                $detailPayroll->save();
                
                return ['status'=>'success', 'data'=>$KomponenDetailPayroll];
            }
        }

    }
}
