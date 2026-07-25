<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\EdukasiController;
use App\Http\Controllers\KalkulatorController;
use App\Http\Controllers\Admin\AnalisisController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicController;

// ── Auth Routes ──────────────────────────────────────────────
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
});


// ── Public Routes ──────────────────────────────────────────────
Route::controller(PublicController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/faq', 'faq')->name('faq');

    Route::view('/tentang', 'public.tentang')->name('tentang');
    Route::view('/hasil', 'public.hasil')->name('hasil');
    Route::view('/kontak', 'public.kontak')->name('kontak');
});

Route::controller(EdukasiController::class)->group(function () {
    Route::get('/edukasi', 'index')->name('edukasi');
    Route::get('/edukasi/{slug}', 'show')->name('artikel.detail');
});

Route::controller(KalkulatorController::class)->group(function () {
    Route::get('/kalkulator', 'index')->name('kalkulator');
    Route::post('/kalkulator/hitung', 'hitung')->name('kalkulator.hitung');
});

// ── Admin Routes ───────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Analisis
    Route::controller(AnalisisController::class)->group(function () {
        Route::get('/analisis', 'index')->name('analisis');
        Route::get('/analisis/peta', 'peta')->name('analisis.peta');
        Route::get('/analisis/export', 'exportCsv')->name('analisis.export');
        Route::get('/analisis/{measurement}/hasil', 'detailHasil')->name('analisis.detail-hasil');
        Route::get('/hasil-analisis-risiko', 'hasilAnalisisRisikoForm')->name('hasil-analisis-risiko');
        Route::post('/hasil-analisis-risiko/simpan', 'saveRecommendations')->name('hasil-analisis-risiko.simpan');
    });

    // Artikel CRUD
    Route::controller(ArticleController::class)->group(function () {
        Route::get('/artikel',                     'index')->name('artikel.list');
        Route::get('/artikel/create',              'create')->name('artikel.create');
        Route::post('/artikel',                    'store')->name('artikel.store');
        Route::get('/artikel/{article}/edit',      'edit')->name('artikel.edit');
        Route::get('/artikel/{article}/preview',   'preview')->name('artikel.preview');
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

    // CRUD FAQ
    Route::controller(FaqController::class)->group(function () {
        Route::get('/crud-faq',          'index')->name('crud-faq');
        Route::post('/crud-faq',         'store')->name('crud-faq.store');
        Route::put('/crud-faq/{faq}',    'update')->name('crud-faq.update');
        Route::delete('/crud-faq/{faq}', 'destroy')->name('crud-faq.destroy');
    });
});
