<?php

namespace App\Http\Controllers\InventoryAsset;

use App\Http\Controllers\Controller;
use App\Models\CategoryAsset;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{
    private function validasiKategori(Request $request)
    {
        return $request->validate([
            'nama_kategori' => 'required',
        ]);
    }

    public function index()
    {
        $Data = [
            'Title' => "List Category Assets"
        ];

        $categories = CategoryAsset::latest()->get();

        return view('inventoryAssets.kategoriBarang.index', compact('Data', 'categories'));
    }

    public function create()
    {
        return view('inventoryAssets.kategoriBarang.create');
    }

    public function store(Request $request)
    {
        $this->validasiKategori($request);
        $store = [
            'nama_kategori' => $request->get('nama_kategori'),
        ];
        $category = CategoryAsset::create($store);
        if ($category) {
            Alert::success('Success', 'Kategori Berhasil Ditambahkan');
        } else {
            Alert::error('Error', 'Kategori Gagal Ditambahkan');
        }
        return redirect()->route('inventory-assets.kategori.show');
    }

    public function edit($id)
    {
        $category = CategoryAsset::find($id);
        return view('inventoryAssets.kategoriBarang.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->validasiKategori($request);
        $category = CategoryAsset::find($id);
        $update = [
            'nama_kategori' => $request->get('nama_kategori'),
        ];
        $category->update($update);
        if ($category) {
            Alert::success('Success', 'Kategori Berhasil Diperbarui');
        } else {
            Alert::error('Error', 'Kategori Gagal Diperbarui');
        }
        return redirect()->route('inventory-assets.kategori.show');
    }

    public function destroy($id)
    {
        $category = CategoryAsset::findOrFail($id);
        $category->delete();
        Alert::success('Success', 'Kategori Berhasil Dihapus');
        return redirect()->route('inventory-assets.kategori.show');
    }
}
