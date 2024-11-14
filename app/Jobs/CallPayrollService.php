<?php
namespace App\Jobs;

use App\Services\PayrollService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CallPayrollService implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $karyawanId;
    protected $payrollId;

    /**
     * Create a new job instance.
     */
    public function __construct($karyawanId, $payrollId)
    {
        $this->karyawanId = $karyawanId;
        $this->payrollId = $payrollId;
    }

    /**
     * Execute the job.
     */
    public function handle(PayrollService $payrollService)
    {
        // Your payroll processing logic here
        $payrollService->KomponenGaji($this->karyawanId, $this->payrollId);
    }
}
