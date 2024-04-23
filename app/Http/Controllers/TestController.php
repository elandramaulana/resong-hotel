<?php

namespace App\Http\Controllers;

use App\Models\Checkin;
use App\Models\DetailDaily;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index()  {
        $c = new DaftarMenuController();
        $show = $c->listDetail(1,2);
        echo json_encode($show);
    }
}
