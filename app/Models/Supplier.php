<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_supplier',
        'supplier_name',
        'supplier_telp',
        'supplier_alamat',
    ];

    public static function getAllSupplier()
    {
        return self::all();
    }
}
