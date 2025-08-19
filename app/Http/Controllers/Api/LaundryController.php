<?php

namespace App\Http\Controllers\Api;

use App\Models\Laundry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\LaundryResource;
use App\Models\LaundryGuest;
use App\Models\LaundryLinen;
use Carbon\Carbon;
use App\Http\Controllers\LaundryController as WebLaundryController;

class LaundryController extends Controller
{
    public function index()
    {
        try {
            $laundry = DB::table('laundries')
                ->leftJoin('det_laundries', 'laundries.id', '=', 'det_laundries.laundry_id')
                ->leftJoin('checkins', 'laundries.checkin_id', '=', 'checkins.id')
                ->leftJoin('rooms', 'checkins.room_id', '=', 'rooms.id')
                ->leftJoin('guests', 'checkins.guest_id', '=', 'guests.id')
                ->select(
                    DB::raw("IFNULL(guests.name_guest, 'Internal') as name_guest"),
                    DB::raw("IFNULL(rooms.room_no, '~') as room_no"),
                    'laundries.laundry_type',
                    'det_laundries.det_laundry_price',
                )
                ->get();
            $laundryTotal = $laundry->count();
            return new LaundryResource(true, 'Data Laundry', compact('laundry', 'laundryTotal'));
        } catch (\Exception $e) {
            return new LaundryResource(false, 'Gagal mendapatkan data laundry', []);
        }
    }

