<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';
    protected $primaryKey = 'id';
    protected $fillable = ['menu_name', 'menu_category', 'menu_price', 'menu_photo'];

  
    public function kategori()
    {
        return $this->belongsTo(KategoriMenu::class, 'menu_category', 'id');
    }

    public static function getAllCategories()
    {
        return self::all();
    }

    public function dailyMenus()
    {
        return $this->belongsToMany(DailyMenu::class, 'detail_daily', 'menu_id', 'daily_id');
    }

}
