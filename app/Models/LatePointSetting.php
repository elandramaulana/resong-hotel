<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LatePointSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_late',
        'first_latepoint',
        'second_late',
        'second_latepoint',
        'third_late',
        'third_latepoint',
        'besar_potongan',
        'besar_point'
    ];
}
