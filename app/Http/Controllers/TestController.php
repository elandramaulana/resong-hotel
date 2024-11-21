<?php

namespace App\Http\Controllers;

use App\Models\Checkin;
use App\Models\DetailDaily;
use App\Models\Rooms;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index(){
        $user  = User::find(1);
        $Token = $user->createToken('authToken')->plainTextToken;
        echo $Token;
    }
}

