<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\KaryawanResource;
use App\Http\Controllers\AttendanceController;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        try {
            $search = $request->input('search');
            $query = Karyawan::join('karyawan_has_divisions', 'karyawan_has_divisions.karyawan_id', '=', 'karyawan.id')
                ->join('divisis', 'divisis.id', '=', 'karyawan_has_divisions.divisi_id')
                ->leftJoin('karyawan_shifts', 'karyawan_shifts.karyawan_id', '=', 'karyawan.id')
                ->leftJoin('shifts', 'shifts.id', '=', 'karyawan_shifts.shift_id')
                ->where("karyawan.k_nama", "like", "%$search%");

            $query->whereExists(function ($subquery) {
                $subquery->select(DB::raw(1))
                    ->from('scan_logs')
                    ->whereRaw('scan_logs.pin = karyawan.k_pin');
            });

            $tgl = $request->get('tanggal_absen');
            $statusAbsen = $request->get('status_absen');

            if (!$tgl) {
                $tgl = Carbon::now()->format('Y-m-d');
            }

            $absensi = $query->get();
            // return response()->json($absensi);
            $absensiKaryawan = $absensi->map(function ($item) use ($tgl) {
                $AttController = new AttendanceController();
                $checkin = $AttController->getPunchInnOut($item->karyawan_id, $tgl);
                $status = '';
                if (is_null($checkin['punch_in'])) {
                    $status = 'Undefined';
                } elseif ($checkin['punch_in'] <= $item->s_clock_in) {
                    $status = 'Ontime';
                } else {
                    $status = 'Late';
                }


                return [
                    'nama' => $item->k_nama,
                    'contact' => $item->k_contact,
                    'divisi' => $item->d_nama,
                    'tanggal' => $tgl,
                    'status_absensi' => $status,
                ];
            });

            if ($statusAbsen) {
                $absensiKaryawan = $absensiKaryawan->filter(function ($item) use ($statusAbsen) {
                    return $item['status_absensi'] === $statusAbsen;
                });
            }

            $karyawans = Karyawan::all();
            $karyawansTotal = $karyawans->count();
            return new KaryawanResource(true, 'Data Karyawan', compact('absensiKaryawan', 'karyawansTotal'));
        } catch (\Exception $e) {
            return new KaryawanResource(false, $e->getMessage(), null);
        }
    }

    public function attendanceReport(Request $request)
    {
        try {
            // Get the date range from the request or default to the current month
            $startDate = $request->get('start_date') ? Carbon::parse($request->get('start_date'))->startOfDay() : Carbon::now()->startOfMonth();
            $endDate = $request->get('end_date') ? Carbon::parse($request->get('end_date'))->endOfDay() : Carbon::now()->endOfMonth();
            $search = $request->input('search');

            // Get all employees
            $karyawans = Karyawan::where("karyawan.k_nama", "like", "%$search%")->get();

            $reportData = $karyawans->map(function ($karyawan) use ($startDate, $endDate) {
                $lateCount = 0;
                $ontimeCount = 0;
                $undefinedCount = 0;

                // Loop through each day in the specified date range
                for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                    $tgl = $date->format('Y-m-d');

                    // Get the attendance data for each day
                    $attendanceController = new AttendanceController();
                    $checkin = $attendanceController->getPunchInnOut($karyawan->id, $tgl);

                    if (is_null($checkin['punch_in'])) {
                        $undefinedCount++;
                    } elseif ($checkin['punch_in'] <= $karyawan->s_clock_in) {
                        $ontimeCount++;
                    } else {
                        $lateCount++;
                    }
                }

                // Return the aggregated report for each employee
                return [
                    'nama' => $karyawan->k_nama,
                    'contact' => $karyawan->k_contact,
                    'divisi' => $karyawan->divisi->d_nama ?? 'N/A', // Assuming `division` relation is defined on `Karyawan` model
                    'late' => $lateCount,
                    'ontime' => $ontimeCount,
                    'undefined' => $undefinedCount,
                ];
            });

            return response()->json([
                'success' => true,
                'message' => 'Attendance Report Data Retrieved Successfully',
                'data' => $reportData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ]);
        }
    }
}
