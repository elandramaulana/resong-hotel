<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateLatePointRequest;
use App\Models\Divisi;
use App\Models\Karyawan;
use App\Models\LatePointSetting;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelIgnition\Http\Requests\UpdateConfigRequest;

class KehadiranController extends Controller
{
    public function index()
    {
        $divisis = Divisi::all();
        $shifts = Shift::all();
        $latePointSetting = LatePointSetting::first();
        return view('pegawai.absensi', compact('divisis', 'shifts', 'latePointSetting'));
    }

    public function postUpdateLatePoint(UpdateLatePointRequest $request)
    {
        $getSettings = LatePointSetting::first();
        if ($getSettings) {
            $getSettings->extrabed_price = $request->extrabed_price;
            $getSettings->pajak_checkin = $request->pajak_checkin;
            $getSettings->first_late = $request->first_late;
            $getSettings->first_latepoint = $request->first_latepoint;
            $getSettings->second_late = $request->second_late;
            $getSettings->second_latepoint = $request->second_latepoint;
            $getSettings->third_late = $request->third_late;
            $getSettings->third_latepoint = $request->third_latepoint;
            $getSettings->besar_potongan = $request->besar_potongan;
            $getSettings->besar_point = $request->besar_point;
            $getSettings->payroll_period = $request->payroll_period;
            $getSettings->ot_price = $request->ot_price;
            $SaveSetting = $getSettings->save();
        } else {
            $dataSettings  = [
                'extrabed_price' => $request->extrabed_price,
                'pajak_checkin' => $request->pajak_checkin,
                'first_late' => $request->first_late,
                'first_latepoint' => $request->first_latepoint,
                'second_late' => $request->second_late,
                'second_latepoint' => $request->second_latepoint,
                'third_late' => $request->third_late,
                'third_latepoint' => $request->third_latepoint,
                'besar_potongan' => $request->besar_potongan,
                'besar_point' => $request->besar_point,
                'payroll_period' => $request->payroll_period,
                'op_price' => $request->ot_price,
            ];
            // dd($dataSettings);
            $SaveSetting = LatePointSetting::create($dataSettings);
        }

        return response()->json(['status' => 'success', 'message' => 'Setting berhasil diperbarui']);
    }
    public function getKaryawanByDivisi($divisiId)
    {
        $karyawan = Karyawan::whereHas('karyawanHasDivisions', function ($query) use ($divisiId) {
            $query->where('divisi_id', $divisiId)->where('khr_isActive', 1);
        })->get(['id', 'k_nama']);
        return response()->json($karyawan);
    }
    public function getShiftsByDivisi($divisiId)
    {
        $shifts = Shift::where('id_divisi', $divisiId)->get(['id', 's_nama']);
        return response()->json($shifts);
    }

    public function filterAbsensi(Request $request)
    {
        $query = Karyawan::join('karyawan_has_divisions', 'karyawan_has_divisions.karyawan_id', '=', 'karyawan.id')
            ->join('divisis', 'divisis.id', '=', 'karyawan_has_divisions.divisi_id')
            ->leftJoin('karyawan_shifts', 'karyawan_shifts.karyawan_id', '=', 'karyawan.id')
            ->leftJoin('shifts', 'shifts.id', '=', 'karyawan_shifts.shift_id');
        if ($request->filled('id_divisi')) {
            $query->where('divisis.id', $request->id_divisi);
        }
        if ($request->filled('id_shift')) {
            $query->where('shifts.id', $request->id_shift);
        }

        $query->whereExists(function ($subquery) {
            $subquery->select(DB::raw(1))
                ->from('scan_logs')
                ->whereRaw('scan_logs.pin = karyawan.k_pin');
        });
        $tgl = $request->get('tanggal_absen');
        $absensi = $query->get();
        $transformedAbsensi = $absensi->map(function ($item) use ($tgl) {
            $AttController = new AttendanceController();
            $checkin = $AttController->getPunchInnOut($item->karyawan_id, $tgl);
            $durasi = Durasi($checkin['punch_in'], $checkin['punch_out']);

            $status = '';
            $status_class = '';
            if (is_null($checkin['punch_in'])) {
                $status = 'Undefined';
                $status_class = 'btn-secondary';
            } elseif (Carbon::parse($checkin['punch_in'])->format('H:i') <= Carbon::parse($item->s_clock_in)->format('H:i')) {
                $status = 'Ontime';
                $status_class = 'btn-success';
            } else {
                $status = 'Late';
                $status_class = 'btn-danger';
            }

            if (!empty($checkin['punch_out']) && strtotime($checkin['punch_out'])) {
                $punch_out_time =  Carbon::parse($checkin['punch_out'])->format('H:i');
            } else {
                $punch_out_time = '-';
            }
            if (!empty($checkin['punch_in']) && strtotime($checkin['punch_in'])) {
                $punch_in_time =  Carbon::parse($checkin['punch_in'])->format('H:i');
            } else {
                $punch_in_time = '-';
            }

            return [
                'nama' => $item->k_nama,
                'divisi' => $item->d_nama,
                'tanggal' => $item->scan_date,
                'punch_in' => $punch_in_time ?? '-',
                'punch_out' => $punch_out_time ?? '-',
                'shift_nama' => $item->s_nama,
                'schedule_in' => $item->s_clock_in,
                'schedule_out' => $item->s_clock_out,
                'working_hour' => $durasi,
                'status_absensi' => $status,
                'status_class' => $status_class // untuk styling button status
            ];
        });

        return response()->json(['absensi' => $transformedAbsensi]);
    }
}
