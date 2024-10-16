<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryBarang extends Model
{
    use HasFactory;
    protected $table = 'category_barang';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_kategori',
    ];

    public function barang()
    {
        return $this->hasMany(Barang::class, 'barang_kategori', 'id');
    }

    public static function getAllCategories()
    {
        return self::all();
    }
}
