<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LatePoint extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        'karyawan_id',
        'date',
        'month',
        'late_point'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
