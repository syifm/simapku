<?php

namespace App\Http\Controllers;

use App\Models\WisataKuliner;
use App\Models\Fasilitas;
use App\Models\FasilitasWisataKuliner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


class FasilitasController extends Controller
{
    // Kelola Fasilitas
    // Halaman Awal (Kelola Fasilitas)
    public function kelolaFasilitas()
    {
        $fasilitas = Fasilitas::withCount('wisataKuliner')
            ->orderBy('nama', 'asc')
            ->paginate(10)
            ->withQueryString();

        $fasilitas->getCollection()->transform(function ($item, $key) use ($fasilitas) {
            $item->nomor = ($fasilitas->currentPage() - 1) * $fasilitas->perPage() + $key + 1;
            return $item;
        });

        $wisataKuliner = WisataKuliner::with('fasilitas:id_fasilitas,nama')->get();

        return view('admin.kelola-fasilitas.awal-fasilitas', compact(
            'fasilitas',
            'wisataKuliner'
        ));
    }

    // Tambah Fasilitas (Kelola Fasilitas)
    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
        ], [
            'nama.required' => 'Nama fasilitas harus diisi'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first('nama')
            ]);
        }

        $nama = trim($request->nama);

        $exists = Fasilitas::whereRaw('LOWER(nama) = ?', [strtolower($nama)])->exists();

        if ($exists) {
            return response()->json([
                'error' => 'Nama fasilitas sudah tersedia'
            ]);
        }

        Fasilitas::create([
            'nama' => $nama
        ]);

        return response()->json([
            'success' => 'Fasilitas berhasil ditambahkan'
        ]);
    }

    // Update Fasilitas (Kelola Fasilitas)
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
        ], [
            'nama.required' => 'Nama fasilitas harus diisi'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first('nama')
            ]);
        }

        $fasilitas = Fasilitas::findOrFail($id);
        $nama = trim($request->nama);
        if (!$nama) {
            return response()->json([
                'error' => 'Nama fasilitas harus diisi'
            ]);
        }

        $fasilitas->nama = $nama;
        if (!$fasilitas->isDirty()) {
            return response()->json([
                'info' => 'Tidak ada perubahan'
            ]);
        }

        $exists = Fasilitas::whereRaw('LOWER(nama) = ?', [strtolower($nama)])
            ->where('id_fasilitas', '!=', $id)
            ->exists();
        if ($exists) {
            return response()->json([
                'error' => 'Nama fasilitas sudah tersedia'
            ]);
        }

        $fasilitas->update([
            'nama' => $nama
        ]);

        return response()->json([
            'success' => 'Fasilitas berhasil diperbarui'
        ]);
    }

    public function hapus(Request $request, $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        $reassign = $request->reassign ?? [];
        $hapusIds = $request->hapus_ids ?? [];

        $kulinerList = DB::table('fasilitas_wisata_kuliner')
            ->where('id_fasilitas', $id)
            ->pluck('id_wisata_kuliner');

        foreach ($kulinerList as $kulinerId) {
            $jumlahFasilitas = DB::table('fasilitas_wisata_kuliner')
                ->where('id_wisata_kuliner', $kulinerId)
                ->count();

            // if ($jumlahFasilitas == 1) {
            //     if (!isset($reassign[$kulinerId]) || !$reassign[$kulinerId]) {
            //         return response()->json([
            //             'error' => 'Semua wisata kuliner harus dihapus atau dipindahkan ke fasilitas lain terlebih dahulu'
            //         ]);
            //     }
            // }
        }

        foreach ($reassign as $kulinerId => $fasilitasBaru) {
            if (in_array($kulinerId, $hapusIds)) continue;

            if ($fasilitasBaru) {
                DB::table('fasilitas_wisata_kuliner')
                    ->where('id_wisata_kuliner', $kulinerId)
                    ->where('id_fasilitas', $id)
                    ->where('id_fasilitas', '!=', $fasilitasBaru)
                    ->update([
                        'id_fasilitas' => $fasilitasBaru
                    ]);
            }
        }

        DB::table('fasilitas_wisata_kuliner')
            ->where('id_fasilitas', $id)
            ->whereNotIn('id_wisata_kuliner', array_keys($reassign))
            ->delete();

        if (!empty($hapusIds)) {
            DB::table('fasilitas_wisata_kuliner')
                ->where('id_fasilitas', $id)
                ->whereIn('id_wisata_kuliner', $hapusIds)
                ->delete();
        }

        $fasilitas->delete();

        return back()->with('success', 'Fasilitas berhasil dihapus');
    }
}