    public function index_guest(Request $request)
    {
        try {
            // Parsing tanggal dari request atau menggunakan default
            $startDate = $request->get('start_date') ? Carbon::parse($request->get('start_date'))->startOfDay() : null;
            $endDate = $request->get('end_date') ? Carbon::parse($request->get('end_date'))->endOfDay() : null;
            $search = $request->input('search');
    
            // Query utama untuk total harga berdasarkan tanggal
            $queryTotal = LaundryGuest::query();
            if ($startDate && $endDate) {
                $queryTotal->whereBetween('created_at', [$startDate, $endDate]);
            }
            $total = $queryTotal->sum('harga'); // Total harga dalam rentang tanggal
    
            // Hitung totalDiproses dan totalSelesai berdasarkan tanggal saja
            $totalDiproses = (clone $queryTotal)->whereNull('fo_user_id_masuk')->orWhereNull('tgl_laundry_masuk')->count();
            $totalSelesai = (clone $queryTotal)->whereNotNull('fo_user_id_masuk')->whereNotNull('tgl_laundry_masuk')->count();
    
            // Query untuk data yang ditampilkan (berdasarkan search & tanggal)
            $query = LaundryGuest::query()
                ->orderBy('created_at', 'desc')
                ->join('checkins', 'laundry_guests.checkin_id', '=', 'checkins.id')
                ->join('rooms', 'checkins.room_id', '=', 'rooms.id')
                ->join('guests', 'checkins.guest_id', '=', 'guests.id')
                ->addSelect(
                    'laundry_guests.*',
                    'checkins.room_id',
                    'rooms.room_name',
                    'guests.name_guest',
                    'guests.id as guest_id'
                );
    
            // Filter berdasarkan tanggal jika ada
            if ($startDate && $endDate) {
                $query->whereBetween('laundry_guests.created_at', [$startDate, $endDate]);
            }
    
            // Filter berdasarkan pencarian
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where("guests.name_guest", "like", "%$search%")
                      ->orWhere("rooms.room_no", "like", "%$search%");
                });
            }
    
            // Ambil data hasil pencarian
            $data = $query->get();
    
            $laundryController = new WebLaundryController();
    
            // Transform data
            $guest = $data->map(function ($item) use ($laundryController) {
                $pengirim = $laundryController->getName($item->fo_user_id_keluar);
                $penerima = $laundryController->getName($item->fo_user_id_masuk);
    
                $status = ($penerima && $item->tgl_laundry_masuk) ? 'Selesai' : 'Diproses';
    
                return [
                    'catatan' => $item->catatan,
                    'name_guest' => $item->name_guest,
                    'room' => $item->room_name,
                    'jenis_laundry' => $item->jenis_laundry,
                    'pengirim' => $pengirim,
                    'tgl_laundry_keluar' => date('d F Y', strtotime($item->tgl_laundry_keluar)),
                    'penerima' => $penerima,
                    'tgl_laundry_masuk' => $item->tgl_laundry_masuk ? date('d F Y', strtotime($item->tgl_laundry_masuk)) : '',
                    'harga' => 'Rp. ' . number_format($item->harga, 0, ',', '.'),
                    'status' => $status,
                ];
            });
    
            return new LaundryResource(true, 'Data Laundry Guest', compact('guest', 'total', 'totalDiproses', 'totalSelesai'));
        } catch (\Exception $e) {
            return new LaundryResource(false, 'Gagal mendapatkan data laundry guest', []);
        }
    }
    
    

    public function index_linen(Request $request) {
        try {
            $startDate = $request->get('start_date') ? Carbon::parse($request->get('start_date'))->startOfDay() : Carbon::now()->startOfMonth();
            $endDate = $request->get('end_date') ? Carbon::parse($request->get('end_date'))->endOfDay() : Carbon::now()->endOfMonth();
            $search = $request->input('search');
            
            // Query utama untuk total harga dan status berdasarkan tanggal
            $queryTotal = LaundryLinen::whereBetween('created_at', [$startDate, $endDate]);
    
            // Total harga linen berdasarkan tanggal (tidak terpengaruh pencarian)
            $total = $queryTotal->sum('harga');
    
            // Hitung jumlah linen yang masih diproses & sudah selesai dalam rentang tanggal
            $totalDiproses = (clone $queryTotal)->whereNull('user_id_masuk')->orWhereNull('tgl_masuk')->count();
            $totalSelesai = (clone $queryTotal)->whereNotNull('user_id_masuk')->whereNotNull('tgl_masuk')->count();
    
            // Query untuk data yang ditampilkan (berdasarkan search & tanggal)
            $query = LaundryLinen::whereBetween('created_at', [$startDate, $endDate])
                ->orderBy('created_at', 'desc');
    
            $data = $query->get();
    
            // Transformasi data
            $linen = $data->map(function ($item) {
                $laundryController = new WebLaundryController();
                $pengirim = $laundryController->getName($item->user_id_keluar);
                $penerima = $laundryController->getName($item->user_id_masuk);
    
                $status = ($penerima && $item->tgl_masuk) ? 'Selesai' : 'Diproses';
    
                return [
                    'keterangan' => $item->nama_item,
                    'jumlah_satuan' => $item->jumlah_satuan,
                    'tgl_keluar' => date('d F Y', strtotime($item->tgl_keluar)),
                    'pengirim' => $pengirim,
                    'tgl_masuk' => $item->tgl_masuk ? date('d F Y', strtotime($item->tgl_masuk)) : '',
                    'penerima' => $penerima,
                    'harga' => 'Rp. ' . number_format($item->harga, 0, ',', '.'),
                    'invoice_laundry' => $item->invoice_laundry,
                    'status' => $status,
                ];
            });
    
            // Filter berdasarkan search tanpa mempengaruhi total harga dan status
            if (!empty($search)) {
                $linen = $linen->filter(function ($item) use ($search) {
                    return stripos($item['keterangan'], $search) !== false || 
                           stripos($item['pengirim'], $search) !== false || 
                           stripos($item['penerima'], $search) !== false;
                })->values(); // Reset keys setelah filter
            }
    
            return new LaundryResource(true, 'Data Laundry Linen', compact('linen', 'total', 'totalDiproses', 'totalSelesai'));
        } catch (\Exception $e) {
            return new LaundryResource(false, 'Gagal mendapatkan data laundry linen', []);
        }
    }
    
}
