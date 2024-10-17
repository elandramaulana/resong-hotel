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
        'kh_clock_in',
        'kh_clock_out',
        'status',
    ];

}
