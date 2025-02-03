<?php

namespace App\Http\Controllers;

use App\Models\Checkin;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function getReceipt($id)
    {
        // $receipt = Checkin::find($id);
        $receipt = [
            'logoPath' => asset('img/logo.png'),
        ];

        $pdf = Pdf::loadView('pdf.receipt', $receipt);
        return $pdf->download('receipt.pdf');
    }
}
