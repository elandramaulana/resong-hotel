<?php

namespace App\Http\Controllers;

use App\Models\ScanLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class APIController extends Controller
{
    public function scanlogStore(Request $request)
    {
         // Validate the incoming data
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
            '*.created_at' => 'nullable|date_format:Y-m-d H:i:s',
            '*.updated_at' => 'nullable|date_format:Y-m-d H:i:s',
        ]);

        // Collect data into an array
        $scanlogData = [];
        foreach ($validatedData as $entry) {
            $scanlogData[] = [
                'pin' => $entry['pin'],
                'workcode' => $entry['workcode'],
                'verifymode' => $entry['verifymode'], // Ensure correct key
                'iomode' => $entry['iomode'],
                'scan_date' => $entry['scandate'],
                'scanlog_id' => $entry['scanlog_id'],
                'sync_date' => $entry['datetime_scan'],
            ];
        }
        //save it to the database
        ScanLog::insert($scanlogData);
        // Return the collected data
        return response()->json(['message' => 'Data received successfully', 'data' => $scanlogData], 200);
        }
}
