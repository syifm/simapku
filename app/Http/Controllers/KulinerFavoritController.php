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
    // public function cek(Request $request)
    // {
    //     if (!Auth::check()) {
    //         return response()->json(['status' => 'not_login']);
    //     }

    //     $ada = KulinerFavorit::where('id_wisatawan', Auth::id())
    //         ->where('id_wisata_kuliner', $request->id_wisata_kuliner)
    //         ->exists();

    //     return response()->json([
    //         'status' => 'ok',
    //         'favorit' => $ada
    //     ]);
    // }

    public function tampilkanHalamanFavorit()
    {
        $wisatawan = Wisatawan::where('user_id', Auth::id())->first();

        $kulinerFavorit = KulinerFavorit::with('wisatakuliner')
            ->where('id_wisatawan', $wisatawan->id_wisatawan)
            ->latest('waktu_dibuat')
            ->get();
        return view('wisatawan.favorit.halaman-favorit', compact('kulinerFavorit'));
    }

    public function simpan(int $id)
    {
        $waktu_dibuat = Carbon::now('Asia/Jakarta');
        $wisatawan = Wisatawan::where('user_id', Auth::id())->first();
        KulinerFavorit::create([
            'id_wisatawan' => $wisatawan->id_wisatawan,
            'id_wisata_kuliner' => $id,
            'waktu_dibuat' => $waktu_dibuat,
        ]);

        return response()->json([
            'status' => 'success',
            'title' => 'Berhasil',
            'text' => 'Wisata kuliner berhasil ditambahkan ke kuliner favorit',
        ]);
    }

    // public function hapusFavoritDariList(Request $request)
    // {
    //     $wisatawan = Wisatawan::where('user_id', Auth::id())->first();

    //     KulinerFavorit::where('id_wisatawan', $wisatawan->id_wisatawan)
    //         ->where('id_wisata_kuliner', $request->id_wisata_kuliner)
    //         ->delete();

    //     return back()->with('success', 'Berhasil dihapus dari Kuliner Favorit');
    // }

    // public function hapus($id)
    // {
    //     $wisatawan = Wisatawan::where('user_id', Auth::id())->first();

    //     KulinerFavorit::where('id_wisatawan', $wisatawan->id_wisatawan)
    //         ->where('id_wisata_kuliner', $id)
    //         ->delete();

    //     return response()->json(['status' => 'Dihapus']);
    // }

    public function hapus(int $id)
    {
        $wisatawan = Wisatawan::where('user_id', Auth::id())->first();

        KulinerFavorit::where('id_wisatawan', $wisatawan->id_wisatawan)
            ->where('id_wisata_kuliner', $id)
            ->delete();

        return response()->json([
            'status' => 'success',
            'title' => 'Berhasil',
            'text' => 'Wisata kuliner berhasil dihapus dari kuliner favorit',
        ]);
    }

    public function tampilkanDetailWKuliner(int $id)
    {
        $wisataKuliner = WisataKuliner::with(['fasilitas', 'kategori'])->findOrFail($id);

        return response()->json($wisataKuliner);
    }
}
