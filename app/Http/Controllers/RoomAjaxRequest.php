<?php

namespace App\Http\Controllers;

use App\Models\Checkin;
use App\Models\Rooms;
use FontLib\Table\Type\fpgm;
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
            $DetailRoom = Checkin::leftJoin('checkouts', 'checkins.id','=','checkouts.checkin_id')
                                ->join('rooms', 'rooms.id', '=', 'checkins.room_id')
                                ->join('guests', 'guests.id', '=', 'checkins.guest_id')
                                ->where('checkouts.id', null)
                                ->where('room_type', $Rooms['room_type'])
                                ->where('room_price', $Rooms['room_price'])
                                ->select('checkins.*', 'checkins.id as checkin_id')
                                ->addselect('rooms.*', 'rooms.id as room_id')
                                ->addselect('guests.name_guest', 'guests.id as guest_id')
                                ->get();
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
    public function ajax_select_room_reservations(Request $request){
        $checkin = $request->get('date_in');
        $checkout = $request->get('date_out');
        $qty_guest = $request->get('qty_guest');

        $FisrtQuery = Rooms::groupBy('room_type', 'room_price')
        ->select('room_type', 'room_price')
        ->get();
        foreach ($FisrtQuery as $Rooms) {
            $DetailRoom = Rooms::whereDoesntHave('reservations', function ($query) use ($checkin, $checkout) {
                $query->where(function ($query) use ($checkin, $checkout) {
                    $query->where('reservation_checkin', '<', $checkout)
                          ->where('reservation_checkout', '>', $checkin);
                });
            })->where('room_status', 'VACANT READY')
              ->where('room_price', $Rooms['room_price'])
              ->where('room_type', $Rooms['room_type'])
              ->get();
            $DR[] = [
                'room_type'=>$Rooms['room_type'],
                'room_price'=>formatCurrency($Rooms['room_price']),
                'detail_room'=>$DetailRoom,
                'dateid'=>$checkin,
                'dateout'=>$checkout
            ];
        }
        $Data = [
            'Data' => $DR ?? []
        ];
        $view = FacadesView::make('frontoffice.reservation.ajax_select_reservation_rooms', $Data)->render();
        return response()->json(['html' => $view]);
    }
}
