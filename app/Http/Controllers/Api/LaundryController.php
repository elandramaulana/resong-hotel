<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LaundryResource;
use App\Models\Laundry;
use Illuminate\Http\Request;

class LaundryController extends Controller
{
    public function index()
    {
        try {
            $laundry = Laundry::all();
            $laundryTotal = $laundry->count();
            return new LaundryResource(true, 'Data Laundry', compact('laundry', 'laundryTotal'));
        } catch (\Exception $e) {
            return new LaundryResource(false, 'Gagal mendapatkan data laundry', null);
        }
    }
}
