<?php

namespace App\Http\Controllers;

use App\Models\LatePointSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function index(): View
    {
        $latePointSetting = LatePointSetting::first() ?? ['payroll_period' => null];
        // echo json_encode($data);
        return view('system_settings.system_settings', compact('latePointSetting'));
    }
}
