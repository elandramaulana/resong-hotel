<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AutocompleteController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BillReportController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CheckinController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DaftarMenuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\HouseKeepingController;
use App\Http\Controllers\InhouseController;
use App\Http\Controllers\InventoryAsset\AssetController;
use App\Http\Controllers\InventoryAsset\KategoriController;
use App\Http\Controllers\InventoryAsset\SupplierController as InventoryAssetSupplierController;
use App\Http\Controllers\InventoryAsset\TransAssetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\KategoriMenuController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RestoMenuController;

use App\Http\Controllers\SupplierController;
use App\Http\Controllers\LaundryController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\RoomAjaxRequest;
use App\Http\Controllers\Select2Controller;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TransBarangController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\DataCollector\AjaxDataCollector;

require __DIR__ . '/auth.php';
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

<<<<<<< HEAD
=======
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

>>>>>>> 8cb0b246115f0903bd8e457db207b8c5c1384de5
Route::middleware(['auth', 'verified'])->group(function () {});




Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/checkin-normal', [CheckinController::class, 'index'])->name('checkin.normal');
    Route::post('/checkin-normal', [CheckinController::class, 'store'])->name('checkin.normal.store');
    Route::get('/checkin-normal-form/{id}', [CheckinController::class, 'form_normal'])->name('checkin.normal.form');
    Route::get('/checkin-speedy', [CheckinController::class, 'speedy'])->name('checkin.speedy');
    Route::post('/speedy-post', [CheckinController::class, 'speedy_post'])->name('checkin.speedy_post');
});


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
    Route::get('/generate-invoice/{id}', [CheckoutController::class, 'generatePDF'])->name('generate.invoice');
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


    Route::view('/reservation-list', 'frontoffice/reservation/reservation_list')->name('reservation_list');
    Route::get('/reservation-list', [BookingController::class, 'reservation_list'])->name('reservation.list');
    Route::get('/booking-canceled/', [BookingController::class, 'booking_canceled'])->name('booking.canceled');
    Route::get('/booking-no-showed/', [BookingController::class, 'no_showed'])->name('booking.no_showed');
    Route::view('/edit-reservation', 'frontoffice/reservation/edit_reservation')->name('edit_reservation');


    Route::view('/noshow-reservation-list', 'frontoffice/reservation/noshow_reservation_list')->name('noshow_reservation_list');

    // Guest View
    Route::get('/inhouse-guest', [InhouseController::class, 'index'])->name('inhouse.list');
    Route::get('/checkout-history', [InhouseController::class, 'checkout_history'])->name('checked_out.list');
    Route::get('/inhouse-table', [InhouseController::class, 'call_table'])->name('inhouse.table');
    Route::get('/his_checkout-table', [InhouseController::class, 'his_checkout'])->name('his_checkout.table');
    Route::get('/inhouse-addextrabed', [InhouseController::class, 'add_extrabed'])->name('inhouse.add_extrabed');
    Route::post('/inhouse-postaddons', [InhouseController::class, 'add_addons'])->name('inhouse.postaddons');
    Route::get('/inhouse-deladdons', [InhouseController::class, 'del_addons'])->name('inhouse.del_addons');
    Route::get('/detail-inhouse-guest/{id}', [InhouseController::class, 'inhouse_detail'])->name('inhouse.details');
    Route::view('/detail-guest', 'frontoffice/guest/detail_guest')->name('detail_guest');
    Route::view('/guest-database', 'frontoffice/guest/guest_database')->name('guest_database');

    Route::get('/guest-autocomplete', [AutocompleteController::class, 'guests'])->name('autocomplete.guests');
    Route::get('/guest-speedy', [AutocompleteController::class, 'speedy'])->name('autocomplete.speedy');
    Route::get('/guest-autocomplete-selected', [AutocompleteController::class, 'selected_guest'])->name('autocomplete.selectedguest');
    // House Keeping 
    Route::get('/house-keeping', [HouseKeepingController::class, 'index'])->name('cleaningroom.list');
    Route::post('/house-keeping-makehistory', [HouseKeepingController::class, 'storeHistory'])->name('cleaningroom.history');
    Route::get('/housekeeping-table', [HouseKeepingController::class, 'call_table'])->name('cleaningroom.table');
    Route::get('/edit-housekeeping-detail/{id}', [HouseKeepingController::class, 'cleaning_detail'])->name('cleaningroom.details');


    // Report
    Route::get('/bill-report', [BillReportController::class, 'index'])->name('bill.report');
    Route::get('/bill-detail', [BillReportController::class, 'detail'])->name('bill.detail');



    // Supplier
    Route::get('/supplier', [SupplierController::class, 'index'])->name('list.supplier');
    Route::get('/tambah-supplier', [SupplierController::class, 'create'])->name('tambah.supplier');
    Route::post('/store-supplier', [SupplierController::class, 'storeSupplier'])->name('store.supplier');
    Route::get('/edit-supplier-detail/{id}', [SupplierController::class, 'edit'])->name('edit.supplier');
    Route::delete('/supplier/destroy/{id}', [SupplierController::class, 'destroy'])->name('destroy.supplier');
    Route::get('/supplier/update/{id}', [SupplierController::class, 'update'])->name('supplier.update');


    // Barang
    Route::get('/barang', [BarangController::class, 'index'])->name('list.barang');
    Route::get('/tambah-barang', [BarangController::class, 'create'])->name('tambah.barang');
    Route::post('/store-barang', [BarangController::class, 'storeBarang'])->name('store.barang');
    Route::get('/edit-barang-detail/{id}', [BarangController::class, 'edit'])->name('edit.barang');
    Route::delete('/barang/destroy/{id}', [BarangController::class, 'destroy'])->name('destroy.barang');
    Route::put('/update-barang/{id}', [BarangController::class, 'update'])->name('update.barang');

    // Kategori Barang
    Route::get('/kategori', [KategoriBarangController::class, 'index'])->name('list.kategori');
    Route::get('/tambah-kategori', [KategoriBarangController::class, 'create'])->name('tambah.kategori');
    Route::post('/store-kategori', [KategoriBarangController::class, 'storeCategori'])->name('store.kategori');
    Route::get('/edit-kategori-detail/{id}', [KategoriBarangController::class, 'edit'])->name('edit.kategori');
    Route::delete('/kategori/destroy/{id}', [KategoriBarangController::class, 'destroy'])->name('destroy.kategori');

    // Kategori Menu
    Route::get('/kategori-menu', [KategoriMenuController::class, 'index'])->name('kategori.menu');
    Route::get('/tambah-kategori-menu', [KategoriMenuController::class, 'create'])->name('tambah.kategori.menu');
    Route::post('/store-kategori-menu', [KategoriMenuController::class, 'storeKategori'])->name('store.kategori.menu');
    Route::delete('/kategori-menu/destroy/{id}', [KategoriMenuController::class, 'destroy'])->name('destroy.kategori.menu');


    // Barang
    Route::get('/list-trans-barang', [TransBarangController::class, 'index'])->name('list.trans');
    Route::get('/tambah-trans-barang', [TransBarangController::class, 'createMasuk'])->name('tambah.trans.barang');
    Route::get('/kurang-trans-barang', [TransBarangController::class, 'createKurang'])->name('kurang.trans.barang');
    Route::post('/store-trans-barang', [TransBarangController::class, 'stroreTrans'])->name('store.trans.barang');
    Route::get('/edit-trans-barang/{id}', [TransBarangController::class, 'edit'])->name('edit.trans.barang');
    Route::delete('/trans-barang/destroy/{id}', [TransBarangController::class, 'destroy'])->name('destroy.trans.barang');

    // Manage Menu
    Route::get('/menu-list', [MenuController::class, 'index'])->name('list.menu');
    Route::get('/tambah-menu', [MenuController::class, 'create'])->name('tambah.menu');
    Route::post('/store-menu', [MenuController::class, 'storeMenu'])->name('store.menu');
    Route::get('/edit-menu-detail/{id}', [MenuController::class, 'edit'])->name('edit.menu');
    Route::delete('/menu/destroy/{id}', [MenuController::class, 'destroy'])->name('destroy.menu');
    Route::put('/update-menu/{id}', [MenuController::class, 'update'])->name('update.menu');

    // Daftar Menu
    Route::get('/daily-menu', [DaftarMenuController::class, 'index'])->name('daily.menu');
    Route::get('/tambah-daily-menu', [DaftarMenuController::class, 'create'])->name('tambah.daily.menu');
    Route::get('/manage-daily-menu/{id}', [DaftarMenuController::class, 'manage'])->name('manage.daily');
    Route::post('/update-daily-menu/{id}', [DaftarMenuController::class, 'update'])->name('update.daily');
    Route::get('/store-daily-menu', [DaftarMenuController::class, 'storeMenuDaily'])->name('store.daily.menu');


    // Daftar Menu
    // Route::get('/resto-menu', [RestoMenuController::class, 'getMenuForToday'])->name('resto.menu'); //get available menu by day
    Route::get('/resto-menu', [RestoMenuController::class, 'index'])->name('resto.menu'); //get available menu by day
    Route::get('/resto_form', [RestoMenuController::class, 'form'])->name('resto.form');
    Route::post('/resto_submit', [RestoMenuController::class, 'PostResto'])->name('resto.resto_submit');
    Route::get('/guest-autocomplete-speedy', [AutocompleteController::class, 'selected_speedy'])->name('autocomplete.selectedspeedy');

    Route::get('/test', [TestController::class, 'index'])->name('test');

    //route for laundry feature
    Route::get('/laundry', [LaundryController::class, 'index'])->name('laundry');
    Route::get('/laundry_form', [LaundryController::class, 'form'])->name('laundry.form');
    Route::post('/laundry_post', [LaundryController::class, 'post'])->name('laundry.post');

    //select2 route
    Route::get('/select2room_inhouse', [Select2Controller::class, 'room_inhouse'])->name('select2.room_inhouse');
    Route::get('/select2room_cat_laundry', [Select2Controller::class, 'cat_laundry'])->name('select2.categoryLaundry');
    Route::get('/select2menuActive', [Select2Controller::class, 'menu_active'])->name('select2.menu_active');
    Route::get('/select2menuCategory', [Select2Controller::class, 'menu_category'])->name('select2.menu_category');

    //detail
    Route::get('/detail_menu', [Select2Controller::class, 'detail_menu'])->name('detail.menu');
    //datatable route
    Route::get('/dt_laudry', [LaundryController::class, 'list_laundry'])->name('datatable.laundry');
    //ajax request   
    Route::post('/ajax_detcatlaundrybyid', [AjaxController::class, 'detCatLaundryByID'])->name('ajax.detCatLaundryByID');


    //Kepegawaian
    Route::get('/daftar-karyawan', [KaryawanController::class, 'index'])->name('daftar.karyawan');
    Route::get('/tambah-karyawan', [KaryawanController::class, 'add'])->name('tambah.karyawan');
    Route::post('/store-karyawan', [KaryawanController::class, 'store'])->name('store.karyawan');
    Route::get('/karyawan/{id}/edit', [KaryawanController::class, 'edit'])->name('edit.karyawan');
    Route::get('/get-shifts/{divisi_id}', [KaryawanController::class, 'getShiftsByDivision'])->name('get.shifts');
    Route::put('/karyawan/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');
    
    
    //Divisi
    Route::get('/daftar-divisi', [DivisiController::class, 'index'])->name('daftar.divisi');
    Route::get('/tambah-divisi', [DivisiController::class, 'add'])->name('tambah.divisi');
    Route::post('/store-divisi', [DivisiController::class, 'store'])->name('store.divisi');
    Route::get('/divisi/{id}/edit', [DivisiController::class, 'edit'])->name('edit.divisi');
    Route::put('/divisi/{id}', [DivisiController::class, 'update'])->name('update.divisi');
    Route::delete('/divisi/destroy/{id}', [DivisiController::class, 'destroy'])->name('destroy.divisi');

    //Shift
    Route::get('/daftar-shift', [ShiftController::class, 'index'])->name('daftar.shift');
    Route::get('/tambah-shift', [ShiftController::class, 'add'])->name('tambah.shift');
    Route::post('/store-shift', [ShiftController::class, 'store'])->name('store.shift');
    Route::get('/shift/{id}/edit', [ShiftController::class, 'edit'])->name('edit.shift');
    Route::put('/shift/{id}', [ShiftController::class, 'update'])->name('update.shift');
