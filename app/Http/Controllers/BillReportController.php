<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\BillReport;
use Illuminate\Http\Request;
use App\Models\CheckinDetail;
use App\Models\TransAsset;
use App\Models\TransBarang;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class BillReportController extends Controller
{
    private function detailCheckIn($dateNow, $category, $filterType = 'daily')
    {
        $query = CheckinDetail::where('item_category', $category);

        switch ($filterType) {
            case 'weekly':
                $query->whereBetween('created_at', [$dateNow->startOfWeek(), $dateNow->endOfWeek()]);
                break;
            case 'monthly':
                $query->whereMonth('created_at', $dateNow->month);
                break;
            default:
                $query->whereDate('created_at', $dateNow);
        }

        return $query->sum('item_price');
    }

    private function detailBarang($dateNow, $filterType = 'daily')
    {
        $query = TransBarang::query();

        switch ($filterType) {
            case 'weekly':
                $query->whereBetween('created_at', [$dateNow->startOfWeek(), $dateNow->endOfWeek()]);
                break;
            case 'monthly':
                $query->whereMonth('created_at', $dateNow->month);
                break;
            default:
                $query->whereDate('created_at', $dateNow);
        }

        return $query->sum('trans_harga');
    }

    private function detailAsset($dateNow, $filterType = 'daily')
    {
        $query = TransAsset::query();

        switch ($filterType) {
            case 'weekly':
                $query->whereBetween('created_at', [$dateNow->startOfWeek(), $dateNow->endOfWeek()]);
                break;
            case 'monthly':
                $query->whereMonth('created_at', $dateNow->month);
                break;
            default:
                $query->whereDate('created_at', $dateNow);
        }

        return $query->sum('trans_harga');
    }

    public function index(Request $request)
    {
        $filter = $request->input('filter', 'daily'); // Default ke harian jika tidak ada filter
        $dateNow = Carbon::now()->timezone('Asia/Jakarta');
        Carbon::setLocale('id');
        $startDate = $dateNow;
        $endDate = $dateNow;
        $formatDate = '';

        // Tentukan rentang tanggal berdasarkan filter
        switch ($filter) {
            case 'weekly':
                $startDate = $dateNow->startOfWeek();
                $endDate = $dateNow->endOfWeek();
                $formatDate = $startDate->translatedFormat('d F Y') . ' - ' . $endDate->translatedFormat('d F Y');
                $filterType = 'Mingguan';
                break;

            case 'monthly':
                $startDate = $dateNow->startOfMonth();
                $endDate = $dateNow->endOfMonth();
                $formatDate = $startDate->translatedFormat('F Y');
                $filterType = 'Bulanan';
                break;

            default:
                $formatDate = $dateNow->translatedFormat('l, d F Y');
                $filterType = 'Harian';
                break;
        }

        // Ambil data berdasarkan rentang tanggal yang ditentukan
        $vacantTotal = CheckinDetail::whereBetween('created_at', [$startDate, $endDate])
            ->where('item_category', 'Rooms')
            ->sum('item_price');
        $serviceTotal = CheckinDetail::whereBetween('created_at', [$startDate, $endDate])
            ->where('item_category', 'Services')
            ->sum('item_price');
        $restoTotal = CheckinDetail::whereBetween('created_at', [$startDate, $endDate])
            ->where('item_category', 'Resto')
            ->sum('item_price');
        $laundryTotal = CheckinDetail::whereBetween('created_at', [$startDate, $endDate])
            ->where('item_category', 'Laundry')
            ->sum('item_price');
        $barangTotal = TransBarang::whereBetween('created_at', [$startDate, $endDate])->sum('trans_harga');
        $assetTotal = TransAsset::whereBetween('created_at', [$startDate, $endDate])->sum('trans_harga');

        $subTotalKredit = $vacantTotal + $serviceTotal + $restoTotal + $laundryTotal;
        $subTotalDebit = $barangTotal + $assetTotal;

        $data = [
            'Title' => "Bill Reports",
            'Tanggal' => $formatDate,
            'FilterType' => $filterType,
            'Vacant' => $vacantTotal,
            'Service' => $serviceTotal,
            'Resto' => $restoTotal,
            'Laundry' => $laundryTotal,
            'Barang' => $barangTotal,
            'Asset' => $assetTotal,
            'SubTotalDebit' => $subTotalDebit,
            'SubTotalKredit' => $subTotalKredit,
            'Total' => $subTotalKredit - $subTotalDebit,
        ];
        return view('frontoffice.report.bill_report', $data);
    }
}
