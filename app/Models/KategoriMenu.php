<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriMenu extends Model
{
    use HasFactory;

    protected $table = 'kategori_menu';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'nama_kategori',
    ];

    public function menus()
    {
        return $this->hasMany(Menu::class, 'menu_category', 'id');
    }

    public static function getAllCategories()
    {
        return self::all();
    }
}
