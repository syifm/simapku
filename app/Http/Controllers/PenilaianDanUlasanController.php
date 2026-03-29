<?php

namespace App\Http\Controllers;

use App\Models\PenilaiandanUlasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wisatawan;
use App\Models\Admin;
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
    //         'harga_total' => $request->harga_total,
    //         'email_pengulas' => $email_pengulas,
    //         'id_wisatawan' => $id_wisatawan ?? null,
    //         'id_admin' => $id_admin ?? null,
    //         'status' => $status,
    //         'waktu_dibuat' => $waktu_dibuat,
    //         'waktu_diubah' => $waktu_diubah,
    //     ]);

    //     return redirect()->route('beranda-Wisatawan')->with('success', 'Penilaian dan Ulasan Berhasil Disimpan');
    // }
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

        if (Auth::check() && Auth::user()->peran === 'Wisatawan') {
            $id_wisatawan = Wisatawan::where('user_id', Auth::id())->value('id_wisatawan');
        } elseif (Auth::check() && Auth::user()->peran === 'Admin') {
            $id_admin = Admin::where('user_id', Auth::id())->value('id_admin');
        }

        PenilaiandanUlasan::create([
            'id_wisata_kuliner' => $request->id_wisata_kuliner,
            'penilaian' => $request->penilaian,
            'ulasan' => $request->ulasan,
            'foto_ulasan' => $fotoPath,
            'harga_total' => $request->harga_total,
            'email_pengulas' => $email_pengulas,
            'id_wisatawan' => $id_wisatawan,
            'id_admin' => $id_admin,
            'status' => 'Belum Diverifikasi',
            'waktu_dibuat' => now(),
            'waktu_diubah' => now(),
        ]);

        return redirect()->back()->with('success', 'Ulasan berhasil disimpan');
    }

    public function detail($id)
    {
        $ulasan = PenilaiandanUlasan::where('id_wisata_kuliner', $id)
            ->orderBy('waktu_diubah', 'desc')
            ->get();

        return response()->json($ulasan);
    }
}
