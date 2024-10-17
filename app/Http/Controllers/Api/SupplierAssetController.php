<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SupplierAssetResource;
use App\Models\SupplierAsset;
use Illuminate\Http\Request;

class SupplierAssetController extends Controller
{
    public function index()
    {
        try {
            $supplierAssets = SupplierAsset::all();
            $totalSupplierAsset = $supplierAssets->count();
            return new SupplierAssetResource(true, 'Data Supplier Asset', compact('supplierAssets', 'totalSupplierAsset'));
        } catch (\Exception $e) {
            return new SupplierAssetResource(false, 'Gagal mendapatkan data supplier asset', null);
        }
    }
}