<<<<<<< HEAD
    Route::delete('/shift/destroy/{id}', [ShiftController::class, 'destroy'])->name('destroy.shift');
=======
>>>>>>> 8cb0b246115f0903bd8e457db207b8c5c1384de5


    //Kehadiran
    Route::get('/daftar-hadir', [KehadiranController::class, 'index'])->name('daftar.hadir');
    Route::get('/get-karyawan-by-divisi/{divisiId}', [KehadiranController::class, 'getKaryawanByDivisi'])->name('get.karyawan.by.divisi');
    Route::get('/get-shifts-by-divisi/{divisiId}', [KehadiranController::class, 'getShiftsByDivisi'])->name('get.shifts.by.divisi');
    Route::get('/filter-absensi', [KehadiranController::class, 'filterAbsensi'])->name('filter.absensi');

<<<<<<< HEAD
      // supplier
=======
    // Inventory Asset

    // supplier
>>>>>>> 8cb0b246115f0903bd8e457db207b8c5c1384de5
    Route::prefix('inventory-assets/supplier')->group(function () {
        Route::get('/show', [InventoryAssetSupplierController::class, 'index'])->name('inventory-assets.supplier.show');
        Route::get('/create', [InventoryAssetSupplierController::class, 'create'])->name('inventory-assets.supplier.create');
        Route::post('/store', [InventoryAssetSupplierController::class, 'store'])->name('inventory-assets.supplier.store');
        Route::get('/edit/{id}', [InventoryAssetSupplierController::class, 'edit'])->name('inventory-assets.supplier.edit');
        Route::post('/update/{id}', [InventoryAssetSupplierController::class, 'update'])->name('inventory-assets.supplier.update');
        Route::delete('/destroy/{id}', [InventoryAssetSupplierController::class, 'destroy'])->name('inventory-assets.supplier.destroy');
    });

    Route::prefix('inventory-assets/category')->group(function () {
        Route::get('/show', [KategoriController::class, 'index'])->name('inventory-assets.kategori.show');
        Route::get('/create', [KategoriController::class, 'create'])->name('inventory-assets.kategori.create');
        Route::post('/store', [KategoriController::class, 'store'])->name('inventory-assets.kategori.store');
        Route::get('/edit/{id}', [KategoriController::class, 'edit'])->name('inventory-assets.kategori.edit');
        Route::post('/update/{id}', [KategoriController::class, 'update'])->name('inventory-assets.kategori.update');
        Route::delete('/destroy/{id}', [KategoriController::class, 'destroy'])->name('inventory-assets.kategori.destroy');
    });

    Route::prefix('inventory-assets/asset')->group(function () {
        Route::get('/show', [AssetController::class, 'index'])->name('inventory-assets.asset.show');
        Route::get('/create', [AssetController::class, 'create'])->name('inventory-assets.asset.create');
        Route::post('/store', [AssetController::class, 'store'])->name('inventory-assets.asset.store');
        Route::get('/edit/{id}', [AssetController::class, 'edit'])->name('inventory-assets.asset.edit');
        Route::post('/update/{id}', [AssetController::class, 'update'])->name('inventory-assets.asset.update');
        Route::delete('/destroy/{id}', [AssetController::class, 'destroy'])->name('inventory-assets.asset.destroy');
    });

    Route::prefix('inventory-assets/trans')->group(function () {
        Route::get('/show', [TransAssetController::class, 'index'])->name('inventory-assets.trans.show');
        Route::get('/create-masuk', [TransAssetController::class, 'createMasuk'])->name('inventory-assets.trans.create-masuk');
        Route::get('/create-keluar', [TransAssetController::class, 'createKeluar'])->name('inventory-assets.trans.create-keluar');
        Route::post('/store-masuk', [TransAssetController::class, 'storeMasuk'])->name('inventory-assets.trans.store-masuk');
        Route::post('/store-keluar', [TransAssetController::class, 'storeKeluar'])->name('inventory-assets.trans.store-keluar');
        Route::get('/edit/{id}', [TransAssetController::class, 'edit'])->name('inventory-assets.trans.edit');
        Route::post('/update-masuk/{id}', [TransAssetController::class, 'updateMasuk'])->name('inventory-assets.trans.update-masuk');
        Route::post('/update-keluar/{id}', [TransAssetController::class, 'updateKeluar'])->name('inventory-assets.trans.update-keluar');
        Route::delete('/destroy/{id}', [TransAssetController::class, 'destroy'])->name('inventory-assets.trans.destroy');
    });
    // end Inventory Asset
<<<<<<< HEAD

=======
>>>>>>> 8cb0b246115f0903bd8e457db207b8c5c1384de5
    // payroll
    Route::get('/data-gaji', [PayrollController::class, 'dataGaji'])->name('data.gaji');
    Route::get('/gaji/{id}/edit', [PayrollController::class, 'editGaji'])->name('edit.gaji');
    Route::get('/proses-gaji', [PayrollController::class, 'prosesGaji'])->name('proses.gaji');
    Route::get('/detai-proses-gaji/{id}', [PayrollController::class, 'detailProsesGaji'])->name('detail.proses');
    Route::get('/bill-gaji', [PayrollController::class, 'billGaji'])->name('bill.gaji');
    Route::put('/update-gaji/{id}', [PayrollController::class, 'updateGaji'])->name('update.gaji');


<<<<<<< HEAD
    
});
=======
    //
    Route::get('/tgl', [KehadiranController::class, 'getTgl'])->name('tgl');
});
>>>>>>> 8cb0b246115f0903bd8e457db207b8c5c1384de5
