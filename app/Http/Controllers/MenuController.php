<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMenuRequest;
use App\Models\Barang;
use App\Models\KategoriMenu;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class MenuController extends Controller
{
    public function index() {
        $Data = [
            'Title'=>"Daftar Menu"
        ];

        $menus = Menu::all();
        $barang = Barang::all();
        return view('inventorykitchen.manage_menu.manage_menu', compact('menus', 'barang'), $Data);
    }

    public function create() {
        $menus = Menu::all();
        $kategori = KategoriMenu::all();
        return view('inventorykitchen.manage_menu.tambah_menu', compact('menus', 'kategori'));
    }

    public function storeMenu(StoreMenuRequest $request)
    {
        $imagePath = $request->file('menu_photo')->store('menus');
        $data = [
            'menu_name'=> $request->get('menu_name'),
            'menu_category'=> $request->get('menu_category'),
            'menu_price'=> $request->get('menu_price'),
            'menu_photo' => $imagePath,
      ];

      Menu::create($data);

      Alert::success('success', 'Menu berhasil ditambahkan');
      return redirect()->route('list.menu');
    }


}
