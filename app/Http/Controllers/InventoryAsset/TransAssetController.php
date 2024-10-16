<?php

namespace App\Http\Controllers\InventoryAsset;

use App\Http\Controllers\Controller;
use App\Models\Assets;
use App\Models\SupplierAsset;
use App\Models\TransAsset;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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

        $trans = TransAsset::with('rAssets', 'rSupplierAsset')->latest()->get();
        // dd($trans);
        return view('inventoryAssets.transaksiAsset.index', compact('Data', 'trans'));
    }

    public function createMasuk()
    {
        $assets = Assets::all();
        $suppliers = SupplierAsset::all();
        // dd($suppliers);
        return view('inventoryAssets.transaksiAsset.masuk', compact('assets', 'suppliers'));
    }

    public function createKeluar()
    {
        $assets = Assets::all();
        return view('inventoryAssets.transaksiAsset.keluar', compact('assets'));
    }

    public function storeMasuk(Request $request)
    {
        $this->validasiTrans($request, 'required');
        $data = [
            'trans_jenis' => $request->get('trans_jenis'),
            'asset_id' => $request->get('asset_id'),
            'trans_jml' => $request->get('trans_jml'),
            'trans_harga' => $request->get('trans_harga'),
            'supplier_asset_id' => $request->get('supplier_asset_id'),
        ];
        $storeMasuk = TransAsset::create($data);
        if ($storeMasuk) {
            Alert::success('Success', 'Transaksi Asset Masuk Berhasil Ditambahkan');
        } else {
            Alert::error('Error', 'Transaksi Asset Masuk Gagal Ditambahkan');
        }
        return redirect()->route('inventory-assets.trans.show');
    }

    public function storeKeluar(Request $request)
    {
        $this->validasiTrans($request, 'sometimes');
        $data = [
            'asset_id' => $request->get('asset_id'),
            'trans_jml' => $request->get('trans_jml'),
            // 'trans_harga' => $request->get('trans_harga'),
            'supplier_asset_id' => $request->get('supplier_asset_id') ?: null,
            'trans_jenis' => $request->get('trans_jenis')
        ];
        $storeKeluar = TransAsset::create($data);
        if ($storeKeluar) {
            Alert::success('Success', 'Transaksi Asset Keluar Berhasil Ditambahkan');
        } else {
            Alert::error('Error', 'Transaksi Asset Keluar Gagal Ditambahkan');
        }
        return redirect()->route('inventory-assets.trans.show');
    }

    public function edit($id)
    {
        $trans = TransAsset::findOrFail($id);
        $assets = Assets::all();
        $suppliers = SupplierAsset::all();
        return view('inventoryAssets.transaksiAsset.edit', compact('trans', 'assets', 'suppliers'));
    }

    public function updateMasuk(Request $request, $id)
    {
        $this->validasiTrans($request, 'required');
        $data = [
            'trans_jenis' => $request->get('trans_jenis'),
            'asset_id' => $request->get('asset_id'),
            'trans_jml' => $request->get('trans_jml'),
            'trans_harga' => $request->get('trans_harga'),
            'supplier_asset_id' => $request->get('supplier_asset_id'),
        ];
        $updateMasuk = TransAsset::findOrFail($id)->update($data);
        if ($updateMasuk) {
            Alert::success('Success', 'Transaksi Asset Masuk Berhasil Diupdate');
        } else {
            Alert::error('Error', 'Transaksi Asset Masuk Gagal Diupdate');
        }
        return redirect()->route('inventory-assets.trans.show');
    }

    public function updateKeluar(Request $request, $id)
    {
        $this->validasiTrans($request, 'sometimes');
        $data = [
            'asset_id' => $request->get('asset_id'),
            'trans_jml' => $request->get('trans_jml'),
            // 'trans_harga' => $request->get('trans_harga'),
            'supplier_asset_id' => $request->get('supplier_asset_id') ?: null,
            'trans_jenis' => $request->get('trans_jenis')
        ];
        $updateKeluar = TransAsset::findOrFail($id)->update($data);
        if ($updateKeluar) {
            Alert::success('Success', 'Transaksi Asset Keluar Berhasil Diupdate');
        } else {
            Alert::error('Error', 'Transaksi Asset Keluar Gagal Diupdate');
        }
        return redirect()->route('inventory-assets.trans.show');
    }

    public function destroy($id)
    {
        $trans = TransAsset::findOrFail($id);
        $trans->delete();
        Alert::success('Success', 'Transaksi Asset Berhasil Dihapus');
        return redirect()->route('inventory-assets.trans.show');
    }
}
