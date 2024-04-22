<?php

namespace App\Http\Controllers;

use App\Models\Checkin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index()  {
        //query room checkin id = checkin_id value = room_no
        $query = Checkin::leftJoin('checkouts', 'checkouts.checkin_id', '=', 'checkins.id')
                            ->join('rooms', 'rooms.id', '=', 'checkins.room_id')
                            ->join('guests', 'guests.id', '=', 'checkins.guest_id')
                            ->select('checkins.*','checkins.id as checkin_id', 'rooms.room_no', 'guests.name_guest')
                            ->get();
        $no=1;
        foreach($query as $data){
            $show[] = [
                'id'=>$data['checkin_id'],
                'text'=>$data['room_no'].' ('.$data['name_guest'].')'
            ];
            $no++;
        }
        echo json_encode($show);
    }
}
