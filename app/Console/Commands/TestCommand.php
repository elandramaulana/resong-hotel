<?php

namespace App\Console\Commands;

use App\Services\PayrollService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $PayrollService = New PayrollService();
        $countLembur = $PayrollService->countLembur(5, 88, 1,2);
        Log::info("countlembur:". $countLembur);
    }
}
