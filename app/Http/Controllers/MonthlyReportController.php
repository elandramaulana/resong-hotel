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
        // Filter input
        $tahun         = $request->input('tahun');
        $tanggalAwal   = $request->input('tanggal_awal'); // format: YYYY-MM-DD
        $tanggalAkhir  = $request->input('tanggal_akhir');  // format: YYYY-MM-DD

        // Ambil semua transaksi berdasarkan filter tahun dan rentang tanggal
        $allTransactions = DB::table('transaction_reports as t')
            ->when($tahun, function ($query, $tahun) {
                return $query->whereYear('t.created_at', $tahun);
            })
            ->when($tanggalAwal && $tanggalAkhir, function ($query) use ($tanggalAwal, $tanggalAkhir) {
                return $query->whereBetween('t.created_at', [$tanggalAwal, $tanggalAkhir]);
            })
            ->get();

        // Ambil ID untuk transaksi checkin
        $checkinIDs = $allTransactions
            ->where('tabel_referensi', 'checkins')
            ->pluck('id_referensi')
            ->unique()
            ->values();

        // Query detail checkin dari tabel checkins, join ke rooms, guests, dll.
        $checkinCheckoutTransactions = DB::table('transaction_reports as t')
            ->whereIn('t.id_referensi', $checkinIDs)
            ->where('t.tabel_referensi', 'checkins')
            ->leftJoin('checkins as c', 't.id_referensi', '=', 'c.id')
            ->leftJoin('checkouts as co', 'c.id', '=', 'co.checkin_id')
            ->leftJoin('rooms as r', 'c.room_id', '=', 'r.id')
            ->leftJoin('guests as g', 'c.guest_id', '=', 'g.id')
            ->select(
                't.*',
                'c.date_checkin',
                'c.date_checkout',
                'c.guest_adult',
                'c.guest_kids',
                'r.room_no',
                'g.name_guest'
            )
            ->get();

        $otherTransactions = $allTransactions->filter(function ($item) {
            return $item->tabel_referensi !== 'checkins';
        });

        // Gabungkan transaksi checkin dan non-checkin
        $transactions = $checkinCheckoutTransactions->merge($otherTransactions);

        $checkinTransactions = $transactions->filter(function ($t) {
            return $t->tabel_referensi === 'checkins'
                && !empty($t->date_checkin)
                && !empty($t->date_checkout);
        });

        $nonCheckinTrans = $transactions->filter(function ($t) {
            return $t->tabel_referensi !== 'checkins';
        });

        $dataByDate = [];

        // Proses transaksi checkin
        $checkinTransactions->each(function ($t) use (&$dataByDate) {
            $date = Carbon::parse($t->date_checkin)->format('Y-m-d');
            $org = $t->guest_adult + $t->guest_kids;
            $days = Carbon::parse($t->date_checkout)->diffInDays(Carbon::parse($t->date_checkin));
            $income = $t->besar_transaksi;

            if (!isset($dataByDate[$date])) {
                $dataByDate[$date] = [
                    'date'            => $date,
                    'org'             => 0,
                    'hr'              => 0,
                    'km'              => 0,
                    'rekapan_jumlah'  => 0,
                    'pembayaran_cash' => 0,
                    'pembayaran_card' => 0,
                    'pembayaran_ota'  => 0,
                ];
            }

            $dataByDate[$date]['org'] += $org;
            $dataByDate[$date]['hr']  += $days;
            $dataByDate[$date]['km']  += 1;
            $dataByDate[$date]['rekapan_jumlah'] += $income;

            if (isset($t->jenis_pembayaran)) {
                // Gunakan strtolower dan trim agar pengecekan tidak dipengaruhi kapital
                $method = strtolower(trim($t->jenis_pembayaran));
                if ($method === 'cash') {
                    $dataByDate[$date]['pembayaran_cash'] += $income;
                } elseif ($method === 'card' || $method === 'credit') {
                    $dataByDate[$date]['pembayaran_card'] += $income;
                } elseif ($method === 'ota') {
                    $dataByDate[$date]['pembayaran_ota'] += $income;
                }
            }
        });

        // Proses transaksi non-checkin (misalnya laundry, lainnya)
        $nonCheckinTrans->each(function ($t) use (&$dataByDate) {
            $date = Carbon::parse($t->created_at)->format('Y-m-d');
            $income = $t->besar_transaksi;

            if (!isset($dataByDate[$date])) {
                $dataByDate[$date] = [
                    'date'            => $date,
                    'org'             => 0,
                    'hr'              => 0,
                    'km'              => 0,
                    'rekapan_jumlah'  => 0,
                    'pembayaran_cash' => 0,
                    'pembayaran_card' => 0,
                    'pembayaran_ota'  => 0,
                ];
            }

            $dataByDate[$date]['rekapan_jumlah'] += $income;

            if (isset($t->jenis_pembayaran)) {
                $method = strtolower(trim($t->jenis_pembayaran));
                if ($method === 'cash') {
                    $dataByDate[$date]['pembayaran_cash'] += $income;
                } elseif ($method === 'card' || $method === 'credit') {
                    $dataByDate[$date]['pembayaran_card'] += $income;
                } elseif ($method === 'ota') {
                    $dataByDate[$date]['pembayaran_ota'] += $income;
                }
            }
        });

        // Urutkan data berdasarkan tanggal
        ksort($dataByDate);
        $dataByDate = array_values($dataByDate);

        $total = [
            'org'                => 0,
            'hr'                 => 0,
            'km'                 => 0,
            'rekapan_jumlah'     => 0,
            'pembayaran_card'    => 0,
            'pembayaran_cash'    => 0,
            'pembayaran_ota'     => 0,
        ];

        foreach ($dataByDate as $data) {
            $total['org']             += $data['org'];
            $total['hr']              += $data['hr'];
            $total['km']              += $data['km'];
            $total['rekapan_jumlah']  += $data['rekapan_jumlah'];
            $total['pembayaran_card'] += $data['pembayaran_card'];
            $total['pembayaran_cash'] += $data['pembayaran_cash'];
            $total['pembayaran_ota']  += $data['pembayaran_ota'];
        }

        $transaksiByDate = [];

        // Kelompokkan transaksi berdasarkan tanggal
        foreach ($transactions as $transaction) {
            $date = Carbon::parse($transaction->created_at)->format('Y-m-d');

            if (!isset($transaksiByDate[$date])) {
                $transaksiByDate[$date] = [
                    'date'   => $date,
                    'debit'  => 0,
                    'kredit' => 0,
                    'cash'   => 0,
                    'card'   => 0,
                    'ota'    => 0,
                ];
            }

            // Pisahkan berdasarkan tipe transaksi (debit/credit)
            if (isset($transaction->type_transaksi)) {
                $type = strtolower(trim($transaction->type_transaksi));
                if ($type === 'debit') {
                    $transaksiByDate[$date]['debit'] += $transaction->besar_transaksi;
                } elseif ($type === 'credit') {
                    $transaksiByDate[$date]['kredit'] += $transaction->besar_transaksi;
                }
            }

            // Pisahkan berdasarkan metode pembayaran (cash, card/credit, ota)
            if (isset($transaction->jenis_pembayaran)) {
                $payMethod = strtolower(trim($transaction->jenis_pembayaran));
                if ($payMethod === 'cash') {
                    $transaksiByDate[$date]['cash'] += $transaction->besar_transaksi;
                } elseif ($payMethod === 'card' || $payMethod === 'credit') {
                    $transaksiByDate[$date]['card'] += $transaction->besar_transaksi;
                } elseif ($payMethod === 'ota') {
                    $transaksiByDate[$date]['ota'] += $transaction->besar_transaksi;
                }
            }
        }

        ksort($transaksiByDate);
        $transaksiByDate = array_values($transaksiByDate);

        $totalTransaksi = [
            'debit'  => 0,
            'kredit' => 0,
            'cash'   => 0,
            'card'   => 0,
            'ota'    => 0,
        ];

        foreach ($transaksiByDate as $row) {
            $totalTransaksi['debit']  += $row['debit'];
            $totalTransaksi['kredit'] += $row['kredit'];
            $totalTransaksi['cash']   += $row['cash'];
            $totalTransaksi['card']   += $row['card'];
            $totalTransaksi['ota']    += $row['ota'];
        }

        return view('frontoffice.report.monthly_report', compact(
            'tahun',
            'tanggalAwal',
            'tanggalAkhir',
            'dataByDate',
            'total',
            'transaksiByDate',
            'totalTransaksi'
        ));
    }
}
