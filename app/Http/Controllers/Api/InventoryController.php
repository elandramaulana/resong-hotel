<?php

namespace App\Http\Controllers\Api;

use App\Models\Assets;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Ambil semua asset beserta relasinya
            $assets = Assets::with('rCategoryAssets', 'rTransAssets')->latest()->get();

            // Array untuk menyimpan data dengan stok tersedia
            $data = [];

            // Menghitung stok untuk setiap asset dan menyimpannya dalam array
            foreach ($assets as $item) {
                // Menghitung stok masuk (jenis transaksi MASUK)
                $stockMasuk = $item->rTransAssets()
                    ->where('trans_jenis', 'MASUK')
                    ->sum('trans_jml');

                // Menghitung stok keluar atau rusak (jenis transaksi TERPAKAI, RUSAK, EXPIRED)
                $stockKeluar = $item->rTransAssets()
                    ->whereIn('trans_jenis', ['BAIK', 'RUSAK'])
                    ->sum('trans_jml');

                // Menghitung stok tersedia
                $stockAvailable = $stockMasuk - $stockKeluar;

                // Menambahkan data asset dengan stok tersedia ke dalam array
                $data[] = [
                    'id' => $item->id,
                    'nama' => $item->nama,
                    'satuan' => $item->satuan,
                    'nama_kategori' => $item->rCategoryAssets->nama_kategori,
                    'stok' => $stockAvailable
                ];
            }

            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'Success Get Data'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => []
            ]);
        }
    }
}
