<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        try {
            $search = $request->input('search');
            $today = Carbon::today()->toDateString();
            $yesterday = Carbon::yesterday()->toDateString();

            $inRoom = DB::table('checkins')
                ->join('rooms', 'checkins.room_id', '=', 'rooms.id')
                ->join('guests', 'checkins.guest_id', '=', 'guests.id')
                ->select(
                    'guests.name_guest as guest_name',
                    'guests.guest_contact',
                    'rooms.room_no',
                    'checkins.date_checkin',
                    'checkins.date_checkout'
                )
                ->where("guests.name_guest", "like", "%$search%")
                ->orWhere("rooms.room_no", "like", "%$search%")
                ->get();

            $reserved = DB::table('reservations')
                ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
                ->select(
                    'reservations.reservation_name as guest_name',
                    'reservations.reservation_contact as guest_contact',
                    'rooms.room_no',
                    'reservations.reservation_checkin as date_checkin',
                    'reservations.reservation_checkout as date_checkout'
                )
                ->where("reservations.reservation_name", "like", "%$search%")
                ->orWhere("rooms.room_no", "like", "%$search%")
                ->get();

            $vacantRoomCount = DB::table('rooms')
                ->where('room_status', 'VACANT READY')
                ->count();

            $occupiedRoomCount = DB::table('rooms')
                ->where('room_status', 'OCCUPIED')
                ->count();

            $bookedRoomCount = DB::table('rooms')
                ->where('room_status', 'BOOKED')
                ->count();

            $vacantDirtyRoomCount = DB::table('rooms')
                ->where('room_status', 'VACANT DIRTY')
                ->count();
            return new RoomResource(true, 'Data Ruangan', compact('inRoom', 'reserved', 'vacantRoomCount', 'occupiedRoomCount', 'bookedRoomCount', 'vacantDirtyRoomCount'));
        } catch (\Exception $e) {
            return new RoomResource(false, 'Gagal mendapatkan data ruangan', []);
        }
    }
}
