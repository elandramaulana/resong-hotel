<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShiftRequest;
use App\Models\Divisi;
use App\Models\Shift;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ShiftController extends Controller
{
    public function index()
    {
        $Data = [
            'Title' => "Daftar shift"
        ];

        $shifts = Shift::all();
        $divisis = Divisi::all();
        return view('pegawai.data_shift', compact('shifts', 'divisis'), $Data);
    }

    public function add()
    {
        $Data = [
            'Title' => "Tambah shift"
        ];

        $shifts = Shift::all();
        $divisis = Divisi::all();
        return view('pegawai.tambah_shift', compact('shifts', 'divisis'), $Data);
    }

    public function store(StoreShiftRequest $request)
    {

        //     $data = [
        //         'd_nama'=> $request->get('d_nama'),
        //         'd_deskripsi'=> $request->get('d_deskripsi'),
        //         'd_jobdesc'=> $request->get('d_jobdesc'),
        //         'd_OT_approver' => $request->get('d_OT_approver'),
        //   ];

        $data = $request->only(['id_divisi', 's_nama', 's_clock_in', 's_clock_out']);

        Shift::create($data);

        Alert::success('success', 'Shift berhasil ditambahkan');
        return redirect()->route('daftar.shift');
    }

    public function edit($id)
    {
        $shift = Shift::findOrFail($id);
        $divisis = Divisi::all();

        return view('pegawai.edit_shift', compact('shift', 'divisis'));
    }

    public function update(Request $request, $id)
    {


        $request->validate([
            's_nama' => 'required',
            'id_divisi' => 'required',
            's_clock_in' => 'required',
            's_clock_out' => 'required',
        ]);

        $shift = Shift::findOrFail($id);

        $shift->s_nama = $request->s_nama;
        $shift->id_divisi = $request->id_divisi;
        $shift->s_clock_in = $request->s_clock_in;
        $shift->s_clock_out = $request->s_clock_out;

        $shift->save();


        Alert::success('success', 'Shift berhasil diperbarui');
        return redirect()->route('daftar.shift');
    }
}
