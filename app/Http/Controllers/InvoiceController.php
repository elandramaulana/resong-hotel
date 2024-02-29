<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;


class InvoiceController extends Controller
{
    public function generateInvoice()
    {
        // Logika untuk membuat file PDF dan download
        // ...

        // Contoh menggunakan laravel-dompdf untuk membuat PDF
        $pdf = Pdf::loadView('frontoffice.checkout.invoice_pdf'); // Buat file PDF dari view 'invoice.invoice-pdf'

        return $pdf->download('invoice.pdf'); // Download file PDF dengan nama 'invoice.pdf'
    }
}
