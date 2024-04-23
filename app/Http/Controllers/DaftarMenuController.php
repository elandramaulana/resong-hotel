<?php

namespace App\Http\Controllers;

use App\Models\DaftarMenu;
use App\Models\DailyMenu;
use App\Models\DetailDaily;
use App\Models\Menu;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;


class DaftarMenuController extends Controller
{
    public function index() {
        $Data = [
            'Title'=>"Daftar Daily Menu"
        ];

        $days = DailyMenu::all();
        foreach ($days as $day) {
            $Breakfast = $this->listDetail($day->id, 1);
            $Lunch = $this->listDetail($day->id, 2);
            $Dinner = $this->listDetail($day->id, 3);
            $menus[] = [
                'id'=>$day->id,
                'status'=>$day->status,
                'day_name'=>$day->day_name,
                'Breakfast'=>$Breakfast,
                'Lunch'=>$Lunch,
                'Dinner'=>$Dinner,
            ];
        }
        $dailyMenu = DailyMenu::all();
        return view('inventorykitchen.daftar_menu.daftar_menu', compact('menus', 'dailyMenu'), $Data);
    }

    public function create() {
        $menus = Menu::all();
        $dailyMenu = DailyMenu::all();
        return view('inventorykitchen.daftar_menu.tambah_daftar_menu', compact('menus', 'dailyMenu'));
    }
    private function listDetail($daily_id, $kat_id){
        $Model = new DetailDaily();
        $show = $Model->listDetailDaily($daily_id,$kat_id);
            foreach ($show as $item) {
                $list_menu[] = [$item->menu_name];
            }
        return $show;
    }
    public function storeMenuDaily (Request $request)
    {

       // Validasi request
       $request->validate([
            'day_name' => 'required',
            'status' => 'required|in:Active,Non-Active',
            'menu_ids' => 'required|array',
            'menu_ids.*' => 'exists:menus,menu_id',
        ]);

        // Simpan data ke dalam tabel daily_menus
        $dailyMenu = DailyMenu::create([
            'day_name' => $request->input('day_name'),
            'status' => $request->input('status'),
        ]);

        // Simpan menu_ids ke dalam tabel daily_detail dengan daily_id yang baru dibuat
        $dailyMenu->menus()->attach($request->input('menu_ids'));

        $dailyMenu->menus()->updateExistingPivot($request->input('menu_ids'), [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Alert::success('Success', 'Daftar Menu Hari Ini Berhasil Ditambahkan');
         return redirect()->route('daily.menu');
    }
}
