<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\WisatawanController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WisataKulinerController;
use App\Http\Controllers\KulinerFavoritController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\PengajuanWKulinerController;
use Illuminate\Support\Facades\Route;

// Route::get('/login', function () {
//     return view('auth/login');
// })->name('login');

// Route::get('/daftar', function () {
//     return view('auth/daftar');
// });

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'tampilkanProfil'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'tampilkanEditProfil'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'updateDetail'])->name('profile.update');
    // Route::patch('/profile/updatePassword', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/cek-lokasi', [WisataKulinerController::class, 'cekLokasi']);
    Route::get('/wisata/api/kecamatan', [WisataKulinerController::class, 'getKecamatan']);
    Route::get('/wisata/api/kelurahan/{districtCode}', [WisataKulinerController::class, 'getKelurahan']);
});

Route::middleware(['auth', 'Admin'])->group(function () {
    Route::get('/admin/beranda', [BerandaController::class, 'tampilkanBerandaAdmin'])->name('beranda.Admin');

    // Kelola Wisata Kuliner, Kategori, dan Fasilitas
    Route::get('/admin/kelolawisatakuliner', [WisataKulinerController::class, 'tampilkanKelolaWK'])->name('kelolawisatakuliner');
    Route::get('/admin/kelolawisatakuliner/detail/{id}', [WisataKulinerController::class, 'tampilkanDetailWK'])->name('kelolawisatakuliner.detail');
    Route::get('/admin/tambahwisatakuliner', [WisataKulinerController::class, 'tampilkanTambahWK'])->name('kelolawisatakuliner.tambah');
    Route::post('/admin/tambahwisatakuliner/simpan', [WisataKulinerController::class, 'simpan'])->name('kelolawisatakuliner.simpan');
    Route::get('/admin/editwisatakuliner/edit/{id}', [WisataKulinerController::class, 'tampilkanEditWK'])->name('kelolawisatakuliner.edit');
    Route::put('/admin/editwisatakuliner/update/{id}', [WisataKulinerController::class, 'update'])->name('kelolawisatakuliner.update');
    Route::get('/admin/kelolawisatakuliner/ubahstatus/{id}', [WisataKulinerController::class, 'ubahStatusOperasional'])->name('kelolawisatakuliner.ubahstatusoperasional');
    // Route::delete('/admin/kelolawisatakuliner/hapus/{id}', [WisataKulinerController::class, 'hapus'])->name('kelolawisatakuliner.hapus');

    // Route::get('/admin/kelolakategori', [KategoriController::class, 'tampilkanKelolaKategori'])->name('kelolakategori');
    Route::get('/admin/kelolakategori/detail/{id}', [KategoriController::class, 'detail'])->name('kelolakategori.detail');
    Route::post('/admin/kelolakategori', [KategoriController::class, 'simpan'])->name('kelolakategori.simpan');
    Route::put('/admin/kelolakategori/{id}', [KategoriController::class, 'update'])->name('kelolakategori.update');
    Route::delete('/admin/kelolakategori/hapus/{id}', [KategoriController::class, 'hapus'])->name('kelolakategori.hapus');
    Route::put('/admin/kelolakategori/aktifkan/{id}', [KategoriController::class, 'aktifkan'])->name('kelolakategori.aktifkan');

    // Route::get('/admin/kelolafasilitas', [FasilitasController::class, 'kelolaFasilitas'])->name('kelolafasilitas');
    Route::get('/admin/kelolafasilitas/detail/{id}', [FasilitasController::class, 'detail'])->name('kelolafasilitas.detail');
    Route::post('/admin/kelolafasilitas', [FasilitasController::class, 'simpan'])->name('kelolafasilitas.simpan');
    Route::put('/admin/kelolafasilitas/{id}', [FasilitasController::class, 'update'])->name('kelolafasilitas.update');
    Route::delete('/admin/kelolafasilitas/hapus/{id}', [FasilitasController::class, 'hapus'])->name('kelolafasilitas.hapus');
    Route::put('/admin/kelolafasilitas/aktifkan/{id}', [FasilitasController::class, 'aktifkan'])->name('kelolafasilitas.aktifkan');

    Route::get('/admin/kelolaulasan', [UlasanController::class, 'tampilkanKelolaUlasan'])->name('kelolaulasan');
    Route::get('/admin/kelolaulasan/detail/{id}', [UlasanController::class, 'tampilkanDetailUlasan'])->name('kelolaulasan.detail');
    Route::put('/admin/kelolaulasan/ubahstatus/{id}', [UlasanController::class, 'ubahStatusPenampilan'])->name('kelolaulasan.ubahstatuspenampilan');

    // Verifikasi Wisata Kuliner dan Ulasan
    Route::get('/admin/verifikasiwisatakuliner', [WisataKulinerController::class, 'tampilkanHalVerifikasi'])->name('verifikasi');
    Route::get('/admin/verifikasiwisatakuliner/detail/{id}', [WisataKulinerController::class, 'tampilkanDetailVerifWK'])->name('verifikasiwisatakuliner.detail');
    Route::post('/admin/verifikasiwisatakuliner/{id}', [WisataKulinerController::class, 'verifikasiWisataKuliner'])->name('verifikasiwisatakuliner.verifikasi');
    Route::post('/admin/tampilkanwisatakuliner/{id}', [AdminController::class, 'tampilkanWisataKuliner'])->name('verifikasiwisatakuliner.tampilkan');

    Route::get('/admin/verifikasiulasan/detail/{id}', [UlasanController::class, 'tampilkanDetailVerifUlasan'])->name('verifikasiulasan.detail');
    Route::post('/admin/verifikasiulasan/{id}', [UlasanController::class, 'verifikasiUlasan'])->name('verifikasiulasan.verifikasi');
    // Route::delete('/admin/verifikasiulasan/hapus/{id}', [AdminController::class, 'hapusUlasan'])->name('ulasan.hapus');



    // Route::get('/admin/tambahwisatakuliner', [AdminController::class, 'halamantambah'])->name('kelolawisatakuliner.tambah');
    // Route::get('/wisata/api/kecamatan', [AdminController::class, 'getKecamatan']);
    // Route::get('/wisata/api/kelurahan/{districtCode}', [AdminController::class, 'getKelurahan']);
    // Route::post('/admin/tambahwisatakuliner/simpan', [AdminController::class, 'simpan'])->name('kelolawisatakuliner.simpan');
    // Route::get('/admin/kelolawisatakuliner/detail/{id}', [AdminController::class, 'detail'])->name('kelolawisatakuliner.detail');
    // Route::get('/admin/editwisatakuliner/edit/{id}', [AdminController::class, 'halamanedit'])->name('kelolawisatakuliner.edit');
    // Route::put('/admin/editwisatakuliner/update/{id}', [AdminController::class, 'update'])->name('kelolawisatakuliner.update');
    // Route::delete('/admin/kelolawisatakuliner/{id}', [AdminController::class, 'hapus'])->name('kelolawisatakuliner.hapus');



    Route::get('/selectmhsadmin', [AdminController::class, 'selectmhs'])->name('select.mhs.admin');
    Route::get('/selectmkadmin/{id}', [AdminController::class, 'selectmk'])->name('select.mk.admin');
    Route::get('/ngampumkadmin/{id}', [AdminController::class, 'getngampu'])->name('getngampumk.admin');
    Route::get('/selectkategoriadmin/{id}', [AdminController::class, 'selectkategori'])->name('select.kategori.admin');
    Route::get('/ngampukategoriadmin/{id}', [AdminController::class, 'getKategori'])->name('getngampukategori.admin');
});

