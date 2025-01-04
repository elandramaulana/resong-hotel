<?php

namespace App\Http\Controllers\InventoryAsset;

use App\Http\Controllers\Controller;
use App\Models\SupplierAsset;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SupplierController extends Controller
{
    private function validasiSupplier(Request $request)
    {
        return $request->validate([
            'supplier_name' => 'required',
            'supplier_telp' => 'required',
            'supplier_alamat' => 'required',
        ]);
    }

    public function index()
    {
        $Data = [
            'Title' => "List Supplier Assets"
        ];

        $supplier = SupplierAsset::latest()->get();

        return view('inventoryAssets.supplier.index', compact('Data', 'supplier'));
    }

    public function create()
    {
        return view('inventoryAssets.supplier.create');
    }

    public function store(Request $request)
    {
        $this->validasiSupplier($request);
        $idSupplier = 'SA-' . uniqid();
        $store = [
            'id_supplier' => $idSupplier,
            'supplier_name' => $request->get('supplier_name'),
            'supplier_telp' => $request->get('supplier_telp'),
            'supplier_alamat' => $request->get('supplier_alamat'),
        ];
        $supplier = SupplierAsset::create($store);
        if ($supplier) {
            Alert::success('Success', 'Supplier Berhasil Ditambahkan');
        } else {
            Alert::error('Error', 'Supplier Gagal Ditambahkan');
        }
        return redirect()->route('inventory-assets.supplier.show');
    }

    public function edit($id)
    {
        $supplier = SupplierAsset::find($id);
        return view('inventoryAssets.supplier.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $this->validasiSupplier($request);
        $supplier = SupplierAsset::find($id);
        $update = [
            'supplier_name' => $request->get('supplier_name'),
            'supplier_telp' => $request->get('supplier_telp'),
            'supplier_alamat' => $request->get('supplier_alamat'),
        ];
        $supplier->update($update);
        if ($supplier) {
            Alert::success('Success', 'Supplier Berhasil Diperbarui');
        } else {
            Alert::error('Error', 'Supplier Gagal Diperbarui');
        }
        return redirect()->route('inventory-assets.supplier.show');
    }

    public function destroy($id)
    {
        $supplier = SupplierAsset::findOrFail($id);
        $supplier->delete();
        Alert::success('Success', 'Supplier Berhasil Dihapus');
        return redirect()->route('inventory-assets.supplier.show');
    }
}
