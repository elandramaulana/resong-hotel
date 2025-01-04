<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKategoriBarangRequest;
use App\Models\CategoryBarang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriBarangController extends Controller
{
    public function index() {
        $Data = [
            'Title'=>"Kategori Barang"
        ];

        $kategori = CategoryBarang::all();
        return view('inventorykitchen.kategori_barang.kategori', compact('kategori'), $Data);
    }

    public function create() {
        $kategori = CategoryBarang::all();
        return view('inventorykitchen.kategori_barang.tambah_kategori', compact('kategori'));
    }

    public function storeCategori(StoreKategoriBarangRequest $request) {
        
        $data  = [
            'nama_kategori'=>$request->get('nama_kategori'),
        ];

        CategoryBarang::create($data);


        Alert::success('Success', 'Kategori Berhasil Ditambahkan');
        return redirect()->route('list.kategori');
    }

    public function destroy($id)
    {
        $barang = CategoryBarang::findOrFail($id);
       
    
        // Hapus data post
        $barang->delete();
    
        Alert::success('Success', 'Kategori Berhasil Dihapus');
         return redirect()->route('list.kategori');
    }
}
