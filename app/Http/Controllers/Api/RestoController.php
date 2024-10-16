<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RestoResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RestoController extends Controller
{
    public function index()
    {
        try {
            $data = DB::table('trans_resto')
                ->leftJoin('detail_trans_resto', 'trans_resto.id', '=', 'detail_trans_resto.trans_resto_id')
                ->leftJoin('checkins', 'trans_resto.checkin_id', '=', 'checkins.id')
                ->leftJoin('rooms', 'checkins.room_id', '=', 'rooms.id')
                ->select('trans_resto.guest_name', DB::raw('COALESCE(rooms.room_no, "Tidak Ada") AS room'), DB::raw('SUM(detail_trans_resto.qty * detail_trans_resto.det_price) AS harga'))
                ->groupBy('trans_resto.guest_name', 'rooms.room_no')
                ->get();

            $restoTotal = $data->count();
            return new RestoResource(true, 'Data Resto', compact('data', 'restoTotal'));
        } catch (\Exception $e) {
            return new RestoResource(false, 'Gagal mendapatkan data resto', null);
        }
    }
}
