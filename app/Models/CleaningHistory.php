<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CleaningHistory extends Model
{
    use HasFactory;

    protected $table = 'history_cleaning_room';

    protected $fillable = [
        'tanggal_cleaning',
        'pic_cleaning',
        'jam_cleaning',
        'room_type',
        'room_no',
        'status'
    ];
}
