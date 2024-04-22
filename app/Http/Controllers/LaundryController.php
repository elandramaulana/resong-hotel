<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostLaundryRequest;
use App\Models\CheckinDetail;
use App\Models\DetLaundry;
use App\Models\Laundry;
use Illuminate\Http\Request;

use function Laravel\Prompts\select;

class LaundryController extends Controller
{
    public function index(){
        $ListLaundry = Laundry::join('det_laundries', 'det_laundries.laundry_id', '=', 'laundries.id')
                                ->where('checkin_id', '!=', null)
                                ->sum('det_laundries.det_laundry_price')
                                ->groupBy('laundries.id')
                                ->get();
        $Data = [
            'Title'=>'List Laundry',
            'listlaundry'=>""
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
