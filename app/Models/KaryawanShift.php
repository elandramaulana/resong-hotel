<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryawanShift extends Model
{
    use HasFactory;
    protected $table = 'karyawan_shifts';
    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'karyawan_id',
        'shift_id',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }

}
