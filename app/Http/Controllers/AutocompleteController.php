<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class AutocompleteController extends Controller
{
    public function guests(Request $request){
        $term = $request->input('term');
        $type_identity =$request->input('type_identity');
        $tags = Guest::where('id_type', $type_identity)
                        ->where('id_number', 'LIKE', '%' . $term . '%')
                        ->pluck('id_number');
        return response()->json($tags);
    }

    public function selected_guest(Request $request) {
        $id_type = $request->input('id_type');
        $id_number = $request->input('id_number');

        $Guest = Guest::where('id_type', $id_type)
                        ->where('id_number', $id_number)
                        ->get()->first();
        return response()->json($Guest);
    }

}
