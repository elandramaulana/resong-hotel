<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherTransactions extends Model
{
    use HasFactory;

    protected $table = 'other_transactions';

    protected $fillable = [
        'item',
        'qty',
        'harga',
        'tgl',
        'keterangan',
    ];
}
