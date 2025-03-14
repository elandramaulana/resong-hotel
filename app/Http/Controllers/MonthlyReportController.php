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
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
    
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
    
        $month = ($bulan && isset($bulanMapping[$bulan])) ? $bulanMapping[$bulan] : null;
    
       
        $allTransactions = DB::table('transaction_reports as t')
            ->when($month, function ($query, $month) {
                return $query->whereMonth('t.created_at', $month);
            })
            ->when($tahun, function ($query, $tahun) {
                return $query->whereYear('t.created_at', $tahun);
            })
            ->get();
    
        
        $checkinIDs = $allTransactions
            ->where('tabel_referensi', 'checkins')
            ->pluck('id_referensi')
            ->unique()
            ->values();
    
        // Query detail checkin dari tabel checkins, join ke rooms, guests, dll
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
    
        // Gabungkan
        $transactions = $checkinCheckoutTransactions->merge($otherTransactions);
    
       
        $checkinTransactions = $transactions->filter(function ($t) {
            return $t->tabel_referensi === 'checkins'
                && !empty($t->date_checkin)
                && !empty($t->date_checkout);
        });
    
        // Sisanya (non-checkin) —> sekadar definisi jika masih mau dipisah
        $nonCheckinTrans = $transactions->filter(function ($t) {
            return $t->tabel_referensi !== 'checkins';
        });
    
        $dataByDate = [];
    
        // -- LOGIKA PERHITUNGAN ORG, KM, HR--
        $checkinTransactions->each(function ($t) use (&$dataByDate) {
            $date = \Carbon\Carbon::parse($t->date_checkin)->format('Y-m-d');
            $org = $t->guest_adult + $t->guest_kids;
            $days = \Carbon\Carbon::parse($t->date_checkout)->diffInDays(\Carbon\Carbon::parse($t->date_checkin));
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
                ];
            }
    
            $dataByDate[$date]['org'] += $org;
            $dataByDate[$date]['hr']  += $days;
            $dataByDate[$date]['km']  += 1;
            $dataByDate[$date]['rekapan_jumlah'] += $income;
    
           
            if (isset($t->jenis_pembayaran)) {
                $method = strtolower(trim($t->jenis_pembayaran));
                if ($method === 'cash') {
                    $dataByDate[$date]['pembayaran_cash'] += $income;
                } elseif ($method === 'card') {
                    $dataByDate[$date]['pembayaran_card'] += $income;
                }
            }
        });
    
        // -- Untuk data non-checkin (laundry, other, dsb), tetap catat pendapatan per tanggal created_at
        $nonCheckinTrans->each(function ($t) use (&$dataByDate) {
            $date = \Carbon\Carbon::parse($t->created_at)->format('Y-m-d');
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
                ];
            }
    
            $dataByDate[$date]['rekapan_jumlah'] += $income;
    
            // Gunakan `jenis_pembayaran` untuk cek cash/card
            if (isset($t->jenis_pembayaran)) {
                $method = strtolower(trim($t->jenis_pembayaran));
                if ($method === 'cash') {
                    $dataByDate[$date]['pembayaran_cash'] += $income;
                } elseif ($method === 'card') {
                    $dataByDate[$date]['pembayaran_card'] += $income;
                }
            }
        });
    
        // Urutkan dataByDate berdasarkan key (tanggal) dan jadikan array numerik
        ksort($dataByDate);
        $dataByDate = array_values($dataByDate);
    
       
        $total = [
            'org'                => 0,
            'hr'                 => 0,
            'km'                 => 0,
            'rekapan_jumlah'     => 0,
            'pembayaran_card'    => 0,
            'pembayaran_cash'    => 0,
        ];
    
        foreach ($dataByDate as $data) {
            $total['org']             += $data['org'];
            $total['hr']              += $data['hr'];
            $total['km']              += $data['km'];
            $total['rekapan_jumlah']  += $data['rekapan_jumlah'];
            $total['pembayaran_card'] += $data['pembayaran_card'];
            $total['pembayaran_cash'] += $data['pembayaran_cash'];
        }
    
      
        $transaksiByDate = [];
    
        foreach ($transactions as $transaction) {
            // Gunakan created_at sebagai acuan grouping
            $date = \Carbon\Carbon::parse($transaction->created_at)->format('Y-m-d');
    
            if (!isset($transaksiByDate[$date])) {
                $transaksiByDate[$date] = [
                    'date'   => $date,
                    'debit'  => 0,
                    'kredit' => 0,
                    'cash'   => 0,
                    'card'   => 0,
                ];
            }
    
            // Pisahkan debit/credit (type_transaksi)
            if (isset($transaction->type_transaksi)) {
                $type = strtolower(trim($transaction->type_transaksi));
                if ($type === 'debit') {
                    $transaksiByDate[$date]['debit'] += $transaction->besar_transaksi;
                } elseif ($type === 'credit') {
                    $transaksiByDate[$date]['kredit'] += $transaction->besar_transaksi;
                }
            }
    
            // Pisahkan cash/card (jenis_pembayaran)
            if (isset($transaction->jenis_pembayaran)) {
                $payMethod = strtolower(trim($transaction->jenis_pembayaran));
                if ($payMethod === 'cash') {
                    $transaksiByDate[$date]['cash'] += $transaction->besar_transaksi;
                } elseif ($payMethod === 'card') {
                    $transaksiByDate[$date]['card'] += $transaction->besar_transaksi;
                }
            }
        }
    
        ksort($transaksiByDate);
        $transaksiByDate = array_values($transaksiByDate);
    
        // Total keseluruhan untuk grouping transaksi
        $totalTransaksi = [
            'debit'  => 0,
            'kredit' => 0,
            'cash'   => 0,
            'card'   => 0,
        ];
    
        foreach ($transaksiByDate as $row) {
            $totalTransaksi['debit']  += $row['debit'];
            $totalTransaksi['kredit'] += $row['kredit'];
            $totalTransaksi['cash']   += $row['cash'];
            $totalTransaksi['card']   += $row['card'];
        }
    
        return view('frontoffice.report.monthly_report', compact(
            'bulan',
            'tahun',
            'dataByDate',
            'total',
            'transaksiByDate',
            'totalTransaksi'
        ));
    }
    
}


//updatettt