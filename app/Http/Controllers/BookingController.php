<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReserveRoomRequest;
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
        $qty_guest = $data['qty_guest'];

        
        // $Data = [
        //     'Title'=>'Pilih Kamar',
        // ];
        // return view('frontoffice.reservation.booking_room_number', $Data);
      }
}
