<?php

namespace App\Http\Controllers;

use App\Http\Requests\NormalCheckinRequest;
use App\Http\Requests\PostSpeedyCheckin;
use App\Models\Checkin;
use App\Models\CheckinDetail;
use App\Models\Guest;
use App\Models\LatePointSetting;
use App\Models\Reservation;
use App\Models\Rooms;
use App\Models\TransaksiReport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CheckinController extends Controller
{
    public function index() : View {
        $RoomData = Rooms::all();
        $Data = [
            'Title'=>'Regular Checking',
            'rooms'=>$RoomData
        ];
        // return view('frontoffice.checkin.normal_checkin', $Data);
        return view('frontoffice.checkin.normal_checkin_table', $Data);
    }
    public function speedy_post(PostSpeedyCheckin $request)
    {
        $getDetailReservation = Reservation::where('reservation_name', $request->reservation_name)
            ->where('reservation_contact', $request->reservation_contact)
            ->where('reservation_checkin', $request->speedy_checkin_time)
            ->where('reservation_checkout', $request->speedy_checkout_time)
            ->get()->first();
        //get details data to insert into checkin
        $invoice = "RR" . date('ymdhis');
        $name_guest = $request->name_guest;
        $id_type = $request->id_type;
        $id_number = $request->id_number;
        $Guest = Guest::where('id_type', $id_type)
            ->where('id_number', $id_number)->first();
        if (!$Guest) {
            //if not exist store guest data to guest table and get the primary key that inserted
            $GuestData = [
                'name_guest' => $request->name_guest,
                'id_type' => $request->id_type,
                'id_number' => $request->id_number,
                'date_of_birth' => $request->date_of_birth,
                'place_of_birth' => $request->place_of_birth,
                'guest_gender' => $request->gender,
                'guest_religion' => $request->religion,
                'guest_title' => $request->title,
                'guest_country' => $request->country,
                'guest_province' => $request->province,
                'guest_city' => $request->city,
                'guest_postalcode' => $request->postal_code,
                'guest_email' => $request->email_address,
                'guest_contact' => $request->telp_number,
                // 'id_img'=>$request->document  @todo : not implemented yet
            ];
            $Guest =  Guest::create($GuestData);
            $guest_id = $Guest->id;
        } else {
            $guest_id = $Guest->id;
        }

        $checkinData = [
            'reservation_id' => $getDetailReservation->id,
            'no_invoice' => $invoice,
            'room_id' => $getDetailReservation->room_id,
            'chanel_checkin' => $getDetailReservation->reservation_chanel,
            'date_checkin' => $getDetailReservation->reservation_checkin,
            'time_checkin' => $getDetailReservation->speedy_checkin_hour,
            'date_checkout' => $getDetailReservation->reservation_checkout,
            'guest_id' => $guest_id,
            'guest_adult' => $request->number_of_adult,
            'guest_kids' => $request->number_of_children,
            'payment_status' => $getDetailReservation->reservation_payment_status,
            'payment' => $getDetailReservation->reservation_payment,
            'payment_method' => $getDetailReservation->reservation_payment_method,
            'tax_price' => $getDetailReservation->tax_payment,
            'extrabed_price' => $getDetailReservation->extrabed_payment,
            'deposit_type' => $request->jenis_deposit
        ];



        if ($request->jenis_deposit == "Cash") {
            $checkinData['deposit'] = $request->deposit;
        } else {
            $checkinData['deposit_lain'] = $request->deposit_lain;
        }
        if ($Checkin = Checkin::create($checkinData)) {
            //get room detil
            $Rooms = Rooms::find($getDetailReservation->room_id);
            $Rooms->room_status = 'OCCUPIED';
            $Rooms->save();
            $days = daysInterval($getDetailReservation->reservation_checkin, $getDetailReservation->reservation_checkout);
            //insert detail checkin
            $DetailCheckin = [
                'checkin_id' => $Checkin->id,
                'item_category' => 'Rooms',
                'item_name' => $Rooms->room_name,
                'item_price' => $Rooms->room_price,
                'item_qty' => $days,
                'item_description' => "Item Speedy Checkin"
            ];
            CheckinDetail::create($DetailCheckin);
            //insert checkin detail if extrabed exist
            if ($getDetailReservation->extrabed_payment > 0) {
                $DetailCheckin = [
                    'checkin_id' => $Checkin->id,
                    'item_category' => 'Extrabed',
                    'item_name' => 'Extrabed',
                    'item_price' => $getDetailReservation->extrabed_payment,
                    'item_qty' => 1,
                    'item_description' => "Item Speedy Checkin"
                ];
                CheckinDetail::create($DetailCheckin);
            }
            if($getDetailReservation->reservation_chanel != 'Walk-in' || $getDetailReservation->reservation_chanel != 'Phone-in'){
                $jenis_pembayaran  = 'Ota';
            }else{
                $jenis_pembayaran = strtolower($getDetailReservation->reservation_payment_method);
            }
            $transactionData = [
                'tabel_referensi' => 'checkins',
                'id_referensi' => $Checkin->id,
                'type_transaksi' => 'credit',
                'jenis_transaksi' => 'rooms',
                'besar_transaksi' => $getDetailReservation->total_payment + $getDetailReservation->tax_payment + $getDetailReservation->tax_payment,
                'keterangan_transaksi' => 'Checkin for ' . $name_guest,
                'jenis_pembayaran' => $jenis_pembayaran
            ];
            TransaksiReport::create($transactionData);
            //set reservation checkedin
            $getDetailReservation->reservation_status = 'Checked-in';
            $getDetailReservation->save();
            $pdfController = new PdfController();
            $receipt = $pdfController->getReceipt($Checkin->id);
            if ($receipt instanceof BinaryFileResponse) {
                return redirect()->route('dashboard')->with('download_url', route('receipt.download', ['id' => $Checkin->id]));
            }
        }
    }
    public function speedy()
    {
        $Data = [
            'Title' => 'Speedty Check-in',
        ];
        return view('frontoffice.checkin.speedy_checkin_form', $Data);
    }
    public function form_normal($id): View
    {
        $Room = Rooms::find($id);
        $invoice = "RR" . date('ymdhis');
        $Settings = LatePointSetting::first();
        $Data = [
            'Room' => $Room,
            'no_invoice' => $invoice,
            'checkin_time' => date('Y-m-d'),
            'Settings'=>$Settings
        ];
        // return view('frontoffice.checkin.normal_checkin_form', $Data);
        return view('frontoffice.checkin.normal_checkin_form_new', $Data);
    }

    public function store(NormalCheckinRequest $request)
    {
        //store or get guest information before create checkin event
        //get guest info
        $name_guest = $request->name_guest;
        $id_type = $request->id_type;
        $id_number = $request->id_number;
        $Guest = Guest::where('id_type', $id_type)
            ->where('id_number', $id_number)->first();
        if (!$Guest) {
            //if not exist store guest data to guest table and get the primary key that inserted
            $GuestData = [
                'name_guest' => $request->name_guest,
                'id_type' => $request->id_type,
                'id_number' => $request->id_number,
                'date_of_birth' => $request->date_of_birth,
                'place_of_birth' => $request->place_of_birth,
                'guest_gender' => $request->gender,
                'guest_religion' => $request->religion,
                'guest_title' => $request->title,
                'guest_country' => $request->country,
                'guest_province' => $request->province,
                'guest_city' => $request->city,
                'guest_postalcode' => $request->postal_code,
                'guest_email' => $request->frm_email,
                'guest_contact' => $request->telp_number,
                // 'id_img'=>$request->document  @todo : not implemented yet
            ];
            $Guest =  Guest::create($GuestData);
            $guest_id = $Guest->id;
        } else {
            $guest_id = $Guest->id;
        }

        //checkin info
        $checkin = $request->checkin_time;
        $checkout = $request->checkout_time;
        $children = $request->number_of_children;
        $adults = $request->number_of_adult;
        $channel = $request->channel;
        $checkinHour = $request->checkinHour;
        $checkoutHour = $request->checkout_hour;

        //create data checkin
        $CheckinDetail = [
            'reservation_id' => $request->reservation_id ?? null,
            'no_invoice' => $request->invoice,
            'room_id' => $request->room_id,
            'guest_id' => $guest_id,
            'chanel_checkin' => $channel,
            'date_checkin' => $checkin,
            'time_checkin' => $checkinHour,
            'date_checkout' => $checkout,
            'time_checkout' => $checkoutHour,
            'guest_adult' => $adults,
            'guest_kids' => $children,
            'is_extrabed'=> $request->extrabed ?? 0,
            'payment_status' => 'DEPOSIT',
            'payment' => $request->total_price,
            'payment_method' => $request->payment_method,
            'tax_price' => $request->tax,
            'extrabed_price' => $request->extrabed_price,
            'deposit' => $request->deposit
        ];
        if($request->deposit_type == 'Cash'){
            $CheckinDetail['deposit_type'] = 'Cash';
            $CheckinDetail['deposit'] = $request->deposit;
        }else{
            $CheckinDetail['deposit_type'] = 'Lain-lain';
            $CheckinDetail['deposit_lain'] = $request->deposit_lain;
        }

        if ($Checkin = Checkin::create($CheckinDetail)) {

            //get room detil
            $Rooms = Rooms::find($request->room_id);
            $Rooms->room_status = 'OCCUPIED';
            $Rooms->save();
            $days = daysInterval($checkin, $checkout);
            //insert detail checkin
            $DetailCheckin = [
                'checkin_id' => $Checkin->id,
                'item_category' => 'Rooms',
                'item_name' => $Rooms->room_name,
                'item_price' => $Rooms->room_price,
                'item_qty' => $days,
                'item_description' => "Item Default Checkin"
            ];
            CheckinDetail::create($DetailCheckin);
            if($request->extrabed){
                $extrabed_price = $this->getExtrabedPrice();
                $DetailCheckin = [
                    'checkin_id' => $Checkin->id,
                    'item_category' => 'Extra Bed',
                    'item_name' => 'Extra Bed',
                    'item_price' => $extrabed_price,
                    'item_qty' =>1,
                    'item_description' => "Item Extra Bed"
                ];
                CheckinDetail::create($DetailCheckin);
            }
            $return = ['status' => 'success', 'message' => 'Checkin untuk ' . $name_guest . ' Berhasil'];
            //save transaction report
            if($$channel != 'Walk-in' || $channel != 'Phone-in'){
                $jenis_pembayaran  = 'Ota';
            }else{
                $jenis_pembayaran = strtolower($request->payment_method);
            }
            $transactionData = [
                'tabel_referensi' => 'checkins',
                'id_referensi' => $Checkin->id,
                'type_transaksi' => 'credit',
                'jenis_transaksi' => 'rooms',
                'besar_transaksi' => $request->total_price - $request->deposit,
                'keterangan_transaksi' => 'Checkin for ' . $name_guest,
                'jenis_pembayaran' => $jenis_pembayaran
            ];
            TransaksiReport::create($transactionData);
            //do download & print invoice
            //here we gona create invoice pdf
            $pdfController = new PdfController();
            $receipt = $pdfController->getReceipt($Checkin->id);
            if ($receipt instanceof BinaryFileResponse) {
                return redirect()->route('dashboard')->with('download_url', route('receipt.download', ['id' => $Checkin->id]));
            }
            return redirect()->route('dashboard')->with($return);
        }
    }
    public function generateInvoice($checking_id) {
        $checkin_info = Checkin::find($checking_id);
        $invoice = $checkin_info->no_invoice;
        $room = Rooms::find($checkin_info->room_id);
        $guest = Guest::find($checkin_info->guest_id);

        $data = [
            'invoice' => $checkin_info->no_invoice,
            'room_name' => $room->room_name,
            'room_price' => $room->room_price,
            'guest_name' => $guest->name_guest,
            'guest_contact' => $guest->guest_contact,
            'guest_email' => $guest->guest_email,
            'checkin_date' => $checkin_info->date_checkin_info,
            'checkout_date' => $checkin_info->date_checkout,
            'adults' => $checkin_info->guest_adult,
            'children' => $checkin_info->guest_kids,
            'total_payment' => $checkin_info->payment,
        ];

        // $pdf = Pdf::loadview('pdf.invoice', compact('checkin_info', 'data', 'room', 'guest'));
        // return $pdf->download($invoice.'.pdf');
        return view('pdf.invoice', compact('checkin_info', 'data', 'room', 'guest'));
    }
}
