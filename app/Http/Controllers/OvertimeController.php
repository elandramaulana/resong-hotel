<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\OverTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class OvertimeController extends Controller
{
    public function index(){
        // Query untuk mengambil data overtime beserta detail karyawan dan divisi
    $overtimeData = DB::table('over_times')
    ->join('karyawan_has_divisions', 'over_times.khd_id', '=', 'karyawan_has_divisions.id')
    ->join('karyawan', 'karyawan_has_divisions.karyawan_id', '=', 'karyawan.id')
    ->join('divisis', 'karyawan_has_divisions.divisi_id', '=', 'divisis.id')
    ->select(
        'over_times.id as overtime_id',
        'karyawan.id as karyawan_id',
        'karyawan.k_nama as nama_karyawan',
        'divisis.d_nama as nama_divisi',
        'over_times.ot_date',
        'over_times.ot_start',
        'over_times.ot_end',
        'over_times.ot_approval',
        'over_times.ot_approvedBy'
    )
    ->get();

        return view('payroll.overtime', compact('overtimeData'));
    }
    public function add(){

        $karyawanList = Karyawan::all();

        return view('payroll.add_overtime',compact('karyawanList'));
    }
    public function store(Request $request){

        $request->validate([
            'khd_id' => 'required',
            'ot_date' => 'required',
            'ot_start' => 'required',
            'ot_end' => 'required',
        ]);

        $data = [
            'khd_id' => $request->get('khd_id'),
            'ot_date' => $request->get('ot_date'),
            'ot_start' => $request->get('ot_start'),
            'ot_end' => $request->get('ot_end'),
            'ot_approval' => 'NO',
            'ot_approvedBy' => 'null',
        ];

        OverTime::create($data);
        Alert::success('Success', 'Overtime Berhasil Diajukan');
        return redirect()->route('overtime');
    }
    public function edit(){

    }
    public function update(){

    }

    public function getKaryawanData(Request $request)
    {
        $karyawanId = $request->karyawan_id;

        // Ambil data karyawan berdasarkan id
        $karyawan = Karyawan::with(['karyawanHasDivisions.divisi', 'karyawanShifts.shift'])
            ->where('id', $karyawanId)
            ->first();

        if ($karyawan) {
            return response()->json([
                'divisi' => $karyawan->karyawanDivisions->divisi->d_nama,
                'shift' => $karyawan->karyawanShifts->shift->s_nama,
                'khd_id' => $karyawan->karyawanDivisions->id
            ]);
        }

        return response()->json(['error' => 'Data tidak ditemukan'], 404);
    }

}
