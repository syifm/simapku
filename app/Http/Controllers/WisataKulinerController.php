<?php

namespace App\Http\Controllers;

use App\Models\WisataKuliner;
use App\Models\Kategori;
use App\Models\Fasilitas;
use App\Models\KulinerFavorit;
use App\Models\Wisatawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Ulasan;
use App\Models\Admin;
use App\Models\FasilitasWisataKuliner;
use App\Models\KategoriWisataKuliner;
use App\Models\PengajuanWisataKuliner;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class WisataKulinerController extends Controller
{
    // Kelola Wisata Kuliner
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

    private function cekLokasiDuplikat($lat, $lng, $idwisata = null, $idpengajuan = null)
    {
        $lat = round($lat, 6);
        $lng = round($lng, 6);

        $queryWisata = WisataKuliner::whereRaw('ROUND(latitude, 6) = ?', [$lat])
            ->whereRaw('ROUND(longitude, 6) = ?', [$lng]);

        if ($idwisata) {
            $queryWisata->where('id_wisata_kuliner', '! =', $idwisata);
        }

        $queryPengajuan = PengajuanWisataKuliner::whereRaw('ROUND(latitude, 6) = ?', [$lat])
            ->whereRaw('ROUND(longitude, 6) = ?', [$lng])
            ->where('status', 'Belum Diverifikasi');

        if ($idpengajuan) {
            $queryPengajuan->where('id_pengajuan', '! =', $idpengajuan);
        }

        return $queryWisata->exists()  || $queryPengajuan->exists();
    }

    public function cekLokasi(Request $request)
    {
        $isDuplikat = $this->cekLokasiDuplikat(
            $request->latitude,
            $request->longitude,
            $request->id_wisata_kuliner,
            $request->id_pengajuan  ?? null
        );

        return response()->json([
            'duplikat'  => $isDuplikat
        ]);
    }

    public function tampilkanKelolaWK()
    {
        // Wisata Kuliner
        $wisataKuliner = WisataKuliner::orderByRaw("
                CASE 
                    WHEN status_operasional = 'Aktif' THEN 1
                    WHEN status_operasional = 'Tutup Sementara' THEN 2
                    ELSE 3
                END
          ")
            ->orderBy('waktu_diubah', 'desc')
            ->paginate(10, ['*'], 'wisatakuliner')
            ->withQueryString();

        $wisataKuliner->getCollection()->transform(function ($item, $key) use ($wisataKuliner) {
            $item->nomor = ($wisataKuliner->currentPage() -  1) * $wisataKuliner->perPage() + $key + 1;
            return $item;
        });

        // Kategori
        $kategori = Kategori::with([
            'wisataKuliner.kategori',
            'pengajuanwisataKuliner.kategori'
        ])
            ->withCount('wisataKuliner', 'pengajuanwisataKuliner')
            ->orderBy('jenis_kategori', 'asc')
            ->orderBy('nama', 'asc')
            ->paginate(10, ['*'], 'kategori')
            ->withQueryString();

        $kategori->getCollection()->transform(function ($item, $key) use ($kategori) {
            $item->nomor = ($kategori->currentPage() -  1) * $kategori->perPage() + $key + 1;
            // $total = $item->wisataKuliner->count();

            // $pengajuanKategori = $item->pengajuanwisataKuliner
            //     ->whereIn('status', ['Belum Diverifikasi', 'Ditolak'])
            //     ->sortByDesc('waktu_dibuat')
            //     ->unique('id_wisata_kuliner');

            // $pengajuanKDisetujui = $item->pengajuanwisataKuliner
            //     ->where('status', 'Disetujui')
            //     ->sortByDesc('waktu_dibuat')
            //     ->unique('id_wisata_kuliner');

            // $semuaPengajuanK = $pengajuanKategori->concat($pengajuanKDisetujui);

            // foreach ($semuaPengajuanK  as $pengajuanK) {
            //     if ($pengajuanK->status === 'Belum Diverifikasi'  || $pengajuanK->status === 'Ditolak') {
            //         $total++;
            //     }

            //     if ($pengajuanK->status === 'Disetujui') {
            //         $wkK = $item->wisataKuliner
            //             ->firstWhere('id_wisata_kuliner', $pengajuanK->id_wisata_kuliner);
            //         if (!$wkK) {
            //             $total++;
            //         } else {
            //             $aktifK = $wkK->kategori->pluck('id_kategori')->sort()->values();
            //             $disetujuiK = $pengajuanK->kategori->pluck('id_kategori')->sort()->values();
            //             if ($aktifK->toArray() !== $disetujuiK->toArray()) {

            //                 $total++;
            //             }
            //         }
            //     }
            // }

            // $item->total_wisata = $total;
            return $item;
        });

        // $wkKategori = WisataKuliner::with('kategori:id_kategori,nama')
        //     ->get()
        //     ->map(function ($item) {
        //         return [
        //             'id'  => $item->id_wisata_kuliner,
        //             'nama'  => $item->nama,
        //             'status'  => $item->status_operasional,
        //             'kategori'  => $item->kategori
        //         ];
        //     });

        // $pengajuanWKKategori = PengajuanWisataKuliner::with('kategori:id_kategori,nama')
        //     ->get();

        // $pengajuanKategori = $pengajuanWKKategori
        //     ->whereIn('status', ['Belum Diverifikasi', 'Ditolak'])
        //     ->map(function ($item) {
        //         return [
        //             'id'  => $item->id_wisata_kuliner,
        //             'nama'  => $item->nama,
        //             'status'  => $item->status,
        //             'kategori'  => $item->kategori
        //         ];
        //     });

        // $pengajuanKDisetujui = $pengajuanWKKategori
        //     ->where('status', 'Disetujui')
        //     ->sortByDesc('waktu_dibuat')
        //     ->unique('id_wisata_kuliner')
        //     ->filter(function ($pengajuanK) use ($wkKategori) {
        //         $wkK = $wkKategori->firstWhere('id', $pengajuanK->id_wisata_kuliner);
        //         if (!$wkK) {
        //             return true;
        //         }

        //         $aktifK = collect($wkK['kategori'])->pluck('id_kategori')->sort()->values();
        //         $disetujuiK = $pengajuanK->kategori->pluck('id_kategori')->sort()->values();

        //         return $aktifK->toArray() !== $disetujuiK->toArray();
        //     })
        //     ->map(function ($item) {
        //         return [
        //             'id'  => $item->id_wisata_kuliner,
        //             'nama'  => $item->nama,
        //             'status'  => $item->status,
        //             'kategori'  => $item->kategori
        //         ];
        //     });

        // $allKulinerKategori = $wkKategori
        //     ->concat($pengajuanKategori)
        //     ->concat($pengajuanKDisetujui)
        //     ->sortby(function ($item) {
        //         return match ($item['status']) {
        //             'Aktif'  => 1,
        //             'Tutup Sementara'  => 2,
        //             'Tutup Permanen'  => 3,
        //             'Belum Diverifikasi'  => 4,
        //             'Disetujui'  => 5,
        //             'Ditolak'  => 6,
        //         };
        //     })
        //     ->values();

        // Fasilitas
        $fasilitas = Fasilitas::with([
            'wisataKuliner.fasilitas',
            'pengajuanwisataKuliner.fasilitas'
        ])
            ->withCount('wisataKuliner', 'pengajuanwisataKuliner')
            ->orderBy('nama', 'asc')
            ->paginate(10, ['*'], 'fasilitas')
            ->withQueryString();


        $fasilitas->getCollection()->transform(function ($item, $key) use ($fasilitas) {
            $item->nomor = ($fasilitas->currentPage() -  1) * $fasilitas->perPage() + $key + 1;
            // $total = $item->wisataKuliner->count();

            // $pengajuanFasilitas = $item->pengajuanwisataKuliner
            //     ->whereIn('status', ['Belum Diverifikasi', 'Ditolak']);

            // $pengajuanFDisetujui = $item->pengajuanwisataKuliner
            //     ->where('status', 'Disetujui')
            //     ->sortByDesc('waktu_dibuat')
            //     ->unique('id_wisata_kuliner');

            // $semuaPengajuan = $pengajuanFasilitas->concat($pengajuanFDisetujui);

            // foreach ($semuaPengajuan  as $pengajuan) {
            //     if ($pengajuan->status === 'Belum Diverifikasi'  || $pengajuan->status === 'Ditolak') {
            //         $total++;
            //     }

            //     if ($pengajuan->status === 'Disetujui') {

            //         $wk = $item->wisataKuliner
            //             ->firstWhere('id_wisata_kuliner', $pengajuan->id_wisata_kuliner);
            //         if (!$wk) {
            //             $total++;
            //         } else {
            //             $aktif = $wk->fasilitas->pluck('id_fasilitas')->sort()->values();
            //             $disetujui = $pengajuan->fasilitas->pluck('id_fasilitas')->sort()->values();
            //             if ($aktif->toArray() !== $disetujui->toArray()) {
            //                 $total++;
            //             }
            //         }
            //     }
            // }

            // $item->total_wisata = $total;
            return $item;
        });

        // $wkFasilitas = WisataKuliner::with('fasilitas:id_fasilitas,nama')
        //     ->get()
        //     ->map(function ($item) {
        //         return [
        //             'id' => $item->id_wisata_kuliner,
        //             'nama'  => $item->nama,
        //             'status'  => $item->status_operasional,
        //             'fasilitas'  => $item->fasilitas
        //         ];
        //     });

        // $pengajuanWKFasilitas = PengajuanWisataKuliner::with('fasilitas:id_fasilitas,nama')
        //     ->get();

        // $pengajuanFasilitas = $pengajuanWKFasilitas
        //     ->whereIn('status', ['Belum Diverifikasi', 'Ditolak'])
        //     ->map(function ($item) {
        //         return [
        //             'id'  => $item->id_wisata_kuliner,
        //             'nama'  => $item->nama,
        //             'status'  => $item->status,
        //             'fasilitas'  => $item->fasilitas
        //         ];
        //     });

        // $pengajuanFDisetujui = $pengajuanWKFasilitas
        //     ->where('status', 'Disetujui')
        //     // ->sortByDesc('waktu_dibuat')
        //     // ->unique('id_wisata_kuliner')
        //     ->filter(function ($pengajuan) use ($wkFasilitas) {

        //         $wk = $wkFasilitas->firstWhere('id', $pengajuan->id_wisata_kuliner);
        //         if (!$wk) {
        //             return true;
        //         }

        //         $aktif = collect($wk['fasilitas'])->pluck('id_fasilitas')->sort()->values();
        //         $disetujui = $pengajuan->fasilitas->pluck('id_fasilitas')->sort()->values();
        //         return $aktif->toArray() !== $disetujui->toArray();
        //     })
        //     ->map(function ($item) {
        //         return [
        //             'id'  => $item->id_wisata_kuliner,
        //             'nama'  => $item->nama,
        //             'status'  => $item->status,
        //             'fasilitas'  => $item->fasilitas
        //         ];
        //     });

        // $allKulinerFasilitas = $wkFasilitas
        //     ->concat($pengajuanFasilitas)
        //     ->concat($pengajuanFDisetujui)
        //     ->sortby(function ($item) {

        //         return match ($item['status']) {
        //             'Aktif'  => 1,
        //             'Tutup Sementara'  => 2,
        //             'Tutup Permanen'  => 3,
        //             'Belum Diverifikasi'  => 4,
        //             'Disetujui'  => 5,
        //             'Ditolak'  => 6,
        //         };
        //     })
        //     ->values();

        return view('admin.kelola-wisata-kuliner.halaman-wisatakuliner', compact(
            'wisataKuliner',
            'kategori',
            // 'allKulinerKategori',
            'fasilitas',
            // 'allKulinerFasilitas',
        ));

        // $wkFasilitas = WisataKuliner::with('fasilitas:id_fasilitas,nama')
        //     ->get()
        //     ->map(function ($item) {
        //         return [
        //             'id' => $item->id_wisata_kuliner,
        //             'nama' => $item->nama,
        //             'status' => 'Aktif',
        //             'fasilitas' => $item->fasilitas
        //         ];
        //     });

        // $pengajuanWisataKulinerFasilitas = PengajuanWisataKuliner::with('fasilitas:id_fasilitas,nama')
        //     ->get()
        //     ->map(function ($item) {
        //         return [
        //             'id' => $item->id_wisata_kuliner,
        //             'nama' => $item->nama,
        //             'status' => $item->status,
        //             'fasilitas' => $item->fasilitas
        //         ];
        //     });

        // $allKulinerFasilitas = $wkFasilitas->concat($pengajuanWisataKulinerFasilitas);
        // $allKulinerFasilitas = $wkFasilitas
        //     ->concat($pengajuanWisataKulinerFasilitas)
        //     ->sortBy(function ($item) {
        //         return match ($item['status']) {
        //             'Aktif' => 1,
        //             'Belum Diverifikasi' => 2,
        //             'Disetujui' => 3,
        //             'Ditolak' => 4,
        //         };
        //     })
        //     ->values();

    }

    public function tampilkanTambahWK()
    {
        $wkuliner = WisataKuliner::where('status', 'Disetujui')->get();

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


        return view('admin.kelola-wisata-kuliner.halaman-tambahwkuliner', compact(
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
            'nama_wisata_kuliner'  => 'required|string|max:255',
            'kecamatan'  => 'required|string|max:50',
            'kelurahan'  => 'required|string|max:50',
            'alamat'  => 'required|string',
            'no_telp'  => 'nullable|string|min:10|max:15',
            'deskripsi'  => 'required|string|max:255',
            'foto'  => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'latitude'  => 'required|numeric|between:-90,90',
            'longitude'  => 'required|numeric|between:-180,180',
            'sertifikat_halal'  => 'required',
        ], [
            'nama_wisata_kuliner.required'  => 'Nama wisata kuliner harus diisi',
            'kecamatan'  => 'Kecamatan harus diisi',
            'kelurahan'  => 'Kelurahan harus diisi',
            'alamat'  => 'Alamat harus diisi',
            'deskripsi'  => 'Deskripsi harus diisi',
            'sertifikat_halal'  => 'Pilihan sertifikat halal harus diisi',
        ],);

        $fotoPath = null;
        if ($request->foto) {
            $fotoPath = $request->file('foto')->storeAs(
                'uploads',
                'foto_ ' . '_ ' . time() . '. ' . $request->file('foto')->extension(),
                'public'
            );
        }

        $id_admin = Admin::where('user_id', Auth::id())->value('id_admin');
        $waktu_dibuat = Carbon::now('Asia/Jakarta');
        $waktu_diubah = Carbon::now('Asia/Jakarta');

        $fasilitas = $request->id_fasilitas ?? [];
        // $kategori = $request->id_kategori ?? [];
        $kategori = [
            [
                'value'  => $request->jenis_hidangan,
                'jenis'  => 'Jenis Hidangan'
            ],
            [
                'value'  => $request->kategori_tempat,
                'jenis'  => 'Tempat'
            ],
            [
                'value'  => $request->asal_kuliner,
                'jenis'  => 'Asal Kuliner'
            ]

        ];

        $idWisata = $request->nama_wisata_kuliner;
        if (!is_numeric($idWisata)) {
            $wisata = WisataKuliner::firstOrCreate([
                'nama'  => trim($idWisata),
                'kecamatan'  => $request->kecamatan,
                'kelurahan'  => $request->kelurahan,
                'alamat'  => $request->alamat,
                'no_telp'  => $request->no_telp ?? null,
                'foto'  => $fotoPath,
                'deskripsi'  => $request->deskripsi,
                'latitude'  => $request->latitude,
                'longitude'  => $request->longitude,
                'harga_min'  => null,
                'harga_max'  => null,
                'penilaian'  => null,
                'sertifikat_halal'  => $request->sertifikat_halal,
                'id_wisatawan'  => null,
                'id_admin'  => $id_admin,
                'status'  => 'Disetujui',
                'status_operasional'  => 'Aktif',
                'waktu_dibuat'  => $waktu_dibuat,
                'waktu_diubah'  => $waktu_diubah,
            ]);
            $idWisata = $wisata->id_wisata_kuliner;
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
                if ($kategori) {
                    if ($kategori->status !== 'Aktif') {
                        $kategori->update([
                            'status'  => 'Aktif'
                        ]);
                    }
                } else {
                    $kategori = Kategori::firstOrCreate([
                        'nama'  => trim($item['value']),
                        'jenis_kategori'  => $item['jenis'],
                        'status'  => 'Aktif',
                    ]);
                }
                $kategoriId = $kategori->id_kategori;
            }
            $kategoriIds[] = $kategoriId;
        }

        // Fasilitas
        $fasilitasIds = [];
        foreach ($fasilitas as $item) {
            if (is_numeric($item)) {
                $fasilitasId = $item;
            } else {
                $fasilitas = Fasilitas::where('nama', trim($item))->first();
                if ($fasilitas) {
                    if ($fasilitas->status !== 'Aktif') {
                        $fasilitas->update([
                            'status'  => 'Aktif'
                        ]);
                    }
                } else {
                    $fasilitas = Fasilitas::firstOrCreate([
                        'nama'  => trim($item),
                        'status'  => 'Aktif',
                    ]);
                }
                $fasilitasId = $fasilitas->id_fasilitas;
            }
            $fasilitasIds[] = $fasilitasId;
        }
        $wisata = WisataKuliner::find($idWisata);
        $wisata->fasilitas()->sync($fasilitasIds);
        // $kategoriIds = [];

        // foreach ($kategori as $item) {

        //     if (is_numeric($item)) {
        //         $kategoriId = $item;
        //     } else {

        //         $kategori = Kategori::firstOrCreate([
        //             'nama' => trim($item),
        //         ]);

        //         $kategoriId = $kategori->id_kategori;
        //     }

        //     $kategoriIds[] = $kategoriId;
        // }

        $wisata = WisataKuliner::find($idWisata);
        $wisata->kategori()->sync($kategoriIds);

        return redirect($request->redirect  ?? route('kelolawisatakuliner'))->with('success', 'Wisata Kuliner berhasil disimpan');
        // return redirect()->route('kelolawisatakuliner')->with('success', 'Wisata Kuliner berhasil disimpan');
    }

    public function tampilkanDetailWK(int $id)
    {
        $wisataKuliner = WisataKuliner::with([
            'wisatawan.user',
            'admin.user',
            'fasilitas',
            'kategori'
        ])->findOrFail($id);


        if ($wisataKuliner->id_wisatawan) {

            $pengaju = $wisataKuliner->wisatawan->user;
        } else {

            $pengaju = $wisataKuliner->admin->user;
        }

        return response()->json([
            'nama'  => $wisataKuliner->nama,
            'nama_pengaju'  => $pengaju->nama,
            'email'  => $pengaju->email,
            'peran'  => $pengaju->peran,

            'alamat'  => $wisataKuliner->alamat,
            'kecamatan'  => $wisataKuliner->kecamatan,
            'kelurahan'  => $wisataKuliner->kelurahan,
            'deskripsi'  => $wisataKuliner->deskripsi,
            'latitude'  => $wisataKuliner->latitude,
            'longitude'  => $wisataKuliner->longitude,
            'no_telp'  => $wisataKuliner->no_telp,
            'foto'  => $wisataKuliner->foto,
            'sertifikat_halal'  => $wisataKuliner->sertifikat_halal,
            'status_operasional'  => $wisataKuliner->status_operasional,

            'fasilitas'  => $wisataKuliner->fasilitas,
            'kategori'  => $wisataKuliner->kategori,

        ]);
    }

    public function tampilkanEditWK(int $id)
    {
        $wisataKuliner = WisataKuliner::findOrFail($id);

        $wkuliner = WisataKuliner::where('status', 'Disetujui')->get();

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


        return view('admin.kelola-wisata-kuliner.halaman-editwkuliner', compact(
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

        ));
    }

    public function update(Request $request, int $id)
    {
        try {
            $wisataKuliner = WisataKuliner::findOrFail($id);
            // $request->validate([
            //     'nama' => 'required|string|max:255',
            //     'kecamatan' => 'required|string|max:50',
            //     'kelurahan' => 'required|string|max:50',
            //     'alamat' => 'required|string',
            //     'no_telp' => 'nullable|string|min:10|max:15',
            //     'email' => 'nullable|email|max:70',
            //     'deskripsi' => 'required|string|max:255',
            //     'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            //     'latitude'  => 'required|numeric|between:-90,90',
            //     // Rule::unique('wisata_kuliner')->ignore($wisataKuliner->id),
            //     'longitude' => 'required|numeric|between:-180,180',
            //     // Rule::unique('wisata_kuliner')->ignore($wisataKuliner->id),
            // ]);

            $request->validate([
                'nama_wisata_kuliner'  => 'required|string|max:255',
                'kecamatan'  => 'required|string|max:50',
                'kelurahan'  => 'required|string|max:50',
                'alamat'  => 'required|string',
                'no_telp'  => 'nullable|string|min:10|max:15',
                'deskripsi'  => 'required|string|max:255',
                'foto'  => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
                'latitude'  => 'required|numeric|between:-90,90',
                'longitude'  => 'required|numeric|between:-180,180',
                'sertifikat_halal'  => 'required',
            ], [
                'nama_wisata_kuliner.required'  => 'Nama wisata kuliner harus diisi',
                'kecamatan'  => 'Kecamatan harus diisi',
                'kelurahan'  => 'Kelurahan harus diisi',
                'alamat'  => 'Alamat harus diisi',
                'deskripsi'  => 'Deskripsi harus diisi',
                'sertifikat_halal'  => 'Pilihan sertifikat halal harus diisi',
            ],);


            $fotoPath = $wisataKuliner->foto ?? null;
            if ($request->hasFile('foto ')) {
                if ($wisataKuliner->foto  && Storage::exists('public/ ' . $wisataKuliner->foto)) {

                    Storage::delete('public/ ' . $wisataKuliner->foto);
                }

                $fotoPath = $request->file('foto')->storeAs(
                    'uploads',
                    'foto_ ' . '_ ' . time() . '. ' . $request->file('foto')->extension(),
                    'public'
                );
            }

            $id_admin = Admin::where('user_id', Auth::id())->value('id_admin');
            $waktu_diubah = Carbon::now('Asia/Jakarta');

            $fasilitas = $request->id_fasilitas ?? [];
            // $dataMK = $request->id_fasilitas ?? [];
            // $dataKategori = $request->id_kategori ?? [];

            $kategori = [
                [
                    'value'  => $request->jenis_hidangan,
                    'jenis'  => 'Jenis Hidangan'
                ],
                [
                    'value'  => $request->kategori_tempat,
                    'jenis'  => 'Tempat'
                ],
                [
                    'value'  => $request->asal_kuliner,
                    'jenis'  => 'Asal Kuliner'
                ]
            ];

            $idWisata = $request->nama_wisata_kuliner;
            $wisataKuliner->fill([
                'nama'  => trim($idWisata),
                'kecamatan'  => $request->kecamatan,
                'kelurahan'  => $request->kelurahan,
                'alamat'  => $request->alamat,
                'no_telp'  => $request->no_telp  ?? null,
                'foto'  => $fotoPath,
                'deskripsi'  => $request->deskripsi,
                'latitude'  => $request->latitude,
                'longitude'  => $request->longitude,
                'sertifikat_halal'  => $request->sertifikat_halal,
            ]);
            // $wisataKuliner->load([
            //     'kategori',
            //     'fasilitas'
            // ]);

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

            $kategoriBerubah = $oldKategori  != $newKategori;
            $fasilitasBerubah = $oldFasilitas  != $newFasilitas;
            // $oldKategori = $wisataKuliner->kategori->pluck('id_kategori')->toArray();
            // $oldFasilitas = $wisataKuliner->fasilitas->pluck('id_fasilitas')->toArray();

            // $newKategori = [
            //     $request->kategori_tempat,
            //     $request->jenis_hidangan,
            //     $request->asal_kuliner
            // ];

            // $newKategori = array_values(array_filter($newKategori));

            // $newFasilitas = $request->id_fasilitas ?? [];

            // $kategoriBerubah =
            //     implode(',', $oldKategori) !== implode(',', $newKategori);

            // $fasilitasBerubah =
            //     implode(',', $oldFasilitas) !== implode(',', $newFasilitas);


            $dataUtamaBerubah = $wisataKuliner->isDirty();
            if (!$dataUtamaBerubah  && !$kategoriBerubah  && !$fasilitasBerubah) {
                return redirect($request->redirect  ?? route('kelolawisatakuliner'))->with('info', 'Tidak Terdapat Perubahan');
            }
            // if (!$wisataKuliner->isDirty()) {
            //     return redirect()->route('kelolawisatakuliner')
            //         ->with('info', 'Tidak Terdapat Perubahan');
            // }
            // if (!$berubah && !$kategoriberubah && !$fasilitasberubah) {
            //     return back()->with('info', 'Tidak Terdapat Perubahan');
            // }
            $wisataKuliner->update([
                'nama'  => trim($idWisata),
                'kecamatan'  => $request->kecamatan,
                'kelurahan'  => $request->kelurahan,
                'alamat'  => $request->alamat,
                'no_telp'  => $request->no_telp  ?? null,
                'foto'  => $fotoPath,
                'deskripsi'  => $request->deskripsi,
                'latitude'  => $request->latitude,
                'longitude'  => $request->longitude,
                'id_wisatawan'  => null,
                'id_admin'  => $id_admin,
                'status'  => 'Disetujui',
                'status_operasional'  => $wisataKuliner->status_operasional,
                'waktu_diubah'  => $waktu_diubah,
            ]);

            $idWisata = $wisataKuliner->id_wisata_kuliner;

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
                    if ($kategori) {
                        if ($kategori->status !== 'Aktif') {
                            $kategori->update([
                                'status'  => 'Aktif'
                            ]);
                        }
                    } else {
                        $kategori = Kategori::firstOrCreate([
                            'nama'  => trim($item['value']),
                            'jenis_kategori'  => $item['jenis'],
                            'status'  => 'Aktif',
                        ]);
                    }
                    $kategoriId = $kategori->id_kategori;
                }
                $kategoriIds[] = $kategoriId;
            }

            $wisata = WisataKuliner::find($idWisata);
            $wisata->kategori()->sync($kategoriIds);

            // Fasilitas
            $fasilitasIds = [];

            foreach ($fasilitas  as $item) {
                if (is_numeric($item)) {
                    $fasilitasId = $item;
                } else {
                    $fasilitas = Fasilitas::where('nama', trim($item))->first();
                    if ($fasilitas) {
                        if ($fasilitas->status !== 'Aktif') {
                            $fasilitas->update([
                                'status'  => 'Aktif'
                            ]);
                        }
                    } else {
                        $fasilitas = Fasilitas::firstOrCreate([
                            'nama'  => trim($item),
                            'status'  => 'Aktif',
                        ]);
                    }
                    $fasilitasId = $fasilitas->id_fasilitas;
                }
                $fasilitasIds[] = $fasilitasId;
            }

            $wisata = WisataKuliner::find($idWisata);
            $wisata->fasilitas()->sync($fasilitasIds);


            // $favorit = KulinerFavorit::where('id_wisata_kuliner', $idWisata)->get();
            // $kategoriWisata = $wisata->kategori->pluck('id_kategori')->toArray();
            // foreach ($favorit as $f) {
            //     $id_wisatawan = $f->id_wisatawan;

            //     foreach ($kategoriWisata as $id_kategori) {

            //         $sudahAda = Preferensi::where('id_wisatawan', $id_wisatawan)
            //             ->where('id_kategori', $id_kategori)
            //             ->exists();

            //         if (!$sudahAda) {
            //             Preferensi::create([
            //                 'id_wisatawan' => $id_wisatawan,
            //                 'id_kategori' => $id_kategori,
            //                 'jumlah' => 1
            //             ]);
            //         }
            //     }
            // }

        } catch (\Exception $e) {

            dd($e->getMessage());
        }
        return redirect($request->redirect  ?? route('kelolawisatakuliner'))->with('success', 'Wisata Kuliner berhasil disimpan');
        // return redirect()->route('kelolawisatakuliner')->with('success', 'Wisata Kuliner berhasil disimpan');
    }

    public function ubahStatusOperasional(Request $request, int $id)


    {
        $kuliner = WisataKuliner::findOrFail($id);


        $statusBaru = $request->status;

        $waktu_diubah = Carbon::now('Asia/Jakarta');


        if (in_array($statusBaru, ['Aktif', 'Tutup Sementara', 'Tutup Permanen'])) {

            $kuliner->status_operasional = $statusBaru;

            $kuliner->waktu_diubah = $waktu_diubah;

            $kuliner->save();
        }

        return back()->with('success', 'Status operasional wisata kuliner berhasil diubah');
    }

    // public function hapus(int $id)
    // {
    //     $wisataKuliner = WisataKuliner::findOrFail($id);

    //     if ($wisataKuliner->foto && Storage::disk('public')->exists($wisataKuliner->foto)) {
    //         Storage::disk('public')->delete($wisataKuliner->foto);
    //     }

    //     $wisataKuliner->delete();

    //     return response()->json([
    //         'status' => 'success',
    //         'title' => 'Berhasil',
    //         'text' => 'Wisata Kuliner berhasil dihapus'
    //     ]);
    // }


    // Verifikasi
    public function tampilkanHalVerifikasi()
    {
        $wisataKuliner = PengajuanWisataKuliner::query()
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
            $item->nomor = ($wisataKuliner->currentPage() -  1) * $wisataKuliner->perPage() + $key + 1;
            return $item;
        });

        $ulasankuliner = Ulasan::orderByRaw("
                CASE 
                    WHEN status = 'Belum Diverifikasi' THEN 1
                    WHEN status = 'Disetujui' THEN 2
                    ELSE 3
                END
          ")
            ->orderBy('waktu_dibuat', 'desc')
            ->paginate(10, ['*'], 'ulasan')
            ->withQueryString();

        $ulasankuliner->getCollection()->transform(function ($item, $key) use ($ulasankuliner) {
            $item->nomor = ($ulasankuliner->currentPage() -  1) * $ulasankuliner->perPage() + $key + 1;
            return $item;
        });

        return view('admin.verifikasi.halaman-verifikasikuliner', compact(
            'wisataKuliner',
            'ulasankuliner'
        ));
    }

    public function tampilkanDetailVerifWK(int $id)
    {
        $pengajuan = PengajuanWisataKuliner::with([
            'wisatawan.user',
            'admin.user',
            'fasilitas',
            'kategori'
        ])->findOrFail($id);

        $wisataKuliner = null;

        if ($pengajuan->id_wisatawan) {
            $pengaju_baru = $pengajuan->wisatawan->user;
        } else {
            $pengaju_baru = $pengajuan->admin->user;
        }

        $pengaju_lama = null;

        if ($pengajuan->id_wisata_kuliner) {

            $wisataKuliner = WisataKuliner::with([
                'fasilitas',
                'kategori',
                'wisatawan.user',
                'admin.user',
            ])
                ->where('id_wisata_kuliner', $pengajuan->id_wisata_kuliner)
                ->first();

            if ($wisataKuliner->id_wisatawan) {
                $pengaju_lama = $wisataKuliner->wisatawan->user;
            } else {
                $pengaju_lama = $wisataKuliner->admin->user;
            }
        }

        return response()->json([
            'pengaju_lama'  => $pengaju_lama,
            'pengaju_baru'  => $pengaju_baru,
            'jenis_pengajuan'  => $pengajuan->jenis_pengajuan,
            'lama'  => $wisataKuliner,
            'baru'  => $pengajuan,
        ]);
    }

    public function verifikasiWisataKuliner(Request $request, int $id)
    {
        $pengajuan = PengajuanWisataKuliner::findOrFail($id);
        // $waktu_dibuat = Carbon::now('Asia/Jakarta');
        $waktu_diubah = Carbon::now('Asia/Jakarta');
        $id_admin = Admin::where('user_id', Auth::id())->value('id_admin');

        $fotoPath = $pengajuan->foto  ?? null;
        if ($request->hasFile('foto ')) {
            if ($pengajuan->foto  && Storage::exists('public/ ' . $pengajuan->foto)) {
                Storage::delete('public/ ' . $pengajuan->foto);
            }
            $fotoPath = $request->file('foto')->storeAs(
                'uploads',
                'foto_ ' . Str::slug($request->nama) . '_ ' . time() . '. ' . $request->file('foto')->extension(),
                'public'
            );
        }

        // $fasilitas = $request->id_fasilitas ?? [];
        // $kategori = $request->id_kategori ?? [];

        if ($pengajuan->jenis_pengajuan === 'Baru') {
            if ($request->status === 'Setujui') {
                $exists = WisataKuliner::where('latitude', $pengajuan->latitude)
                    ->where('longitude', $pengajuan->longitude)
                    ->exists();
                if ($exists) {
                    return response()->json([
                        'success'  => false,
                        'message'  => 'Lokasi sudah digunakan wisata kuliner lain'
                    ], 422);
                }

                $wisata = WisataKuliner::create([
                    'nama'  => $pengajuan->nama,
                    'kecamatan'  => $pengajuan->kecamatan,
                    'kelurahan'  => $pengajuan->kelurahan,
                    'alamat'  => $pengajuan->alamat,
                    'no_telp'  => $pengajuan->no_telp  ?? null,
                    'fo to'  => $fotoPath,
                    'deskripsi'  => $pengajuan->deskripsi,
                    'latitude'  => $pengajuan->latitude,
                    'longitude'  => $pengajuan->longitude,
                    'harga_min'  => null,
                    'harga_max'  => null,
                    'penilaian'  => null,
                    'sertifikat_halal'  => $pengajuan->sertifikat_halal,
                    'id_wisatawan'  => $pengajuan->id_wisatawan,
                    'id_admin'  => $id_admin,
                    'status'  => 'Disetujui',
                    'status_operasional'  => 'Aktif',
                    'waktu_dibuat'  => $pengajuan->waktu_dibuat,
                    'waktu_diubah'  => $waktu_diubah,
                ]);

                $fasilitasIds = $pengajuan->fasilitas()->pluck('fasilitas.id_fasilitas')->toArray();
                $kategoriIds = $pengajuan->kategori()->pluck('kategori.id_kategori')->toArray();

                $wisata->fasilitas()->sync($fasilitasIds);
                $wisata->kategori()->sync($kategoriIds);

                Kategori::whereIn('id_kategori', $kategoriIds)
                    ->where('status', 'Tidak Aktif')
                    ->update([
                        'status' => 'Aktif'
                    ]);

                Fasilitas::whereIn('id_fasilitas', $fasilitasIds)
                    ->where('status', 'Tidak Aktif')
                    ->update([
                        'status' => 'Aktif'
                    ]);

                $pengajuan->update([
                    'status'  => 'Disetujui',
                    'id_wisata_kuliner'  => $wisata->id_wisata_kuliner,
                    'waktu_diubah'  => $waktu_diubah,
                ]);
            } else {
                $pengajuan->update([
                    'status'  => 'Ditolak',
                    'waktu_diubah'  => $waktu_diubah,
                ]);
            }
        } else {
            $wisata = WisataKuliner::findOrFail($pengajuan->id_wisata_kuliner);
            if ($request->status === 'Setujui') {
                $exists = WisataKuliner::where('latitude', $pengajuan->latitude)
                    ->where('longitude', $pengajuan->longitude)
                    ->where('id_wisata_kuliner', '!=', $pengajuan->id_wisata_kuliner)
                    ->exists();

                if ($exists) {
                    return response()->json([
                        'success' =>  false,
                        'message' => 'Lokasi sudah digunakan wisata kuliner lain'
                    ], 422);
                }

                $wisata->update([
                    'nama' =>  $pengajuan->nama,
                    'kecamatan' =>  $pengajuan->kecamatan,
                    'kelurahan' =>  $pengajuan->kelurahan,
                    'alamat' =>  $pengajuan->alamat,
                    'no_telp' =>  $pengajuan->no_telp ?? null,
                    'foto' =>  $fotoPath,
                    'deskripsi' =>  $pengajuan->deskripsi,
                    'latitude' =>  $pengajuan->latitude,
                    'longitude' =>  $pengajuan->longitude,
                    'harga_min' =>  $wisata->harga_min,
                    'harga_max' =>  $wisata->harga_max,
                    'penilaian' =>  $wisata->penilaian,
                    'sertifikat_halal' =>  $pengajuan->sertifikat_halal,
                    'id_wisatawan' => $pengajuan->id_wisatawan,
                    'id_admin' => $id_admin,
                    'status' => 'Disetujui',
                    'status_operasional' => $pengajuan->status_operasional,
                    'waktu_dibuat' => $pengajuan->waktu_dibuat,
                    'waktu_diubah'  => $waktu_diubah,
                ]);

                $fasilitasIds = $pengajuan->fasilitas()->pluck('fasilitas.id_fasilitas')->toArray();
                $kategoriIds = $pengajuan->kategori()->pluck('kategori.id_kategori')->toArray();

                $wisata->fasilitas()->sync($fasilitasIds);
                $wisata->kategori()->sync($kategoriIds);

                Kategori::whereIn('id_kategori', $kategoriIds)
                    ->where('status', 'Tidak Aktif')
                    ->update([
                        'status' => 'Aktif'
                    ]);

                Fasilitas::whereIn('id_fasilitas', $fasilitasIds)
                    ->where('status', 'Tidak Aktif')
                    ->update([
                        'status' => 'Aktif'
                    ]);

                $pengajuan->update([
                    'status' => 'Disetujui',
                    'waktu_diubah' => $waktu_diubah,
                ]);
            } else {
                $pengajuan->update([
                    'status' => 'Ditolak',
                    'waktu_diubah' => $waktu_diubah,
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Wisata kuliner berhasil diverifikasi'
        ]);
    }

    public function cariWisataKuliner(Request $request)
    {
        $keyword = trim($request->keyword ?? '');
        $keywordLower = strtolower($keyword);
        $hasKeyword = $keywordLower !== '';

        $lat = $request->lat;
        $lng = $request->lng;
        $isTerdekat = $request->boolean('terdekat');

        $useJarakFilter = ($request->jarak && $request->jarak > 0);
        $kategoriFilter = $request->kategori ?? [];
        $fasilitasFilter = $request->fasilitas ?? [];

        $kategori = Kategori::all();
        $fasilitas = Fasilitas::all();
        $wisatawan = Wisatawan::where('user_id', Auth::id())->first();
        $favoritIds = [];
        if ($wisatawan) {
            $favoritIds = KulinerFavorit::where('id_wisatawan', $wisatawan->id_wisatawan)
                ->pluck('id_wisata_kuliner')->toArray();
        }

        $query = WisataKuliner::query()->with(['fasilitas', 'kategori'])->where('status', 'Disetujui')->where('status_operasional', 'Aktif');

        if ($hasKeyword) {
            $query->where(function ($q) use ($keywordLower) {
                $q->where('nama', 'like', '%' . $keywordLower . '%')
                    ->orWhere('kecamatan', 'like', '%' . $keywordLower . '%')
                    ->orWhere('kelurahan', 'like', '%' . $keywordLower . '%')
                    ->orWhere('alamat', 'like', '%' . $keywordLower . '%')
                    ->orWhereHas('kategori', function ($q2) use ($keywordLower) {
                        $q2->where('nama', 'like', '%' . $keywordLower . '%');
                    })
                    ->orWhereHas('fasilitas', function ($q2) use ($keywordLower) {
                        $q2->where('nama', 'like', '%' . $keywordLower . '%');
                    });
            });
        }

        $data = $query->get();

        if ($request->lat && $request->lng && $data->isNotEmpty()) {
            // $origin = $request->lat . ',' . $request->lng;

            // $destinations = $data->map(function ($item) {
            //     return $item->latitude . ',' . $item->longitude;
            // })->join('|');

            // $apiKey = 'AIzaSyD-gBdR_gqZTd8B6jz3mVJWI-pqC_jPlAI';

            // $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$origin}&destinations={$destinations}&key={$apiKey}&language=id";

            // $response = file_get_contents($url);
            // $response = json_decode($response, true);

            // foreach ($data as $index => $item) {
            //     $distanceMeter = $response['rows'][0]['elements'][$index]['distance']['value'] ?? null;
            //     $item->distance_km = $distanceMeter ? $distanceMeter / 1000 : null;
            // }

            // if (!$isTerdekat && $useJarakFilter && $request->jarak < 10) {
            //     $data = $data->filter(fn($item) => $item->distance_km <= $request->jarak)->values();
            // }
            $data = $this->cariJarakKeKuliner($request, $data, $isTerdekat, $useJarakFilter);
        }

        if (($request->minharga > 0) || ($request->maxharga < 500000)) {
            $data = $data->filter(function ($item) use ($request) {
                return $item->harga_max >= $request->minharga
                    && $item->harga_min <= $request->maxharga;
            })->values();
        }

        if (($request->minrating > 0) || ($request->maxrating < 5)) {
            $data = $data->filter(function ($item) use ($request) {
                return $item->penilaian >= $request->minrating
                    && $item->penilaian <= $request->maxrating;
            })->values();
        }

        $kulinerIds = $data->pluck('id_wisata_kuliner')->toArray();
        $kategoriMatchMap = [];
        if (!empty($kategoriFilter)) {
            $kategoriMatchMap = DB::table('kategori_wisata_kuliner')
                ->whereIn('id_wisata_kuliner', $kulinerIds)
                ->whereIn('id_kategori', $kategoriFilter)
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

        $hasKriteria = (
            !empty($request->kategori) ||
            !empty($request->fasilitas) ||

            ($request->minharga > 0) ||
            ($request->maxharga < 500000) ||

            ($request->minrating > 0) ||
            ($request->maxrating < 5) ||

            ($request->jarak < 10)
        ) && !$isTerdekat;

        $isFallback = false;

        // if ($data->isEmpty() && !$isTerdekat) {
        //     $isFallback = true;
        //     $query2 = WisataKuliner::with(['fasilitas', 'kategori'])->where('status', 'Disetujui')->where('status_operasional', 'Aktif');
        //     $data = $query2->limit(50)->get();
        // }
        $rawJarak     = 0;
        $rawHarga     = 0;
        $rawRating    = 0;
        $rawKategori  = 0;
        $rawFasilitas = 0;

        if ($hasKriteria) {
            $rawJarak     = $request->bobot_jarak;
            $rawHarga     = $request->bobot_harga;
            $rawRating    = $request->bobot_rating;
            $rawKategori  = $request->bobot_kategori;
            $rawFasilitas = $request->bobot_fasilitas;

            if (empty($kategoriFilter)) {
                $rawKategori = 0;
            }
            if (empty($fasilitasFilter)) {
                $rawFasilitas = 0;
            }

            $totalBobotAktif = $rawJarak + $rawHarga + $rawRating + $rawKategori + $rawFasilitas;
            if ($totalBobotAktif <= 0) {
                $totalBobotAktif = 1;
            }
            if ($totalBobotAktif == 0) {
                $bobotJarak = 0;
                $bobotHarga = 0;
                $bobotRating = 0;
                $bobotKategori = 0;
                $bobotFasilitas = 0;
            } else {
                $bobotJarak     = $rawJarak / $totalBobotAktif;
                $bobotHarga     = $rawHarga / $totalBobotAktif;
                $bobotRating    = $rawRating / $totalBobotAktif;
                $bobotKategori  = $rawKategori / $totalBobotAktif;
                $bobotFasilitas = $rawFasilitas / $totalBobotAktif;
            }

            $maxRating = max($data->pluck('penilaian')->filter()->toArray() ?: [1]);
            $minHarga = min($data->pluck('harga_min')->filter()->toArray() ?: [1]);
            $minJarak = min($data->pluck('distance_km')->filter()->toArray() ?: [1]);

            foreach ($data as $item) {
                $id = $item->id_wisata_kuliner;

                $kategoriMatch = $kategoriMatchMap[$id] ?? 0;
                $fasilitasMatch = $fasilitasMatchMap[$id] ?? 0;

                $ratingNorm =
                    $maxRating > 0
                    ? ($item->penilaian ?? 0) / $maxRating
                    : 0;

                $hargaNorm = ($item->harga_min > 0)
                    ? $minHarga / $item->harga_min
                    : 0;

                $jarakNorm = ($item->distance_km && $minJarak > 0) ? $minJarak / $item->distance_km : 0;

                $kategoriNorm =
                    !empty($kategoriFilter)
                    ? $kategoriMatch / count($kategoriFilter)
                    : 0;

                $fasilitasNorm =
                    !empty($fasilitasFilter)
                    ? $fasilitasMatch / count($fasilitasFilter)
                    : 0;

                $item->score =
                    ($jarakNorm * $bobotJarak) +
                    ($hargaNorm * $bobotHarga) +
                    ($ratingNorm * $bobotRating) +
                    ($kategoriNorm * $bobotKategori) +
                    ($fasilitasNorm * $bobotFasilitas);
                // $filterScore = 0;
                // if (!$useJarakFilter || ($item->distance_km ?? 999) <= $request->jarak) {
                //     $filterScore++;
                // }
                // if (!$useRatingFilter || $item->penilaian >= $request->minrating) {
                //     $filterScore++;
                // }
                // if (
                //     !$useHargaFilter ||
                //     (
                //         ($item->harga_min ?? 0) <= $request->maxharga &&
                //         ($item->harga_max ?? 999999) >= $request->minharga
                //     )
                // ) {
                //     $filterScore++;
                // }
                // if (empty($kategoriFilter) || $kategoriMatch > 0) {
                //     $filterScore++;
                // }
                // if (empty($fasilitasFilter) || $fasilitasMatch > 0) {
                //     $filterScore++;
                // }
                // $item->filter_score = $filterScore;

                // $item->score =
                //     ($distanceScore * 40) +
                //     ($ratingScore * 25) +
                //     ($hargaScore * 20) +
                //     ($kategoriMatch * 10) +
                //     ($fasilitasMatch * 5);
            }
        }

        if ($isTerdekat) {
            $data = $data
                ->sortBy('distance_km')
                ->values();
        } elseif ($hasKriteria) {
            $data = $data
                ->sortByDesc('score')
                ->values();
        } else {
            $data = $data->sortByDesc('penilaian')->values();
        }

        return view('wisatawan.pencarian.hasil-pencarian', compact('data', 'kategori', 'fasilitas', 'keyword', 'isFallback', 'favoritIds', 'rawJarak', 'rawHarga', 'rawRating', 'rawKategori', 'rawFasilitas'));
        // $isRekomendasi =
        //     ($keyword === '' ||
        //         str_contains($keywordLower, 'rekomendasi') ||
        //         str_contains($keywordLower, 'kuliner') ||
        //         str_contains($keywordLower, 'recommendation') ||
        //         str_contains($keywordLower, 'culinary')) && !$isTerdekat;

        // if (!$isRekomendasi && !$isTerdekat) {
        //     // $query->where(function ($q) use ($request) {
        //     $query->where(function ($q) use ($keyword) {
        //         $q->where('nama', 'like', '%' . $keyword . '%')
        //             ->orWhere('kecamatan', 'like', '%' . $keyword . '%')
        //             ->orWhere('kelurahan', 'like', '%' . $keyword . '%')
        //             ->orWhere('alamat', 'like', '%' . $keyword . '%')
        //             ->orWhereHas('kategori', function ($q2) use ($keyword) {
        //                 $q2->where('nama', 'like', '%' . $keyword . '%');
        //             })->orWhereHas('fasilitas', function ($q2) use ($keyword) {
        //                 $q2->where('nama', 'like', '%' . $keyword . '%');
        //             });
        //     });
        // }

        // $useHargaFilter =
        //     ($request->minharga && $request->minharga != 0) ||
        //     ($request->maxharga && $request->maxharga != 1000000);


        // if ($useRatingFilter) {
        //     $query->whereBetween('penilaian', [
        //         $request->minrating,
        //         $request->maxrating
        //     ]);
        // }

        // if ($useHargaFilter) {
        //     $query->where(function ($q) use ($request) {
        //         $q->where('harga_max', '>=', $request->minharga)
        //             ->where('harga_min', '<=', $request->maxharga);
        //     });
        // }
        // if ($useHargaFilter) {
        //     $query->where(function ($q) use ($request) {
        //         if (!is_null($request->minharga) && !is_null($request->maxharga)) {
        //             $q->where('harga_max', '>=', $request->minharga)
        //                 ->where('harga_min', '<=', $request->maxharga);
        //         } elseif (!is_null($request->minharga)) {
        //             $q->where('harga_max', '>=', $request->minharga);
        //         } elseif (!is_null($request->maxharga)) {
        //             $q->where('harga_min', '<=', $request->maxharga);
        //         }
        //     });
        // }
        // $maxSliderHarga = 500000;

        // $query->where(function ($q) use ($request, $maxSliderHarga) {
        //     if (!is_null($request->minharga)) {
        //         $q->where(function ($sub) use ($request) {
        //             $sub->where('harga_max', '>=', $request->minharga)
        //                 ->orWhereNull('harga_max');
        //         });
        //     }

        //     if (!is_null($request->maxharga) && $request->maxharga < $maxSliderHarga) {
        //         $q->where('harga_min', '<=', $request->maxharga);
        //     }
        // });
    }

    public function cariJarakKeKuliner($request, $data, $isTerdekat, $useJarakFilter)
    {
        $origin = $request->lat . ',' . $request->lng;

        $destinations = $data->map(function ($item) {
            return $item->latitude . ',' . $item->longitude;
        })->join('|');

        $apiKey = $apiKey = 'AIzaSyD-gBdR_gqZTd8B6jz3mVJWI-pqC_jPlAI';

        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$origin}&destinations={$destinations}&key={$apiKey}&language=id";

        $response = file_get_contents($url);
        $response = json_decode($response, true);

        foreach ($data as $index => $item) {
            $distanceMeter = $response['rows'][0]['elements'][$index]['distance']['value'] ?? null;
            $item->distance_km = $distanceMeter ? $distanceMeter / 1000 : null;
        }

        if (!$isTerdekat && $useJarakFilter && $request->jarak < 10) {
            $data = $data->filter(fn($item) => $item->distance_km <= $request->jarak)->values();
        }

        return $data;
    }

    // public function tampilkanWisataKuliner(Request $request, int $id)
    // {
    //     $wisataKuliner = WisataKuliner::findOrFail($id);

    //     $waktu_diubah = Carbon::now('Asia/Jakarta');

    //     if ($request->status === 'Disetujui') {
    //         $wisataKuliner->update([
    //             'status' => 'Disetujui',
    //             'waktu_diubah' => $waktu_diubah,
    //         ]);
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'wisataKuliner' => $wisataKuliner,
    //         'status' => $wisataKuliner->status,
    //         'message' => 'Wisata Kuliner berhasil disetujui'
    //     ]);
    // }

    // public function halamanVerifKuliner()
    // {
    //     $statuswisatakuliner = WisataKuliner::exists();
    //     $wisataKuliner = WisataKuliner::paginate(10)->withQueryString();;

    //     $wisataKuliner->getCollection()->transform(function ($item, $key) use ($wisataKuliner) {
    //         $item->nomor = ($wisataKuliner->currentPage() - 1) * $wisataKuliner->perPage() + $key + 1;
    //         return $item;
    //     });

    //     return view('admin.verifikasi-kuliner.halaman-verifikasi-kuliner', compact(
    //         'statuswisatakuliner',
    //         'wisataKuliner',
    //     ));
    // }

    // public function detailVerifKuliner($id)
    // {
    //     $wisataKuliner = WisataKuliner::findOrFail($id);

    //     return response()->json($wisataKuliner);
    // }

    // public function verifikasiWisataKuliner(Request $request, $id)
    // {
    //     $wisataKuliner = WisataKuliner::findOrFail($id);

    //     if ($request->status === 'Disetujui') {
    //         $wisataKuliner->update([
    //             'status' => 'Disetujui'
    //         ]);
    //     }

    //     if ($request->status === 'Ditolak') {
    //         $wisataKuliner->update([
    //             'status' => 'Ditolak'
    //         ]);
    //     }

    //     if ($request->status === 'Disetujui') {
    //         $wisataKuliner->update([
    //             'status' => 'Disetujui'
    //         ]);
    //     }

    //     // $wisataKuliner->save();

    //     return response()->json($wisataKuliner, [
    //         'success' => true,
    //         'wisataKuliner' => $wisataKuliner,
    //         'status' => $wisataKuliner->status
    //     ]);
    // }

    // public function search(Request $request)
    // {
    //     $kategori = Kategori::all();
    //     $fasilitas = Fasilitas::all();
    //     $wisatawan = Wisatawan::where('user_id', Auth::id())->first();
    //     $favoritIds = KulinerFavorit::where('id_wisatawan', $wisatawan->id_wisatawan)
    //         ->pluck('id_wisata_kuliner')
    //         ->toArray();
    //     // $lat = $request->lat;
    //     // $lng = $request->lng;
    //     // $radius = $request->radius ?? 5;

    //     // $query = DB::table('wisata_kuliner')
    //     //     ->selectRaw("
    //     //     *,
    //     //     (6371 * acos(
    //     //         cos(radians(?))
    //     //         * cos(radians(latitude))
    //     //         * cos(radians(longitude) - radians(?))
    //     //         + sin(radians(?))
    //     //         * sin(radians(latitude))
    //     //     )) AS distance
    //     // ", [$lat, $lng, $lat]);

    //     // // filter radius
    //     // $query->having('distance', '<', $radius);
    //     //     $lat = $request->lat;
    //     //     $lng = $request->lng;

    //     //     $query = DB::table('wisata_kuliner')
    //     //         ->selectRaw("
    //     //     *,
    //     //     (6371 * acos(
    //     //         cos(radians(?))
    //     //         * cos(radians(latitude))
    //     //         * cos(radians(longitude) - radians(?))
    //     //         + sin(radians(?))
    //     //         * sin(radians(latitude))
    //     //     )) AS distance
    //     // ", [$lat, $lng, $lat]);

    //     //     $query->orderBy('distance', 'asc');
    //     // $query = DB::table('wisata_kuliner');
    //     $query = \App\Models\WisataKuliner::query()->with(['fasilitas', 'kategori']);

    //     // $lat = $request->lat;
    //     // $lng = $request->lng;
    //     // $radius = $request->radius ?? 5;

    //     // $kuliner = DB::table('wisata_kuliner')
    //     //     ->selectRaw("
    //     //     *,
    //     //     (6371 * acos(
    //     //         cos(radians(?)) 
    //     //         * cos(radians(latitude)) 
    //     //         * cos(radians(longitude) - radians(?)) 
    //     //         + sin(radians(?)) 
    //     //         * sin(radians(latitude))
    //     //     )) AS distance
    //     // ", [$lat, $lng, $lat])
    //     //     ->having('distance', '<=', $radius)
    //     //     ->orderBy('distance', 'asc')
    //     //     ->get();

    //     // keyword
    //     if ($request->keyword) {
    //         // $query = DB::table('wisata_kuliner')->where('nama', 'like', '%' . $request->keyword . '%');
    //         $query->where(function ($q) use ($request) {
    //             $q->where('nama', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kecamatan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kelurahan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('alamat', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('no_telp', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('deskripsi', 'like', '%' . $request->keyword . '%');
    //         });
    //     }

    //     //penilaian
    //     if ($request->minrating && $request->maxrating) {
    //         $query->whereBetween('penilaian', [
    //             $request->minrating,
    //             $request->maxrating
    //         ]);
    //     }

    //     //harga
    //     if ($request->minharga && $request->maxharga) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('harga_max', '>=', $request->minharga)
    //                 ->where('harga_min', '<=', $request->maxharga);
    //         });
    //     }

    //     // filter kategori
    //     // if ($request->kategori) {
    //     //     $query->where('kategori', $request->kategori);
    //     // }

    //     // if ($request->rating) {
    //     //     $query->having('penilaian', '>=', $request->rating);
    //     // }

    //     // if ($request->fasilitas) {
    //     //     $query->join('fasilitas_wisata_kuliner', 'wisata_kuliner.id_wisata_kuliner', '=', 'fasilitas_wisata_kuliner.id_wisata_kuliner')
    //     //         ->whereIn('fasilitas_wisata_kuliner.id_fasilitas', $request->fasilitas);
    //     // }

    //     if ($request->lat && $request->lng && $request->jarak) {
    //         $lat = $request->lat;
    //         $lng = $request->lng;
    //         $jarak = $request->jarak;

    //         $query->selectRaw("
    //         *,
    //             (
    //                 6371 * 2 * ATAN2(
    //                     SQRT(
    //                         POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                         COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                         POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                     ),
    //                     SQRT(
    //                         1 - (
    //                             POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                             COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                             POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                         )
    //                     )
    //                 )
    //             ) AS distance
    //         ", [
    //             $lat,
    //             $lat,
    //             $lng,
    //             $lat,
    //             $lat,
    //             $lng
    //         ]);

    //         $query->having("distance", "<=", $jarak);

    //         $query->orderBy("distance", "asc");
    //     }
    //     // dd($request->lat, $request->lng, $request->jarak);
    //     $kuliner = $query
    //         ->orderBy('distance', 'asc')
    //         ->limit(20)
    //         ->get();

    //     $origins = "$lat,$lng";

    //     $destinations = $kuliner->map(function ($item) {
    //         return $item->latitude . ',' . $item->longitude;
    //     })->join('|');

    //     if ($request->fasilitas) {

    //         $query->leftJoin(
    //             'fasilitas_wisata_kuliner as f',
    //             'wisata_kuliner.id_wisata_kuliner',
    //             '=',
    //             'f.id_wisata_kuliner'
    //         )

    //             ->select(
    //                 'wisata_kuliner.*',
    //                 DB::raw('COUNT(CASE 
    //             WHEN f.id_fasilitas IN (' . implode(',', $request->fasilitas) . ') 
    //             THEN 1 END) as total_sesuai')
    //             )

    //             ->groupBy('wisata_kuliner.id_wisata_kuliner')
    //             ->having('total_sesuai', '>', 0)
    //             ->orderByDesc('total_sesuai');
    //     }

    //     // if ($request->lat && $request->lng) {

    //     //     $lat = $request->lat;
    //     //     $lng = $request->lng;

    //     //     $query->selectRaw("
    //     //     *,
    //     //     (6371 * acos(
    //     //         cos(radians(?))
    //     //         * cos(radians(latitude))
    //     //         * cos(radians(longitude) - radians(?))
    //     //         + sin(radians(?))
    //     //         * sin(radians(latitude))
    //     //     )) AS distance
    //     // ", [$lat, $lng, $lat]);

    //     //     // urutkan dari terdekat
    //     //     $query->orderBy('distance', 'asc');
    //     // }

    //     // $data = $query->orderBy('distance')->get();
    //     $data = $query->distinct()->get();

    //     // return response()->json($data);
    //     return view('wisatawan.pencarian.hasil-pencarian', compact('data', 'kategori', 'fasilitas', 'favoritIds'));
    // }

    // public function kulinerTerdekat(Request $request)
    // {
    //     $lat = $request->lat;
    //     $lng = $request->lng;
    //     $radius = $request->radius ?? 5; // default 5 km

    //     $kuliner = DB::table('wisata_kuliner')
    //         ->selectRaw("
    //         *,
    //         (6371 * acos(
    //             cos(radians(?)) 
    //             * cos(radians(latitude)) 
    //             * cos(radians(longitude) - radians(?)) 
    //             + sin(radians(?)) 
    //             * sin(radians(latitude))
    //         )) AS distance
    //     ", [$lat, $lng, $lat])
    //         ->having('distance', '<=', $radius)
    //         ->orderBy('distance', 'asc')
    //         ->get();

    //     return response()->json($kuliner);
    // }


    // public function search(Request $request)
    // {
    //     $kategori = Kategori::all();
    //     $fasilitas = Fasilitas::all();
    //     $wisatawan = Wisatawan::where('user_id', Auth::id())->first();
    //     $favoritIds = KulinerFavorit::where('id_wisatawan', $wisatawan->id_wisatawan)
    //         ->pluck('id_wisata_kuliner')
    //         ->toArray();

    //     $query = WisataKuliner::query()->with(['fasilitas', 'kategori']);

    //     $lat = $request->lat;
    //     $lng = $request->lng;

    //     // keyword
    //     if ($request->keyword) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('nama', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kecamatan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kelurahan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('alamat', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('no_telp', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('deskripsi', 'like', '%' . $request->keyword . '%');
    //         });
    //     }

    //     //penilaian
    //     if ($request->minrating && $request->maxrating) {
    //         $query->whereBetween('penilaian', [
    //             $request->minrating,
    //             $request->maxrating
    //         ]);
    //     }

    //     //harga
    //     if ($request->minharga && $request->maxharga) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('harga_max', '>=', $request->minharga)
    //                 ->where('harga_min', '<=', $request->maxharga);
    //         });
    //     }

    //     // haversine
    //     if ($request->lat && $request->lng && $request->jarak) {
    //         $lat = $request->lat;
    //         $lng = $request->lng;
    //         $jarak = $request->jarak;

    //         $query->selectRaw("
    //         *,
    //             (
    //                 6371 * 2 * ATAN2(
    //                     SQRT(
    //                         POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                         COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                         POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                     ),
    //                     SQRT(
    //                         1 - (
    //                             POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                             COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                             POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                         )
    //                     )
    //                 )
    //             ) AS haversine_distance
    //         ", [
    //             $lat,
    //             $lat,
    //             $lng,
    //             $lat,
    //             $lat,
    //             $lng
    //         ]);


    //         $query->having("haversine_distance", "<=", $jarak);

    //         // $query->orderBy("distance", "asc");
    //     }

    //     $data = $query->limit(20)->get();
    //     // if ($lat && $lng && count($data) > 0) {

    //     //     $destinations = $data->map(function ($item) {
    //     //         return $item->latitude . ',' . $item->longitude;
    //     //     })->join('|');

    //     //     $mockDistances = [];

    //     //     foreach ($data as $item) {
    //     //         $item->real_distance = $item->distance;
    //     //     }
    //     // }

    //     if ($request->lat && $request->lng && count($data) > 0) {

    //         $origin = $request->lat . ',' . $request->lng;

    //         $destinations = $data->map(function ($item) {
    //             return $item->latitude . ',' . $item->longitude;
    //         })->join('|');

    //         $apiKey = 'AIzaSyD-gBdR_gqZTd8B6jz3mVJWI-pqC_jPlAI';

    //         $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$origin}&destinations={$destinations}&key={$apiKey}";

    //         $response = file_get_contents($url);
    //         $response = json_decode($response, true);

    //         foreach ($data as $index => $item) {

    //             $distanceMeter = $response['rows'][0]['elements'][$index]['distance']['value'] ?? null;
    //             // $durationText = $response['rows'][0]['elements'][$index]['duration']['value'] ?? null;

    //             $item->distance_km = $distanceMeter ? $distanceMeter / 1000 : $item->haversine_distance;
    //             // $item->duration_min = $durationText ? $durationText / 60 : null;
    //         }
    //     }

    //     $totalFasilitasUser = count($request->fasilitas ?? []);

    //     foreach ($data as $item) {
    //         $item->distance_km = $response[$item->id]['distance'] ?? $item->haversine_distance;
    //         $kategoriMatch = 0;

    //         if ($request->kategori) {
    //             $kategoriMatch = DB::table('kategori_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_kategori', $request->kategori)
    //                 ->count();
    //         }

    //         $fasilitasMatch = 0;

    //         if ($request->fasilitas) {
    //             $fasilitasMatch = DB::table('fasilitas_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_fasilitas', $request->fasilitas)
    //                 ->count();
    //         }

    //         $distance = $item->distance_km ?? 999;

    //         $item->score =
    //             (1 / ($item->distance_km + 1)) * 40 +
    //             ($item->penilaian / 5) * 25 +
    //             (1 / ($item->harga_min + 1)) * 20 +
    //             ($kategoriMatch * 10) +
    //             ($fasilitasMatch * 5);
    //     }

    //     // $data = $query->distinct()->get();
    //     $data = $data->sortByDesc('score')->values();


    //     return view('wisatawan.pencarian.hasil-pencarian', compact('data', 'kategori', 'fasilitas', 'favoritIds'));
    // }

    // public function search(Request $request)
    // {
    //     $keyword = $request->keyword ?? 'Rekomendasi Kuliner';
    //     $kategori = Kategori::all();
    //     $fasilitas = Fasilitas::all();
    //     $wisatawan = Wisatawan::where('user_id', Auth::id())->first();
    //     $favoritIds = KulinerFavorit::where('id_wisatawan', $wisatawan->id_wisatawan)
    //         ->pluck('id_wisata_kuliner')
    //         ->toArray();

    //     $query = WisataKuliner::query()->with(['fasilitas', 'kategori']);

    //     $lat = $request->lat;
    //     $lng = $request->lng;

    //     // keyword
    //     if ($request->keyword) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('nama', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kecamatan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kelurahan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('alamat', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('no_telp', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('deskripsi', 'like', '%' . $request->keyword . '%');
    //         });
    //     }

    //     $useHargaFilter =
    //         ($request->minharga && $request->minharga != 0) ||
    //         ($request->maxharga && $request->maxharga != 1000000);

    //     $useRatingFilter =
    //         ($request->minrating && $request->minrating != 0) ||
    //         ($request->maxrating && $request->maxrating != 5);

    //     $useJarakFilter =
    //         ($request->jarak && $request->jarak > 0);

    //     // penilaian
    //     if ($useRatingFilter) {
    //         $query->whereBetween('penilaian', [
    //             $request->minrating,
    //             $request->maxrating
    //         ]);
    //     }

    //     // harga
    //     if ($useHargaFilter) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('harga_max', '>=', $request->minharga)
    //                 ->where('harga_min', '<=', $request->maxharga);
    //         });
    //     }

    //     // haversine
    //     if ($request->lat && $request->lng && $request->jarak) {
    //         $lat = $request->lat;
    //         $lng = $request->lng;
    //         $jarak = $request->jarak;

    //         $query->selectRaw("
    //         *,
    //             (
    //                 6371 * 2 * ATAN2(
    //                     SQRT(
    //                         POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                         COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                         POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                     ),
    //                     SQRT(
    //                         1 - (
    //                             POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                             COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                             POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                         )
    //                     )
    //                 )
    //             ) AS haversine_distance
    //         ", [
    //             $lat,
    //             $lat,
    //             $lng,
    //             $lat,
    //             $lat,
    //             $lng
    //         ]);


    //         if ($useJarakFilter) {
    //             $query->having('distance_km', '<=', $request->jarak);
    //         }

    //         // $query->orderBy("distance", "asc");
    //     }

    //     $data = $query->limit(50)->get();

    //     // preferensi
    //     $preferensiKuliner = DB::table('preferensi')
    //         ->where('id_wisatawan', $wisatawan->id_wisatawan)
    //         ->pluck('id_kategori')
    //         ->toArray();

    //     if ($request->lat && $request->lng && count($data) > 0) {

    //         $origin = $request->lat . ',' . $request->lng;

    //         $destinations = $data->map(function ($item) {
    //             return $item->latitude . ',' . $item->longitude;
    //         })->join('|');

    //         $apiKey = 'AIzaSyD-gBdR_gqZTd8B6jz3mVJWI-pqC_jPlAI';

    //         $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$origin}&destinations={$destinations}&key={$apiKey}";

    //         $response = file_get_contents($url);
    //         $response = json_decode($response, true);

    //         foreach ($data as $index => $item) {

    //             $distanceMeter = $response['rows'][0]['elements'][$index]['distance']['value'] ?? null;
    //             // $durationText = $response['rows'][0]['elements'][$index]['duration']['value'] ?? null;

    //             $item->distance_km = $distanceMeter ? $distanceMeter / 1000 : $item->haversine_distance;
    //             // $item->duration_min = $durationText ? $durationText / 60 : null;
    //         }
    //     }

    //     $totalFasilitasUser = count($request->fasilitas ?? []);

    //     foreach ($data as $item) {
    //         $listKategori = $request->kategori ?? [];
    //         if (!empty($listKategori)) {
    //             $cariKategori = $listKategori;
    //         } elseif (!empty($preferensiKuliner)) {
    //             $cariKategori = $preferensiKuliner;
    //         } else {
    //             $cariKategori = [];
    //         }

    //         $kategoriMatch = 0;
    //         if ($request->kategori) {
    //             $kategoriMatch = DB::table('kategori_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_kategori', $request->kategori)
    //                 ->count();
    //         }

    //         $fasilitasMatch = 0;
    //         if ($request->fasilitas) {
    //             $fasilitasMatch = DB::table('fasilitas_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_fasilitas', $request->fasilitas)
    //                 ->count();
    //         }

    //         // $item->distance_km = $response[$item->id]['distance'] ?? $item->haversine_distance;

    //         $distanceScore = 1 / (($item->distance_km ?? 999) + 1);
    //         $ratingScore = ($item->penilaian ?? 0) / 5;
    //         $hargaScore = 1 / (($item->harga_min ?? 1) + 1);

    //         $item->score =
    //             ($distanceScore * 40) +
    //             ($ratingScore * 25) +
    //             ($hargaScore * 20) +
    //             ($kategoriMatch * 10) +
    //             ($fasilitasMatch * 5);
    //     }

    //     // $data = $query->distinct()->get();
    //     $data = $data->sortByDesc('score')->values();


    //     return view('wisatawan.pencarian.hasil-pencarian', compact('data', 'kategori', 'fasilitas', 'favoritIds', 'keyword'));
    // }

    // public function search(Request $request)
    // {
    //     $keyword = $request->keyword ?? 'Rekomendasi Kuliner';
    //     $kategori = Kategori::all();
    //     $fasilitas = Fasilitas::all();
    //     $wisatawan = Wisatawan::where('user_id', Auth::id())->first();
    //     $favoritIds = [];
    //     if ($wisatawan) {
    //         $favoritIds = KulinerFavorit::where('id_wisatawan', $wisatawan->id_wisatawan)
    //             ->pluck('id_wisata_kuliner')
    //             ->toArray();
    //     }

    //     $query = WisataKuliner::query()->with(['fasilitas', 'kategori']);

    //     $lat = $request->lat;
    //     $lng = $request->lng;

    //     // keyword
    //     $keyword = $request->keyword;

    //     $isRekomendasi = false;

    //     if (!$keyword || trim($keyword) === '') {
    //         $isRekomendasi = true;
    //     }

    //     if ($request->keyword) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('nama', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kecamatan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kelurahan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('alamat', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('deskripsi', 'like', '%' . $request->keyword . '%');
    //         });
    //     }

    //     $useHargaFilter =
    //         ($request->minharga && $request->minharga != 0) ||
    //         ($request->maxharga && $request->maxharga != 1000000);

    //     $useRatingFilter =
    //         ($request->minrating && $request->minrating != 0) ||
    //         ($request->maxrating && $request->maxrating != 5);

    //     $useJarakFilter =
    //         ($request->jarak && $request->jarak > 0);

    //     // penilaian
    //     if ($useRatingFilter) {
    //         $query->whereBetween('penilaian', [
    //             $request->minrating,
    //             $request->maxrating
    //         ]);
    //     }

    //     // harga
    //     if ($useHargaFilter) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('harga_max', '>=', $request->minharga)
    //                 ->where('harga_min', '<=', $request->maxharga);
    //         });
    //     }

    //     // haversine
    //     if ($request->lat && $request->lng && $request->jarak) {
    //         $lat = $request->lat;
    //         $lng = $request->lng;
    //         $jarak = $request->jarak;

    //         $query->selectRaw("
    //         *,
    //             (
    //                 6371 * 2 * ATAN2(
    //                     SQRT(
    //                         POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                         COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                         POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                     ),
    //                     SQRT(
    //                         1 - (
    //                             POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                             COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                             POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                         )
    //                     )
    //                 )
    //             ) AS haversine_distance
    //         ", [
    //             $lat,
    //             $lat,
    //             $lng,
    //             $lat,
    //             $lat,
    //             $lng
    //         ]);


    //         if ($useJarakFilter) {
    //             $query->having('distance_km', '<=', $request->jarak);
    //         }

    //         // $query->orderBy("distance", "asc");
    //     }

    //     $data = $query->limit(50)->get();

    //     // preferensi
    //     $preferensiKuliner = DB::table('preferensi')
    //         ->where('id_wisatawan', $wisatawan->id_wisatawan)
    //         ->pluck('id_kategori')
    //         ->toArray();

    //     if ($request->lat && $request->lng && count($data) > 0) {

    //         $origin = $request->lat . ',' . $request->lng;

    //         $destinations = $data->map(function ($item) {
    //             return $item->latitude . ',' . $item->longitude;
    //         })->join('|');

    //         $apiKey = 'AIzaSyD-gBdR_gqZTd8B6jz3mVJWI-pqC_jPlAI';

    //         $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$origin}&destinations={$destinations}&key={$apiKey}";

    //         $response = file_get_contents($url);
    //         $response = json_decode($response, true);

    //         foreach ($data as $index => $item) {

    //             $distanceMeter = $response['rows'][0]['elements'][$index]['distance']['value'] ?? null;
    //             // $durationText = $response['rows'][0]['elements'][$index]['duration']['value'] ?? null;

    //             $item->distance_km = $distanceMeter ? $distanceMeter / 1000 : $item->haversine_distance;
    //             // $item->duration_min = $durationText ? $durationText / 60 : null;
    //         }
    //     }

    //     $totalFasilitasUser = count($request->fasilitas ?? []);

    //     foreach ($data as $item) {
    //         $listKategori = $request->kategori ?? [];
    //         if (!empty($listKategori)) {
    //             $cariKategori = $listKategori;
    //         } elseif (!empty($preferensiKuliner)) {
    //             $cariKategori = $preferensiKuliner;
    //         } else {
    //             $cariKategori = [];
    //         }

    //         $kategoriMatch = 0;
    //         if ($request->kategori) {
    //             $kategoriMatch = DB::table('kategori_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_kategori', $request->kategori)
    //                 ->count();
    //         }

    //         $fasilitasMatch = 0;
    //         if ($request->fasilitas) {
    //             $fasilitasMatch = DB::table('fasilitas_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_fasilitas', $request->fasilitas)
    //                 ->count();
    //         }

    //         // $item->distance_km = $response[$item->id]['distance'] ?? $item->haversine_distance;

    //         $distanceScore = 1 / (($item->distance_km ?? 999) + 1);
    //         $ratingScore = ($item->penilaian ?? 0) / 5;
    //         $hargaScore = 1 / (($item->harga_min ?? 1) + 1);

    //         $item->score =
    //             ($distanceScore * 40) +
    //             ($ratingScore * 25) +
    //             ($hargaScore * 20) +
    //             ($kategoriMatch * 10) +
    //             ($fasilitasMatch * 5);
    //     }

    //     // $data = $query->distinct()->get();
    //     $data = $data->sortByDesc('score')->values();


    //     return view('wisatawan.pencarian.hasil-pencarian', compact('data', 'kategori', 'fasilitas', 'favoritIds', 'keyword'));
    // }

    // public function search(Request $request)
    // {
    //     $kategori = Kategori::all();
    //     $fasilitas = Fasilitas::all();

    //     $wisatawan = Wisatawan::where('user_id', Auth::id())->first();

    //     $favoritIds = [];
    //     if ($wisatawan) {
    //         $favoritIds = KulinerFavorit::where('id_wisatawan', $wisatawan->id_wisatawan)
    //             ->pluck('id_wisata_kuliner')
    //             ->toArray();
    //     }

    //     $query = WisataKuliner::with(['fasilitas', 'kategori']);

    //     $lat = $request->lat;
    //     $lng = $request->lng;

    //     $keyword = trim($request->keyword ?? '');

    //     $isRekomendasi = false;

    //     if ($keyword === '' || $keyword === 'Rekomendasi Kuliner') {
    //         $isRekomendasi = true;
    //     }

    //     if (!$isRekomendasi) {
    //         $query->where(function ($q) use ($keyword) {
    //             $q->where('nama', 'like', "%{$keyword}%")
    //                 ->orWhere('alamat', 'like', "%{$keyword}%")
    //                 ->orWhere('kecamatan', 'like', "%{$keyword}%")
    //                 ->orWhere('kelurahan', 'like', "%{$keyword}%")
    //                 ->orWhere('deskripsi', 'like', "%{$keyword}%");
    //         });
    //     }

    //     if ($request->minrating !== null && $request->maxrating !== null) {
    //         $query->whereBetween('penilaian', [
    //             $request->minrating,
    //             $request->maxrating
    //         ]);
    //     }

    //     if ($request->minharga !== null && $request->maxharga !== null) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('harga_max', '>=', $request->minharga)
    //                 ->where('harga_min', '<=', $request->maxharga);
    //         });
    //     }

    //     if ($lat && $lng && $request->jarak) {

    //         $query->selectRaw("
    //         wisata_kuliner.*,
    //         (
    //             6371 * 2 * ATAN2(
    //                 SQRT(
    //                     POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                     COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                     POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                 ),
    //                 SQRT(
    //                     1 - (
    //                         POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                         COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                         POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                     )
    //                 )
    //             )
    //         ) AS distance_km
    //     ", [
    //             $lat,
    //             $lat,
    //             $lng,
    //             $lat,
    //             $lat,
    //             $lng
    //         ]);

    //         $query->having("distance_km", "<=", $request->jarak);
    //     }

    //     $data = $query->limit(50)->get();

    //     if ($lat && $lng && $data->count() > 0) {

    //         $origin = $lat . ',' . $lng;

    //         $destinations = $data->map(fn($i) => $i->latitude . ',' . $i->longitude)->join('|');

    //         $apiKey = 'API_KEY';

    //         $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$origin}&destinations={$destinations}&key={$apiKey}";

    //         $response = json_decode(file_get_contents($url), true);

    //         foreach ($data as $index => $item) {
    //             $distanceValue = $response['rows'][0]['elements'][$index]['distance']['value'] ?? null;
    //             $item->distance_km = $distanceValue ? $distanceValue / 1000 : null;
    //         }

    //         if ($request->jarak) {
    //             $data = $data->filter(fn($item) => $item->distance_km <= $request->jarak);
    //         }
    //     }

    //     foreach ($data as $item) {

    //         $kategoriMatch = 0;
    //         if ($request->kategori) {
    //             $kategoriMatch = DB::table('kategori_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_kategori', $request->kategori)
    //                 ->count();
    //         }

    //         $fasilitasMatch = 0;
    //         if ($request->fasilitas) {
    //             $fasilitasMatch = DB::table('fasilitas_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_fasilitas', $request->fasilitas)
    //                 ->count();
    //         }

    //         $item->score =
    //             (1000 - ($item->distance_km * 100)) +
    //             ($item->penilaian * 50) +
    //             ((1000000 - $item->harga_min) / 10000) +
    //             ($kategoriMatch * 30) +
    //             ($fasilitasMatch * 20);
    //     }

    //     $data = $data->sortByDesc('score')->values();

    //     return view('wisatawan.pencarian.hasil-pencarian', compact(
    //         'data',
    //         'kategori',
    //         'fasilitas',
    //         'favoritIds'
    //     ));
    // }

    // public function search(Request $request)
    // {
    //     $keyword = $request->keyword ?? 'Rekomendasi Kuliner';
    //     $kategori = Kategori::all();
    //     $fasilitas = Fasilitas::all();
    //     $wisatawan = Wisatawan::where('user_id', Auth::id())->first();
    //     $favoritIds = [];
    //     if ($wisatawan) {
    //         $favoritIds = KulinerFavorit::where('id_wisatawan', $wisatawan->id_wisatawan)
    //             ->pluck('id_wisata_kuliner')
    //             ->toArray();
    //     }

    //     $query = WisataKuliner::query()->with(['fasilitas', 'kategori']);

    //     $lat = $request->lat;
    //     $lng = $request->lng;

    //     // keyword
    //     $keyword = trim($request->keyword ?? '');

    //     $isRekomendasi = false;

    //     if ($keyword === '' || $keyword === 'Rekomendasi Kuliner') {
    //         $isRekomendasi = true;
    //     }

    //     if (!$isRekomendasi) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('nama', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kecamatan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kelurahan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('alamat', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('deskripsi', 'like', '%' . $request->keyword . '%');
    //         });
    //     }

    //     $useHargaFilter =
    //         ($request->minharga && $request->minharga != 0) ||
    //         ($request->maxharga && $request->maxharga != 1000000);

    //     $useRatingFilter =
    //         ($request->minrating && $request->minrating != 0) ||
    //         ($request->maxrating && $request->maxrating != 5);

    //     $useJarakFilter =
    //         ($request->jarak && $request->jarak > 0);

    //     // penilaian
    //     if ($useRatingFilter) {
    //         $query->whereBetween('penilaian', [
    //             $request->minrating,
    //             $request->maxrating
    //         ]);
    //     }

    //     // harga
    //     if ($useHargaFilter) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('harga_max', '>=', $request->minharga)
    //                 ->where('harga_min', '<=', $request->maxharga);
    //         });
    //     }

    //     // haversine
    //     if ($request->lat && $request->lng && $request->jarak) {
    //         $lat = $request->lat;
    //         $lng = $request->lng;
    //         $jarak = $request->jarak;

    //         $query->selectRaw("
    //         *,
    //             (
    //                 6371 * 2 * ATAN2(
    //                     SQRT(
    //                         POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                         COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                         POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                     ),
    //                     SQRT(
    //                         1 - (
    //                             POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                             COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                             POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                         )
    //                     )
    //                 )
    //             ) AS haversine_distance
    //         ", [
    //             $lat,
    //             $lat,
    //             $lng,
    //             $lat,
    //             $lat,
    //             $lng
    //         ]);


    //         if ($useJarakFilter) {
    //             $query->having('distance_km', '<=', $request->jarak);
    //         }

    //         // $query->orderBy("distance", "asc");
    //     }

    //     $data = $query->limit(50)->get();

    //     // preferensi
    //     $preferensiKuliner = DB::table('preferensi')
    //         ->where('id_wisatawan', $wisatawan->id_wisatawan)
    //         ->pluck('id_kategori')
    //         ->toArray();

    //     if ($request->lat && $request->lng && count($data) > 0) {

    //         $origin = $request->lat . ',' . $request->lng;

    //         $destinations = $data->map(function ($item) {
    //             return $item->latitude . ',' . $item->longitude;
    //         })->join('|');

    //         $apiKey = 'AIzaSyD-gBdR_gqZTd8B6jz3mVJWI-pqC_jPlAI';

    //         $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$origin}&destinations={$destinations}&key={$apiKey}";

    //         $response = file_get_contents($url);
    //         $response = json_decode($response, true);

    //         foreach ($data as $index => $item) {

    //             $distanceMeter = $response['rows'][0]['elements'][$index]['distance']['value'] ?? null;
    //             // $durationText = $response['rows'][0]['elements'][$index]['duration']['value'] ?? null;

    //             $item->distance_km = $distanceMeter ? $distanceMeter / 1000 : $item->haversine_distance;
    //             // $item->duration_min = $durationText ? $durationText / 60 : null;
    //         }
    //     }

    //     $totalFasilitasUser = count($request->fasilitas ?? []);

    //     foreach ($data as $item) {
    //         $listKategori = $request->kategori ?? [];
    //         if (!empty($listKategori)) {
    //             $cariKategori = $listKategori;
    //         } elseif (!empty($preferensiKuliner)) {
    //             $cariKategori = $preferensiKuliner;
    //         } else {
    //             $cariKategori = [];
    //         }

    //         $kategoriMatch = 0;
    //         if ($request->kategori) {
    //             $kategoriMatch = DB::table('kategori_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_kategori', $request->kategori)
    //                 ->count();
    //         }

    //         $fasilitasMatch = 0;
    //         if ($request->fasilitas) {
    //             $fasilitasMatch = DB::table('fasilitas_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_fasilitas', $request->fasilitas)
    //                 ->count();
    //         }

    //         // $item->distance_km = $response[$item->id]['distance'] ?? $item->haversine_distance;

    //         $distanceScore = 1 / (($item->distance_km ?? 999) + 1);
    //         $ratingScore = ($item->penilaian ?? 0) / 5;
    //         $hargaScore = 1 / (($item->harga_min ?? 1) + 1);

    //         $item->score =
    //             ($distanceScore * 40) +
    //             ($ratingScore * 25) +
    //             ($hargaScore * 20) +
    //             ($kategoriMatch * 10) +
    //             ($fasilitasMatch * 5);
    //     }

    //     // $data = $query->distinct()->get();
    //     $data = $data->sortByDesc('score')->values();


    //     return view('wisatawan.pencarian.hasil-pencarian', compact('data', 'kategori', 'fasilitas', 'favoritIds', 'keyword'));
    // }

    // public function search(Request $request)
    // {
    //     $keyword = $request->keyword ?? 'Rekomendasi Kuliner';
    //     $kategori = Kategori::all();
    //     $fasilitas = Fasilitas::all();
    //     $wisatawan = Wisatawan::where('user_id', Auth::id())->first();
    //     $favoritIds = [];
    //     if ($wisatawan) {
    //         $favoritIds = KulinerFavorit::where('id_wisatawan', $wisatawan->id_wisatawan)
    //             ->pluck('id_wisata_kuliner')
    //             ->toArray();
    //     }

    //     $query = WisataKuliner::query()->with(['fasilitas', 'kategori']);

    //     $lat = $request->lat;
    //     $lng = $request->lng;

    //     // keyword
    //     $keyword = trim($request->keyword ?? '');

    //     $isRekomendasi = false;

    //     if ($keyword === '' || $keyword === 'Rekomendasi Kuliner') {
    //         $isRekomendasi = true;
    //     }

    //     if (!$isRekomendasi) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('nama', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kecamatan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kelurahan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('alamat', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('deskripsi', 'like', '%' . $request->keyword . '%');
    //         });
    //     }

    //     $useHargaFilter =
    //         ($request->minharga && $request->minharga != 0) ||
    //         ($request->maxharga && $request->maxharga != 1000000);

    //     $useRatingFilter =
    //         ($request->minrating && $request->minrating != 0) ||
    //         ($request->maxrating && $request->maxrating != 5);

    //     $useJarakFilter =
    //         ($request->jarak && $request->jarak > 0);

    //     // penilaian
    //     if ($useRatingFilter) {
    //         $query->whereBetween('penilaian', [
    //             $request->minrating,
    //             $request->maxrating
    //         ]);
    //     }

    //     // harga
    //     if ($useHargaFilter) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('harga_max', '>=', $request->minharga)
    //                 ->where('harga_min', '<=', $request->maxharga);
    //         });
    //     }

    //     // haversine
    //     if ($request->lat && $request->lng && $request->jarak) {
    //         $lat = $request->lat;
    //         $lng = $request->lng;
    //         $jarak = $request->jarak;

    //         $query->selectRaw("
    //         *,
    //             (
    //                 6371 * 2 * ATAN2(
    //                     SQRT(
    //                         POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                         COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                         POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                     ),
    //                     SQRT(
    //                         1 - (
    //                             POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                             COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                             POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                         )
    //                     )
    //                 )
    //             ) AS haversine_distance
    //         ", [
    //             $lat,
    //             $lat,
    //             $lng,
    //             $lat,
    //             $lat,
    //             $lng
    //         ]);


    //         if ($useJarakFilter) {
    //             $query->having('distance_km', '<=', $request->jarak);
    //         }

    //         // $query->orderBy("distance", "asc");
    //     }

    //     $data = $query->limit(50)->get();

    //     // preferensi
    //     $preferensiKuliner = DB::table('preferensi')
    //         ->where('id_wisatawan', $wisatawan->id_wisatawan)
    //         ->pluck('id_kategori')
    //         ->toArray();

    //     if ($request->lat && $request->lng && count($data) > 0) {

    //         $origin = $request->lat . ',' . $request->lng;

    //         $destinations = $data->map(function ($item) {
    //             return $item->latitude . ',' . $item->longitude;
    //         })->join('|');

    //         $apiKey = 'AIzaSyD-gBdR_gqZTd8B6jz3mVJWI-pqC_jPlAI';

    //         $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$origin}&destinations={$destinations}&key={$apiKey}";

    //         $response = file_get_contents($url);
    //         $response = json_decode($response, true);

    //         foreach ($data as $index => $item) {

    //             $distanceMeter = $response['rows'][0]['elements'][$index]['distance']['value'] ?? null;
    //             // $durationText = $response['rows'][0]['elements'][$index]['duration']['value'] ?? null;

    //             $item->distance_km = $distanceMeter ? $distanceMeter / 1000 : $item->haversine_distance;
    //             // $item->duration_min = $durationText ? $durationText / 60 : null;
    //         }
    //     }

    //     $totalFasilitasUser = count($request->fasilitas ?? []);

    //     foreach ($data as $item) {
    //         $listKategori = $request->kategori ?? [];
    //         if (!empty($listKategori)) {
    //             $cariKategori = $listKategori;
    //         } elseif (!empty($preferensiKuliner)) {
    //             $cariKategori = $preferensiKuliner;
    //         } else {
    //             $cariKategori = [];
    //         }

    //         $kategoriMatch = 0;
    //         if ($request->kategori) {
    //             $kategoriMatch = DB::table('kategori_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_kategori', $request->kategori)
    //                 ->count();
    //         }

    //         $fasilitasMatch = 0;
    //         if ($request->fasilitas) {
    //             $fasilitasMatch = DB::table('fasilitas_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_fasilitas', $request->fasilitas)
    //                 ->count();
    //         }

    //         // $item->distance_km = $response[$item->id]['distance'] ?? $item->haversine_distance;

    //         $distanceScore = 1 / (($item->distance_km ?? 999) + 1);
    //         $ratingScore = ($item->penilaian ?? 0) / 5;
    //         $hargaScore = 1 / (($item->harga_min ?? 1) + 1);

    //         $item->score =
    //             ($distanceScore * 40) +
    //             ($ratingScore * 25) +
    //             ($hargaScore * 20) +
    //             ($kategoriMatch * 10) +
    //             ($fasilitasMatch * 5);
    //     }

    //     // $data = $query->distinct()->get();
    //     $data = $data->sortByDesc('score')->values();


    //     return view('wisatawan.pencarian.hasil-pencarian', compact('data', 'kategori', 'fasilitas', 'favoritIds', 'keyword'));
    // }

    // public function search(Request $request)
    // {
    //     $keyword = $request->keyword ?? 'Rekomendasi Kuliner';
    //     $kategori = Kategori::all();
    //     $fasilitas = Fasilitas::all();
    //     $wisatawan = Wisatawan::where('user_id', Auth::id())->first();
    //     $favoritIds = [];
    //     if ($wisatawan) {
    //         $favoritIds = KulinerFavorit::where('id_wisatawan', $wisatawan->id_wisatawan)
    //             ->pluck('id_wisata_kuliner')
    //             ->toArray();
    //     }

    //     $query = WisataKuliner::query()->with(['fasilitas', 'kategori']);

    //     $lat = $request->lat;
    //     $lng = $request->lng;

    //     // keyword
    //     $keyword = trim($request->keyword ?? '');

    //     $isRekomendasi = false;

    //     if ($keyword === '' || strtolower($keyword) === 'Rekomendasi Kuliner') {
    //         $isRekomendasi = true;
    //     }

    //     if (!$isRekomendasi) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('nama', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kecamatan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kelurahan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('alamat', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('deskripsi', 'like', '%' . $request->keyword . '%');
    //         });
    //     }

    //     $data = $query->get();

    //     if (!$isRekomendasi && $data->isEmpty()) {
    //         $isRekomendasi = true;

    //         $data = WisataKuliner::with(['fasilitas', 'kategori'])->get();
    //     }

    //     $useHargaFilter =
    //         ($request->minharga && $request->minharga != 0) ||
    //         ($request->maxharga && $request->maxharga != 1000000);

    //     $useRatingFilter =
    //         ($request->minrating && $request->minrating != 0) ||
    //         ($request->maxrating && $request->maxrating != 5);

    //     $useJarakFilter =
    //         ($request->jarak && $request->jarak > 0);

    //     // penilaian
    //     if ($useRatingFilter) {
    //         $query->whereBetween('penilaian', [
    //             $request->minrating,
    //             $request->maxrating
    //         ]);
    //     }

    //     // harga
    //     if ($useHargaFilter) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('harga_max', '>=', $request->minharga)
    //                 ->where('harga_min', '<=', $request->maxharga);
    //         });
    //     }

    //     // haversine
    //     if ($request->lat && $request->lng && $request->jarak) {
    //         $lat = $request->lat;
    //         $lng = $request->lng;
    //         $jarak = $request->jarak;

    //         $query->selectRaw("
    //         *,
    //             (
    //                 6371 * 2 * ATAN2(
    //                     SQRT(
    //                         POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                         COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                         POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                     ),
    //                     SQRT(
    //                         1 - (
    //                             POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                             COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                             POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                         )
    //                     )
    //                 )
    //             ) AS haversine_distance
    //         ", [
    //             $lat,
    //             $lat,
    //             $lng,
    //             $lat,
    //             $lat,
    //             $lng
    //         ]);


    //         if ($useJarakFilter) {
    //             $query->having('distance_km', '<=', $request->jarak);
    //         }

    //         // $query->orderBy("distance", "asc");
    //     }

    //     $data = $query->limit(50)->get();

    //     // preferensi
    //     $preferensiKuliner = DB::table('preferensi')
    //         ->where('id_wisatawan', $wisatawan->id_wisatawan)
    //         ->pluck('id_kategori')
    //         ->toArray();

    //     if ($request->lat && $request->lng && count($data) > 0) {

    //         $origin = $request->lat . ',' . $request->lng;

    //         $destinations = $data->map(function ($item) {
    //             return $item->latitude . ',' . $item->longitude;
    //         })->join('|');

    //         $apiKey = 'AIzaSyD-gBdR_gqZTd8B6jz3mVJWI-pqC_jPlAI';

    //         $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$origin}&destinations={$destinations}&key={$apiKey}";

    //         $response = file_get_contents($url);
    //         $response = json_decode($response, true);

    //         foreach ($data as $index => $item) {

    //             $distanceMeter = $response['rows'][0]['elements'][$index]['distance']['value'] ?? null;
    //             // $durationText = $response['rows'][0]['elements'][$index]['duration']['value'] ?? null;

    //             $item->distance_km = $distanceMeter ? $distanceMeter / 1000 : $item->haversine_distance;
    //             // $item->duration_min = $durationText ? $durationText / 60 : null;
    //         }
    //     }

    //     $totalFasilitasUser = count($request->fasilitas ?? []);

    //     foreach ($data as $item) {
    //         $listKategori = $request->kategori ?? [];
    //         if (!empty($listKategori)) {
    //             $cariKategori = $listKategori;
    //         } elseif (!empty($preferensiKuliner)) {
    //             $cariKategori = $preferensiKuliner;
    //         } else {
    //             $cariKategori = [];
    //         }

    //         $kategoriMatch = 0;
    //         if ($request->kategori) {
    //             $kategoriMatch = DB::table('kategori_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_kategori', $request->kategori)
    //                 ->count();
    //         }

    //         $fasilitasMatch = 0;
    //         if ($request->fasilitas) {
    //             $fasilitasMatch = DB::table('fasilitas_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_fasilitas', $request->fasilitas)
    //                 ->count();
    //         }

    //         // $item->distance_km = $response[$item->id]['distance'] ?? $item->haversine_distance;

    //         $distanceScore = 1 / (($item->distance_km ?? 999) + 1);
    //         $ratingScore = ($item->penilaian ?? 0) / 5;
    //         $hargaScore = 1 / (($item->harga_min ?? 1) + 1);

    //         $item->score =
    //             ($distanceScore * 40) +
    //             ($ratingScore * 25) +
    //             ($hargaScore * 20) +
    //             ($kategoriMatch * 10) +
    //             ($fasilitasMatch * 5);
    //     }

    //     // $data = $query->distinct()->get();
    //     $data = $data->sortByDesc('score')->values();


    //     return view('wisatawan.pencarian.hasil-pencarian', compact('data', 'kategori', 'fasilitas', 'favoritIds', 'keyword'));
    // }

    // public function search(Request $request)
    // {
    //     $kategori = Kategori::all();
    //     $fasilitas = Fasilitas::all();

    //     $wisatawan = Wisatawan::where('user_id', Auth::id())->first();
    //     $favoritIds = [];
    //     $preferensiKuliner = [];
    //     if ($wisatawan) {
    //         $favoritIds = KulinerFavorit::where('id_wisatawan', $wisatawan->id_wisatawan)
    //             ->pluck('id_wisata_kuliner')
    //             ->toArray();

    //         $preferensiKuliner = DB::table('preferensi')
    //             ->where('id_wisatawan', $wisatawan->id_wisatawan)
    //             ->pluck('id_kategori')
    //             ->toArray();
    //     }

    //     $lat = $request->lat;
    //     $lng = $request->lng;

    //     $query = WisataKuliner::query()->with(['fasilitas', 'kategori']);

    //     // keyword
    //     $keyword        = trim($request->keyword ?? '');
    //     $isRekomendasi  = ($keyword === '' || strtolower($keyword) === 'rekomendasi kuliner');
    //     $displayKeyword = $isRekomendasi ? 'Rekomendasi Kuliner' : $keyword;
    //     $keyword = trim($request->keyword ?? '');

    //     $isRekomendasi = false;

    //     if ($keyword === '' || strtolower($keyword) === 'Rekomendasi Kuliner') {
    //         $isRekomendasi = true;
    //     }

    //     if (!$isRekomendasi) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('nama', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kecamatan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kelurahan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('alamat', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('deskripsi', 'like', '%' . $request->keyword . '%');
    //         });
    //     }

    //     $data = $query->get();

    //     if (!$isRekomendasi && $data->isEmpty()) {
    //         $isRekomendasi = true;

    //         $data = WisataKuliner::with(['fasilitas', 'kategori'])->get();
    //     }

    //     $useHargaFilter =
    //         ($request->minharga && $request->minharga != 0) ||
    //         ($request->maxharga && $request->maxharga != 1000000);

    //     $useRatingFilter =
    //         ($request->minrating && $request->minrating != 0) ||
    //         ($request->maxrating && $request->maxrating != 5);

    //     $useJarakFilter =
    //         ($request->jarak && $request->jarak > 0);

    //     // penilaian
    //     if ($useRatingFilter) {
    //         $query->whereBetween('penilaian', [
    //             $request->minrating,
    //             $request->maxrating
    //         ]);
    //     }

    //     // harga
    //     if ($useHargaFilter) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('harga_max', '>=', $request->minharga)
    //                 ->where('harga_min', '<=', $request->maxharga);
    //         });
    //     }

    //     // haversine
    //     if ($request->lat && $request->lng && $request->jarak) {
    //         $lat = $request->lat;
    //         $lng = $request->lng;
    //         $jarak = $request->jarak;

    //         $query->selectRaw("
    //         *,
    //             (
    //                 6371 * 2 * ATAN2(
    //                     SQRT(
    //                         POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                         COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                         POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                     ),
    //                     SQRT(
    //                         1 - (
    //                             POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                             COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                             POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                         )
    //                     )
    //                 )
    //             ) AS haversine_distance
    //         ", [
    //             $lat,
    //             $lat,
    //             $lng,
    //             $lat,
    //             $lat,
    //             $lng
    //         ]);


    //         if ($useJarakFilter) {
    //             $query->having('distance_km', '<=', $request->jarak);
    //         }

    //         // $query->orderBy("distance", "asc");
    //     }

    //     $data = $query->limit(50)->get();

    //     // preferensi
    //     $preferensiKuliner = DB::table('preferensi')
    //         ->where('id_wisatawan', $wisatawan->id_wisatawan)
    //         ->pluck('id_kategori')
    //         ->toArray();

    //     if ($request->lat && $request->lng && count($data) > 0) {

    //         $origin = $request->lat . ',' . $request->lng;

    //         $destinations = $data->map(function ($item) {
    //             return $item->latitude . ',' . $item->longitude;
    //         })->join('|');

    //         $apiKey = 'AIzaSyD-gBdR_gqZTd8B6jz3mVJWI-pqC_jPlAI';

    //         $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$origin}&destinations={$destinations}&key={$apiKey}";

    //         $response = file_get_contents($url);
    //         $response = json_decode($response, true);

    //         foreach ($data as $index => $item) {

    //             $distanceMeter = $response['rows'][0]['elements'][$index]['distance']['value'] ?? null;
    //             // $durationText = $response['rows'][0]['elements'][$index]['duration']['value'] ?? null;

    //             $item->distance_km = $distanceMeter ? $distanceMeter / 1000 : $item->haversine_distance;
    //             // $item->duration_min = $durationText ? $durationText / 60 : null;
    //         }
    //     }

    //     $totalFasilitasUser = count($request->fasilitas ?? []);

    //     foreach ($data as $item) {
    //         $listKategori = $request->kategori ?? [];
    //         if (!empty($listKategori)) {
    //             $cariKategori = $listKategori;
    //         } elseif (!empty($preferensiKuliner)) {
    //             $cariKategori = $preferensiKuliner;
    //         } else {
    //             $cariKategori = [];
    //         }

    //         $kategoriMatch = 0;
    //         if ($request->kategori) {
    //             $kategoriMatch = DB::table('kategori_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_kategori', $request->kategori)
    //                 ->count();
    //         }

    //         $fasilitasMatch = 0;
    //         if ($request->fasilitas) {
    //             $fasilitasMatch = DB::table('fasilitas_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_fasilitas', $request->fasilitas)
    //                 ->count();
    //         }

    //         // $item->distance_km = $response[$item->id]['distance'] ?? $item->haversine_distance;

    //         $distanceScore = 1 / (($item->distance_km ?? 999) + 1);
    //         $ratingScore = ($item->penilaian ?? 0) / 5;
    //         $hargaScore = 1 / (($item->harga_min ?? 1) + 1);

    //         $item->score =
    //             ($distanceScore * 40) +
    //             ($ratingScore * 25) +
    //             ($hargaScore * 20) +
    //             ($kategoriMatch * 10) +
    //             ($fasilitasMatch * 5);
    //     }

    //     // $data = $query->distinct()->get();
    //     $data = $data->sortByDesc('score')->values();


    //     return view('wisatawan.pencarian.hasil-pencarian', compact('data', 'kategori', 'fasilitas', 'favoritIds', 'keyword'));
    // }

    // public function search(Request $request)
    // {
    //     $kategori  = Kategori::all();
    //     $fasilitas = Fasilitas::all();

    //     $wisatawan         = Wisatawan::where('user_id', Auth::id())->first();
    //     $favoritIds        = [];
    //     $preferensiKuliner = [];

    //     if ($wisatawan) {
    //         $favoritIds = KulinerFavorit::where('id_wisatawan', $wisatawan->id_wisatawan)
    //             ->pluck('id_wisata_kuliner')
    //             ->toArray();

    //         $preferensiKuliner = DB::table('preferensi')
    //             ->where('id_wisatawan', $wisatawan->id_wisatawan)
    //             ->pluck('id_kategori')
    //             ->toArray();
    //     }

    //     // keyword
    //     $keyword        = trim($request->keyword ?? '');
    //     $isRekomendasi  = ($keyword === '' || strtolower($keyword) === 'rekomendasi kuliner');
    //     $displayKeyword = $isRekomendasi ? 'Rekomendasi Kuliner' : $keyword;

    //     $query = WisataKuliner::query()->with(['fasilitas', 'kategori']);

    //     if (!$isRekomendasi) {
    //         $query->where(function ($q) use ($keyword) {
    //             $q->where('nama',        'like', "%{$keyword}%")
    //                 ->orWhere('kecamatan', 'like', "%{$keyword}%")
    //                 ->orWhere('kelurahan', 'like', "%{$keyword}%")
    //                 ->orWhere('alamat',    'like', "%{$keyword}%")
    //                 ->orWhere('deskripsi', 'like', "%{$keyword}%");
    //         });
    //     }

    //     // rating
    //     $useRatingFilter = ($request->filled('minrating') && $request->minrating != 0)
    //         || ($request->filled('maxrating') && $request->maxrating != 5);
    //     if ($useRatingFilter) {
    //         $query->whereBetween('penilaian', [$request->minrating, $request->maxrating]);
    //     }

    //     // harga
    //     $useHargaFilter = ($request->filled('minharga') && $request->minharga != 0)
    //         || ($request->filled('maxharga') && $request->maxharga != 1000000);
    //     if ($useHargaFilter) {
    //         $query->where('harga_max', '>=', $request->minharga)
    //             ->where('harga_min', '<=', $request->maxharga);
    //     }

    //     $data = $query->limit(50)->get();

    //     if (!$isRekomendasi && $data->isEmpty()) {
    //         $isRekomendasi  = true;
    //         $displayKeyword = 'Rekomendasi Kuliner';

    //         $query2 = WisataKuliner::query()->with(['fasilitas', 'kategori']);

    //         if ($useRatingFilter) {
    //             $query2->whereBetween('penilaian', [$request->minrating, $request->maxrating]);
    //         }
    //         if ($useHargaFilter) {
    //             $query2->where('harga_max', '>=', $request->minharga)
    //                 ->where('harga_min', '<=', $request->maxharga);
    //         }

    //         $data = $query2->limit(50)->get();
    //     }

    //     $lat = $request->lat;
    //     $lng = $request->lng;

    //     if ($lat && $lng && $data->isNotEmpty()) {
    //         foreach ($data as $item) {
    //             $dlat = deg2rad($item->latitude - $lat);
    //             $dlng = deg2rad($item->longitude - $lng);
    //             $a    = sin($dlat / 2) ** 2
    //                 + cos(deg2rad($lat)) * cos(deg2rad($item->latitude)) * sin($dlng / 2) ** 2;
    //             $item->distance_km = 6371 * 2 * atan2(sqrt($a), sqrt(1 - $a));
    //         }

    //         if ($request->filled('jarak') && $request->jarak > 0) {
    //             $data = $data->filter(fn($item) => $item->distance_km <= $request->jarak)->values();
    //         }

    //         // Google Distance Matrix (lebih akurat)
    //         try {
    //             $origin       = "{$lat},{$lng}";
    //             $destinations = $data->map(fn($i) => "{$i->latitude},{$i->longitude}")->join('|');
    //             $apiKey       = 'AIzaSyD-gBdR_gqZTd8B6jz3mVJWI-pqC_jPlAI';
    //             $url          = "https://maps.googleapis.com/maps/api/distancematrix/json"
    //                 . "?origins={$origin}&destinations={$destinations}&key={$apiKey}";

    //             $response = json_decode(file_get_contents($url), true);

    //             foreach ($data as $index => $item) {
    //                 $meter = $response['rows'][0]['elements'][$index]['distance']['value'] ?? null;
    //                 if ($meter !== null) {
    //                     $item->distance_km = $meter / 1000;
    //                 }
    //             }
    //         } catch (\Exception $e) {
    //         }
    //     }

    //     $kategoriFilter  = $request->kategori  ?? [];
    //     $fasilitasFilter = $request->fasilitas ?? [];
    //     $cariKategori    = !empty($kategoriFilter) ? $kategoriFilter : $preferensiKuliner;

    //     $kulinerIds = $data->pluck('id_wisata_kuliner')->toArray();

    //     $kategoriMatchMap = [];
    //     if (!empty($cariKategori)) {
    //         $kategoriMatchMap = DB::table('kategori_wisata_kuliner')
    //             ->whereIn('id_wisata_kuliner', $kulinerIds)
    //             ->whereIn('id_kategori', $cariKategori)
    //             ->select('id_wisata_kuliner', DB::raw('COUNT(*) as match_count'))
    //             ->groupBy('id_wisata_kuliner')
    //             ->pluck('match_count', 'id_wisata_kuliner')
    //             ->toArray();
    //     }

    //     $fasilitasMatchMap = [];
    //     if (!empty($fasilitasFilter)) {
    //         $fasilitasMatchMap = DB::table('fasilitas_wisata_kuliner')
    //             ->whereIn('id_wisata_kuliner', $kulinerIds)
    //             ->whereIn('id_fasilitas', $fasilitasFilter)
    //             ->select('id_wisata_kuliner', DB::raw('COUNT(*) as match_count'))
    //             ->groupBy('id_wisata_kuliner')
    //             ->pluck('match_count', 'id_wisata_kuliner')
    //             ->toArray();
    //     }

    //     foreach ($data as $item) {
    //         $id = $item->id_wisata_kuliner;

    //         $distanceScore  = 1 / (($item->distance_km ?? 999) + 1);
    //         $ratingScore    = ($item->penilaian ?? 0) / 5;
    //         $hargaScore     = 1 / (($item->harga_min ?? 1) + 1);
    //         $kategoriMatch  = $kategoriMatchMap[$id]  ?? 0;
    //         $fasilitasMatch = $fasilitasMatchMap[$id] ?? 0;

    //         $item->score =
    //             ($distanceScore  * 40) +
    //             ($ratingScore    * 25) +
    //             ($hargaScore     * 20) +
    //             ($kategoriMatch  * 10) +
    //             ($fasilitasMatch *  5);
    //     }

    //     $data = $data->sortByDesc('score')->values();

    //     return view('wisatawan.pencarian.hasil-pencarian', compact(
    //         'data',
    //         'kategori',
    //         'fasilitas',
    //         'favoritIds',
    //         'displayKeyword'
    //     ));
    // }
}
