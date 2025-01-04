<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OverTime extends Model
{
    use HasFactory;
    protected $table = 'over_times';
    protected $fillable = [
        'id',
        'khd_id',
        'ot_date',
        'ot_start',
        'ot_end',
        'ot_duration',
        'ot_approval',
        'ot_approvedBy',
        'ot_reason_reject'
    ];

    public function callOvertimes(  $divisi_id = null, 
                                    $ot_date= null, 
                                    $ot_approval= null, 
                                    $ot_approvedBy= null){
        $Query = OverTime::join('karyawan_has_divisions', 'karyawan_has_divisions.id','=', 'over_times.khd_id')
                            ->join('karyawan', 'karyawan.id', '=', 'karyawan_has_divisions.karyawan_id')
                            ->join('karyawan_shifts', 'karyawan_shifts.karyawan_id', '=', 'karyawan.id')
                            ->join('shifts', 'shifts.id', '=', 'karyawan_shifts.shift_id')
                            ->select('over_times.*', 
                                     'over_times.id as ot_id',
                                     'karyawan.*', 
                                     'shifts.s_nama', 
                                     'shifts.s_clock_out');
        if($divisi_id){
            $Query->where('karyawan_has_divisions.divisi_id', $divisi_id);
        }
        if($ot_date){
            $Query->where('over_times.ot_date', $ot_date);
        }
        
        if($ot_approval){
            $Query->where('over_times.ot_approval', $ot_approval);
        }
        if($ot_approvedBy){
            $Query->where('over_times.ot_approvedBy', $ot_approvedBy);
        }
        $Query->orderBy('over_times.created_at', 'desc');
        return $Query->get();
    }
}
