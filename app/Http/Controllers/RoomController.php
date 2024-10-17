<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index() {
        $rooms = Rooms::all();
        return view('frontoffice.rooms.room_list', compact('rooms'));
    }
    
    public function add(Request $request) {
        return view('frontoffice.rooms.add_room');
    }

    public function store(){
        
    }
    
    public function edit() {
        
    }
    
    public function update() {
        
    }

    public function destroy() {
        
    }
    
}
