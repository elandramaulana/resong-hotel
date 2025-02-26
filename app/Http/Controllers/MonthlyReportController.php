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
        
        $checkinCheckoutTransactions = DB::table('transaction_reports as t')
            ->when($month, function ($query, $month) {
                return $query->whereMonth('t.created_at', $month);
            })
            ->when($tahun, function ($query, $tahun) {
                return $query->whereYear('t.created_at', $tahun);
            })
         
            ->where('t.tabel_referensi', '=', 'checkins')
            ->leftJoin('checkins as c', function ($join) {
                $join->on('t.id_referensi', '=', 'c.id');
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

            // dd($checkinCheckoutTransactions);
        $otherTransactions = DB::table('transaction_reports as t')
            ->when($month, function ($query, $month) {
                return $query->whereMonth('t.created_at', $month);
            })
            ->when($tahun, function ($query, $tahun) {
                return $query->whereYear('t.created_at', $tahun);
            })
            // Batasi hanya transaksi other
            ->where('t.tabel_referensi', '=', 'other_transactions')
            ->leftJoin('other_transactions as ot', function ($join) {
                $join->on('t.id_referensi', '=', 'ot.id');
            })
            ->select(
                't.*',
                'ot.item',
                'ot.qty',
                'ot.harga'
            )
            ->get();
    
        $transactions = $checkinCheckoutTransactions->merge($otherTransactions);
      
        $checkinTransactions = $transactions->filter(function ($transaction) {
            return !empty($transaction->date_checkin) && !empty($transaction->date_checkout);
        });
        $otherTrans = $transactions->filter(function ($transaction) {
            return empty($transaction->date_checkin) || empty($transaction->date_checkout);
        });
       
        $dataByDate = [];

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
                ];
            }
            $dataByDate[$date]['org'] += $org;
            $dataByDate[$date]['hr']  += $days;
            $dataByDate[$date]['km']  += 1; 
            $dataByDate[$date]['rekapan_jumlah'] += $income;
                   
            if (isset($t->jenis_transaksi)) {
                $method = strtolower(trim($t->jenis_transaksi));
                if ($method == 'cash') {
                    $dataByDate[$date]['pembayaran_cash'] += $income;
                } elseif ($method == 'card') {
                    $dataByDate[$date]['pembayaran_card'] += $income;
                }
            }
        });
        
        $otherTrans->each(function ($t) use (&$dataByDate) {
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
                ];
            }
            $dataByDate[$date]['rekapan_jumlah'] += $income;
            if (isset($t->jenis_transaksi)) {
                $method = strtolower(trim($t->jenis_transaksi));
                if ($method == 'cash') {
                    $dataByDate[$date]['pembayaran_cash'] += $income;
                } elseif ($method == 'card') {
                    $dataByDate[$date]['pembayaran_card'] += $income;
                }
            }
        });
        
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

        foreach ($transactions as $transaction) {
            $date = Carbon::parse($transaction->created_at)->format('Y-m-d');
            if (!isset($transaksiByDate[$date])) {
                $transaksiByDate[$date] = [
                    'date'   => $date,
                    'debit'  => 0,
                    'kredit' => 0,
                ];
            }
            if (isset($transaction->type_transaksi)) {
                $type = strtolower($transaction->type_transaksi);
                if ($type === 'debit') {
                    $transaksiByDate[$date]['debit'] += $transaction->besar_transaksi;
                } elseif ($type === 'kredit') {
                    $transaksiByDate[$date]['kredit'] += $transaction->besar_transaksi;
                }
            }
        }
        ksort($transaksiByDate);
        $transaksiByDate = array_values($transaksiByDate);

        $totalTransaksi = [
            'debit'  => 0,
            'kredit' => 0,
        ];
        foreach ($transaksiByDate as $row) {
            $totalTransaksi['debit']  += $row['debit'];
            $totalTransaksi['kredit'] += $row['kredit'];
        }

        return view('frontoffice.report.monthly_report', compact('bulan', 'tahun', 'dataByDate', 'total', 'transaksiByDate', 'totalTransaksi'));
    }
}
