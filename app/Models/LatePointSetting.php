<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LatePointSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'extrabed_price',
        'pajak_checkin',
        'first_late',
        'first_latepoint',
        'second_late',
        'second_latepoint',
        'third_late',
        'third_latepoint',
        'besar_potongan',
        'besar_point',
        'payroll_period',
        'ot_price'
    ];
}
