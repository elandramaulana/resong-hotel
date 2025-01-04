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

    public function edit($id) {
        // Temukan kategori berdasarkan ID
        $kategori = CategoryBarang::findOrFail($id);
        
        // Tampilkan halaman edit dengan membawa data kategori
        return view('inventorykitchen.kategori_barang.edit_kategori_barang', compact('kategori'));
    }

    public function update(Request $request, $id) {
        // Validasi input (bisa menggunakan FormRequest atau langsung di controller)
        $request->validate([
            'nama_kategori' => 'required',  // Pastikan nama kategori diisi
        ]);

        // Temukan kategori berdasarkan ID
        $kategori = CategoryBarang::findOrFail($id);

        // Update data kategori dengan data baru
        $kategori->update([
            'nama_kategori' => $request->get('nama_kategori'),
        ]);

        Alert::success('Success', 'Kategori Berhasil Diperbarui');
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
