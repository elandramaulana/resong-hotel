<?php

namespace App\Http\Controllers;
use App\Models\TransaksiReport;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MonthlyReportController extends Controller
{
    
    public function index(Request $request)
{
    // Ambil input bulan dan tahun dari request
    $bulan = $request->input('bulan');
    $tahun = $request->input('tahun'); // misalnya "2025"

    // Mapping nama bulan ke angka
    $bulanMapping = [
        'Januari'   => 1,
        'Februari'  => 2,
        'Maret'     => 3,
        'April'     => 4,
        'Mei'       => 5,
        'Juni'      => 6,
        'Juli'      => 7,
        'Agustus'   => 8,
        'September' => 9,
        'Oktober'   => 10,
        'November'  => 11,
        'Desember'  => 12,
    ];

    // Konversi bulan yang dipilih menjadi angka (jika ada)
    $month = ($bulan && isset($bulanMapping[$bulan])) ? $bulanMapping[$bulan] : null;

    // Query untuk transaksi Checkin + Checkout
    $checkinCheckoutTransactions = DB::table('transaction_reports as t')
        ->when($month, function ($query, $month) {
            return $query->whereMonth('t.created_at', $month);
        })
        ->when($tahun, function ($query, $tahun) {
            return $query->whereYear('t.created_at', $tahun);
        })
        ->leftJoin('checkins as c', function ($join) {
            $join->on('t.id_referensi', '=', 'c.id')
                 ->where('t.tabel_referensi', '=', 'checkins');
        })
        ->leftJoin('checkouts as co', 'c.id', '=', 'co.checkin_id')
        ->leftJoin('rooms as r', 'c.room_id', '=', 'r.id')
        ->leftJoin('guests as g', 'c.guest_id', '=', 'g.id')
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
            'g.name_guest'
        )
        ->get();

    // Query untuk Other Transactions
    $otherTransactions = DB::table('transaction_reports as t')
        ->when($month, function ($query, $month) {
            return $query->whereMonth('t.created_at', $month);
        })
        ->when($tahun, function ($query, $tahun) {
            return $query->whereYear('t.created_at', $tahun);
        })
        ->leftJoin('other_transactions as ot', function ($join) {
            $join->on('t.id_referensi', '=', 'ot.id')
                 ->where('t.tabel_referensi', '=', 'other_transactions');
        })
        ->select(
            't.*',
            'ot.item',
            'ot.qty',
            'ot.harga'
        )
        ->get();

    // Gabungkan kedua koleksi menjadi satu
    $transactions = $checkinCheckoutTransactions->merge($otherTransactions);

    // Pisahkan transaksi berdasarkan adanya data checkin & checkout
    $checkinTransactions = $transactions->filter(function ($transaction) {
        return !empty($transaction->date_checkin) && !empty($transaction->date_checkout);
    });

    $otherTrans = $transactions->filter(function ($transaction) {
        return empty($transaction->date_checkin) || empty($transaction->date_checkout);
    });

    // Inisialisasi array untuk mengelompokkan data per tanggal
    // (Key menggunakan format 'Y-m-d')
    $dataByDate = [];

    // Proses transaksi checkin
    $checkinTransactions->each(function ($t) use (&$dataByDate) {
        // Gunakan date_checkin sebagai key
        $date = Carbon::parse($t->date_checkin)->format('Y-m-d');
        // Hitung lama menginap (selisih hari antara checkout dan checkin)
        $days = Carbon::parse($t->date_checkout)->diffInDays(Carbon::parse($t->date_checkin));
        // Total pemasukan dari booking kamar
        $checkinIncome = $t->room_price * $days;
        // Total tamu: guest_adult + guest_kids
        $org = $t->guest_adult + $t->guest_kids;

        // Inisialisasi array data jika belum ada untuk tanggal tersebut
        if (!isset($dataByDate[$date])) {
            $dataByDate[$date] = [
                'date'                => $date,
                'org'                 => 0,
                'hr'                  => 0,
                'km'                  => 0,
                'rekapan_jumlah'      => 0,
                'pembayaran_cash'     => 0,
                'pembayaran_card'     => 0,
            ];
        }
        $dataByDate[$date]['org'] += $org;
        $dataByDate[$date]['hr']  += $days;
        $dataByDate[$date]['km']  += 1; // setiap transaksi checkin mewakili 1 kamar
        $dataByDate[$date]['rekapan_jumlah'] += $checkinIncome;

        // Pisahkan pembayaran berdasarkan metode (cash atau card)
        if (isset($t->payment_method)) {
            $method = strtolower($t->payment_method);
            if ($method == 'cash') {
                $dataByDate[$date]['pembayaran_cash'] += $checkinIncome;
            } elseif ($method == 'card') {
                $dataByDate[$date]['pembayaran_card'] += $checkinIncome;
            }
        }
    });

    // Proses transaksi other (gunakan created_at sebagai tanggal transaksi)
    $otherTrans->each(function ($t) use (&$dataByDate) {
        $date = Carbon::parse($t->created_at)->format('Y-m-d');
        // Total pemasukan dari other transaction (asumsi: qty * harga)
        $otherIncome = $t->qty * $t->harga;
        if (!isset($dataByDate[$date])) {
            $dataByDate[$date] = [
                'date'                => $date,
                'org'                 => 0,
                'hr'                  => 0,
                'km'                  => 0,
                'rekapan_jumlah'      => 0,
                'pembayaran_cash'     => 0,
                'pembayaran_card'     => 0,
            ];
        }
        $dataByDate[$date]['rekapan_jumlah'] += $otherIncome;
        if (isset($t->payment_method)) {
            $method = strtolower($t->payment_method);
            if ($method == 'cash') {
                $dataByDate[$date]['pembayaran_cash'] += $otherIncome;
            } elseif ($method == 'card') {
                $dataByDate[$date]['pembayaran_card'] += $otherIncome;
            }
        }
    });

    // Urutkan data berdasarkan tanggal (key)
    ksort($dataByDate);
    // Ubah ke array numerik untuk iterasi di view
    $dataByDate = array_values($dataByDate);

    return view('frontoffice.report.monthly_report', compact('bulan', 'tahun', 'dataByDate'));
}
    
}
