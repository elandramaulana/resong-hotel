<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScanlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startDate = Carbon::create(2024, 9, 1, 0, 0, 0); // Start from September 1, 2024
        $endDate = Carbon::now(); // Current date and time

        $scanlogId = 5; // Static scanlog_id for this example
        $iomode = 1;    // Example fixed iomode
        $verifymode = 1; // Example fixed verifymode

        $pinCycle = [1, 2, 3]; // Pin cycle (representing employees)

        // Loop through each day from the start date to the end date
        while ($startDate->lte($endDate)) {
            foreach ($pinCycle as $pin) {
                // Punch In (06:00 to 08:00)
                $punchInTime = $startDate->copy()->setTime(rand(6, 8), rand(0, 59), rand(0, 59));
                $syncInDate = $punchInTime->copy()->addHours(rand(0, 2));   // Sync date a few hours after punch in
                $createdAt = Carbon::now();
                $updatedAt = Carbon::now();

                // Insert punch in record for the day
                DB::table('scan_logs')->insert([
                    'scanlog_id' => $scanlogId,
                    'pin' => $pin, // Cycle through 1, 2, 3 for each day
                    'workcode' => 0, // Static workcode
                    'verifymode' => $verifymode,
                    'iomode' => $iomode,
                    'scan_date' => $punchInTime,
                    'sync_date' => $syncInDate,
                    'created_at' => $createdAt,
                    'updated_at' => $updatedAt
                ]);

                // Punch Out (16:00 to 20:00)
                $punchOutTime = $startDate->copy()->setTime(rand(16, 20), rand(0, 59), rand(0, 59));
                $syncOutDate = $punchOutTime->copy()->addHours(rand(0, 2));  // Sync date a few hours after punch out

                // Insert punch out record for the day
                DB::table('scan_logs')->insert([
                    'scanlog_id' => $scanlogId,
                    'pin' => $pin, // Same pin (employee) for punch out
                    'workcode' => 0, // Static workcode
                    'verifymode' => $verifymode,
                    'iomode' => $iomode,
                    'scan_date' => $punchOutTime,
                    'sync_date' => $syncOutDate,
                    'created_at' => $createdAt,
                    'updated_at' => $updatedAt
                ]);
            }

            // Move to the next day
            $startDate->addDay();
        }
    }
}
