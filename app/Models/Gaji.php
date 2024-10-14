<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;
    protected $table = 'gaji';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'karyawan_id',
        'no_rek',
        'gaji_pokok'
    ];
}