Route::middleware(['auth', 'Wisatawan'])->group(function () {
    // Icon Beranda
    Route::get('/wisatawan/beranda', [BerandaController::class, 'tampilkanBerandaWisatawan'])->name('beranda-Wisatawan');
    Route::get('/wisatawan/beranda/detail/{id}', [BerandaController::class, 'tampilkanDetailWKuliner'])->name('berandaWisatawan.detail');

    Route::get('/wisata-kuliner-cari', [WisataKulinerController::class, 'cariWisataKuliner'])->name('wisatakulinerhalaman');
    Route::post('/wisatawan/ulasan/simpan', [UlasanController::class, 'simpan'])->name('ulasan.simpan');
    Route::get('/wisatawan/ulasan/detail/{id}', [UlasanController::class, 'detail'])->name('penilaianulasan.detail');
    Route::delete('/wisatawan/ulasan/{id}', [UlasanController::class, 'hapus'])->name('penilaianulasan.hapus');
    Route::get('/wisatawan/ulasan/modalulasan/{id}', [UlasanController::class, 'tampilkanFormUlasan']);

    // Icon Favorit
    Route::get('/wisatawan/favorit', [KulinerFavoritController::class, 'tampilkanHalamanFavorit'])->name('favorit');
    Route::post('/wisatawan/favorit/simpan', [KulinerFavoritController::class, 'simpan'])->name('favorit.simpan');
    // Route::delete('/favorit/hapus', [KulinerFavoritController::class, 'hapusFavoritDariList'])->name('favorit.hapusdarilist');
    Route::delete('/wisatawan/favorit/hapus/{id}', [KulinerFavoritController::class, 'hapus'])->name('favorit.hapus');
    Route::get('/wisatawan/favorit/detail/{id}', [KulinerFavoritController::class, 'tampilkanDetailWKuliner'])->name('favorit.detail');


    // Icon Tambah
    Route::get('/wisatawan/tambahwisatakuliner', [PengajuanWKulinerController::class, 'tampilkanTambahWK'])->name('wisatakuliner.tambah');
    Route::post('/wisatawan/tambahwisatakuliner/simpan', [PengajuanWKulinerController::class, 'simpan'])->name('wisatakuliner.simpan');
    Route::get('/wisatawan/editwisatakuliner/{id}', [PengajuanWKulinerController::class, 'tampilkanEditWK'])->name('wisatakuliner.edit');
    Route::put('/wisatawan/editwisatakuliner/update/{id}', [PengajuanWKulinerController::class, 'update'])->name('wisatakuliner.update');

    // Route::get('/wisatawan/wisata/api/kecamatan', [WisatawanController::class, 'getKecamatan']);
    // Route::get('/wisatawan/wisata/api/kelurahan/{districtCode}', [WisatawanController::class, 'getKelurahan']);
    Route::get('/selectmhs', [WisatawanController::class, 'selectmhs'])->name('select.mhs');
    Route::get('/selectmk/{id}', [WisatawanController::class, 'selectmk'])->name('select.mk');
    Route::get('/ngampumk/{id}', [WisatawanController::class, 'getngampu'])->name('getngampumk');
    Route::get('/selectkategori/{id}', [WisatawanController::class, 'selectkategori'])->name('select.kategori');
    Route::get('/ngampukategori/{id}', [WisatawanController::class, 'getKategori'])->name('getngampukategori');
    // Route::put('/wisatawan/editwisatakuliner/update/{id}', [WisatawanController::class, 'update'])->name('updatewisatakuliner');

    Route::get('/detailkuliner/{id}', [KulinerFavoritController::class, 'detail'])->name('detailkuliner');
    // Route::get('/adatag', [WisatawanController::class, 'adatags']);
    // Route::post('/wisatawan/category', [WisatawanController::class, 'getCategory'])->name('get-category');
    // Route::get('/wisatawan/mapwisatakuliner', [WisatawanController::class, 'mapWisataKuliner'])->name('map-WisataKuliner');
    // Route::get('/wisatawan/mapwisatakuliner2', [WisatawanController::class, 'mapWisataKuliner2'])->name('map-WisataKuliner2');
    // Route::get('/cobaya', [WisataKulinerController::class, 'coba'])->name('cobacoba');

    Route::get('/wisatawan/riwayatpengajuan', [PengajuanWKulinerController::class, 'tampilkanRiwayatPengajuan'])->name('riwayatpengajuan');
    Route::get('/wisatawan/riwayatpengajuan/detail/kuliner/{id}', [PengajuanWKulinerController::class, 'tampilkanDetailWKuliner'])->name('riwayatpengajuan.detailkuliner');
    Route::get('/wisatawan/riwayatpengajuan/detail/ulasan/{id}', [PengajuanWKulinerController::class, 'tampilkanDetailUlasan'])->name('riwayatpengajuan.detailulasan');


    // Route::post('/store', [WisatawanController::class, 'store'])->name('store');
    // Route::get('/wisatawan/diarikuliner', [WisatawanController::class, 'halamanDiari'])->name('diarikuliner');
    // Route::get('/wisatawan/diarikuliner/detail/{id}', [WisatawanController::class, 'detailDiari'])->name('diarikuliner.detail');
    // Route::get('/wisatawan/diarikuliner/tambah', [WisatawanController::class, 'tambahDiari'])->name('diarikuliner.tambah');
    // Route::post('/wisatawan/diarikuliner/simpan', [WisatawanController::class, 'simpanDiari'])->name('diarikuliner.simpan');
    // Route::get('/wisatawan/diarikuliner/edit/{id}', [WisatawanController::class, 'editDiari'])->name('diarikuliner.edit');
    // Route::put('/wisatawan/diarikuliner/update/{id}', [WisatawanController::class, 'updateDiari'])->name('diarikuliner.update');
    // Route::delete('/wisatawan/diarikuliner/hapus/{id}', [WisatawanController::class, 'hapusDiari'])->name('diarikuliner.hapus');

    // Route::delete('/wisatawan/hapus-preferensi', [WisatawanController::class, 'hapusPreferensi']);
});

