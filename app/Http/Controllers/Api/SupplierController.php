<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        try {
            $suppliers = Supplier::all();
            $totalSupplier = $suppliers->count();
            return new SupplierResource(true, 'Data Supplier', compact('suppliers', 'totalSupplier'));
        } catch (\Exception $e) {
            return new SupplierResource(false, 'Gagal mendapatkan data supplier', null);
        }
    }
}
