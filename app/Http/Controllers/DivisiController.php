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
}
