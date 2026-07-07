<?php

namespace App\Http\Controllers;

use App\Models\WisataKuliner;
use Illuminate\Http\Request;
use App\Models\Fasilitas;
use App\Models\FasilitasWisataKuliner;
use App\Models\Kategori;
use App\Models\KategoriWisataKuliner;
use App\Models\KulinerFavorit;
use App\Models\PengajuanWisataKuliner;
use App\Models\Ulasan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class PengajuanWKulinerController extends Controller
{
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

    public function tampilkanTambahWK()
    {
        $wkuliner = WisataKuliner::get();
        $oldKategori = \App\Models\Kategori::whereIn(
            'id_kategori',
            old('id_kategori', [])
        )->get(['id_kategori', 'nama']);

        $jenisHidangan = Kategori::where(
            'jenis_kategori',
            'Jenis Hidangan'
        )->where('status', 'Aktif')
            ->get();

        $kategoriTempat = Kategori::where(
            'jenis_kategori',
            'Tempat'
        )->where('status', 'Aktif')
            ->get();

        $asalKuliner = Kategori::where(
            'jenis_kategori',
            'Asal Kuliner'
        )->where('status', 'Aktif')
            ->get();

        return view('wisatawan.wisata-kuliner.halaman-tambahwkuliner', compact(
            'wkuliner',
            'oldKategori',
            'jenisHidangan',
            'kategoriTempat',
            'asalKuliner'
        ));
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'nama_wisata_kuliner' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:50',
            'kelurahan' => 'required|string|max:50',
            'alamat' => 'required|string',
            'no_telp' => 'nullable|string|min:10|max:15',
            'deskripsi' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'latitude'  => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'sertifikat_halal' => 'required',
        ], [
            'nama_wisata_kuliner.required' => 'Nama wisata kuliner harus diisi.',
            'kecamatan' => 'Kecamatan harus diisi.',
            'kelurahan' => 'Kelurahan harus diisi.',
            'alamat' => 'Alamat harus diisi.',
            'deskripsi' => 'Deskripsi harus diisi.',
            'sertifikat_halal' => 'Pilihan sertifikat halal harus diisi.',
        ],);

        $fotoPath = null;
        if ($request->foto) {
            $fotoPath = $request->file('foto')->storeAs(
                'uploads',
                'foto_' . '_' . time() . '.' . $request->file('foto')->extension(),
                'public'
            );
        }

        $waktu_dibuat = Carbon::now('Asia/Jakarta');
        $waktu_diubah = Carbon::now('Asia/Jakarta');

        $fasilitas = $request->id_fasilitas ?? [];

        $kategori = [
            [
                'value' => $request->jenis_hidangan,
                'jenis' => 'Jenis Hidangan'
            ],
            [
                'value' => $request->kategori_tempat,
                'jenis' => 'Tempat'
            ],
            [
                'value' => $request->asal_kuliner,
                'jenis' => 'Asal Kuliner'
            ]
        ];

        $idWisata = $request->nama_wisata_kuliner;

        if (!is_numeric($idWisata)) {
            $wisata = PengajuanWisataKuliner::firstOrCreate([
                'nama' => trim($idWisata),
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp ?? null,
                'foto' => $fotoPath,
                'deskripsi' => $request->deskripsi,
                'latitude'  => $request->latitude,
                'longitude' => $request->longitude,
                'sertifikat_halal' => $request->sertifikat_halal,
                'id_user' => Auth::id(),
                'status_operasional' => 'Aktif',
                'jenis_pengajuan' => 'Baru',
                'waktu_dibuat' => $waktu_dibuat,
                'waktu_diubah' => $waktu_diubah,
            ]);

            $idWisata = $wisata->id_pengajuan;
        }

        // Kategori
        $kategoriIds = [];

        foreach ($kategori as $item) {

            if (!$item['value']) {
                continue;
            }
            if (is_numeric($item['value'])) {
                $kategoriId = $item['value'];
            } else {
                $kategori = Kategori::where('nama', trim($item['value']))->first();

                // if ($kategori) {
                //     if ($kategori->status !== 'Aktif') {
                //         $kategori->update([
                //             'status' => 'Aktif'
                //         ]);
                //     }
                // } else {
                //     $kategori = Kategori::firstOrCreate([
                //         'nama' => trim($item['value']),
                //         'jenis_kategori' => $item['jenis'],
                //         'status' => 'Aktif',
                //     ]);
                // }
                if (!$kategori) {
                    $kategori = Kategori::firstOrCreate([
                        'nama' => trim($item['value']),
                        'jenis_kategori' => $item['jenis'],
                        'status' => 'Tidak Aktif',
                    ]);
                }
                $kategoriId = $kategori->id_kategori;
            }

            $kategoriIds[] = $kategoriId;
        }

        $wisata = PengajuanWisataKuliner::find($idWisata);

        $wisata->kategori()->sync($kategoriIds);

        // Fasilitas
        $fasilitasIds = [];

        foreach ($fasilitas as $item) {

            if (is_numeric($item)) {
                $fasilitasId = $item;
            } else {

                $fasilitas = Fasilitas::where('nama', trim($item))->first();

                // if ($fasilitas) {
                //     if ($fasilitas->status !== 'Aktif') {
                //         $fasilitas->update([
                //             'status' => 'Aktif'
                //         ]);
                //     }
                // } else {
                //     $fasilitas = Fasilitas::firstOrCreate([
                //         'nama' => trim($item),
                //         'status' => 'Aktif',
                //     ]);
                // }
                if (!$fasilitas) {
                    $fasilitas = Fasilitas::firstOrCreate([
                        'nama' => trim($item),
                        'status' => 'Tidak Aktif',
                    ]);
                }

                $fasilitasId = $fasilitas->id_fasilitas;
            }

            $fasilitasIds[] = $fasilitasId;
        }

        $wisata = PengajuanWisataKuliner::find($idWisata);

        $wisata->fasilitas()->sync($fasilitasIds);

        return redirect($request->redirect ?? route('beranda-Wisatawan'))->with('swal', [
            'title' => 'Berhasil',
            'text' => 'Wisata Kuliner Berhasil Diajukan',
            'icon' => 'success'
        ]);
    }

    public function tampilkanEditWK(int $id)
    {
        $wisataKuliner = WisataKuliner::findOrFail($id);
        $wkuliner = WisataKuliner::get();
        $fasilitas = FasilitasWisataKuliner::with('fasilitas')
            ->where('id_wisata_kuliner', $id)
            ->get();
        $kategori = KategoriWisataKuliner::with('kategori')
            ->where('id_wisata_kuliner', $id)
            ->get();

        $allKategori = Kategori::all();
        $oldKategori = \App\Models\Kategori::whereIn(
            'id_kategori',
            old('id_kategori', [])
        )->get(['id_kategori', 'nama']);

        $jenisHidangan = Kategori::where(
            'jenis_kategori',
            'Jenis Hidangan'
        )->get();

        $kategoriTempat = Kategori::where(
            'jenis_kategori',
            'Tempat'
        )->get();

        $asalKuliner = Kategori::where(
            'jenis_kategori',
            'Asal Kuliner'
        )->get();

        $kategoriTempatSelected = $kategori
            ->firstWhere('kategori.jenis_kategori', 'Tempat');

        $jenisHidanganSelected = $kategori
            ->firstWhere('kategori.jenis_kategori', 'Jenis Hidangan');

        $asalKulinerSelected = $kategori
            ->firstWhere('kategori.jenis_kategori', 'Asal Kuliner');
        $from = request('from');

        return view('wisatawan.wisata-kuliner.halaman-editwkuliner', compact(
            'wisataKuliner',
            'oldKategori',
            'jenisHidangan',
            'kategoriTempat',
            'asalKuliner',
            'fasilitas',
            'kategori',
            'wkuliner',
            'allKategori',
            'kategoriTempatSelected',
            'jenisHidanganSelected',
            'asalKulinerSelected',
            'from'
        ));
    }

    public function update(Request $request, $id)
    {
        try {
            $from = request('from');
            $wisataKuliner = WisataKuliner::findOrFail($id);

            $request->validate([
                'nama_wisata_kuliner' => 'required|string|max:255',
                'kecamatan' => 'required|string|max:50',
                'kelurahan' => 'required|string|max:50',
                'alamat' => 'required|string',
                'no_telp' => 'nullable|string|min:10|max:15',
                'deskripsi' => 'required|string|max:255',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
                'latitude'  => 'required|numeric|between:-90,90',
                'longitude' => 'required|numeric|between:-180,180',
                'sertifikat_halal' => 'required',
            ], [
                'nama_wisata_kuliner.required' => 'Nama wisata kuliner harus diisi.',
                'kecamatan' => 'Kecamatan harus diisi.',
                'kelurahan' => 'Kelurahan harus diisi.',
                'alamat' => 'Alamat harus diisi.',
                'deskripsi' => 'Deskripsi harus diisi.',
                'sertifikat_halal' => 'Pilihan sertifikat halal harus diisi.',
            ],);

            $fotoPath = $wisataKuliner->foto ?? null;

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

            $waktu_dibuat = Carbon::now('Asia/Jakarta');
            $waktu_diubah = Carbon::now('Asia/Jakarta');

            $fasilitas = $request->id_fasilitas ?? [];

            $kategori = [
                [
                    'value' => $request->jenis_hidangan,
                    'jenis' => 'Jenis Hidangan'
                ],
                [
                    'value' => $request->kategori_tempat,
                    'jenis' => 'Tempat'
                ],
                [
                    'value' => $request->asal_kuliner,
                    'jenis' => 'Asal Kuliner'
                ]
            ];

            $idWisata = $request->nama_wisata_kuliner;
            // $dataMK = $request->id_fasilitas ?? [];
            // $dataKategori = $request->id_kategori ?? [];
            // $idWisata = $request->nama;
            // $harga_min = $wisataKuliner->harga_min;
            // $harga_max = $wisataKuliner->harga_max;
            // $penilaian = $wisataKuliner->penilaian;

            $wisataKuliner->fill([
                'nama' => $request->nama_wisata_kuliner,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp ?? null,
                'foto' => $fotoPath,
                'deskripsi' => $request->deskripsi,
                'latitude'  => $request->latitude,
                'longitude' => $request->longitude,
                'sertifikat_halal' => $request->sertifikat_halal,
                'status_operasional' => $request->status_operasional,
            ]);

            // if (!$wisataKuliner->isDirty()) {
            //     return redirect($request->from . '&detail=' . $id)
            //         ->with('info', 'Tidak Terdapat Perubahan');
            // }
            $oldKategori = $wisataKuliner->kategori
                ->pluck('id_kategori')
                ->sort()
                ->values()
                ->toArray();

            $oldFasilitas = $wisataKuliner->fasilitas
                ->pluck('id_fasilitas')
                ->sort()
                ->values()
                ->toArray();

            $newKategori = array_values(array_filter([
                $request->kategori_tempat,
                $request->jenis_hidangan,
                $request->asal_kuliner
            ]));

            sort($newKategori);

            $newFasilitas = $request->id_fasilitas ?? [];
            sort($newFasilitas);
            $kategoriBerubah = $oldKategori != $newKategori;
            $fasilitasBerubah = $oldFasilitas != $newFasilitas;

            $dataUtamaBerubah = $wisataKuliner->isDirty();

            // dd([
            //     'dataUtamaBerubah' => $dataUtamaBerubah,
            //     'kategoriBerubah' => $kategoriBerubah,
            //     'fasilitasBerubah' => $fasilitasBerubah,
            // ]);

            if (!$dataUtamaBerubah && !$kategoriBerubah && !$fasilitasBerubah) {
                return redirect($request->from)->with('swal', [
                    'title' => 'Info',
                    'text' => 'Tidak terdapat perubahan',
                    'icon' => 'info',
                ]);
            }

            $idWisata = $request->nama_wisata_kuliner;

            if (!is_numeric($idWisata)) {
                $wisata = PengajuanWisataKuliner::firstOrCreate([
                    'id_wisata_kuliner' => $wisataKuliner->id_wisata_kuliner,
                    'nama' => trim($idWisata),
                    'kecamatan' => $request->kecamatan,
                    'kelurahan' => $request->kelurahan,
                    'alamat' => $request->alamat,
                    'no_telp' => $request->no_telp ?? null,
                    'foto' => $fotoPath,
                    'deskripsi' => $request->deskripsi,
                    'latitude'  => $request->latitude,
                    'longitude' => $request->longitude,
                    'sertifikat_halal' => $request->sertifikat_halal,
                    'id_user' => Auth::id(),
                    'status_operasional' => $request->status_operasional,
                    'jenis_pengajuan' => 'Perubahan',
                    'waktu_dibuat' => $wisataKuliner->waktu_dibuat,
                    'waktu_diubah' => $waktu_diubah,
                ]);

                $idWisata = $wisata->id_pengajuan;
            }

            // Kategori
            $kategoriIds = [];

            foreach ($kategori as $item) {

                if (!$item['value']) {
                    continue;
                }
                if (is_numeric($item['value'])) {
                    $kategoriId = $item['value'];
                } else {
                    $kategori = Kategori::where('nama', trim($item['value']))->first();

                    // if ($kategori) {
                    //     if ($kategori->status !== 'Aktif') {
                    //         $kategori->update([
                    //             'status' => 'Aktif'
                    //         ]);
                    //     }
                    // } else {
                    //     $kategori = Kategori::firstOrCreate([
                    //         'nama' => trim($item['value']),
                    //         'jenis_kategori' => $item['jenis'],
                    //         'status' => 'Aktif',
                    //     ]);
                    // }
                    if (!$kategori) {
                        $kategori = Kategori::firstOrCreate([
                            'nama' => trim($item['value']),
                            'jenis_kategori' => $item['jenis'],
                            'status' => 'Tidak Aktif',
                        ]);
                    }

                    $kategoriId = $kategori->id_kategori;
                }

                $kategoriIds[] = $kategoriId;
            }

            $wisata = PengajuanWisataKuliner::find($idWisata);

            $wisata->kategori()->sync($kategoriIds);

            // Fasilitas
            $fasilitasIds = [];

            foreach ($fasilitas as $item) {

                if (is_numeric($item)) {
                    $fasilitasId = $item;
                } else {

                    $fasilitas = Fasilitas::where('nama', trim($item))->first();

                    // if ($fasilitas) {
                    //     if ($fasilitas->status !== 'Aktif') {
                    //         $fasilitas->update([
                    //             'status' => 'Aktif'
                    //         ]);
                    //     }
                    // } else {
                    //     $fasilitas = Fasilitas::firstOrCreate([
                    //         'nama' => trim($item),
                    //         'status' => 'Aktif',
                    //     ]);
                    // }
                    if (!$fasilitas) {
                        $fasilitas = Fasilitas::firstOrCreate([
                            'nama' => trim($item),
                            'status' => 'Tidak Aktif',
                        ]);
                    }

                    $fasilitasId = $fasilitas->id_fasilitas;
                }

                $fasilitasIds[] = $fasilitasId;
            }

            $wisata = PengajuanWisataKuliner::find($idWisata);

            $wisata->fasilitas()->sync($fasilitasIds);

            // $wisataKuliner = PengajuanWisataKuliner::firstOrCreate([
            //     'nama' => trim($idWisata),
            //     'kecamatan' => $request->kecamatan,
            //     'kelurahan' => $request->kelurahan,
            //     'alamat' => $request->alamat,
            //     'no_telp' => $request->no_telp ?? null,
            //     'foto' => $fotoPath,
            //     'deskripsi' => $request->deskripsi,
            //     'latitude'  => $request->latitude,
            //     'longitude' => $request->longitude,
            //     'id_wisatawan' => $id_wisatawan,
            //     'id_admin' => null,
            //     'status' => 'Disetujui',
            //     'status_operasional' => $wisataKuliner->status_operasional,
            //     'waktu_diubah' => $waktu_diubah,
            // ]);

            // $idWisata = $wisataKuliner->id_wisata_kuliner;

            // // Fasilitas
            // foreach ($fasilitas as $item) {

            //     if (is_numeric($item)) {
            //         $fasilitasId = $item;
            //     } else {

            //         $fasilitas = Fasilitas::firstOrCreate([
            //             'nama' => trim($item),
            //             'status' => 'Aktif',
            //         ]);

            //         $fasilitasId = $fasilitas->id_fasilitas;
            //     }

            //     $fasilitasIds[] = $fasilitasId;
            // }

            // $wisata = PengajuanWisataKuliner::find($idWisata);

            // $wisata->fasilitas()->sync($fasilitasIds);
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
            // $kategoriIds = [];

            // foreach ($kategori as $item) {

            //     if (!$item['value']) {
            //         continue;
            //     }

            //     if (is_numeric($item['value'])) {

            //         $kategoriId = $item['value'];
            //     } else {

            //         $kategori = Kategori::firstOrCreate([
            //             'nama' => trim($item['value']),
            //             'jenis_kategori' => $item['jenis'],
            //             'status' => 'Aktif',
            //         ]);

            //         $kategoriId = $kategori->id_kategori;
            //     }

            //     $kategoriIds[] = $kategoriId;
            // }

            // $wisata = PengajuanWisataKuliner::find($idWisata);

            // $wisata->kategori()->sync($kategoriIds);
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

        // dd([
        //     'from' => $request->from,
        //     'redirect' => $request->from
        // ]);

        return redirect($request->from)->with('swal', [
            'title' => 'Berhasil',
            'text' => 'Wisata Kuliner Berhasil Diajukan',
            'icon' => 'success'
        ]);
    }

    // public function getngampu($id = null)
    // {
    //     if (!$id || $id == "null") {
    //         return '';
    //     }

    //     $mk = FasilitasWisataKuliner::with('fasilitas')
    //         ->where('id_wisata_kuliner', $id)
    //         ->get();

    //     $data = '';

    //     foreach ($mk as $row) {
    //         if ($row->fasilitas) {
    //             $data .= "<option value='{$row->id_fasilitas}' selected>
    //                     {$row->fasilitas->nama}
    //                   </option>";
    //         }
    //     }

    //     return $data;
    // }

    public function selectmhs()
    {
        $data = WisataKuliner::where('nama', 'LIKE', '%' . request('q') . '%')->paginate(10);

        return response()->json($data);
    }

    public function selectfasilitas($id)
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

    public function tampilkanRiwayatPengajuan()
    {
        $wisataKuliner = PengajuanWisataKuliner::where('id_user', Auth::id())
            ->orderByRaw("
                CASE 
                    WHEN status = 'Belum Diverifikasi' THEN 1
                    WHEN status = 'Disetujui' THEN 2
                    ELSE 3
                END
            ")
            ->orderBy('waktu_diubah', 'desc')
            ->paginate(10, ['*'], 'wisatakuliner')
            ->withQueryString();

        $wisataKuliner->getCollection()->transform(function ($item, $key) use ($wisataKuliner) {
            $item->nomor = ($wisataKuliner->currentPage() - 1) * $wisataKuliner->perPage() + $key + 1;
            return $item;
        });

        $ulasan = Ulasan::where('id_user', Auth::id())
            ->orderByRaw("
                CASE 
                    WHEN status = 'Belum Diverifikasi' THEN 1
                    WHEN status = 'Disetujui' THEN 2
                    ELSE 3
                END
            ")
            ->orderBy('waktu_diubah', 'desc')
            ->paginate(10, ['*'], 'ulasan')
            ->withQueryString();

        $ulasan->getCollection()->transform(function ($item, $key) use ($ulasan) {
            $item->nomor = ($ulasan->currentPage() - 1) * $ulasan->perPage() + $key + 1;
            return $item;
        });

        return view('wisatawan.riwayat.halaman-riwayatkuliner', compact(
            'wisataKuliner',
            'ulasan',
        ));
    }

    public function tampilkanDetailWKuliner($id)
    {
        $wisataKuliner = PengajuanWisataKuliner::with(['fasilitas', 'kategori'])->findOrFail($id);

        return response()->json($wisataKuliner);
    }

    public function tampilkanDetailUlasan($id)
    {
        $ulasan = Ulasan::with('wisataKuliner')->findOrFail($id);

        return response()->json($ulasan);
    }

    // public function simpan(Request $request)
    // {
    //     $request->validate([
    //         'nama_wisata_kuliner' => 'required|string|max:255',
    //         'kecamatan' => 'required|string|max:50',
    //         'kelurahan' => 'required|string|max:50',
    //         'alamat' => 'required|string',
    //         'no_telp' => 'nullable|string|min:10|max:15',
    //         'email' => 'nullable|email|max:70',
    //         'deskripsi' => 'required|string|max:255',
    //         'foto' => 'required|image|mimes:jpeg,png,jpg|max:10240',
    //         'latitude'  => 'required|numeric|between:-90,90|unique:wisata_kuliner,latitude',
    //         'longitude' => 'required|numeric|between:-180,180|unique:wisata_kuliner,longitude',
    //     ]);

    //     $fotoPath = $request->file('foto')->storeAs(
    //         'uploads',
    //         'foto_' . time() . '.' . $request->file('foto')->extension(),
    //         'public'
    //     );

    //     $email_pengaju = Auth::user()->email;

    //     $id_wisatawan = null;
    //     $id_admin = null;
    //     if (Auth::check() && Auth::user()->peran === 'Wisatawan') {
    //         $id_wisatawan = Wisatawan::where('user_id', Auth::id())->value('id_wisatawan');
    //     } elseif (Auth::check() && Auth::user()->peran === 'Admin') {
    //         $id_admin = Admin::where('user_id', Auth::id())->value('id_admin');
    //     }

    //     $waktu_dibuat = Carbon::now('Asia/Jakarta');
    //     $waktu_diubah = Carbon::now('Asia/Jakarta');

    //     $status = 'Belum Diverifikasi';
    //     if (Auth::check() && Auth::user()->peran === 'Admin') {
    //         $status = 'Disetujui';
    //     }

    //     // $wisata = WisataKuliner::create([
    //     //     'nama' => $request->nama,
    //     //     'kecamatan' => $request->kecamatan,
    //     //     'kelurahan' => $request->kelurahan,
    //     //     'alamat' => $request->alamat,
    //     //     'no_telp' => $request->no_telp,
    //     //     'email' => $request->email ?? null,
    //     //     'foto' => $fotoPath,
    //     //     'deskripsi' => $request->deskripsi,
    //     //     'latitude'  => $request->latitude,
    //     //     'longitude' => $request->longitude,
    //     //     'email_pengaju' => $email_pengaju,
    //     //     'id_wisatawan' => $id_wisatawan ?? null,
    //     //     'id_admin' => $id_admin ?? null,
    //     //     'status' => $status,
    //     //     'waktu_dibuat' => $waktu_dibuat,
    //     //     'waktu_diubah' => $waktu_diubah,
    //     // ]);

    //     $dataMK = $request->id_fasilitas ?? [];
    //     $dataKategori = $request->id_kategori ?? [];
    //     $idWisata = $request->nama_wisata_kuliner;

    //     // $lat = $request->latitude;
    //     // $lng = $request->longitude;

    //     // if ($this->cekLokasiDuplikat($lat, $lng)) {
    //     //     return back()->withErrors([
    //     //         'latitude' => 'Latitude sudah digunakan',
    //     //         'longitude' => 'Longitude sudah digunakan'
    //     //     ])->withInput();
    //     // }

    //     if (!is_numeric($idWisata)) {

    //         $wisata = PengajuanWisataKuliner::firstOrCreate([
    //             'nama' => trim($idWisata),
    //             'kecamatan' => $request->kecamatan,
    //             'kelurahan' => $request->kelurahan,
    //             'alamat' => $request->alamat,
    //             'no_telp' => $request->no_telp ?? null,
    //             'email' => $request->email ?? null,
    //             'foto' => $fotoPath,
    //             'deskripsi' => $request->deskripsi,
    //             'latitude'  => $request->latitude,
    //             'longitude' => $request->longitude,
    //             'harga_min' => 0,
    //             'harga_max' => 0,
    //             'penilaian' => 0,
    //             'email_pengaju' => $email_pengaju,
    //             'id_wisatawan' => $id_wisatawan ?? null,
    //             'id_admin' => $id_admin ?? null,
    //             'status' => $status,
    //             'jenis_pengajuan' => 'Baru',
    //             'waktu_dibuat' => $waktu_dibuat,
    //             'waktu_diubah' => $waktu_diubah,
    //         ]);

    //         $idWisata = $wisata->id_pengajuan;
    //     }

    //     $fasilitasIds = [];

    //     foreach ($dataMK as $item) {

    //         if (is_numeric($item)) {
    //             $fasilitasId = $item;
    //         } else {

    //             $fasilitas = Fasilitas::firstOrCreate([
    //                 'nama' => trim($item)
    //             ]);

    //             $fasilitasId = $fasilitas->id_fasilitas;
    //         }

    //         $fasilitasIds[] = $fasilitasId;
    //     }

    //     $wisata = PengajuanWisataKuliner::find($idWisata);

    //     $wisata->fasilitas()->sync($fasilitasIds);

    //     $kategoriIds = [];

    //     foreach ($dataKategori as $item) {

    //         if (is_numeric($item)) {
    //             $kategoriId = $item;
    //         } else {

    //             $kategori = Kategori::firstOrCreate([
    //                 'nama' => trim($item)
    //             ]);

    //             $kategoriId = $kategori->id_kategori;
    //         }

    //         $kategoriIds[] = $kategoriId;
    //     }

    //     $wisata = PengajuanWisataKuliner::find($idWisata);

    //     $wisata->kategori()->sync($kategoriIds);

    //     return redirect()->route('beranda-Wisatawan')->with('success', 'Wisata Kuliner berhasil disimpan');
    // }







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

    // private string $regencyCode = '33.74';
    // public function getKecamatan()
    // {
    //     $response = Http::get(
    //         "https://wilayah.id/api/districts/{$this->regencyCode}.json"
    //     );

    //     return response()->json($response->json()['data']);
    // }

    // public function getKelurahan($districtCode)
    // {
    //     $response = Http::get(
    //         "https://wilayah.id/api/villages/{$districtCode}.json"
    //     );

    //     return response()->json($response->json()['data']);
    // }

    // public function adatags()
    // {
    //     $fasilitas = Fasilitas::all();
    //     return view('wisatawan.wisata-kuliner.tambahadaform', compact('fasilitas'));
    // }

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


}
