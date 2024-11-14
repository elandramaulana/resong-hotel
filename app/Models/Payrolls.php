<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payrolls extends Model
{
    use HasFactory;
    protected $fillable = [
        'periode_payroll',
        'hari_kerja',
        'total_penggajian',
        'jumlah_karyawan',
        'payroll_status'
    ];
}
