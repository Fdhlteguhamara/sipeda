<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==============================
// HALAMAN UTAMA
// ==============================
Route::get('/', function () {
    return view('welcome');
});

// ==============================
// DASHBOARD (SETELAH LOGIN)
// ==============================
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ==============================
// ROUTE AUTH (LARAVEL BREEZE)
// ==============================
require __DIR__.'/auth.php';

// ==============================
// PROFILE (DEFAULT BREEZE)
// ==============================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==============================
// REPORT (FITUR UTAMA SIPEDA)
// ==============================
Route::middleware(['auth'])->group(function () {

    // CRUD laporan
    Route::resource('reports', ReportController::class);

});