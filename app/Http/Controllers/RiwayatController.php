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

class RiwayatController extends Controller
{
    public function riwayat()
    {
        $wisatawan = Wisatawan::where('user_id', Auth::id())->first();
        $id_wisatawan = $wisatawan->id_wisatawan;
        $statuswisatakuliner = PengajuanWisataKuliner::where('id_wisatawan', $id_wisatawan)->exists();
        $wisataKuliner = PengajuanWisataKuliner::where('id_wisatawan', $id_wisatawan)
            ->orderByRaw("
                CASE 
                    WHEN status = 'Belum Diverifikasi' THEN 1
                    WHEN status = 'Disetujui' THEN 2
                    WHEN status = 'Ditolak' THEN 3
                END
            ")
            ->orderBy('waktu_diubah', 'desc')
            ->paginate(10)
            ->withQueryString();

        $wisataKuliner->getCollection()->transform(function ($item, $key) use ($wisataKuliner) {
            $item->nomor = ($wisataKuliner->currentPage() - 1) * $wisataKuliner->perPage() + $key + 1;
            return $item;
        });

        $statusUlasan = PenilaiandanUlasan::where('id_wisatawan', $id_wisatawan)->exists();
        // $penilaianDanUlasan = PenilaiandanUlasan::paginate(10)->withQueryString();
        $penilaianDanUlasan = PenilaiandanUlasan::where('id_wisatawan', $id_wisatawan)
            ->orderByRaw("
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

        return view('wisatawan.riwayat.riwayat', compact(
            'statuswisatakuliner',
            'wisataKuliner',
            'statusUlasan',
            'penilaianDanUlasan',
        ));
    }

    public function detailKuliner($id)
    {
        $wisataKuliner = PengajuanWisataKuliner::with(['fasilitas', 'kategori'])->findOrFail($id);

        return response()->json($wisataKuliner);
    }

    public function detailUlasan($id)
    {
        $penilaianDanUlasan = PenilaiandanUlasan::with('wisataKuliner')->findOrFail($id);

        return response()->json($penilaianDanUlasan);
    }
}
