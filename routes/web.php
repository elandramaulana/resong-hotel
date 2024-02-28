<?php

use App\Http\Controllers\CheckinController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomAjaxRequest;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\DataCollector\AjaxDataCollector;
use App\Http\Controllers\InvoiceController;

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


// checkout view
Route::view('/check-out', 'frontoffice/checkout/checkout')->name('checkout');
Route::view('/check-out-detail', 'frontoffice/checkout/checkout_detail')->name('checkout_detail');


// Route::view('/normal-check-in', 'frontoffice/checkin/normal_checkin')->name('checkin_normal');
// Route::view('/normal-checkin-form', 'frontoffice/checkin/normal_checkin_form')->name('checkin_normal_form');
Route::view('/speedy-check-in', 'frontoffice/checkin/speedy_checkin_form')->name('checkin_speedy');


//ajax route
Route::middleware('auth')->group(function () {
    Route::get('/ajax-selectrooms', [RoomAjaxRequest::class, 'ajax_select_room'])->name('ajax.selectrooms');
});
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
