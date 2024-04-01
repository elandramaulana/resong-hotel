<?php

namespace App\Http\Controllers;

use App\Models\Checkin;
use App\Models\Rooms;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        $query = Checkin::leftJoin('checkouts', 'checkouts.checkin_id', '=', 'checkins.id')
                        ->join('rooms', 'rooms.id', '=', 'checkins.room_id')
                        ->join('guests', 'guests.id', '=', 'checkins.guest_id')
                        ->select('checkins.*','checkins.id as checkin_id', 'rooms.room_no', 'guests.name_guest')
                        ->get();
        echo json_encode($query);
    }
}
