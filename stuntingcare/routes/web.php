<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\EdukasiController;
use App\Http\Controllers\KalkulatorController;
use App\Http\Controllers\Admin\AnalisisController;
use App\Http\Controllers\AuthController;

// ── Auth Routes ────────────────────────────────────────────────
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ── Public Routes ──────────────────────────────────────────────
Route::view('/', 'public.index')->name('home');
Route::view('/tentang', 'public.tentang')->name('tentang');
Route::view('/hasil', 'public.hasil')->name('hasil');
Route::view('/faq', 'public.faq')->name('faq');
Route::view('/kontak', 'public.kontak')->name('kontak');

Route::get('/edukasi', [EdukasiController::class, 'index'])->name('edukasi');
Route::get('/edukasi/{slug}', [EdukasiController::class, 'show'])->name('artikel.detail');

Route::get('/kalkulator', [KalkulatorController::class, 'index'])->name('kalkulator');
Route::post('/kalkulator/hitung', [KalkulatorController::class, 'hitung'])->name('kalkulator.hitung');

// ── Admin Routes ───────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Analisis
    Route::controller(AnalisisController::class)->group(function () {
        Route::get('/analisis', 'index')->name('analisis');
        Route::get('/analisis/export', 'exportCsv')->name('analisis.export');
    });

    // Artikel CRUD
    Route::controller(ArticleController::class)->group(function () {
        Route::get('/artikel',                     'index')->name('artikel.list');
        Route::get('/artikel/create',              'create')->name('artikel.create');
        Route::post('/artikel',                    'store')->name('artikel.store');
        Route::get('/artikel/{article}/edit',      'edit')->name('artikel.edit');
        Route::put('/artikel/{article}',           'update')->name('artikel.update');
        Route::patch('/artikel/{article}/archive', 'archive')->name('artikel.archive');
        Route::delete('/artikel/{article}',        'destroy')->name('artikel.destroy');
    });

    // Pengguna CRUD
    Route::controller(UserController::class)->group(function () {
        Route::get('/pengguna',              'index')->name('pengguna');
        Route::get('/pengguna/export-csv',   'exportCsv')->name('pengguna.export');
        Route::post('/pengguna',             'store')->name('pengguna.store');
        Route::put('/pengguna/{user}',       'update')->name('pengguna.update');
        Route::delete('/pengguna/{user}',    'destroy')->name('pengguna.destroy');
    });
});
