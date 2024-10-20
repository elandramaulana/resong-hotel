<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomponenGaji extends Model
{
    use HasFactory;
    protected $table = 'komponen_gaji';
    protected $fillable = [
        'karyawan_id',
        'nama_komponen',
        'besaran',
        'tipe_komponen',
        'deskripsi_komponen'
    ];
}
