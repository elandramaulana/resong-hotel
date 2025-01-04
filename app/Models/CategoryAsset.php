<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryAsset extends Model
{
    use HasFactory;

    protected $table = 'category_assets';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_kategori',
    ];

    public function rAsset()
    {
        return $this->hasMany(Assets::class, 'category_asset_id', 'id');
    }
}
