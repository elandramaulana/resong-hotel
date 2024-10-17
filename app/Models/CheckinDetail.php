<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckinDetail extends Model
{
    use HasFactory;
    
    public $fillable = [
        'checkin_id',
        'item_category',
        'item_name',
        'item_price',
        'item_qty',
        'item_description'
    ];
}
