<?php

namespace App\Http\Controllers;

use App\Models\RoomCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RoomtypeController extends Controller
{
    public function index(){
        $roomcat = RoomCategory::all();
        return view('frontoffice.rooms.room_category', compact('roomcat'));
    }

    public function add() {
        return view('frontoffice.rooms.add_roomcat');
    }

    public function store(Request $request){
        $data  = [
            'name_category'=>$request->get('name_category'),
        ];

        RoomCategory::create($data);


        Alert::success('Success', 'Kategori Room Berhasil Ditambahkan');
        return redirect()->route('daftar.roomcat');
        
    }
    
    public function edit($id) {
        $roomcat = RoomCategory::findOrFail($id);
        return view('frontoffice.rooms.edit_roomcat', compact('roomcat'));
    }
    
    public function update(Request $request, $id) {
        $request->validate([
            'name_category' => 'required',
        ]);

        $roomcat = RoomCategory::findOrFail($id);

        $roomcat->name_category = $request->name_category;
        $roomcat->save();
        Alert::success('success', 'Kategori berhasil di Update');
      return redirect()->route('daftar.roomcat');
    }

    public function destroy($id) {
        $roomcat = RoomCategory::findOrFail($id);
       
    
        // Hapus data post
        $roomcat->delete();
    
        Alert::success('Success', 'Kategori Berhasil Dihapus');
         return redirect()->route('daftar.roomcat');
    }
}
