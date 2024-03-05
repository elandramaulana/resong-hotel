<?php

use App\Http\Controllers\CheckinController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\RoomAjaxRequest;
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
Route::view('/check-out', 'frontoffice/checkout/checkout')->name('checkout');
Route::view('/check-out-detail', 'frontoffice/checkout/checkout_detail')->name('checkout_detail');



// reservation view
Route::view('/booking', 'frontoffice/reservation/booking')->name('booking');
Route::view('/booking-room-number', 'frontoffice/reservation/booking_room_number')->name('booking_room_number');
Route::view('/booking-form', 'frontoffice/reservation/booking_form')->name('booking_form');
Route::view('/reservation-list', 'frontoffice/reservation/reservation_list')->name('reservation_list');
Route::view('/edit-reservation', 'frontoffice/reservation/edit_reservation')->name('edit_reservation');

Route::view('/cancel-reservation-list', 'frontoffice/reservation/cancel_reservation_list')->name('cancel_reservation_list');
Route::view('/noshow-reservation-list', 'frontoffice/reservation/noshow_reservation_list')->name('noshow_reservation_list');



// Guest View
Route::view('/inhouse-guest', 'frontoffice/guest/inhouse_guest')->name('inhouse_guest');
Route::view('/detail-inhouse-guest', 'frontoffice/guest/detail_inhouse_guest')->name('detail_inhouse_guest');
Route::view('/detail-guest', 'frontoffice/guest/detail_guest')->name('detail_guest');
Route::view('/guest-database', 'frontoffice/guest/guest_database')->name('guest_database');