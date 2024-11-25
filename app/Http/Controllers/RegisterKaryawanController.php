<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegisterKaryawanRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterKaryawanController extends Controller
{
    public function index() {
        return view('pegawai.register_karyawan');
    }

    public function storeUserAcc(Request $request){
        $data = [
            'name' => $request->get('r_nama'),
            'username' => $request->get('r_username'),
            'email' => $request->get('r_email'),
        ];

        $ttl = $request->get('r_ttl'); // Format: 16/12/2001

        // Ambil tiga huruf pertama dari nama dalam huruf kecil
        $namePrefix = strtolower(substr($data['name'], 0, 3));
        
        // Ambil tahun dari ttl
        $yearTtl = Carbon::parse($ttl)->format('Y');
        
        // Ambil tanggal hari ini (tanpa bulan dan tahun)
        $currentDay = Carbon::now()->format('d');
        
        // Gabungkan tahun kelahiran, tanggal hari ini, dan tiga huruf pertama dari nama
        $password = $yearTtl . $currentDay . $namePrefix;
        // dd($password);
    
        // format (tahun lahir + tanggal saat ini + 3 huruf nama awal)
        

        // Simpan data ke database menggunakan model
        $insertData = [
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'level_user' => 'KARYAWAN',
            'password' => bcrypt($password),
        ];

        User::create($insertData);

        Alert::success('Success', 'User Berhasil Didaftarkan');
        return redirect()->route('daftar.karyawan');
    }
}
