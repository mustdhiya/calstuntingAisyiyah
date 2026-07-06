<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

Route::get('/edukasi', function () {
    return view('edukasi');
})->name('edukasi');

Route::get('/kalkulator', function () {
    return view('kalkulator');
})->name('kalkulator');

Route::get('/hasil', function () {
    return view('hasil');
})->name('hasil');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

Route::get('/artikel-detail', function () {
    return view('artikel-detail');
})->name('artikel.detail');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/analisis', function () {
        return view('admin.analisis');
    })->name('analisis');

    Route::get('/artikel', function () {
        return view('admin.artikel-list');
    })->name('artikel.list');

    Route::get('/artikel/edit', function () {
        return view('admin.artikel-edit');
    })->name('artikel.edit');

    Route::get('/pengguna', function () {
        return view('admin.pengguna');
    })->name('pengguna');
});

