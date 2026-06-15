<?php

namespace App\Http\Controllers;

use App\Models\WisataKuliner;
use App\Models\Kategori;
use App\Models\KategoriWisataKuliner;
use App\Models\PengajuanWisataKuliner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


class KategoriController extends Controller
{
    // public function tampilkanKelolaKategori()
    // {
    //     // $kategori = Kategori::withCount('wisataKuliner', 'pengajuanwisataKuliner')
    //     //     ->orderBy('nama', 'asc')
    //     //     ->paginate(10)
    //     //     ->withQueryString();
    //     $kategori = Kategori::with([
    //         'wisataKuliner',
    //         'pengajuanwisataKuliner'
    //     ])
    //         ->withCount('wisataKuliner', 'pengajuanwisataKuliner')
    //         ->orderBy('nama', 'asc')
    //         ->paginate(10)
    //         ->withQueryString();

    //     $kategori->getCollection()->transform(function ($item, $key) use ($kategori) {
    //         $item->nomor = ($kategori->currentPage() - 1) * $kategori->perPage() + $key + 1;

    //         $item->total_wisata =
    //             $item->wisata_kuliner_count +
    //             $item->pengajuanwisata_kuliner_count;
    //         return $item;
    //     });

    //     $wisataKuliner = WisataKuliner::with('kategori:id_kategori,nama')
    //         ->get()
    //         ->map(function ($item) {
    //             $item->jenis = 'Wisata Kuliner';
    //             return $item;
    //         });

    //     $pengajuanWisataKuliner = PengajuanWisataKuliner::with('kategori:id_kategori,nama')
    //         ->get()
    //         ->map(function ($item) {
    //             $item->jenis = 'Pengajuan';
    //             return $item;
    //         });

    //     $allKuliner = $wisataKuliner->concat($pengajuanWisataKuliner);

    //     return view('admin.kelola-wisata-kuliner.halaman-kategori', compact(
    //         'kategori',
    //         'allKuliner'
    //     ));
    // }
    // public function detailKategori(int $id)
    // {
    //     // $kategori = Kategori::findOrFail($id);

    //     // $data = $this->getAllKulinerKategori()
    //     //     ->filter(function ($wk) use ($id) {
    //     //         return collect($wk['kategori'])
    //     //             ->contains('id_kategori', $id);
    //     //     })
    //     //     ->values();
    //     // $data = collect($allKulinerKategori)
    //     //     ->filter(function ($wk) use ($id) {
    //     //         return collect($wk['kategori'])
    //     //             ->contains('id_kategori', $id);
    //     //     })
    //     //     ->values();

    //     // $kategori = Kategori::with([
    //     //     'wisataKuliner.kategori',
    //     //     'pengajuanwisataKuliner.kategori'
    //     // ])
    //     //     ->withCount('wisataKuliner', 'pengajuanwisataKuliner')
    //     //     ->orderBy('jenis_kategori', 'asc')
    //     //     ->orderBy('nama', 'asc')
    //     //     ->paginate(10, ['*'], 'kategori')
    //     //     ->withQueryString();
    //     $kategori = Kategori::findOrFail($id);

    //     $kategori->getCollection()->transform(function ($item, $key) use ($kategori) {
    //         $item->nomor = ($kategori->currentPage() -  1) * $kategori->perPage() + $key + 1;
    //         $total = $item->wisataKuliner->count();

    //         $pengajuanKategori = $item->pengajuanwisataKuliner
    //             ->whereIn('status', ['Belum Diverifikasi', 'Ditolak']);

    //         $pengajuanKDisetujui = $item->pengajuanwisataKuliner
    //             ->where('status', 'Disetujui')
    //             ->sortByDesc('waktu_dibuat')
    //             ->unique('id_wisata_kuliner');

    //         $semuaPengajuanK = $pengajuanKategori->concat($pengajuanKDisetujui);

    //         foreach ($semuaPengajuanK  as $pengajuanK) {
    //             if ($pengajuanK->status === 'Belum Diverifikasi'  || $pengajuanK->status === 'Ditolak') {
    //                 $total++;
    //             }

    //             if ($pengajuanK->status === 'Disetujui') {
    //                 $wkK = $item->wisataKuliner
    //                     ->firstWhere('id_wisata_kuliner', $pengajuanK->id_wisata_kuliner);
    //                 if (!$wkK) {
    //                     $total++;
    //                 } else {
    //                     $aktifK = $wkK->kategori->pluck('id_kategori')->sort()->values();
    //                     $disetujuiK = $pengajuanK->kategori->pluck('id_kategori')->sort()->values();
    //                     if ($aktifK->toArray() !== $disetujuiK->toArray()) {

    //                         $total++;
    //                     }
    //                 }
    //             }
    //         }

    //         $item->total_wisata = $total;
    //         return $item;
    //     });

