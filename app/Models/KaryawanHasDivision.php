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
        'user_id',
        'khr_tgljoin',
        'khr_isActive',
        'khr_tglOut',
        'khd_ot_approval'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id', 'id');
    }

    // Relasi ke model Divisi
    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'divisi_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
