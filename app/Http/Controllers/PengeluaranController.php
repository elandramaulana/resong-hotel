<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengeluaranRequest;
use App\Models\OtherTransactions;
use App\Models\TransaksiReport;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index()
    {
        $data = OtherTransactions::all();
        return view('pengeluaran.index', compact('data'));
    }
    public function create()
    {
        // return view('pengeluaran.index');
    }
    public function store(StorePengeluaranRequest $request)
    {
        $save = OtherTransactions::create(
            [
                'item' => $request->item,
                'qty' => $request->jumlah,
                'harga' => $request->harga,
                'tgl' => $request->tanggal,
                'keterangan' => $request->keterangan,
            ]
        );
        if($save){
            //insert into transaction_reports
            TransaksiReport::create(
                [
                    'tabel_referensi' => 'other_transactions',
                    'id_referensi' => $save->id,
                    'type_transaksi' => 'debit',
                    'jenis_transaksi' => 'Pengeluaran Lain-lain',
                    'besar_transaksi' => $save->harga * $save->qty,
                    'keterangan_transaksi' => $save->keterangan,
                    'jenis_pembayaran' => 'cash'
                ]
                );
            return redirect()->route('pengeluaran.show')->with('success', 'Pengeluaran Berhasil Ditambahkan');
        }else{
            return redirect()->route('pengeluaran.show')->with('error', 'Pengeluaran Gagal Ditambahkan');
        }
    }
    public function edit($id_pengeluaran)
    {
        $data = OtherTransactions::find($id_pengeluaran);
        return response()->json($data);
    }
    public function update(StorePengeluaranRequest $request)
    {
        $update = OtherTransactions::find($request->id)->update(
            [
                'item' => $request->item,
                'qty' => $request->jumlah,
                'harga' => $request->harga,
                'tgl' => $request->tanggal,
                'keterangan' => $request->keterangan,
            ]
        );
        if($update){
            return redirect()->route('pengeluaran.show')->with('success', 'Pengeluaran Berhasil Diubah');
        }else{
            return redirect()->route('pengeluaran.show')->with('error', 'Pengeluaran Gagal Diubah');
        }
    }
    public function destroy(Request $request)
    {
        $destroy = OtherTransactions::find($request->id)->delete();
        if($destroy){
            TransaksiReport::where('id_referensi', $request->id)
                            ->where('tabel_referensi', 'other_transactions')
                            ->delete();
            return response()->json(['success' => 'Pengeluaran Berhasil Dihapus']);
        }else{
            return response()->json(['error' => 'Pengeluaran Gagal Dihapus']);
        }
    }


}
