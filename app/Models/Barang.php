<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'id';
    protected $fillable = [
        'barang_nama',
        'barang_kategori',
        'barang_satuan',
    ];


    public function kategori()
    {
        return $this->belongsTo(CategoryBarang::class, 'barang_kategori', 'id');
    }

    // public function barangMasuk()
    // {
    //     return $this->hasMany(BarangMasuk::class, 'nama_barang', 'id');
    // }

    public static function getAllCategories()
    {
        return self::all();
    }

    // public function menu()
    // {
    //     return $this->hasMany(Menu::class, 'bahan_menu', 'id');
    // }

    // public function barang()
    // {
    //     return $this->hasMany(BarangMasuk::class, 'barang_name', 'nama_barang');
    // }

    // public static function getAllBarang()
    // {
    //     return self::all();
    // }
} 
