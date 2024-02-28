<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::view('/dashboard', 'dashboard')->name('dashboard');

// checkout view
Route::view('/check-out', 'frontoffice/checkout/checkout')->name('checkout');
Route::view('/check-out-detail', 'frontoffice/checkout/checkout_detail')->name('checkout_detail');


// checkin view
Route::view('/normal-check-in', 'frontoffice/checkin/normal_checkin')->name('checkin_normal');
Route::view('/normal-checkin-form', 'frontoffice/checkin/normal_checkin_form')->name('checkin_normal_form');
Route::view('/speedy-check-in', 'frontoffice/checkin/speedy_checkin_form')->name('checkin_speedy');

// reservation view
Route::view('/booking', 'frontoffice/reservation/booking')->name('booking');
Route::view('/booking-room-number', 'frontoffice/reservation/booking_room_number')->name('booking_room_number');
Route::view('/booking-form', 'frontoffice/reservation/booking_form')->name('booking_form');


// route generate pdf in invoice view
Route::get('/generate-invoice', [InvoiceController::class, 'generateInvoice'])->name('generate.invoice');
