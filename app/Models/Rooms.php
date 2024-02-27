<?php

namespace App\Models;

use ArrayObject;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'room_no',
        'room_name',
        'room_type',
        'room_capacity',
        'room_extrabed',
        'room_price',
        'room_status',
        'bed_type',
    ];

   public function detailRoomsByType($room_type) : Collection{
    $data = $this->where('room_type', $room_type)->get();
    return $data;
   }
}
