<?php
namespace App\Http\Controllers;
use Admin\LaporanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [Auth\AuthController::class, 'index'])->name('login');
Route::get('/auth', [Auth\AuthController::class, 'login'])->name('auth_qr');
Route::post('/auth', [Auth\AuthController::class, 'login'])->name('auth_login');
Route::get('/logout', [Auth\AuthController::class, 'logout'])->name('logout');

//level admin
Route::middleware('auth', 'validatelevels:admin')->group(function () {
    Route::get('/admin/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard_admin');

    Route::get('/admin/management/user', [Admin\UsersController::class, 'index'])->name('user');
    Route::view('/admin/management/user/add', 'admin.user_add')->name('add_user');
    Route::get('/admin/management/user/edit/{id}', [Admin\UsersController::class, 'edit'])->name('edit_user');
    Route::get('/admin/management/user/delete/{id}', [Admin\UsersController::class, 'delete'])->name('delete_user');

    Route::get('/admin/management/room', [Admin\RoomController::class, 'index'])->name('room');
    Route::view('/admin/management/room/add', 'admin.room_add')->name('add_room');
    Route::get('/admin/management/room/edit/{id}', [Admin\RoomController::class, 'edit'])->name('edit_room');
    Route::get('/admin/management/room/delete/{id}', [Admin\RoomController::class, 'delete'])->name('delete_room');
    Route::get('/admin/management/room/cetak/{id}', [Admin\RoomController::class, 'cetakStruk'])->name('cetakStruk');

    Route::get('/admin/management/food', [Admin\FoodController::class, 'index'])->name('food');
    Route::view('/admin/management/food/add', 'admin.food_add')->name('add_food');
    Route::get('/admin/management/food/edit/{id}', [Admin\FoodController::class, 'edit'])->name('edit_food');
    Route::get('/admin/management/food/delete/{id}', [Admin\FoodController::class, 'delete'])->name('delete_food');

    Route::get('/admin/management/station', [Admin\StationController::class, 'index'])->name('station');
    Route::get('/admin/management/station/edit/{id}', [Admin\StationController::class, 'edit'])->name('edit_station');
    // Route::view('/admin/management/station/add', 'admin.station_add')->name('add_station');
    // Route::get('/admin/management/station/delete/{id}', [Admin\StationController::class, 'delete'])->name('delete_station');
    // Route::get('/admin/management/antrian/detail/{id}', [Admin\AntrianController::class, 'antriandetail'])->name('transaksi_detail');
    
    Route::get('/admin/management/transaksi', [Admin\TransaksiController::class, 'index'])->name('transaksi');
    Route::view('/admin/management/transaksi/add', 'admin.transaksi_add')->name('add_transaksi');
    Route::get('/admin/management/transaksi/detail/{id}', [Admin\TransaksiController::class, 'detail'])->name('transaksi_detail');
    
    Route::get('/admin/management/fcfs', [Admin\AntrianController::class, 'index'])->name('fcfs');
    Route::get('/admin/management/laporan', [Admin\LaporanController::class, 'index'])->name('halaman_laporan');
    Route::get('/admin/management/cetak_laporan_penjualan', [Admin\LaporanController::class, 'cetak_laporan_penjualan'])->name('laporan_penjualan');
    Route::get('/admin/management/cetak_laporan_menu_favorit', [Admin\LaporanController::class, 'cetak_menu_favorit'])->name('menu_favorit');
    Route::get('/admin/management/cetak_laporan_fcfs', [Admin\LaporanController::class, 'cetak_laporan_fcfs'])->name('laporan_fcfs');

    Route::post('/admin/management/user/store', [Admin\UsersController::class, 'store'])->name('store_users');
    Route::post('/admin/management/room/store', [Admin\RoomController::class, 'store'])->name('store_rooms');
    Route::post('/admin/management/food/store', [Admin\FoodController::class, 'store'])->name('store_foods');
    Route::post('/admin/management/station/store', [Admin\StationController::class, 'store'])->name('store_stations');
    
    Route::put('/admin/management/user/update/{id}', [Admin\UsersController::class, 'update'])->name('update_users');
    Route::put('/admin/management/room/update/{id}', [Admin\RoomController::class, 'update'])->name('update_rooms');
    Route::put('/admin/management/food/update/{id}', [Admin\FoodController::class, 'update'])->name('update_foods');
    Route::put('/admin/management/transaksi/update/{id}', [Admin\TransaksiController::class, 'update'])->name('transaksi_update');
    Route::put('/admin/management/station/update/{id}', [Admin\StationController::class, 'update'])->name('station_update');


});

