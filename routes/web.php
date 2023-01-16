<?php

use Illuminate\Support\Facades\Route;
use App\http\controllers\ContactController;
use App\http\controllers\PaymentController;
use App\http\controllers\PpdbController;

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

//landing page//
Route::get('/',[PpdbController::class, 'index'])->name('index');
Route::get('/daftar',[PpdbController::class, 'daftar'])->name('daftar');
Route::post('/daftar/input', [PpdbController::class, 'daftarAccount'])->name('daftar.input');
Route::get('/pdf',[PpdbController::class, 'pdf'])->name('pdf');

//login
Route::middleware('Guest')->group(function() {
Route::get('/login',[PpdbController::class,'login'])->name('login');
Route::post('/login/auth',[PpdbController::class,'auth'])->name('login.auth');
});

//dashboard user//
Route::middleware(['Login', 'Role:user'])->group(function(){
Route::get('/dashboard',[PaymentController::class,'dashboard'])->name('finance.dashboard');
Route::get('/createPayment', [PaymentController::class,'createPayment'])->name('createPayment');
Route::patch('/update/payment', [PaymentController::class,'update'])->name('updatePayment');
Route::post('/pembayaran', [PaymentController::class, 'store'])->name('payment');
});

//dashboard admin//
Route::middleware(['Login', 'Role:admin'])->group(function(){
Route::get('/admindash',[PaymentController::class,'admindash'])->name('admin.dashboard');
Route::get('/verifikasi',[PaymentController::class,'verifikasi'])->name('verifikasi');
Route::patch('/update/{id}',[PaymentController::class,'update'])->name('update');
Route::get('/admin/bukti/{id}',[PaymentController::class,'bukti'])->name('bukti');
Route::get('/admin/detail/{id}',[PaymentController::class,'detail'])->name('detail');
Route::patch('/accepted/{id}',[PaymentController::class,'accepted'])->name('accepted');
Route::patch('/rejected/{id}',[PaymentController::class,'rejected'])->name('rejected');
});

Route::get('/logout', [PpdbController::class, 'logout'])->name('logout');
Route::get('/error', [PpdbController::class, 'error'])->name('error');

