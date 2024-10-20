<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransResto extends Model
{
    use HasFactory;
    protected $table = 'trans_resto';
    protected $fillable = [
        'checkin_id',
        'guest_name',
        'guest_contact',
        'guest_email'
    ];
}
