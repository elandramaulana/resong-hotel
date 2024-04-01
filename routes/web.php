<?php

use App\Http\Controllers\AutocompleteController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CheckinController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\InhouseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LaundryController;
use App\Http\Controllers\RoomAjaxRequest;
use App\Http\Controllers\Select2Controller;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\DataCollector\AjaxDataCollector;

require __DIR__.'/auth.php';
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/checkin-normal', [CheckinController::class, 'index'])->name('checkin.normal');
    Route::post('/checkin-normal', [CheckinController::class, 'store'])->name('checkin.normal.store');
    Route::get('/checkin-normal-form/{id}', [CheckinController::class, 'form_normal'])->name('checkin.normal.form');
    Route::get('/checkin-speedy', [CheckinController::class, 'speedy'])->name('checkin.speedy');
});

// route generate pdf in invoice view
Route::get('/generate-invoice', [InvoiceController::class, 'generateInvoice'])->name('generate.invoice');

//ajax route
Route::middleware('auth')->group(function () {
    Route::get('/ajax-selectrooms', [RoomAjaxRequest::class, 'ajax_select_room'])->name('ajax.selectrooms');
});

// checkout view
Route::middleware('auth')->group(function () {
Route::get('/check-out', [CheckoutController::class, 'index'])->name('checkout.list');
Route::get('/check-out-detail/{id}', [CheckoutController::class, 'detail'])->name('checkout.detail');
Route::post('/check-out-extend', [CheckoutController::class, 'extend'])->name('checkout.extend');
Route::post('/check-out-action', [CheckoutController::class, 'action'])->name('checkout.action');
Route::post('/check-out-editdate', [CheckoutController::class, 'edit_checkout_date'])->name('checkout.edit.outdate');
});


// Route::view('/normal-check-in', 'frontoffice/checkin/normal_checkin')->name('checkin_normal');
// Route::view('/normal-checkin-form', 'frontoffice/checkin/normal_checkin_form')->name('checkin_normal_form');
Route::view('/speedy-check-in', 'frontoffice/checkin/speedy_checkin_form')->name('checkin_speedy');


//ajax route
Route::middleware('auth')->group(function () {
    Route::get('/ajax-selectrooms', [RoomAjaxRequest::class, 'ajax_select_room'])->name('ajax.selectrooms');
    Route::get('/ajax-selectrooms-checkout', [RoomAjaxRequest::class, 'ajax_select_room_checkout'])->name('ajax.selectrooms.checkout');
    Route::get('/ajax-selectrooms-reservations', [RoomAjaxRequest::class, 'ajax_select_room_reservations'])->name('ajax.selectrooms.reservations');
});
// checkin view
Route::middleware('auth')->group(function () {
Route::view('/normal-check-in', 'frontoffice/checkin/normal_checkin')->name('checkin_normal');
Route::view('/normal-checkin-form', 'frontoffice/checkin/normal_checkin_form')->name('checkin_normal_form');
Route::view('/speedy-check-in', 'frontoffice/checkin/speedy_checkin_form')->name('checkin_speedy');
});
// reservation view
Route::middleware('auth')->group(function () {
Route::get('/booking', [BookingController::class, 'index'])->name('booking');
Route::post('/booking-pick-room', [BookingController::class, 'pick_room'])->name('booking.pick_room');
Route::get('/booking-table', [BookingController::class, 'call_table'])->name('booking.table');
Route::get('/booking-payment/{id}', [BookingController::class, 'booking_payment'])->name('booking.payment');
Route::post('/booking-payment-store/', [BookingController::class, 'booking_store'])->name('booking.store');
Route::post('/booking-cancel/', [BookingController::class, 'booking_cancel'])->name('booking.cancel');
Route::get('/booking-no-show/', [BookingController::class, 'set_no_show'])->name('booking.set_no_show');
});

// route generate pdf in invoice view
Route::middleware('auth')->group(function () {
Route::get('/generate-invoice', [InvoiceController::class, 'generateInvoice'])->name('generate.invoice');
Route::get('/reservation-list', [BookingController::class, 'reservation_list'])->name('reservation.list');
Route::get('/booking-canceled/', [BookingController::class, 'booking_canceled'])->name('booking.canceled');
Route::get('/booking-no-showed/', [BookingController::class, 'no_showed'])->name('booking.no_showed');
Route::view('/edit-reservation', 'frontoffice/reservation/edit_reservation')->name('edit_reservation');


Route::view('/noshow-reservation-list', 'frontoffice/reservation/noshow_reservation_list')->name('noshow_reservation_list');

// Guest View
Route::get('/inhouse-guest', [InhouseController::class, 'index'])->name('inhouse.list');
Route::get('/inhouse-table', [InhouseController::class, 'call_table'])->name('inhouse.table');
Route::get('/inhouse-addextrabed', [InhouseController::class, 'add_extrabed'])->name('inhouse.add_extrabed');
Route::post('/inhouse-postaddons', [InhouseController::class, 'add_addons'])->name('inhouse.postaddons');
Route::get('/inhouse-deladdons', [InhouseController::class, 'del_addons'])->name('inhouse.del_addons');
Route::get('/detail-inhouse-guest/{id}',[InhouseController::class, 'inhouse_detail'] )->name('inhouse.details');
Route::view('/detail-guest', 'frontoffice/guest/detail_guest')->name('detail_guest');
Route::view('/guest-database', 'frontoffice/guest/guest_database')->name('guest_database');


Route::get('/guest-autocomplete', [AutocompleteController::class, 'guests'])->name('autocomplete.guests');
Route::get('/guest-autocomplete-selected', [AutocompleteController::class, 'selected_guest'])->name('autocomplete.selectedguest');


Route::get('/test', [TestController::class, 'index'])->name('test');



//route for laundry feature
Route::get('/laundry', [LaundryController::class, 'index'])->name('laundry');
Route::get('/laundry_form', [LaundryController::class, 'form'])->name('laundry.form');
Route::post('/laundry_post', [LaundryController::class, 'post'])->name('laundry.post');


//select2 route
Route::get('/select2room_inhouse', [Select2Controller::class, 'room_inhouse'])->name('select2.room_inhouse');


});

