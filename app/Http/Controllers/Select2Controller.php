<?php

namespace App\Http\Controllers;

use App\Models\Checkin;
use App\Models\LaundryCat;
use Illuminate\Http\Request;

class Select2Controller extends Controller
{
    public function room_inhouse()  {
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
    public function cat_laundry() {
        $query = LaundryCat::all();
        $no=1;
        foreach($query as $data){
            $show[] = [
                'id'=>$data['id'],
                'text'=>$data['catergory_name']
            ];
            $no++;
        }
        echo json_encode($show);
    }
    
}
