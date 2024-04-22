<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryCat extends Model
{
    use HasFactory;
    public $fillable = [
        'catergory_name',
        'cat_price',
        'cat_unit',
        'cat_desc'
    ];
}
