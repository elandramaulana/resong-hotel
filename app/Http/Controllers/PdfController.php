<?php

namespace App\Http\Controllers;

use App\Models\Checkin;
use App\Models\CheckinDetail;
use App\Models\Guest;
use App\Models\LatePointSetting;
use App\Models\Rooms;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PdfController extends Controller
{
    public function getReceipt($id)
    {
        $receipt = Checkin::find($id);
        $detReceipt= CheckinDetail::where('checkin_id', $id)->get();
        $guest = Guest::find($receipt->guest_id);
        $room = Rooms::find($receipt->room_id);
        $TaxConfig = LatePointSetting::first();
        $bankInfo = LatePointSetting::first();
        $data = [
            'receipt' => $receipt,
            'detReceipt' => $detReceipt,
            'guest' => $guest,
            'room' => $room,
            'logoPath' => public_path('assets/img/logo.png'),
            'taxConfig' => $TaxConfig->pajak_checkin,
            'bank_name'=> $bankInfo->bank_name,
            'bank_account_name'=> $bankInfo->bank_account_name,
            'bank_account_number'=> $bankInfo->bank_account_number,
            'chanel_checkin'=> $receipt->chanel_checkin,
            'payment_method'=> $receipt->payment_method
        ];
        // Log::info('data 1: ' . json_encode($data));
        $pdf = Pdf::loadView('pdf.receipt', $data);
        // Save to storage
        $path = storage_path('app/public/receipts/receipt_' . $id .'_'. $guest->name_guest . '.pdf');
        $pdf->save($path);

         return response()->download($path)->deleteFileAfterSend(true);
    }
}
