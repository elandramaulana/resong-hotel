<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryLinen extends Model
{
    use HasFactory;

    protected $table = 'laundry_linens';

    protected $fillable = [
        'nama_item',
        'jumlah_satuan',
        'tgl_keluar',
        'user_id_keluar',
        'tgl_masuk',
        'user_id_masuk',
        'harga',
        'invoice_laundry',
        'status',
        'status_kembali',
        'keterangan_status'
    ];
}
