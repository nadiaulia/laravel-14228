<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PeriksaController;
use App\Http\Controllers\MemeriksaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing_page');
});

// Route Auth
Route::get('/register', [AuthController::class, 'showRegsiterForm']);
Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// Route Dokter
Route::get('/dokter/dashboard', function () {
    return view('dokter.index');
})->name('dokter.dashboard')->middleware('role:dokter', 'auth');

Route::get('/dokter/obat', [ObatController::class, 'index'])->middleware('role:dokter', 'auth');
Route::get('/dokter/obat/create', [ObatController::class, 'create'])->middleware('role:dokter', 'auth');
Route::post('/dokter/obat', [ObatController::class, 'store'])->middleware('role:dokter', 'auth');
Route::get('/dokter/obat/{id}/edit', [ObatController::class, 'edit'])->middleware('role:dokter', 'auth');
Route::put('/dokter/obat/{id}', [ObatController::class, 'update'])->middleware('role:dokter', 'auth');
Route::delete('/dokter/obat/{id}', [ObatController::class, 'destroy'])->middleware('role:dokter', 'auth');

// Route Pasien
Route::get('/pasien/dashboard', function () {
    return view('pasien.index');
})->name('pasien.dashboard')->middleware('role:pasien', 'auth');
Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () {
Route::get('/periksa', [PeriksaController::class, 'create'])->name('pasien.periksa');
Route::post('/periksa', [PeriksaController::class, 'store'])->name('pasien.periksa.store');
Route::get('/riwayat', [PeriksaController::class, 'index'])->name('pasien.riwayat');
});

// Route Pemeriksaan oleh Dokter
Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->group(function () {
    Route::get('/memeriksa', [MemeriksaController::class, 'index'])->name('dokter.periksa');
    Route::get('/memeriksa/{id}/edit', [MemeriksaController::class, 'edit'])->name('dokter.tambah.pemeriksaan');
    Route::put('/memeriksa/{id}', [MemeriksaController::class, 'update'])->name('dokter.periksa.update');
});



