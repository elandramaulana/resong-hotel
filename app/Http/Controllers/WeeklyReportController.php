<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WeeklyReportController extends Controller
{
    public function index()
    {
        $date = request('date') ?? now()->format('Y-m-d');
        // Query untuk Checkin + Checkout
        $checkinCheckoutTransactions = DB::table('transaction_reports as t')
            ->leftJoin('checkins as c', function ($join) {
                $join->on('t.id_referensi', '=', 'c.id')
                    ->where('t.tabel_referensi', '=', 'checkins');
            })
            ->leftJoin('checkouts as co', 'c.id', '=', 'co.checkin_id') // Hubungkan checkin dengan checkout
            ->leftJoin('rooms as r', 'c.room_id', '=', 'r.id')
            ->leftJoin('guests as g', 'c.guest_id', '=', 'g.id')
            // Subquery untuk mendapatkan total laundry per checkin
            ->leftJoin(DB::raw('(
                SELECT lg.room_id, SUM(lg.harga) as total_laundry
                FROM laundry_guests lg
                GROUP BY lg.room_id
            ) as laundry'), 'r.id', '=', 'laundry.room_id')
            ->select(
                't.*',
                'c.no_invoice',
                'c.room_id',
                'c.guest_id',
                'c.chanel_checkin',
                'c.date_checkin',
                'c.date_checkout',
                'c.time_checkin',
                'c.time_checkout',
                'c.guest_adult',
                'c.guest_kids',
                'c.payment_method',
                'r.room_no',
                'r.room_type',
                'r.room_status',
                'r.room_price',
                'g.name_guest',
                'laundry.total_laundry'
                // 'g.guest_email',
                // 'co.checkout_date', // Data checkout terkait checkin
                // 'co.total_payment'
            )
            ->whereDate('t.created_at', $date)
            ->orderBy('c.chanel_checkin', 'asc')
            ->get();

        // Query untuk Other Transactions
        $otherTransactions = DB::table('transaction_reports as t')
            ->leftJoin('other_transactions as ot', function ($join) {
                $join->on('t.id_referensi', '=', 'ot.id')
                    ->where('t.tabel_referensi', '=', 'other_transactions');
            })
            ->leftJoin('laundry_linens as ll', function ($join) {
                $join->on('t.id_referensi', '=', 'll.id')
                    ->where('t.tabel_referensi', '=', 'laundry_linens');
            })
            ->select(
                't.*',
                'ot.item',
                'ot.qty',
                'ot.harga',
                'll.nama_item',
                'll.jumlah_satuan',
                'll.harga as laundry_harga'
            )
            ->whereDate('t.created_at', $date)
            ->get();

        // Gabungkan kedua koleksi menjadi satu
        $transactions = $checkinCheckoutTransactions->merge($otherTransactions);



        return view('frontoffice.report.weekly_report', compact('transactions', 'checkinCheckoutTransactions', 'otherTransactions'));
    }
}
