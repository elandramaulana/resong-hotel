<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Gaji;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PayrollController extends Controller
{
    public function dataGaji() {
        $payrollData = Karyawan::select(
            'karyawan.id as id_karyawan',
            'karyawan.k_nama as karyawan_nama',
            'karyawan.k_gender as gender_karyawan',
            'divisis.d_nama as divisi_karyawan',
            'karyawan_has_divisions.khr_isActive as status_karyawan',
            'gaji.gaji_pokok as gaji_karyawan',
            'gaji.no_rek as rek_karyawan'
        )
        ->join('karyawan_has_divisions', 'karyawan.id', '=', 'karyawan_has_divisions.karyawan_id')
        ->join('divisis', 'karyawan_has_divisions.divisi_id', '=', 'divisis.id')
        ->leftJoin('karyawan_shifts', 'karyawan.id', '=', 'karyawan_shifts.karyawan_id')
        ->leftJoin('gaji', 'karyawan.id', '=', 'gaji.karyawan_id')
        ->orderBy('karyawan.id')
        ->get();
        
        return view('payroll.data_gaji', compact('payrollData'));
   
    }
    

    public function editgaji($id){

        $detailGaji = Karyawan::select(
            'karyawan.id as id_karyawan',
            'karyawan.k_nama as karyawan_nama',
            'karyawan.k_gender as gender_karyawan',
            'divisis.d_nama as divisi_karyawan',
            'karyawan_has_divisions.khr_isActive as status_karyawan',
            'gaji.gaji_pokok',
            'gaji.no_rek' 
        )
        ->join('karyawan_has_divisions', 'karyawan.id', '=', 'karyawan_has_divisions.karyawan_id')
        ->join('divisis', 'karyawan_has_divisions.divisi_id', '=', 'divisis.id')
        ->leftJoin('gaji', 'karyawan.id', '=', 'gaji.karyawan_id')
        ->where('karyawan.id', $id)
        ->first();
    
        if (!$detailGaji) {
            abort(404, 'Karyawan tidak ditemukan');
        }
        return view('payroll.edit_gaji', compact('detailGaji'));
    }

    public function updateGaji(Request $request, $id)
    {
        $request->validate([
            'karyawan_id' => 'required',
            'gaji_pokok' => 'required|numeric',
            'no_rek' => 'required|string',
        ]);
    
        $gaji = Gaji::where('karyawan_id', $request->karyawan_id)->first();
    
        if (!$gaji) {
            $gaji = new Gaji;
            $gaji->karyawan_id = $request->karyawan_id;
        }
    
        $gaji->gaji_pokok = $request->gaji_pokok;
        $gaji->no_rek = $request->no_rek;
    
        $gaji->save();
    
        Alert::success('success', 'Gaji berhasil di Update');
        return redirect()->route('data.gaji');
    }

//Proses Gaji
    public function prosesGaji() {
        $karyawan = Karyawan::all();

        return view('payroll.proses_gaji', compact('karyawan'));
    }


    public function detailProsesGaji(){
        return view('payroll.detail_proses');
    }

    public function billGaji(){

        $karyawan = Karyawan::all();

        return view('payroll.data_bill', compact('karyawan'));
        
    }
}
