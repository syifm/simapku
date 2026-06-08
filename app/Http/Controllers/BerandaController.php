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
        $rekomendasiCosine = collect(); // Default berupa collection kosong jika user belum login/tidak punya favorit
        $isHasilCosine = false;

        // Ambil data wisatawan berdasarkan user yang sedang login
        $wisatawan = DB::table('wisatawan')->where('user_id', Auth::id())->first();

        $maxSliderHarga = 500000; // Batas atas normalisasi harga

        $favoritIds = [];
        $favoritIds = DB::table('kuliner_favorit')
            ->where('id_wisatawan', $wisatawan->id_wisatawan)
            ->pluck('id_wisata_kuliner')
            ->toArray();

        $rekomendasiCosine = collect();
        $isHasilCosine = false;
        if ($request->rekomendasi == 1) {
            // if (!empty($favoritIds)) {
            //     $masterKategori = DB::table('kategori')->pluck('id_kategori')->toArray();
            //     $masterFasilitas = DB::table('fasilitas')->pluck('id_fasilitas')->toArray();

            //     $totalKolom = 3 + count($masterKategori) + count($masterFasilitas);

            //     $userProfileVector = array_fill(0, $totalKolom, 0);
            //     $countValidFavorit = 0;

            //     foreach ($favoritIds as $favId) {
            //         $kuliner = DB::table('wisata_kuliner')->where('id_wisata_kuliner', $favId)->first();
            //         if (!$kuliner) continue;

            //         $countValidFavorit++;
            //         $myKategori = DB::table('kategori_wisata_kuliner')->where('id_wisata_kuliner', $favId)->pluck('id_kategori')->toArray();
            //         $myFasilitas = DB::table('fasilitas_wisata_kuliner')->where('id_wisata_kuliner', $favId)->pluck('id_fasilitas')->toArray();

            //         // Min-Max Scaling (Mengubah angka kontinu ke skala 0-1)
            //         $ratingNorm = ($kuliner->penilaian ?? 0) / 5;
            //         $hargaMinNorm = min(($kuliner->harga_min ?? 0), $maxSliderHarga) / $maxSliderHarga;
            //         $hargaMaxNorm = min(($kuliner->harga_max ?? 0), $maxSliderHarga) / $maxSliderHarga;

            //         $tmpVector = [$ratingNorm, $hargaMinNorm, $hargaMaxNorm];

            //         // One-Hot Biner Encoding
            //         foreach ($masterKategori as $idKat) {
            //             $tmpVector[] = in_array($idKat, $myKategori) ? 1 : 0;
            //         }
            //         foreach ($masterFasilitas as $idFas) {
            //             $tmpVector[] = in_array($idFas, $myFasilitas) ? 1 : 0;
            //         }

            //         for ($i = 0; $i < $totalKolom; $i++) {
            //             $userProfileVector[$i] += $tmpVector[$i];
            //         }
            //     }

            //     if ($countValidFavorit > 0) {
            //         // Selesaikan hitungan rata-rata vektor profil user
            //         for ($i = 0; $i < $totalKolom; $i++) {
            //             $userProfileVector[$i] /= $countValidFavorit;
            //         }

            //         // 3. Hitung Kedekatan Sudut Cosine dengan kuliner Semarang lainnya (yang belum difavoritkan)
            //         $calonKuliner = DB::table('wisata_kuliner')
            //             ->where('status', 'Disetujui')
            //             ->whereNotIn('id_wisata_kuliner', $favoritIds)
            //             ->get();

            //         $hasilMatriks = [];

            //         foreach ($calonKuliner as $item) {
            //             $itemKategori = DB::table('kategori_wisata_kuliner')->where('id_wisata_kuliner', $item->id_wisata_kuliner)->pluck('id_kategori')->toArray();
            //             $itemFasilitas = DB::table('fasilitas_wisata_kuliner')->where('id_wisata_kuliner', $item->id_wisata_kuliner)->pluck('id_fasilitas')->toArray();

            //             $itemRatingNorm = ($item->penilaian ?? 0) / 5;
            //             $itemHargaMinNorm = min(($item->harga_min ?? 0), $maxSliderHarga) / $maxSliderHarga;
            //             $itemHargaMaxNorm = min(($item->harga_max ?? 0), $maxSliderHarga) / $maxSliderHarga;

            //             $itemVector = [$itemRatingNorm, $itemHargaMinNorm, $itemHargaMaxNorm];
            //             foreach ($masterKategori as $idKat) {
            //                 $itemVector[] = in_array($idKat, $itemKategori) ? 1 : 0;
            //             }
            //             foreach ($masterFasilitas as $idFas) {
            //                 $itemVector[] = in_array($idFas, $itemFasilitas) ? 1 : 0;
            //             }

            //             // Rumus Cosine Similarity murni
            //             $dotProduct = 0;
            //             $v1Length = 0;
            //             $v2Length = 0;
            //             for ($i = 0; $i < $totalKolom; $i++) {
            //                 $dotProduct += $userProfileVector[$i] * $itemVector[$i];
            //                 $v1Length += pow($userProfileVector[$i], 2);
            //                 $v2Length += pow($itemVector[$i], 2);
            //             }

            //             $cosineScore = ($v1Length > 0 && $v2Length > 0) ? ($dotProduct / (sqrt($v1Length) * sqrt($v2Length))) : 0;

            //             $item->score_cosine = $cosineScore;
            //             $hasilMatriks[] = $item;
            //         }

            //         // SORTING MUTLAK: Urutkan dari nilai skor kemiripan tertinggi ke terendah, potong ambil 6 item
            //         $rekomendasiCosine = collect($hasilMatriks)->sortByDesc('score_cosine')->take(6)->values();
            //         $isHasilCosine = true;
            //     }
            // }
            $wisatawan = DB::table('wisatawan')
                ->where('user_id', Auth::id())
                ->first();

            if ($wisatawan) {

                $hasilRekomendasi = $this->cariKulinerSerupa(
                    $wisatawan->id_wisatawan
                );

                $rekomendasiCosine = $hasilRekomendasi['rekomendasiCosine'];
                $isHasilCosine = $hasilRekomendasi['isHasilCosine'];
            }
        }

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
            'namaKategoriDipilih',
            'rekomendasiCosine',
            'isHasilCosine'
        ));
    }

    private function cariKulinerSerupa($idWisatawan)
    {
        $rekomendasiCosine = collect();
        $isHasilCosine = false;

        $maxSliderHarga = 500000;

        $favoritIds = DB::table('kuliner_favorit')
            ->where('id_wisatawan', $idWisatawan)
            ->pluck('id_wisata_kuliner')
            ->toArray();

        if (empty($favoritIds)) {
            return [
                'rekomendasiCosine' => $rekomendasiCosine,
                'isHasilCosine' => false
            ];
        }

        $masterKategori = DB::table('kategori')->pluck('id_kategori')->toArray();
        $masterFasilitas = DB::table('fasilitas')->pluck('id_fasilitas')->toArray();

        $totalKolom = 3 + count($masterKategori) + count($masterFasilitas);

        $userProfileVector = array_fill(0, $totalKolom, 0);
        $countValidFavorit = 0;

        foreach ($favoritIds as $favId) {
            $kuliner = DB::table('wisata_kuliner')->where('id_wisata_kuliner', $favId)->first();
            if (!$kuliner) continue;

            $countValidFavorit++;
            $myKategori = DB::table('kategori_wisata_kuliner')->where('id_wisata_kuliner', $favId)->pluck('id_kategori')->toArray();
            $myFasilitas = DB::table('fasilitas_wisata_kuliner')->where('id_wisata_kuliner', $favId)->pluck('id_fasilitas')->toArray();

            // Min-Max Scaling (Mengubah angka kontinu ke skala 0-1)
            $ratingNorm = ($kuliner->penilaian ?? 0) / 5;
            $hargaMinNorm = min(($kuliner->harga_min ?? 0), $maxSliderHarga) / $maxSliderHarga;
            $hargaMaxNorm = min(($kuliner->harga_max ?? 0), $maxSliderHarga) / $maxSliderHarga;

            $tmpVector = [$ratingNorm, $hargaMinNorm, $hargaMaxNorm];

            // One-Hot Biner Encoding
            foreach ($masterKategori as $idKat) {
                $tmpVector[] = in_array($idKat, $myKategori) ? 1 : 0;
            }
            foreach ($masterFasilitas as $idFas) {
                $tmpVector[] = in_array($idFas, $myFasilitas) ? 1 : 0;
            }

            for ($i = 0; $i < $totalKolom; $i++) {
                $userProfileVector[$i] += $tmpVector[$i];
            }
        }

        if ($countValidFavorit > 0) {
            // Selesaikan hitungan rata-rata vektor profil user
            for ($i = 0; $i < $totalKolom; $i++) {
                $userProfileVector[$i] /= $countValidFavorit;
            }

            // 3. Hitung Kedekatan Sudut Cosine dengan kuliner Semarang lainnya (yang belum difavoritkan)
            $calonKuliner = DB::table('wisata_kuliner')
                ->where('status', 'Disetujui')
                ->whereNotIn('id_wisata_kuliner', $favoritIds)
                ->get();

            $hasilMatriks = [];

            foreach ($calonKuliner as $item) {
                $itemKategori = DB::table('kategori_wisata_kuliner')->where('id_wisata_kuliner', $item->id_wisata_kuliner)->pluck('id_kategori')->toArray();
                $itemFasilitas = DB::table('fasilitas_wisata_kuliner')->where('id_wisata_kuliner', $item->id_wisata_kuliner)->pluck('id_fasilitas')->toArray();

                $itemRatingNorm = ($item->penilaian ?? 0) / 5;
                $itemHargaMinNorm = min(($item->harga_min ?? 0), $maxSliderHarga) / $maxSliderHarga;
                $itemHargaMaxNorm = min(($item->harga_max ?? 0), $maxSliderHarga) / $maxSliderHarga;

                $itemVector = [$itemRatingNorm, $itemHargaMinNorm, $itemHargaMaxNorm];
                foreach ($masterKategori as $idKat) {
                    $itemVector[] = in_array($idKat, $itemKategori) ? 1 : 0;
                }
                foreach ($masterFasilitas as $idFas) {
                    $itemVector[] = in_array($idFas, $itemFasilitas) ? 1 : 0;
                }

                // Rumus Cosine Similarity murni
                $dotProduct = 0;
                $v1Length = 0;
                $v2Length = 0;
                for ($i = 0; $i < $totalKolom; $i++) {
                    $dotProduct += $userProfileVector[$i] * $itemVector[$i];
                    $v1Length += pow($userProfileVector[$i], 2);
                    $v2Length += pow($itemVector[$i], 2);
                }

                $cosineScore = ($v1Length > 0 && $v2Length > 0) ? ($dotProduct / (sqrt($v1Length) * sqrt($v2Length))) : 0;

                $item->score_cosine = $cosineScore;
                $hasilMatriks[] = $item;
            }

            // SORTING MUTLAK: Urutkan dari nilai skor kemiripan tertinggi ke terendah, potong ambil 6 item
            $rekomendasiCosine = collect($hasilMatriks)->sortByDesc('score_cosine')->take(6)->values();
            $isHasilCosine = true;
        }

        return [
            'rekomendasiCosine' => $rekomendasiCosine,
            'isHasilCosine' => $isHasilCosine
        ];
    }

    public function tampilkanDetailWKuliner(int $id)
    {
        $wisataKuliner = WisataKuliner::with(['fasilitas', 'kategori'])->findOrFail($id);

        return response()->json($wisataKuliner);
    }

    public function tampilkanBerandaTamu(Request $request)
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

        return view('tamu.beranda', compact(
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
            'namaKategoriDipilih',
        ));
    }
}
