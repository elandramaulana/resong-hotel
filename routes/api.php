<?php

use Illuminate\Http\Request;
use App\Http\Resources\RoomResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\RestoController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\LaundryController;
use App\Http\Controllers\Api\KaryawanController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\InventoryController;
use App\Http\Controllers\Api\SupplierAssetController;

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
// Route::post('/login-api', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'loginApi']);

Route::middleware('auth:sanctum')->post('/scanlogs', [APIController::class, 'scanlog_endpoint']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(('auth:sanctum'))->group(function () {
    Route::post('/logout', [AuthController::class, 'logoutApi']);

    //Cashflow
    Route::get('/cashflow', [ReportController::class, 'cashflow']);

    //Cashflow All
    Route::get('/cashflow-all', [ReportController::class, 'cashflowAll']);

    Route::prefix('room')->group(function () {
        Route::get('/index', [RoomController::class, 'index']);
    });

    Route::prefix('karyawan')->group(function () {
        Route::get('/index', [KaryawanController::class, 'index']);
        Route::get('/report', [KaryawanController::class, 'attendanceReport']);
    });

    Route::prefix('supplier')->group(function () {
        Route::get('/index', [SupplierController::class, 'index']);
    });

    Route::prefix('inventory')->group(function () {
        Route::get('/index', [InventoryController::class, 'index']);
        Route::get('/kategori', [InventoryController::class, 'kategori']);
    });

    Route::prefix('supplier-asset')->group(function () {
        Route::get('/index', [SupplierAssetController::class, 'index']);
    });

    Route::prefix('laundry')->group(function () {
        Route::get('/index', [LaundryController::class, 'index']);
    });

    Route::prefix('laundry-guest')->group(function () {
        Route::get('/index', [LaundryController::class, 'index_guest']);
    });

    Route::prefix('laundry-linen')->group(function () {
        Route::get('/index', [LaundryController::class, 'index_linen']);
    });

    Route::prefix('resto')->group(function () {
        Route::get('/index', [RestoController::class, 'index']);
    });
});

