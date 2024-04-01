<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetLaundry extends Model
{
    use HasFactory;
    public $fillable = [
        'laundry_id',
        'id_category',
        'det_laundry_price',
        'det_laundry_qty'
        'det_laundry_desc'
    ];
}
