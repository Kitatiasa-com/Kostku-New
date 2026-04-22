<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenghuniController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\ProfileController;

// Route untuk Guest (Belum Login)
Route::get('/', function () { return view('welcome'); });

// Route yang membutuhkan Autentikasi
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard Utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- FITUR KHUSUS OWNER (Role: Admin/Owner) ---
    Route::middleware(['role:owner'])->group(function () {
        // Data Kamar
        Route::resource('kamars', KamarController::class);

        // Data Penghuni & History
        Route::get('/penghunis/history', [PenghuniController::class, 'history'])->name('penghuni.history');
        Route::patch('/penghunis/{tenant}/status', [PenghuniController::class, 'updateStatus'])->name('penghuni.status');
        Route::resource('penghunis', PenghuniController::class);

        // Kode Kost (Generate & Manage)
        Route::get('/settings/kost-code', [DashboardController::class, 'kostCode'])->name('settings.kost-code');
    });

    // --- FITUR KHUSUS PENGHUNI (Role: Tenant) ---
    Route::middleware(['role:penghuni'])->group(function () {
        // Pembayaran (Lunas & Cicilan)
        Route::get('/payments/checkout', [PembayaranController::class, 'checkout'])->name('payments.checkout');
        Route::post('/payments/pay-full', [PembayaranController::class, 'payFull'])->name('payments.pay-full');
        Route::post('/payments/pay-installment', [PembayaranController::class, 'payInstallment'])->name('payments.pay-installment');

        // Join Kost via Kode
        Route::post('/join-kost', [PenghuniController::class, 'joinByCode'])->name('join.kost');
    });

    // --- FITUR BERSAMA (Shared) ---
    // Pembayaran (History & Detail)
    Route::get('/payments', [PembayaranController::class, 'index'])->name('payments.index');
    Route::get('/payments/{payment}', [PembayaranController::class, 'show'])->name('payments.show');

    // Pengaduan
    Route::resource('pengaduans', PengaduanController::class);
});

// Webhook untuk Payment Gateway (Midtrans) - Matikan CSRF untuk route ini
Route::post('/payments/notification', [PembayaranController::class, 'notification'])->name('payments.notification');

require __DIR__.'/auth.php';

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';
