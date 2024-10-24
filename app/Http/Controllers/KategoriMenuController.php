<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKategoriMenuRequest;
use App\Models\KategoriMenu;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriMenuController extends Controller
{
    public function index() {
        $Data = [
            'Title'=>"Kategori Barang"
        ];

        $kategori = KategoriMenu::all();
        return view('inventorykitchen.daftar_menu.kategori_menu', compact('kategori'), $Data);
    }

    
    public function create() {
        $kategori = KategoriMenu::all();
        return view('inventorykitchen.daftar_menu.tambah_kategori_menu', compact('kategori'));
    }

    public function storeKategori(StoreKategoriMenuRequest $request) {
        
        $data  = [
            'nama_kategori'=>$request->get('nama_kategori'),
        ];

        KategoriMenu::create($data);


        Alert::success('Success', 'Kategori Berhasil Ditambahkan');
        return redirect()->route('kategori.menu');
    }

    public function destroy($id)
    {
        $kategori = KategoriMenu::findOrFail($id);
       
    
        // Hapus data post
        $kategori->delete();
    
        Alert::success('Success', 'Kategori Berhasil Dihapus');
         return redirect()->route('kategori.menu');
    }

}
