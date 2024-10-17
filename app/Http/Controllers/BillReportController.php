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
    private function detailCheckIn($dateNow, $category)
    {
        $detailCheckin = CheckinDetail::whereDate('created_at', $dateNow)
            ->where('item_category', $category)
            ->sum('item_price');
        return $detailCheckin;
    }

    private function detailBarang($dateNow) {
        $detailBarang = TransBarang::whereDate('created_at', $dateNow)
            ->sum('trans_harga');
        return $detailBarang;
    }

    private function detailAsset($dateNow) {
        $detailAsset = TransAsset::whereDate('created_at', $dateNow)
            ->sum('trans_harga');
        return $detailAsset;
    }

    public function index()
    {
        $dateNow = Carbon::now()->timezone('Asia/Jakarta');
        Carbon::setLocale('id');
        $formatDate = $dateNow->translatedFormat('l, d F Y');
        // Hitung detail check-in per kategori
        $vacantTotal = $this->detailCheckIn($dateNow, 'Rooms');
        $serviceTotal = $this->detailCheckIn($dateNow, 'Services');
        $restoTotal = $this->detailCheckIn($dateNow, 'Resto');
        $laundryTotal = $this->detailCheckIn($dateNow, 'Laundry');
        $barangTotal = $this->detailBarang($dateNow);
        $assetTotal = $this->detailAsset($dateNow);

        // Subtotal dari semua kategori
        $subTotalKredit = $vacantTotal + $serviceTotal + $restoTotal + $laundryTotal;
        $subTotalDebit = $barangTotal + $assetTotal;

        // Data yang akan dikirim ke view
        $data = [
            'Title' => "Bill Reports",
            'Tanggal' => $formatDate,
            'Vacant' => $vacantTotal,
            'Service' => $serviceTotal,
            'Resto' => $restoTotal,
            'Laundry' => $laundryTotal,
            'Barang' => $barangTotal,
            'Asset' => $assetTotal,
            'SubTotalDebit' => $subTotalDebit,
            'SubTotalKredit' => $subTotalKredit,
            'Total' => $subTotalKredit - $subTotalDebit
        ];

        // dd($data);

        return view('frontoffice.report.bill_report', $data);
    }


    public function detail()
    {
        $Data = [
            'Title' => "Bill Detail"
        ];

        return view('frontoffice.report.bill_detail', $Data);
    }
}
