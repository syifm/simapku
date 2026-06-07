<?php

namespace App\Http\Controllers;

use App\Models\WisataKuliner;
use App\Models\Fasilitas;
use App\Models\FasilitasWisataKuliner;
use App\Models\PengajuanWisataKuliner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


class FasilitasController extends Controller
{
    // public function kelolaFasilitas()
    // {
    //     $fasilitas = Fasilitas::with([
    //         'wisataKuliner',
    //         'pengajuanwisataKuliner'
    //     ])
    //         ->withCount('wisataKuliner', 'pengajuanwisataKuliner')
    //         ->orderBy('nama', 'asc')
    //         ->paginate(10)
    //         ->withQueryString();

    //     $fasilitas->getCollection()->transform(function ($item, $key) use ($fasilitas) {
    //         $item->nomor = ($fasilitas->currentPage() - 1) * $fasilitas->perPage() + $key + 1;

    //         $item->total_wisata =
    //             $item->wisata_kuliner_count +
    //             $item->pengajuanwisata_kuliner_count;
    //         return $item;
    //     });

    //     $wisataKuliner = WisataKuliner::with('fasilitas:id_fasilitas,nama')
    //         ->get()
    //         ->map(function ($item) {
    //             $item->status = 'Aktif';
    //             $item->jenis = 'Wisata Kuliner';
    //             return $item;
    //         });

    //     $pengajuanWisataKuliner = PengajuanWisataKuliner::with('fasilitas:id_fasilitas,nama')
    //         ->get()
    //         ->map(function ($item) {
    //             $item->jenis = 'Pengajuan';
    //             return $item;
    //         });

    //     $allKuliner = $wisataKuliner->concat($pengajuanWisataKuliner);

