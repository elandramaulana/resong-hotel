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

    public function listDetailDaily($daily_id, $kategori_id) {
        $list = $this->join('menus', 'menus.menu_id', '=', 'detail_daily.menu_id')
                ->join('daily_menus', 'daily_menus.id', '=', 'detail_daily.daily_id')
                ->join('kategori_menu', 'kategori_menu.id', '=', 'menus.menu_category')
                ->where('detail_daily.daily_id', $daily_id)
                ->where('menus.menu_category', $kategori_id)
                ->get();
        return $list;
    }
}
