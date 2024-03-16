<?php

namespace App\Http\Controllers;

use App\Models\Checkin;
use Illuminate\Http\Request;

class InhouseController extends Controller
{
    public function index() {
        $Data = [
            'Title'=>"Daftar Tamu Checkin"
        ];
        return view('frontoffice.guest.inhouse_guest', $Data);
    }
    public function inhouse_detail($id) {
        $Data = [
            'Title'=>"Detail Checkin"
        ];
        return view('frontoffice.guest.detail_inhouse_guest');
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

        // Custom search filter 
        // $filterLevel = $request->get('filterLevel');
            
        // Total records
        $records = Checkin::leftJoin('checkouts', 'checkins.id','=','checkouts.checkin_id')
        ->join('rooms', 'rooms.id', '=', 'checkins.room_id')
        ->join('guests', 'guests.id', '=', 'checkins.guest_id')
        ->where('checkouts.id', null)->select('count(*) as allcount');

        ## Add custom filter conditions
        // if(!empty($searchCity)){
        //     $records->where('user_level',$filterLevel);
        // }
        $totalRecords = $records->count();
        // Total records with filter
        $records = Checkin::leftJoin('checkouts', 'checkins.id','=','checkouts.checkin_id')
                            ->join('rooms', 'rooms.id', '=', 'checkins.room_id')
                            ->join('guests', 'guests.id', '=', 'checkins.guest_id')
                            ->where('checkouts.id', null)
                            ->select('count(*) as allcount');
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
        $records = Checkin::orderBy($columnName,$columnSortOrder)
                            ->leftJoin('checkouts', 'checkins.id','=','checkouts.checkin_id')
                            ->join('rooms', 'rooms.id', '=', 'checkins.room_id')
                            ->join('guests', 'guests.id', '=', 'checkins.guest_id')
                            ->where('checkouts.id', null)
                            ->select('checkins.*', 'checkins.id as checkin_id')
                            ->addselect('rooms.*', 'rooms.id as room_id')
                            ->addselect('guests.name_guest', 'guests.id as guest_id')
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
           $link_checkout = route('checkout.detail', $item_data->room_id);
           $link_detail = route('inhouse.details', $item_data->checkin_id);
            $btn_action = "<div class='dropdown'>
            <button class='btn btn-warning rounded dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                Select
            </button>
            <ul class='dropdown-menu'>
                <li><a class='dropdown-item' href='$link_detail'>Lihat Detail</a></li>
                <li><a class='dropdown-item' href='$link_checkout'>Checkout</a></li>
            </ul>
            </div>";
            $data_arr[] = array(
                "no" => $item_data->row_number,
                "name_guest" => $item_data->name_guest,
                "room_no" => $item_data->room_no,
                "date_checkin" => $item_data->date_checkin,
                "date_checkout" => $item_data->date_checkin,
                "chanel_checkin" => $item_data->chanel_checkin,
                "payment" => formatCurrency($item_data->payment),
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
