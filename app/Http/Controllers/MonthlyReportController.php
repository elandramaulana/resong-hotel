<?php

namespace App\Http\Controllers;
use App\Models\TransaksiReport;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MonthlyReportController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan');

        $query = TransaksiReport::query();

        $bulanMapping = [
            'Januari' => 1, 'Februari' => 2, 'Maret' => 3, 'April' => 4,
            'Mei' => 5, 'Juni' => 6, 'Juli' => 7, 'Agustus' => 8,
            'September' => 9, 'Oktober' => 10, 'November' => 11, 'Desember' => 12
        ];

        if ($bulan && isset($bulanMapping[$bulan])) {
            $query->whereMonth('created_at', $bulanMapping[$bulan]);
        }

        $transaksi = $query->orderBy('created_at', 'asc')->get();

        // Hitung total transaksi
        $totalTransaksi = $transaksi->sum('besar_transaksi');

        return view('frontoffice.report.monthly_report', compact('transaksi', 'bulan', 'totalTransaksi'));
    }
}
