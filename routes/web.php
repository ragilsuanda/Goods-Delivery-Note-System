<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanSuratJalanController;
use App\Http\Controllers\SuratJalanController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/test', function () {
    return view('admin.test.index');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'doLogin']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/account/setting', [App\Http\Controllers\AccountController::class, 'edit'])->name('account.setting');
    Route::post('/account/setting', [App\Http\Controllers\AccountController::class, 'update'])->name('account.update');
    Route::resource('dashboard', App\Http\Controllers\DashboardController::class);
    Route::resource('databarang', App\Http\Controllers\DatabarangController::class);
    Route::patch('/suratjalan/{id}/status', [SuratJalanController::class, 'updateStatus'])->name('suratjalan.updateStatus');
    Route::resource('suratjalan', SuratJalanController::class);
    Route::get('/suratjalan/{id}/detail', [SuratJalanController::class, 'show'])->name('suratjalan.show');
    Route::get('/laporan/suratjalan', [LaporanSuratJalanController::class, 'index'])->name('laporan.suratjalan');
    Route::get('/laporan/suratjalan/export', [LaporanSuratJalanController::class, 'export'])->name('laporan.suratjalan.export');
    Route::get('/suratjalan/{id}/word', [SuratJalanController::class, 'cetakWord'])->name('suratjalan.word');
});
Route::get('/suratjalan/{id}/cetak', [SuratJalanController::class, 'cetak'])->name('suratjalan.cetak');
