<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = 'karyawan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'k_nama',
        'k_contact',
        'k_email',
        'K_alamat',
        'k_nik',
        'k_pin',
        'k_divisi',
        'k_biometric_status'
    ];

    public static function getAllDivision()
    {
        return self::all();
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi', 'id');
    }
}