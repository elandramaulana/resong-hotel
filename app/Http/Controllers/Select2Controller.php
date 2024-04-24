<?php

namespace App\Http\Controllers;

use App\Models\Checkin;
use App\Models\DailyMenu;
use App\Models\KategoriMenu;
use App\Models\LaundryCat;
use App\Models\Menu;
use Illuminate\Http\Request;

class Select2Controller extends Controller
{
    public function menu_category() {
        $query = KategoriMenu::all();
        foreach($query as $data){
            
            $show[] = [
                'id'=>$data['id'],
                'text'=>$data['nama_kategori']
            ];
        }
        echo json_encode($show);
    }
    public function detail_menu(Request $request) {
        $menu_id = $request->menu_id;
        $MenuData = Menu::find($menu_id);
        echo json_encode($MenuData);
    }
    public function menu_active(Request $request) {
        //query room checkin id = checkin_id value = room_no
        $day_id = $request->day_id;
        $cat_id = $request->cat_id;
        $query = DailyMenu::join('detail_daily', 'detail_daily.daily_id', '=', 'daily_menus.id')
                            ->join('menus', 'menus.menu_id', '=', 'detail_daily.menu_id')
                            ->where('daily_menus.day_name', $day_id)
                            ->where('menus.menu_category', $cat_id)
                            ->select('detail_daily.*', 'menus.*','daily_menus.*', 'menus.menu_id as menu_id')
                            ->get();
          
        foreach($query as $data){
            $show_price = formatCurrency($data['menu_price']);
            $show[] = [
                'id'=>$data['menu_id'],
                'text'=>$data['menu_name'].' ('.$show_price.')'
            ];
        }
        echo json_encode($show);
    }
    public function room_inhouse()  {
        //query room checkin id = checkin_id value = room_no
        $query = Checkin::leftJoin('checkouts', 'checkouts.checkin_id', '=', 'checkins.id')
                            ->join('rooms', 'rooms.id', '=', 'checkins.room_id')
                            ->join('guests', 'guests.id', '=', 'checkins.guest_id')
                            ->where('checkouts.id', null)
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
