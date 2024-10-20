<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransResto extends Model
{
    use HasFactory;
    protected $table = 'detail_trans_resto';
    protected $fillable = [
        'trans_resto_id',
        'menu_id',
        'qty'
    ];
}
