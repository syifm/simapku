<?php

namespace App\Http\Controllers;

use App\Models\PenilaiandanUlasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wisatawan;
use App\Models\Admin;
use App\Models\WisataKuliner;
use Carbon\Carbon;


class PenilaianDanUlasanController extends Controller
{

    // public function simpan(Request $request)
    // {

    //     $request->validate([
    //         'id_wisata_kuliner' => 'required|integer',
    //         'penilaian' => 'required|numeric|max:5',
    //         'ulasan' => 'required|string',
    //         'foto_ulasan' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
    //     ]);

    //     // $fotoPath = $request->file('foto')->storeAs(
    //     //     'uploads',
    //     //     'foto_' . 'ulasan_' . time() . '.' . $request->file('foto_ulasan')->extension(),
    //     //     'public'
    //     // );
    //     $fotoPath = null;

    //     if ($request->hasFile('foto_ulasan')) {
    //         $fotoPath = $request->file('foto_ulasan')->storeAs(
    //             'uploads',
    //             'foto_ulasan_' . time() . '.' . $request->file('foto_ulasan')->extension(),
    //             'public'
    //         );
    //     }

    //     if (Auth::check()) {
    //         $email_pengulas = Auth::user()->email;
    //     } else {
    //         $email_pengulas = $request->email_pengulas;
    //     }


    //     $id_wisatawan = null;
    //     $id_admin = null;
    //     if (Auth::check() && Auth::user()->peran === 'Wisatawan') {
    //         $id_wisatawan = Wisatawan::where('user_id', Auth::id())->value('id_wisatawan');
    //     } elseif (Auth::check() && Auth::user()->peran === 'Admin') {
    //         $id_admin = Admin::where('user_id', Auth::id())->value('id_admin');
    //     }

    //     $waktu_dibuat = Carbon::now('Asia/Jakarta');
    //     $waktu_diubah = Carbon::now('Asia/Jakarta');

    //     $status = 'Belum Diverifikasi';
    //     if (Auth::check() && Auth::user()->peran === 'Admin') {
    //         $status = 'Disetujui';
    //     }

    //     PenilaiandanUlasan::create([
    //         'id_wisata_kuliner' => $request->id_wisata_kuliner,
    //         'penilaian' => $request->penilaian,
    //         'ulasan' => $request->ulasan,
    //         'foto_ulasan' => $fotoPath,
    //         'harga_per_orang' => $request->harga_per_orang,
    //         'email_pengulas' => $email_pengulas,
    //         'id_wisatawan' => $id_wisatawan ?? null,
    //         'id_admin' => $id_admin ?? null,
    //         'status' => $status,
    //         'waktu_dibuat' => $waktu_dibuat,
    //         'waktu_diubah' => $waktu_diubah,
    //     ]);

    //     return redirect()->route('beranda-Wisatawan')->with('success', 'Penilaian dan Ulasan Berhasil Disimpan');
    // }
    public function getUlasan($id)
    {
        if (!Auth::check()) {
            return response()->json(null);
        }

        $wisatawan = Wisatawan::where('user_id', Auth::id())->first();

        if (!$wisatawan) {
            return response()->json(null);
        }

        $ulasan = PenilaiandanUlasan::where('id_wisata_kuliner', $id)
            ->where('id_wisatawan', $wisatawan->id_wisatawan)
            ->first();

        return response()->json($ulasan);
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'id_wisata_kuliner' => 'required|integer',
            'penilaian' => 'required|integer|max:5',
            'ulasan' => 'required|string',
            'foto_ulasan' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);

        $fotoPath = null;

        if ($request->hasFile('foto_ulasan')) {
            $fotoPath = $request->file('foto_ulasan')->storeAs(
                'uploads',
                'foto_ulasan_' . time() . '.' . $request->file('foto_ulasan')->extension(),
                'public'
            );
        }

        $email_pengulas = Auth::check()
            ? Auth::user()->email
            : $request->email_pengulas;

