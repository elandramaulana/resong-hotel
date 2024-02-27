<?php

namespace App\Http\Controllers;

use App\Http\Requests\NormalCheckinRequest;
use App\Models\Checkin;
use App\Models\Guest;
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
    public function form_normal($id) : View {
        $Room = Rooms::find($id);
        $Data = [
            'Room'=>$Room
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
            // 'payment_method',
        ];
        Checkin::create($CheckinDetail);
    }
}
