<?php

use App\Http\Controllers\Api\KaryawanController;
use App\Http\Controllers\Api\LaundryController;
use App\Http\Controllers\Api\RestoController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\SupplierAssetController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\APIController;
use App\Http\Resources\RoomResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/scanlogs', [APIController::class, 'scanlogStore']);

Route::prefix('room')->group(function () {
    Route::get('/index', [RoomController::class, 'index']);
});

Route::prefix('karyawan')->group(function () {
    Route::get('/index', [KaryawanController::class, 'index']);
});

Route::prefix('supplier')->group(function () {
    Route::get('/index', [SupplierController::class, 'index']);
});

Route::prefix('supplier-asset')->group(function () {
    Route::get('/index', [SupplierAssetController::class, 'index']);
});

Route::prefix('laundry')->group(function () {
    Route::get('/index', [LaundryController::class, 'index']);
});

Route::prefix('resto')->group(function () {
    Route::get('/index', [RestoController::class, 'index']);
});
