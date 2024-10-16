<?php

namespace App\Http\Controllers;

use App\Models\DaftarMenu;
use App\Models\DailyMenu;
use App\Models\DetailDaily;
use App\Models\KategoriMenu;
use App\Models\Menu;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;


class DaftarMenuController extends Controller
{
    public function index() {
        $Data = [
            'Title' => "Daftar Daily Menu"
        ];
    
        // Ambil semua kategori dari tabel kategori_menu
        $categories = KategoriMenu::all();
    
        // Ambil data dari DailyMenu dan urutkan berdasarkan id secara ascending
        $days = DailyMenu::orderBy('id', 'asc')->get();
        $menus = [];
    
        foreach ($days as $day) {
            $menuDetails = [];
    
            // Loop melalui setiap kategori secara dinamis
            foreach ($categories as $category) {
                $menuDetails[$category->nama_kategori] = $this->listDetail($day->id, $category->id);
            }
    
            $menus[] = [
                'id' => $day->id,
                'status' => $day->status,
                'day_name' => $day->day_name,
                'categories' => $menuDetails
            ];
        }
    
        $dailyMenu = DailyMenu::all();
        
        return view('inventorykitchen.daftar_menu.daftar_menu', compact('menus', 'dailyMenu', 'categories'), $Data);
    }
    
    
    


    public function manage($id) {
        $day = DailyMenu::find($id);
    
        // Ambil ID menu yang sudah ada di hari ini
        $Breakfast = $this->listDetail($day->id, 1)->pluck('menu_id')->toArray();
        $Lunch = $this->listDetail($day->id, 2)->pluck('menu_id')->toArray();
        $Dinner = $this->listDetail($day->id, 3)->pluck('menu_id')->toArray();
    
        $existingMenus = array_merge($Breakfast, $Lunch, $Dinner);
    
        // Ambil semua data dari tabel menu
        $allMenus = Menu::join('kategori_menu', 'kategori_menu.id', '=', 'menus.menu_category')
                        ->select('menus.*', 'kategori_menu.nama_kategori')
                        ->get();
    
        return view('inventorykitchen.daftar_menu.manage_daily', compact('allMenus', 'existingMenus', 'day'));
    }
    

    private function listDetail($daily_id, $kat_id){
        $Model = new DetailDaily();
        $show = $Model->listDetailDaily($daily_id,$kat_id);
            foreach ($show as $item) {
                $list_menu[] = [$item->menu_name];
            }
        return $show;
    }
    
    public function update(Request $request, $id) {
        // Debugging: Menampilkan semua data request
        // dd($request->all());
    
        // Find the DailyMenu record by its ID
        $day = DailyMenu::find($id);
    
        // Ensure the daily menu exists
        if (!$day) {
            return redirect()->route('daily.menu')->with('error', 'Daily menu not found');
        }
    
        // Hapus semua menu yang sudah ada
        DetailDaily::where('daily_id', $id)->delete();
    
    
        // Insert new records for each selected menu
        foreach ($request->input('menu_ids') as $menuId) {
            DetailDaily::create([
                'daily_id' => $id,
                'menu_id' => $menuId,
            ]);
        }
        
    
        return redirect()->route('daily.menu')->with('success', 'Menu updated successfully');
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
