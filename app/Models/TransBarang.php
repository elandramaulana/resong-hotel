<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransBarang extends Model
{
    use HasFactory;
    protected $table = 'trans_barang';
    protected $fillable = [
        'barang_id',
        'trans_jml',
        'trans_harga',
        'trans_suplier',
        'trans_jenis',
    ];
}
