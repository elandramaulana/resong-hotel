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


    public function detCheckin($checkin_id) {
        $Query = $this->join('rooms', 'rooms.id', '=', 'checkins.room_id')
                ->join('guests', 'guests.id', '=', 'checkins.guest_id')
                ->select('checkins.*', 'rooms.*', 'guests.*', 'checkins.id as checkin_id')
                ->where('checkins.id', $checkin_id)
                ->get()->first();
        if($Query){
            return $Query;
        }else{
            return false;
        }
    }
}
