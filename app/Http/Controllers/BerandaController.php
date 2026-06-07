<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use App\Models\WisataKuliner;
use App\Models\Wisatawan;
use App\Models\Admin;
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

class BerandaController extends Controller
{
    // Beranda 
    public function tampilkanBerandaAdmin()
    {
        $wkulinerBelumDiverifikasi = PengajuanWisataKuliner::where('status', 'Belum Diverifikasi')
            ->count();

        $wkulinerDisetujui = PengajuanWisataKuliner::where('status', 'Disetujui')
            ->count();

        $wkulinerDitolak = PengajuanWisataKuliner::where('status', 'Ditolak')
            ->count();

        $totalWisataKuliner = $wkulinerBelumDiverifikasi + $wkulinerDisetujui + $wkulinerDitolak;
        $persentaseWkulinerBelumDiverifikasi = $totalWisataKuliner > 0 ? ($wkulinerBelumDiverifikasi / $totalWisataKuliner) * 100 : 0;
        $persentaseWkulinerDisetujui = $totalWisataKuliner > 0 ? ($wkulinerDisetujui / $totalWisataKuliner) * 100 : 0;
        $persentaseWkulinerDitolak = $totalWisataKuliner > 0 ? ($wkulinerDitolak / $totalWisataKuliner) * 100 : 0;

        $ulasanBelumDiverifikasi = Ulasan::where('status', 'Belum Diverifikasi')
            ->count();

        $ulasanDisetujui = Ulasan::where('status', 'Disetujui')
            ->count();

        $ulasanDitolak = Ulasan::where('status', 'Ditolak')
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

    public function tampilkanBerandaWisatawan(Request $request)
    {
        $keyword = trim($request->keyword ?? '');

        if ($keyword === '') {
            $keyword = 'Rekomendasi Kuliner';
        }
        $kulinerBaru = WisataKuliner::where('status', 'Disetujui')->orderBy('waktu_dibuat', 'desc')->get();
        $kulinerFavorit = WisataKuliner::where('status', 'Disetujui')->orderBy('penilaian', 'desc')->get();
        $fasilitas = Fasilitas::all();
        $kategori = Kategori::all();

        $kategoriTempat = Kategori::where('jenis_kategori', 'Tempat')
            ->where('status', 'Aktif')
            ->orderBy('nama', 'asc')
            ->get();

        $jenisHidangan = Kategori::where('jenis_kategori', 'Jenis Hidangan')
            ->where('status', 'Aktif')
            ->orderBy('nama', 'asc')
            ->get();

        $asalKuliner = Kategori::where('jenis_kategori', 'Asal Kuliner')
            ->where('status', 'Aktif')
            ->orderBy('nama', 'asc')
            ->get();

        $event = Kategori::where('jenis_kategori', 'Event')
            ->where('status', 'Aktif')
            ->orderBy('nama', 'asc')
            ->get();

        $kategoriDipilih = $request->kategori;

        $wisataKuliner = WisataKuliner::where('status', 'Disetujui');

        if ($kategoriDipilih) {

            $wisataKuliner->whereHas('kategori', function ($q) use ($kategoriDipilih) {

                $q->where('kategori.id_kategori', $kategoriDipilih);
            });
        }

        $wisataKuliner = $wisataKuliner
            ->orderBy('waktu_dibuat', 'desc')
            ->get();

        $kategoriDipilih = $request->kategori;
        $namaKategoriDipilih = null;

        if ($kategoriDipilih) {
            $namaKategoriDipilih = Kategori::where(
                'id_kategori',
                $kategoriDipilih
            )->value('nama');
        }
        // return view('wisatawan.wisata-kuliner', compact(
        //     'kategoriTempat',
        //     'jenisHidangan',
        //     'asalKuliner'
        // ));

        return view('wisatawan.beranda', compact(
            'fasilitas',
            'kategori',
            'keyword',
            'kulinerBaru',
            'kulinerFavorit',
            // 'kategoriAktif',
            'kategoriTempat',
            'jenisHidangan',
            'asalKuliner',
            'wisataKuliner',
            'kategoriDipilih',
            'namaKategoriDipilih'
        ));
    }

    public function tampilkanBerandaTamu()
    {
        $keyword = trim($request->keyword ?? '');

        if ($keyword === '') {

            $kulinerBaru = WisataKuliner::where('status', 'Disetujui')->orderBy('waktu_dibuat', 'desc')->take(4)->get();
            $kulinerFavorit = WisataKuliner::where('status', 'Disetujui')->orderBy('penilaian', 'desc')->take(4)->get();
            $fasilitas = Fasilitas::all();
            $kategori = Kategori::all();

            $keyword = 'Rekomendasi Kuliner';
        }
        return view('tamu.beranda', compact('fasilitas', 'kategori', 'keyword', 'kulinerBaru', 'kulinerFavorit'));
    }
}
