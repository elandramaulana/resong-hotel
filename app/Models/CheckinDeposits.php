<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckinDeposits extends Model
{
    use HasFactory;

    protected $table = 'checkin_deposits';

    protected $fillable = [
        'checkin_id',
        'deposit_type',
        'deposit',
        'deposit_lain',
        'deposit_status',
    ];
}
