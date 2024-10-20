<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
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

                $coutKaryawan = DB::table('karyawan_has_divisions')->where('khr_isActive', '1')->count();
               

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
              
                    // dd($vacantRoomCount);

            return view('dashboard', compact('coutKaryawan','coutSupplier', 'todayCheckin','todayCheckout','vacantRoomCount', 'occupiedRoomCount','bookedRoomCount', 'vacantDirtyRoomCount' ));

    }
}
