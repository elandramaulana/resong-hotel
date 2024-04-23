<?php

namespace App\Http\Controllers;

use App\Models\Checkin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RestoMenuController extends Controller
{
    public function index() {
        $Data = [
            'Title'=>"List Menu Resto"
        ];

        // $resto = Supplier::all();
        return view('inventorykitchen.resto.resto_menu',  $Data);
    }

    public function room_inhouse_resto()  {
        //query room checkin id = checkin_id value = room_no
        $query = Checkin::leftJoin('checkouts', 'checkouts.checkin_id', '=', 'checkins.id')
                            ->join('rooms', 'rooms.id', '=', 'checkins.room_id')
                            ->join('guests', 'guests.id', '=', 'checkins.guest_id')
                            ->select('checkins.*','checkins.id as checkin_id', 'rooms.room_no', 'guests.name_guest')
                            ->get();

        foreach($query as $data){
            $show[] = [
                'id'=>$data['checkin_id'],
                'text'=>$data['room_no'].' ('.$data['name_guest'].')'
            ];
        }
        echo json_encode($show);
    }

 

    public function form()
    {
        $Data = [
            'Title'=>'Form Resto',
        ];

        $dayNameMapping = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];

        $englishDayName = Carbon::now()->englishDayOfWeek;
        $dayName = $dayNameMapping[$englishDayName];



        // Query untuk mengambil menu berdasarkan day_name dan status
        $menus = DB::table('detail_daily as dd')
            ->select('dd.menu_id', 'm.menu_name', 'm.menu_price', 'm.menu_photo')
            ->join('menus as m', 'dd.menu_id', '=', 'm.menu_id')
            ->join('daily_menus as dm', 'dd.daily_id', '=', 'dm.id')
            ->where('dm.day_name', $dayName)
            ->where('dm.status', 'Active')
            ->get();    

        return view('inventorykitchen.resto.resto_form', compact('menus', 'dayName'), $Data);
    }
}