//level guest
Route::middleware('auth', 'validatelevels:guest')->group(function () {
    Route::get('/guest/dashboard', [Guest\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/guest/items/cart' ,[Guest\DetailsController::class, 'cart'])->name('details_cart');
    Route::get('/guest/details', [Guest\DetailsController::class, 'index'])->name('details');
    Route::get('/guest/items/{id}',[Guest\DetailsController::class, 'details_items'])->name('details_items');
    Route::get('/guest/items/hapus/{id}',[Guest\DetailsController::class, 'hapus_cart'])->name('hapus_cart');
    Route::get('/guest/payment/cc/success',[Guest\TransaksiController::class, 'cc_payment'])->name('cc_payment');
    Route::get('/guest/payment/cash/success',[Guest\TransaksiController::class, 'cc_cash'])->name('cc_cash');
    Route::post('/guest/items/tambah/{id}',[Guest\DetailsController::class, 'tambah_cart'])->name('tambah_cart');
    Route::post('/guest/items/payment',[Guest\TransaksiController::class, 'pembayaran'])->name('pembayaran');
    Route::view('/guest/payment/cc', 'guest.cc_transaksi')->name('cc_transaksi');
    Route::get('/guest/history', [Guest\HistoryController::class, 'index'])->name('history');
    Route::get('/guest/history/detail/{id}', [Guest\HistoryController::class, 'detail'])->name('history_detail');
});

//guest m001
Route::get('/guest/dashboard/m001', [Guest\DashboardController::class, 'index'])->name('dashboard_1');
//guest m002
Route::get('/guest/dashboard/m002', [Guest\DashboardController::class, 'index'])->name('dashboard_2');
//guest m003
Route::get('/guest/dashboard/m003', [Guest\DashboardController::class, 'index'])->name('dashboard_3');


// produksi
Route::middleware('auth', 'validatelevels:produksi')->group(function () {
    Route::get('/produksi/dashboard', [Produksi\DashboardController::class, 'index'])->name('dashboard_produksi');
    Route::get('/produksi/transaksi', [Produksi\TransaksiController::class, 'index'])->name('transaksi_produksi');
    // Route::view('/produksi/transaksi/add', 'produksi.transaksi_add')->name('add_transaksi_produksi');
    Route::get('/produksi/transaksi/detail/{id}', [Produksi\TransaksiController::class, 'detail'])->name('transaksi_detail_produksi');
    Route::put('/produksi/transaksi/update/{id}', [Produksi\TransaksiController::class, 'update'])->name('transaksi_update_produksi');

});

// kasir
Route::middleware('auth', 'validatelevels:kasir')->group(function () {
    Route::get('/kasir/dashboard', [Kasir\DashboardController::class, 'index'])->name('dashboard_kasir');
    Route::get('/kasir/transaksi', [Kasir\TransaksiController::class, 'index'])->name('transaksi_kasir');
    Route::get('/kasir/transaksi/detail/{id}', [Kasir\TransaksiController::class, 'detail'])->name('transaksi_detail_kasir');
    Route::get('/kasir/transaksi/cetak', [Kasir\TransaksiController::class, 'cetak_struk'])->name('cetak_struk');
    Route::view('/kasir/transaksi/add', 'kasir.transaksi_add')->name('add_transaksi_kasir');
    Route::put('/kasir/transaksi/update/{id}', [Kasir\TransaksiController::class, 'update'])->name('transaksi_update_kasir');
});
