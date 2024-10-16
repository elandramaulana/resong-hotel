<?php

namespace App\Http\Controllers;

use App\Models\BillReport;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillReportController extends Controller
{
    public function index() {
        $Data = [
            'Title'=>"Bill Reports"
        ];

        return view('frontoffice.report.bill_report', $Data);
    }

    public function detail() {
        $Data = [
            'Title'=>"Bill Detail"
        ];

        return view('frontoffice.report.bill_detail', $Data);
    }
}
