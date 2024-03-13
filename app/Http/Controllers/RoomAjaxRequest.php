<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View as FacadesView;

class RoomAjaxRequest extends Controller
{
    public function ajax_select_room(Request $request){
        $FisrtQuery = Rooms::groupBy('room_type', 'room_price')
                        ->select('room_type', 'room_price')
                        ->get();
        foreach ($FisrtQuery as $Rooms) {
            $DetailRoom = Rooms::where('room_type', $Rooms['room_type'])
                            ->where('room_price', $Rooms['room_price'])->get();
            $DR[] = [
                'room_type'=>$Rooms['room_type'],
                'room_price'=>formatCurrency($Rooms['room_price']),
                'detail_room'=>$DetailRoom
            ];
        }
        $Data = [
            'Data' => $DR ?? []
        ];
        $view = FacadesView::make('frontoffice.checkin.ajax_select_rooms', $Data)->render();
        return response()->json(['html' => $view]);
    }
    public function ajax_select_room_checkout(Request $request){
        $FisrtQuery = Rooms::groupBy('room_type', 'room_price')
                        ->select('room_type', 'room_price')
                        ->get();
        foreach ($FisrtQuery as $Rooms) {
            $DetailRoom = Rooms::where('room_type', $Rooms['room_type'])
                            ->where('room_price', $Rooms['room_price'])
                            ->where('room_status', 'OCCUPIED')->get();
            $DR[] = [
                'room_type'=>$Rooms['room_type'],
                'room_price'=>formatCurrency($Rooms['room_price']),
                'detail_room'=>$DetailRoom
            ];
        }
        $Data = [
            'Data' => $DR ?? []
        ];
        $view = FacadesView::make('frontoffice.checkout.ajax_select_checkout_rooms', $Data)->render();
        return response()->json(['html' => $view]);
    }
}
