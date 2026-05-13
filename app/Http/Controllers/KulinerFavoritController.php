<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KulinerFavorit;
use App\Models\Wisatawan;
use App\Models\WisataKuliner;
use App\Models\Preferensi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KulinerFavoritController extends Controller
{
    // public function simpan(Request $request)
    // {
    //     if (!Auth::check()) {
    //         return response()->json([
    //             'error' => 'Harus login'
    //         ], 401);
    //     }
    //     $id_wisatawan = Wisatawan::where('user_id', Auth::id())->value('id_wisatawan');

    //     if (!$id_wisatawan) {
    //         return response()->json([
    //             'error' => 'Data wisatawan tidak ditemukan'
    //         ], 404);
    //     }
    //     $waktu_dibuat = Carbon::now('Asia/Jakarta');

    //     KulinerFavorit::create([
    //         'id_wisatawan' => $id_wisatawan,
    //         'id_wisata_kuliner' => $request->id_wisata_kuliner,
    //         'waktu_dibuat' => $waktu_dibuat,
    //     ]);

    //     return response()->json([
    //         'status' => 'Ditambahkan'
    //     ]);
    // }
    // public function simpan(Request $request)
    // {
    //     if (!Auth::check()) {
    //         return response()->json([
    //             'error' => 'Harus login'
    //         ], 401);
    //     }

    //     $wisatawan = Wisatawan::where('user_id', Auth::id())->first();

    //     if (!$wisatawan) {
    //         return response()->json([
    //             'error' => 'Data wisatawan tidak ditemukan'
    //         ], 404);
    //     }

    //     $waktu_dibuat = Carbon::now('Asia/Jakarta');

    //     KulinerFavorit::create([
    //         'id_wisatawan' => $wisatawan->id_wisatawan,
    //         'id_wisata_kuliner' => $request->id_wisata_kuliner,
    //         'waktu_dibuat' => $waktu_dibuat
    //     ]);

    //     return response()->json([
    //         'status' => 'berhasil simpan'
    //     ]);
    // }
    // public function simpan(Request $request)
    // {
    //     if (!Auth::check()) {
    //         return response()->json(['error' => 'Harus login'], 401);
    //     }

    //     $wisatawan = Wisatawan::where('user_id', Auth::id())->first();

    //     if (!$wisatawan) {
    //         return response()->json(['error' => 'Data wisatawan tidak ditemukan'], 404);
    //     }

    //     KulinerFavorit::updateOrCreate(
    //         [
    //             'id_wisatawan' => $wisatawan->id_wisatawan,
    //             'id_wisata_kuliner' => $request->id_wisata_kuliner,
    //         ],
    //         [
    //             'komentar' => $request->komentar,
    //             'waktu_dibuat' => Carbon::now('Asia/Jakarta'),
    //         ]
    //     );

    //     return response()->json(['status' => 'berhasil simpan']);
    // }

    // public function hapus($id)
    // {
    //     $id_wisatawan = Wisatawan::where('user_id', Auth::id())->value('id_wisatawan');

    //     KulinerFavorit::where('id_wisatawan', $id_wisatawan)
    //         ->where('id_wisata_kuliner', $id)
    //         ->delete();

    //     return response()->json([
    //         'status' => 'Dihapus'
    //     ]);
    // }

    public function cek(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['status' => 'not_login']);
        }

        $ada = KulinerFavorit::where('id_wisatawan', Auth::id())
            ->where('id_wisata_kuliner', $request->id_wisata_kuliner)
            ->exists();

        return response()->json([
            'status' => 'ok',
            'favorit' => $ada
        ]);
    }

    // public function simpan(Request $request)
    // {
    //     if (!Auth::check()) {
    //         return response()->json(['status' => 'not_login']);
    //     }

    //     KulinerFavorit::create([
    //         'id_wisatawan' => Auth::id(),
    //         'id_wisata_kuliner' => $request->id_wisata_kuliner,
    //         'komentar' => $request->komentar,
    //         'waktu_dibuat' => now()
    //     ]);

    //     return response()->json(['status' => 'added']);
    // }
    public function simpan(Request $request)
    {
        $waktu_dibuat = Carbon::now('Asia/Jakarta');
        $wisatawan = Wisatawan::where('user_id', Auth::id())->first();
        KulinerFavorit::create([
            'id_wisatawan' => $wisatawan->id_wisatawan,
            'id_wisata_kuliner' => $request->id_wisata_kuliner_favorit,
            'komentar' => $request->komentar ?? null,
            'waktu_dibuat' => $waktu_dibuat,
        ]);

        $kuliner = WisataKuliner::with('kategori')
            ->find($request->id_wisata_kuliner_favorit);

        foreach ($kuliner->kategori as $k) {
            $preferensi = Preferensi::where('id_wisatawan', $wisatawan->id_wisatawan)
                ->where('id_kategori', $k->id_kategori)
                ->first();

            if ($preferensi) {
                $preferensi->increment('jumlah');
            } else {
                Preferensi::create([
                    'id_wisatawan' => $wisatawan->id_wisatawan,
                    'id_kategori' => $k->id_kategori,
                    'jumlah' => ($k->jumlah) + 1,
                ]);
            }
        }

        return response()->json([
            'status' => 'Disimpan'
        ]);
    }

    // public function hapus(Request $request)
    // {
    //     if (!Auth::check()) {
    //         return response()->json(['status' => 'not_login']);
    //     }

    //     KulinerFavorit::where('id_wisatawan', Auth::id())
    //         ->where('id_wisata_kuliner', $request->id_wisata_kuliner)
    //         ->delete();

    //     return response()->json(['status' => 'removed']);
    // }
    public function hapus($id)
    {
        $wisatawan = Wisatawan::where('user_id', Auth::id())->first();

        KulinerFavorit::where('id_wisatawan', $wisatawan->id_wisatawan)
            ->where('id_wisata_kuliner', $id)
            ->delete();

        $kuliner = WisataKuliner::with('kategori')
            ->find($id);

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

        return response()->json(['status' => 'Dihapus']);
    }
}
