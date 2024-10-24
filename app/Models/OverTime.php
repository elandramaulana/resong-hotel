<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OverTime extends Model
{
    use HasFactory;
    protected $table = 'over_times';
    protected $fillable = [
        'id',
        'khd_id',
        'ot_start',
        'ot_end',
        'ot_approval',
        'ot_approvedBy'
    ];
}
