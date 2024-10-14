<?php

namespace App\Http\Controllers\InventoryAsset;

use App\Http\Controllers\Controller;
use App\Models\Assets;
use App\Models\CategoryAsset;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AssetController extends Controller
{
    private function validasiAsset(Request $request)
    {
        return $request->validate([
            'nama' => 'required',
            'category_asset_id' => 'required',
            'satuan' => 'required',
        ]);
    }

    public function index()
    {
        $Data = [
            'Title' => "Data Asset"
        ];
        $assets = Assets::with('rCategoryAssets')->latest()->get();
        return view('inventoryAssets.asset.index', compact('Data', 'assets'));
    }

    public function create()
    {
        $categories = CategoryAsset::all();
        return view('inventoryAssets.asset.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validasiAsset($request);
        $store = [
            'nama' => $request->get('nama'),
            'category_asset_id' => $request->get('category_asset_id'),
            'satuan' => $request->get('satuan'),
        ];
        $asset = Assets::create($store);
        if ($asset) {
            Alert::success('Success', 'Asset Berhasil Ditambahkan');
        } else {
            Alert::error('Error', 'Asset Gagal Ditambahkan');
        }
        return redirect()->route('inventory-assets.asset.show');
    }

    public function edit($id)
    {
        $asset = Assets::find($id);
        $categories = CategoryAsset::all();
        return view('inventoryAssets.asset.edit', compact('asset', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validasiAsset($request);
        $update = [
            'nama' => $request->get('nama'),
            'category_asset_id' => $request->get('category_asset_id'),
            'satuan' => $request->get('satuan'),
        ];
        $asset = Assets::find($id)->update($update);
        if ($asset) {
            Alert::success('Success', 'Asset Berhasil Diubah');
        } else {
            Alert::error('Error', 'Asset Gagal Diubah');
        }
        return redirect()->route('inventory-assets.asset.show');
    }

    public function destroy($id)
    {
        $asset = Assets::findOrFail($id);
        $asset->delete();
        Alert::success('Success', 'Asset Berhasil Dihapus');
        return redirect()->route('inventory-assets.asset.show');
    }
}
