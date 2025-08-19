<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $Data = [
            'Title'=>"Dashboard"
        ];

        $today = Carbon::today()->toDateString();
        $yesterday = Carbon::yesterday()->toDateString();

        $todayCheckin = DB::table('reservations')
            ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
            ->select(
                'reservations.reservation_name as customer_name',
                'rooms.room_no',
                'reservations.reservation_checkin as checkin_time'
            )
            ->whereDate('reservations.reservation_checkin', $today)
            ->get();


        $todayCheckout = DB::table('checkins')
                ->leftJoin('checkouts', 'checkins.id', '=', 'checkouts.checkin_id')
                ->join('rooms', 'checkins.room_id', '=', 'rooms.id')
                ->join('guests', 'checkins.guest_id', '=', 'guests.id')
                ->select(
                    'guests.name_guest as guest_name',
                    'rooms.room_no',
                    'checkins.date_checkout as checkout_date',
                    'checkouts.created_at as checkout_time'
                )
                ->where(function ($query) use ($today, $yesterday) {
                    $query->whereDate('checkins.date_checkout', $today)
                        ->orWhere(function ($query) use ($today, $yesterday) {
                            $query->whereDate('checkins.date_checkout', '<', $today)
                                ->whereNull('checkouts.id')
                                ->orWhereDate('checkins.date_checkout', $yesterday); // Tambahkan kondisi untuk checkout kemarin
                        });
                })
                ->whereNull('checkouts.id') // Tambahkan kondisi untuk memeriksa checkin_id yang belum ada di checkout
                ->get();

                $coutSupplier = DB::table('suppliers')->count();

                $coutKaryawan = DB::table('karyawan')->count();
                $date = $request->input('date') ?: Carbon::today()->format('Y-m-d');
                $getRoomStatus = $this->getRoomStatus($date);

                $vacantRoomCount =$getRoomStatus['available_rooms'];

                $occupiedRoomCount = $getRoomStatus['occupied_rooms'];

                $bookedRoomCount = $getRoomStatus['reserved_rooms'];

                $vacantDirtyRoomCount = DB::table('rooms')
                    ->where('room_status', 'VACANT DIRTY')
                    ->count();

                $kehadiranCount = DB::table('kehadirans')->where('created_at', $date)->count();

                    // dd($vacantRoomCount);

            return view('dashboard', compact('kehadiranCount','coutKaryawan','coutSupplier', 'todayCheckin','todayCheckout','vacantRoomCount', 'occupiedRoomCount','bookedRoomCount', 'vacantDirtyRoomCount' ));

    }
    public function getRoomStatus($date = null)
    {
        $date = $date ?: Carbon::today();
        // Get date from request, or default to today

        // Get Occupied Room IDs
        $occupiedRoomIds = DB::table('checkins')
            ->whereDate('date_checkin', '<=', $date)
            ->whereDate('date_checkout', '>=', $date)
            ->leftJoin('checkouts', 'checkins.id', '=', 'checkouts.checkin_id')
            ->whereNull('checkouts.id')
            ->pluck('room_id');
        Log::info('occupiedRoomIds: ' . $occupiedRoomIds);
        // Get Reserved Room IDs
        $reservedRoomIds = DB::table('reservations')
            ->where('reservation_status', 'New') // adjust if needed
            ->whereDate('reservation_checkin', '<=', $date)
            ->whereDate('reservation_checkout', '>=', $date)
            ->pluck('room_id');

        // Merge occupied and reserved rooms
        $busyRoomIds = $occupiedRoomIds->merge($reservedRoomIds)->unique();

        // Count total rooms
        $totalRooms = DB::table('rooms')->count();
        Log::info('busyRoom: ' . $busyRoomIds);
        // Count available rooms
        $availableRooms = DB::table('rooms')
            ->whereNotIn('id', $busyRoomIds)
            ->where('room_status', 'VACANT READY') // adjust if needed
            ->count();
        // Response
        return [
            'date' => $date,
            'available_rooms' => $availableRooms,
            'occupied_rooms' => $occupiedRoomIds->count(),
            'reserved_rooms' => $reservedRoomIds->count(),
            'total_rooms' => $totalRooms,
        ];
    }
}
