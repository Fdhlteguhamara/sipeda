<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Models\Report;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// HALAMAN UTAMA
Route::get('/', function () {
    return view('login');
});

// DASHBOARD
Route::get('/dashboard', function () {

    return view('dashboard', [
        'total' => Report::count(),
        'pending' => Report::where('status', 'pending')->count(),
        'proses' => Report::where('status', 'proses')->count(),
        'selesai' => Report::where('status', 'selesai')->count(),
        'reports' => Report::latest()->take(5)->get()
    ]);

})->middleware(['auth'])->name('dashboard');

// AUTH
require __DIR__.'/auth.php';

// PROFILE
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

// PUBLIC
Route::get('/reports', [ReportController::class, 'index']);
Route::get('/reports/{report}', [ReportController::class, 'show']);

// AUTH ONLY
Route::middleware('auth')->group(function () {

    Route::get('/reports/create', [ReportController::class, 'create']);

    Route::post('/reports', [ReportController::class, 'store']);

});