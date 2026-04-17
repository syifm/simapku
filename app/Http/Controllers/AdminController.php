<?php

namespace App\Http\Controllers;

use App\Models\PenilaiandanUlasan;
use App\Models\WisataKuliner;
use App\Models\Wisatawan;
use App\Models\Admin;
use App\Models\Fasilitas;
use App\Models\FasilitasWisataKuliner;
use App\Models\Kategori;
use App\Models\KategoriWisataKuliner;
use App\Models\PengajuanWisataKuliner;
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
    // Beranda 
    public function berandaAdmin()
    {
        $wkulinerBelumDiverifikasi = WisataKuliner::where('status', 'Belum Diverifikasi')
            ->count();

        $wkulinerDisetujui = WisataKuliner::where('status', 'Disetujui')
            ->count();

        $wkulinerDitolak = WisataKuliner::where('status', 'Ditolak')
            ->count();

        $wkulinerDitampilkan = WisataKuliner::where('status', 'Ditampilkan')
            ->count();

        $totalWisataKuliner = $wkulinerBelumDiverifikasi + $wkulinerDisetujui + $wkulinerDitolak + $wkulinerDitampilkan;
        $persentaseWkulinerBelumDiverifikasi = $totalWisataKuliner > 0 ? ($wkulinerBelumDiverifikasi / $totalWisataKuliner) * 100 : 0;
        $persentaseWkulinerDisetujui = $totalWisataKuliner > 0 ? ($wkulinerDisetujui / $totalWisataKuliner) * 100 : 0;
        $persentaseWkulinerDitolak = $totalWisataKuliner > 0 ? ($wkulinerDitolak / $totalWisataKuliner) * 100 : 0;
        $persentaseWkulinerDitampilkan = $totalWisataKuliner > 0 ? ($wkulinerDitampilkan / $totalWisataKuliner) * 100 : 0;

        $ulasanBelumDiverifikasi = PenilaiandanUlasan::where('status', 'Belum Diverifikasi')
            ->count();

        $ulasanDisetujui = PenilaiandanUlasan::where('status', 'Disetujui')
            ->count();

        $ulasanDitolak = PenilaiandanUlasan::where('status', 'Ditolak')
            ->count();

        $ulasanDitampilkan = PenilaiandanUlasan::where('status', 'Ditampilkan')
            ->count();

        $totalUlasan = $ulasanBelumDiverifikasi + $ulasanDisetujui + $ulasanDitolak;
        $persentaseUlasanBelumDiverifikasi = $totalUlasan > 0 ? ($ulasanBelumDiverifikasi / $totalUlasan) * 100 : 0;
        $persentaseUlasanDisetujui = $totalUlasan > 0 ? ($ulasanDisetujui / $totalUlasan) * 100 : 0;
        $persentaseUlasanDitolak = $totalUlasan > 0 ? ($ulasanDitolak / $totalUlasan) * 100 : 0;

        return view('admin.beranda', compact(
            'wkulinerBelumDiverifikasi',
            'wkulinerDisetujui',
            'wkulinerDitolak',
            'wkulinerDitampilkan',
            'totalWisataKuliner',
            'persentaseWkulinerBelumDiverifikasi',
            'persentaseWkulinerDisetujui',
            'persentaseWkulinerDitolak',
            'persentaseWkulinerDitampilkan',
            'ulasanBelumDiverifikasi',
            'ulasanDisetujui',
            'ulasanDitolak',
            'totalUlasan',
            'persentaseUlasanBelumDiverifikasi',
            'persentaseUlasanDisetujui',
            'persentaseUlasanDitolak',
        ));
    }

    // Kelola Wisata Kuliner
    // Halaman Awal (Kelola Wisata Kuliner)
    public function kelolaWisataKuliner()
    {
        $statuswisatakuliner = WisataKuliner::whereIn('status', ['Disetujui', 'Ditampilkan'])->exists();
        $wisataKuliner = WisataKuliner::whereIn('status', ['Disetujui', 'Ditampilkan'])
            ->orderByRaw("
                CASE 
                    WHEN status = 'Disetujui' THEN 1
                    WHEN status = 'Ditampilkan' THEN 2
                    ELSE 3
                END
            ")
            ->orderBy('waktu_diubah', 'desc')
            ->paginate(10)
            ->withQueryString();

        $wisataKuliner->getCollection()->transform(function ($item, $key) use ($wisataKuliner) {
            $item->nomor = ($wisataKuliner->currentPage() - 1) * $wisataKuliner->perPage() + $key + 1;
            return $item;
        });

        return view('admin.kelola-wisata-kuliner.halaman-awal', compact(
            'statuswisatakuliner',
            'wisataKuliner',
        ));
    }

    // Halaman Tambah Wisata Kuliner (Kelola Wisata Kuliner)
    public function halamantambah()
    {
        $wkuliner = WisataKuliner::where('status', ['Disetujui', 'Ditampilkan'])->get();
        return view('admin.kelola-wisata-kuliner.halaman-tambah', compact(
            'wkuliner'
        ));
    }

    // Simpan Wisata Kuliner (Kelola Wisata Kuliner)
    public function simpan(Request $request)
    {
        $request->validate([
            'nama_wisata_kuliner' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:50',
            'kelurahan' => 'required|string|max:50',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|min:10|max:15',
            'email' => 'nullable|email|max:70',
            'deskripsi' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:10240',
            'latitude'  => 'required|numeric|between:-90,90|unique:wisata_kuliner,latitude',
            'longitude' => 'required|numeric|between:-180,180|unique:wisata_kuliner,longitude',
        ], [
            'nama_wisata_kuliner.required' => 'Nama wisata kuliner harus diisi.',
            'kecamatan' => 'Kecamatan harus diisi.',
            'kelurahan' => 'Kelurahan harus diisi.',
            'alamat' => 'Alamat harus diisi.',
            'no_telp' => 'Nomor telepon harus diisi.',
            'deskripsi' => 'Deskripsi harus diisi.',
            'foto' => 'Foto harus diisi.',
            'latitude'  => 'Latitude harus diisi.',
            'longitude' => 'Longitude harus diisi.',
        ],);

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
            $id_admin = Wisatawan::where('user_id', Auth::id())->value('id_wisatawan');
        } elseif (Auth::check() && Auth::user()->peran === 'Admin') {
            $id_admin = Admin::where('user_id', Auth::id())->value('id_admin');
        }

        $waktu_dibuat = Carbon::now('Asia/Jakarta');
        $waktu_diubah = Carbon::now('Asia/Jakarta');

        $status = 'Belum Diverifikasi';
        if (Auth::check() && Auth::user()->peran === 'Admin') {
            $status = 'Disetujui';
        }

        $dataMK = $request->id_fasilitas ?? [];
        $dataKategori = $request->id_kategori ?? [];
        $idWisata = $request->nama_wisata_kuliner;

        if (!is_numeric($idWisata)) {

            $wisata = WisataKuliner::firstOrCreate([
                'nama' => trim($idWisata),
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'email' => $request->email ?? null,
                'foto' => $fotoPath,
                'deskripsi' => $request->deskripsi,
                'latitude'  => $request->latitude,
                'longitude' => $request->longitude,
                'harga_min' => 0,
                'harga_max' => 0,
                'penilaian' => 0,
                'email_pengaju' => $email_pengaju,
                'id_wisatawan' => $id_wisatawan ?? null,
                'id_admin' => $id_admin ?? null,
                'status' => $status,
                'waktu_dibuat' => $waktu_dibuat,
                'waktu_diubah' => $waktu_diubah,
            ]);

            $idWisata = $wisata->id_wisata_kuliner;
        }

        // Fasilitas
        $fasilitasIds = [];

        foreach ($dataMK as $item) {

            if (is_numeric($item)) {
                $fasilitasId = $item;
            } else {

                $fasilitas = Fasilitas::firstOrCreate([
                    'nama' => trim($item)
                ]);

                $fasilitasId = $fasilitas->id_fasilitas;
            }

            $fasilitasIds[] = $fasilitasId;
        }

        $wisata = WisataKuliner::find($idWisata);

        $wisata->fasilitas()->sync($fasilitasIds);

        // Kategori
        $kategoriIds = [];

        foreach ($dataKategori as $item) {

            if (is_numeric($item)) {
                $kategoriId = $item;
            } else {

                $kategori = Kategori::firstOrCreate([
                    'nama' => trim($item),
                    'status' => 'Disetujui',
                ]);

                $kategoriId = $kategori->id_kategori;
            }

            $kategoriIds[] = $kategoriId;
        }

        $wisata = WisataKuliner::find($idWisata);

        $wisata->kategori()->sync($kategoriIds);

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
        $wisataKuliner = WisataKuliner::with(['fasilitas', 'kategori'])->findOrFail($id);

        return response()->json($wisataKuliner);
    }

    public function halamanedit($id)
    {
        $wisataKuliner = WisataKuliner::findOrFail($id);
        $wkuliner = WisataKuliner::where('status', ['Disetujui', 'Ditampilkan'])->get();
        $fasilitas = FasilitasWisataKuliner::with('fasilitas')
            ->where('id_wisata_kuliner', $id)
            ->get();
        $kategori = KategoriWisataKuliner::with('kategori')
            ->where('id_wisata_kuliner', $id)
            ->get();
        return view('admin.kelola-wisata-kuliner.halaman-edit', compact(
            'wisataKuliner',
            'fasilitas',
            'kategori',
            'wkuliner'
        ));
    }

    public function update(Request $request, $id)
    {
        try {
            $wisataKuliner = WisataKuliner::findOrFail($id);
            // dd($request->all());

            $request->validate([
                'nama' => 'required|string|max:255',
                'kecamatan' => 'required|string|max:50',
                'kelurahan' => 'required|string|max:50',
                'alamat' => 'required|string',
                'no_telp' => 'required|string|min:10|max:15',
                'email' => 'nullable|email|max:70',
                'deskripsi' => 'required|string|max:255',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
                'latitude'  => 'required|numeric|between:-90,90',
                Rule::unique('wisata_kuliner')->ignore($wisataKuliner->id),
                'longitude' => 'required|numeric|between:-180,180',
                Rule::unique('wisata_kuliner')->ignore($wisataKuliner->id),
            ]);

            // dd("LOLOS VALIDASI");

            $fotoPath = $wisataKuliner->foto;

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

            $waktu_diubah = Carbon::now('Asia/Jakarta');

            $status = 'Belum Diverifikasi';
            if (Auth::check() && Auth::user()->peran === 'Admin') {
                $status = 'Disetujui';
            }

            $dataMK = $request->id_fasilitas ?? [];
            $dataKategori = $request->id_kategori ?? [];
            $idWisata = $request->nama;

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

            $idWisata = $wisataKuliner->id_wisata_kuliner;

            // Fasilitas
            $fasilitasIds = [];

            foreach ($dataMK as $item) {

                if (is_numeric($item)) {
                    $fasilitasId = $item;
                } else {

                    $fasilitas = Fasilitas::firstOrCreate([
                        'nama' => trim($item)
                    ]);

                    $fasilitasId = $fasilitas->id_fasilitas;
                }

                $fasilitasIds[] = $fasilitasId;
            }

            $wisata = WisataKuliner::find($idWisata);

            $wisata->fasilitas()->sync($fasilitasIds);

            // Kategori
            $kategoriIds = [];

            foreach ($dataKategori as $item) {

                if (is_numeric($item)) {
                    $kategoriId = $item;
                } else {

                    $kategori = Kategori::firstOrCreate([
                        'nama' => trim($item)
                    ]);

                    $kategoriId = $kategori->id_kategori;
                }

                $kategoriIds[] = $kategoriId;
            }

            $wisata = WisataKuliner::find($idWisata);

            $wisata->kategori()->sync($kategoriIds);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

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
        $statuswisatakuliner = PengajuanWisataKuliner::whereIn('status', ['Belum Diverifikasi', 'Ditolak'])->exists();
        // $wisataKuliner = WisataKuliner::whereIn('status', ['Belum Diverifikasi', 'Ditolak'])->paginate(10)->withQueryString();
        $wisataKuliner = PengajuanWisataKuliner::whereIn('status', ['Belum Diverifikasi', 'Ditolak'])
            ->orderByRaw("
                CASE 
                    WHEN status = 'Belum Diverifikasi' THEN 1
                    WHEN status = 'Ditolak' THEN 2
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

    public function detailVerifKuliner($id)
    {
        $wisataKuliner = WisataKuliner::with(['fasilitas', 'kategori'])->findOrFail($id);
        $pengajuanwk = PengajuanWisataKuliner::with(['fasilitas', 'kategori'])->findOrFail($id);

        return response()->json([
            'lama' => $wisataKuliner,
            'baru' => $pengajuanwk
        ]);
    }

    public function verifikasiWisataKuliner(Request $request, $id)
    {
        $wisataKuliner = WisataKuliner::findOrFail($id);

        $waktu_diubah = Carbon::now('Asia/Jakarta');

        if ($request->status === 'Disetujui') {
            $wisataKuliner->update([
                'status' => 'Disetujui',
                'waktu_diubah' => $waktu_diubah,
            ]);
        }

        if ($request->status === 'Ditolak') {
            $wisataKuliner->update([
                'status' => 'Ditolak',
                'waktu_diubah' => $waktu_diubah,
            ]);
        }

        if ($request->status === 'Ditampilkan') {
            $wisataKuliner->update([
                'status' => 'Ditampilkan',
                'waktu_diubah' => $waktu_diubah,
            ]);
        }

        return response()->json([
            'success' => true,
            'wisataKuliner' => $wisataKuliner,
            'status' => $wisataKuliner->status,
            'message' => 'Status berhasil diperbarui'
        ]);
    }

    public function tampilkanWisataKuliner(Request $request, $id)
    {
        $wisataKuliner = WisataKuliner::findOrFail($id);

        $waktu_diubah = Carbon::now('Asia/Jakarta');

        if ($request->status === 'Ditampilkan') {
            $wisataKuliner->update([
                'status' => 'Ditampilkan',
                'waktu_diubah' => $waktu_diubah,
            ]);
        }

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
        // $penilaianDanUlasan = PenilaiandanUlasan::paginate(10)->withQueryString();
        $penilaianDanUlasan = PenilaiandanUlasan::orderByRaw("
                CASE 
                    WHEN status = 'Belum Diverifikasi' THEN 1
                    WHEN status = 'Disetujui' THEN 2
                    WHEN status = 'Ditolak' THEN 3
                END
            ")
            ->orderBy('waktu_diubah', 'desc')
            ->paginate(10)
            ->withQueryString();

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
        $waktu_diubah = Carbon::now('Asia/Jakarta');

        if ($request->status === 'Disetujui') {
            $penilaianDanUlasan->update([
                'status' => 'Disetujui',
                'waktu_diubah' => $waktu_diubah,
            ]);
        }

        if ($request->status === 'Ditolak') {
            $penilaianDanUlasan->update([
                'status' => 'Ditolak',
                'waktu_diubah' => $waktu_diubah,
            ]);
        }

        // if ($request->status === 'Ditampilkan') {
        //     $penilaianDanUlasan->update([
        //         'status' => 'Ditampilkan'
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

    public function hapusUlasan($id)
    {
        try {

            $ulasan = PenilaiandanUlasan::findOrFail($id);

            if ($ulasan->foto && Storage::disk('public')->exists($ulasan->foto)) {
                Storage::disk('public')->delete($ulasan->foto);
            }

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
        $data = Fasilitas::where('nama', 'LIKE', '%' . request('q') . '%')
            ->paginate(10);

        return response()->json($data);
    }

    public function selectkategori($id)
    {
        $data = Kategori::where('nama', 'LIKE', '%' . request('q') . '%')
            ->paginate(10);

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

    //     if ($request->status === 'Ditampilkan') {
    //         $wisataKuliner->update([
    //             'status' => 'Ditampilkan'
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
