<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserInfoController extends Controller
{
    public function profile()
    {
        return view('profile.user_info');
    }
    public function history_absensi()
    {
        return view('profile.absent_info');
    }
    public function history_slip_gaji()
    {
        return view('profile.slipgaji_info');
    }
}
