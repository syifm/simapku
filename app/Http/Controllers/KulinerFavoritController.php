<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KulinerFavorit;
use App\Models\WisataKuliner;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KulinerFavoritController extends Controller
{
    public function tampilkanHalamanFavorit()
    {
        $kulinerFavorit = KulinerFavorit::with('wisatakuliner')
            ->where('id_user', Auth::id())
            ->latest('waktu_dibuat')
            ->get();
        return view('wisatawan.favorit.halaman-favorit', compact('kulinerFavorit'));
    }

    public function simpan(int $id)
    {
        $waktu_dibuat = Carbon::now('Asia/Jakarta');
        KulinerFavorit::create([
            'id_user' => Auth::id(),
            'id_wisata_kuliner' => $id,
            'waktu_dibuat' => $waktu_dibuat,
        ]);

        return response()->json([
            'status' => 'success',
            'title' => 'Berhasil',
            'text' => 'Wisata kuliner berhasil ditambahkan ke kuliner favorit',
        ]);
    }

    public function hapus(int $id)
    {
        KulinerFavorit::where('id_user', Auth::id())
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
