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

    // public function hapus(Request $request, $id)
    // {
    //     $kategori = Kategori::withCount('wisataKuliner')->findOrFail($id);

    //     if ($kategori->wisata_kuliner_count > 0) {

    //         $request->validate([
    //             'kategori_pengganti' => 'required|exists:kategori,id|different:id',
    //         ], [
    //             'kategori_pengganti.required' => 'Pilih kategori pengganti dulu.',
    //         ]);

    //         WisataKuliner::where('id_kategori', $id)
    //             ->update(['id_kategori' => $request->kategori_pengganti]);
    //     }

    //     $kategori->delete();

    //     return back()->with('success', 'Kategori berhasil dihapus');
    // }
    // public function hapus(Request $request, $id)
    // {
    //     $kategori = Kategori::findOrFail($id);

    //     $reassign = $request->reassign ?? [];
    //     $hapusIds = $request->hapus_ids ?? [];

    //     $kulinerTerpengaruh = WisataKuliner::whereHas('kategori', function ($q) use ($id) {
    //         $q->where('kategori.id_kategori', $id);
    //     })->withCount('kategori')->get();

    //     foreach ($kulinerTerpengaruh as $kuliner) {
    //         if ($kuliner->kategori_count <= 1) {
    //             return back()->with('error', 'Ada wisata kuliner yang hanya punya 1 kategori');
    //         }
    //     }

    //     foreach ($hapusIds as $idKuliner) {
    //         // $kuliner = WisataKuliner::find($idKuliner);

    //         // if ($kuliner && !$kuliner->id_kategori) {
    //         //     return back()->with('error', 'Minimal 1 kategori harus ada');
    //         // }
    //         $kuliner = WisataKuliner::withCount('kategori')->find($idKuliner);

    //         if ($kuliner && $kuliner->kategori_count <= 1) {
    //             return back()->with('error', 'Minimal 1 kategori harus ada');
    //         }
    //     }

    //     foreach ($reassign as $kulinerId => $kategoriBaru) {

    //         if (in_array($kulinerId, $hapusIds)) {
    //             continue; // skip karena mau dihapus
    //         }

    //         if ($kategoriBaru) {
    //             // WisataKuliner::where('id', $kulinerId)
    //             //     ->update(['id_kategori' => $kategoriBaru]);
    //             $kuliner = WisataKuliner::find($kulinerId);

    //             if ($kuliner) {
    //                 // tambahin kategori baru
    //                 $kuliner->kategori()->syncWithoutDetaching([$kategoriBaru]);

    //                 // hapus kategori lama (yang mau dihapus)
    //                 $kuliner->kategori()->detach($id);
    //             }
    //         }
    //     }

    //     DB::table('kategori_wisata_kuliner')
    //         ->where('id_kategori', $id)
    //         ->delete();
    //     // hapus kuliner yg dipilih
    //     // if (!empty($hapusIds)) {
    //     //     WisataKuliner::whereIn('id_wisata_', $hapusIds)->delete();
    //     // }

    //     $kategori->delete();

    //     return back()->with('success', 'Kategori berhasil dihapus & data disesuaikan');
    // }

    // -------------------------------------------------------------------------------------------------------------------
    // public function hapus(Request $request, $id)
    // {
    //     $kategori = Kategori::findOrFail($id);

    //     $reassign = $request->reassign ?? [];
    //     $hapusIds = $request->hapus_ids ?? [];

    //     foreach ($reassign as $kulinerId => $kategoriBaru) {
    //         if (in_array($kulinerId, $hapusIds)) continue;

    //         if ($kategoriBaru) {

    //             $kuliner = WisataKuliner::find($kulinerId);

    //             if ($kuliner) {
    //                 $kuliner->kategori()->syncWithoutDetaching([$kategoriBaru]);

    //                 $kuliner->kategori()->detach($id);
    //             }
    //         }
    //     }

    //     DB::table('kategori_wisata_kuliner')
    //         ->where('id_kategori', $id)
    //         ->whereNotIn('id_wisata_kuliner', array_keys($reassign))
    //         ->delete();

    //     $kategori->delete();

    //     return back()->with('success', 'Kategori berhasil dihapus');
    // }

    // -----------------------------------------------------------------------------------------------------------------------------


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
                    // return back()->with(
                    //     'error',
                    //     "Ada wisata kuliner yang hanya punya 1 kategori. Harus direassign dulu sebelum kategori dihapus."
                    // );
                    return response()->json([
                        'error' => 'Ada wisata kuliner yang hanya punya 1 kategori. Harus direassign dulu sebelum kategori dihapus.'
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

            //     WisataKuliner::whereIn('id', $hapusIds)->delete();
        }

        $kategori->delete();

        return back()->with('success', 'Kategori berhasil dihapus');
    }


    // Hapus Kategori (Kelola Kategori)
    // public function hapus($id)
    // {
    //     try {

    //         $wisataKuliner = WisataKuliner::findOrFail($id);

    //         if ($wisataKuliner->foto && Storage::disk('public')->exists($wisataKuliner->foto)) {
    //             Storage::disk('public')->delete($wisataKuliner->foto);
    //         }

    //         $wisataKuliner->delete();

    //         return redirect()->back()->with('success', 'Wisata Kuliner berhasil dihapus');
    //     } catch (Exception $e) {
    //         Log::error('Error in AdminController@destroy: ' . $e->getMessage());
    //         return back()->with('error', 'Terjadi Kesalahan Saat Menghapus Wisata Kuliner.');
    //     }
    // }
    // public function hapus($id)
    // {
    //     $kategori = Kategori::withCount('wisataKuliner')->findOrFail($id);

    //     if ($kategori->wisata_kuliner_count > 0) {
    //         return back()->with('error', 'Kategori masih digunakan, tidak bisa dihapus');
    //     }

    //     $kategori->delete();

    //     return back()->with('success', 'Kategori berhasil dihapus');
    // }

    // public function halamanVerifKuliner()
    // {
    //     $statuswisatakuliner = PengajuanWisataKuliner::exists();
    //     // $wisataKuliner = WisataKuliner::whereIn('status', ['Belum Diverifikasi', 'Ditolak'])->paginate(10)->withQueryString();
    //     $wisataKuliner = PengajuanWisataKuliner::query()
    //         ->orderByRaw("
    //             CASE 
    //                 WHEN status = 'Belum Diverifikasi' THEN 1
    //                 WHEN status = 'Disetujui' THEN 2
    //                 WHEN status = 'Ditolak' THEN 3
    //                 ELSE 4
    //             END
    //         ")
    //         ->orderBy('waktu_diubah', 'desc')
    //         ->paginate(10)
    //         ->withQueryString();

    //     $wisataKuliner->getCollection()->transform(function ($item, $key) use ($wisataKuliner) {
    //         $item->nomor = ($wisataKuliner->currentPage() - 1) * $wisataKuliner->perPage() + $key + 1;
    //         return $item;
    //     });

    //     return view('admin.verifikasi-kuliner.halaman-verifikasi-kuliner', compact(
    //         'statuswisatakuliner',
    //         'wisataKuliner',
    //     ));
    // }

    // // public function halamanVerifKuliner()
    // // {
    // //     $queryBaru = WisataKuliner::whereIn('status', ['Belum Diverifikasi', 'Ditolak'])
    // //         ->selectRaw("
    // //         id,
    // //         nama,
    // //         status,
    // //         waktu_diubah,
    // //         'baru' as sumber,
    // //         id as id_sumber
    // //     ");

    // //     $queryPerubahan = PengajuanWisataKuliner::whereIn('status', ['Belum Diverifikasi', 'Ditolak'])
    // //         ->selectRaw("
    // //         id,
    // //         nama,
    // //         status,
    // //         waktu_diubah,
    // //         'perubahan' as sumber,
    // //         id as id_sumber
    // //     ");

    // //     $wisataKuliner = WisataKuliner::fromSub(
    // //         $queryBaru->unionAll($queryPerubahan),
    // //         'gabungan'
    // //     )
    // //         ->orderByRaw("
    // //     CASE 
    // //         WHEN status = 'Belum Diverifikasi' THEN 1
    // //         WHEN status = 'Ditolak' THEN 2
    // //     END
    // // ")
    // //         ->orderBy('waktu_diubah', 'desc')
    // //         ->paginate(10)
    // //         ->withQueryString();

    // //     $wisataKuliner->getCollection()->transform(function ($item, $key) use ($wisataKuliner) {
    // //         $item->nomor = ($wisataKuliner->currentPage() - 1) * $wisataKuliner->perPage() + $key + 1;
    // //         $item->label_sumber = $item->sumber === 'baru' ? 'Data Baru' : 'Perubahan Data';
    // //         return $item;
    // //     });

    // //     $statuswisatakuliner = $wisataKuliner->isNotEmpty();

    // //     return view('admin.verifikasi-kuliner.halaman-verifikasi-kuliner', compact(
    // //         'statuswisatakuliner',
    // //         'wisataKuliner',
    // //     ));
    // // }

    // // public function detailVerifKuliner($id)
    // // {
    // //     $wisataKuliner = WisataKuliner::with(['fasilitas', 'kategori'])->findOrFail($id);
    // //     $pengajuanwk = PengajuanWisataKuliner::with(['fasilitas', 'kategori'])->findOrFail($id);

    // //     return response()->json([
    // //         'lama' => $wisataKuliner,
    // //         'baru' => $pengajuanwk
    // //     ]);
    // // }
    // // public function detailVerifKuliner($id)
    // // {
    // //     $pengajuan = PengajuanWisataKuliner::with(['fasilitas', 'kategori'])
    // //         ->findOrFail($id);

    // //     $wisataKuliner = null;

    // //     if ($pengajuan->id_wisata_kuliner) {
    // //         $wisataKuliner = WisataKuliner::with(['fasilitas', 'kategori'])
    // //             ->find($pengajuan->id_wisata_kuliner);
    // //     }

    // //     return response()->json([
    // //         'lama' => $wisataKuliner,
    // //         'baru' => $pengajuan
    // //     ]);
    // // }
    // public function detailVerifKuliner($id)
    // {
    //     $pengajuan = PengajuanWisataKuliner::with(['fasilitas', 'kategori'])
    //         ->findOrFail($id);

    //     $wisataKuliner = WisataKuliner::with(['fasilitas', 'kategori'])
    //         ->where('id_wisata_kuliner', $pengajuan->id_wisata_kuliner)
    //         ->first();

    //     return response()->json([
    //         'lama' => $wisataKuliner,
    //         'baru' => $pengajuan
    //     ]);
    // }

    // public function verifikasiWisataKuliner(Request $request, $id)
    // {
    //     $pengajuan = PengajuanWisataKuliner::findOrFail($id);
    //     $waktu_dibuat = Carbon::now('Asia/Jakarta');
    //     $waktu_diubah = Carbon::now('Asia/Jakarta');

    //     // $email_pengaju = Auth::user()->email;

    //     $id_wisatawan = null;
    //     $id_admin = null;
    //     if (Auth::check() && Auth::user()->peran === 'Wisatawan') {
    //         $id_admin = Wisatawan::where('user_id', Auth::id())->value('id_wisatawan');
    //     } elseif (Auth::check() && Auth::user()->peran === 'Admin') {
    //         $id_admin = Admin::where('user_id', Auth::id())->value('id_admin');
    //     }

    //     $fotoPath = $pengajuan->foto;

    //     if ($request->hasFile('foto')) {
    //         if ($pengajuan->foto && Storage::exists('public/' . $pengajuan->foto)) {
    //             Storage::delete('public/' . $pengajuan->foto);
    //         }

    //         $fotoPath = $request->file('foto')->storeAs(
    //             'uploads',
    //             'foto_' . Str::slug($request->nama) . '_' . time() . '.' . $request->file('foto')->extension(),
    //             'public'
    //         );
    //     }

    //     $dataMK = $request->id_fasilitas ?? [];
    //     $dataKategori = $request->id_kategori ?? [];

    //     if (!$pengajuan->id_wisata_kuliner) {
    //         if ($request->status === 'Disetujui' || $request->status === 'Ditampilkan') {

    //             $exists = WisataKuliner::where('latitude', $pengajuan->latitude)
    //                 ->where('longitude', $pengajuan->longitude)
    //                 ->exists();

    //             if ($exists) {
    //                 return response()->json([
    //                     'success' => false,
    //                     'message' => 'Lokasi sudah digunakan wisata kuliner lain'
    //                 ], 422);
    //             }

    //             $wisata = WisataKuliner::create([
    //                 'nama' => $pengajuan->nama,
    //                 'kecamatan' => $pengajuan->kecamatan,
    //                 'kelurahan' => $pengajuan->kelurahan,
    //                 'alamat' => $pengajuan->alamat,
    //                 'no_telp' => $pengajuan->no_telp ?? null,
    //                 'email' => $pengajuan->email,
    //                 'foto' => $fotoPath,
    //                 'deskripsi' => $pengajuan->deskripsi,
    //                 'latitude' => $pengajuan->latitude,
    //                 'longitude' => $pengajuan->longitude,
    //                 'harga_min' => 0,
    //                 'harga_max' => 0,
    //                 'penilaian' => 0,
    //                 'email_pengaju' => $pengajuan->email_pengaju,
    //                 'id_wisatawan' => $id_wisatawan ?? null,
    //                 'id_admin' => $id_admin ?? null,
    //                 'status' => $request->status,
    //                 'waktu_dibuat' => $waktu_dibuat,
    //                 'waktu_diubah' => $waktu_diubah,
    //             ]);

    //             // $kategoriLama = $wisata->kategori()->pluck('id_kategori')->toArray();

    //             $fasilitasIds = $pengajuan->fasilitas()->pluck('fasilitas.id_fasilitas')->toArray();
    //             $kategoriIds = $pengajuan->kategori()->pluck('kategori.id_kategori')->toArray();

    //             $wisata->fasilitas()->sync($fasilitasIds);
    //             $wisata->kategori()->sync($kategoriIds);

    //             // $kategoriBaru = $kategoriIds;
    //             // $kategoriDihapus = array_diff($kategoriLama, $kategoriBaru);
    //             // $idWisata = $wisata->id_wisata_kuliner;

    //             // $favorit = KulinerFavorit::where('id_wisata_kuliner', $idWisata)->get();
    //             // $kategoriWisata = $wisata->kategori->pluck('id_kategori')->toArray();
    //             // foreach ($favorit as $f) {
    //             //     $id_wisatawan = $f->id_wisatawan;

    //             //     foreach ($kategoriWisata as $id_kategori) {

    //             //         $sudahAda = Preferensi::where('id_wisatawan', $id_wisatawan)
    //             //             ->where('id_kategori', $id_kategori)
    //             //             ->exists();

    //             //         if (!$sudahAda) {
    //             //             Preferensi::create([
    //             //                 'id_wisatawan' => $id_wisatawan,
    //             //                 'id_kategori' => $id_kategori,
    //             //                 'jumlah' => 1
    //             //             ]);
    //             //         }
    //             //     }
    //             // }
    //             // $favorit = KulinerFavorit::where('id_wisata_kuliner', $idWisata)->get();

    //             // foreach ($favorit as $f) {
    //             //     $id_wisatawan = $f->id_wisatawan;

    //             //     foreach ($kategoriDihapus as $id_kategori) {

    //             //         $masihDipakai = KulinerFavorit::where('id_wisatawan', $id_wisatawan)
    //             //             ->whereHas('wisata.kategori', function ($q) use ($id_kategori) {
    //             //                 $q->where('id_kategori', $id_kategori);
    //             //             })
    //             //             ->exists();

    //             //         if (!$masihDipakai) {
    //             //             Preferensi::where('id_wisatawan', $id_wisatawan)
    //             //                 ->where('id_kategori', $id_kategori)
    //             //                 ->delete();
    //             //         }
    //             //     }

    //             //     foreach ($kategoriBaru as $id_kategori) {
    //             //         Preferensi::firstOrCreate([
    //             //             'id_wisatawan' => $id_wisatawan,
    //             //             'id_kategori' => $id_kategori
    //             //         ], [
    //             //             'jumlah' => 1
    //             //         ]);
    //             //     }
    //             // }

    //             $pengajuan->update([
    //                 'status' => 'Disetujui',
    //                 'id_wisata_kuliner' => $wisata->id_wisata_kuliner,
    //                 'waktu_diubah' => $waktu_diubah,
    //             ]);
    //         } else {
    //             $pengajuan->update([
    //                 'status' => 'Ditolak',
    //                 'waktu_diubah' => $waktu_diubah,
    //             ]);
    //         }
    //     } else {
    //         $wisata = WisataKuliner::findOrFail($pengajuan->id_wisata_kuliner);
    //         if ($request->status === 'Disetujui' || $request->status === 'Ditampilkan') {
    //             $exists = WisataKuliner::where('latitude', $pengajuan->latitude)
    //                 ->where('longitude', $pengajuan->longitude)
    //                 ->where('id_wisata_kuliner', '!=', $pengajuan->id_wisata_kuliner)
    //                 ->exists();

    //             if ($exists) {
    //                 return response()->json([
    //                     'success' => false,
    //                     'message' => 'Lokasi sudah digunakan wisata kuliner lain'
    //                 ], 422);
    //             }

    //             $wisata->update([
    //                 'nama' => $pengajuan->nama,
    //                 'kecamatan' => $pengajuan->kecamatan,
    //                 'kelurahan' => $pengajuan->kelurahan,
    //                 'alamat' => $pengajuan->alamat,
    //                 'no_telp' => $pengajuan->no_telp ?? null,
    //                 'email' => $pengajuan->email ?? null,
    //                 'foto' => $fotoPath,
    //                 'deskripsi' => $pengajuan->deskripsi,
    //                 'latitude'  => $pengajuan->latitude,
    //                 'longitude' => $pengajuan->longitude,
    //                 'email_pengaju' => $pengajuan->email_pengaju,
    //                 'id_wisatawan' => $id_wisatawan ?? null,
    //                 'id_admin' => $id_admin ?? null,
    //                 'status' => $request->status,
    //                 'waktu_diubah' => $waktu_diubah,
    //             ]);

    //             $fasilitasIds = $pengajuan->fasilitas()->pluck('fasilitas.id_fasilitas')->toArray();
    //             $kategoriIds = $pengajuan->kategori()->pluck('kategori.id_kategori')->toArray();

    //             $wisata->fasilitas()->sync($fasilitasIds);
    //             $wisata->kategori()->sync($kategoriIds);

    //             // $idWisata = $wisata->id_wisata_kuliner;

    //             // $favorit = KulinerFavorit::where('id_wisata_kuliner', $idWisata)->get();
    //             // $kategoriWisata = $wisata->kategori->pluck('id_kategori')->toArray();
    //             // foreach ($favorit as $f) {
    //             //     $id_wisatawan = $f->id_wisatawan;

    //             //     foreach ($kategoriWisata as $id_kategori) {

    //             //         $sudahAda = Preferensi::where('id_wisatawan', $id_wisatawan)
    //             //             ->where('id_kategori', $id_kategori)
    //             //             ->exists();

    //             //         if (!$sudahAda) {
    //             //             Preferensi::create([
    //             //                 'id_wisatawan' => $id_wisatawan,
    //             //                 'id_kategori' => $id_kategori,
    //             //                 'jumlah' => 1
    //             //             ]);
    //             //         }
    //             //     }
    //             // }

    //             $pengajuan->update([
    //                 'status' => 'Disetujui',
    //                 'waktu_diubah' => $waktu_diubah,
    //             ]);
    //         } else {
    //             $pengajuan->update([
    //                 'status' => 'Ditolak',
    //                 'waktu_diubah' => $waktu_diubah,
    //             ]);
    //         }
    //     }
    //     // if ($request->status === 'Disetujui') {
    //     //     $wisataKuliner->update([
    //     //         'status' => 'Disetujui',
    //     //         'waktu_diubah' => $waktu_diubah,
    //     //     ]);
    //     // }

    //     // if ($request->status === 'Ditolak') {
    //     //     $wisataKuliner->update([
    //     //         'status' => 'Ditolak',
    //     //         'waktu_diubah' => $waktu_diubah,
    //     //     ]);
    //     // }

    //     // if ($request->status === 'Ditampilkan') {
    //     //     $wisataKuliner->update([
    //     //         'status' => 'Ditampilkan',
    //     //         'waktu_diubah' => $waktu_diubah,
    //     //     ]);
    //     // }

    //     return response()->json([
    //         'success' => true,
    //         // 'wisataKuliner' => $wisataKuliner,
    //         // 'status' => $wisataKuliner->status,
    //         'message' => 'Status berhasil diperbarui'
    //     ]);
    // }

    // public function tampilkanWisataKuliner(Request $request, $id)
    // {
    //     $wisataKuliner = WisataKuliner::findOrFail($id);

    //     $waktu_diubah = Carbon::now('Asia/Jakarta');

    //     if ($request->status === 'Ditampilkan') {
    //         $wisataKuliner->update([
    //             'status' => 'Ditampilkan',
    //             'waktu_diubah' => $waktu_diubah,
    //         ]);
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'wisataKuliner' => $wisataKuliner,
    //         'status' => $wisataKuliner->status,
    //         'message' => 'Wisata Kuliner berhasil ditampilkan'
    //     ]);
    // }

    // public function halamanVerifUlasan()
    // {
    //     $statusUlasan = PenilaiandanUlasan::exists();
    //     // $penilaianDanUlasan = PenilaiandanUlasan::paginate(10)->withQueryString();
    //     $penilaianDanUlasan = PenilaiandanUlasan::orderByRaw("
    //             CASE 
    //                 WHEN status = 'Belum Diverifikasi' THEN 1
    //                 WHEN status = 'Disetujui' THEN 2
    //                 WHEN status = 'Ditolak' THEN 3
    //             END
    //         ")
    //         ->orderBy('waktu_diubah', 'desc')
    //         ->paginate(10)
    //         ->withQueryString();

    //     $penilaianDanUlasan->getCollection()->transform(function ($item, $key) use ($penilaianDanUlasan) {
    //         $item->nomor = ($penilaianDanUlasan->currentPage() - 1) * $penilaianDanUlasan->perPage() + $key + 1;
    //         return $item;
    //     });

    //     return view('admin.verifikasi-ulasan.halaman-verifikasi-ulasan', compact(
    //         'statusUlasan',
    //         'penilaianDanUlasan',
    //     ));
    // }

    // public function detailVerifUlasan($id)
    // {
    //     $penilaianDanUlasan = PenilaiandanUlasan::with('wisataKuliner')->findOrFail($id);

    //     return response()->json($penilaianDanUlasan);
    // }

    // public function verifikasiUlasan(Request $request, $id)
    // {
    //     $penilaianDanUlasan = PenilaiandanUlasan::findOrFail($id);
    //     $waktu_diubah = Carbon::now('Asia/Jakarta');

    //     if ($request->status === 'Disetujui') {
    //         $penilaianDanUlasan->update([
    //             'status' => 'Disetujui',
    //             'waktu_diubah' => $waktu_diubah,
    //         ]);
    //     }

    //     if ($request->status === 'Ditolak') {
    //         $penilaianDanUlasan->update([
    //             'status' => 'Ditolak',
    //             'waktu_diubah' => $waktu_diubah,
    //         ]);
    //     }

    //     $waktu_diubah = Carbon::now('Asia/Jakarta');
    //     $wisataKuliner = WisataKuliner::findOrFail($penilaianDanUlasan->id_wisata_kuliner);
    //     $min_total = PenilaiandanUlasan::where('id_wisata_kuliner', $penilaianDanUlasan->id_wisata_kuliner)
    //         ->where('status', 'Disetujui')
    //         ->min('harga_min');
    //     $max_total = PenilaiandanUlasan::where('id_wisata_kuliner', $penilaianDanUlasan->id_wisata_kuliner)
    //         ->where('status', 'Disetujui')
    //         ->max('harga_max');
    //     $penilaian_ratarata = PenilaiandanUlasan::where('id_wisata_kuliner', $penilaianDanUlasan->id_wisata_kuliner)
    //         ->where('status', 'Disetujui')
    //         ->avg('penilaian');
    //     $wisataKuliner->update([
    //         'harga_min' => $min_total,
    //         'harga_max' => $max_total,
    //         'penilaian' => $penilaian_ratarata,
    //         'waktu_diubah' => $waktu_diubah,
    //     ]);

    //     return response()->json([
    //         'success' => true,
    //         'wisataKuliner' => $penilaianDanUlasan,
    //         'status' => $penilaianDanUlasan->status,
    //         'message' => 'Status berhasil diperbarui'
    //     ]);
    // }

    // public function hapusUlasan($id)
    // {
    //     try {

    //         $ulasan = PenilaiandanUlasan::findOrFail($id);

    //         if ($ulasan->foto && Storage::disk('public')->exists($ulasan->foto)) {
    //             Storage::disk('public')->delete($ulasan->foto);
    //         }

    //         $wisataKuliner = WisataKuliner::findOrFail($ulasan->id_wisata_kuliner);
    //         $idUlasan = $ulasan->id_penilaian_dan_ulasan;
    //         $waktu_diubah = Carbon::now('Asia/Jakarta');

    //         $min_total = PenilaiandanUlasan::where('id_wisata_kuliner', $ulasan->id_wisata_kuliner)
    //             ->where('status', 'Disetujui')
    //             ->where('id_penilaian_dan_ulasan', '!=', $idUlasan)
    //             ->min('harga_min');

    //         $max_total = PenilaiandanUlasan::where('id_wisata_kuliner', $ulasan->id_wisata_kuliner)
    //             ->where('status', 'Disetujui')
    //             ->where('id_penilaian_dan_ulasan', '!=', $idUlasan)
    //             ->max('harga_max');

    //         $penilaian_ratarata = PenilaiandanUlasan::where('id_wisata_kuliner', $ulasan->id_wisata_kuliner)
    //             ->where('status', 'Disetujui')
    //             ->where('id_penilaian_dan_ulasan', '!=', $idUlasan)
    //             ->avg('penilaian');

    //         $wisataKuliner->update([
    //             'harga_min' => $min_total ?? 0,
    //             'harga_max' => $max_total ?? 0,
    //             'penilaian' => $penilaian_ratarata ?? 0,
    //             'waktu_diubah' => $waktu_diubah,
    //         ]);

    //         $ulasan->delete();

    //         return redirect()->back()->with('success', 'Ulasan berhasil dihapus');
    //     } catch (Exception $e) {
    //         Log::error('Error in AdminController@destroy: ' . $e->getMessage());
    //         return back()->with('error', 'Terjadi kesalahan saat menghapus ulasan.');
    //     }
    // }

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

    // public function selectmhs()
    // {
    //     $data = WisataKuliner::where('nama', 'LIKE', '%' . request('q') . '%')->paginate(10);

    //     return response()->json($data);
    // }

    // public function selectmk($id)
    // {
    //     $data = Fasilitas::where('nama', 'LIKE', '%' . request('q') . '%')
    //         ->paginate(10);

    //     return response()->json($data);
    // }

    // public function selectkategori($id)
    // {
    //     $data = Kategori::where('nama', 'LIKE', '%' . request('q') . '%')
    //         ->paginate(10);

    //     return response()->json($data);
    // }

    // public function getKategori($id = null)
    // {
    //     if (!$id || $id == "null") {
    //         return '';
    //     }

    //     $kategori = KategoriWisataKuliner::with('kategori')
    //         ->where('id_wisata_kuliner', $id)
    //         ->get();

    //     $data = '';

    //     foreach ($kategori as $row) {
    //         if ($row->kategori) {
    //             $data .= "<option value='{$row->id_kategori}' selected>
    //                     {$row->kategori->nama}
    //                   </option>";
    //         }
    //     }

    //     return $data;
    // }

    // // public function verifikasiWisataKuliner(Request $request, $id)
    // // {
    // //     // $wisataKuliner = WisataKuliner::findOrFail($id);
    // //     // $jadwalkuliahajukan = JadwalKuliah::where('id_semester_aktif', $idsemaktif)
    // //     //     ->where('status', 'diajukan')
    // //     //     ->get();

    // //     // if ($jadwalkuliahajukan->isEmpty()) {
    // //     //     return response()->json([
    // //     //         'success' => false,
    // //     //         'message' => 'Tidak ada jadwal yang dapat disetujui.',
    // //     //     ]);
    // //     // }

    // //     // foreach ($jadwalkuliahajukan as $jadwal) {
    // //     //     $jadwal->status = 'disetujui';
    // //     //     $jadwal->save();
    // //     // }

    // //     // return response()->json([
    // //     //     'success' => true,
    // //     //     'status' => 'Disetujui',
    // //     //     'message' => 'Wisata kuliner berhasil disetujui.',
    // //     // ]);

    // //     $wisataKuliner = WisataKuliner::findOrFail($id);

    // //     if ($request->status === 'Disetujui') {
    // //         $wisataKuliner->update([
    // //             'status' => 'Disetujui'
    // //         ]);
    // //     }

    // //     if ($request->status === 'Ditolak') {
    // //         $wisataKuliner->update([
    // //             'status' => 'Ditolak'
    // //         ]);
    // //     }

    // //     if ($request->status === 'Ditampilkan') {
    // //         $wisataKuliner->update([
    // //             'status' => 'Ditampilkan'
    // //         ]);
    // //     }

    // //     // $wisataKuliner->save();

    // //     return response()->json($wisataKuliner, [
    // //         'success' => true,
    // //         'wisataKuliner' => $wisataKuliner,
    // //         'status' => $wisataKuliner->status
    // //     ]);
    // // }

    // // public function detail($nama_wk)
    // // {
    // //     $detail = WisataKuliner::select('nama', 'waktu_diubah')
    // //         ->where('id_wisatakuliner', $nama_wk)
    // //         ->first();

    // //     if (!$detail) {
    // //         return response()->json(['error' => 'Data tidak ditemukan'], 404);
    // //     }

    // //     return response()->json($detail);
    // // }

    // // public function edit(Request $request, $nama_wk)
    // // {
    // //     $validated = $request->validate([
    // //         'nama' => 'required|string|max:255',
    // //         'kecamatan' => 'required|string|max:50',
    // //         'kelurahan' => 'required|string|max:50',
    // //         'alamat' => 'required|string|max:100',
    // //         'no_hp' => 'required|numeric|min:10|max:15',
    // //         'email' => 'nullable|string|max:70',
    // //         'foto' => 'required|image|mimes:jpeg,png,jpg|max:10240',
    // //         'deskripsi' => 'required|string|max:255',
    // //         'latitude'  => 'required|numeric|between:-90,90',
    // //         'longitude' => 'required|numeric|between:-180,180',
    // //         'email_pengaju' => 'required|string|max:70',
    // //         'id_wisatawan' => 'nullable|integer|min:1|exists:wisata_kuliner,id_wisata_kuliner',
    // //         'id_admin' => 'nullable|integer|min:1|exists:admin,id_admin',
    // //         'status' => 'required|string|max:28',
    // //     ]);

    // //     $wisataKuliner = WisataKuliner::findOrFail($nama_wk);

    // //     if ($request->hasFile('foto')) {
    // //         $path = $request->file('foto')->storeAs(
    // //             'uploads',
    // //             'foto_' . Str::slug($wisataKuliner) . '.' . $request->file('foto')->extension(),
    // //             'public'
    // //         );
    // //         $wisataKuliner->foto = $path;
    // //     }

    // //     $wisataKuliner->update($validated);

    // //     return redirect()->back()->with('success', 'Wisata Kuliner Berhasil Diperbarui');
    // // }

    // // public function hapus($nama_wk)
    // // {
    // //     WisataKuliner::findOrFail($nama_wk)->delete();
    // //     return redirect()->route('kelola-Wisata-Kuliner')
    // //         ->with('success', 'Wisata Kuliner Berhasil Dihapus');
    // // }
}