    //     return view('admin.kelola-wisata-kuliner.halaman-fasilitas', compact(
    //         'fasilitas',
    //         'allKuliner'
    //     ));
    // }
    public function detail(int $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        $wkFasilitas = WisataKuliner::with('fasilitas:id_fasilitas,nama')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id_wisata_kuliner,
                    'nama'  => $item->nama,
                    'status'  => $item->status_operasional,
                    'fasilitas'  => $item->fasilitas
                ];
            });

        $pengajuanWKFasilitas = PengajuanWisataKuliner::with('fasilitas:id_fasilitas,nama')
            ->get();

        $pengajuanFasilitas = $pengajuanWKFasilitas
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
                    'fasilitas'  => $item->fasilitas
                ];
            });

        // $pengajuanFasilitas = $pengajuanWKFasilitas
        //     ->whereIn('status', ['Belum Diverifikasi', 'Ditolak'])
        //     ->sortByDesc('waktu_dibuat')
        //     ->unique(function ($item) {

        //         $fasilitas = $item->fasilitas
        //             ->pluck('id_fasilitas')
        //             ->sort()
        //             ->implode('-');

        //         return $item->id_wisata_kuliner
        //             . '-' . $item->status
        //             . '-' . $fasilitas;
        //     })
        //     ->map(function ($item) {
        //         return [
        //             'id' => $item->id_wisata_kuliner,
        //             'nama' => $item->nama,
        //             'status' => $item->status,
        //             'fasilitas' => $item->fasilitas,
        //         ];
        //     });

        $pengajuanFDisetujui = $pengajuanWKFasilitas
            ->where('status', 'Disetujui')
            // ->sortByDesc('waktu_dibuat')
            // ->unique('id_wisata_kuliner')
            ->filter(function ($pengajuan) use ($wkFasilitas) {

                $wk = $wkFasilitas->firstWhere('id', $pengajuan->id_wisata_kuliner);
                if (!$wk) {
                    return true;
                }

                $aktif = collect($wk['fasilitas'])->pluck('id_fasilitas')->sort()->values();
                $disetujui = $pengajuan->fasilitas->pluck('id_fasilitas')->sort()->values();
                return $aktif->toArray() !== $disetujui->toArray();
            })
            ->map(function ($item) {
                return [
                    'id'  => $item->id_wisata_kuliner,
                    'nama'  => $item->nama,
                    'status'  => $item->status,
                    'fasilitas'  => $item->fasilitas
                ];
            });

        $allKulinerFasilitas = $wkFasilitas
            ->concat($pengajuanFasilitas)
            ->concat($pengajuanFDisetujui);

        $urutanStatus = [
            'Aktif' => 1,
            'Belum Diverifikasi' => 2,
            'Disetujui' => 3,
            'Ditolak' => 4,
        ];

        $detailFasilitas = $allKulinerFasilitas
            ->filter(function ($item) use ($id) {
                return collect($item['fasilitas'])
                    ->contains('id_fasilitas', $id);
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
            'fasilitas' => $fasilitas->nama,
            'detail' => $detailFasilitas,
        ]);
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100'
        ], [
            'nama.required' => 'Fasilitas harus diisi'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first()
            ]);
        }

        $nama = trim($request->nama);

        $exists = Fasilitas::whereRaw('LOWER(nama) = ?', [strtolower($nama)])
            ->exists();

        if ($exists) {
            return response()->json([
                'error' => 'Fasilitas Sudah Tersedia'
            ]);
        }

        Fasilitas::create([
            'nama' => $nama,
            'status' => 'Aktif',
        ]);

        return response()->json([
            'success' => 'Fasilitas Berhasil Disimpan'
        ]);
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100'
        ], [
            'nama.required' => 'Fasilitas harus diisi'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first()
            ]);
        }

        $fasilitas = Fasilitas::findOrFail($id);

        $nama = trim($request->nama);

        $exists = Fasilitas::whereRaw('LOWER(nama) = ?', [strtolower($nama)])
            ->where('id_fasilitas', '!=', $id)
            ->exists();

        if ($exists) {
            return response()->json([
                'error' => 'Fasilitas Sudah Tersedia'
            ]);
        }

        $fasilitas->nama = $nama;

        if (!$fasilitas->isDirty()) {
            return response()->json([
                'info' => 'Tidak terdapat perubahan'
            ]);
        }

        $fasilitas->save();

        return response()->json([
            'success' => 'Fasilitas Berhasil Disimpan'
        ]);
    }

    // public function hapus(int $id)
    // {
    //     $fasilitas = Fasilitas::withCount(['wisataKuliner', 'pengajuanwisataKuliner'])
    //         ->findOrFail($id);

    //     $total = $fasilitas->wisata_kuliner_count + $fasilitas->pengajuanwisata_kuliner_count;

    //     if ($total > 0) {
    //         return response()->json([
    //             'status' => 'error',
    //             'title' => 'Tidak Dapat Dihapus',
    //             'text' => 'Fasilitas masih dimiliki oleh wisata kuliner',
    //         ]);
    //     }

    //     $fasilitas->delete();

    //     return response()->json([
    //         'status' => 'success',
    //         'title' => 'Berhasil',
    //         'text' => 'Fasilitas berhasil dihapus'
    //     ]);
    // }
    public function hapus(Request $request, int $id)
    {
        // $fasilitas = Fasilitas::findOrFail($id);

        // if ($fasilitas->wisataKuliner()->exists()) {
        //     return response()->json([
        //         'action' => 'tdkblhhapus',
        //         'title' => 'Tidak Dapat Dihapus',
        //         'text' => 'Fasilitas masih dimiliki oleh wisata kuliner',
        //     ]);
        // }

        $fasilitas = Fasilitas::with([
            'wisataKuliner.fasilitas',
            'pengajuanwisataKuliner.fasilitas'
        ])->findOrFail($id);

        if ($fasilitas->wisataKuliner->isNotEmpty()) {
            return response()->json([
                'action' => 'tdkblhhapus',
                'title' => 'Tidak Dapat Dihapus',
                'text' => 'Fasilitas masih dimiliki oleh wisata kuliner',
            ]);
        }

        $nonaktif = false;

        $pengajuanFasilitas = $fasilitas->pengajuanwisataKuliner
            ->whereIn('status', ['Belum Diverifikasi', 'Ditolak']);

        $pengajuanDisetujui = $fasilitas->pengajuanwisataKuliner
            ->where('status', 'Disetujui');
        // ->sortByDesc('waktu_dibuat')
        // ->unique('id_wisata_kuliner');

        $semuaPengajuan = $pengajuanFasilitas->concat($pengajuanDisetujui);

        foreach ($semuaPengajuan as $pengajuan) {

            // if ($pengajuan->status === 'Belum Diverifikasi') {
            //     return response()->json([
            //         'action' => 'tdkblhhapus',
            //         'title' => 'Tidak Dapat Dihapus',
            //         'text' => 'Fasilitas masih digunakan oleh wisata kuliner',
            //     ]);
            // }

            if ($pengajuan->status === 'Ditolak' || $pengajuan->status === 'Belum Diverifikasi') {
                $nonaktif = true;
            }

            if ($pengajuan->status === 'Disetujui') {
                // $wk = WisataKuliner::with('fasilitas')
                //     ->find($pengajuan->id_wisata_kuliner);
                $wk = $fasilitas->wisataKuliner
                    ->firstWhere('id_wisata_kuliner', $pengajuan->id_wisata_kuliner);

                if (!$wk) {
                    $nonaktif = true;
                } else {
                    $aktif = $wk->fasilitas->pluck('id_fasilitas')->sort()->values();
                    $disetujui = $pengajuan->fasilitas->pluck('id_fasilitas')->sort()->values();

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
                    'text' => 'Fasilitas ini tidak dapat dihapus, hanya dapat dinonaktifkan karena masih dimiliki oleh wisata kuliner sebagai riwayat pengajuan wisata kuliner'
                ]);
            }

            return response()->json([
                'action' => 'hapus',
            ]);
        }

        if ($nonaktif) {
            $fasilitas->status = 'Tidak Aktif';
            $fasilitas->save();

            return response()->json([
                'status' => 'success',
                'title' => 'Berhasil',
                'text' => 'Status berhasil diperbarui'
            ]);
        }

        $fasilitas->delete();

        return response()->json([
            'status' => 'success',
            'title' => 'Berhasil',
            'text' => 'Fasilitas berhasil dihapus'
        ]);
    }

    public function aktifkan(int $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        $fasilitas->status = 'Aktif';
        $fasilitas->save();

        return response()->json([
            'status' => 'success',
            'title' => 'Berhasil',
            'text' => 'Fasilitas berhasil diaktifkan dan akan tampil sebagai pilihan fasilitas'
        ]);
    }
}
