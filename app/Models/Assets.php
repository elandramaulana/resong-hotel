<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assets extends Model
{
    use HasFactory;
    protected $table = 'assets';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
        'category_asset_id',
        'satuan',
    ];

    public function rCategoryAssets()
    {
        return $this->belongsTo(CategoryAsset::class, 'category_asset_id', 'id');
    }
}
