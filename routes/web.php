<?php

use Illuminate\Support\Facades\Route;

// Controllers ------------------------------------------------
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PenumpangController;

// Homepage ---------------------------------------------------
Route::get('/', function () {
    return view('home')->with('title', 'RoyAir');
});

// Route untuk calon penumpang ----------------------------------

# Redirects
Route::get('/login', [PenumpangController::class, 'login'])->name('penumpang.login');
Route::get('/cari-tiket', [PenumpangController::class, 'searchForm'])->name('penumpang.cari');

# Proses
Route::post('/login', [PenumpangController::class, 'cekLogin'])->name('penumpang.ceklogin');
Route::post('/cari-tiket', [PenumpangController::class, 'find'])->name('penumpang.search');

// Route untuk petugas ------------------------------------------

# Redirects
Route::get('/misc/petugas/', [PetugasController::class, 'login'])->name('petugas.login');
Route::get('/misc/petugas/dashboard', [PetugasController::class, 'index'])->name('petugas.index');

# Proses
Route::post('/misc/petugas', [PetugasController::class, 'cekLogin'])->name('petugas.ceklogin');