<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_guest',
        'id_type',
        'id_number',
        'date_of_birth',
        'place_of_birth',
        'guest_gender',
        'guest_religion',
        'guest_title',
        'guest_country',
        'guest_province',
        'guest_city',
        'guest_postalcode',
        'guest_email',
        'guest_contact',
    ];
}
