<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransAsset extends Model
{
    use HasFactory;
    protected $table = 'trans_assets';
    protected $fillable = [
        'asset_id',
        'trans_jml',
        'trans_harga',
        'supplier_asset_id',
        'trans_jenis',
    ];

    public function rAssets()
    {
        return $this->belongsTo(Assets::class, 'asset_id');
    }

    public function rSupplierAsset()
    {
        return $this->belongsTo(SupplierAsset::class, 'supplier_asset_id');
    }
}
