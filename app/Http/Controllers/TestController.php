<?php

namespace App\Http\Controllers;

use App\Models\Checkin;
use App\Models\DetailDaily;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index(){
        $AttendanceController = new AttendanceController();
        $ok = $AttendanceController->ProsessLatePoint(1, '2024-10-14');
        print_r($ok);
    }
}
