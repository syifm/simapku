<?php

namespace App\Http\Controllers;

use App\Models\PenilaiandanUlasan;
use App\Models\WisataKuliner;
use App\Models\Wisatawan;
use App\Models\Admin;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function berandaAdmin()
    {
        $wkulinerBelumDiverifikasi = WisataKuliner::where('status', 'Belum Diverifikasi')
            ->count();

        $wkulinerDisetujui = WisataKuliner::where('status', ['Disetujui', 'Tampilkan'])
            ->count();

        $wkulinerDitolak = WisataKuliner::where('status', 'Ditolak')
            ->count();

        $totalWisataKuliner = $wkulinerBelumDiverifikasi + $wkulinerDisetujui + $wkulinerDitolak;
        $persentaseWkulinerBelumDiverifikasi = $totalWisataKuliner > 0 ? ($wkulinerBelumDiverifikasi / $totalWisataKuliner) * 100 : 0;
        $persentaseWkulinerDisetujui = $totalWisataKuliner > 0 ? ($wkulinerDisetujui / $totalWisataKuliner) * 100 : 0;
        $persentaseWkulinerDitolak = $totalWisataKuliner > 0 ? ($wkulinerDitolak / $totalWisataKuliner) * 100 : 0;

        $ulasanBelumDiverifikasi = PenilaiandanUlasan::where('status', 'Belum Diverifikasi')
            ->count();

        $ulasanDisetujui = PenilaiandanUlasan::where('status', 'Disetujui')
            ->count();

        $ulasanDitolak = PenilaiandanUlasan::where('status', 'Ditolak')
            ->count();

        $totalUlasan = $ulasanBelumDiverifikasi + $ulasanDisetujui + $ulasanDitolak;
        $persentaseUlasanBelumDiverifikasi = $totalUlasan > 0 ? ($ulasanBelumDiverifikasi / $totalUlasan) * 100 : 0;
        $persentaseUlasanDisetujui = $totalUlasan > 0 ? ($ulasanDisetujui / $totalUlasan) * 100 : 0;
        $persentaseUlasanDitolak = $totalUlasan > 0 ? ($ulasanDitolak / $totalUlasan) * 100 : 0;

        return view('admin.beranda', compact(
            'wkulinerBelumDiverifikasi',
            'wkulinerDisetujui',
            'wkulinerDitolak',
            'totalWisataKuliner',
            'persentaseWkulinerBelumDiverifikasi',
            'persentaseWkulinerDisetujui',
            'persentaseWkulinerDitolak',
            'ulasanBelumDiverifikasi',
            'ulasanDisetujui',
            'ulasanDitolak',
            'totalUlasan',
            'persentaseUlasanBelumDiverifikasi',
            'persentaseUlasanDisetujui',
            'persentaseUlasanDitolak',
        ));
    }

    public function kelolaWisataKuliner()
    {
        $statuswisatakuliner = WisataKuliner::where('status', 'Disetujui')->exists();
        $wisataKuliner = WisataKuliner::where('status', 'Disetujui')->paginate(5)->withQueryString();;

        $wisataKuliner->getCollection()->transform(function ($item, $key) use ($wisataKuliner) {
            $item->nomor = ($wisataKuliner->currentPage() - 1) * $wisataKuliner->perPage() + $key + 1;
            return $item;
        });

        return view('admin.kelola-wisata-kuliner.halaman-awal', compact(
            'statuswisatakuliner',
            'wisataKuliner',
        ));
    }

    public function halamantambah()
    {
        return view('admin.kelola-wisata-kuliner.halaman-tambah');
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:50',
            'kelurahan' => 'required|string|max:50',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|min:10|max:15',
            'email' => 'nullable|email|max:70',
            'deskripsi' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:10240',
            'latitude'  => 'required|numeric|between:-90,90|unique:wisata_kuliner,latitude',
            'longitude' => 'required|numeric|between:-180,180|unique:wisata_kuliner,longitude',
        ]);

        $wisataKuliner = $request->nama;
        $fotoPath = $request->file('foto')->storeAs(
            'uploads',
            'foto_' . Str::slug($wisataKuliner) . '_' . time() . '.' . $request->file('foto')->extension(),
            'public'
        );

        $email_pengaju = Auth::user()->email;

        $id_wisatawan = null;
        $id_admin = null;
        if (Auth::check() && Auth::user()->peran === 'Wisatawan') {
            $id_wisatawan = Wisatawan::where('user_id', Auth::id())->value('id_wisatawan');
        } elseif (Auth::check() && Auth::user()->peran === 'Admin') {
            $id_admin = Admin::where('user_id', Auth::id())->value('id_admin');
        }

        // $waktu_dibuat = Carbon::now()->format('d/m/Y H:i');
        // $waktu_diubah = Carbon::now()->format('d/m/Y H:i');

        $waktu_dibuat = Carbon::now('Asia/Jakarta');
        $waktu_diubah = Carbon::now('Asia/Jakarta');

        $status = 'Belum Diverifikasi';
        if (Auth::check() && Auth::user()->peran === 'Admin') {
            $status = 'Disetujui';
        }

        WisataKuliner::create([
            'nama' => $request->nama,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'email' => $request->email ?? null,
            'foto' => $fotoPath,
            'deskripsi' => $request->deskripsi,
            'latitude'  => $request->latitude,
            'longitude' => $request->longitude,
            'penilaian' => 0,
            'email_pengaju' => $email_pengaju,
            'id_wisatawan' => $id_wisatawan ?? null,
            'id_admin' => $id_admin ?? null,
            'status' => $status,
            'waktu_dibuat' => $waktu_dibuat,
            'waktu_diubah' => $waktu_diubah,
        ]);

        return redirect()->route('kelolawisatakuliner')->with('success', 'Wisata Kuliner Berhasil Disimpan');
    }

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

    public function detail($id)
    {
        $wisataKuliner = WisataKuliner::findOrFail($id);

        return response()->json($wisataKuliner);
    }

    public function halamanedit($id)
    {
        $wisataKuliner = WisataKuliner::findOrFail($id);
        return view('admin.kelola-wisata-kuliner.halaman-edit', compact(
            'wisataKuliner',
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:50',
            'kelurahan' => 'required|string|max:50',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|min:10|max:15',
            'email' => 'nullable|email|max:70',
            'deskripsi' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:10240',
            'latitude'  => 'required|numeric|between:-90,90|unique:wisata_kuliner,latitude',
            'longitude' => 'required|numeric|between:-180,180|unique:wisata_kuliner,longitude',
        ]);

        $wisataKuliner = WisataKuliner::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($wisataKuliner->foto && Storage::exists('public/' . $wisataKuliner->foto)) {
                Storage::delete('public/' . $wisataKuliner->foto);
            }

            $fotoPath = $request->file('foto')->storeAs(
                'uploads',
                'foto_' . Str::slug($request->nama) . '_' . time() . '.' . $request->file('foto')->extension(),
                'public'
            );
        }

        $email_pengaju = Auth::user()->email;

        $id_wisatawan = null;
        $id_admin = null;
        if (Auth::check() && Auth::user()->peran === 'Wisatawan') {
            $id_admin = Wisatawan::where('user_id', Auth::id())->value('id_wisatawan');
        } elseif (Auth::check() && Auth::user()->peran === 'Admin') {
            $id_admin = Admin::where('user_id', Auth::id())->value('id_admin');
        }

        $waktu_diubah = Carbon::now('Asia/Jakarta')->format('d/m/Y H:i');

        $status = 'Belum Diverifikasi';
        if (Auth::check() && Auth::user()->peran === 'Admin') {
            $status = 'Disetujui';
        }

        $wisataKuliner->update([
            'nama' => $request->nama,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'email' => $request->email ?? null,
            'foto' => $fotoPath,
            'deskripsi' => $request->deskripsi,
            'latitude'  => $request->latitude,
            'longitude' => $request->longitude,
            'penilaian' => 0,
            'email_pengaju' => $email_pengaju,
            'id_wisatawan' => $id_wisatawan ?? null,
            'id_admin' => $id_admin ?? null,
            'status' => $status,
            'waktu_diubah' => $waktu_diubah,
        ]);

        return redirect()->route('kelolawisatakuliner')->with('success', 'Wisata Kuliner Berhasil Diperbarui');
    }

    public function hapus($id)
    {
        try {

            $wisataKuliner = WisataKuliner::findOrFail($id);

            if ($wisataKuliner->foto && Storage::disk('public')->exists($wisataKuliner->foto)) {
                Storage::disk('public')->delete($wisataKuliner->foto);
            }

            $wisataKuliner->delete();

            return redirect()->back()->with('success', 'Wisata Kuliner berhasil dihapus');
        } catch (Exception $e) {
            Log::error('Error in AdminController@destroy: ' . $e->getMessage());
            return back()->with('error', 'Terjadi Kesalahan Saat Menghapus Wisata Kuliner.');
        }
    }

    public function halamanVerifKuliner()
    {
        $statuswisatakuliner = WisataKuliner::where('status', 'Belum Diverifikasi')->exists();
        $wisataKuliner = WisataKuliner::where('status', 'Belum Diverifikasi')->paginate(5)->withQueryString();;

        $wisataKuliner->getCollection()->transform(function ($item, $key) use ($wisataKuliner) {
            $item->nomor = ($wisataKuliner->currentPage() - 1) * $wisataKuliner->perPage() + $key + 1;
            return $item;
        });

        return view('admin.verifikasi-kuliner.halaman-verifikasi-kuliner', compact(
            'statuswisatakuliner',
            'wisataKuliner',
        ));
    }

    public function detailVerifKuliner($id)
    {
        $wisataKuliner = WisataKuliner::findOrFail($id);

        return response()->json($wisataKuliner);
    }

    public function verifikasiWisataKuliner(Request $request, $id)
    {
        $wisataKuliner = WisataKuliner::findOrFail($id);

        if ($request->status === 'Disetujui') {
            $wisataKuliner->update([
                'status' => 'Disetujui'
            ]);
        }

        if ($request->status === 'Ditolak') {
            $wisataKuliner->update([
                'status' => 'Ditolak'
            ]);
        }

        if ($request->status === 'Tampilkan') {
            $wisataKuliner->update([
                'status' => 'Tampilkan'
            ]);
        }

        // $wisataKuliner->save();

        return response()->json([
            'success' => true,
            'wisataKuliner' => $wisataKuliner,
            'status' => $wisataKuliner->status,
            'message' => 'Status berhasil diperbarui'
        ]);
    }

    public function halamanVerifUlasan()
    {
        $statusUlasan = PenilaiandanUlasan::exists();
        $penilaianDanUlasan = PenilaiandanUlasan::paginate(5)->withQueryString();;

        $penilaianDanUlasan->getCollection()->transform(function ($item, $key) use ($penilaianDanUlasan) {
            $item->nomor = ($penilaianDanUlasan->currentPage() - 1) * $penilaianDanUlasan->perPage() + $key + 1;
            return $item;
        });

        return view('admin.verifikasi-ulasan.halaman-verifikasi-ulasan', compact(
            'statusUlasan',
            'penilaianDanUlasan',
        ));
    }

    public function detailVerifUlasan($id)
    {
        $penilaianDanUlasan = PenilaiandanUlasan::with('wisataKuliner')->findOrFail($id);

        return response()->json($penilaianDanUlasan);
    }

    public function verifikasiUlasan(Request $request, $id)
    {
        $penilaianDanUlasan = PenilaiandanUlasan::findOrFail($id);

        if ($request->status === 'Disetujui') {
            $penilaianDanUlasan->update([
                'status' => 'Disetujui'
            ]);
        }

        if ($request->status === 'Ditolak') {
            $penilaianDanUlasan->update([
                'status' => 'Ditolak'
            ]);
        }

        // if ($request->status === 'Tampilkan') {
        //     $penilaianDanUlasan->update([
        //         'status' => 'Tampilkan'
        //     ]);
        // }

        // $wisataKuliner->save();

        return response()->json([
            'success' => true,
            'wisataKuliner' => $penilaianDanUlasan,
            'status' => $penilaianDanUlasan->status,
            'message' => 'Status berhasil diperbarui'
        ]);
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

    //     if ($request->status === 'Tampilkan') {
    //         $wisataKuliner->update([
    //             'status' => 'Tampilkan'
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
