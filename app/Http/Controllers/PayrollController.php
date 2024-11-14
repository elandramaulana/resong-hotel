<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddKomponenRequest;
use App\Models\Divisi;
use App\Models\Gaji;
use App\Models\Karyawan;
use App\Models\KomponenGaji;
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
            'karyawan.k_norek as k_norek',
            'divisis.d_nama as divisi_karyawan',
            'karyawan_has_divisions.khr_isActive as status_karyawan',
        )
        ->join('karyawan_has_divisions', 'karyawan.id', '=', 'karyawan_has_divisions.karyawan_id')
        ->join('divisis', 'karyawan_has_divisions.divisi_id', '=', 'divisis.id')
        ->leftJoin('karyawan_shifts', 'karyawan.id', '=', 'karyawan_shifts.karyawan_id')
        ->orderBy('karyawan.id')
        ->get();
        for ($i=0; $i < count($payrollData); $i++) { 
            $payrollData[$i]->thp = $this->getTHP($payrollData[$i]->id_karyawan);
        }
        return view('payroll.data_gaji', compact('payrollData'));
   
    }
    
    public function deletekomponen(Request $request) {
        $komponen_id = $request->komponen_id;
        $KomponenData = KomponenGaji::find($komponen_id);
        $KomponenData->delete();
        return response()->json(['status'=>'success', 'message'=> 'Komponen berhasil dihapus']);
    }

    public function addkomponen(AddKomponenRequest $request) {
        //retrieve data from form submition
        $dataKomponen = [
            'karyawan_id' => $request->karyawan_id,
            'nama_komponen' => $request->nama_komponen,
            'besaran'=>$request->besaran,
            'tipe_komponen'=>$request->tipe_komponen,
            'deskripsi_komponen'=>$request->deskripsi_komponen,
        ];
        //insert into table komponen_gaji
        if(KomponenGaji::create($dataKomponen)){
            return response()->json(['status'=>'success', 'message'=> 'Komponen berhasil ditambahkan']);
        }else{
            return response()->json(['status'=>'error', 'message' => 'Komponen gagal ditambahkan']);
        }
    }

    public function editgaji($id){
        $detailGaji = Karyawan::select(
            'karyawan.id as id_karyawan',
            'karyawan.k_nama as karyawan_nama',
            'karyawan.k_gender as gender_karyawan',
            'divisis.d_nama as divisi_karyawan',
            'karyawan_has_divisions.khr_isActive as status_karyawan',
        )
        ->join('karyawan_has_divisions', 'karyawan.id', '=', 'karyawan_has_divisions.karyawan_id')
        ->join('divisis', 'karyawan_has_divisions.divisi_id', '=', 'divisis.id')
        ->where('karyawan.id', $id)
        ->first();
        $komponenGaji = $this->getKomponenGaji($id);
    
        if (!$detailGaji) {
            abort(404, 'Karyawan tidak ditemukan');
        }
        return view('payroll.edit_gaji', compact('detailGaji', 'komponenGaji'));
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
        $processData = Karyawan::select(
            'karyawan.id as id_karyawan',
            'karyawan.k_nama as karyawan_nama',
            'divisis.d_nama as divisi_karyawan',
            'karyawan_has_divisions.khr_isActive as status_karyawan',
            'gaji.gaji_pokok as gaji_karyawan',
            'gaji.no_rek as rek_karyawan'
        )
        ->join('karyawan_has_divisions', 'karyawan.id', '=', 'karyawan_has_divisions.karyawan_id')
        ->join('divisis', 'karyawan_has_divisions.divisi_id', '=', 'divisis.id')
        ->leftJoin('gaji', 'karyawan.id', '=', 'gaji.karyawan_id')
        ->orderBy('karyawan.id')
        ->get();

        // dd($processData);

        return view('payroll.proses_gaji', compact('processData'));
    }
    


    public function detailProsesGaji($id){
        $detailGaji = Karyawan::select(
            'karyawan.id as id_karyawan',
            'karyawan.k_nama as karyawan_nama',
            'karyawan.k_gender as gender_karyawan',
            'divisis.d_nama as divisi_karyawan',
            'karyawan_has_divisions.khr_isActive as status_karyawan',
        )
        ->join('karyawan_has_divisions', 'karyawan.id', '=', 'karyawan_has_divisions.karyawan_id')
        ->join('divisis', 'karyawan_has_divisions.divisi_id', '=', 'divisis.id')
        ->where('karyawan.id', $id)
        ->first();
        $komponenGaji = $this->getKomponenGaji($id);
        if (!$detailGaji) {
            abort(404, 'Karyawan tidak ditemukan');
        }
        // dd($detailData);
        return view('payroll.detail_proses', compact('detailGaji', 'komponenGaji'));
        
    }

    public function billGaji(){

        $karyawan = Karyawan::all();

        return view('payroll.data_bill', compact('karyawan'));
        
    }
    public function getKomponenGaji($karyawan_id){
        $dataKaryawan = Karyawan::find($karyawan_id);
        $penambahan = $this->komponenGajiByTipe($karyawan_id, 'pendapatan');
        $potongan = $this->komponenGajiByTipe($karyawan_id, 'potongan');
        $KomponenGaji = [
            'karyawan_id'=>$dataKaryawan->id,
            'k_nama'=>$dataKaryawan->k_nama,
            'pemasukan'=>$penambahan,
            'potongan'=>$potongan
        ];
        return $KomponenGaji;
    }
    function komponenGajiByTipe($karyawan_id,$tipe_komponen = null) {
        $komponenGaji = KomponenGaji::where('karyawan_id', $karyawan_id)
                                    ->where('tipe_komponen', $tipe_komponen)
                                    ->get();
        return $komponenGaji;
    }
    public function getTHP($karyawan_id){
        $takeHomePays = KomponenGaji::select('karyawan_id', DB::raw("
                                        SUM(CASE WHEN tipe_komponen = 'pendapatan' THEN besaran ELSE 0 END) -
                                        SUM(CASE WHEN tipe_komponen = 'potongan' THEN besaran ELSE 0 END) AS take_home_pay
                                    "))
                                    ->where('karyawan_id', $karyawan_id)
                                    ->groupBy('karyawan_id')
                                    ->get();
        return $takeHomePays['0']['take_home_pay'] ?? 0;
    }
    
}
