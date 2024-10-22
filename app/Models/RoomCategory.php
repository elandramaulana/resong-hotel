<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomCategory extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'room_category';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name_category',
    ];

    public function rooms() {
        return $this->hasMany(Rooms::class, 'room_type', 'nama_room');
    }
}