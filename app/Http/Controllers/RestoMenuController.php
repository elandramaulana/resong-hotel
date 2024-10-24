<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRestoRequest;
use App\Models\Checkin;
use App\Models\CheckinDetail;
use App\Models\DetailTransResto;
use App\Models\TransResto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RestoMenuController extends Controller
{
    public function index()
    {
        $Data = [
            'Title' => "List Menu Resto"
        ];

        $data = DB::table('trans_resto')
            ->leftJoin('detail_trans_resto', 'trans_resto.id', '=', 'detail_trans_resto.trans_resto_id')
            ->leftJoin('checkins', 'trans_resto.checkin_id', '=', 'checkins.id')
            ->leftJoin('rooms', 'checkins.room_id', '=', 'rooms.id')
            ->select('trans_resto.guest_name', DB::raw('COALESCE(rooms.room_no, "Tidak Ada") AS room'), DB::raw('SUM(detail_trans_resto.qty * detail_trans_resto.det_price) AS harga'))
            ->groupBy('trans_resto.guest_name', 'rooms.room_no')
            ->get();


        // $resto = Supplier::all();
        return view('inventorykitchen.resto.resto_menu', compact('data'), $Data);
    }

    public function PostResto(PostRestoRequest $request)
    {
        $checkin_id = $request->checkin_id ?? null;
        if ($checkin_id != null) {
            $ModelCheckin = new Checkin();
            $detCheckin = $ModelCheckin->detCheckin($checkin_id);
            $guest_name = $detCheckin->name_guest;
            $guest_contact = $detCheckin->guest_contact;
            $guest_email = $detCheckin->guest_email;
        } else {
            $guest_name = $request->nama_customer;
            $guest_contact = $request->contact_customer;
            $guest_email = $request->customer_email;
        }
        $resto = [
            'checkin_id' => $checkin_id,
            'guest_name' => $guest_name,
            'guest_contact' => $guest_contact,
            'guest_email' => $guest_email,
        ];
        //lakukan insert ke table trans_resto
        $transResto = TransResto::create($resto);
        $idTrans = $transResto->id;
        //proses detail transaksi resto
        $menu_ids = $request->inp_menu_id;
        $menu_qtys = $request->inp_qty;
        $menu_prices = $request->inp_price;
        $menu_names = $request->inp_menu_name;
        for ($i = 0; $i < count($menu_ids); $i++) {
            $menu_id = $menu_ids[$i];
            $menu_qty = $menu_qtys[$i];
            $menu_price = $menu_prices[$i];
            $menu_name = $menu_names[$i];


            $det_resto[] = [
                'trans_resto_id' => $idTrans,
                'menu_id' => $menu_id,
                'qty' => $menu_qty,
                'det_price' => $menu_price,
                'created_at' => now(),
                'updated_at' => now(),
            ];


            if ($checkin_id != null) {
                $det_checkin[] = [
                    'checkin_id' => $checkin_id,
                    'item_category' => 'Resto',
                    'item_name' => $menu_name,
                    'item_price' => $menu_price,
                    'item_qty' => $menu_qty,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            } else {
                $det_checkin = false;
            }
        }

        $createDetTransResto = DetailTransResto::insert($det_resto);

        //insert into chekin_detail if checkin_id true
        if ($det_checkin) {
            $detCheckin = CheckinDetail::insert($det_checkin);
        }
        Alert::success('Success', 'Detail Transaksi Berhasil Ditambahkan');
        return redirect()->route('resto.menu');
    }

    public function room_inhouse_resto()
    {
        //query room checkin id = checkin_id value = room_no
        $query = Checkin::leftJoin('checkouts', 'checkouts.checkin_id', '=', 'checkins.id')
            ->join('rooms', 'rooms.id', '=', 'checkins.room_id')
            ->join('guests', 'guests.id', '=', 'checkins.guest_id')
            ->select('checkins.*', 'checkins.id as checkin_id', 'rooms.room_no', 'guests.name_guest')
            ->get();

        foreach ($query as $data) {
            $show[] = [
                'id' => $data['checkin_id'],
                'text' => $data['room_no'] . ' (' . $data['name_guest'] . ')'
            ];
        }
        echo json_encode($show);
    }



    public function form()
    {
        $Data = [
            'Title' => 'Form Resto',
        ];

        $dayNameMapping = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];

        $englishDayName = Carbon::now()->englishDayOfWeek;
        $dayName = $dayNameMapping[$englishDayName];



        // Query untuk mengambil menu berdasarkan day_name dan status
        $menus = DB::table('detail_daily as dd')
            ->select('dd.menu_id', 'm.menu_name', 'm.menu_price', 'm.menu_photo')
            ->join('menus as m', 'dd.menu_id', '=', 'm.menu_id')
            ->join('daily_menus as dm', 'dd.daily_id', '=', 'dm.id')
            ->where('dm.day_name', $dayName)
            ->where('dm.status', 'Active')
            ->get();

        return view('inventorykitchen.resto.resto_form', compact('menus', 'dayName'), $Data);
    }
}
