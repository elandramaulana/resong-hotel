<?php

namespace App\Http\Controllers;

use App\Models\LaundryCat;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function detCatLaundryByID(Request $request) {
        $cat_id = $request->cat_id;
        //get detail cat laundry
        $data = LaundryCat::find($cat_id);
        if($data){
            return response()->json(['status'=>'success', 'data'=>$data]);
        }else{
            return response()->json(['status'=>'fail']);
        }
    }
}
