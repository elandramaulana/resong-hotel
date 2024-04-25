<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActionCheckoutRequest;
use App\Http\Requests\EditDateCheckoutRequest;
use App\Http\Requests\ExtendRequest;
use App\Models\Checkin;
use App\Models\CheckinDetail;
use App\Models\Checkout;
use App\Models\Guest;
use App\Models\Rooms;
use DateTime;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class CheckoutController extends Controller
{
    public function index(){
         $Data = [
            'Title'=>'List Room Need Checkout',

        ];
        return view('frontoffice.checkout.checkout', $Data);
    }
    public function edit_checkout_date(EditDateCheckoutRequest $request) {
        //find the checkin data
        $Checkin = Checkin::find($request->checkin_id);
        $date_str = $request->checkoutTime;
        $date = date("Y-m-d", strtotime(str_replace('/', '-', $date_str)));
        $Checkin->date_checkout = $date;
        $Checkin->save();
        //edit detail checkin
        $this->editDetailCheckin($request->checkin_id, $Checkin->date_checkin, $date);
        return redirect()->back()->with('success', 'Tanggal Checkout Berhasil di Rubah');
    }
    public function action(ActionCheckoutRequest $request) {
        //insert to checkout table
        $dataCheckout = [
            'checkin_id'=>$request->checkin_id,
            'checkout_payment'=>$request->checkout_method,
            'discount'=>$request->inputDiscount
        ];

        // dd($dataCheckout);
        Checkout::create($dataCheckout);
        echo json_encode($dataCheckout);
        //update room status to vacant dirty
        $Checkin = Checkin::find($request->checkin_id);
        $room_id = $Checkin->room_id;
        $Room = Rooms::find($room_id);
        $Room->room_status = 'VACANT DIRTY';
        $Room->save();
        $invoiceNeed = ['success'=>'Proses Checkout Selesai', 'checkin_id'=>$request->checkin_id];
        return redirect('dashboard')->with($invoiceNeed);

    }
    public function  detail(Request $request, $id)  {
        $getCheckinbyRoom = Checkin::where('checkins.id', $id)
                                        ->select('checkins.*', 'rooms.*', 'guests.*', 'checkins.id as checkin_id') 
                                        ->where('room_status', 'OCCUPIED')
                                        ->join('rooms', 'rooms.id', '=', 'checkins.room_id')
                                        ->join('guests', 'guests.id', '=', 'checkins.guest_id')
                                        ->first();
        $detailDataCheckin = CheckinDetail::where('checkin_id', $getCheckinbyRoom->checkin_id)->get();

        $Data = [
            'Title'=>'Halaman Detail Checkout',
            'detailCheckin'=>$getCheckinbyRoom,
            'dataDetailCheckin'=>$detailDataCheckin
        ];

        
        return view('frontoffice.checkout.checkout_detail', $Data);
    }
    public function extend(ExtendRequest $request) {
        $checkin = Checkin::find($request->extend_checkin_id);
        $checkin->date_checkout = $request->checkout_time_extend;
        $detailCheckin = CheckinDetail::where('checkin_id', $request->extend_checkin_id)->get()->first();
        $checkin_date = $request->current_checkin;
        $chekout_date = $request->checkout_time_extend;
        $days = daysInterval($checkin_date, $chekout_date);
        $detailCheckin->item_qty = $days;
        $detailCheckin->save();
        if($checkin->save()){
            return redirect()->back()->with('success', 'Extend Checkout Date Berhasil');
        }else{
           return redirect()->back()->with('errors', "Error Extend Checkout");
        }
    }
    public function editDetailCheckin($checkin_id, $date_checkin, $date_checkout) {
        $detailCheckin = CheckinDetail::where('checkin_id', $checkin_id)->get()->first();
        $days = daysInterval($date_checkin, $date_checkout);
        $detailCheckin->item_qty = $days;
        if($detailCheckin->save()){
            return true;
        }else{
            return false;
        }
    }
    private function detCheckin($checkin_id, $cat){
        $detCheckin = CheckinDetail::where('checkin_id', $checkin_id)
                                    ->where('item_category', $cat)
                                    ->get();
        return $detCheckin;
    }
    public function generatePDF($checkin_id)
    {
        $checkin_info = Checkin::join('guests', 'guests.id', '=', 'checkins.guest_id')
                                ->where('checkins.id', $checkin_id)
                                ->get()->first();
        $guestInfo = [
            'no_invoice'=>$checkin_info->no_invoice,
            'name_guest'=>$checkin_info->name_guest,
            'guest_contact'=>$checkin_info->guest_contact,
            'guest_email'=>$checkin_info->guest_email,
            'deposit'=>$checkin_info->payment
        ];
        
        $detCheckout = Checkout::where('checkin_id', $checkin_id)
                                ->get()->first();
        $checkoutInfo = [
            'checkout_payment'=>$detCheckout->checkout_payment,
            'discount'=>$detCheckout->discount
        ];                     
        $data = [
            'checkin_info'=>$guestInfo,
            'detail_vacant'=>$this->detCheckin($checkin_id, 'Rooms'),
            'detail_resto'=>$this->detCheckin($checkin_id, 'Resto'),
            'detail_laundry'=>$this->detCheckin($checkin_id, 'Laundry'),
            'detail_checkout'=>$checkoutInfo,
        ];
        // Mulai buffering output
        ob_start();

        // Mulai HTML
        ?>
       <html>
        <head>
            <title>Invoice Details</title>
            <style>
                /* Tambahkan CSS Anda di sini */
            </style>
        </head>
        <body>
            <section id="form-detail">
                <div class="container-fluid mt-4 mb-5">
                    <div class="card">
                        <div class="card-body text-dark">
                            <?php echo View::make('invoice_pdf', ['data' => $data])->render(); ?>
                        </div>
                    </div>
                </div>
            </section>
        </body>
        </html>
        <?php

        // Simpan output ke variabel
        $html = ob_get_clean();

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        // Inisialisasi Dompdf
        $dompdf = new Dompdf($options);

        // Muat HTML ke Dompdf
        $dompdf->loadHtml($html);

        // Atur ukuran dan orientasi kertas
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (generate)
        $dompdf->render();

        // Keluarkan (output) file PDF ke browser
        return $dompdf->stream('invoice.pdf');
    }

}
