<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        try {
            $search = $request->input("search");
            $suppliers = Supplier::where('supplier_name', 'like', '%' . $search . '%')->get();
            $totalSupplier = Supplier::count();
            return new SupplierResource(true, 'Data Supplier', compact('suppliers', 'totalSupplier'));
        } catch (\Exception $e) {
            return new SupplierResource(false, 'Gagal mendapatkan data supplier', []);
        }
    }
}
