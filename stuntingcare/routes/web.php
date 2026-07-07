<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\EdukasiController;
use App\Http\Controllers\KalkulatorController;

// ── Public Routes ──────────────────────────────────────────────
Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

Route::get('/edukasi', [EdukasiController::class, 'index'])->name('edukasi');

Route::get('/kalkulator', [KalkulatorController::class, 'index'])->name('kalkulator');
Route::post('/kalkulator/hitung', [KalkulatorController::class, 'hitung'])->name('kalkulator.hitung');

Route::get('/hasil', function () {
    return view('hasil');
})->name('hasil');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

Route::get('/edukasi/{slug}', [EdukasiController::class, 'show'])->name('artikel.detail');

// ── Admin Routes ───────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Analisis (static view for now)
    Route::get('/analisis', function () {
        return view('admin.analisis');
    })->name('analisis');

    // Artikel CRUD
    Route::get('/artikel',                    [ArticleController::class, 'index'])->name('artikel.list');
    Route::get('/artikel/create',             [ArticleController::class, 'create'])->name('artikel.create');
    Route::post('/artikel',                   [ArticleController::class, 'store'])->name('artikel.store');
    Route::get('/artikel/{article}/edit',     [ArticleController::class, 'edit'])->name('artikel.edit');
    Route::put('/artikel/{article}',          [ArticleController::class, 'update'])->name('artikel.update');
    Route::patch('/artikel/{article}/archive',[ArticleController::class, 'archive'])->name('artikel.archive');
    Route::delete('/artikel/{article}',       [ArticleController::class, 'destroy'])->name('artikel.destroy');

    // Pengguna CRUD
    Route::get('/pengguna/export-csv',   [UserController::class, 'exportCsv'])->name('pengguna.export');
    Route::get('/pengguna',              [UserController::class, 'index'])->name('pengguna');
    Route::post('/pengguna',             [UserController::class, 'store'])->name('pengguna.store');
    Route::put('/pengguna/{user}',       [UserController::class, 'update'])->name('pengguna.update');
    Route::delete('/pengguna/{user}',    [UserController::class, 'destroy'])->name('pengguna.destroy');
});
