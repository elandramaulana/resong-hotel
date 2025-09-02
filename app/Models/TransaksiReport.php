<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiReport extends Model
{
    use HasFactory;

    protected $table = 'transaction_reports'; // Sesuaikan dengan nama tabel di database

    protected $fillable = [
        'tabel_referensi',
        'id_referensi',
        'type_transaksi',
        'jenis_transaksi',
        'besar_transaksi',
        'keterangan_transaksi',
        'jenis_pembayaran',
        'created_at',
        'updated_at'
    ];

    protected $dates = ['besar_transaksi', 'created_at', 'updated_at'];
}