        $id_wisatawan = null;
        $id_admin = null;

        $waktu_dibuat = Carbon::now('Asia/Jakarta');
        $waktu_diubah = Carbon::now('Asia/Jakarta');

        if (Auth::check() && Auth::user()->peran === 'Wisatawan') {
            $id_wisatawan = Wisatawan::where('user_id', Auth::id())->value('id_wisatawan');
        } elseif (Auth::check() && Auth::user()->peran === 'Admin') {
            $id_admin = Admin::where('user_id', Auth::id())->value('id_admin');
        }

        $range = explode('-', $request->harga_per_orang);

        $min = $range[0] ?? null;
        $max = $range[1] ?? null;

        $ulasan = null;

        if ($id_wisatawan) {
            $ulasan = PenilaiandanUlasan::where('id_wisata_kuliner', $request->id_wisata_kuliner)
                ->where('id_wisatawan', $id_wisatawan)
                ->first();
        }

        if ($ulasan) {
            $ulasan->update([
                'penilaian' => $request->penilaian,
                'ulasan' => $request->ulasan,
                'foto_ulasan' => $fotoPath ?? $ulasan->foto_ulasan,
                'harga_min' => $min,
                'harga_max' => $max,
                'waktu_diubah' => $waktu_diubah,
            ]);

            return response()->json([
                'status' => 'Diperbarui',
                'message' => 'Ulasan berhasil diperbarui'
            ]);
        } else {
            PenilaiandanUlasan::create([
                'id_wisata_kuliner' => $request->id_wisata_kuliner,
                'penilaian' => $request->penilaian,
                'ulasan' => $request->ulasan,
                'foto_ulasan' => $fotoPath,
                'harga_min' => $min,
                'harga_max' => $max,
                'email_pengulas' => $email_pengulas,
                'id_wisatawan' => $id_wisatawan,
                'id_admin' => $id_admin,
                'status' => 'Belum Diverifikasi',
                'waktu_dibuat' => $waktu_dibuat,
                'waktu_diubah' => $waktu_diubah,
            ]);
        }

