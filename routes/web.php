<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::view('/dashboard1', 'dashboard')->name('dashboard');

Route::view('/check-out', 'frontoffice/checkout')->name('checkout');


Route::view('/normal-check-in', 'frontoffice/checkin/normal_checkin')->name('checkin_normal');
Route::view('/normal-checkin-form', 'frontoffice/checkin/normal_checkin_form')->name('checkin_normal_form');
Route::view('/speedy-check-in', 'frontoffice/checkin/speedy_checkin_form')->name('checkin_speedy');
