<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CheckinDetail;
use App\Models\TransAsset;
use App\Models\TransBarang;

class ReportController extends Controller
{
    private function detailCheckIn($dateFrom, $dateTo, $category)
    {
        $query = CheckinDetail::where('item_category', $category);

        // Apply date range if provided, otherwise default to today
        if ($dateFrom && $dateTo) {
            $query->whereBetween('created_at', [$dateFrom, $dateTo]);
        } else {
            $query->whereDate('created_at', Carbon::today());
        }

        return $query->sum('item_price');
    }

    private function detailBarang($dateFrom, $dateTo)
    {
        $query = TransBarang::query();

        if ($dateFrom && $dateTo) {
            $query->whereBetween('created_at', [$dateFrom, $dateTo]);
        } else {
            $query->whereDate('created_at', Carbon::today());
        }

        return $query->sum('trans_harga');
    }

    private function detailAsset($dateFrom, $dateTo)
    {
        $query = TransAsset::query();

        if ($dateFrom && $dateTo) {
            $query->whereBetween('created_at', [$dateFrom, $dateTo]);
        } else {
            $query->whereDate('created_at', Carbon::today());
        }

        return $query->sum('trans_harga');
    }
    public function cashflow()
    {
        $dateNow = Carbon::now()->timezone('Asia/Jakarta');
        Carbon::setLocale('id');

        // Use today's date as the range for data retrieval
        $dateFrom = $dateNow->startOfDay();
        $dateTo = $dateNow->endOfDay();

        // Calculate detail check-in per category for today
        $vacantTotal = $this->detailCheckIn($dateFrom, $dateTo, 'Rooms');
        $serviceTotal = $this->detailCheckIn($dateFrom, $dateTo, 'Services');
        $restoTotal = $this->detailCheckIn($dateFrom, $dateTo, 'Resto');
        $laundryTotal = $this->detailCheckIn($dateFrom, $dateTo, 'Laundry');
        $barangTotal = $this->detailBarang($dateFrom, $dateTo);
        $assetTotal = $this->detailAsset($dateFrom, $dateTo);

        // Subtotals for credit and debit
        $subTotalKredit = $vacantTotal + $serviceTotal + $restoTotal + $laundryTotal;
        $subTotalDebit = $barangTotal + $assetTotal;

        // Data to be sent in the response
        $data = [
            'Tanggal' => $dateNow->format('d/m/y'),
            'SubTotalDebit' => $subTotalDebit,
            'SubTotalKredit' => $subTotalKredit,
            'Total' => $subTotalKredit - $subTotalDebit
        ];

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil',
            'data' => $data
        ]);
    }
    


    public function cashflowAll(Request $request)
    {
        // Get the date range from the request or default to today
        $dateFrom = $request->input('from') ? Carbon::parse($request->input('from'))->startOfDay() : Carbon::today();
        $dateTo = $request->input('to') ? Carbon::parse($request->input('to'))->endOfDay() : Carbon::today();

        Carbon::setLocale('id');
        $formatDate = $dateFrom->format('d/m/y') . ' - ' . $dateTo->format('d/m/y');

        // Calculate details by category within the date range
        $vacantTotal = $this->detailCheckIn($dateFrom, $dateTo, 'Rooms');
        $serviceTotal = $this->detailCheckIn($dateFrom, $dateTo, 'Services');
        $restoTotal = $this->detailCheckIn($dateFrom, $dateTo, 'Resto');
        $laundryTotal = $this->detailCheckIn($dateFrom, $dateTo, 'Laundry');
        $barangTotal = $this->detailBarang($dateFrom, $dateTo);
        $assetTotal = $this->detailAsset($dateFrom, $dateTo);

        // Calculate subtotals
        $subTotalKredit = $vacantTotal + $serviceTotal + $restoTotal + $laundryTotal;
        $subTotalDebit = $barangTotal + $assetTotal;

        // Prepare data for response
        $data = [
            'Tanggal' => $formatDate,
            'Vacant' => $vacantTotal,
            'Service' => $serviceTotal,
            'Resto' => $restoTotal,
            'Laundry' => $laundryTotal,
            'Barang' => $barangTotal,
            'Asset' => $assetTotal,
            'SubTotalDebit' => $subTotalDebit,
            'SubTotalKredit' => $subTotalKredit,
            'Total' => $subTotalDebit - $subTotalKredit  
        ];

        // Convert all numeric 0 values and totals to string "0"
        $data = array_map(function ($value) {
            if ($value === 0 || $value === '0') {
                return "0";
            }
            return is_numeric($value) ? (string)$value : $value;
        }, $data);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil',
            'data' => $data
        ]);
    }
}
