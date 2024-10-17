<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\KaryawanResource;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        try {
            $karyawans = Karyawan::all();
            $karyawansTotal = $karyawans->count();
            return new KaryawanResource(true, 'Data Karyawan', compact('karyawans', 'karyawansTotal'));
        } catch (\Exception $e) {
            return new KaryawanResource(false, $e->getMessage(), null);
        }
    }
}
