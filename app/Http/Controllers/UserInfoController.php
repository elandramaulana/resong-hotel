<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserInfoController extends Controller
{
    public function profile(){
        
    }
    public function history_absensi(){
        return view('profile.absent_info');
    }
    public function history_slip_gaji(){

    }
}
