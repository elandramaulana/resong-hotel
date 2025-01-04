<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extend extends Model
{
    use HasFactory;
    protected $filllable = [
        'checkin_id',
        'date_extend',
        'description_extend'
    ];
}
