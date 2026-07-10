<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\EdukasiController;
use App\Http\Controllers\KalkulatorController;
use App\Http\Controllers\Admin\AnalisisController;
use App\Http\Controllers\AuthController;

// ── Auth Routes ──────────────────────────────────────────────
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
});


// ── Public Routes ──────────────────────────────────────────────
Route::get('/', function () {
    $latestArticles = \App\Models\Article::published()
        ->latest('published_date')
        ->limit(3)
        ->get();
    return view('public.index', compact('latestArticles'));
})->name('home');
Route::view('/tentang', 'public.tentang')->name('tentang');
Route::view('/hasil', 'public.hasil')->name('hasil');
Route::view('/faq', 'public.faq')->name('faq');
Route::view('/kontak', 'public.kontak')->name('kontak');

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
        Route::view('/hasil-analisis-risiko', 'admin.hasil-analisis-risiko')->name('hasil-analisis-risiko');
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
});
