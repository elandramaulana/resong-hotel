<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Reservation;
use Illuminate\Http\Request;

class AutocompleteController extends Controller
{
    public function guests(Request $request){
        $term = $request->input('term');
        $type_identity =$request->input('type_identity');
        $tags = Guest::where('id_type', $type_identity)
                        ->where('id_number', 'LIKE', '%' . $term . '%')
                        ->pluck('id_number');
        return response()->json($tags);
    }

    public function selected_guest(Request $request) {
        $id_type = $request->input('id_type');
        $id_number = $request->input('id_number');

        $Guest = Guest::where('id_type', $id_type)
                        ->where('id_number', $id_number)
                        ->get()->first();
        return response()->json($Guest);
    }
    

    public function speedy(Request $request) {
        $term = $request->input('term');
        $tags = Reservation::where('reservation_status', 'New')
                        ->where('reservation_name', 'LIKE', '%' . $term . '%')
                        ->pluck('reservation_name');
        return response()->json($tags);
    }

    public function selected_speedy(Request $request) {
        $reservation_name = $request->input('reservation_name');
        // $reservation_contact = $request->input('reservation_contact');
        // $reservation_checkin = $request->input('reservation_checkin');
        // $reservation_checkout = $request->input('reservation_checkout');

        $Guest = Reservation::where('reservation_name', $reservation_name)
                        // ->where('reservation_contact', $reservation_contact)
                        // ->where('reservation_checkin', $reservation_checkin)
                        // ->where('reservation_checkout', $reservation_checkout)
                        ->get()->first();
        return response()->json($Guest);
    }
}