        $wisataKuliner = WisataKuliner::findOrFail($request->id_wisata_kuliner);
        $min_total = PenilaiandanUlasan::where('id_wisata_kuliner', $request->id_wisata_kuliner)->min('harga_min');
        $max_total = PenilaiandanUlasan::where('id_wisata_kuliner', $request->id_wisata_kuliner)->max('harga_max');
        $penilaian_ratarata = PenilaiandanUlasan::where('id_wisata_kuliner', $request->id_wisata_kuliner)->avg('penilaian');
        $wisataKuliner->update([
            'harga_min' => $min_total,
            'harga_max' => $max_total,
            'penilaian' => $penilaian_ratarata,
            'waktu_diubah' => $waktu_diubah,
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function detail($id)
    {
        $userId = Auth::id();
        $id_wisatawan = Wisatawan::where('user_id', $userId)->value('id_wisatawan');

        $ulasan = PenilaiandanUlasan::where('id_wisata_kuliner', $id)
            ->orderBy('waktu_diubah', 'desc')
            ->get()
            ->map(function ($item) use ($id_wisatawan) {
                return [
                    'penilaian' => $item->penilaian,
                    'ulasan' => $item->ulasan,
                    'foto_ulasan' => $item->foto_ulasan,
                    'waktu_diubah' => $item->waktu_diubah,
                    'nama' => $item->wisatawan->nama ?? null,
                    'punya_sendiri' => $item->id_wisatawan == $id_wisatawan
                ];
            });

        return response()->json($ulasan);
    }


    // Wisatawan Tidak Login
    public function simpanUlasan(Request $request)
    {
        $request->validate([
            'id_wisata_kuliner' => 'required|integer',
            'penilaian' => 'required|integer|max:5',
            'ulasan' => 'required|string',
            'foto_ulasan' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'email_pengulas' => 'nullable|email|max:70',
        ]);

        $fotoPath = null;

        if ($request->hasFile('foto_ulasan')) {
            $fotoPath = $request->file('foto_ulasan')->storeAs(
                'uploads',
                'foto_ulasan_' . time() . '.' . $request->file('foto_ulasan')->extension(),
                'public'
            );
        }

        $email_pengulas = Auth::check()
            ? Auth::user()->email
            : $request->email_pengulas;

        $id_wisatawan = null;
        $id_admin = null;

        $waktu_dibuat = Carbon::now('Asia/Jakarta');
        $waktu_diubah = Carbon::now('Asia/Jakarta');

        if (Auth::check() && Auth::user()->peran === 'Wisatawan') {
            $id_wisatawan = Wisatawan::where('user_id', Auth::id())->value('id_wisatawan');
        } elseif (Auth::check() && Auth::user()->peran === 'Admin') {
            $id_admin = Admin::where('user_id', Auth::id())->value('id_admin');
        }

        $range = explode('-', $request->harga_per_orang);

        $min = $range[0] ?? null;
        $max = $range[1] ?? null;

        $ulasan = null;

        if ($id_wisatawan) {
            $ulasan = PenilaiandanUlasan::where('id_wisata_kuliner', $request->id_wisata_kuliner)
                ->where('id_wisatawan', $id_wisatawan)
                ->first();
        }

        if ($ulasan) {
            $ulasan->update([
                'penilaian' => $request->penilaian,
                'ulasan' => $request->ulasan,
                'foto_ulasan' => $fotoPath ?? $ulasan->foto_ulasan,
                'harga_min' => $min,
                'harga_max' => $max,
                'waktu_diubah' => $waktu_diubah,
            ]);

            return response()->json([
                'status' => 'Diperbarui',
                'message' => 'Ulasan berhasil diperbarui'
            ]);
        } else {
            PenilaiandanUlasan::create([
                'id_wisata_kuliner' => $request->id_wisata_kuliner,
                'penilaian' => $request->penilaian,
                'ulasan' => $request->ulasan,
                'foto_ulasan' => $fotoPath,
                'harga_min' => $min,
                'harga_max' => $max,
                'email_pengulas' => $email_pengulas,
                'id_wisatawan' => $id_wisatawan,
                'id_admin' => $id_admin,
                'status' => 'Belum Diverifikasi',
                'waktu_dibuat' => $waktu_dibuat,
                'waktu_diubah' => $waktu_diubah,
            ]);
        }

        $wisataKuliner = WisataKuliner::findOrFail($request->id_wisata_kuliner);
        $min_total = PenilaiandanUlasan::where('id_wisata_kuliner', $request->id_wisata_kuliner)->min('harga_min');
        $max_total = PenilaiandanUlasan::where('id_wisata_kuliner', $request->id_wisata_kuliner)->max('harga_max');
        $penilaian_ratarata = PenilaiandanUlasan::where('id_wisata_kuliner', $request->id_wisata_kuliner)->avg('penilaian');
        $wisataKuliner->update([
            'harga_min' => $min_total,
            'harga_max' => $max_total,
            'penilaian' => $penilaian_ratarata,
            'waktu_diubah' => $waktu_diubah,
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function detail($id)
    {
        $userId = Auth::id();
        $id_wisatawan = Wisatawan::where('user_id', $userId)->value('id_wisatawan');

        $ulasan = PenilaiandanUlasan::where('id_wisata_kuliner', $id)
            ->orderBy('waktu_diubah', 'desc')
            ->get()
            ->map(function ($item) use ($id_wisatawan) {
                return [
                    'penilaian' => $item->penilaian,
                    'ulasan' => $item->ulasan,
                    'foto_ulasan' => $item->foto_ulasan,
                    'waktu_diubah' => $item->waktu_diubah,
                    'nama' => $item->wisatawan->nama ?? null,
                    'punya_sendiri' => $item->id_wisatawan == $id_wisatawan
                ];
            });

        return response()->json($ulasan);
    }
}
