<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHistoryCleaningRequest;
use App\Models\CleaningHistory;
use App\Models\Rooms;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HouseKeepingController extends Controller
{
    public function index() {
        $Data = [
            'Title'=>"Room Cleaning"
        ];

        $listRoom = DB::table('rooms')->select('id','room_no','room_type','room_status')
        ->where('room_status','VACANT DIRTY')
        ->get();

        $history = CleaningHistory::all();

        return view('frontoffice.housekeeping.house_keeping', compact('listRoom','history'), $Data);
    }

    public function cleaning_detail($id)
    {
        $room = Rooms::find($id);
        return view('frontoffice.housekeeping.edit_house_keeping',compact('room'));
    }

    public function storeHistory(StoreHistoryCleaningRequest $request)
    {
        
        $data  = [
            'tanggal_cleaning'=> $request->get('tanggal_cleaning'),
            'jam_cleaning'=>$request->get('jam_cleaning'),
            'pic_cleaning'=>$request->get('pic_cleaning'),
            'room_type'=>$request->get('room_type'),
            'room_no'=>$request->get('room_no'),
            'status'=>$request->get('status')
        ];
        CleaningHistory::create($data);
        $room = Rooms::find($request->get('room_id'));
        $room->room_status = "VACANT READY";
        $room->save();
        Alert::success('Success', 'Status Ruangan Berhasil Diperbaharui');
         return redirect()->route('cleaningroom.list');
            
    }

    
}
