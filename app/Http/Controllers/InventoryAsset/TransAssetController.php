<?php

namespace App\Http\Controllers\InventoryAsset;

use App\Http\Controllers\Controller;
use App\Models\Assets;
use App\Models\SupplierAsset;
use Illuminate\Http\Request;

class TransAssetController extends Controller
{
    private function validasiTrans(Request $request, $rule)
    {
        return $request->validate([
            'trans_jenis' => 'required',
            'asset_id' => 'required',
            'trans_jml' => 'required',
            'trans_harga' => $rule,
            'supplier_asset_id' => $rule,
        ]);
    }

    public function index()
    {
        $Data = [
            'Title' => "Data Transaksi Asset"
        ];
        return view('inventoryAssets.transaksiAsset.index', compact('Data'));
    }

    public function createMasuk()
    {
        $assets = Assets::all();
        $suppliers = SupplierAsset::all();
        return view('inventoryAssets.transaksiAsset.masuk', compact('assets', 'suppliers'));
    }

    public function createKeluar()
    {
        $assets = Assets::all();
        return view('inventoryAssets.transaksiAsset.keluar', compact('assets'));
    }
}
