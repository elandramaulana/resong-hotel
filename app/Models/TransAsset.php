<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransAsset extends Model
{
    use HasFactory;
    protected $table = 'trans_assets';
    protected $fillable = [
        'assets_id',
        'trans_jml',
        'trans_harga',
        'trans_suplier',
        'trans_jenis',
    ];

    public function rAssets()
    {
        return $this->belongsTo(Assets::class, 'assets_id');
    }

    public function rSupplierAsset()
    {
        return $this->belongsTo(SupplierAsset::class, 'supplier_asset_id');
    }
}
