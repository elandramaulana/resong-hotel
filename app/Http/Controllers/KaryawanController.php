<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\KaryawanHasDivision;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index(){
        $Data = [
            'Title'=>"Daftar Karyawan"
        ];

        $karyawan = Karyawan::all();
        $divisi = KaryawanHasDivision::all();
        return view('pegawai.data_karyawan', compact('karyawan', 'divisi'), $Data);
    }

    public function add(){
        $Data = [
            'Title'=>"Tambah Karyawan"
        ];

        $karyawan = Karyawan::all();
        return view('pegawai.tambah_karyawan', compact('karyawan'), $Data);
    }
}