// SEMUA
// Wisatawan Tidak Login


Route::get('/', [BerandaController::class, 'tampilkanBerandaTamu'])->name('beranda.tidaklogin');
Route::get('/favorit', [WisatawanController::class, 'halamanFavoritTidakLogin'])->name('favorit.tidaklogin');
Route::get('/tambahwisatakuliner', [WisatawanController::class, 'halamantambahTidakLogin'])->name('tambahwisatakuliner.tidaklogin');
Route::post('/tambahwisatakuliner/simpan', [WisatawanController::class, 'simpankulinerTidakLogin'])->name('simpanwisatakuliner.tidaklogin');
Route::get('/editwisatakuliner/{id}', [WisatawanController::class, 'halamaneditTidakLogin'])->name('editwisatakuliner.tidaklogin');
Route::put('/editwisatakuliner/update/{id}', [WisatawanController::class, 'updateTidakLogin'])->name('updatewisatakuliner.tidaklogin');
Route::get('/carikuliner', [WisatawanController::class, 'search'])->name('carikuliner.tidaklogin');
Route::post('/ulasan/simpan', [UlasanController::class, 'simpanTidakLogin'])->name('simpanpenilaianulasan.tidaklogin');
Route::get('/ulasan/{id}', [UlasanController::class, 'detailTidakLogin'])->name('detailpenilaianulasan.tidaklogin');
Route::get('/ulasan/modalulasan/{id}', [UlasanController::class, 'getUlasanTidakLogin']);

// Event
Route::get('/wisatawan/eventsemarang/dugderan', [WisatawanController::class, 'dugderan'])->name('dugderan');
Route::get('/wisatawan/eventsemarang/kulinerkauman', [WisatawanController::class, 'kulinerkauman'])->name('kulinerkauman');
Route::get('/wisatawan/eventsemarang/semawis', [WisatawanController::class, 'semawis'])->name('semawis');

// Kecamatan, Kelurahan, Dropdown nama kategori fasilitas
// Route::post('/wisatawan/cek-lokasi', [WisatawanController::class, 'cekLokasi']);


require __DIR__ . '/auth.php';
