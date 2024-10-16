<?php

namespace App\Http\Controllers;

use App\Http\Requests\NormalCheckinRequest;
use App\Http\Requests\PostSpeedyCheckin;
use App\Models\Checkin;
use App\Models\CheckinDetail;
use App\Models\Guest;
use App\Models\Reservation;
use App\Models\Rooms;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CheckinController extends Controller
{
    public function index() : View {
        $Data = [
            'Title'=>'Regular Checking',
        ];
        return view('frontoffice.checkin.normal_checkin', $Data);
    }
    public function speedy_post(PostSpeedyCheckin $request) {
        $getDetailReservation = Reservation::where('reservation_name', $request->reservation_name)
                                            ->where('reservation_contact', $request->reservation_contact)
                                            ->where('reservation_checkin', $request->speedy_checkin_time)
                                            ->where('reservation_checkout', $request->speedy_checkout_time)
                                            ->get()->first();
        //get details data to insert into checkin
        $invoice = "RR".date('ymdhis');
        $name_guest = $request->name_guest;
        $id_type = $request->id_type;
        $id_number = $request->id_number;
        $Guest = Guest::where('id_type', $id_type)
                        ->where('id_number',$id_number)->first();
        if(!$Guest){
            //if not exist store guest data to guest table and get the primary key that inserted
            $GuestData = [
                'name_guest'=>$request->name_guest,
                'id_type'=>$request->id_type,
                'id_number'=>$request->id_number,
                'date_of_birth'=>$request->date_of_birth,
                'place_of_birth'=>$request->place_of_birth,
                'guest_gender'=>$request->gender,
                'guest_religion'=>$request->religion,
                'guest_title'=>$request->title,
                'guest_country'=>$request->country,
                'guest_province'=>$request->province,
                'guest_city'=>$request->city,
                'guest_postalcode'=>$request->postal_code,
                'guest_email'=>$request->email_address,
                'guest_contact'=>$request->telp_number,
                // 'id_img'=>$request->document  @todo : not implemented yet
            ];
            $Guest =  Guest::create($GuestData);
            $guest_id = $Guest->id;
        }else{
            $guest_id = $Guest->id;
        }
        $checkinData = [
            'reservation_id'=>$getDetailReservation->id,
            'no_invoice'=>$invoice,
            'room_id'=>$getDetailReservation->room_id,
            'chanel_checkin'=>$getDetailReservation->reservation_chanel,
            'date_checkin'=>$getDetailReservation->reservation_checkin,
            'date_checkout'=>$getDetailReservation->reservation_checkout,
            'guest_id'=>$guest_id,
            'guest_adult'=>$request->number_of_adult,
            'guest_kids'=>$request->number_of_children,
            'payment_status'=>$getDetailReservation->reservation_payment_status,
            'payment'=>$getDetailReservation->reservation_payment,
            'payment_method'=>$getDetailReservation->reservation_payment_method
        ];

        if($Checkin = Checkin::create($checkinData)){
            //get room detil
            $Rooms = Rooms::find($getDetailReservation->room_id);
            $Rooms->room_status = 'OCCUPIED';
            $Rooms->save();
            $days = daysInterval($getDetailReservation->reservation_checkin, $getDetailReservation->reservation_checkout);
            //insert detail checkin
            $DetailCheckin = [
                'checkin_id'=>$Checkin->id,
                'item_category'=>'Rooms',
                'item_name'=>$Rooms->room_name,
                'item_price'=>$Rooms->room_price,
                'item_qty'=>$days,
                'item_description'=>"Item Speedy Checkin"
            ];
            CheckinDetail::create($DetailCheckin);
            //set reservation checkedin
            $getDetailReservation->reservation_status = 'Checked-in';
            $getDetailReservation->save();
            $return = ['status'=>'success', 'message'=>'Checkin untuk '.$name_guest.' Berhasil'];
            return redirect()->route('dashboard')->with($return);
        }

    }
    public function speedy() {
        $Data = [
            'Title'=>'Speedty Check-in',
        ];
        return view('frontoffice.checkin.speedy_checkin_form', $Data);
    }
    public function form_normal($id) : View {
        $Room = Rooms::find($id);
        $invoice = "RR".date('ymdhis');
        $Data = [
            'Room'=>$Room,
            'no_invoice'=>$invoice,
            'checkin_time'=>date('Y-m-d')
        ];
        return view('frontoffice.checkin.normal_checkin_form', $Data);
    }

    public function store(NormalCheckinRequest $request) {
        //store or get guest information before create checkin event
        //get guest info 
        $name_guest = $request->name_guest;
        $id_type = $request->id_type;
        $id_number = $request->id_number;
        $Guest = Guest::where('id_type', $id_type)
                        ->where('id_number',$id_number)->first();
        if(!$Guest){
            //if not exist store guest data to guest table and get the primary key that inserted
            $GuestData = [
                'name_guest'=>$request->name_guest,
                'id_type'=>$request->id_type,
                'id_number'=>$request->id_number,
                'date_of_birth'=>$request->date_of_birth,
                'place_of_birth'=>$request->place_of_birth,
                'guest_gender'=>$request->gender,
                'guest_religion'=>$request->religion,
                'guest_title'=>$request->title,
                'guest_country'=>$request->country,
                'guest_province'=>$request->province,
                'guest_city'=>$request->city,
                'guest_postalcode'=>$request->postal_code,
                'guest_email'=>$request->email_address,
                'guest_contact'=>$request->telp_number,
                // 'id_img'=>$request->document  @todo : not implemented yet
            ];
            $Guest =  Guest::create($GuestData);
            $guest_id = $Guest->id;
        }else{
            $guest_id = $Guest->id;
        }
        
        //checkin info
        $checkin = $request->checkin_time;
        $checkout = $request->checkout_time;
        $children = $request->number_of_children;
        $adults = $request->number_of_adult;
        $channel = $request->channel;

        //create data checkin
        $CheckinDetail = [
            'reservation_id'=>$request->reservation_id ?? null,
            'no_invoice'=>$request->invoice,
            'room_id'=>$request->room_id,
            'guest_id'=>$guest_id,
            'chanel_checkin'=>$channel,
            'date_checkin'=>$checkin,
            'date_checkout'=>$checkout,
            'guest_adult'=>$adults,
            'guest_kids'=>$children,
            // 'is_extrabed'=>null' not implemented
            'payment_status' =>'DEPOSIT',
            'payment'=>$request->deposit,
            'payment_method'=>$request->payment_method,
        ];
        if($Checkin = Checkin::create($CheckinDetail)){
            //get room detil
            $Rooms = Rooms::find($request->room_id);
            $Rooms->room_status = 'OCCUPIED';
            $Rooms->save();
            $days = daysInterval($checkin, $checkout);
            //insert detail checkin
            $DetailCheckin = [
                'checkin_id'=>$Checkin->id,

                'item_category'=>'Rooms',
                'item_name'=>$Rooms->room_name,
                'item_price'=>$Rooms->room_price,
                'item_qty'=>$days,
                'item_description'=>"Item Default Checkin"
            ];
            CheckinDetail::create($DetailCheckin);
            $return = ['status'=>'success', 'message'=>'Checkin untuk '.$name_guest.' Berhasil'];
            return redirect()->route('dashboard')->with($return);
        }
    }
}