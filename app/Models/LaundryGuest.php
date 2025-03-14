<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryGuest extends Model
{
    use HasFactory;

    protected $table = 'laundry_guests';

    protected $fillable = [
        'checkin_id',
        'room_id',
        'jenis_laundry',
        'catatan',
        'harga',
        'tgl_laundry_keluar',
        'fo_user_id_keluar',
        'tgl_laundry_masuk',
        'fo_user_id_masuk',
        'status',
    ];
}
