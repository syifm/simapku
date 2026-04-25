<?php

namespace App\Http\Controllers;

use App\Models\WisataKuliner;
use App\Models\Kategori;
use App\Models\KategoriWisataKuliner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


class KategoriController extends Controller
{
    // Kelola Kategori
    // Halaman Awal (Kelola Kategori)
    public function kelolaKategori()
    {
        $kategori = Kategori::withCount('wisataKuliner')
            ->orderBy('nama', 'asc')
            ->paginate(10)
            ->withQueryString();

        $kategori->getCollection()->transform(function ($item, $key) use ($kategori) {
            $item->nomor = ($kategori->currentPage() - 1) * $kategori->perPage() + $key + 1;
            return $item;
        });

        $wisataKuliner = WisataKuliner::with('kategori:id_kategori,nama')->get();

        return view('admin.kelola-kategori.awal-kategori', compact(
            'kategori',
            'wisataKuliner'
        ));
    }

    // Tambah Kategori (Kelola Kategori)
    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
        ], [
            'nama.required' => 'Nama kategori harus diisi'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first('nama')
            ]);
        }

        $nama = trim($request->nama);

        $exists = Kategori::whereRaw('LOWER(nama) = ?', [strtolower($nama)])->exists();

        if ($exists) {
            return response()->json([
                'error' => 'Nama kategori sudah tersedia'
            ]);
        }

        Kategori::create([
            'nama' => $nama
        ]);

        return response()->json([
            'success' => 'Kategori berhasil ditambahkan'
        ]);
    }

    // Update Kategori (Kelola Kategori)
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
        ], [
            'nama.required' => 'Nama kategori harus diisi'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first('nama')
            ]);
        }

        $kategori = Kategori::findOrFail($id);
        $nama = trim($request->nama);
        if (!$nama) {
            return response()->json([
                'error' => 'Nama kategori harus diisi'
            ]);
        }

        $kategori->nama = $nama;
        if (!$kategori->isDirty()) {
            return response()->json([
                'info' => 'Tidak ada perubahan'
            ]);
        }

        $exists = Kategori::whereRaw('LOWER(nama) = ?', [strtolower($nama)])
            ->where('id_kategori', '!=', $id)
            ->exists();
        if ($exists) {
            return response()->json([
                'error' => 'Nama kategori sudah tersedia'
            ]);
        }

        $kategori->update([
            'nama' => $nama
        ]);

        return response()->json([
            'success' => 'Kategori berhasil diperbarui'
        ]);
    }

    public function hapus(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $reassign = $request->reassign ?? [];
        $hapusIds = $request->hapus_ids ?? [];

        $kulinerList = DB::table('kategori_wisata_kuliner')
            ->where('id_kategori', $id)
            ->pluck('id_wisata_kuliner');

        foreach ($kulinerList as $kulinerId) {
            $jumlahKategori = DB::table('kategori_wisata_kuliner')
                ->where('id_wisata_kuliner', $kulinerId)
                ->count();

            if ($jumlahKategori == 1) {
                if (!isset($reassign[$kulinerId]) || !$reassign[$kulinerId]) {
                    return response()->json([
                        'error' => 'Semua wisata kuliner harus dihapus atau dipindahkan ke kategori lain terlebih dahulu'
                    ]);
                }
            }
        }

        foreach ($reassign as $kulinerId => $kategoriBaru) {
            if (in_array($kulinerId, $hapusIds)) continue;

            if ($kategoriBaru) {
                DB::table('kategori_wisata_kuliner')
                    ->where('id_wisata_kuliner', $kulinerId)
                    ->where('id_kategori', $id)
                    ->where('id_kategori', '!=', $kategoriBaru)
                    ->update([
                        'id_kategori' => $kategoriBaru
                    ]);
            }
        }

        DB::table('kategori_wisata_kuliner')
            ->where('id_kategori', $id)
            ->whereNotIn('id_wisata_kuliner', array_keys($reassign))
            ->delete();

        if (!empty($hapusIds)) {
            DB::table('kategori_wisata_kuliner')
                ->where('id_kategori', $id)
                ->whereIn('id_wisata_kuliner', $hapusIds)
                ->delete();
        }

        $kategori->delete();

        return back()->with('success', 'Kategori berhasil dihapus');
    }

}
