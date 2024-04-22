<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogActiveMenu extends Model
{
    use HasFactory;
    protected $table = 'log_active_menu';
    protected $fillable = [
        'day_name',
        'menu_id',
        'menu_name',
        'menu_category',
        'menu_price'
    ];
}
