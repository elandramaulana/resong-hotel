<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KehadiranController extends Controller
{
    public function index(){

        $Data = [
            'Title'=>"Daftar Kehadiran"
        ];

        $shifts = Shift::all();
        $divisis = Divisi::all();
        return view('pegawai.absensi', compact('shifts', 'divisis'), $Data);
    }

    public function filterAbsensi(Request $request)
    {
        $query = DB::table('absensis')
            ->join('shifts', 'absensis.id_shift', '=', 'shifts.id')
            ->join('divisis', 'shifts.id_divisi', '=', 'divisis.id')
            ->select('absensis.*', 'shifts.s_nama as shift_nama', 'divisis.d_nama as divisi_nama');

        if ($request->has('id_divisi') && $request->id_divisi != '') {
            $query->where('shifts.id_divisi', $request->id_divisi);
        }

        if ($request->has('id_shift') && $request->id_shift != '') {
            $query->where('absensis.id_shift', $request->id_shift);
        }

        if ($request->has('tanggal_cleaning') && $request->tanggal_cleaning != '') {
            $query->whereDate('absensis.tanggal_cleaning', $request->tanggal_cleaning);
        }

        $absensi = $query->get();

        return response()->json(['absensi' => $absensi]);
    }

    public function getShiftsByDivisi($id)
    {
        $shifts = Shift::where('id_divisi', $id)->get();
        return response()->json(['shifts' => $shifts]);
    }

    
}
