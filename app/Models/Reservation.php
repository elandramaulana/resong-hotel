<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'reservation_chanel',
        'reservation_date',
        'reservation_checkin',
        'reservation_checkout',
        'reservation_name',
        'reservation_contact',
        'reservation_email',
        'qty_guest',
        'reservation_payment_status',
        'reservation_payment_method',
        'reservation_status',
        'reservation_desc',
    ];
}
