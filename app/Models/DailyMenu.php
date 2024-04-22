<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyMenu extends Model
{
    use HasFactory;
    protected $table = 'daily_menus';
    protected $fillable = [
        'day_name',
        'status'
    ];

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'detail_daily', 'daily_id', 'menu_id');
    }
}
