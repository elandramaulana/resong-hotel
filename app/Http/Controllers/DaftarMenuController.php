<?php

namespace App\Http\Controllers;

use App\Models\DaftarMenu;
use App\Models\DailyMenu;
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

        $menus = Menu::all();
        $dailyMenu = DailyMenu::all();
        return view('inventorykitchen.daftar_menu.daftar_menu', compact('menus', 'dailyMenu'), $Data);
    }

    public function create() {
        $menus = Menu::all();
        $dailyMenu = DailyMenu::all();
        return view('inventorykitchen.daftar_menu.tambah_daftar_menu', compact('menus', 'dailyMenu'));
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
