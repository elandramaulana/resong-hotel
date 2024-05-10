<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;
    protected $table = 'divisis';
    protected $fillable = [
        'id',
        'd_nama',
        'd_deskripsi',
        'd_jobdesc',
        'd_OT_approver',
    ];
}
