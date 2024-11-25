<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;
    protected $table = 'kehadirans';
    protected $fillable = [
        'id',
        'khd_id',
        'shift_id',
        's_nama',
        's_clock_in',
        's_clock_out',
        'kh_clock_in',
        'kh_clock_out',
        'status',
    ];

}
