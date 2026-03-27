<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WisatawanController;
use App\Http\Controllers\PenilaianDanUlasanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WisataKulinerController;
use App\Models\PenilaiandanUlasan;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
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
    Route::get('/wisatawan/tambahwisatakuliner', [WisatawanController::class, 'halamantambah'])->name('tambahwisatakuliner');
    Route::get('/wisatawan/wisata/api/kecamatan', [WisatawanController::class, 'getKecamatan']);
    Route::get('/wisatawan/wisata/api/kelurahan/{districtCode}', [WisatawanController::class, 'getKelurahan']);
    Route::post('/wisatawan/tambahwisatakuliner/simpan', [WisatawanController::class, 'simpan'])->name('simpanwisatakuliner');
    Route::get('/wisatawan/diarikuliner', [WisatawanController::class, 'halamanDiari'])->name('diarikuliner');
    Route::get('/wisatawan/diarikuliner/detail/{id}', [WisatawanController::class, 'detailDiari'])->name('diarikuliner.detail');
    Route::get('/wisatawan/diarikuliner/tambah', [WisatawanController::class, 'tambahDiari'])->name('diarikuliner.tambah');
    Route::post('/wisatawan/diarikuliner/simpan', [WisatawanController::class, 'simpanDiari'])->name('diarikuliner.simpan');
    Route::get('/wisatawan/diarikuliner/edit/{id}', [WisatawanController::class, 'editDiari'])->name('diarikuliner.edit');
    Route::put('/wisatawan/diarikuliner/update/{id}', [WisatawanController::class, 'updateDiari'])->name('diarikuliner.update');
    Route::delete('/wisatawan/diarikuliner/hapus/{id}', [WisatawanController::class, 'hapusDiari'])->name('diarikuliner.hapus');
    Route::get('/adatag', [WisatawanController::class, 'adatags']);
    Route::post('/wisatawan/category', [WisatawanController::class, 'getCategory'])->name('get-category');

    Route::get('/selectmhs', [WisatawanController::class, 'selectmhs'])->name('select.mhs');
    Route::get('/selectmk/{id}', [WisatawanController::class, 'selectmk'])->name('select.mk');
    Route::get('/ngampumk/{id}', [WisatawanController::class, 'getngampu'])->name('getngampumk');

    Route::get('/wisata-kuliner-cari', [WisataKulinerController::class, 'search'])->name('wisatakulinerhalaman');

    Route::post('/wisatawan/penilaiandanulasan/simpan', [PenilaianDanUlasanController::class, 'simpan'])->name('penilaianulasan.simpan');


    // Route::get('/search-fasilitas', [WisatawanController::class, 'search']);

    // Route::get('/cari', [HomeController::class, 'create']);
    // Route::post('/simpan', [HomeController::class, 'store'])->name('save.form');
    // Route::get('/selectmhs', [HomeController::class, 'selectmhs'])->name('select.mhs');
    // Route::get('/selectmk/{id}', [HomeController::class, 'selectmk'])->name('select.mk');
    // Route::get('/ngampumk/{id}', [HomeController::class, 'getngampu'])->name('getngampumk');

    // Route::get('ngampumk/{id}', 'getngampu')->name('getngampumk');
    // Route::get('nilai', 'index')->name('list.nilai');
});

require __DIR__ . '/auth.php';
