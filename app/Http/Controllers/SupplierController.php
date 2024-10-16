<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Requests\StoreSupplierRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SupplierController extends Controller
{
    public function index() {
        $Data = [
            'Title'=>"List Supplier"
        ];

        $supplier = Supplier::all();
        return view('inventorykitchen.supplier.supplier_barang', compact('supplier'), $Data);
    }

    public function create() {
        $supplier = Supplier::all();
        return view('inventorykitchen.supplier.tambah_supplier', compact('supplier'));
    }

    public function storeSupplier(StoreSupplierRequest $request) {
        
        $idSupplier = 'S-' . uniqid();
        $data  = [
            'id_supplier'=>$idSupplier,
            'supplier_name'=>$request->get('supplier_name'),
            'supplier_telp'=>$request->get('supplier_telp'),
            'supplier_alamat'=>$request->get('supplier_alamat'),
        ];

         Supplier::create($data);
         Alert::success('Success', 'Supplier Berhasil Ditambahkan');
         return redirect()->route('list.supplier');
        //  return redirect('dashboard')->with('success', 'Supplier Berhasil Ditambah');
    }

    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view('inventorykitchen.supplier.edit_supplier', compact('supplier'));
    }
    public function update(Request $request, $id)
    {
        // Validasi data input, jika diperlukan
        $request->validate([
            'supplier_name' => 'required',
            'supplier_telp' => 'required',
            'supplier_alamat' => 'required',
        ]);

        // Ambil data supplier berdasarkan ID
        $supplier = Supplier::find($id);

        if(!$supplier){
            return redirect()->route('list.supplier')->with('error', 'Supplier tidak ditemukan');
        }

        $supplier->update([
            'supplier_name' => $request->input('supplier_name'),
            'supplier_telp' => $request->input('supplier_telp'),
            'supplier_alamat' => $request->input('supplier_alamat'),
        ]);

        Alert::success('Success', 'Supplier Berhasil Diperbarui');
        return redirect()->route('list.supplier');
    }

    
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
       
    
        // Hapus data post
        $supplier->delete();
    
        Alert::success('Success', 'Supplier Berhasil Dihapus');
         return redirect()->route('list.supplier');
    }
}
