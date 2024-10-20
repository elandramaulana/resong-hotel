<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'divisis';
    protected $fillable = [
        'id',
        'd_nama',
        'd_deskripsi',
        'd_jobdesc',
        'd_OT_approver',
    ];

    public function shift()
    {
        return $this->hasMany(Shift::class, 'id_divisi', 'id');
    }

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class, 'k_divisi', 'id');
    }

    public function karyawanHasDivision()
    {
        return $this->hasMany(KaryawanHasDivision::class, 'divisi_id', 'id');
    }
}
