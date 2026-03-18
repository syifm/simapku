<?php

namespace App\Http\Controllers;

use App\Models\WisataKuliner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WisataKulinerController extends Controller
{
    public function halamanVerifKuliner()
    {
        $statuswisatakuliner = WisataKuliner::exists();
        $wisataKuliner = WisataKuliner::paginate(5)->withQueryString();;

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

        return response()->json($wisataKuliner, [
            'success' => true,
            'wisataKuliner' => $wisataKuliner,
            'status' => $wisataKuliner->status
        ]);
    }

    public function search(Request $request)
    {
        // $lat = $request->lat;
        // $lng = $request->lng;
        // $radius = $request->radius ?? 5;

        // $query = DB::table('wisata_kuliner')
        //     ->selectRaw("
        //     *,
        //     (6371 * acos(
        //         cos(radians(?))
        //         * cos(radians(latitude))
        //         * cos(radians(longitude) - radians(?))
        //         + sin(radians(?))
        //         * sin(radians(latitude))
        //     )) AS distance
        // ", [$lat, $lng, $lat]);

        // filter radius
        // $query->having('distance', '<', $radius);
        $query = DB::table('wisata_kuliner');
        // keyword
        if ($request->keyword) {
            // $query = DB::table('wisata_kuliner')->where('nama', 'like', '%' . $request->keyword . '%');
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->keyword . '%')
                    ->orWhere('kecamatan', 'like', '%' . $request->keyword . '%')
                    ->orWhere('kelurahan', 'like', '%' . $request->keyword . '%')
                    ->orWhere('alamat', 'like', '%' . $request->keyword . '%')
                    ->orWhere('no_telp', 'like', '%' . $request->keyword . '%')
                    ->orWhere('deskripsi', 'like', '%' . $request->keyword . '%');
            });
        }

        // penilaian
        if ($request->penilaian) {
            $query->whereIn('penilaian', $request->penilaian);
        }




        // filter kategori
        // if ($request->kategori) {
        //     $query->where('kategori', $request->kategori);
        // }

        // if ($request->rating) {
        //     $query->having('penilaian', '>=', $request->rating);
        // }

        // if ($request->fasilitas) {
        //     $query->join('fasilitas_wisata_kuliner', 'wisata_kuliner.id_wisata_kuliner', '=', 'fasilitas_wisata_kuliner.id_wisata_kuliner')
        //         ->whereIn('fasilitas_wisata_kuliner.id_fasilitas', $request->fasilitas);
        // }
        if ($request->fasilitas) {

            $query->leftJoin(
                'fasilitas_wisata_kuliner as f',
                'wisata_kuliner.id_wisata_kuliner',
                '=',
                'f.id_wisata_kuliner'
            )

                ->select(
                    'wisata_kuliner.*',
                    DB::raw('COUNT(CASE 
                WHEN f.id_fasilitas IN (' . implode(',', $request->fasilitas) . ') 
                THEN 1 END) as total_sesuai')
                )

                ->groupBy('wisata_kuliner.id_wisata_kuliner')
                ->having('total_sesuai', '>', 0)
                ->orderByDesc('total_sesuai');
        }

        // $data = $query->orderBy('distance')->get();
        $data = $query->distinct()->get();

        // return response()->json($data);
        return view('wisatawan.pencarian.hasil-pencarian', compact('data'));
    }
}
