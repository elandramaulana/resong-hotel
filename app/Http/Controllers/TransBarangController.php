<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransBarangRequest;
use App\Models\Barang;
use App\Models\Supplier;
use App\Models\TransBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class TransBarangController extends Controller
{
    public function index() {
        $Data = [
            'Title'=>"Data Transaksi Barang"
        ];

        $transMasuk = Barang::join('trans_barang', 'trans_barang.barang_id', '=', 'barang.id')
            ->select('barang.*', 'trans_barang.*', 'trans_barang.created_at as tgl_masuk')
            ->get();

        $supplier = Supplier::all();
        $trans = TransBarang::all();
        return view('inventorykitchen.trans_barang.list_trans', compact('transMasuk','trans', 'supplier'), $Data);
    }

    public function createMasuk() {
        $barang = Barang::all();
        $supplier = Supplier::all();
        $trans = TransBarang::all();
        return view('inventorykitchen.trans_barang.tambah_trans', compact('barang', 'trans', 'supplier'));
    }
    public function createKurang() {
        $barang = Barang::all();
        $supplier = Supplier::all();
        $trans = TransBarang::all();
        return view('inventorykitchen.trans_barang.kurang_trans', compact('barang', 'trans', 'supplier'));
    }

    public function stroreTrans(StoreTransBarangRequest $request) {
        
        // $idTransaksi = 'BRG-' . uniqid();

        $data  = [
            'barang_id'=>$request->get('barang_id'),
            'trans_jml'=>$request->get('trans_jml'),
            'trans_harga'=>$request->get('trans_harga'),
            'trans_suplier'=>$request->get('trans_suplier'),
            'trans_jenis'=>$request->get('trans_jenis'),
        ];

         TransBarang::create($data);
        
         Alert::success('success', 'Transaksi Barang berhasil ditambahkan');
         return redirect()->route('list.trans');

    }

    public function destroy($id)
    {
        $transBarang = TransBarang::findOrFail($id);
       
    
        // Hapus data post
        $transBarang->delete();
    
        Alert::success('success', 'Transaksi Barang berhasil dihapus');
         return redirect()->route('list.trans');
    }
}
