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

        // $menus = Menu::join('kategori_menu', 'kategori_menu.id', '=', 'menus.menu_category')->get();
        $menus = Menu::leftJoin('kategori_menu', 'kategori_menu.id', '=', 'menus.menu_category')
                 ->select('menus.*', 'kategori_menu.nama_kategori') // Ambil nama_kategori dari tabel kategori_menu
                 ->get();
        $kategori = KategoriMenu::all();
        // dd($menus);
        return view('inventorykitchen.manage_menu.manage_menu', compact('menus', 'kategori'), $Data);
    }

    public function create() {
        $menus = Menu::all();
        $kategori = KategoriMenu::all();
        // dd($kategori);
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

    public function edit($id){

        $menu = Menu::findOrFail($id);
        $kategori = KategoriMenu::all();

        return view('inventorykitchen.manage_menu.edit_menu', compact('menu', 'kategori') );
    }

    public function update(Request $request, $id){
        $request->validate([
            'menu_name' => 'required',
            'menu_category' => 'required',
            'menu_price' => 'required',
            'menu_photo'=> 'required',
        ]);

        $menu = Menu::findOrFail($id);
        $imagePath = $request->file('menu_photo')->store('menus');

        $menu->menu_name = $request->menu_name;
        $menu->menu_category = $request->menu_category;
        $menu->menu_price = $request->menu_price;
        $menu->menu_photo = $imagePath;
        $menu->save();

        Alert::success('success', 'Menu berhasil di Update');
      return redirect()->route('list.menu');
    }


}
