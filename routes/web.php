<?php

// use App\Models\User;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OtenController;
// use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\AdminController;
// use App\Http\Controllers\KuotaController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\CallbackController;
use App\Http\Controllers\CHController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DataUserController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EWcontroller;
use App\Http\Controllers\MergePdfController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PPCBController;
use App\Http\Controllers\PpController;
use App\Http\Controllers\ShortLinkController;
// use App\Http\Controllers\KuotaCekController;
use App\Http\Controllers\SocialiteController;
use App\Models\ShortLink;

// Rute halaman utama
Route::get('/', function () {
    return view('welcome');
});
Route::get('/coba', function () {
    return view('indexkuy');
});
Route::get('/servis', [EWcontroller::class, 'cekharga'])->name('cekharga');;

Route::get('/login', [OtenController::class, 'login'])->name('login');
Route::post('/login', [OtenController::class, 'otentikasi']);
Route::get('/register', [OtenController::class, 'register'])->name('register');
Route::post('/register', [OtenController::class, 'registeruser'])->name('register');

// Route::middleware(['web'])->group(function () {});

// Route::get('login/google', [SocialiteController::class, 'redirect'])->name('login.google');
// Route::get('auth/google/callback', [SocialiteController::class, 'callback']);

Route::get('login/google', [SocialiteController::class, 'redirect'])->name('login.google');
Route::get('login/google/callback', [SocialiteController::class, 'callback']);
Route::post('/callback/portalpulsa', [PPCBController::class, 'handleCallback']);
// Rute dengan middleware auth
Route::middleware(['auth'])->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('dashboard/turnitin', [AdminController::class, 'dokumenindex'])->name('admin.turnitin');
    Route::get('dashboard/turnitin/uncheck', [AdminController::class, 'dokumenindex2'])->name('admin.turnitinuncheck');
    Route::post('dashboard/turnitin/{id}/status', [AdminController::class, 'updateStatus'])->name('dashboard.updateStatus');
    Route::get('dashboard/turnitin/{id}/download', [AdminController::class, 'download'])->name('dashboard.download');
    Route::post('dashboard/turnitin/{id}/upload', [AdminController::class, 'uploadChecked'])->name('dashboard.uploadChecked');
    Route::get('dashboard/turnitin/{id}/upload', [AdminController::class, 'uploadChecked'])->name('dashboard.uploadChecked');
    Route::get('/dashboard/datauser', [DataUserController::class, 'index'])->name('dashboard.datauser.hapus');
    Route::get('/dashboard/datauser', [DataUserController::class, 'index'])->name('admin.datauser');
    Route::get('/dashboard/ceksaldopulsa', [PpController::class, 'ceksaldo'])->name('admin.dashboard.depopulsa');
    // Route::get('/dashboard/ceksaldopulsa', [PpController::class, 'cekharga'])->name('admin.dashboard.depopulsa');
    Route::post('/dashboard/ceksaldopulsa', [PpController::class, 'depo'])->name('admin.dashboard.depopulsa');
    Route::resource('users', DataUserController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    // Dashboard Customer
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer.dashboard');
    Route::get('customer/turnitin', [DocumentController::class, 'index'])->name('customer.cekturnitin');
    Route::post('customer/turnitin', [DocumentController::class, 'store'])->name('customer.store');
    Route::get('customer/{dokument}/download', [DocumentController::class, 'download'])->name('customer.download');
    Route::get('customer/isisaldo', [SaldoController::class, 'index'])->name('customer.isisaldo');
    // Route::post('customer/isisaldo', [SaldoController::class, 'createTopup'])->name('customer.isisaldo');
    Route::post('customer/turnitin/belikuota', [DocumentController::class, 'belikuota'])->name('customer.belikuota');
    Route::get('customer/pulsa', [CustomerController::class, 'belipulsaindex'])->name('customer.belipulsa');
    Route::post('customer/pulsa', [CustomerController::class, 'belipulsa'])->name('customer.belipulsa');
    Route::get('customer/pulsa', [CHController::class, 'cekharga'])->name('customer.belipulsa');
    Route::get('customer/pulsa/topup', [CHController::class, 'topup'])->name('customer.topup');
    Route::post('customer/pulsa/topup', [CHController::class, 'topup'])->name('customer.topup');
    Route::get('customer/pulsa/token', [CHController::class, 'tokenlistrik'])->name('customer.token');
    Route::post('customer/pulsa/token', [CHController::class, 'tokenlistrik'])->name('customer.token');
    Route::get('customer/pulsa/gopay', [CHController::class, 'topupgopay'])->name('customer.gopay');
    Route::post('customer/pulsa/gopay', [CHController::class, 'topupgopay'])->name('customer.gopay');
    // Route::get('customer/pulsa/riwayatcb', [PPCBController::class, 'index'])->name('customer.ppcb');
    Route::post('customer/edithp', [DataUserController::class, 'update'])->name('customer.edithp');
    Route::get('customer/edithp', [DataUserController::class, 'update'])->name('customer.edithp');


    // Route::prefix('customer')->group(function () {

    // Halaman utama untuk daftar short link

    // Route::get('customer/{shortUrl}', [ShortLinkController::class, 'redirect'])->name('shortlink.redirect');  // Redirect ke URL asli
    // Route::delete('customer/short-link/{id}', [ShortLinkController::class, 'destroy']);  // Untuk menghapus short link

    // });
    Route::post('/callback', [CallbackController::class, 'handle'])->withoutMiddleware(['auth', 'web']);
    // Route::get('/callback', [CallbackController::class, 'handle'])->withoutMiddleware(['auth', 'web']);


    // Logout menggunakan POST
    Route::post('/logout', [OtenController::class, 'logout'])->name('logout');
});
