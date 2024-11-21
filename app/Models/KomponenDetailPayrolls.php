<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomponenDetailPayrolls extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_detail_payroll',
        'nama_komponen_payroll',
        'besaran_komponen_payroll',
        'type_komponen_payroll',
        'keterangan_komponen_payroll'
    ];
}
