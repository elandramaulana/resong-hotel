<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScanLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'pin',
        'scanlog_id',
        'workcode',
        'verifymode',
        'iomode',
        'scan_date',
        'sync_date',
    ];
}