    //     $wkKategori = WisataKuliner::with('kategori:id_kategori,nama')
    //         ->get()
    //         ->map(function ($item) {
    //             return [
    //                 'id'  => $item->id_wisata_kuliner,
    //                 'nama'  => $item->nama,
    //                 'status'  => $item->status_operasional,
    //                 'kategori'  => $item->kategori
    //             ];
    //         });

    //     $pengajuanWKKategori = PengajuanWisataKuliner::with('kategori:id_kategori,nama')
    //         ->get();

    //     $pengajuanKategori = $pengajuanWKKategori
    //         ->whereIn('status', ['Belum Diverifikasi', 'Ditolak'])
    //         ->map(function ($item) {
    //             return [
    //                 'id'  => $item->id_wisata_kuliner,
    //                 'nama'  => $item->nama,
    //                 'status'  => $item->status,
    //                 'kategori'  => $item->kategori
    //             ];
    //         });

    //     $pengajuanKDisetujui = $pengajuanWKKategori
    //         ->where('status', 'Disetujui')
    //         ->sortByDesc('waktu_dibuat')
    //         ->unique('id_wisata_kuliner')
    //         ->filter(function ($pengajuanK) use ($wkKategori) {
    //             $wkK = $wkKategori->firstWhere('id', $pengajuanK->id_wisata_kuliner);
    //             if (!$wkK) {
    //                 return true;
    //             }

    //             $aktifK = collect($wkK['kategori'])->pluck('id_kategori')->sort()->values();
    //             $disetujuiK = $pengajuanK->kategori->pluck('id_kategori')->sort()->values();

    //             return $aktifK->toArray() !== $disetujuiK->toArray();
    //         })
    //         ->map(function ($item) {
    //             return [
    //                 'id'  => $item->id_wisata_kuliner,
    //                 'nama'  => $item->nama,
    //                 'status'  => $item->status,
    //                 'kategori'  => $item->kategori
    //             ];
    //         });

    //     $allKulinerKategori = $wkKategori
    //         ->concat($pengajuanKategori)
    //         ->concat($pengajuanKDisetujui)
    //         ->sortby(function ($item) {
    //             return match ($item['status']) {
    //                 'Aktif'  => 1,
    //                 'Tutup Sementara'  => 2,
    //                 'Tutup Permanen'  => 3,
    //                 'Belum Diverifikasi'  => 4,
    //                 'Disetujui'  => 5,
    //                 'Ditolak'  => 6,
    //             };
    //         })
    //         ->values();


    //     return response()->json([
    //         'kategori' => $kategori->nama,
    //         // 'wisata_kuliner' => $data
    //     ]);
    // }

