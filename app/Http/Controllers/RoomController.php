<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RoomController extends Controller
{
    public function index() {
        $rooms = Rooms::all();
        return view('frontoffice.rooms.room_list', compact('rooms'));
    }
    
    public function add() {
        return view('frontoffice.rooms.add_room');
    }

    public function store(Request $request){
        $validate = [
            'room_no' => 'required',
            'room_name' => 'required',
            'room_type' => 'required',
            'room_capacity' => 'required',
            'room_extrabed' => 'required',
            'room_price' => 'required',
            'room_status' => 'required',
            'bed_type' => 'required',
        ];

        $data =[
            'room_no' => $request->get('room_no'),
            'room_name' => $request->get('room_name') ,
            'room_type' =>$request->get('room_type') ,
            'room_capacity' =>$request->get('room_capacity') ,
            'room_extrabed' =>$request->get('room_extrabed') ,
            'room_price' =>$request->get('room_price') ,
            'room_status' => 'VACANT READY',
            'bed_type' =>$request->get('bed_type') ,
        ];

        Rooms::create($data);

        Alert::success('success', 'Room berhasil ditambahkan');
        return redirect()->route('daftar.room');
    }
    
    public function edit($id) {
        $rooms = Rooms::findOrFail($id);
        return view('frontoffice.rooms.edit_room', compact('rooms'));
    }
    
    public function update(Request $request, $id) {
        $request->validate([
            'room_no' => 'required',
            'room_name' => 'required',
            'room_type' => 'required',
            'room_capacity' => 'required',
            'room_extrabed' => 'required',
            'room_price' => 'required',
            'room_status' => 'required',
            'bed_type' => 'required',
        ]);
        
        $rooms = Rooms::findOrFail($id);

        $rooms->room_no = $request->room_no;
        $rooms->room_name = $request->room_name;
        $rooms->room_type = $request->room_type;
        $rooms->room_capacity = $request->room_capacity;
        $rooms->room_extrabed = $request->room_extrabed;
        $rooms->room_price = $request->room_price;
        $rooms->room_status = $request->room_status;
        $rooms->bed_type = $request->bed_type;

        $rooms->save();

        Alert::success('success', 'Room berhasil di Update');
        return redirect()->route('daftar.room');
    }

    public function destroy($id) {
        $rooms = Rooms::findOrFail($id);

        $rooms->delete();
        Alert::success('success', 'Room berhasil di Hapus');
        return redirect()->route('daftar.room');
    }
    
}
