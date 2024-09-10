<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryawanHasDivision extends Model
{
    use HasFactory;
    protected $table = 'karyawan_has_divisions';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'karyawan_id',
        'divisi_id',
        'khr_tgljoin',
        'khr_isActive',
        'khr_tglOut'
    ];
}
