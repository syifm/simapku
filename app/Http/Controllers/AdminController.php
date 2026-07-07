<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use App\Models\WisataKuliner;
use App\Models\Fasilitas;
use App\Models\FasilitasWisataKuliner;
use App\Models\Kategori;
use App\Models\KategoriWisataKuliner;
use App\Models\PengajuanWisataKuliner;
use App\Models\KulinerFavorit;
use App\Models\Preferensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    // private function cekLokasiDuplikat($lat, $lng, $idwisata = null, $idpengajuan = null)
    // {
    //     $queryWisata = WisataKuliner::where('latitude', $lat)
    //         ->where('longitude', $lng);

    //     if ($idwisata) {
    //         $queryWisata->where('id_wisata_kuliner', '!=', $idwisata);
    //     }

    //     $queryPengajuan = PengajuanWisataKuliner::where('latitude', $lat)
    //         ->where('longitude', $lng)
    //         ->where('status', 'Belum Diverifikasi');

    //     if ($idpengajuan) {
    //         $queryPengajuan->where('id_pengajuan', '!=', $idpengajuan);
    //     }

    //     return $queryWisata->exists() || $queryPengajuan->exists();
    // }
    private function cekLokasiDuplikat($lat, $lng, $idwisata = null, $idpengajuan = null)
    {
        $lat = round($lat, 6);
        $lng = round($lng, 6);

        $queryWisata = WisataKuliner::whereRaw('ROUND(latitude, 6) = ?', [$lat])
            ->whereRaw('ROUND(longitude, 6) = ?', [$lng]);

        if ($idwisata) {
            $queryWisata->where('id_wisata_kuliner', '!=', $idwisata);
        }

        $queryPengajuan = PengajuanWisataKuliner::whereRaw('ROUND(latitude, 6) = ?', [$lat])
            ->whereRaw('ROUND(longitude, 6) = ?', [$lng])
            ->where('status', 'Belum Diverifikasi');

        if ($idpengajuan) {
            $queryPengajuan->where('id_pengajuan', '!=', $idpengajuan);
        }

        return $queryWisata->exists() || $queryPengajuan->exists();
    }

    public function cekLokasi(Request $request)
    {
        $isDuplikat = $this->cekLokasiDuplikat(
            $request->latitude,
            $request->longitude,
            $request->id_wisata_kuliner,
            $request->id_pengajuan ?? null
        );

        return response()->json([
            'duplikat' => $isDuplikat
        ]);
    }

    public function tampilkanVerifKuliner()
    {
        $statuswisatakuliner = PengajuanWisataKuliner::exists();
        // $wisataKuliner = WisataKuliner::whereIn('status', ['Belum Diverifikasi', 'Ditolak'])->paginate(10)->withQueryString();
        $wisataKuliner = PengajuanWisataKuliner::query()
            ->orderByRaw("
                CASE 
                    WHEN status = 'Belum Diverifikasi' THEN 1
                    WHEN status = 'Disetujui' THEN 2
                    ELSE THEN 3
                END
            ")
            ->orderBy('waktu_diubah', 'desc')
            ->paginate(10)
            ->withQueryString();

        $wisataKuliner->getCollection()->transform(function ($item, $key) use ($wisataKuliner) {
            $item->nomor = ($wisataKuliner->currentPage() - 1) * $wisataKuliner->perPage() + $key + 1;
            return $item;
        });

        return view('admin.verifikasi-kuliner.halaman-verifikasi-kuliner', compact(
            'statuswisatakuliner',
            'wisataKuliner',
        ));
    }

    // public function halamanVerifKuliner()
    // {
    //     $queryBaru = WisataKuliner::whereIn('status', ['Belum Diverifikasi', 'Ditolak'])
    //         ->selectRaw("
    //         id,
    //         nama,
    //         status,
    //         waktu_diubah,
    //         'baru' as sumber,
    //         id as id_sumber
    //     ");

    //     $queryPerubahan = PengajuanWisataKuliner::whereIn('status', ['Belum Diverifikasi', 'Ditolak'])
    //         ->selectRaw("
    //         id,
    //         nama,
    //         status,
    //         waktu_diubah,
    //         'perubahan' as sumber,
    //         id as id_sumber
    //     ");

    //     $wisataKuliner = WisataKuliner::fromSub(
    //         $queryBaru->unionAll($queryPerubahan),
    //         'gabungan'
    //     )
    //         ->orderByRaw("
    //     CASE 
    //         WHEN status = 'Belum Diverifikasi' THEN 1
    //         WHEN status = 'Ditolak' THEN 2
    //     END
    // ")
    //         ->orderBy('waktu_diubah', 'desc')
    //         ->paginate(10)
    //         ->withQueryString();

    //     $wisataKuliner->getCollection()->transform(function ($item, $key) use ($wisataKuliner) {
    //         $item->nomor = ($wisataKuliner->currentPage() - 1) * $wisataKuliner->perPage() + $key + 1;
    //         $item->label_sumber = $item->sumber === 'baru' ? 'Data Baru' : 'Perubahan Data';
    //         return $item;
    //     });

    //     $statuswisatakuliner = $wisataKuliner->isNotEmpty();

    //     return view('admin.verifikasi-kuliner.halaman-verifikasi-kuliner', compact(
    //         'statuswisatakuliner',
    //         'wisataKuliner',
    //     ));
    // }

    // public function detailVerifKuliner($id)
    // {
    //     $wisataKuliner = WisataKuliner::with(['fasilitas', 'kategori'])->findOrFail($id);
    //     $pengajuanwk = PengajuanWisataKuliner::with(['fasilitas', 'kategori'])->findOrFail($id);

    //     return response()->json([
    //         'lama' => $wisataKuliner,
    //         'baru' => $pengajuanwk
    //     ]);
    // }
    // public function detailVerifKuliner($id)
    // {
    //     $pengajuan = PengajuanWisataKuliner::with(['fasilitas', 'kategori'])
    //         ->findOrFail($id);

    //     $wisataKuliner = null;

    //     if ($pengajuan->id_wisata_kuliner) {
    //         $wisataKuliner = WisataKuliner::with(['fasilitas', 'kategori'])
    //             ->find($pengajuan->id_wisata_kuliner);
    //     }

    //     return response()->json([
    //         'lama' => $wisataKuliner,
    //         'baru' => $pengajuan
    //     ]);
    // }


    // public function tampilkanWisataKuliner(Request $request, $id)
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

    public function halamanVerifUlasan()
    {
        $statusUlasan = Ulasan::exists();
        // $ulasan = Ulasan::paginate(10)->withQueryString();
        $ulasan = Ulasan::orderByRaw("
                CASE 
                    WHEN status = 'Belum Diverifikasi' THEN 1
                    WHEN status = 'Disetujui' THEN 2
                    WHEN status = 'Ditolak' THEN 3
                END
            ")
            ->orderBy('waktu_diubah', 'desc')
            ->paginate(10)
            ->withQueryString();

        $ulasan->getCollection()->transform(function ($item, $key) use ($ulasan) {
            $item->nomor = ($ulasan->currentPage() - 1) * $ulasan->perPage() + $key + 1;
            return $item;
        });

        return view('admin.verifikasi-ulasan.halaman-verifikasiulasan', compact(
            'statusUlasan',
            'ulasan',
        ));
    }

    public function detailVerifUlasan($id)
    {
        $ulasan = Ulasan::with('wisataKuliner')->findOrFail($id);

        return response()->json($ulasan);
    }

    public function verifikasiUlasan(Request $request, $id)
    {
        $ulasan = Ulasan::findOrFail($id);
        $waktu_diubah = Carbon::now('Asia/Jakarta');

        if ($request->status === 'Disetujui') {
            $ulasan->update([
                'status' => 'Disetujui',
                'waktu_diubah' => $waktu_diubah,
            ]);
        }

        if ($request->status === 'Ditolak') {
            $ulasan->update([
                'status' => 'Ditolak',
                'waktu_diubah' => $waktu_diubah,
            ]);
        }

        $waktu_diubah = Carbon::now('Asia/Jakarta');
        $wisataKuliner = WisataKuliner::findOrFail($ulasan->id_wisata_kuliner);
        $min_total = Ulasan::where('id_wisata_kuliner', $ulasan->id_wisata_kuliner)
            ->where('status', 'Disetujui')
            ->min('harga_min');
        $max_total = Ulasan::where('id_wisata_kuliner', $ulasan->id_wisata_kuliner)
            ->where('status', 'Disetujui')
            ->max('harga_max');
        $penilaian_ratarata = Ulasan::where('id_wisata_kuliner', $ulasan->id_wisata_kuliner)
            ->where('status', 'Disetujui')
            ->avg('penilaian');
        $wisataKuliner->update([
            'harga_min' => $min_total,
            'harga_max' => $max_total,
            'penilaian' => $penilaian_ratarata,
            'waktu_diubah' => $waktu_diubah,
        ]);

        return response()->json([
            'success' => true,
            'wisataKuliner' => $ulasan,
            'status' => $ulasan->status,
            'message' => 'Status berhasil diperbarui'
        ]);
    }

    public function hapusUlasan($id)
    {
        try {

            $ulasan = Ulasan::findOrFail($id);

            if ($ulasan->foto && Storage::disk('public')->exists($ulasan->foto)) {
                Storage::disk('public')->delete($ulasan->foto);
            }

            $wisataKuliner = WisataKuliner::findOrFail($ulasan->id_wisata_kuliner);
            $idUlasan = $ulasan->id_penilaian_dan_ulasan;
            $waktu_diubah = Carbon::now('Asia/Jakarta');

            $min_total = Ulasan::where('id_wisata_kuliner', $ulasan->id_wisata_kuliner)
                ->where('status', 'Disetujui')
                ->where('id_penilaian_dan_ulasan', '!=', $idUlasan)
                ->min('harga_min');

            $max_total = Ulasan::where('id_wisata_kuliner', $ulasan->id_wisata_kuliner)
                ->where('status', 'Disetujui')
                ->where('id_penilaian_dan_ulasan', '!=', $idUlasan)
                ->max('harga_max');

            $penilaian_ratarata = Ulasan::where('id_wisata_kuliner', $ulasan->id_wisata_kuliner)
                ->where('status', 'Disetujui')
                ->where('id_penilaian_dan_ulasan', '!=', $idUlasan)
                ->avg('penilaian');

            $wisataKuliner->update([
                'harga_min' => $min_total ?? 0,
                'harga_max' => $max_total ?? 0,
                'penilaian' => $penilaian_ratarata ?? 0,
                'waktu_diubah' => $waktu_diubah,
            ]);

            $ulasan->delete();

            return redirect()->back()->with('success', 'Ulasan berhasil dihapus');
        } catch (Exception $e) {
            Log::error('Error in AdminController@destroy: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghapus ulasan.');
        }
    }

    public function getngampu($id = null)
    {
        if (!$id || $id == "null") {
            return '';
        }

        $mk = FasilitasWisataKuliner::with('fasilitas')
            ->where('id_wisata_kuliner', $id)
            ->get();

        $data = '';

        foreach ($mk as $row) {
            if ($row->fasilitas) {
                $data .= "<option value='{$row->id_fasilitas}' selected>
                        {$row->fasilitas->nama}
                      </option>";
            }
        }

        return $data;
    }

    public function selectmhs()
    {
        $data = WisataKuliner::where('nama', 'LIKE', '%' . request('q') . '%')->paginate(10);

        return response()->json($data);
    }

    public function selectmk($id)
    {
        // $data = Fasilitas::where('nama', 'LIKE', '%' . request('q') . '%')
        //     ->paginate(10);
        $query = Fasilitas::query();

        if (request('q')) {
            $query->where('nama', 'LIKE', '%' . request('q') . '%');
        }

        $data = $query->get();

        return response()->json($data);
    }

    public function selectkategori($id)
    {
        // $data = Kategori::where('nama', 'LIKE', '%' . request('q') . '%')
        //     ->paginate(10);
        $query = Kategori::query();

        if (request('q')) {
            $query->where('nama', 'LIKE', '%' . request('q') . '%');
        }

        $data = $query->get();
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

    // public function verifikasiWisataKuliner(Request $request, $id)
    // {
    //     // $wisataKuliner = WisataKuliner::findOrFail($id);
    //     // $jadwalkuliahajukan = JadwalKuliah::where('id_semester_aktif', $idsemaktif)
    //     //     ->where('status', 'diajukan')
    //     //     ->get();

    //     // if ($jadwalkuliahajukan->isEmpty()) {
    //     //     return response()->json([
    //     //         'success' => false,
    //     //         'message' => 'Tidak ada jadwal yang dapat disetujui.',
    //     //     ]);
    //     // }

    //     // foreach ($jadwalkuliahajukan as $jadwal) {
    //     //     $jadwal->status = 'disetujui';
    //     //     $jadwal->save();
    //     // }

    //     // return response()->json([
    //     //     'success' => true,
    //     //     'status' => 'Disetujui',
    //     //     'message' => 'Wisata kuliner berhasil disetujui.',
    //     // ]);

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

    // public function detail($nama_wk)
    // {
    //     $detail = WisataKuliner::select('nama', 'waktu_diubah')
    //         ->where('id_wisatakuliner', $nama_wk)
    //         ->first();

    //     if (!$detail) {
    //         return response()->json(['error' => 'Data tidak ditemukan'], 404);
    //     }

    //     return response()->json($detail);
    // }

    // public function edit(Request $request, $nama_wk)
    // {
    //     $validated = $request->validate([
    //         'nama' => 'required|string|max:255',
    //         'kecamatan' => 'required|string|max:50',
    //         'kelurahan' => 'required|string|max:50',
    //         'alamat' => 'required|string|max:100',
    //         'no_hp' => 'required|numeric|min:10|max:15',
    //         'email' => 'nullable|string|max:70',
    //         'foto' => 'required|image|mimes:jpeg,png,jpg|max:10240',
    //         'deskripsi' => 'required|string|max:255',
    //         'latitude'  => 'required|numeric|between:-90,90',
    //         'longitude' => 'required|numeric|between:-180,180',
    //         'email_pengaju' => 'required|string|max:70',
    //         'id_wisatawan' => 'nullable|integer|min:1|exists:wisata_kuliner,id_wisata_kuliner',
    //         'id_admin' => 'nullable|integer|min:1|exists:admin,id_admin',
    //         'status' => 'required|string|max:28',
    //     ]);

    //     $wisataKuliner = WisataKuliner::findOrFail($nama_wk);

    //     if ($request->hasFile('foto')) {
    //         $path = $request->file('foto')->storeAs(
    //             'uploads',
    //             'foto_' . Str::slug($wisataKuliner) . '.' . $request->file('foto')->extension(),
    //             'public'
    //         );
    //         $wisataKuliner->foto = $path;
    //     }

    //     $wisataKuliner->update($validated);

    //     return redirect()->back()->with('success', 'Wisata Kuliner Berhasil Diperbarui');
    // }

    // public function hapus($nama_wk)
    // {
    //     WisataKuliner::findOrFail($nama_wk)->delete();
    //     return redirect()->route('kelola-Wisata-Kuliner')
    //         ->with('success', 'Wisata Kuliner Berhasil Dihapus');
    // }
}
