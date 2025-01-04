<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDivisiRequest;
use App\Models\Divisi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DivisiController extends Controller
{
    public function index(){
        $Data = [
            'Title'=>"Daftar Divisi"
        ];

        $divisi = Divisi::all();
        return view('pegawai.data_divisi', compact('divisi'), $Data);
    }

    public function add(){
        $Data = [
            'Title'=>"Tambah Divisi"
        ];

        $divisi = Divisi::all();
        return view('pegawai.tambah_divisi', compact('divisi'), $Data);
    }

    public function store(StoreDivisiRequest $request)
    {
       
    //     $data = [
    //         'd_nama'=> $request->get('d_nama'),
    //         'd_deskripsi'=> $request->get('d_deskripsi'),
    //         'd_jobdesc'=> $request->get('d_jobdesc'),
    //         'd_OT_approver' => $request->get('d_OT_approver'),
    //   ];

      $data = $request -> only(['d_nama', 'd_deskripsi', 'd_jobdesc', 'd_OT_approver' ]);

      Divisi::create($data);

      Alert::success('success', 'Divisi berhasil ditambahkan');
      return redirect()->route('daftar.divisi');
    }

    public function edit($id){
        $Data = [
            'Title'=>"Edit Divisi"
        ];
        $divisi = Divisi::findOrFail($id);
     
        return view('pegawai.edit_divisi', compact('divisi'), $Data);
    }

    public function update(Request $request, $id){
       
        $request->validate([
            'd_nama' => 'required|string|max:255',
            'd_deskripsi' => 'required|string|max:255',
            'd_jobdesc' => 'required|string|max:255',
            'd_OT_approver' => 'required',
        ]);

        $divisi = Divisi::findOrFail($id);

        $divisi->d_nama = $request->d_nama;
        $divisi->d_deskripsi = $request->d_deskripsi;
        $divisi->d_jobdesc = $request->d_jobdesc;
        $divisi->d_OT_approver = $request->d_OT_approver;

        $divisi->save();

        Alert::success('success', 'Divisi berhasil di Update');
      return redirect()->route('daftar.divisi');
    }

    public function destroy($id)
    {
        $divisi = Divisi::findOrFail($id);
       
    
        // Hapus data post
        $divisi->delete();
    
        Alert::success('Success', 'Divisi Berhasil Dihapus');
         return redirect()->route('daftar.divisi');
    }
}
