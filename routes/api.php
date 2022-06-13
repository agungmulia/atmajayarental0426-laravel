<?php
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::group(['middleware' => 'auth:api'], function (){
    
    Route::get('mobilTersedia','Api\MobilController@mobilTersedia');
    Route::get('mobil','Api\MobilController@index');
    Route::get('brosur','Api\MobilController@getBrosur');
    Route::get('mobil/{id}','Api\MobilController@show');
    Route::post('mobil','Api\MobilController@store');
    Route::put('mobil/{id}','Api\MobilController@update');
    Route::delete('mobil/{id}','Api\MobilController@destroy');
});

Route::group(['middleware' => 'auth:api'], function (){
    Route::get('pegawai','Api\PegawaiController@index');
    Route::get('pegawai/{id}','Api\PegawaiController@show');
    Route::post('pegawai','Api\PegawaiController@store');
    Route::put('pegawai/{id}','Api\PegawaiController@update');
    Route::delete('pegawai/{id}','Api\PegawaiController@destroy');
});

Route::group(['middleware' => 'auth:api'], function (){
    Route::get('jadwal','Api\ShiftController@index');
    Route::get('jadwal/{id}','Api\ShiftController@show');
    Route::post('jadwal','Api\ShiftController@store');
    Route::put('jadwal/{id1}/{id2}','Api\ShiftController@update');
    Route::delete('jadwal/{id}','Api\ShiftController@destroy');
});

Route::group(['middleware' => 'auth:api'], function (){
    Route::get('promo','Api\PromoController@index');
    Route::get('promo/{id}','Api\PromoController@show');
    Route::post('promo','Api\PromoController@store');
    Route::put('promo/{id}','Api\PromoController@update');
    Route::delete('promo/{id}','Api\PromoController@destroy');
});

Route::group(['middleware' => 'auth:api'], function (){
    Route::get('mitra','Api\MitraController@index');
    Route::get('mitra/{id}','Api\MitraController@show');
    Route::post('mitra','Api\MitraController@store');
    Route::put('mitra/{id}','Api\MitraController@update');
    Route::delete('mitra/{id}','Api\MitraController@destroy');
});

Route::group(['middleware' => 'auth:api'], function (){
    Route::get('driver','Api\DriverController@index');
    Route::get('driver/{id}','Api\DriverController@show');
    Route::get('driverMobile/{id}','Api\DriverController@showMobile');
    Route::post('driver','Api\DriverController@store');
    Route::put('driver/{id}','Api\DriverController@update');
    Route::put('driverMobile/{id}','Api\DriverController@updateMobile');
    Route::delete('driver/{id}','Api\DriverController@destroy');
});

Route::group(['middleware' => 'auth:api'], function (){
    Route::get('transaksi','Api\TransaksiController@index');
    Route::get('pendapatan','Api\TransaksiController@pendapatan');
    Route::get('promoTransaksi','Api\TransaksiController@promoTransaksi');
    Route::get('topDriver','Api\TransaksiController@topDriver');
    Route::get('topCustomer','Api\TransaksiController@topCustomer');
    Route::get('jumlahPendapatan','Api\TransaksiController@jumlahPendapatan');
    Route::get('transaksi/{id}','Api\TransaksiController@show');
    Route::get('driverByTransaksi/{id}','Api\TransaksiController@driverByTransaksi');
    Route::get('transaksiMobile/{id}','Api\TransaksiController@showMobile');
    Route::get('transaksiByDriver/{id}','Api\TransaksiController@getTransaksiByDriver');
    Route::get('transaksiByCustomer/{id}','Api\TransaksiController@getTransaksiByCustomer');
    Route::get('transaksiByCustomerEmail/{id}','Api\TransaksiController@getTransaksiByCustomerEmail');
    Route::post('transaksi','Api\TransaksiController@store');
    Route::put('rating/{id}','Api\TransaksiController@rating');
    Route::put('transaksi/{id}','Api\TransaksiController@update');
    Route::put('pembayaran/{id}','Api\TransaksiController@pembayaran');
    Route::put('verifikasi/{id}','Api\TransaksiController@verifikasi');
    // Route::delete('driver/{id}','Api\DriverController@destroy');
});
Route::post('customer','Api\CustomerController@store');
Route::group(['middleware' => 'auth:api'], function (){
    // Route::get('transaksi','Api\TransaksiController@index');
    Route::get('customer/{id}','Api\CustomerController@getCustomerByEmail');
    
    // Route::put('transaksi/{id}','Api\TransaksiController@update');
    // Route::put('pembayaran/{id}','Api\TransaksiController@pembayaran');
    // Route::delete('driver/{id}','Api\DriverController@destroy');
});


Route::post('register','Api\AuthController@register');
Route::post('login','Api\AuthController@login');