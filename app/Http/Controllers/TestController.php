<?php

namespace App\Http\Controllers;

use App\Models\Checkin;
use App\Models\Rooms;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        $checkin = "2024-03-25";
        $checkout = "2024-03-29";
        $qtyGuest = 1;

        $BookController = new BookingController();
        $listRoom = $BookController->BookingEngine($checkin, $checkout, $qtyGuest);

        
        echo json_encode($listRoom);
    }
}
