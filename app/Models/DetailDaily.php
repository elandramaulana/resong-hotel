<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailDaily extends Model
{
    use HasFactory;
    protected $table = 'detail_daily';
    protected $fillable = [
        'daily_id',
        'menu_id'
    ];
}
