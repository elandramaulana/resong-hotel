<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_id',
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
        'reservation_payment',
        'reservation_status',
        'reservation_desc',
    ];
    public function room()
    {
        return $this->belongsTo(Rooms::class, 'room_id', 'id');
    }
}
