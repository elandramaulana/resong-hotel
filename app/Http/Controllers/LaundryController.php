<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostLaundryRequest;
use App\Models\CheckinDetail;
use App\Models\DetLaundry;
use App\Models\Laundry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class LaundryController extends Controller
{
    public function list_laundry(Request $request){
        $filters = $request->input('filters', []);

        // Query data based on filters
        $query = Laundry::query();
        $query->leftJoin('checkins', 'checkins.id', '=', 'laundries.checkin_id');
        $query->leftJoin('rooms', 'rooms.id', '=', 'checkins.room_id');
        $query->leftJoin('guests', 'guests.id', '=', 'checkins.guest_id');
        $query->select('checkins.id as checkin_id');
        $query->addSelect('rooms.id as room_id', 'rooms.room_no');
        $query->addSelect('guests.id as guest_id', 'guests.name_guest');
        $query->addSelect('laundries.laundry_type', 'laundries.id as laundry_id');
        if (!empty($filters)) {
            $query->whereIn('laundry_type', $filters);
        }
        $data = $query->get();

        foreach ($data as $key) {
            $price = $this->getSumPrice($key->laundry_id);
            $return[] = [
                'checkin_id'=>$key->checkin_id,
                'room_id'=>$key->room_id,
                'room_no'=>$key->room_no,
                'guest_id'=>$key->guest_id,
                'name_guest'=>$key->name_guest,
                'laundry_id'=>$key->laundry_id,
                'laundry_type'=>$key->laundry_type,
                'total_price'=>formatCurrency($price)
            ];
        }
        return response()->json($return);
    }
    public function getSumPrice($laundry_id){
        $query = DetLaundry::select(DB::raw('SUM(det_laundry_price * det_laundry_qty) as jumlah'))
                    ->where('laundry_id', $laundry_id)
                    ->get()->first();
        return $query->jumlah;
    }
    public function index(){
        $ListLaundry = Laundry::all();
        $Data = [
            'Title'=>'List Laundry',
            'listlaundry'=>$ListLaundry
        ];
        return view('laundry.laundry', $Data);
    }
    public function form(){
        $Data = [
            'Title'=>'Form Laundry',
        ];
        return view('laundry.laundry_form', $Data);
    }
    public function Post(PostLaundryRequest $request) {
        //craete data laundry first
        $checkin_id = $request->checkin_id ?? null;
        $Laundry = [
            'laundry_type'=>$request->laundry_type,
            'checkin_id'=>$request->checkin_id,
            'laundry_status'=>'NEW'
        ];
        $CreateLaundry = Laundry::create($Laundry);
        $LaundryID = $CreateLaundry->id;
        //handle multiple input
        $cat_id = $request->send_cat_id;
        $cat_price = $request->send_cat_price;
        $cat_qty = $request->send_cat_qty;
        $cat_desc = $request->send_cat_desc;
        $cat_name = $request->send_cat_name;
        for ($i=0; $i < count($cat_id); $i++) { 
            $laundry_id         = $LaundryID;
            $id_category        = $cat_id[$i];
            $det_laundry_price  = $cat_price[$i];
            $det_laundry_qty    = $cat_qty[$i];
            $det_laundry_desc   = $cat_desc[$i];
            $item_name   = $cat_name[$i];
            //build array for table det_laundry
            $det_laundry[] = [
                'laundry_id'=>$laundry_id,
                'id_category'=>$id_category,
                'det_laundry_price'=>$det_laundry_price,
                'det_laundry_qty'=>$det_laundry_qty,
                'det_laundry_desc'=>$det_laundry_desc,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            if($checkin_id!=null){
                $det_checkin[] = [
                    'checkin_id'=>$checkin_id,
                    'item_category'=>'Laundry',
                    'item_name'=>"[Laundry] ".$item_name,
                    'item_price'=>$det_laundry_price,
                    'item_qty'=>$det_laundry_qty,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }else{
                $det_checkin = false;
            }
        }
        //insert into laundry detail
        $createDetLaundry = DetLaundry::insert($det_laundry);

        //insert into chekin_detail if checkin_id != null
        if($det_checkin){
            $detCheckin = CheckinDetail::insert($det_checkin);
        }
        $response = ['status'=>'success','message'=>'Sukses, Transaksi Laundry Berhasil di simpan'];
        return response()->json($response);
    }
    
}
