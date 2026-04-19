<?php

namespace App\Http\Controllers;

use App\Models\WisataKuliner;
use Illuminate\Http\Request;
use App\Models\Wisatawan;
use App\Models\Admin;
use App\Models\DiariKuliner;
use App\Models\Fasilitas;
use App\Models\FasilitasWisataKuliner;
use App\Models\Kategori;
use App\Models\KategoriWisataKuliner;
use App\Models\KulinerFavorit;
use App\Models\PengajuanWisataKuliner;
use App\Models\Preferensi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class WisatawanController extends Controller
{
    // Semua
    public function dugderan()
    {
        return view('event.dugderan');
    }

    public function kulinerkauman()
    {
        return view('event.kulinerkauman');
    }

    public function semawis()
    {
        return view('event.semawis');
    }

    // Wisatawan Login
    public function berandaWisatawan()
    {
        $keyword = $request->keyword ?? 'Rekomendasi Kuliner';
        $kulinerBaru = WisataKuliner::where('status', 'Ditampilkan')->orderBy('waktu_diubah', 'desc')->take(4)->get();
        $kulinerFavorit = WisataKuliner::where('status', 'Ditampilkan')->orderBy('penilaian', 'desc')->take(4)->get();
        $fasilitas = Fasilitas::all();
        $kategori = Kategori::all();
        return view('wisatawan.beranda', compact('fasilitas', 'kategori', 'keyword', 'kulinerBaru', 'kulinerFavorit'));
    }



    public function mapWisataKuliner()
    {
        return view('wisatawan.map-wisatakuliner');
    }

    public function mapWisataKuliner2()
    {
        return view('wisatawan.map-wisatakuliner2');
    }

    public function store(Request $request)
    {
        WisataKuliner::create([
            'latitude' => $request->lat,
            'longitude' => $request->lng
        ]);
        return view('wisatawan.beranda');
    }



    // Wisata Kuliner
    // Tambah Wisata Kuliner

    public function halamantambah()
    {
        $fasilitas = Fasilitas::all();
        $wkuliner = WisataKuliner::where('status', ['Disetujui', 'Ditampilkan'])->get();
        return view('wisatawan.wisata-kuliner.tambah-kuliner', compact('fasilitas', 'wkuliner'));
    }

    // public function simpan(Request $request)
    // {
    //     $request->validate([
    //         'nama' => 'required|string|max:255',
    //         'kecamatan' => 'required|string|max:50',
    //         'kelurahan' => 'required|string|max:50',
    //         'alamat' => 'required|string',
    //         'no_telp' => 'required|string|min:10|max:15',
    //         'email' => 'nullable|email|max:70',
    //         'deskripsi' => 'required|string|max:255',
    //         'foto' => 'required|image|mimes:jpeg,png,jpg|max:10240',
    //         'latitude'  => 'required|numeric|between:-90,90|unique:wisata_kuliner,latitude',
    //         'longitude' => 'required|numeric|between:-180,180|unique:wisata_kuliner,longitude',
    //     ]);

    //     $wisataKuliner = $request->nama;
    //     $fotoPath = $request->file('foto')->storeAs(
    //         'uploads',
    //         'foto_' . Str::slug($wisataKuliner) . '_' . time() . '.' . $request->file('foto')->extension(),
    //         'public'
    //     );

    //     $email_pengaju = Auth::user()->email;

    //     $id_wisatawan = null;
    //     $id_admin = null;
    //     if (Auth::check() && Auth::user()->peran === 'Wisatawan') {
    //         $id_admin = Wisatawan::where('user_id', Auth::id())->value('id_wisatawan');
    //     } elseif (Auth::check() && Auth::user()->peran === 'Admin') {
    //         $id_admin = Admin::where('user_id', Auth::id())->value('id_admin');
    //     }

    //     // $waktu_dibuat = Carbon::now()->format('d/m/Y H:i');
    //     // $waktu_diubah = Carbon::now()->format('d/m/Y H:i');

    //     $waktu_dibuat = Carbon::now('Asia/Jakarta');
    //     $waktu_diubah = Carbon::now('Asia/Jakarta');

    //     $status = 'Belum Diverifikasi';
    //     if (Auth::check() && Auth::user()->peran === 'Admin') {
    //         $status = 'Disetujui';
    //     }

    //     $wisata = WisataKuliner::create([
    //         'nama' => $request->nama,
    //         'kecamatan' => $request->kecamatan,
    //         'kelurahan' => $request->kelurahan,
    //         'alamat' => $request->alamat,
    //         'no_telp' => $request->no_telp,
    //         'email' => $request->email ?? null,
    //         'foto' => $fotoPath,
    //         'deskripsi' => $request->deskripsi,
    //         'latitude'  => $request->latitude,
    //         'longitude' => $request->longitude,
    //         'email_pengaju' => $email_pengaju,
    //         'id_wisatawan' => $id_wisatawan ?? null,
    //         'id_admin' => $id_admin ?? null,
    //         'status' => $status,
    //         'waktu_dibuat' => $waktu_dibuat,
    //         'waktu_diubah' => $waktu_diubah,
    //     ]);

    //     // $fasilitasIds = [];

    //     // foreach ($request->fasilitas as $item) {
    //     //     if (is_numeric($item)) {
    //     //         $fasilitasIds[] = $item;
    //     //     } else {
    //     //         $new = Fasilitas::create([
    //     //             'nama_fasilitas' => $item
    //     //         ]);
    //     //         $fasilitasIds[] = $new->id;
    //     //     }
    //     // }

    //     // $wisata->fasilitas()->sync($fasilitasIds);
    //     // $wisata->fasilitas()->sync($request->fasilitas);
    //     $fasilitasIds = [];

    //     foreach ($request->fasilitas ?? [] as $item) {

    //         // 🔥 Skip kalau kosong
    //         if (empty($item)) continue;

    //         // Kalau sudah berupa ID
    //         if (is_numeric($item)) {

    //             $fasilitasIds[] = $item;
    //         } else {

    //             // 🔥 Cek dulu apakah sudah ada (case insensitive)
    //             $fasilitasBaru = Fasilitas::whereRaw(
    //                 'LOWER(nama) = ?',
    //                 [strtolower(trim($item))]
    //             )->first();

    //             // Kalau belum ada → buat baru
    //             if (!$fasilitasBaru) {
    //                 $fasilitasBaru = Fasilitas::create([
    //                     'nama' => trim($item)
    //                 ]);
    //             }

    //             $fasilitasIds[] = $fasilitasBaru->id_fasilitas;
    //         }
    //     }

    //     // Simpan ke pivot
    //     $wisata->fasilitas()->sync($fasilitasIds);

    //     return redirect()->route('beranda-Wisatawan')->with('success', 'Wisata Kuliner Berhasil Disimpan');
    // }
    public function cekLokasi(Request $request)
    {
        $isDuplikat = $this->cekLokasiDuplikat(
            $request->latitude,
            $request->longitude
        );

        return response()->json([
            'duplikat' => $isDuplikat
        ]);
    }

    private function cekLokasiDuplikat($lat, $lng, $idwisata = null, $idpengajuan = null)
    {
        $queryWisata = WisataKuliner::where('latitude', $lat)
            ->where('longitude', $lng);

        if ($idwisata) {
            $queryWisata->where('id_wisata_kuliner', '!=', $idwisata);
        }

        $queryPengajuan = PengajuanWisataKuliner::where('latitude', $lat)
            ->where('longitude', $lng)
            ->where('status', 'Belum Diverifikasi');

        if ($idpengajuan) {
            $queryPengajuan->where('id_pengajuan', '!=', $idpengajuan);
        }

        return $queryWisata->exists() || $queryPengajuan->exists();
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'nama_wisata_kuliner' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:50',
            'kelurahan' => 'required|string|max:50',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|min:10|max:15',
            'email' => 'nullable|email|max:70',
            'deskripsi' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:10240',
            'latitude'  => 'required|numeric|between:-90,90|unique:wisata_kuliner,latitude',
            'longitude' => 'required|numeric|between:-180,180|unique:wisata_kuliner,longitude',
        ]);

        $fotoPath = $request->file('foto')->storeAs(
            'uploads',
            'foto_' . time() . '.' . $request->file('foto')->extension(),
            'public'
        );

        $email_pengaju = Auth::user()->email;

        $id_wisatawan = null;
        $id_admin = null;
        if (Auth::check() && Auth::user()->peran === 'Wisatawan') {
            $id_admin = Wisatawan::where('user_id', Auth::id())->value('id_wisatawan');
        } elseif (Auth::check() && Auth::user()->peran === 'Admin') {
            $id_admin = Admin::where('user_id', Auth::id())->value('id_admin');
        }

        $waktu_dibuat = Carbon::now('Asia/Jakarta');
        $waktu_diubah = Carbon::now('Asia/Jakarta');

        $status = 'Belum Diverifikasi';
        if (Auth::check() && Auth::user()->peran === 'Admin') {
            $status = 'Disetujui';
        }

        // $wisata = WisataKuliner::create([
        //     'nama' => $request->nama,
        //     'kecamatan' => $request->kecamatan,
        //     'kelurahan' => $request->kelurahan,
        //     'alamat' => $request->alamat,
        //     'no_telp' => $request->no_telp,
        //     'email' => $request->email ?? null,
        //     'foto' => $fotoPath,
        //     'deskripsi' => $request->deskripsi,
        //     'latitude'  => $request->latitude,
        //     'longitude' => $request->longitude,
        //     'email_pengaju' => $email_pengaju,
        //     'id_wisatawan' => $id_wisatawan ?? null,
        //     'id_admin' => $id_admin ?? null,
        //     'status' => $status,
        //     'waktu_dibuat' => $waktu_dibuat,
        //     'waktu_diubah' => $waktu_diubah,
        // ]);

        $dataMK = $request->id_fasilitas ?? [];
        $dataKategori = $request->id_kategori ?? [];
        $idWisata = $request->nama_wisata_kuliner;

        $lat = $request->latitude;
        $lng = $request->longitude;

        if ($this->cekLokasiDuplikat($lat, $lng)) {
            return back()->withErrors([
                'latitude' => 'Lokasi sudah digunakan wisata lain'
            ])->withInput();
        }

        if (!is_numeric($idWisata)) {

            $wisata = PengajuanWisataKuliner::firstOrCreate([
                'nama' => trim($idWisata),
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'email' => $request->email ?? null,
                'foto' => $fotoPath,
                'deskripsi' => $request->deskripsi,
                'latitude'  => $request->latitude,
                'longitude' => $request->longitude,
                'harga_min' => 0,
                'harga_max' => 0,
                'penilaian' => 0,
                'email_pengaju' => $email_pengaju,
                'id_wisatawan' => $id_wisatawan ?? null,
                'id_admin' => $id_admin ?? null,
                'status' => $status,
                'jenis_pengajuan' => 'Baru',
                'waktu_dibuat' => $waktu_dibuat,
                'waktu_diubah' => $waktu_diubah,
            ]);

            $idWisata = $wisata->id_pengajuan;
        }

        $fasilitasIds = [];

        foreach ($dataMK as $item) {

            if (is_numeric($item)) {
                $fasilitasId = $item;
            } else {

                $fasilitas = Fasilitas::firstOrCreate([
                    'nama' => trim($item)
                ]);

                $fasilitasId = $fasilitas->id_fasilitas;
            }

            $fasilitasIds[] = $fasilitasId;
        }

        $wisata = PengajuanWisataKuliner::find($idWisata);

        $wisata->fasilitas()->sync($fasilitasIds);

        $kategoriIds = [];

        foreach ($dataKategori as $item) {

            if (is_numeric($item)) {
                $kategoriId = $item;
            } else {

                $kategori = Kategori::firstOrCreate([
                    'nama' => trim($item)
                ]);

                $kategoriId = $kategori->id_kategori;
            }

            $kategoriIds[] = $kategoriId;
        }

        $wisata = PengajuanWisataKuliner::find($idWisata);

        $wisata->kategori()->sync($kategoriIds);

        return redirect()->route('beranda-Wisatawan')->with('success', 'Wisata Kuliner Berhasil Disimpan');
    }

    public function halamanedit($id)
    {
        $wisataKuliner = WisataKuliner::findOrFail($id);
        $wkuliner = WisataKuliner::where('status', ['Disetujui', 'Ditampilkan'])->get();
        $fasilitas = FasilitasWisataKuliner::with('fasilitas')
            ->where('id_wisata_kuliner', $id)
            // ->where('status', '!=', 'Belum Diverifikasi')
            ->get();
        $kategori = KategoriWisataKuliner::with('kategori')
            ->where('id_wisata_kuliner', $id)
            // ->where('status', '!=', 'Belum Diverifikasi')
            ->get();
        $from = request('from');
        return view('wisatawan.wisata-kuliner.edit-kuliner', compact(
            'wisataKuliner',
            'fasilitas',
            'kategori',
            'wkuliner',
            'from'
        ));
    }

    // public function update(Request $request, $id)
    // {
    //     try {
    //         $from = request('from');
    //         $wisataKuliner = WisataKuliner::findOrFail($id);

    //         $request->validate([
    //             'nama' => 'required|string|max:255',
    //             'kecamatan' => 'required|string|max:50',
    //             'kelurahan' => 'required|string|max:50',
    //             'alamat' => 'required|string',
    //             'no_telp' => 'required|string|min:10|max:15',
    //             'email' => 'nullable|email|max:70',
    //             'deskripsi' => 'required|string|max:255',
    //             'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
    //             'latitude'  => 'required|numeric|between:-90,90',
    //             'longitude' => 'required|numeric|between:-180,180',
    //         ]);

    //         $fotoPath = $wisataKuliner->foto;

    //         if ($request->hasFile('foto')) {
    //             if ($wisataKuliner->foto && Storage::exists('public/' . $wisataKuliner->foto)) {
    //                 Storage::delete('public/' . $wisataKuliner->foto);
    //             }

    //             $fotoPath = $request->file('foto')->storeAs(
    //                 'uploads',
    //                 'foto_' . Str::slug($request->nama) . '_' . time() . '.' . $request->file('foto')->extension(),
    //                 'public'
    //             );
    //         }

    //         $email_pengaju = Auth::user()->email;

    //         $id_wisatawan = null;
    //         $id_admin = null;
    //         if (Auth::check() && Auth::user()->peran === 'Wisatawan') {
    //             $id_admin = Wisatawan::where('user_id', Auth::id())->value('id_wisatawan');
    //         } elseif (Auth::check() && Auth::user()->peran === 'Admin') {
    //             $id_admin = Admin::where('user_id', Auth::id())->value('id_admin');
    //         }

    //         $waktu_diubah = Carbon::now('Asia/Jakarta');

    //         $status = 'Belum Diverifikasi';
    //         if (Auth::check() && Auth::user()->peran === 'Admin') {
    //             $status = 'Disetujui';
    //         }

    //         $dataMK = $request->id_fasilitas ?? [];
    //         $dataKategori = $request->id_kategori ?? [];
    //         $idWisata = $request->nama;

    //         $wisataKuliner->update([
    //             'nama' => $request->nama,
    //             'kecamatan' => $request->kecamatan,
    //             'kelurahan' => $request->kelurahan,
    //             'alamat' => $request->alamat,
    //             'no_telp' => $request->no_telp,
    //             'email' => $request->email ?? null,
    //             'foto' => $fotoPath,
    //             'deskripsi' => $request->deskripsi,
    //             'latitude'  => $request->latitude,
    //             'longitude' => $request->longitude,
    //             'email_pengaju' => $email_pengaju,
    //             'id_wisatawan' => $id_wisatawan ?? null,
    //             'id_admin' => $id_admin ?? null,
    //             'status' => $status,
    //             'waktu_diubah' => $waktu_diubah,
    //         ]);

    //         $idWisata = $wisataKuliner->id_wisata_kuliner;

    //         // Fasilitas
    //         $fasilitasIds = [];

    //         foreach ($dataMK as $item) {

    //             if (is_numeric($item)) {
    //                 $fasilitasId = $item;
    //             } else {

    //                 $fasilitas = Fasilitas::firstOrCreate([
    //                     'nama' => trim($item)
    //                 ]);

    //                 $fasilitasId = $fasilitas->id_fasilitas;
    //             }

    //             $fasilitasIds[] = $fasilitasId;
    //         }

    //         $wisata = WisataKuliner::find($idWisata);

    //         $wisata->fasilitas()->sync($fasilitasIds);

    //         // Kategori
    //         $kategoriIds = [];

    //         foreach ($dataKategori as $item) {

    //             if (is_numeric($item)) {
    //                 $kategoriId = $item;
    //             } else {

    //                 $kategori = Kategori::firstOrCreate([
    //                     'nama' => trim($item)
    //                 ]);

    //                 $kategoriId = $kategori->id_kategori;
    //             }

    //             $kategoriIds[] = $kategoriId;
    //         }

    //         $wisata = WisataKuliner::find($idWisata);

    //         $wisata->kategori()->sync($kategoriIds);
    //     } catch (\Exception $e) {
    //         dd($e->getMessage());
    //     }

    //     // redirect()->route('wisatakulinerhalaman')->with('success', 'Saran Pembaruan Informasi Wisata Kuliner Berhasil Dikirim!');
    //     // return redirect($request->from)
    //     //     ->with('success', 'Berhasil update!');
    //     return redirect($request->from . '&detail=' . $id)
    //         ->with('success', 'Wisata Kuliner Berhasil Diperbarui!');
    // }

    public function update(Request $request, $id)
    {
        try {
            $from = request('from');
            $wisataKuliner = WisataKuliner::findOrFail($id);

            $request->validate([
                'nama' => 'required|string|max:255',
                'kecamatan' => 'required|string|max:50',
                'kelurahan' => 'required|string|max:50',
                'alamat' => 'required|string',
                'no_telp' => 'required|string|min:10|max:15',
                'email' => 'nullable|email|max:70',
                'deskripsi' => 'required|string|max:255',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
                'latitude'  => 'required|numeric|between:-90,90',
                'longitude' => 'required|numeric|between:-180,180',
            ]);

            $fotoPath = $wisataKuliner->foto;

            if ($request->hasFile('foto')) {
                if ($wisataKuliner->foto && Storage::exists('public/' . $wisataKuliner->foto)) {
                    Storage::delete('public/' . $wisataKuliner->foto);
                }

                $fotoPath = $request->file('foto')->storeAs(
                    'uploads',
                    'foto_' . time() . '.' . $request->file('foto')->extension(),
                    'public'
                );
            }

            $email_pengaju = Auth::user()->email;

            $id_wisatawan = null;
            $id_admin = null;
            if (Auth::check() && Auth::user()->peran === 'Wisatawan') {
                $id_admin = Wisatawan::where('user_id', Auth::id())->value('id_wisatawan');
            } elseif (Auth::check() && Auth::user()->peran === 'Admin') {
                $id_admin = Admin::where('user_id', Auth::id())->value('id_admin');
            }

            $waktu_diubah = Carbon::now('Asia/Jakarta');

            $status = 'Belum Diverifikasi';
            if (Auth::check() && Auth::user()->peran === 'Admin') {
                $status = 'Disetujui';
            }

            $dataMK = $request->id_fasilitas ?? [];
            $dataKategori = $request->id_kategori ?? [];
            $idWisata = $request->nama;
            $harga_min = $wisataKuliner->harga_min;
            $harga_max = $wisataKuliner->harga_max;
            $penilaian = $wisataKuliner->penilaian;

            $wisataKuliner = PengajuanWisataKuliner::firstOrCreate([
                'id_wisata_kuliner' => $wisataKuliner->id_wisata_kuliner,
                'nama' => $request->nama,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'email' => $request->email ?? null,
                'foto' => $fotoPath,
                'deskripsi' => $request->deskripsi,
                'latitude'  => $request->latitude,
                'longitude' => $request->longitude,
                'email_pengaju' => $email_pengaju,
                'harga_min' => $harga_min,
                'harga_max' => $harga_max,
                'penilaian' => $penilaian,
                'id_wisatawan' => $id_wisatawan ?? null,
                'id_admin' => $id_admin ?? null,
                'status' => $status,
                'jenis_pengajuan' => 'Perubahan',
                'waktu_diubah' => $waktu_diubah,
            ]);

            $idWisata = $wisataKuliner->id_pengajuan;

            // Fasilitas
            $fasilitasIds = [];

            foreach ($dataMK as $item) {

                if (is_numeric($item)) {
                    $fasilitasId = $item;
                } else {

                    $fasilitas = Fasilitas::firstOrCreate([
                        'nama' => trim($item)
                    ]);

                    $fasilitasId = $fasilitas->id_fasilitas;
                }

                $fasilitasIds[] = $fasilitasId;
            }

            $wisata = PengajuanWisataKuliner::find($idWisata);

            $wisata->fasilitas()->sync($fasilitasIds);
            // $fasilitasIds = array_unique($fasilitasIds);

            // $fasilitasterdaftar = DB::table('fasilitas_wisata_kuliner')
            //     ->where('id_wisata_kuliner', $idWisata)
            //     ->get();

            // foreach ($fasilitasIds as $idf) {
            //     $adafasilitas = false;

            //     foreach ($fasilitasterdaftar as $item) {
            //         if ($item->id_fasilitas == $idf) {
            //             $adafasilitas = true;
            //         }
            //     }

            //     if (!$adafasilitas) {
            //         DB::table('fasilitas_wisata_kuliner')->insert([
            //             'id_wisata_kuliner' => $idWisata,
            //             'id_fasilitas' => $idf,
            //             'status' => 'Belum Diverifikasi'
            //         ]);
            //     }
            // }

            // foreach ($fasilitasterdaftar as $item) {
            //     if (!in_array($item->id_fasilitas, $fasilitasIds)) {

            //         DB::table('fasilitas_wisata_kuliner')
            //             ->where('id_wisata_kuliner', $idWisata)
            //             ->where('id_fasilitas', $item->id_fasilitas)
            //             ->update([
            //                 'status' => 'Dihapus'
            //             ]);
            //     }
            // }

            // Kategori
            $kategoriIds = [];

            foreach ($dataKategori as $item) {

                if (is_numeric($item)) {
                    $kategoriId = $item;
                } else {

                    $kategori = Kategori::firstOrCreate([
                        'nama' => trim($item)
                    ]);

                    $kategoriId = $kategori->id_kategori;
                }

                $kategoriIds[] = $kategoriId;
            }

            $wisata = PengajuanWisataKuliner::find($idWisata);

            $wisata->kategori()->sync($kategoriIds);
            // $kategoriIds = array_unique($kategoriIds);

            // $kategoriterdaftar = DB::table('kategori_wisata_kuliner')
            //     ->where('id_wisata_kuliner', $idWisata)
            //     ->get();

            // foreach ($kategoriIds as $idk) {
            //     $adaKategori = false;

            //     foreach ($kategoriterdaftar as $item) {
            //         if ($item->id_kategori == $idk) {
            //             $adaKategori = true;
            //         }
            //     }

            //     if (!$adaKategori) {
            //         DB::table('kategori_wisata_kuliner')->insert([
            //             'id_wisata_kuliner' => $idWisata,
            //             'id_kategori' => $idk,
            //             'status' => 'Belum Diverifikasi'
            //         ]);
            //     }
            // }

            // foreach ($kategoriterdaftar as $item) {
            //     if (!in_array($item->id_kategori, $kategoriIds)) {

            //         DB::table('kategori_wisata_kuliner')
            //             ->where('id_wisata_kuliner', $idWisata)
            //             ->where('id_kategori', $item->id_kategori)
            //             ->update([
            //                 'status' => 'Dihapus'
            //             ]);
            //     }
            // }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return redirect($request->from . '&detail=' . $id)
            ->with('success', 'Wisata Kuliner Berhasil Diperbarui!');
    }

    private string $regencyCode = '33.74';
    public function getKecamatan()
    {
        $response = Http::get(
            "https://wilayah.id/api/districts/{$this->regencyCode}.json"
        );

        return response()->json($response->json()['data']);
    }

    public function getKelurahan($districtCode)
    {
        $response = Http::get(
            "https://wilayah.id/api/villages/{$districtCode}.json"
        );

        return response()->json($response->json()['data']);
    }


    // Diari Kuliner

    public function halamanDiari()
    {
        $wisatawan = Wisatawan::where('user_id', Auth::id())->first();

        $diariKuliner = DiariKuliner::where('id_wisatawan', $wisatawan->id_wisatawan)->latest('waktu_diubah')->get();
        return view('wisatawan.diari-kuliner.halaman-diari-kuliner', compact('diariKuliner'));
    }

    public function tambahDiari()
    {
        return view('wisatawan.diari-kuliner.tambah-diari-kuliner');
    }

    public function simpanDiari(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:10240',
        ]);

        $fotoPath = $request->file('foto')->storeAs(
            'uploads',
            'foto_' . 'diari_' . time() . '.' . $request->file('foto')->extension(),
            'public'
        );

        $id_wisatawan = Wisatawan::where('user_id', Auth::id())->value('id_wisatawan');

        $waktu_dibuat = Carbon::now('Asia/Jakarta');
        $waktu_diubah = Carbon::now('Asia/Jakarta');

        DiariKuliner::create([
            'id_wisatawan' => $id_wisatawan,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
            'waktu_dibuat' => $waktu_dibuat,
            'waktu_diubah' => $waktu_diubah,
        ]);

        return redirect()->route('diarikuliner')->with('success', 'Diari Kuliner Berhasil Disimpan');
    }

    public function detailDiari($id)
    {
        $diariKuliner = DiariKuliner::findOrFail($id);

        return response()->json([
            'diariKuliner' => $diariKuliner,
            'judul' => $diariKuliner->judul,
            'deskripsi' => $diariKuliner->deskripsi,
            'foto' => $diariKuliner->foto,
            'waktu_diubah' => \Carbon\Carbon::parse($diariKuliner->waktu_diubah)->format('d.m.Y')
        ]);
    }

    public function editDiari($id)
    {
        $diariKuliner = DiariKuliner::findOrFail($id);
        return view('wisatawan.diari-kuliner.edit-diari-kuliner', compact(
            'diariKuliner',
        ));
    }

    public function updateDiari(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);

        $diariKuliner = DiariKuliner::findOrFail($id);

        $id_wisatawan = Wisatawan::where('user_id', Auth::id())->value('id_wisatawan');

        $waktu_diubah = Carbon::now('Asia/Jakarta');

        $fotoPath = $diariKuliner->foto;

        if ($request->hasFile('foto')) {
            if ($diariKuliner->foto && Storage::exists('public/' . $diariKuliner->foto)) {
                Storage::delete('public/' . $diariKuliner->foto);
            }

            $fotoPath = $request->file('foto')->storeAs(
                'uploads',
                'foto_' . 'diari_' . time() . '.' . $request->file('foto')->extension(),
                'public'
            );
        }

        $data = [
            'id_wisatawan' => $id_wisatawan,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
            'waktu_diubah' => $waktu_diubah,
        ];

        $diariKuliner->update($data);

        return redirect()->route('diarikuliner')
            ->with('success', 'Diari Kuliner Berhasil Diperbarui');
    }

    public function hapusDiari($id)
    {
        try {

            $diariKuliner = DiariKuliner::findOrFail($id);

            if ($diariKuliner->foto && Storage::disk('public')->exists($diariKuliner->foto)) {
                Storage::disk('public')->delete($diariKuliner->foto);
            }

            $diariKuliner->delete();

            return redirect()->back()->with('success', 'Diari Kuliner berhasil dihapus');
        } catch (Exception $e) {
            Log::error('Error in WisatawanController@destroy: ' . $e->getMessage());
            return back()->with('error', 'Terjadi Kesalahan Saat Menghapus Diari Kuliner.');
        }
    }

    public function adatags()
    {
        $fasilitas = Fasilitas::all();
        return view('wisatawan.wisata-kuliner.tambahadaform', compact('fasilitas'));
    }

    // public function getCategory(Request $request)
    // {
    //     $tags = [];
    //     if ($search = $request->name) {
    //         $tags = Category::where('title', 'LIKE', "%$search%")->get();
    //     }
    //     return response()->json($tags);
    // }

    // public function search(Request $request)
    // {
    //     $search = $request->q;

    //     return Fasilitas::where('nama', 'like', "%{$search}%")
    //         ->limit(10)
    //         ->get(['id_fasilitas as id', 'nama as name']);
    // }

    public function getngampu($id = null)
    {
        if (!$id || $id == "null") {
            return '';
        }

        $mk = FasilitasWisataKuliner::with('fasilitas')
            ->where('id_wisata_kuliner', $id)
            ->get();

        $data = '';

        foreach ($mk as $row) {
            if ($row->fasilitas) {
                $data .= "<option value='{$row->id_fasilitas}' selected>
                        {$row->fasilitas->nama}
                      </option>";
            }
        }

        return $data;
    }

    public function selectmhs()
    {
        $data = WisataKuliner::where('nama', 'LIKE', '%' . request('q') . '%')->paginate(10);

        return response()->json($data);
    }

    public function selectmk($id)
    {
        $data = Fasilitas::where('nama', 'LIKE', '%' . request('q') . '%')
            ->paginate(10);

        return response()->json($data);
    }

    public function selectkategori($id)
    {
        $data = Kategori::where('nama', 'LIKE', '%' . request('q') . '%')
            ->paginate(10);

        return response()->json($data);
    }

    public function getKategori($id = null)
    {
        if (!$id || $id == "null") {
            return '';
        }

        $kategori = KategoriWisataKuliner::with('kategori')
            ->where('id_wisata_kuliner', $id)
            ->get();

        $data = '';

        foreach ($kategori as $row) {
            if ($row->kategori) {
                $data .= "<option value='{$row->id_kategori}' selected>
                        {$row->kategori->nama}
                      </option>";
            }
        }

        return $data;
    }

    // Favorit
    public function halamanFavorit()
    {
        $wisatawan = Wisatawan::where('user_id', Auth::id())->first();

        $kulinerFavorit = KulinerFavorit::with('kuliner')
            ->where('id_wisatawan', $wisatawan->id_wisatawan)
            ->latest('waktu_dibuat')
            ->get();
        return view('wisatawan.favorit.halaman-favorit', compact('kulinerFavorit'));
    }

    // public function hapusFavoritDariList(Request $request)
    // {
    //     $wisatawan = Wisatawan::where('user_id', Auth::id())->first();

    //     KulinerFavorit::where('id_wisatawan', $wisatawan->id_wisatawan)
    //         ->where('id_wisata_kuliner', $request->id_wisata_kuliner)
    //         ->delete();

    //     return back()->with('success', 'Berhasil dihapus dari favorit');
    // }
    public function hapusFavoritDariList(Request $request)
    {
        $wisatawan = Wisatawan::where('user_id', Auth::id())->first();

        $kuliner = WisataKuliner::with('kategori')
            ->find($request->id_wisata_kuliner);

        if ($kuliner) {
            foreach ($kuliner->kategori as $k) {

                $preferensi = Preferensi::where('id_wisatawan', $wisatawan->id_wisatawan)
                    ->where('id_kategori', $k->id_kategori)
                    ->first();

                if ($preferensi) {
                    if ($preferensi->jumlah > 1) {
                        $preferensi->decrement('jumlah');
                    } else {
                        $preferensi->delete();
                    }
                }
            }
        }

        KulinerFavorit::where('id_wisatawan', $wisatawan->id_wisatawan)
            ->where('id_wisata_kuliner', $request->id_wisata_kuliner)
            ->delete();

        return back()->with('success', 'Berhasil dihapus dari favorit');
    }






    // Tidak Login
    public function berandaWisatawanTidakLogin()
    {
        $keyword = $request->keyword ?? 'Rekomendasi Kuliner';
        $kulinerBaru = WisataKuliner::where('status', 'Ditampilkan')->orderBy('waktu_diubah', 'desc')->take(4)->get();
        $kulinerFavorit = WisataKuliner::where('status', 'Ditampilkan')->orderBy('penilaian', 'desc')->take(4)->get();
        $fasilitas = Fasilitas::all();
        $kategori = Kategori::all();
        return view('wisatawan-tidak-login.beranda-wisatawantidaklogin', compact('fasilitas', 'kategori', 'keyword', 'kulinerBaru', 'kulinerFavorit'));
    }

    public function halamanfavoritTidakLogin()
    {
        return view('wisatawan-tidak-login.favorit.halamanfavorit-wisatawantidaklogin');
    }

    public function halamantambahTidakLogin()
    {
        $fasilitas = Fasilitas::all();
        $wkuliner = WisataKuliner::where('status', ['Disetujui', 'Ditampilkan'])->get();
        return view('wisatawan-tidak-login.wisatakuliner.tambahkuliner-wisatawantidaklogin', compact('fasilitas', 'wkuliner'));
    }

    public function simpankulinerTidakLogin(Request $request)
    {
        $request->validate([
            'nama_wisata_kuliner' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:50',
            'kelurahan' => 'required|string|max:50',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|min:10|max:15',
            'email' => 'nullable|email|max:70',
            'deskripsi' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:10240',
            'latitude'  => 'required|numeric|between:-90,90|unique:wisata_kuliner,latitude',
            'longitude' => 'required|numeric|between:-180,180|unique:wisata_kuliner,longitude',
            'email_pengaju' => 'required|email|max:70',
        ]);

        $fotoPath = $request->file('foto')->storeAs(
            'uploads',
            'foto_' . time() . '.' . $request->file('foto')->extension(),
            'public'
        );

        $waktu_dibuat = Carbon::now('Asia/Jakarta');
        $waktu_diubah = Carbon::now('Asia/Jakarta');

        $dataMK = $request->id_fasilitas ?? [];
        $dataKategori = $request->id_kategori ?? [];
        $idWisata = $request->nama_wisata_kuliner;

        if (!is_numeric($idWisata)) {
            $wisata = PengajuanWisataKuliner::firstOrCreate([
                'nama' => trim($idWisata),
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'email' => $request->email ?? null,
                'foto' => $fotoPath,
                'deskripsi' => $request->deskripsi,
                'latitude'  => $request->latitude,
                'longitude' => $request->longitude,
                'harga_min' => 0,
                'harga_max' => 0,
                'penilaian' => 0,
                'email_pengaju' => $request->email_pengaju,
                'status' => 'Belum Diverifikasi',
                'status' => 'Baru',
                'waktu_dibuat' => $waktu_dibuat,
                'waktu_diubah' => $waktu_diubah,
            ]);

            $idWisata = $wisata->id_wisata_kuliner;
        }

        $fasilitasIds = [];

        foreach ($dataMK as $item) {

            if (is_numeric($item)) {
                $fasilitasId = $item;
            } else {

                $fasilitas = Fasilitas::firstOrCreate([
                    'nama' => trim($item)
                ]);

                $fasilitasId = $fasilitas->id_fasilitas;
            }

            $fasilitasIds[] = $fasilitasId;
        }

        $wisata = WisataKuliner::find($idWisata);

        $wisata->fasilitas()->sync($fasilitasIds);

        $kategoriIds = [];

        foreach ($dataKategori as $item) {

            if (is_numeric($item)) {
                $kategoriId = $item;
            } else {

                $kategori = Kategori::firstOrCreate([
                    'nama' => trim($item)
                ]);

                $kategoriId = $kategori->id_kategori;
            }

            $kategoriIds[] = $kategoriId;
        }

        $wisata = WisataKuliner::find($idWisata);

        $wisata->kategori()->sync($kategoriIds);

        return redirect()->route('beranda.tidaklogin')->with('success', 'Wisata Kuliner Berhasil Disimpan');
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword ?? 'Rekomendasi Kuliner';
        $kategori = Kategori::all();
        $fasilitas = Fasilitas::all();
        $wisatawan = Wisatawan::where('user_id', Auth::id())->first();
        $favoritIds = [];
        if ($wisatawan) {
            $favoritIds = KulinerFavorit::where('id_wisatawan', $wisatawan->id_wisatawan)
                ->pluck('id_wisata_kuliner')
                ->toArray();
        }

        $query = WisataKuliner::query()->with(['fasilitas', 'kategori'])->where('status', 'Ditampilkan');

        $lat = $request->lat;
        $lng = $request->lng;

        // keyword
        $keyword = trim($request->keyword ?? '');

        $isRekomendasi = false;

        if ($keyword === '' || strtolower($keyword) === 'rekomendasi kuliner') {
            $isRekomendasi = true;
        }

        if (!$isRekomendasi) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->keyword . '%')
                    ->orWhere('kecamatan', 'like', '%' . $request->keyword . '%')
                    ->orWhere('kelurahan', 'like', '%' . $request->keyword . '%')
                    ->orWhere('alamat', 'like', '%' . $request->keyword . '%')
                    ->orWhere('deskripsi', 'like', '%' . $request->keyword . '%')
                    ->orWhereHas('kategori', function ($q2) use ($request) {
                        $q2->where('nama', 'like', '%' . $request->keyword . '%');
                    });
            });
        }

        $useHargaFilter =
            ($request->minharga && $request->minharga != 0) ||
            ($request->maxharga && $request->maxharga != 1000000);

        $useRatingFilter =
            ($request->minrating && $request->minrating != 0) ||
            ($request->maxrating && $request->maxrating != 5);

        $useJarakFilter =
            ($request->jarak && $request->jarak > 0);

        if ($useRatingFilter) {
            $query->whereBetween('penilaian', [
                $request->minrating,
                $request->maxrating
            ]);
        }

        if ($useHargaFilter) {
            $query->where(function ($q) use ($request) {
                $q->where('harga_max', '>=', $request->minharga)
                    ->where('harga_min', '<=', $request->maxharga);
            });
        }

        $data = $query->limit(50)->get();

        if (!$isRekomendasi && $data->isEmpty()) {
            $isRekomendasi = true;
            $keyword = 'Rekomendasi Kuliner';

            $query2 = WisataKuliner::with(['fasilitas', 'kategori'])->where('status', 'Ditampilkan');

            if ($useRatingFilter) {
                $query2->whereBetween('penilaian', [$request->minrating, $request->maxrating]);
            }
            if ($useHargaFilter) {
                $query2->where('harga_max', '>=', $request->minharga)
                    ->where('harga_min', '<=', $request->maxharga);
            }

            $data = $query2->limit(50)->get();
        }

        // preferensi (FIX: dipindah ke atas sebelum scoring)
        $preferensiKuliner = [];
        if ($wisatawan) {
            $preferensiKuliner = DB::table('preferensi')
                ->where('id_wisatawan', $wisatawan->id_wisatawan)
                ->pluck('id_kategori')
                ->toArray();
        }

        if ($request->lat && $request->lng && count($data) > 0) {

            // FIX: haversine dihitung di PHP dulu sebagai fallback
            foreach ($data as $item) {
                $item->distance_km = 6371 * 2 * atan2(
                    sqrt(
                        pow(sin(deg2rad($item->latitude - $lat) / 2), 2) +
                            cos(deg2rad($lat)) * cos(deg2rad($item->latitude)) *
                            pow(sin(deg2rad($item->longitude - $lng) / 2), 2)
                    ),
                    sqrt(
                        1 - (
                            pow(sin(deg2rad($item->latitude - $lat) / 2), 2) +
                            cos(deg2rad($lat)) * cos(deg2rad($item->latitude)) *
                            pow(sin(deg2rad($item->longitude - $lng) / 2), 2)
                        )
                    )
                );
            }

            // FIX: filter jarak pakai distance_km yang sudah dihitung
            if ($useJarakFilter) {
                $data = $data->filter(fn($item) => $item->distance_km <= $request->jarak)->values();
            }

            $origin = $request->lat . ',' . $request->lng;

            $destinations = $data->map(function ($item) {
                return $item->latitude . ',' . $item->longitude;
            })->join('|');

            $apiKey = 'AIzaSyD-gBdR_gqZTd8B6jz3mVJWI-pqC_jPlAI';

            $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$origin}&destinations={$destinations}&key={$apiKey}&language=in";

            $response = file_get_contents($url);
            $response = json_decode($response, true);

            foreach ($data as $index => $item) {
                $distanceMeter = $response['rows'][0]['elements'][$index]['distance']['value'] ?? null;
                $item->distance_km = $distanceMeter ? $distanceMeter / 1000 : $item->distance_km; // FIX: fallback ke haversine
            }
        }

        $totalFasilitasUser = count($request->fasilitas ?? []);

        // FIX: kategori & fasilitas match pakai bulk query, bukan per-item
        $kategoriFilter = $request->kategori ?? [];
        $fasilitasFilter = $request->fasilitas ?? [];
        $cariKategori = !empty($kategoriFilter) ? $kategoriFilter : $preferensiKuliner;

        $kulinerIds = $data->pluck('id_wisata_kuliner')->toArray();

        $kategoriMatchMap = [];
        if (!empty($cariKategori)) {
            $kategoriMatchMap = DB::table('kategori_wisata_kuliner')
                ->whereIn('id_wisata_kuliner', $kulinerIds)
                ->whereIn('id_kategori', $cariKategori)
                ->select('id_wisata_kuliner', DB::raw('COUNT(*) as match_count'))
                ->groupBy('id_wisata_kuliner')
                ->pluck('match_count', 'id_wisata_kuliner')
                ->toArray();
        }

        $fasilitasMatchMap = [];
        if (!empty($fasilitasFilter)) {
            $fasilitasMatchMap = DB::table('fasilitas_wisata_kuliner')
                ->whereIn('id_wisata_kuliner', $kulinerIds)
                ->whereIn('id_fasilitas', $fasilitasFilter)
                ->select('id_wisata_kuliner', DB::raw('COUNT(*) as match_count'))
                ->groupBy('id_wisata_kuliner')
                ->pluck('match_count', 'id_wisata_kuliner')
                ->toArray();
        }

        foreach ($data as $item) {
            $id = $item->id_wisata_kuliner;

            $listKategori = $request->kategori ?? [];
            if (!empty($listKategori)) {
                $cariKategori = $listKategori;
            } elseif (!empty($preferensiKuliner)) {
                $cariKategori = $preferensiKuliner;
            } else {
                $cariKategori = [];
            }

            $distanceScore = 1 / (($item->distance_km ?? 999) + 1);
            $ratingScore = ($item->penilaian ?? 0) / 5;
            $hargaScore = 1 / (($item->harga_min ?? 1) + 1);
            $kategoriMatch = $kategoriMatchMap[$id] ?? 0;
            $fasilitasMatch = $fasilitasMatchMap[$id] ?? 0;

            $item->score =
                ($distanceScore * 40) +
                ($ratingScore * 25) +
                ($hargaScore * 20) +
                ($kategoriMatch * 10) +
                ($fasilitasMatch * 5);
        }

        $data = $data->sortByDesc('score')->values();

        return view('wisatawan-tidak-login.wisatakuliner.hasilpencarian-wisatawantidaklogin', compact('data', 'kategori', 'fasilitas', 'favoritIds', 'keyword'));
    }
}
