<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WisatawanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth/login');
});

Route::get('/daftar', function () {
    return view('auth/register');
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'Admin'])->group(function () {
    Route::get('/admin/beranda', [AdminController::class, 'berandaAdmin'])->name('beranda-Admin');
    Route::get('/admin/kelolawisatakuliner', [AdminController::class, 'kelolaWisataKuliner'])->name('kelolawisatakuliner');
    Route::get('/admin/tambahwisatakuliner', [AdminController::class, 'halamantambah'])->name('kelolawisatakuliner.tambah');
    Route::get('/wisata/api/kecamatan', [AdminController::class, 'getKecamatan']);
    Route::get('/wisata/api/kelurahan/{districtCode}', [AdminController::class, 'getKelurahan']);
    Route::post('/admin/tambahwisatakuliner/simpan', [AdminController::class, 'simpan'])->name('kelolawisatakuliner.simpan');
    Route::get('/admin/kelolawisatakuliner/detail/{id}', [AdminController::class, 'detail'])->name('kelolawisatakuliner.detail');
    Route::get('/admin/editwisatakuliner/edit/{id}', [AdminController::class, 'halamanedit'])->name('kelolawisatakuliner.edit');
    Route::put('/admin/editwisatakuliner/update/{id}', [AdminController::class, 'update'])->name('kelolawisatakuliner.update');
    Route::delete('/admin/kelolawisatakuliner/{id}', [AdminController::class, 'hapus'])->name('kelolawisatakuliner.hapus');
    Route::get('/admin/verifikasiwisatakuliner', [AdminController::class, 'halamanVerifKuliner'])->name('verifikasiwisatakuliner');
    Route::get('/admin/verifikasiwisatakuliner/detail/{id}', [AdminController::class, 'detailVerifKuliner'])->name('verifikasiwisatakuliner.detail');
    Route::post('/admin/verifikasiwisatakuliner/{id}', [AdminController::class, 'verifikasiWisataKuliner'])->name('verifikasiwisatakuliner.verifikasi');
    Route::get('/admin/verifikasiulasan', [AdminController::class, 'halamanVerifUlasan'])->name('verifikasiulasan');
    Route::get('/admin/verifikasiulasan/detail/{id}', [AdminController::class, 'detailVerifUlasan'])->name('verifikasiulasan.detail');
    Route::post('/admin/verifikasiulasan/{id}', [AdminController::class, 'verifikasiUlasan'])->name('verifikasiulasan.verifikasi');


    // Route::get('/admin/kelolawisatakuliner/detail/{id}', [AdminController::class, 'detail'])->name('kelola-Wisata-Kuliner.detail');
    // Route::put('/admin/kelolawisatakuliner/edit/{id}', [AdminController::class, 'edit'])->name('kelola-Wisata-Kuliner.edit');
    // Route::delete('/admin/kelolawisatakuliner/hapus/{id}', [AdminController::class, 'hapus'])->name('kelola-Wisata-Kuliner.hapus');
});

Route::middleware(['auth', 'Wisatawan'])->group(function () {
    Route::get('/wisatawan/beranda', [WisatawanController::class, 'berandaWisatawan'])->name('beranda-Wisatawan');
    Route::get('/wisatawan/mapwisatakuliner', [WisatawanController::class, 'mapWisataKuliner'])->name('map-WisataKuliner');
    Route::get('/wisatawan/mapwisatakuliner2', [WisatawanController::class, 'mapWisataKuliner2'])->name('map-WisataKuliner2');
    Route::post('/store', [WisatawanController::class, 'store'])->name('store');
    Route::get('/wisatawan/eventsemarang', [WisatawanController::class, 'event'])->name('event');
});

require __DIR__ . '/auth.php';
