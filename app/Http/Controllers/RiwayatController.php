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
    public function tampilkanRiwayatPengajuan()
    {
        $wisataKuliner = PengajuanWisataKuliner::where('id_user', Auth::id())
            ->orderByRaw("
                CASE 
                    WHEN status = 'Belum Diverifikasi' THEN 1
                    WHEN status = 'Disetujui' THEN 2
                    ELSE 3
                END
            ")
            ->orderBy('waktu_diubah', 'desc')
            ->paginate(10, ['*'], 'wisatakuliner')
            ->withQueryString();

        $wisataKuliner->getCollection()->transform(function ($item, $key) use ($wisataKuliner) {
            $item->nomor = ($wisataKuliner->currentPage() - 1) * $wisataKuliner->perPage() + $key + 1;
            return $item;
        });

        $ulasan = Ulasan::where('id_user', Auth::id())
            ->orderByRaw("
                CASE 
                    WHEN status = 'Belum Diverifikasi' THEN 1
                    WHEN status = 'Disetujui' THEN 2
                    ELSE 3
                END
            ")
            ->orderBy('waktu_diubah', 'desc')
            ->paginate(10, ['*'], 'ulasan')
            ->withQueryString();

        $ulasan->getCollection()->transform(function ($item, $key) use ($ulasan) {
            $item->nomor = ($ulasan->currentPage() - 1) * $ulasan->perPage() + $key + 1;
            return $item;
        });

        return view('wisatawan.riwayat.halaman-riwayatkuliner', compact(
            'wisataKuliner',
            'ulasan',
        ));
    }

    public function tampilkanDetailWKuliner($id)
    {
        $wisataKuliner = PengajuanWisataKuliner::with(['fasilitas', 'kategori'])->findOrFail($id);

        return response()->json($wisataKuliner);
    }

    public function tampilkanDetailUlasan($id)
    {
        $ulasan = Ulasan::with('wisataKuliner')->findOrFail($id);

        return response()->json($ulasan);
    }
}
