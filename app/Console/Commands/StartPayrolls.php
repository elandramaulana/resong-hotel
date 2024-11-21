<?php
namespace App\Console\Commands;

use App\Jobs\CallPayrollService;
use App\Models\Karyawan;
use App\Models\Payrolls;
use App\Services\PayrollService;
use Carbon\Carbon;
use Illuminate\Bus\Batch;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use Throwable;

class StartPayrolls extends Command
{
    protected $signature = 'payrolls:start';
    protected $payrollsService;

    public function __construct(PayrollService $payrollService)
    {
        parent::__construct();
        $this->payrollsService = $payrollService;
    }

    protected $description = 'This command is to start an automatic payroll process';

    public function handle()
    {
        $this->info('Starting the payroll process...');

        // Prepare the payroll period
        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');
        $PayrollsPeriod = $currentMonth.'-'.$currentYear;

        // Check if payroll already exists for this period
        $checkPayrols = Payrolls::where('periode_payroll', $PayrollsPeriod)->count();
        if ($checkPayrols > 0) {
            $this->info('This period already exists');
            return;
        } else {
            // Count workdays
            $workdayCall = $this->payrollsService->CountWorkdays();

            // Create the payroll if it does not exist
            $dataPayroll = [
                'periode_payroll' => $PayrollsPeriod,
                'hari_kerja' => $workdayCall['workdays'],
                'payroll_status' => "Calculating",
            ];
            $Payrolls = Payrolls::create($dataPayroll);
            $this->info('Payroll created successfully');

            // call all karyawan
            $allKaryawan = Karyawan::all();

            
            foreach ($allKaryawan as $Karyawan) {
                $komponenGaji = $this->payrollsService->KomponenGaji($Karyawan->id, $Payrolls->id);
                $callLate = $this->payrollsService->insertLatePoint($Karyawan->id, $komponenGaji['detail_payroll_id'], $workdayCall['startDate'], $workdayCall['endDate']);
              //  $this->info('Payroll created successfully'.$callLate);
            }
        }
    }

}
