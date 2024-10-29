<?php
namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\KaryawanHasDivision;
use App\Models\Kehadiran;
use App\Models\ScanLog;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class APIController extends Controller
{
    public function scanlog_endpoint(Request $request){
        Log::info('Content :'. $request->getContent());
        try {
            $validatedData = $request->validate([
                '*.id' => 'required|integer',
                '*.datetime_scan' => 'required|date_format:Y-m-d H:i:s',
                '*.status_send' => 'required|string',
                '*.scanlog_id' => 'required|integer',
                '*.sn' => 'required|string',
                '*.scandate' => 'required|date_format:Y-m-d H:i:s',
                '*.pin' => 'required|string',
                '*.verifymode' => 'required|string',
                '*.iomode' => 'required|string',
                '*.workcode' => 'required|string',
                '*.created_at' => 'nullable|date_format:Y-m-d\TH:i:s.u\Z',
                '*.updated_at' => 'nullable|date_format:Y-m-d\TH:i:s.u\Z',
            ]);

            // Collect data into an array
            $scanlogData = [];
            $KaryawanController = new KaryawanController();
            $AttendanceController = new AttendanceController();
            foreach ($validatedData as $entry) {
                //get shift info
                $scanlogData = [
                    'pin' => $entry['pin'],
                    'workcode' => $entry['workcode'],
                    'verifymode' => $entry['verifymode'], 
                    'iomode' => $entry['iomode'],
                    'scan_date' => $entry['scandate'],
                    'scanlog_id' => $entry['scanlog_id'],
                    'sync_date' => $entry['datetime_scan'],
                ];
                ScanLog::create($scanlogData);
                $scandatetime = new DateTime($entry['scandate']);
                $scandate = $scandatetime->format('Y-m-d');
                $karyawan = $KaryawanController->DetailKaryawanByPIN($entry['pin']);
                $karyawan_id = $karyawan->karyawan_id ?? null;
                if ($karyawan_id) {
                        //count scanlog with current karyawan_id and given date 
                        //to makesure Proccess Late only executed for checkin 
                        $scanlogCount = ScanLog::where('pin', $entry['pin'])
                                                ->whereDate('scan_date', $scandate)
                                                ->count();

                    if ($scanlogCount == 1) {
                        $AttendanceController->ProsessLatePoint($karyawan_id, $scandate);
                    } else {
                        // Log the skipped message
                        Log::info('Latepoint processing skipped for subsequent scans on '.$scandate);
                    }
                }
            }
            Log::info('Data received successfully');
            // Return the collected data
            return response()->json(['message' => 'Data received successfully', 'data' => $scanlogData], 200);
        } catch (ValidationException $e) {
            // Log validation errors
            Log::error('Validation Errors:', $e->errors());

            // Return validation errors in JSON response
            return response()->json([
                'status' => 'error',
                'errors' => $e->errors()
            ], 422);
        }
    
    }
}