<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wisatawan;
use App\Models\Admin;
use App\Models\WisataKuliner;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class UlasanController extends Controller
{
    public function tampilkanKelolaUlasan()
    {
        // $ulasankuliner = Ulasan::where('status_penampilan', 'Tampil')
        //     ->orderBy('waktu_diubah', 'desc')
        //     ->paginate(10)
        //     ->withQueryString();
        $terbaru = Ulasan::where('status', 'Disetujui')
            ->selectRaw('MAX(id_ulasan) as id_ulasan')
            ->groupBy('id_wisatawan', 'id_wisata_kuliner')
            ->pluck('id_ulasan');

        $ulasankuliner = Ulasan::whereIn('id_ulasan', $terbaru)
            ->orderByDesc('waktu_diubah')
            ->paginate(10)
            ->withQueryString();

        $ulasankuliner->getCollection()->transform(function ($item, $key) use ($ulasankuliner) {
            $item->nomor = ($ulasankuliner->currentPage() - 1) * $ulasankuliner->perPage() + $key + 1;
            return $item;
        });

        return view('admin.kelola-ulasan.halaman-ulasan', compact(
            'ulasankuliner',
        ));
    }

    public function tampilkanDetailUlasan(int $id)
    {
        $ulasan = Ulasan::with([
            'wisatawan.user',
            'wisataKuliner'
        ])->findOrFail($id);

        if ($ulasan->id_ulasan) {
            $pengulas = $ulasan->wisatawan->user;
        }

        return response()->json([
            'nama_pengulas' => $pengulas->nama,
            'email' => $pengulas->email,
            'penilaian' => $ulasan->penilaian,
            'ulasan' => $ulasan->ulasan,
            'foto_ulasan' => $ulasan->foto_ulasan,
            'harga_min' => $ulasan->harga_min,
            'harga_max' => $ulasan->harga_max,
            'status' => $ulasan->status,
            'id_ulasan' => $ulasan->id_ulasan,
            'wisata_kuliner' => $ulasan->wisataKuliner,
        ]);
    }

    public function ubahStatusPenampilan(int $id, Request $request)
    {
        $ulasan = Ulasan::findOrFail($id);

        $ulasan->update([
            'status_penampilan' => $request->status,
            'waktu_diubah' => Carbon::now('Asia/Jakarta'),
        ]);

        $ulasanKuliner = Ulasan::where('id_wisata_kuliner', $ulasan->id_wisata_kuliner)
            ->where('status', 'Disetujui')
            ->where('status_penampilan', 'Tampil');
        $wisataKuliner = WisataKuliner::findOrFail($ulasan->id_wisata_kuliner);

        $wisataKuliner->update([
            'harga_min' => $ulasanKuliner->min('harga_min'),
            'harga_max' => $ulasanKuliner->max('harga_max'),
            'penilaian' => $ulasanKuliner->avg('penilaian'),
            'waktu_diubah' => Carbon::now('Asia/Jakarta'),
        ]);

        return response()->json([
            'message' => 'Status penampilan berhasil diperbarui',
            'status' => $ulasan->status_penampilan
        ]);
    }

    public function tampilkanDetailVerifUlasan(int $id)
    {
        $ulasan = Ulasan::with([
            'wisatawan.user',
            'wisataKuliner'
        ])->findOrFail($id);

        if ($ulasan->id_ulasan) {
            $pengulas = $ulasan->wisatawan->user;
        }

        return response()->json([
            'nama_pengulas' => $pengulas->nama,
            'email' => $pengulas->email,
            'penilaian' => $ulasan->penilaian,
            'ulasan' => $ulasan->ulasan,
            'foto_ulasan' => $ulasan->foto_ulasan,
            'harga_min' => $ulasan->harga_min,
            'harga_max' => $ulasan->harga_max,
            'status' => $ulasan->status,
            'id_ulasan' => $ulasan->id_ulasan,
            'wisata_kuliner' => $ulasan->wisataKuliner,
        ]);
    }

    public function verifikasiUlasan(Request $request, int $id)
    {
        $ulasan = Ulasan::findOrFail($id);
        $waktu_diubah = Carbon::now('Asia/Jakarta');

        $wisataKuliner = WisataKuliner::findOrFail($ulasan->id_wisata_kuliner);
        $ulasanKuliner = Ulasan::where('id_wisata_kuliner', $ulasan->id_wisata_kuliner)
            ->where('status', 'Disetujui')
            ->where('status_penampilan', 'Tampil');

        Ulasan::where('id_wisatawan', $ulasan->id_wisatawan)
            ->where('id_wisata_kuliner', $ulasan->id_wisata_kuliner)
            ->where('status', 'Disetujui')
            ->where('status_penampilan', 'Tampil')
            ->update([
                'status_penampilan' => 'Tidak Tampil',
                'waktu_diubah' => $waktu_diubah,
            ]);

        if ($request->status === 'Setujui') {
            $ulasan->update([
                'status' => 'Disetujui',
                'status_penampilan' => 'Tampil',
                'waktu_diubah' => $waktu_diubah,
            ]);

            $wisataKuliner->update([
                'harga_min' => $ulasanKuliner->min('harga_min'),
                'harga_max' => $ulasanKuliner->max('harga_max'),
                'penilaian' => $ulasanKuliner->avg('penilaian'),
                'waktu_diubah' => $waktu_diubah,
            ]);
        } else {
            $ulasan->update([
                'status' => 'Ditolak',
                'waktu_diubah' => $waktu_diubah,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Ulasan berhasil diverifikasi',
        ]);
    }

    public function tampilkanFormUlasan($id)
    {
        // $user = Auth::user();
        // $wisatawan = $user
        //     ? Wisatawan::where('user_id', $user->id)->first()
        //     : null;

        // $ulasan = Ulasan::where('id_wisata_kuliner', $id)
        //     ->where('status', 'Disetujui')
        //     ->where(function ($q) use ($wisatawan, $user) {

        //         if ($wisatawan) {
        //             $q->where('id_wisatawan', $wisatawan->id_wisatawan);
        //         }

        //         if ($user && $user->email) {
        //             $q->orWhere('email_pengulas', $user->email);
        //         }
        //     })
        //     ->orderBy('waktu_diubah', 'desc')
        //     ->first();

        // return response()->json($ulasan);
        $id_wisatawan = Wisatawan::where('user_id', Auth::id())
            ->value('id_wisatawan');

        $ulasan = Ulasan::where('id_wisata_kuliner', $id)
            ->where('id_wisatawan', $id_wisatawan)
            ->where('status', 'Belum Diverifikasi')
            ->latest('waktu_diubah')
            ->first();

        if (!$ulasan) {
            $ulasan = Ulasan::where('id_wisata_kuliner', $id)
                ->where('id_wisatawan', $id_wisatawan)
                ->where('status', 'Ditolak')
                ->latest('waktu_diubah')
                ->first();
        }

        if (!$ulasan) {
            $ulasan = Ulasan::where('id_wisata_kuliner', $id)
                ->where('id_wisatawan', $id_wisatawan)
                ->where('status', 'Disetujui')
                ->where('status_penampilan', 'Tampil')
                ->latest('waktu_diubah')
                ->first();
        }

        return response()->json($ulasan);
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'id_wisata_kuliner' => 'required|integer',
            'penilaian' => 'required|integer|max:5',
            'ulasan' => 'required|string',
            'foto_ulasan' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $fotoPath = null;

        if ($request->hasFile('foto_ulasan')) {
            $fotoPath = $request->file('foto_ulasan')->storeAs(
                'uploads',
                'foto_ulasan_' . time() . '.' . $request->file('foto_ulasan')->extension(),
                'public'
            );
        }

        $id_wisatawan = Wisatawan::where('user_id', Auth::id())->value('id_wisatawan');

        $waktu_dibuat = Carbon::now('Asia/Jakarta');
        $waktu_diubah = Carbon::now('Asia/Jakarta');


        // $range = explode('-', $request->harga_per_orang);
        // $hargaperorangnya = $request->harga_per_orang;

        // // $min = $range[0] ?? null;
        // // $max = $range[1] ?? null;

        // if (str_contains($hargaperorangnya, '+')) {
        //     $min = (int) str_replace('+', '', $hargaperorangnya);
        //     $max = null;
        // } elseif (str_contains($hargaperorangnya, '-')) {
        //     [$min, $max] = explode('-', $hargaperorangnya);

        //     $min = (int) $min;
        //     $max = (int) $max;
        // }

        $ulasan = null;

        $ulasan = Ulasan::where('id_wisata_kuliner', $request->id_wisata_kuliner)
            ->where('id_wisatawan', $id_wisatawan)
            ->orderBy('waktu_diubah', 'desc')
            ->first();

        $min = $request->minhargaulasan;
        $max = $request->maxhargaulasan;
        // if ($ulasan) {
        //     dd($ulasan->penilaian);
        // } else {
        // dd('data tidak ditemukan');
        // }

        if ($ulasan) {
            $ulasan->fill([
                'penilaian' => $request->penilaian,
                'ulasan' => trim($request->ulasan),
                'foto_ulasan' => $fotoPath ?? $ulasan->foto_ulasan,
                'harga_min' => $min ?? null,
                'harga_max' => $max ?? null,
            ]);
            if (!$ulasan->isDirty()) {
                return response()->json([
                    'status' => 'info',
                    'message' => 'Tidak terdapat perubahan'
                ]);
            }
        }

        //     $ulasan->update([
        //         'penilaian' => $request->penilaian,
        //         'ulasan' => $request->ulasan,
        //         'foto_ulasan' => $fotoPath ?? $ulasan->foto_ulasan,
        //         'harga_min' => $min ?? null,
        //         'harga_max' => $max ?? null,
        //         'waktu_diubah' => $waktu_diubah,
        //     ]);

        //     if ($ulasan->status == 'Ditolak' || $ulasan->status == 'Disetujui') {
        //         $ulasan->update([
        //             'status' => 'Belum Diverifikasi',
        //         ]);
        //     }

        //     return response()->json([
        //         'status' => 'Diperbarui',
        //         'message' => 'Ulasan berhasil diperbarui'
        //     ]);
        // } else {
        Ulasan::create([
            'id_wisata_kuliner' => $request->id_wisata_kuliner,
            'penilaian' => $request->penilaian,
            'ulasan' => $request->ulasan,
            'foto_ulasan' => $fotoPath ?? ($ulasan->foto_ulasan ?? null),
            'harga_min' => $min ?? null,
            'harga_max' => $max ?? null,
            'id_wisatawan' => $id_wisatawan,
            'id_admin' => null,
            'status' => 'Belum Diverifikasi',
            'status_penampilan' => 'Tidak Tampil',
            'waktu_dibuat' => $waktu_dibuat,
            'waktu_diubah' => $waktu_diubah,
        ]);
        // }

        // $wisataKuliner = WisataKuliner::findOrFail($request->id_wisata_kuliner);
        // $min_total = Ulasan::where('id_wisata_kuliner', $request->id_wisata_kuliner)->min('harga_min');
        // $max_total = Ulasan::where('id_wisata_kuliner', $request->id_wisata_kuliner)->max('harga_max');
        // $penilaian_ratarata = Ulasan::where('id_wisata_kuliner', $request->id_wisata_kuliner)->avg('penilaian');
        // $wisataKuliner->update([
        //     'harga_min' => $min_total,
        //     'harga_max' => $max_total,
        //     'penilaian' => $penilaian_ratarata,
        //     'waktu_diubah' => $waktu_diubah,
        // ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function detail($id)
    {
        // $userId = Auth::id();
        // $id_wisatawan = Wisatawan::where('user_id', $userId)->value('id_wisatawan');

        // $ulasan = Ulasan::where('id_wisata_kuliner', $id)
        //     ->where('status', 'Disetujui')
        //     ->orderBy('waktu_diubah', 'desc')
        //     ->get()
        //     ->map(function ($item) use ($id_wisatawan) {
        //         return [
        //             'penilaian' => $item->penilaian,
        //             'ulasan' => $item->ulasan,
        //             'foto_ulasan' => $item->foto_ulasan,
        //             'waktu_diubah' => $item->waktu_diubah,
        //             'nama' => $item->wisatawan->nama ?? null,
        //             'punya_sendiri' => $item->id_wisatawan == $id_wisatawan
        //         ];
        //     });


        $userId = Auth::id();
        $id_wisatawan = Wisatawan::where('user_id', $userId)->value('id_wisatawan');

        $ulasan = Ulasan::where('id_wisata_kuliner', $id)
            ->where('status_penampilan', 'Tampil')
            ->orderBy('waktu_dibuat', 'desc')
            ->take(1)
            ->get()
            ->map(function ($item) use ($id_wisatawan) {
                $punyaSendiri =
                    ($id_wisatawan && $item->id_wisatawan == $id_wisatawan);

                return [
                    'id_ulasan' => $item->id_ulasan,
                    'penilaian' => $item->penilaian,
                    'ulasan' => $item->ulasan,
                    'foto_ulasan' => $item->foto_ulasan,
                    'waktu_dibuat' => $item->waktu_dibuat,
                    'nama' => $punyaSendiri ? 'Anda' : ($item->wisatawan->user->nama ?? null),
                    'punya_sendiri' => $punyaSendiri
                ];
            });
        // $user = Auth::user();

        // $ulasan = Ulasan::where('id_wisata_kuliner', $id)
        //     ->where('status', 'Disetujui');

        // if ($user) {

        //     $wisatawan = Wisatawan::where('user_id', $user->id)->first();

        //     $ulasan->where(function ($q) use ($wisatawan, $user) {

        //         if ($wisatawan) {
        //             $q->where('id_wisatawan', $wisatawan->id_wisatawan);
        //         }

        //         $q->orWhereHas('wisatawan', function ($q2) use ($user) {
        //             $q2->where('email_pengulas', $user->email);
        //         });
        //     });
        // }

        return response()->json($ulasan);
    }

    public function hapus($id)
    {
        $ulasan = Ulasan::findOrFail($id);

        $idWisatawan = $ulasan->id_wisatawan;
        $idKuliner = $ulasan->id_wisata_kuliner;

        $daftarUlasan = Ulasan::where('id_wisatawan', $idWisatawan)
            ->where('id_wisata_kuliner', $idKuliner)
            ->get();

        foreach ($daftarUlasan as $item) {
            if ($item->foto_ulasan) {
                Storage::disk('public')->delete($item->foto_ulasan);
            }
        }

        Ulasan::where('id_wisatawan', $idWisatawan)
            ->where('id_wisata_kuliner', $idKuliner)
            ->delete();

        return response()->json([
            'message' => 'Ulasan Berhasil Dihapus'
        ]);
    }


    // public function detail($id)
    // {
    //     $userId = Auth::id();
    //     $id_wisatawan = Wisatawan::where('user_id', $userId)->value('id_wisatawan');

    //     $ulasan = Ulasan::where('id_wisata_kuliner', $id)
    //         ->where('status', 'Disetujui')
    //         ->orderBy('waktu_diubah', 'desc')
    //         ->get()
    //         ->map(function ($item) use ($id_wisatawan) {
    //             return [
    //                 'penilaian' => $item->penilaian,
    //                 'ulasan' => $item->ulasan,
    //                 'foto_ulasan' => $item->foto_ulasan,
    //                 'waktu_diubah' => $item->waktu_diubah,
    //                 'nama' => $item->wisatawan->nama ?? null,
    //                 'punya_sendiri' => $item->id_wisatawan == $id_wisatawan
    //             ];
    //         });
    //     // $user = Auth::user();

    //     // $ulasan = Ulasan::where('id_wisata_kuliner', $id)
    //     //     ->where('status', 'Disetujui');

    //     // if ($user) {

    //     //     $wisatawan = Wisatawan::where('user_id', $user->id)->first();

    //     //     $ulasan->where(function ($q) use ($wisatawan, $user) {

    //     //         if ($wisatawan) {
    //     //             $q->where('id_wisatawan', $wisatawan->id_wisatawan);
    //     //         }

    //     //         $q->orWhereHas('wisatawan', function ($q2) use ($user) {
    //     //             $q2->where('email_pengulas', $user->email);
    //     //         });
    //     //     });
    //     // }

    //     return response()->json($ulasan);
    // }





    // Wisatawan Tidak Login
    // public function simpanTidakLogin(Request $request)
    // {
    //     $request->validate([
    //         'id_wisata_kuliner' => 'required|integer',
    //         'penilaian' => 'required|integer|max:5',
    //         'ulasan' => 'required|string',
    //         'foto_ulasan' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
    //         'email_pengulas' => 'nullable|email|max:70',
    //     ]);

    //     $fotoPath = null;

    //     if ($request->hasFile('foto_ulasan')) {
    //         $fotoPath = $request->file('foto_ulasan')->storeAs(
    //             'uploads',
    //             'foto_ulasan_' . time() . '.' . $request->file('foto_ulasan')->extension(),
    //             'public'
    //         );
    //     }

    //     $email_pengulas = $request->email_pengulas;

    //     $id_wisatawan = null;
    //     $id_admin = null;

    //     $waktu_dibuat = Carbon::now('Asia/Jakarta');
    //     $waktu_diubah = Carbon::now('Asia/Jakarta');

    //     if (Auth::check() && Auth::user()->peran === 'Wisatawan') {
    //         $id_wisatawan = Wisatawan::where('user_id', Auth::id())->value('id_wisatawan');
    //     } elseif (Auth::check() && Auth::user()->peran === 'Admin') {
    //         $id_admin = Admin::where('user_id', Auth::id())->value('id_admin');
    //     }

    //     $range = explode('-', $request->harga_per_orang);

    //     $min = $range[0] ?? null;
    //     $max = $range[1] ?? null;

    //     $ulasan = null;

    //     if ($id_wisatawan) {
    //         $ulasan = Ulasan::where('id_wisata_kuliner', $request->id_wisata_kuliner)
    //             ->where('id_wisatawan', $id_wisatawan)
    //             ->first();
    //     }

    //     // if ($ulasan) {
    //     //     $ulasan->update([
    //     //         'penilaian' => $request->penilaian,
    //     //         'ulasan' => $request->ulasan,
    //     //         'foto_ulasan' => $fotoPath ?? $ulasan->foto_ulasan,
    //     //         'harga_min' => $min,
    //     //         'harga_max' => $max,
    //     //         'waktu_diubah' => $waktu_diubah,
    //     //     ]);

    //     //     return response()->json([
    //     //         'status' => 'Diperbarui',
    //     //         'message' => 'Ulasan berhasil diperbarui'
    //     //     ]);
    //     // } else {
    //     //     Ulasan::create([
    //     //         'id_wisata_kuliner' => $request->id_wisata_kuliner,
    //     //         'penilaian' => $request->penilaian,
    //     //         'ulasan' => $request->ulasan,
    //     //         'foto_ulasan' => $fotoPath,
    //     //         'harga_min' => $min,
    //     //         'harga_max' => $max,
    //     //         'email_pengulas' => $email_pengulas,
    //     //         'id_wisatawan' => $id_wisatawan ?? null,
    //     //         'id_admin' => $id_admin ?? null,
    //     //         'status' => 'Belum Diverifikasi',
    //     //         'waktu_dibuat' => $waktu_dibuat,
    //     //         'waktu_diubah' => $waktu_diubah,
    //     //     ]);
    //     // }
    //     Ulasan::updateOrCreate(
    //         [
    //             'id_wisata_kuliner' => $request->id_wisata_kuliner,
    //             'email_pengulas' => $request->email_pengulas,
    //         ],
    //         [
    //             'penilaian' => $request->penilaian,
    //             'ulasan' => $request->ulasan,
    //             'foto_ulasan' => $fotoPath ?? $ulasan->foto_ulasan,
    //             'harga_min' => $min,
    //             'harga_max' => $max,
    //             'status' => 'Belum Diverifikasi',
    //             'waktu_dibuat' => $waktu_dibuat,
    //             'waktu_diubah' => $waktu_diubah,
    //         ]
    //     );

    //     $wisataKuliner = WisataKuliner::findOrFail($request->id_wisata_kuliner);
    //     $min_total = Ulasan::where('id_wisata_kuliner', $request->id_wisata_kuliner)->min('harga_min');
    //     $max_total = Ulasan::where('id_wisata_kuliner', $request->id_wisata_kuliner)->max('harga_max');
    //     $penilaian_ratarata = Ulasan::where('id_wisata_kuliner', $request->id_wisata_kuliner)->avg('penilaian');
    //     $wisataKuliner->update([
    //         'harga_min' => $min_total,
    //         'harga_max' => $max_total,
    //         'penilaian' => $penilaian_ratarata,
    //         'waktu_diubah' => $waktu_diubah,
    //     ]);

    //     return response()->json([
    //         'status' => 'success'
    //     ]);
    // }

    // public function detailTidakLogin($id)
    // {
    //     $userId = Auth::id();
    //     $id_wisatawan = Wisatawan::where('user_id', $userId)->value('id_wisatawan');

    //     $ulasan = Ulasan::where('id_wisata_kuliner', $id)
    //         ->where('status', 'Disetujui')
    //         ->orderBy('waktu_diubah', 'desc')
    //         ->get()
    //         ->map(function ($item) use ($id_wisatawan) {
    //             return [
    //                 'penilaian' => $item->penilaian,
    //                 'ulasan' => $item->ulasan,
    //                 'foto_ulasan' => $item->foto_ulasan,
    //                 'waktu_diubah' => $item->waktu_diubah,
    //                 'nama' => $item->wisatawan->nama ?? null,
    //                 'punya_sendiri' => $item->id_wisatawan == $id_wisatawan
    //             ];
    //         });

    //     return response()->json($ulasan);
    // }
    public function detailTidakLogin($id)
    {
        $userId = Auth::id();

        $id_wisatawan = null;

        if ($userId) {
            $id_wisatawan = Wisatawan::where('user_id', $userId)
                ->value('id_wisatawan');
        }

        $ulasan = Ulasan::where('id_wisata_kuliner', $id)
            ->where('status', 'Disetujui')
            ->orderBy('waktu_diubah', 'desc')
            ->get()
            ->map(function ($item) use ($id_wisatawan, $userId) {
                return [
                    'penilaian' => $item->penilaian,
                    'ulasan' => $item->ulasan,
                    'foto_ulasan' => $item->foto_ulasan,
                    'waktu_diubah' => $item->waktu_diubah,
                    'nama' => $item->wisatawan->nama ?? null,

                    'punya_sendiri' => $userId
                        ? $item->id_wisatawan == $id_wisatawan
                        : false
                ];
            });

        return response()->json($ulasan);
    }


    // public function detailTidakLogin(Request $request, $id)
    // {
    //     $emailInput = $request->email;

    //     $query = Ulasan::where('id_wisata_kuliner', $id)
    //         ->where('status', 'Disetujui');

    //     $query->whereHas('wisatawan', function ($q) use ($emailInput) {
    //         $q->where('email', $emailInput);
    //     });

    //     $ulasan = $query->orderBy('waktu_diubah', 'desc')
    //         ->get()
    //         ->map(function ($item) {
    //             return [
    //                 'penilaian' => $item->penilaian,
    //                 'ulasan' => $item->ulasan,
    //                 'foto_ulasan' => $item->foto_ulasan,
    //                 'waktu_diubah' => $item->waktu_diubah,
    //                 'nama' => $item->wisatawan->nama ?? null,
    //             ];
    //         });

    //     return response()->json($ulasan);
    // }

    public function getUlasanTidakLogin(Request $request, $id)
    {
        // if (!Auth::check()) {
        //     return response()->json(null);
        // }

        // $wisatawan = Wisatawan::where('user_id', Auth::id())->first();

        // if (!$wisatawan) {
        //     return response()->json(null);
        // }

        // $ulasan = Ulasan::where('id_wisata_kuliner', $id)
        //     ->where('id_wisatawan', $wisatawan->id_wisatawan)
        //     ->first();

        // return response()->json($ulasan);

        $email_pengulas = $request->email_pengulas;

        $ulasan = Ulasan::where('id_wisata_kuliner', $id)
            ->where('email_pengulas', $email_pengulas)
            ->first();

        return response()->json($ulasan);
    }
}