    public function detail(int $id)
    {
        $kategori = Kategori::findOrFail($id);

        $wkKategori = WisataKuliner::with('kategori:id_kategori,nama')
            ->get()
            ->map(function ($item) {
                return [
                    'id'  => $item->id_wisata_kuliner,
                    'nama'  => $item->nama,
                    'status'  => $item->status_operasional,
                    'kategori'  => $item->kategori
                ];
            });

        $pengajuanWKKategori = PengajuanWisataKuliner::with('kategori:id_kategori,nama')
            ->get();

        $pengajuanKategori = $pengajuanWKKategori
            ->whereIn('status', ['Belum Diverifikasi', 'Ditolak'])
            // ->sortByDesc('waktu_dibuat')
            // ->unique(function ($item) {
            //     return $item->id_wisata_kuliner . '-' . $item->status;
            // })
            ->map(function ($item) {
                return [
                    'id'  => $item->id_wisata_kuliner,
                    'nama'  => $item->nama,
                    'status'  => $item->status,
                    'kategori'  => $item->kategori
                ];
            });

        $pengajuanKDisetujui = $pengajuanWKKategori
            ->where('status', 'Disetujui')
            // ->sortByDesc('waktu_dibuat')
            // ->unique('id_wisata_kuliner')
            ->filter(function ($pengajuanK) use ($wkKategori) {
                $wkK = $wkKategori->firstWhere('id', $pengajuanK->id_wisata_kuliner);
                if (!$wkK) {
                    return true;
                }

                $aktifK = collect($wkK['kategori'])->pluck('id_kategori')->sort()->values();
                $disetujuiK = $pengajuanK->kategori->pluck('id_kategori')->sort()->values();

                return $aktifK->toArray() !== $disetujuiK->toArray();
            })
            ->map(function ($item) {
                return [
                    'id'  => $item->id_wisata_kuliner,
                    'nama'  => $item->nama,
                    'status'  => $item->status,
                    'kategori'  => $item->kategori
                ];
            });

        $allKulinerKategori = $wkKategori
            ->concat($pengajuanKategori)
            ->concat($pengajuanKDisetujui);

        $urutanStatus = [
            'Aktif' => 1,
            'Belum Diverifikasi' => 2,
            'Disetujui' => 3,
            'Ditolak' => 4,
        ];

        $detailKategori = $allKulinerKategori
            ->filter(function ($item) use ($id) {
                return collect($item['kategori'])
                    ->contains('id_kategori', $id);
            })
            ->unique(function ($item) {
                return $item['id'] . '-' . $item['status'];
            })
            ->sortBy(function ($item) use ($urutanStatus) {
                return [
                    $urutanStatus[$item['status']] ?? 99,
                    strtolower($item['nama']),
                ];
            })
            ->values();

        return response()->json([
            'kategori' => $kategori->nama,
            'detail' => $detailKategori,
        ]);
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'jenis_kategori' => 'required|in:Tempat,Jenis Hidangan,Asal Kuliner',
        ], [
            'nama.required' => 'Nama kategori harus diisi',
            'jenis_kategori.required' => 'Jenis kategori harus dipilih',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first()
            ]);
        }

        $nama = trim($request->nama);
        $jenisKategori = $request->jenis_kategori;

        $exists = Kategori::whereRaw('LOWER(nama) = ?', [strtolower($nama)])
            ->where('jenis_kategori', $jenisKategori)
            ->exists();

        if ($exists) {
            return response()->json([
                'error' => 'Kategori Sudah Tersedia'
            ]);
        }

        Kategori::create([
            'nama' => $nama,
            'jenis_kategori' => $jenisKategori,
            'status' => 'Aktif',
        ]);

        return response()->json([
            'success' => 'Kategori berhasil disimpan'
        ]);
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'jenis_kategori' => 'required|in:Tempat,Jenis Hidangan,Asal Kuliner, Event',
        ], [
            'nama.required' => 'Nama kategori harus diisi',
            'jenis_kategori.required' => 'Jenis kategori harus dipilih',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first()
            ]);
        }

        $kategori = Kategori::findOrFail($id);

        $nama = trim($request->nama);
        $jenisKategori = $request->jenis_kategori;

        $exists = Kategori::whereRaw('LOWER(nama) = ?', [strtolower($nama)])
            ->where('jenis_kategori', $jenisKategori)
            ->where('id_kategori', '!=', $id)
            ->exists();

        if ($exists) {
            return response()->json([
                'error' => 'Kategori Sudah Tersedia'
            ]);
        }

        $kategori->nama = $nama;
        $kategori->jenis_kategori = $jenisKategori;

        if (!$kategori->isDirty()) {
            return response()->json([
                'info' => 'Tidak Terdapat Perubahan'
            ]);
        }

        $kategori->save();

        return response()->json([
            'success' => 'Kategori Berhasil Disimpan'
        ]);
    }

    public function hapus(Request $request, int $id)
    {
        $kategori = Kategori::with([
            'wisataKuliner.kategori',
            'pengajuanwisataKuliner.kategori'
        ])->findOrFail($id);

        if ($kategori->wisataKuliner->isNotEmpty()) {
            return response()->json([
                'action' => 'tdkblhhapus',
                'title' => 'Tidak Dapat Dihapus',
                'text' => 'Kategori masih dimiliki oleh wisata kuliner',
            ]);
        }

        $nonaktif = false;

        $pengajuanKategori = $kategori->pengajuanwisataKuliner
            ->whereIn('status', ['Belum Diverifikasi', 'Ditolak']);

        $pengajuanDisetujui = $kategori->pengajuanwisataKuliner
            ->where('status', 'Disetujui');
        // ->sortByDesc('waktu_dibuat')
        // ->unique('id_wisata_kuliner');

        $semuaPengajuan = $pengajuanKategori->concat($pengajuanDisetujui);

        foreach ($semuaPengajuan as $pengajuan) {

            // if ($pengajuan->status === 'Belum Diverifikasi') {
            //     return response()->json([
            //         'action' => 'tdkblhhapus',
            //         'title' => 'Tidak Dapat Dihapus',
            //         'text' => 'Kategori masih dimiliki oleh wisata kuliner',
            //     ]);
            // }

            if ($pengajuan->status === 'Ditolak' || $pengajuan->status === 'Belum Diverifikasi') {
                $nonaktif = true;
            }

            if ($pengajuan->status === 'Disetujui') {
                // $wk = WisataKuliner::with('kategori')
                //     ->find($pengajuan->id_wisata_kuliner);
                $wk = $kategori->wisataKuliner
                    ->firstWhere('id_wisata_kuliner', $pengajuan->id_wisata_kuliner);

                if (!$wk) {
                    $nonaktif = true;
                } else {
                    $aktif = $wk->kategori->pluck('id_kategori')->sort()->values();
                    $disetujui = $pengajuan->kategori->pluck('id_kategori')->sort()->values();

                    if (!$aktif->equalTo($disetujui)) {
                        $nonaktif = true;
                    }
                }
            }
        }

        if (!$request->hapusataunonaktif) {
            if ($nonaktif) {
                return response()->json([
                    'action' => 'nonaktif',
                    'text' => 'Kategori ini tidak dapat dihapus, hanya akan dinonaktifkan karena masih dimiliki oleh wisata kuliner sebagai riwayat pengajuan wisata kuliner'
                ]);
            }

            return response()->json([
                'action' => 'hapus',
            ]);
        }

        if ($nonaktif) {
            $kategori->status = 'Tidak Aktif';
            $kategori->save();

            return response()->json([
                'status' => 'success',
                'title' => 'Berhasil',
                'text' => 'Status berhasil diperbarui'
            ]);
        }

        $kategori->delete();

        return response()->json([
            'status' => 'success',
            'title' => 'Berhasil',
            'text' => 'Kategori berhasil dihapus'
        ]);
    }

    public function aktifkan(int $id)
    {
        $kategori = Kategori::findOrFail($id);

        $kategori->update([
            'status' => 'Aktif'
        ]);

        return response()->json([
            'status' => 'success',
            'title' => 'Berhasil',
            'text' => 'Kategori berhasil diaktifkan dan akan tampil sebagai pilihan kategori'
        ]);
    }

    // public function hapus(Request $request, int $id)
    // {
    //     $kategori = Kategori::findOrFail($id);

    //     $reassign = $request->reassign ?? [];
    //     $hapusIds = $request->hapus_ids ?? [];

    //     $kulinerList = DB::table('kategori_wisata_kuliner')
    //         ->where('id_kategori', $id)
    //         ->pluck('id_wisata_kuliner');

    //     foreach ($kulinerList as $kulinerId) {
    //         $jumlahKategori = DB::table('kategori_wisata_kuliner')
    //             ->where('id_wisata_kuliner', $kulinerId)
    //             ->count();

    //         if ($jumlahKategori == 1) {
    //             if (!isset($reassign[$kulinerId]) || !$reassign[$kulinerId]) {
    //                 return response()->json([
    //                     'error' => 'Semua wisata kuliner harus dihapus atau dipindahkan ke kategori lain terlebih dahulu'
    //                 ]);
    //             }
    //         }
    //     }

    //     foreach ($reassign as $kulinerId => $kategoriBaru) {
    //         if (in_array($kulinerId, $hapusIds)) continue;

    //         if ($kategoriBaru) {
    //             DB::table('kategori_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $kulinerId)
    //                 ->where('id_kategori', $id)
    //                 ->where('id_kategori', '!=', $kategoriBaru)
    //                 ->update([
    //                     'id_kategori' => $kategoriBaru
    //                 ]);
    //         }
    //     }

    //     DB::table('kategori_wisata_kuliner')
    //         ->where('id_kategori', $id)
    //         ->whereNotIn('id_wisata_kuliner', array_keys($reassign))
    //         ->delete();

    //     if (!empty($hapusIds)) {
    //         DB::table('kategori_wisata_kuliner')
    //             ->where('id_kategori', $id)
    //             ->whereIn('id_wisata_kuliner', $hapusIds)
    //             ->delete();
    //     }

    //     $kategori->delete();

    //     return back()->with('success', 'Kategori berhasil dihapus');
    // }
    // public function hapus(Request $request, int $id)
    // {
    //     $kategori = Kategori::withCount(['wisataKuliner', 'pengajuanwisataKuliner'])
    //         ->findOrFail($id);

    //     $totalwisata =
    //         $kategori->wisata_kuliner_count +
    //         $kategori->pengajuanwisata_kuliner_count;

    //     if ($totalwisata > 0) {
    //         return response()->json([
    //             'error' => 'Kategori tidak dapat dihapus karena masih dimiliki oleh wisata kuliner'
    //         ], 400);
    //     }

    //     $kategori->delete();

    //     return response()->json([
    //         'success' => 'Kategori berhasil dihapus'
    //     ]);
    // }


    // public function hapus(int $id)
    // {
    //     $kategori = Kategori::withCount(['wisataKuliner', 'pengajuanwisataKuliner'])
    //         ->findOrFail($id);

    //     $total = $kategori->wisata_kuliner_count + $kategori->pengajuanwisata_kuliner_count;

    //     if ($total > 0) {
    //         return response()->json([
    //             'status' => 'error',
    //             'title' => 'Tidak Dapat Dihapus',
    //             'text' => 'Kategori masih dimiliki oleh wisata kuliner',
    //         ]);
    //     }

    //     $kategori->delete();

    //     return response()->json([
    //         'status' => 'success',
    //         'title' => 'Berhasil',
    //         'text' => 'Kategori berhasil dihapus'
    //     ]);
    // }
}
