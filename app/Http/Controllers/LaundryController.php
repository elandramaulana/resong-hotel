<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaundryController extends Controller
{
    public function index(){
        $Data = [
            'Title'=>'List Laundry',

        ];
        return view('laundry.laundry', $Data);
    }
    public function form(){
        $Data = [
            'Title'=>'Form Laundry',
        ];
        return view('laundry.laundry_form', $Data);
    }
    public function Post() {
        
    }
}
