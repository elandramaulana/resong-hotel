<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RestoResource;
use App\Models\TransResto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RestoController extends Controller
{
    public function index(Request $request)
    {
        try {
            $startDate = $request->get('start_date') ? Carbon::parse($request->get('start_date'))->startOfDay() : null;
            $endDate = $request->get('end_date') ? Carbon::parse($request->get('end_date'))->endOfDay() : null;
            $search = $request->input('search');
    
            $query = DB::table('trans_resto')
                ->leftJoin('detail_trans_resto', 'trans_resto.id', '=', 'detail_trans_resto.trans_resto_id')
                ->leftJoin('checkins', 'trans_resto.checkin_id', '=', 'checkins.id')
                ->leftJoin('rooms', 'checkins.room_id', '=', 'rooms.id')
                ->select(
                    'trans_resto.guest_name',
                    DB::raw('COALESCE(rooms.room_no, "Tidak Ada") AS room'),
                    DB::raw('SUM(detail_trans_resto.qty * detail_trans_resto.det_price) AS harga')
                )
                ->groupBy('trans_resto.guest_name', 'rooms.room_no')
                ->where(function ($q) use ($search) {
                    if ($search) {
                        $q->where("trans_resto.guest_name", "like", "%$search%")
                          ->orWhere("rooms.room_no", "like", "%$search%");
                    }
                });
    
            if ($startDate && $endDate) {
                $query->whereBetween('trans_resto.created_at', [$startDate, $endDate]);
            }
    
            $data = $query->get();
    
            // Counting restoTotal based on date filter condition
            $restoTotalQuery = TransResto::query();
            if ($startDate && $endDate) {
                $restoTotalQuery->whereBetween('created_at', [$startDate, $endDate]);
            }
            $restoTotal = $restoTotalQuery->count();
    
            return new RestoResource(true, 'Data Resto', compact('data', 'restoTotal'));
        } catch (\Exception $e) {
            return new RestoResource(false, 'Gagal mendapatkan data resto', null);
        }
    }    
}
