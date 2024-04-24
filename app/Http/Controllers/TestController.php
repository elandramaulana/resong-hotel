<?php

namespace App\Http\Controllers;

use App\Models\Checkin;
use App\Models\Rooms;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        $laund = new LaundryController();
        $jumlah = $laund->getSumPrice(5);
        print_r($jumlah);
    }
}
