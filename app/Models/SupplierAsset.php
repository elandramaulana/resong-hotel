<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierAsset extends Model
{
    use HasFactory;
    protected $table = 'supplier_assets';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_supplier',
        'supplier_name',
        'supplier_telp',
        'supplier_alamat',
    ];
}
