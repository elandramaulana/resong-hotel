<?php

namespace App\Http\Controllers;

use App\Models\Checkin;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        $DataCheckin = Checkin::leftJoin('checkouts', 'checkins.id','=','checkouts.checkin_id')
                        ->join('rooms', 'rooms.id', '=', 'checkins.room_id')
                        ->join('guests', 'guests.id', '=', 'checkins.guest_id')
                        ->select('checkins.*', 'checkins.id as checkin_id')
                        ->addselect('rooms.*', 'rooms.id as room_id')
                        ->addselect('guests.name_guest', 'guests.id as guest_id')
                        ->where('checkouts.id', null)
                        ->get();
        echo json_encode($DataCheckin);
    }
}
