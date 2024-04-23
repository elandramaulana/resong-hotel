<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBarangRequest;
use App\Models\Barang;
use App\Models\CategoryBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class BarangController extends Controller
{
    public function index() {
        $Data = [
            'Title'=>"Data Barang"
        ];

        $stokBarang = DB::table('barang')
            ->select(
                'barang.id as barang_id',
                'barang.barang_nama',
                'barang.barang_kategori',
                'barang.barang_satuan',
                DB::raw('SUM(CASE WHEN trans_barang.trans_jenis = "MASUK" THEN trans_barang.trans_jml ELSE 0 END) AS stock_masuk'),
                DB::raw('SUM(CASE WHEN trans_barang.trans_jenis = "TERPAKAI" THEN trans_barang.trans_jml ELSE 0 END) AS stock_keluar'),
                DB::raw('SUM(CASE WHEN trans_barang.trans_jenis = "RUSAK" THEN trans_barang.trans_jml ELSE 0 END) AS stock_rusak'),
                DB::raw('SUM(CASE WHEN trans_barang.trans_jenis = "EXPIRED" THEN trans_barang.trans_jml ELSE 0 END) AS stock_expired')
            )
            ->leftJoin('trans_barang', 'barang.id', '=', 'trans_barang.barang_id')
            ->groupBy('barang.id', 'barang.barang_nama', 'barang.barang_kategori', 'barang.barang_satuan')
            ->get();

        $barang = Barang::all();
        $kategori = CategoryBarang::all();
        return view('inventorykitchen.barang.data_barang', compact('barang','stokBarang','kategori'), $Data);
    }

    public function create() {
        $barang = Barang::all();
        $kategori = CategoryBarang::all();
        return view('inventorykitchen.barang.tambah_barang', compact('barang', 'kategori'));
    }

    public function storeBarang(StoreBarangRequest $request) {
        

        // $idBarang = 'BRG-' . str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);
        $data  = [
            'barang_nama'=>$request->get('barang_nama'),
            'barang_kategori'=>$request->get('barang_kategori'),
            'barang_satuan'=>$request->get('barang_satuan'),
        ];


         Barang::create($data);

         Alert::success('Success', 'Barang Berhasil Ditambahkan');
         return redirect()->route('list.barang');
    }


    
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
       
    
        // Hapus data post
        $barang->delete();
    
        Alert::success('Success', 'Barang Berhasil Dihapus');
         return redirect()->route('list.barang');
    }
}
