<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Kehadiran;
use App\Models\LatePoint;
use App\Models\OverTime;
use App\Models\Payrolls;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TeamController extends Controller
{
    public function ot_action(Request $request){
        //call username active to get approved by
        $user = Auth::user();
        $ot_id = $request->input('ot_id');
        $status = $request->input('status');
        $reason = $request->input('reason') ?? null;
        $ot_data = OverTime::find($ot_id);        
        $ot_data->ot_approval = $status;
        $ot_data->ot_approvedBy = $user->username;
        $ot_data->ot_reason_reject = $reason;
        if($ot_data->save()){
            //response 200 and message success
            return response()->json(['status'=>"success", 'message'=>"OT Request berhasil proses"]);
        }else{
            //response dengan error code
            return response()->json(['status'=>"error", 'message'=>"OT Request gagal diproses"]);
        }
    }
    public function ot_request(Request $request) {
        $Divisions = Auth::user()->getActiveDivision();
        $divisionName = $Divisions->d_nama ?? false;
        $divisionID = $Divisions->id ?? false;
        $isApproval = Auth::user()->isUserApproval();
        $shift = $request->get('shift'); // Default to null
        $date = $request->get('date') ?? date('Y-m-d');
        if(!$isApproval){
            throw new AuthorizationException('You do not have permission to perform this action.');
        }
        //call data over_times 
        $OvertimeModel = new OverTime();

        $OTQuery = $OvertimeModel->callOvertimes($divisionID);
        return view('team_management.ot_request.ot_request', compact('Divisions', 'OTQuery'));
    }
    public function team_edit_shift(Request $request) {
        //validate terlebih dahulu tgl terakhir payroll.
        //jika lebih tinggi dari $request->input('date') return error
        $lastPayroll = Payrolls::latest('created_at')->first();
        $tgl_edit = $request->input('date');
        // Log::info("LastPayroll: ".$lastPayroll->created_at."Tgl:".$tgl_edit);
        if (!$lastPayroll || Carbon::parse($lastPayroll->created_at)->lessThan(Carbon::parse($tgl_edit))) {
            //get data kehadiran firts
            $Kehadirans = Kehadiran::join('karyawan_has_divisions', 'karyawan_has_divisions.id', '=', 'kehadirans.khd_id')
                                    ->where('karyawan_has_divisions.karyawan_id', $request->input('karyawan_id'))
                                    ->whereDate('kehadirans.kh_clock_in', $request->input('date'))
                                    ->select('kehadirans.id as kehadiran_id','karyawan_has_divisions.karyawan_id', 'kehadirans.kh_clock_in')
                                    ->first();
            $DataKehadiran = Kehadiran::find($Kehadirans->kehadiran_id);
            //call new shift data
            $new_shift = Shift::find($request->input('shift_id'));
            $DataKehadiran->shift_id = $new_shift->id;
            $DataKehadiran->s_nama = $new_shift->s_nama;
            $DataKehadiran->s_clock_in = $new_shift->s_clock_in;
            $DataKehadiran->s_clock_out = $new_shift->s_clock_out;
            try {
                $latePoint = LatePoint::where('karyawan_id', $Kehadirans['karyawan_id'])
                                        ->whereDate('date', $request->input('date'))
                                        ->first();
            if($latePoint){
                $latePoint->delete();
            }
            //call atendance controller for recalculate late point
            $AttendanceController = new AttendanceController();
            $isLate = $AttendanceController->recalculateLatePoint($Kehadirans['karyawan_id'], $new_shift->id, $Kehadirans['kh_clock_in']);
            if($isLate){
                $DataKehadiran->status = 'LATE';
            }else{
                $DataKehadiran->status = 'ONTIME';
            }
            $DataKehadiran->save();

            session()->flash('success', 'Shift Berhasil diganti');
            return response()->json(['status'=>"success", 'message'=>"Shift Berhasil diganti"]);
            } catch (\Exception $e) {
            return response()->json(['status'=>'error','message' => $e->getMessage()], 500);
            }
        } else {
            // Logic when $lastPayroll->created_at is greater than or equal to $tgl_edit
            return response()->json(['status'=>'error', 'message' => 'Presensi tidak dapat di rubah, Tanggal Presensi sudah masuk kedalam proses Payroll']);
        }
    }
    public function team_presentions(Request $request) {
        $Divisions = Auth::user()->getActiveDivision();
        $divisionName = $Divisions->d_nama ?? false;
        $divisionID = $Divisions->id ?? false;
        $isApproval = Auth::user()->isUserApproval();
        $shift = $request->get('shift'); // Default to null
        $date = $request->get('date') ?? date('Y-m-d');
        if(!$isApproval){
            throw new AuthorizationException('You do not have permission to perform this action.');
        }
        $Query = Karyawan::join('karyawan_has_divisions', 'karyawan_has_divisions.karyawan_id', '=', 'karyawan.id')
                                ->join('divisis', 'divisis.id', '=', 'karyawan_has_divisions.divisi_id')
                                ->join('karyawan_shifts', 'karyawan_shifts.karyawan_id', '=', 'karyawan.id')
                                ->join('shifts', 'shifts.id', '=', 'karyawan_shifts.shift_id')
                                ->leftJoin('kehadirans', function ($join) use ($date) {
                                    $join->on('karyawan_has_divisions.id', '=', 'kehadirans.khd_id')
                                        ->whereRaw('DATE(kehadirans.kh_clock_in) = ?', [$date]);
                                })
                                ->select(
                                    'karyawan.*',
                                    'divisis.*',
                                    'shifts.*',
                                    'kehadirans.s_clock_in',
                                    'kehadirans.s_clock_out',
                                    'kehadirans.kh_clock_in',
                                    'kehadirans.kh_clock_out',
                                    'kehadirans.status as kh_status',
                                    'divisis.id as divisi_id',
                                    'kehadirans.shift_id as shift_id',
                                    'shifts.id as real_shift_id',
                                    'karyawan.id as karyawan_id'
                                );
        if($shift!=null){
            $Query->where('kehadirans.shift_id', $shift);
        }
        $KaryawanData = $Query->get();
        $dataShift = Shift::where('id_divisi', $divisionID)->get();
        // echo json_encode($KaryawanData);
        return view('team_management.presensi.team_presensi', compact('divisionID', 'Divisions', 'KaryawanData', 'dataShift', 'date'));
    }
}
