<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laundry extends Model
{
    use HasFactory;
    public $fillable = [
        'laundry_type',
        'checkin_id',
        'laundry_status',
    ];
}
