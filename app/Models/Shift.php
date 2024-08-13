<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'shifts';
    protected $fillable = [
        'id',
        'id_divisi',
        's_nama',
        's_clock_in',
        's_clock_out',
    ];

    public static function getAllDivision()
    {
        return self::all();
    }

    public function divisi()
{
    return $this->belongsTo(Divisi::class, 'id_divisi', 'id');
}
}

