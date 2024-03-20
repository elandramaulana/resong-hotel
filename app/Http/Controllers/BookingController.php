<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReserveRoomRequest;
use App\Models\Rooms;
use App\Models\Reservation;
use Illuminate\Http\Request;

class BookingController extends Controller
{
      public function index() {
        $Data = [
            'Title'=>'Input Detail Reservasi',
        ];
        return view('frontoffice.reservation.booking', $Data);
      }

      public function pick_room(ReserveRoomRequest $request) {
        $formData = $request->all();
        $request->session()->put('form_data', $formData);
        $data = session('form_data');
        $reservation_checkin = $data['reservation_checkin'];
        $reservation_checkout = $data['reservation_checkout'];
        $qty_guest = $data['qty_guest'] ?? 1;
        $availableRooms = $this->BookingEngine($reservation_checkin, $reservation_checkout, $qty_guest);
        print_r($availableRooms);

        // $Data = [
        //     'Title'=>'Pilih Kamar',
        // ];
        // return view('frontoffice.reservation.booking_room_number', $Data);
      }

      public function BookingEngine($date_in, $date_out, $qty_guest) {
        $availableRooms = Rooms::whereDoesntHave('reservations', function ($query) use ($date_in, $date_out) {
            $query->where(function ($query) use ($date_in, $date_out) {
                $query->whereBetween('reservation_checkin', [$date_in, $date_out])
                    ->orWhereBetween('reservation_checkout', [$date_in, $date_out]);
            });
        })->where('room_capacity', '>=', $qty_guest)
        ->where('room_status', 'VACANT READY')
        ->get();
        return $availableRooms;
      }
      
}
