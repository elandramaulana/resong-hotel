<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkin extends Model
{
    use HasFactory;
    protected $fillable = [
        'reservation_id',
        'no_invoice',
        'room_id',
        'guest_id',
        'chanel_checkin',
        'date_checkin',
        'date_checkout',
        'guest_adult',
        'guest_kids',
        'is_extrabed',
        'payment_status',
        'payment',
        'payment_method',
    ];
}
