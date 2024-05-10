<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = 'karyawan';
    protected $fillable = [
        'id',
        'k_nama',
        'k_contact',
        'k_email',
        'K_alamat',
        'k_nik,'
    ];
}
