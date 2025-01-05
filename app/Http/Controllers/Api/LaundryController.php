<?php

namespace App\Http\Controllers\Api;

use App\Models\Laundry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\LaundryResource;

class LaundryController extends Controller
{
    public function index()
    {
        try {
            $laundry = DB::table('laundries')
                ->leftJoin('det_laundries', 'laundries.id', '=', 'det_laundries.laundry_id')
                ->leftJoin('checkins', 'laundries.checkin_id', '=', 'checkins.id')
                ->leftJoin('rooms', 'checkins.room_id', '=', 'rooms.id')
                ->leftJoin('guests', 'checkins.guest_id', '=', 'guests.id')
                ->select(
                    DB::raw("IFNULL(guests.name_guest, 'Internal') as name_guest"),
                    DB::raw("IFNULL(rooms.room_no, '~') as room_no"),
                    'laundries.laundry_type',
                    'det_laundries.det_laundry_price',
                )
                ->get();
            $laundryTotal = $laundry->count();
            return new LaundryResource(true, 'Data Laundry', compact('laundry', 'laundryTotal'));
        } catch (\Exception $e) {
            return new LaundryResource(false, 'Gagal mendapatkan data laundry', []);
        }
    }
}
