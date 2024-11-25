<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\OverTime;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $userId = Auth::id();

        // Ambil informasi user
        $userInfo = User::where('id', $userId)->first();
    
        $karyawanData = Karyawan::join('karyawan_has_divisions', 'karyawan.id', '=', 'karyawan_has_divisions.karyawan_id')
        ->join('divisis', 'karyawan_has_divisions.divisi_id', '=', 'divisis.id')
        ->join('karyawan_shifts', 'karyawan.id', '=', 'karyawan_shifts.karyawan_id')
        ->join('shifts', 'karyawan_shifts.shift_id', '=', 'shifts.id')
        ->where('karyawan_has_divisions.user_id', $userId)
        ->select(
            'karyawan.*',
            'karyawan_has_divisions.khr_tgljoin',
            'karyawan_has_divisions.khr_tglOut',
            'karyawan_has_divisions.id as khd_id',
            'divisis.d_nama as divisi_nama',
            'shifts.s_nama as shift_nama'
    )
        ->get();
        return view('payroll.add_overtime',compact('karyawanData'));
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
        return redirect()->route('dashboard');
    }
    public function edit(){

    }
    public function update(){

    }

    
}
