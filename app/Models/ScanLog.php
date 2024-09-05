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
        'work_code',
        'verify_mode',
        'io_mode',
        'scan_date',
        'sync_date',
    ];
}
