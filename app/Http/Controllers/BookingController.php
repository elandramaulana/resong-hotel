<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentStoreRequest;
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
      public function set_no_show(Request $request) {
        //get all new reservation, 
        $reservationList = Reservation::where('reservation_status', 'new')
                                        ->whereDate('reservation_date', '<', now())
                                        ->get();
        $reservationList->each(function ($reservation) {
            $reservation->update(['reservation_status'=>'no_show']);
        });
        $response = ['status'=>'success', 'message'=>"Set Reservation no_show Success"];
        return response()->json($response);
      }
      public function booking_cancel(Request $request) {
        $reservation_id = $request->get('reservation_id');
        $dataReservation = Reservation::find($reservation_id);
        $dataReservation->reservation_status = 'canceled';
        if($dataReservation->save()){
          $response = ['status'=>'success', 'message'=>'Reservasi Berhasil di Batalkan'];
        }else{
          $response = ['status'=>'error', 'message'=>'Reservasi Gagal di Batalkan'];
        }
        return response()->json($response);
      }
      public function reservation_list(Request $request) {
        //get reservation with status new
        $Reservation = Reservation::join('rooms', 'rooms.id', '=', 'reservations.room_id')
                                  ->select('reservations.*', 'rooms.*', 'reservations.id as reservation_id')
                                  ->where('reservation_status','new')
                                  ->get();

        $Data = [
          'Title'=>'Input Detail Reservasi',
          'data'=>$Reservation
        ];
        return view('frontoffice.reservation.reservation_list', $Data);
      }
      public function booking_canceled(Request $request) {
        //get reservation with status new
        $Reservation = Reservation::join('rooms', 'rooms.id', '=', 'reservations.room_id')
                                  ->select('reservations.*', 'rooms.*', 'reservations.id as reservation_id')
                                  ->where('reservation_status','canceled')
                                  ->get();

        $Data = [
          'Title'=>'Input Detail Reservasi',
          'data'=>$Reservation
        ];
        return view('frontoffice.reservation.cancel_reservation_list', $Data);
      }
      public function no_showed(Request $request) {
        //get reservation with status new
        $Reservation = Reservation::join('rooms', 'rooms.id', '=', 'reservations.room_id')
                                  ->select('reservations.*', 'rooms.*', 'reservations.id as reservation_id')
                                  ->where('reservation_status','no_show')
                                  ->get();

        $Data = [
          'Title'=>'Input Detail Reservasi',
          'data'=>$Reservation
        ];
        return view('frontoffice.reservation.noshow_reservation_list', $Data);
      }
      public function booking_store(PaymentStoreRequest $request) {
        //collect data to be store
        $data = [
          'reservation_chanel'=>$request->get('reservation_chanel'),
          'room_id'=>$request->get('room_id'),
          'is_extrabed'=>0,
          'reservation_date'=>date("Y-m-d"),
          'reservation_checkin'=>$request->get('reservation_checkin'),
          'reservation_checkout'=>$request->get('reservation_checkout'),
          'reservation_name'=>$request->get('reservation_name'),
          'reservation_contact'=>$request->get('reservation_contact'),
          'reservation_email'=>$request->get('reservation_email'),
          'qty_guest'=>$request->get('qty_guest'),
          'reservation_payment_status'=>$request->get('reservation_payment_status'),
          'reservation_payment_method'=>$request->get('reservation_payment_method'),
          'reservation_payment'=>$request->get('reservation_payment'),
          'reservation_desc'=>$request->get('reservation_desc'),
          'reservation_status'=>"New"
        ];
        //store to database
        if(Reservation::create($data)){
          $return = ['status'=>'success', 'message'=>'Reservasi untuk '.$request->get('reservation_name').' Berhasil'];
            return redirect()->route('dashboard')->with($return);
        }
      }
      public function pick_room(ReserveRoomRequest $request) {
        $formData = $request->all();
        $request->session()->put('form_data', $formData);
        $data = session('form_data');
        $reservation_checkin = $data['reservation_checkin'];
        $reservation_checkout = $data['reservation_checkout'];
        $qty_guest = $data['qty_guest'] ?? 1;
        $availableRooms = $this->BookingEngine($reservation_checkin, $reservation_checkout, $qty_guest);
        // print_r($availableRooms);

        $Data = [
            'Title'=>'Pilih Kamar',
            'availableRoom'=>$availableRooms,
            'reservation_checkin'=>$reservation_checkin,
            'reservation_checkout'=>$reservation_checkout,
            'qty_guest'=>$qty_guest,
        ];
        return view('frontoffice.reservation.booking_room_number', $Data);
      }

      public function BookingEngine($checkin, $checkout, $qty_guest) {
        $availableRooms = Rooms::whereDoesntHave('reservations', function ($query) use ($checkin, $checkout) {
          $query->where(function ($query) use ($checkin, $checkout) {
              $query->where('reservation_checkin', '<=', $checkin)
                    ->where('reservation_checkout', '>', $checkin);
          })->orWhere(function ($query) use ($checkin, $checkout) {
              $query->where('reservation_checkin', '<', $checkout)
                    ->where('reservation_checkout', '>=', $checkout);
          })->orWhere(function ($query) use ($checkin, $checkout) {
              $query->where('reservation_checkin', '>=', $checkin)
                    ->where('reservation_checkout', '<=', $checkout);
          });
      })->where('room_capacity', '>=', $qty_guest)->get();
        return $availableRooms;
      }

      public function booking_payment($id) {
        $room_detail = Rooms::find($id);
        $dataSession = session('form_data');
        $reservation_checkin = $dataSession['reservation_checkin'];
        $reservation_checkout = $dataSession['reservation_checkout'];
        $detail_tamu = [  
          'reservation_name'=>$dataSession['reservation_name'],
          'reservation_contact'=>$dataSession['reservation_contact'],
          'reservation_email'=>$dataSession['reservation_email'],
          'reservation_chanel'=>$dataSession['reservation_chanel'],
          'qty_guest'=>$dataSession['qty_guest'],
          'reservation_checkin'=>$reservation_checkin,
          'reservation_checkout'=>$reservation_checkout,
          'reservation_desc'=>$dataSession['reservation_desc'] ?? "",
          'qty_hari' =>daysInterval($reservation_checkin,$reservation_checkout)
        ];
        $Data = [
          'Title'=>'Peyment Reservation',
          'room_detail'=>$room_detail,
          'tamu_detail'=>$detail_tamu
      ];
      return view('frontoffice.reservation.booking_payment', $Data);
      }
      public function call_table(Request $request) {
         ## Read value
          $draw = $request->get('draw');
          $start = $request->get("start");
          $rowperpage = $request->get("length"); // Rows display per page

          $columnIndex_arr = $request->get('order');
          $columnName_arr = $request->get('columns');
          $order_arr = $request->get('order');
          $search_arr = $request->get('search');

          $columnIndex = $columnIndex_arr[0]['column']; // Column index
          $columnName = $columnName_arr[$columnIndex]['data']; // Column name
          $columnSortOrder = $order_arr[0]['dir']; // asc or desc
          $searchValue = $search_arr['value']; // Search value
          
          $checkin = $request->get('reservation_checkin');
          $checkout = $request->get('reservation_checkout');
          $qty_guest = $request->get('qty_guest');
            // Custom search filter 
            // $filterLevel = $request->get('filterLevel');
            // if(!empty($searchCity)){
            //     $records->where('user_level',$filterLevel);
            // }    
            // Total records
            $records = Rooms::whereDoesntHave('reservations', function ($query) use ($checkin, $checkout) {
              $query->where(function ($query) use ($checkin, $checkout) {
                  $query->where('reservation_checkin', '<=', $checkin)
                        ->where('reservation_checkout', '>', $checkin);
              })->orWhere(function ($query) use ($checkin, $checkout) {
                  $query->where('reservation_checkin', '<', $checkout)
                        ->where('reservation_checkout', '>=', $checkout);
              })->orWhere(function ($query) use ($checkin, $checkout) {
                  $query->where('reservation_checkin', '>=', $checkin)
                        ->where('reservation_checkout', '<=', $checkout);
              });
          })->where('room_capacity', '>=', $qty_guest)->select('count(*) as allcount');
            // $records = Checkin::leftJoin('checkouts', 'checkins.id','=','checkouts.checkin_id')
            // ->join('rooms', 'rooms.id', '=', 'checkins.room_id')
            // ->join('guests', 'guests.id', '=', 'checkins.guest_id')
            // ->where('checkouts.id', null)->select('count(*) as allcount');

            ## Add custom filter conditions
            // if(!empty($searchCity)){
            //     $records->where('user_level',$filterLevel);
            // }
            $totalRecords = $records->count();
            // Total records with filter
            $records = Rooms::whereDoesntHave('reservations', function ($query) use ($checkin, $checkout) {
              $query->where(function ($query) use ($checkin, $checkout) {
                  $query->where('reservation_checkin', '<=', $checkin)
                        ->where('reservation_checkout', '>', $checkin);
              })->orWhere(function ($query) use ($checkin, $checkout) {
                  $query->where('reservation_checkin', '<', $checkout)
                        ->where('reservation_checkout', '>=', $checkout);
              })->orWhere(function ($query) use ($checkin, $checkout) {
                  $query->where('reservation_checkin', '>=', $checkin)
                        ->where('reservation_checkout', '<=', $checkout);
              });
          })->where('room_capacity', '>=', $qty_guest);
            $records->where(function ($q) use ($columnName_arr, $searchValue) {
                foreach ($columnName_arr as $column) {
                    if ($column['searchable'] == 'true' && strtolower($column['data']) != 'no' && strtolower($column['data']) != 'btn-action') {
                        $q->orWhere($column['data'], 'like', '%' . $searchValue . '%');
                    }
                }
            });
            ## Add custom filter conditions
            // if(!empty($filterLevel)){
            //     $records->where('user_level',$filterLevel);
            // }

      
            $totalRecordswithFilter = $records->count();

            // Fetch records
            $records = Rooms::whereDoesntHave('reservations', function ($query) use ($checkin, $checkout) {
              $query->where(function ($query) use ($checkin, $checkout) {
                  $query->where('reservation_checkin', '<=', $checkin)
                        ->where('reservation_checkout', '>', $checkin);
              })->orWhere(function ($query) use ($checkin, $checkout) {
                  $query->where('reservation_checkin', '<', $checkout)
                        ->where('reservation_checkout', '>=', $checkout);
              })->orWhere(function ($query) use ($checkin, $checkout) {
                  $query->where('reservation_checkin', '>=', $checkin)
                        ->where('reservation_checkout', '<=', $checkout);
              });
          })->where('room_capacity', '>=', $qty_guest)
                                ;
            ## Add custom filter conditions
            // if(!empty($filterLevel)){
            //     $records->where('user_level',$filterLevel);
            // }
            $records->where(function ($q) use ($columnName_arr, $searchValue) {
            foreach ($columnName_arr as $column) {
                if ($column['searchable'] == 'true' && strtolower($column['data']) != 'no' && strtolower($column['data']) != 'btn-action') {
                    $q->orWhere($column['data'], 'like', '%' . $searchValue . '%');
                }
            }
            });
            
            $listData = $records->skip($start)
                                ->take($rowperpage)
                                ->get();

            $data_arr = array();
            $listData->each(function ($user, $index) use ($start) {
            $user->row_number = $start + $index + 1;
            });
            foreach($listData as $item_data){
              $link_checkout = route('booking.payment', $item_data->id);
              $btn_action = "<a class='btn btn-success btn-sm' href='$link_checkout' title='Pilih Room'><i class='fa fa-check'></i> </a>";
              if($item_data->room_extrabed==1){
                $showExtrabed = "<span class='badge badge-success'> <i class='fa fa-check'></i></span>";
              }else{
                $showExtrabed = "<span class='badge badge-danger'> <i class='fa fa-ban'></i></span>";
              }
              $data_arr[] = array(
                  "no" => $item_data->row_number,
                  "room_no" => $item_data->room_no,
                  "room_name" => $item_data->room_name,
                  "room_type" => $item_data->room_type,
                  "room_price" => formatCurrency($item_data->room_price),
                  "room_capacity" => $item_data->room_capacity,
                  "room_extrabed" => $showExtrabed,
                  "btn-action" => $btn_action,
              );
            }
            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordswithFilter,
                "aaData" => $data_arr
            );
        
            return response()->json($response); 
      }
}
