<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostLaundryRequest;
use App\Models\Checkin;
use App\Models\CheckinDetail;
use App\Models\DetLaundry;
use App\Models\Laundry;
use App\Models\LaundryGuest;
use App\Models\LaundryLinen;
use App\Models\TransaksiReport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class LaundryController extends Controller
{
    public function index_guest() {
        $query = Checkin::leftJoin('checkouts', 'checkouts.checkin_id', '=', 'checkins.id')
                            ->join('rooms', 'rooms.id', '=', 'checkins.room_id')
                            ->join('guests', 'guests.id', '=', 'checkins.guest_id')
                            ->where('checkouts.id', null)
                            ->select('checkins.*','checkins.id as checkin_id', 'rooms.room_no', 'guests.name_guest')
                            ->get();
        $Data = [
            'Title' => 'List Laundry Guest',
            'checkin'=>$query
        ];
        return view('laundry.laundry_guest', $Data);

    }
    public function laundry_new_linen_store(Request $request) {
        LaundryLinen::create([
            'nama_item' => $request->nama_item,
            'jumlah_satuan' => $request->jumlah_satuan,
            'tgl_keluar' => $request->tgl_keluar,
            'user_id_keluar' => Auth::id(),
        ]);
        return redirect()->route('laundry')->with('success', 'Data Laundry Berhasil dinput');
    }
    public function laundry_new_guest_store(Request $request)  {
        $detCheckin = Checkin::find($request->checkin_id);
        LaundryGuest::create([
            'checkin_id' => $request->checkin_id,
            'room_id' => $detCheckin->room_id,
            'jenis_laundry' => $request->jenis_laundry,
            'catatan'=>$request->catatan,
            'fo_user_id_keluar' => Auth::id(),
            'tgl_laundry_keluar'=>$request->tgl_keluar,
            'status'=>'keluar'
        ]);
        return redirect()->route('laundry.guest')->with('success', 'Data Laundry Berhasil dinput');
    }

    public function laundry_linen_store(Request $request) {
        $dataLinen = LaundryLinen::find($request->laundry_id);
        $dataLinen->tgl_masuk = $request->tgl_masuk;
        $dataLinen->user_id_masuk = Auth::id();
        $dataLinen->status = 'masuk';
        $dataLinen->harga = $request->harga;
        $dataLinen->save();
        //insert to transaction_report
        $dataTransaction = [
            'tabel_referensi'=>'laundry_linens',
            'id_referensi'=>$request->laundry_id,
            'type_transaksi'=>'debit',
            'jenis_transaksi'=>'Laundry Linen',
            'besar_transaksi'=>$request->harga,
            'keterangan_transaksi'=>'Pembayaran Laundry '. $dataLinen->nama_item,
            'jenis_pembayaran'=>'Cash'
        ];
        TransaksiReport::create($dataTransaction);
        return redirect()->route('laundry')->with('success', 'Data Laundry Berhasil Diubah');
    }
    public function laundry_guest_store(Request $request) {
        $dataGuest = LaundryGuest::find($request->laundry_id);
        $dataGuest->tgl_laundry_masuk = $request->tgl_masuk;
        $dataGuest->fo_user_id_masuk = Auth::id();
        $dataGuest->status = 'masuk';
        $dataGuest->harga = $request->harga;
        if($dataGuest->save()){
//insert to transaction_report
            $dataTransaction = [
                'tabel_referensi'=>'laundry_guests',
                'id_referensi'=>$request->laundry_id,
                'type_transaksi'=>'kredit',
                'jenis_transaksi'=>'Laundry Guest',
                'besar_transaksi'=>$request->harga,
                'keterangan_transaksi'=>'Pembayaran Laundry Guest',
                'jenis_pembayaran'=>'Cash'
            ];
            TransaksiReport::create($dataTransaction);
            return redirect()->route('laundry.guest')->with('success', 'Data Laundry Berhasil Diubah');
        }


    }
    public function dt_laundry_guest(Request $request) {
        $filters = $request->input('filters', []);
        $data = LaundryGuest::orderBy('created_at', 'desc');
        $data->join('checkins', 'laundry_guests.checkin_id', '=', 'checkins.id');
        $data->join('rooms', 'checkins.room_id', '=', 'rooms.id');
        $data->join('guests', 'checkins.guest_id', '=', 'guests.id');
        $data->addSelect('laundry_guests.*', 'checkins.room_id', 'rooms.room_name', 'guests.name_guest', 'guests.id as guest_id');
        $data = $data->get();
        foreach ($data as $key) {
            $pengirim = $this->getName($key->fo_user_id_keluar);
            $penerima = $this->getName($key->fo_user_id_masuk);
            $return[] = [
                'catatan' => $key->catatan,
                'name_guest' => $key->name_guest,
                'room'=>$key->room_name,
                'jenis_laundry'=>$key->jenis_laundry,
                'pengirim'=>$pengirim,
                'tgl_laundry_keluar'=>date('d F Y', strtotime($key->tgl_laundry_keluar)),
                'penerima'=>$penerima,
                'tgl_laundry_masuk'=> $key->tgl_laundry_masuk ? date('d F Y', strtotime($key->tgl_laundry_masuk)) : '',
                'harga'=>'Rp. ' . number_format($key->harga, 0, ',', '.'),
                'action'=> $key->status == 'keluar' ? '<a href="javascript:void(0)" class="btn btn-sm btn-success btn-masuk" data-toggle="modal" data-id="' . $key->id . '" data-target="#setMasuk" title="Sudah Diterima"><i class="fas fa-check"></i></a>' : '',
                'status'=>$key->laundry_status,
            ];
        }
        return response()->json($return);
    }
    public function list_laundry(Request $request)
    {
        $filters = $request->input('filters', []);

        // Query data based on filters
        $data = LaundryLinen::orderBy('created_at', 'desc');

        // if (!empty($filters)) {
        //     $query->whereIn('laundry_type', $filters);
        // }

        $data = $data->get();
        foreach ($data as $key) {
            $price = $this->getSumPrice($key->laundry_id);
            $pengirim = $this->getName($key->user_id_keluar);
            $penerima = $this->getName($key->user_id_masuk);
            $return[] = [
                'keterangan' => $key->nama_item,
                'jumlah_satuan'=>$key->jumlah_satuan,
                'tgl_keluar'=>date('d F Y', strtotime($key->tgl_keluar)),
                'pengirim'=>$pengirim,
                'tgl_masuk'=> $key->tgl_masuk ? date('d F Y', strtotime($key->tgl_masuk)) : '',
                'penerima'=>$penerima,
                'harga'=>'Rp. ' . number_format($key->harga, 0, ',', '.'),
                'action'=> $key->status == 'keluar' ? '<a href="javascript:void(0)" class="btn btn-sm btn-success btn-masuk" data-toggle="modal" data-id="' . $key->id . '" data-target="#setMasuk" title="Sudah Diterima"><i class="fas fa-check"></i></a>' : '',
                'invoice_laundry'=>$key->invoice_laundry,
                'status'=>$key->laundry_status,

            ];
        }
        return response()->json($return);
    }
    public function getName($user_id) {
        $query = User::find($user_id);
        return $query ? $query->name : null;
    }
    public function getSumPrice($laundry_id)
    {
        $query = DetLaundry::select(DB::raw('SUM(det_laundry_price * det_laundry_qty) as jumlah'))
            ->where('laundry_id', $laundry_id)
            ->get()->first();
        return $query->jumlah;
    }
    public function index()
    {
        $ListLaundry = Laundry::all();
        $Data = [
            'Title' => 'List Laundry',
            'listlaundry' => $ListLaundry
        ];
        return view('laundry.laundry', $Data);
    }
    public function form()
    {
        $Data = [
            'Title' => 'Form Laundry',
        ];
        return view('laundry.laundry_form', $Data);
    }
    public function Post(PostLaundryRequest $request)
    {
        //craete data laundry first
        $checkin_id = $request->checkin_id ?? null;
        $Laundry = [
            'laundry_type' => $request->laundry_type,
            'checkin_id' => $request->checkin_id,
            'laundry_status' => 'NEW'
        ];
        $CreateLaundry = Laundry::create($Laundry);
        $LaundryID = $CreateLaundry->id;
        //handle multiple input
        $cat_id = $request->send_cat_id;
        $cat_price = $request->send_cat_price;
        $cat_qty = $request->send_cat_qty;
        $cat_desc = $request->send_cat_desc;
        $cat_name = $request->send_cat_name;
        for ($i = 0; $i < count($cat_id); $i++) {
            $laundry_id         = $LaundryID;
            $id_category        = $cat_id[$i];
            $det_laundry_price  = $cat_price[$i];
            $det_laundry_qty    = $cat_qty[$i];
            $det_laundry_desc   = $cat_desc[$i];
            $item_name   = $cat_name[$i];
            //build array for table det_laundry
            $det_laundry[] = [
                'laundry_id' => $laundry_id,
                'id_category' => $id_category,
                'det_laundry_price' => $det_laundry_price,
                'det_laundry_qty' => $det_laundry_qty,
                'det_laundry_desc' => $det_laundry_desc,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            if ($checkin_id != null) {
                $det_checkin[] = [
                    'checkin_id' => $checkin_id,
                    'item_category' => 'Laundry',
                    'item_name' => "[Laundry] " . $item_name,
                    'item_price' => $det_laundry_price,
                    'item_qty' => $det_laundry_qty,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            } else {
                $det_checkin = false;
            }
        }
        //insert into laundry detail
        $createDetLaundry = DetLaundry::insert($det_laundry);

        //insert into chekin_detail if checkin_id != null
        if ($det_checkin) {
            $detCheckin = CheckinDetail::insert($det_checkin);
        }
        $response = ['status' => 'success', 'message' => 'Sukses, Transaksi Laundry Berhasil di simpan'];
        return response()->json($response);
    }
}
