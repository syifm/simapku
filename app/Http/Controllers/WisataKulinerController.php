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
        $wisataKuliner = WisataKuliner::paginate(10)->withQueryString();;

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

        // // filter radius
        // $query->having('distance', '<', $radius);
        //     $lat = $request->lat;
        //     $lng = $request->lng;

        //     $query = DB::table('wisata_kuliner')
        //         ->selectRaw("
        //     *,
        //     (6371 * acos(
        //         cos(radians(?))
        //         * cos(radians(latitude))
        //         * cos(radians(longitude) - radians(?))
        //         + sin(radians(?))
        //         * sin(radians(latitude))
        //     )) AS distance
        // ", [$lat, $lng, $lat]);

        //     $query->orderBy('distance', 'asc');
        $query = DB::table('wisata_kuliner');

        // $lat = $request->lat;
        // $lng = $request->lng;
        // $radius = $request->radius ?? 5;

        // $kuliner = DB::table('wisata_kuliner')
        //     ->selectRaw("
        //     *,
        //     (6371 * acos(
        //         cos(radians(?)) 
        //         * cos(radians(latitude)) 
        //         * cos(radians(longitude) - radians(?)) 
        //         + sin(radians(?)) 
        //         * sin(radians(latitude))
        //     )) AS distance
        // ", [$lat, $lng, $lat])
        //     ->having('distance', '<=', $radius)
        //     ->orderBy('distance', 'asc')
        //     ->get();

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

        //penilaian
        if ($request->minrating && $request->maxrating) {
            $query->whereBetween('penilaian', [
                $request->minrating,
                $request->maxrating
            ]);
        }

        //harga
        if ($request->minharga && $request->maxharga) {
            $query->where(function ($q) use ($request) {
                $q->where('harga_max', '>=', $request->minharga)
                    ->where('harga_min', '<=', $request->maxharga);
            });
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

        if ($request->lat && $request->lng && $request->jarak) {
            $lat = $request->lat;
            $lng = $request->lng;
            $jarak = $request->jarak;

            $query->selectRaw("
            *,
    (
        6371 * 2 * ATAN2(
            SQRT(
                POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
                COS(RADIANS(?)) * COS(RADIANS(latitude)) *
                POWER(SIN(RADIANS(longitude - ?) / 2), 2)
            ),
            SQRT(
                1 - (
                    POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
                    COS(RADIANS(?)) * COS(RADIANS(latitude)) *
                    POWER(SIN(RADIANS(longitude - ?) / 2), 2)
                )
            )
        )
    ) AS distance
", [
                $lat,
                $lat,
                $lng,   // bagian atas
                $lat,
                $lat,
                $lng    // bagian bawah (HARUS DIULANG)
            ]);

            $query->having("distance", "<=", $jarak);

            $query->orderBy("distance", "asc");
        }
        // dd($request->lat, $request->lng, $request->jarak);

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

        // if ($request->lat && $request->lng) {

        //     $lat = $request->lat;
        //     $lng = $request->lng;

        //     $query->selectRaw("
        //     *,
        //     (6371 * acos(
        //         cos(radians(?))
        //         * cos(radians(latitude))
        //         * cos(radians(longitude) - radians(?))
        //         + sin(radians(?))
        //         * sin(radians(latitude))
        //     )) AS distance
        // ", [$lat, $lng, $lat]);

        //     // urutkan dari terdekat
        //     $query->orderBy('distance', 'asc');
        // }

        // $data = $query->orderBy('distance')->get();
        $data = $query->distinct()->get();

        // return response()->json($data);
        return view('wisatawan.pencarian.hasil-pencarian', compact('data'));
    }

    // public function kulinerTerdekat(Request $request)
    // {
    //     $lat = $request->lat;
    //     $lng = $request->lng;
    //     $radius = $request->radius ?? 5; // default 5 km

    //     $kuliner = DB::table('wisata_kuliner')
    //         ->selectRaw("
    //         *,
    //         (6371 * acos(
    //             cos(radians(?)) 
    //             * cos(radians(latitude)) 
    //             * cos(radians(longitude) - radians(?)) 
    //             + sin(radians(?)) 
    //             * sin(radians(latitude))
    //         )) AS distance
    //     ", [$lat, $lng, $lat])
    //         ->having('distance', '<=', $radius)
    //         ->orderBy('distance', 'asc')
    //         ->get();

    //     return response()->json($kuliner);
    // }

    public function coba()
    {
        return view('wisatawan.hhhh');
    }
}
