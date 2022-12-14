<?php

use App\Models\Transaction;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Artisan;

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
//     return view('page.home');
// });
Route::get('/mysql', function () {
    // Artisan::call('migrate:rollback', ['--force' => true]);
    Artisan::call('migrate:fresh', ['--force' => true]);
    Artisan::call('db:seed', ['--force' => true]);
});


Route::group(['middleware' =>'guest:login'], function () {
    Route::get('/',[UserController::class,'login'])->name('login');
    Route::post('masuk',[UserController::class,'aksilogin'])->name('masuk');
});

Route::group(['middleware' =>['web','auth:login']],function(){
    
    Route::get('home',[BukuController::class,'index'])->name('home');
    Route::get('input-buku',[BukuController::class,'inputBuku'])->name('input-buku');
    Route::post('save-buku',[BukuController::class,'saveBuku'])->name('save-buku');
    Route::post('update-buku/{id}',[BukuController::class,'updateBuku'])->name('update-buku');
    Route::get('delete-buku/{id}',[BukuController::class,'delete'])->name('delete-buku');
    Route::get('detail-buku/{id}',[BukuController::class,'detail'])->name('detail-buku');
    Route::post('save-kategori',[BukuController::class,'tambahKategori'])->name('save-kategori');
    Route::post('tambah-stok/{id}',[BukuController::class,'tambahStok'])->name('tambah-stok');
    
    Route::get('chart/{id}',[ChartController::class,'index'])->name('chart/');
    Route::get('chart',[ChartController::class,'chart'])->name('chart');
    
    Route::get('diskon',[BukuController::class,'diskon'])->name('diskon');
    
    Route::post('input-diskon',[BukuController::class,'saveDiskon'])->name('input-diskon');
    Route::post('delete-diskon/{id}',[BukuController::class,'deleteDiskon'])->name('delete-diskon');
    
    Route::post('input-chart',[ChartController::class,'inputChart'])->name('input-chart');
    Route::get('delete-chart/{id}',[ChartController::class,'deleteChart'])->name('delete-chart');
    
    Route::post('input-transaction',[TransactionController::class,'create'])->name('input-transaction');
    
    Route::get('transaksi',[TransactionController::class,'index'])->name('transaksi');
    Route::get('detail-transaksi/{id}',[TransactionController::class,'detail'])->name('detail-transaksi');
    Route::get('cetak-struck/{id}',[TransactionController::class,'cetak_pdf'])->name('cetak-struck');

    Route::post('logout',[UserController::class,'keluar'])->name('logout');

});
