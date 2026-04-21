<?php

namespace App\Http\Controllers;

use App\Models\WisataKuliner;
use App\Models\Kategori;
use App\Models\Fasilitas;
use App\Models\KulinerFavorit;
use App\Models\Wisatawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WisataKulinerController extends Controller
{
    // Admin

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

        if ($request->status === 'Ditampilkan') {
            $wisataKuliner->update([
                'status' => 'Ditampilkan'
            ]);
        }

        // $wisataKuliner->save();

        return response()->json($wisataKuliner, [
            'success' => true,
            'wisataKuliner' => $wisataKuliner,
            'status' => $wisataKuliner->status
        ]);
    }

    // public function search(Request $request)
    // {
    //     $kategori = Kategori::all();
    //     $fasilitas = Fasilitas::all();
    //     $wisatawan = Wisatawan::where('user_id', Auth::id())->first();
    //     $favoritIds = KulinerFavorit::where('id_wisatawan', $wisatawan->id_wisatawan)
    //         ->pluck('id_wisata_kuliner')
    //         ->toArray();
    //     // $lat = $request->lat;
    //     // $lng = $request->lng;
    //     // $radius = $request->radius ?? 5;

    //     // $query = DB::table('wisata_kuliner')
    //     //     ->selectRaw("
    //     //     *,
    //     //     (6371 * acos(
    //     //         cos(radians(?))
    //     //         * cos(radians(latitude))
    //     //         * cos(radians(longitude) - radians(?))
    //     //         + sin(radians(?))
    //     //         * sin(radians(latitude))
    //     //     )) AS distance
    //     // ", [$lat, $lng, $lat]);

    //     // // filter radius
    //     // $query->having('distance', '<', $radius);
    //     //     $lat = $request->lat;
    //     //     $lng = $request->lng;

    //     //     $query = DB::table('wisata_kuliner')
    //     //         ->selectRaw("
    //     //     *,
    //     //     (6371 * acos(
    //     //         cos(radians(?))
    //     //         * cos(radians(latitude))
    //     //         * cos(radians(longitude) - radians(?))
    //     //         + sin(radians(?))
    //     //         * sin(radians(latitude))
    //     //     )) AS distance
    //     // ", [$lat, $lng, $lat]);

    //     //     $query->orderBy('distance', 'asc');
    //     // $query = DB::table('wisata_kuliner');
    //     $query = \App\Models\WisataKuliner::query()->with(['fasilitas', 'kategori']);

    //     // $lat = $request->lat;
    //     // $lng = $request->lng;
    //     // $radius = $request->radius ?? 5;

    //     // $kuliner = DB::table('wisata_kuliner')
    //     //     ->selectRaw("
    //     //     *,
    //     //     (6371 * acos(
    //     //         cos(radians(?)) 
    //     //         * cos(radians(latitude)) 
    //     //         * cos(radians(longitude) - radians(?)) 
    //     //         + sin(radians(?)) 
    //     //         * sin(radians(latitude))
    //     //     )) AS distance
    //     // ", [$lat, $lng, $lat])
    //     //     ->having('distance', '<=', $radius)
    //     //     ->orderBy('distance', 'asc')
    //     //     ->get();

    //     // keyword
    //     if ($request->keyword) {
    //         // $query = DB::table('wisata_kuliner')->where('nama', 'like', '%' . $request->keyword . '%');
    //         $query->where(function ($q) use ($request) {
    //             $q->where('nama', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kecamatan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kelurahan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('alamat', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('no_telp', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('deskripsi', 'like', '%' . $request->keyword . '%');
    //         });
    //     }

    //     //penilaian
    //     if ($request->minrating && $request->maxrating) {
    //         $query->whereBetween('penilaian', [
    //             $request->minrating,
    //             $request->maxrating
    //         ]);
    //     }

    //     //harga
    //     if ($request->minharga && $request->maxharga) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('harga_max', '>=', $request->minharga)
    //                 ->where('harga_min', '<=', $request->maxharga);
    //         });
    //     }

    //     // filter kategori
    //     // if ($request->kategori) {
    //     //     $query->where('kategori', $request->kategori);
    //     // }

    //     // if ($request->rating) {
    //     //     $query->having('penilaian', '>=', $request->rating);
    //     // }

    //     // if ($request->fasilitas) {
    //     //     $query->join('fasilitas_wisata_kuliner', 'wisata_kuliner.id_wisata_kuliner', '=', 'fasilitas_wisata_kuliner.id_wisata_kuliner')
    //     //         ->whereIn('fasilitas_wisata_kuliner.id_fasilitas', $request->fasilitas);
    //     // }

    //     if ($request->lat && $request->lng && $request->jarak) {
    //         $lat = $request->lat;
    //         $lng = $request->lng;
    //         $jarak = $request->jarak;

    //         $query->selectRaw("
    //         *,
    //             (
    //                 6371 * 2 * ATAN2(
    //                     SQRT(
    //                         POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                         COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                         POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                     ),
    //                     SQRT(
    //                         1 - (
    //                             POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                             COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                             POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                         )
    //                     )
    //                 )
    //             ) AS distance
    //         ", [
    //             $lat,
    //             $lat,
    //             $lng,
    //             $lat,
    //             $lat,
    //             $lng
    //         ]);

    //         $query->having("distance", "<=", $jarak);

    //         $query->orderBy("distance", "asc");
    //     }
    //     // dd($request->lat, $request->lng, $request->jarak);
    //     $kuliner = $query
    //         ->orderBy('distance', 'asc')
    //         ->limit(20)
    //         ->get();

    //     $origins = "$lat,$lng";

    //     $destinations = $kuliner->map(function ($item) {
    //         return $item->latitude . ',' . $item->longitude;
    //     })->join('|');

    //     if ($request->fasilitas) {

    //         $query->leftJoin(
    //             'fasilitas_wisata_kuliner as f',
    //             'wisata_kuliner.id_wisata_kuliner',
    //             '=',
    //             'f.id_wisata_kuliner'
    //         )

    //             ->select(
    //                 'wisata_kuliner.*',
    //                 DB::raw('COUNT(CASE 
    //             WHEN f.id_fasilitas IN (' . implode(',', $request->fasilitas) . ') 
    //             THEN 1 END) as total_sesuai')
    //             )

    //             ->groupBy('wisata_kuliner.id_wisata_kuliner')
    //             ->having('total_sesuai', '>', 0)
    //             ->orderByDesc('total_sesuai');
    //     }

    //     // if ($request->lat && $request->lng) {

    //     //     $lat = $request->lat;
    //     //     $lng = $request->lng;

    //     //     $query->selectRaw("
    //     //     *,
    //     //     (6371 * acos(
    //     //         cos(radians(?))
    //     //         * cos(radians(latitude))
    //     //         * cos(radians(longitude) - radians(?))
    //     //         + sin(radians(?))
    //     //         * sin(radians(latitude))
    //     //     )) AS distance
    //     // ", [$lat, $lng, $lat]);

    //     //     // urutkan dari terdekat
    //     //     $query->orderBy('distance', 'asc');
    //     // }

    //     // $data = $query->orderBy('distance')->get();
    //     $data = $query->distinct()->get();

    //     // return response()->json($data);
    //     return view('wisatawan.pencarian.hasil-pencarian', compact('data', 'kategori', 'fasilitas', 'favoritIds'));
    // }

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


    // public function search(Request $request)
    // {
    //     $kategori = Kategori::all();
    //     $fasilitas = Fasilitas::all();
    //     $wisatawan = Wisatawan::where('user_id', Auth::id())->first();
    //     $favoritIds = KulinerFavorit::where('id_wisatawan', $wisatawan->id_wisatawan)
    //         ->pluck('id_wisata_kuliner')
    //         ->toArray();

    //     $query = WisataKuliner::query()->with(['fasilitas', 'kategori']);

    //     $lat = $request->lat;
    //     $lng = $request->lng;

    //     // keyword
    //     if ($request->keyword) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('nama', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kecamatan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kelurahan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('alamat', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('no_telp', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('deskripsi', 'like', '%' . $request->keyword . '%');
    //         });
    //     }

    //     //penilaian
    //     if ($request->minrating && $request->maxrating) {
    //         $query->whereBetween('penilaian', [
    //             $request->minrating,
    //             $request->maxrating
    //         ]);
    //     }

    //     //harga
    //     if ($request->minharga && $request->maxharga) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('harga_max', '>=', $request->minharga)
    //                 ->where('harga_min', '<=', $request->maxharga);
    //         });
    //     }

    //     // haversine
    //     if ($request->lat && $request->lng && $request->jarak) {
    //         $lat = $request->lat;
    //         $lng = $request->lng;
    //         $jarak = $request->jarak;

    //         $query->selectRaw("
    //         *,
    //             (
    //                 6371 * 2 * ATAN2(
    //                     SQRT(
    //                         POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                         COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                         POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                     ),
    //                     SQRT(
    //                         1 - (
    //                             POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                             COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                             POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                         )
    //                     )
    //                 )
    //             ) AS haversine_distance
    //         ", [
    //             $lat,
    //             $lat,
    //             $lng,
    //             $lat,
    //             $lat,
    //             $lng
    //         ]);


    //         $query->having("haversine_distance", "<=", $jarak);

    //         // $query->orderBy("distance", "asc");
    //     }

    //     $data = $query->limit(20)->get();
    //     // if ($lat && $lng && count($data) > 0) {

    //     //     $destinations = $data->map(function ($item) {
    //     //         return $item->latitude . ',' . $item->longitude;
    //     //     })->join('|');

    //     //     $mockDistances = [];

    //     //     foreach ($data as $item) {
    //     //         $item->real_distance = $item->distance;
    //     //     }
    //     // }

    //     if ($request->lat && $request->lng && count($data) > 0) {

    //         $origin = $request->lat . ',' . $request->lng;

    //         $destinations = $data->map(function ($item) {
    //             return $item->latitude . ',' . $item->longitude;
    //         })->join('|');

    //         $apiKey = 'AIzaSyD-gBdR_gqZTd8B6jz3mVJWI-pqC_jPlAI';

    //         $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$origin}&destinations={$destinations}&key={$apiKey}";

    //         $response = file_get_contents($url);
    //         $response = json_decode($response, true);

    //         foreach ($data as $index => $item) {

    //             $distanceMeter = $response['rows'][0]['elements'][$index]['distance']['value'] ?? null;
    //             // $durationText = $response['rows'][0]['elements'][$index]['duration']['value'] ?? null;

    //             $item->distance_km = $distanceMeter ? $distanceMeter / 1000 : $item->haversine_distance;
    //             // $item->duration_min = $durationText ? $durationText / 60 : null;
    //         }
    //     }

    //     $totalFasilitasUser = count($request->fasilitas ?? []);

    //     foreach ($data as $item) {
    //         $item->distance_km = $response[$item->id]['distance'] ?? $item->haversine_distance;
    //         $kategoriMatch = 0;

    //         if ($request->kategori) {
    //             $kategoriMatch = DB::table('kategori_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_kategori', $request->kategori)
    //                 ->count();
    //         }

    //         $fasilitasMatch = 0;

    //         if ($request->fasilitas) {
    //             $fasilitasMatch = DB::table('fasilitas_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_fasilitas', $request->fasilitas)
    //                 ->count();
    //         }

    //         $distance = $item->distance_km ?? 999;

    //         $item->score =
    //             (1 / ($item->distance_km + 1)) * 40 +
    //             ($item->penilaian / 5) * 25 +
    //             (1 / ($item->harga_min + 1)) * 20 +
    //             ($kategoriMatch * 10) +
    //             ($fasilitasMatch * 5);
    //     }

    //     // $data = $query->distinct()->get();
    //     $data = $data->sortByDesc('score')->values();


    //     return view('wisatawan.pencarian.hasil-pencarian', compact('data', 'kategori', 'fasilitas', 'favoritIds'));
    // }

    // public function search(Request $request)
    // {
    //     $keyword = $request->keyword ?? 'Rekomendasi Kuliner';
    //     $kategori = Kategori::all();
    //     $fasilitas = Fasilitas::all();
    //     $wisatawan = Wisatawan::where('user_id', Auth::id())->first();
    //     $favoritIds = KulinerFavorit::where('id_wisatawan', $wisatawan->id_wisatawan)
    //         ->pluck('id_wisata_kuliner')
    //         ->toArray();

    //     $query = WisataKuliner::query()->with(['fasilitas', 'kategori']);

    //     $lat = $request->lat;
    //     $lng = $request->lng;

    //     // keyword
    //     if ($request->keyword) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('nama', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kecamatan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kelurahan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('alamat', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('no_telp', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('deskripsi', 'like', '%' . $request->keyword . '%');
    //         });
    //     }

    //     $useHargaFilter =
    //         ($request->minharga && $request->minharga != 0) ||
    //         ($request->maxharga && $request->maxharga != 1000000);

    //     $useRatingFilter =
    //         ($request->minrating && $request->minrating != 0) ||
    //         ($request->maxrating && $request->maxrating != 5);

    //     $useJarakFilter =
    //         ($request->jarak && $request->jarak > 0);

    //     // penilaian
    //     if ($useRatingFilter) {
    //         $query->whereBetween('penilaian', [
    //             $request->minrating,
    //             $request->maxrating
    //         ]);
    //     }

    //     // harga
    //     if ($useHargaFilter) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('harga_max', '>=', $request->minharga)
    //                 ->where('harga_min', '<=', $request->maxharga);
    //         });
    //     }

    //     // haversine
    //     if ($request->lat && $request->lng && $request->jarak) {
    //         $lat = $request->lat;
    //         $lng = $request->lng;
    //         $jarak = $request->jarak;

    //         $query->selectRaw("
    //         *,
    //             (
    //                 6371 * 2 * ATAN2(
    //                     SQRT(
    //                         POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                         COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                         POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                     ),
    //                     SQRT(
    //                         1 - (
    //                             POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                             COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                             POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                         )
    //                     )
    //                 )
    //             ) AS haversine_distance
    //         ", [
    //             $lat,
    //             $lat,
    //             $lng,
    //             $lat,
    //             $lat,
    //             $lng
    //         ]);


    //         if ($useJarakFilter) {
    //             $query->having('distance_km', '<=', $request->jarak);
    //         }

    //         // $query->orderBy("distance", "asc");
    //     }

    //     $data = $query->limit(50)->get();

    //     // preferensi
    //     $preferensiKuliner = DB::table('preferensi')
    //         ->where('id_wisatawan', $wisatawan->id_wisatawan)
    //         ->pluck('id_kategori')
    //         ->toArray();

    //     if ($request->lat && $request->lng && count($data) > 0) {

    //         $origin = $request->lat . ',' . $request->lng;

    //         $destinations = $data->map(function ($item) {
    //             return $item->latitude . ',' . $item->longitude;
    //         })->join('|');

    //         $apiKey = 'AIzaSyD-gBdR_gqZTd8B6jz3mVJWI-pqC_jPlAI';

    //         $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$origin}&destinations={$destinations}&key={$apiKey}";

    //         $response = file_get_contents($url);
    //         $response = json_decode($response, true);

    //         foreach ($data as $index => $item) {

    //             $distanceMeter = $response['rows'][0]['elements'][$index]['distance']['value'] ?? null;
    //             // $durationText = $response['rows'][0]['elements'][$index]['duration']['value'] ?? null;

    //             $item->distance_km = $distanceMeter ? $distanceMeter / 1000 : $item->haversine_distance;
    //             // $item->duration_min = $durationText ? $durationText / 60 : null;
    //         }
    //     }

    //     $totalFasilitasUser = count($request->fasilitas ?? []);

    //     foreach ($data as $item) {
    //         $listKategori = $request->kategori ?? [];
    //         if (!empty($listKategori)) {
    //             $cariKategori = $listKategori;
    //         } elseif (!empty($preferensiKuliner)) {
    //             $cariKategori = $preferensiKuliner;
    //         } else {
    //             $cariKategori = [];
    //         }

    //         $kategoriMatch = 0;
    //         if ($request->kategori) {
    //             $kategoriMatch = DB::table('kategori_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_kategori', $request->kategori)
    //                 ->count();
    //         }

    //         $fasilitasMatch = 0;
    //         if ($request->fasilitas) {
    //             $fasilitasMatch = DB::table('fasilitas_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_fasilitas', $request->fasilitas)
    //                 ->count();
    //         }

    //         // $item->distance_km = $response[$item->id]['distance'] ?? $item->haversine_distance;

    //         $distanceScore = 1 / (($item->distance_km ?? 999) + 1);
    //         $ratingScore = ($item->penilaian ?? 0) / 5;
    //         $hargaScore = 1 / (($item->harga_min ?? 1) + 1);

    //         $item->score =
    //             ($distanceScore * 40) +
    //             ($ratingScore * 25) +
    //             ($hargaScore * 20) +
    //             ($kategoriMatch * 10) +
    //             ($fasilitasMatch * 5);
    //     }

    //     // $data = $query->distinct()->get();
    //     $data = $data->sortByDesc('score')->values();


    //     return view('wisatawan.pencarian.hasil-pencarian', compact('data', 'kategori', 'fasilitas', 'favoritIds', 'keyword'));
    // }

    // public function search(Request $request)
    // {
    //     $keyword = $request->keyword ?? 'Rekomendasi Kuliner';
    //     $kategori = Kategori::all();
    //     $fasilitas = Fasilitas::all();
    //     $wisatawan = Wisatawan::where('user_id', Auth::id())->first();
    //     $favoritIds = [];
    //     if ($wisatawan) {
    //         $favoritIds = KulinerFavorit::where('id_wisatawan', $wisatawan->id_wisatawan)
    //             ->pluck('id_wisata_kuliner')
    //             ->toArray();
    //     }

    //     $query = WisataKuliner::query()->with(['fasilitas', 'kategori']);

    //     $lat = $request->lat;
    //     $lng = $request->lng;

    //     // keyword
    //     $keyword = $request->keyword;

    //     $isRekomendasi = false;

    //     if (!$keyword || trim($keyword) === '') {
    //         $isRekomendasi = true;
    //     }

    //     if ($request->keyword) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('nama', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kecamatan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kelurahan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('alamat', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('deskripsi', 'like', '%' . $request->keyword . '%');
    //         });
    //     }

    //     $useHargaFilter =
    //         ($request->minharga && $request->minharga != 0) ||
    //         ($request->maxharga && $request->maxharga != 1000000);

    //     $useRatingFilter =
    //         ($request->minrating && $request->minrating != 0) ||
    //         ($request->maxrating && $request->maxrating != 5);

    //     $useJarakFilter =
    //         ($request->jarak && $request->jarak > 0);

    //     // penilaian
    //     if ($useRatingFilter) {
    //         $query->whereBetween('penilaian', [
    //             $request->minrating,
    //             $request->maxrating
    //         ]);
    //     }

    //     // harga
    //     if ($useHargaFilter) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('harga_max', '>=', $request->minharga)
    //                 ->where('harga_min', '<=', $request->maxharga);
    //         });
    //     }

    //     // haversine
    //     if ($request->lat && $request->lng && $request->jarak) {
    //         $lat = $request->lat;
    //         $lng = $request->lng;
    //         $jarak = $request->jarak;

    //         $query->selectRaw("
    //         *,
    //             (
    //                 6371 * 2 * ATAN2(
    //                     SQRT(
    //                         POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                         COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                         POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                     ),
    //                     SQRT(
    //                         1 - (
    //                             POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                             COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                             POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                         )
    //                     )
    //                 )
    //             ) AS haversine_distance
    //         ", [
    //             $lat,
    //             $lat,
    //             $lng,
    //             $lat,
    //             $lat,
    //             $lng
    //         ]);


    //         if ($useJarakFilter) {
    //             $query->having('distance_km', '<=', $request->jarak);
    //         }

    //         // $query->orderBy("distance", "asc");
    //     }

    //     $data = $query->limit(50)->get();

    //     // preferensi
    //     $preferensiKuliner = DB::table('preferensi')
    //         ->where('id_wisatawan', $wisatawan->id_wisatawan)
    //         ->pluck('id_kategori')
    //         ->toArray();

    //     if ($request->lat && $request->lng && count($data) > 0) {

    //         $origin = $request->lat . ',' . $request->lng;

    //         $destinations = $data->map(function ($item) {
    //             return $item->latitude . ',' . $item->longitude;
    //         })->join('|');

    //         $apiKey = 'AIzaSyD-gBdR_gqZTd8B6jz3mVJWI-pqC_jPlAI';

    //         $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$origin}&destinations={$destinations}&key={$apiKey}";

    //         $response = file_get_contents($url);
    //         $response = json_decode($response, true);

    //         foreach ($data as $index => $item) {

    //             $distanceMeter = $response['rows'][0]['elements'][$index]['distance']['value'] ?? null;
    //             // $durationText = $response['rows'][0]['elements'][$index]['duration']['value'] ?? null;

    //             $item->distance_km = $distanceMeter ? $distanceMeter / 1000 : $item->haversine_distance;
    //             // $item->duration_min = $durationText ? $durationText / 60 : null;
    //         }
    //     }

    //     $totalFasilitasUser = count($request->fasilitas ?? []);

    //     foreach ($data as $item) {
    //         $listKategori = $request->kategori ?? [];
    //         if (!empty($listKategori)) {
    //             $cariKategori = $listKategori;
    //         } elseif (!empty($preferensiKuliner)) {
    //             $cariKategori = $preferensiKuliner;
    //         } else {
    //             $cariKategori = [];
    //         }

    //         $kategoriMatch = 0;
    //         if ($request->kategori) {
    //             $kategoriMatch = DB::table('kategori_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_kategori', $request->kategori)
    //                 ->count();
    //         }

    //         $fasilitasMatch = 0;
    //         if ($request->fasilitas) {
    //             $fasilitasMatch = DB::table('fasilitas_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_fasilitas', $request->fasilitas)
    //                 ->count();
    //         }

    //         // $item->distance_km = $response[$item->id]['distance'] ?? $item->haversine_distance;

    //         $distanceScore = 1 / (($item->distance_km ?? 999) + 1);
    //         $ratingScore = ($item->penilaian ?? 0) / 5;
    //         $hargaScore = 1 / (($item->harga_min ?? 1) + 1);

    //         $item->score =
    //             ($distanceScore * 40) +
    //             ($ratingScore * 25) +
    //             ($hargaScore * 20) +
    //             ($kategoriMatch * 10) +
    //             ($fasilitasMatch * 5);
    //     }

    //     // $data = $query->distinct()->get();
    //     $data = $data->sortByDesc('score')->values();


    //     return view('wisatawan.pencarian.hasil-pencarian', compact('data', 'kategori', 'fasilitas', 'favoritIds', 'keyword'));
    // }

    // public function search(Request $request)
    // {
    //     $kategori = Kategori::all();
    //     $fasilitas = Fasilitas::all();

    //     $wisatawan = Wisatawan::where('user_id', Auth::id())->first();

    //     $favoritIds = [];
    //     if ($wisatawan) {
    //         $favoritIds = KulinerFavorit::where('id_wisatawan', $wisatawan->id_wisatawan)
    //             ->pluck('id_wisata_kuliner')
    //             ->toArray();
    //     }

    //     $query = WisataKuliner::with(['fasilitas', 'kategori']);

    //     $lat = $request->lat;
    //     $lng = $request->lng;

    //     $keyword = trim($request->keyword ?? '');

    //     $isRekomendasi = false;

    //     if ($keyword === '' || $keyword === 'Rekomendasi Kuliner') {
    //         $isRekomendasi = true;
    //     }

    //     if (!$isRekomendasi) {
    //         $query->where(function ($q) use ($keyword) {
    //             $q->where('nama', 'like', "%{$keyword}%")
    //                 ->orWhere('alamat', 'like', "%{$keyword}%")
    //                 ->orWhere('kecamatan', 'like', "%{$keyword}%")
    //                 ->orWhere('kelurahan', 'like', "%{$keyword}%")
    //                 ->orWhere('deskripsi', 'like', "%{$keyword}%");
    //         });
    //     }

    //     if ($request->minrating !== null && $request->maxrating !== null) {
    //         $query->whereBetween('penilaian', [
    //             $request->minrating,
    //             $request->maxrating
    //         ]);
    //     }

    //     if ($request->minharga !== null && $request->maxharga !== null) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('harga_max', '>=', $request->minharga)
    //                 ->where('harga_min', '<=', $request->maxharga);
    //         });
    //     }

    //     if ($lat && $lng && $request->jarak) {

    //         $query->selectRaw("
    //         wisata_kuliner.*,
    //         (
    //             6371 * 2 * ATAN2(
    //                 SQRT(
    //                     POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                     COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                     POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                 ),
    //                 SQRT(
    //                     1 - (
    //                         POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                         COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                         POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                     )
    //                 )
    //             )
    //         ) AS distance_km
    //     ", [
    //             $lat,
    //             $lat,
    //             $lng,
    //             $lat,
    //             $lat,
    //             $lng
    //         ]);

    //         $query->having("distance_km", "<=", $request->jarak);
    //     }

    //     $data = $query->limit(50)->get();

    //     if ($lat && $lng && $data->count() > 0) {

    //         $origin = $lat . ',' . $lng;

    //         $destinations = $data->map(fn($i) => $i->latitude . ',' . $i->longitude)->join('|');

    //         $apiKey = 'API_KEY';

    //         $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$origin}&destinations={$destinations}&key={$apiKey}";

    //         $response = json_decode(file_get_contents($url), true);

    //         foreach ($data as $index => $item) {
    //             $distanceValue = $response['rows'][0]['elements'][$index]['distance']['value'] ?? null;
    //             $item->distance_km = $distanceValue ? $distanceValue / 1000 : null;
    //         }

    //         if ($request->jarak) {
    //             $data = $data->filter(fn($item) => $item->distance_km <= $request->jarak);
    //         }
    //     }

    //     foreach ($data as $item) {

    //         $kategoriMatch = 0;
    //         if ($request->kategori) {
    //             $kategoriMatch = DB::table('kategori_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_kategori', $request->kategori)
    //                 ->count();
    //         }

    //         $fasilitasMatch = 0;
    //         if ($request->fasilitas) {
    //             $fasilitasMatch = DB::table('fasilitas_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_fasilitas', $request->fasilitas)
    //                 ->count();
    //         }

    //         $item->score =
    //             (1000 - ($item->distance_km * 100)) +
    //             ($item->penilaian * 50) +
    //             ((1000000 - $item->harga_min) / 10000) +
    //             ($kategoriMatch * 30) +
    //             ($fasilitasMatch * 20);
    //     }

    //     $data = $data->sortByDesc('score')->values();

    //     return view('wisatawan.pencarian.hasil-pencarian', compact(
    //         'data',
    //         'kategori',
    //         'fasilitas',
    //         'favoritIds'
    //     ));
    // }

    // public function search(Request $request)
    // {
    //     $keyword = $request->keyword ?? 'Rekomendasi Kuliner';
    //     $kategori = Kategori::all();
    //     $fasilitas = Fasilitas::all();
    //     $wisatawan = Wisatawan::where('user_id', Auth::id())->first();
    //     $favoritIds = [];
    //     if ($wisatawan) {
    //         $favoritIds = KulinerFavorit::where('id_wisatawan', $wisatawan->id_wisatawan)
    //             ->pluck('id_wisata_kuliner')
    //             ->toArray();
    //     }

    //     $query = WisataKuliner::query()->with(['fasilitas', 'kategori']);

    //     $lat = $request->lat;
    //     $lng = $request->lng;

    //     // keyword
    //     $keyword = trim($request->keyword ?? '');

    //     $isRekomendasi = false;

    //     if ($keyword === '' || $keyword === 'Rekomendasi Kuliner') {
    //         $isRekomendasi = true;
    //     }

    //     if (!$isRekomendasi) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('nama', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kecamatan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kelurahan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('alamat', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('deskripsi', 'like', '%' . $request->keyword . '%');
    //         });
    //     }

    //     $useHargaFilter =
    //         ($request->minharga && $request->minharga != 0) ||
    //         ($request->maxharga && $request->maxharga != 1000000);

    //     $useRatingFilter =
    //         ($request->minrating && $request->minrating != 0) ||
    //         ($request->maxrating && $request->maxrating != 5);

    //     $useJarakFilter =
    //         ($request->jarak && $request->jarak > 0);

    //     // penilaian
    //     if ($useRatingFilter) {
    //         $query->whereBetween('penilaian', [
    //             $request->minrating,
    //             $request->maxrating
    //         ]);
    //     }

    //     // harga
    //     if ($useHargaFilter) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('harga_max', '>=', $request->minharga)
    //                 ->where('harga_min', '<=', $request->maxharga);
    //         });
    //     }

    //     // haversine
    //     if ($request->lat && $request->lng && $request->jarak) {
    //         $lat = $request->lat;
    //         $lng = $request->lng;
    //         $jarak = $request->jarak;

    //         $query->selectRaw("
    //         *,
    //             (
    //                 6371 * 2 * ATAN2(
    //                     SQRT(
    //                         POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                         COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                         POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                     ),
    //                     SQRT(
    //                         1 - (
    //                             POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                             COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                             POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                         )
    //                     )
    //                 )
    //             ) AS haversine_distance
    //         ", [
    //             $lat,
    //             $lat,
    //             $lng,
    //             $lat,
    //             $lat,
    //             $lng
    //         ]);


    //         if ($useJarakFilter) {
    //             $query->having('distance_km', '<=', $request->jarak);
    //         }

    //         // $query->orderBy("distance", "asc");
    //     }

    //     $data = $query->limit(50)->get();

    //     // preferensi
    //     $preferensiKuliner = DB::table('preferensi')
    //         ->where('id_wisatawan', $wisatawan->id_wisatawan)
    //         ->pluck('id_kategori')
    //         ->toArray();

    //     if ($request->lat && $request->lng && count($data) > 0) {

    //         $origin = $request->lat . ',' . $request->lng;

    //         $destinations = $data->map(function ($item) {
    //             return $item->latitude . ',' . $item->longitude;
    //         })->join('|');

    //         $apiKey = 'AIzaSyD-gBdR_gqZTd8B6jz3mVJWI-pqC_jPlAI';

    //         $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$origin}&destinations={$destinations}&key={$apiKey}";

    //         $response = file_get_contents($url);
    //         $response = json_decode($response, true);

    //         foreach ($data as $index => $item) {

    //             $distanceMeter = $response['rows'][0]['elements'][$index]['distance']['value'] ?? null;
    //             // $durationText = $response['rows'][0]['elements'][$index]['duration']['value'] ?? null;

    //             $item->distance_km = $distanceMeter ? $distanceMeter / 1000 : $item->haversine_distance;
    //             // $item->duration_min = $durationText ? $durationText / 60 : null;
    //         }
    //     }

    //     $totalFasilitasUser = count($request->fasilitas ?? []);

    //     foreach ($data as $item) {
    //         $listKategori = $request->kategori ?? [];
    //         if (!empty($listKategori)) {
    //             $cariKategori = $listKategori;
    //         } elseif (!empty($preferensiKuliner)) {
    //             $cariKategori = $preferensiKuliner;
    //         } else {
    //             $cariKategori = [];
    //         }

    //         $kategoriMatch = 0;
    //         if ($request->kategori) {
    //             $kategoriMatch = DB::table('kategori_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_kategori', $request->kategori)
    //                 ->count();
    //         }

    //         $fasilitasMatch = 0;
    //         if ($request->fasilitas) {
    //             $fasilitasMatch = DB::table('fasilitas_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_fasilitas', $request->fasilitas)
    //                 ->count();
    //         }

    //         // $item->distance_km = $response[$item->id]['distance'] ?? $item->haversine_distance;

    //         $distanceScore = 1 / (($item->distance_km ?? 999) + 1);
    //         $ratingScore = ($item->penilaian ?? 0) / 5;
    //         $hargaScore = 1 / (($item->harga_min ?? 1) + 1);

    //         $item->score =
    //             ($distanceScore * 40) +
    //             ($ratingScore * 25) +
    //             ($hargaScore * 20) +
    //             ($kategoriMatch * 10) +
    //             ($fasilitasMatch * 5);
    //     }

    //     // $data = $query->distinct()->get();
    //     $data = $data->sortByDesc('score')->values();


    //     return view('wisatawan.pencarian.hasil-pencarian', compact('data', 'kategori', 'fasilitas', 'favoritIds', 'keyword'));
    // }

    // public function search(Request $request)
    // {
    //     $keyword = $request->keyword ?? 'Rekomendasi Kuliner';
    //     $kategori = Kategori::all();
    //     $fasilitas = Fasilitas::all();
    //     $wisatawan = Wisatawan::where('user_id', Auth::id())->first();
    //     $favoritIds = [];
    //     if ($wisatawan) {
    //         $favoritIds = KulinerFavorit::where('id_wisatawan', $wisatawan->id_wisatawan)
    //             ->pluck('id_wisata_kuliner')
    //             ->toArray();
    //     }

    //     $query = WisataKuliner::query()->with(['fasilitas', 'kategori']);

    //     $lat = $request->lat;
    //     $lng = $request->lng;

    //     // keyword
    //     $keyword = trim($request->keyword ?? '');

    //     $isRekomendasi = false;

    //     if ($keyword === '' || $keyword === 'Rekomendasi Kuliner') {
    //         $isRekomendasi = true;
    //     }

    //     if (!$isRekomendasi) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('nama', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kecamatan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kelurahan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('alamat', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('deskripsi', 'like', '%' . $request->keyword . '%');
    //         });
    //     }

    //     $useHargaFilter =
    //         ($request->minharga && $request->minharga != 0) ||
    //         ($request->maxharga && $request->maxharga != 1000000);

    //     $useRatingFilter =
    //         ($request->minrating && $request->minrating != 0) ||
    //         ($request->maxrating && $request->maxrating != 5);

    //     $useJarakFilter =
    //         ($request->jarak && $request->jarak > 0);

    //     // penilaian
    //     if ($useRatingFilter) {
    //         $query->whereBetween('penilaian', [
    //             $request->minrating,
    //             $request->maxrating
    //         ]);
    //     }

    //     // harga
    //     if ($useHargaFilter) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('harga_max', '>=', $request->minharga)
    //                 ->where('harga_min', '<=', $request->maxharga);
    //         });
    //     }

    //     // haversine
    //     if ($request->lat && $request->lng && $request->jarak) {
    //         $lat = $request->lat;
    //         $lng = $request->lng;
    //         $jarak = $request->jarak;

    //         $query->selectRaw("
    //         *,
    //             (
    //                 6371 * 2 * ATAN2(
    //                     SQRT(
    //                         POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                         COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                         POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                     ),
    //                     SQRT(
    //                         1 - (
    //                             POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                             COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                             POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                         )
    //                     )
    //                 )
    //             ) AS haversine_distance
    //         ", [
    //             $lat,
    //             $lat,
    //             $lng,
    //             $lat,
    //             $lat,
    //             $lng
    //         ]);


    //         if ($useJarakFilter) {
    //             $query->having('distance_km', '<=', $request->jarak);
    //         }

    //         // $query->orderBy("distance", "asc");
    //     }

    //     $data = $query->limit(50)->get();

    //     // preferensi
    //     $preferensiKuliner = DB::table('preferensi')
    //         ->where('id_wisatawan', $wisatawan->id_wisatawan)
    //         ->pluck('id_kategori')
    //         ->toArray();

    //     if ($request->lat && $request->lng && count($data) > 0) {

    //         $origin = $request->lat . ',' . $request->lng;

    //         $destinations = $data->map(function ($item) {
    //             return $item->latitude . ',' . $item->longitude;
    //         })->join('|');

    //         $apiKey = 'AIzaSyD-gBdR_gqZTd8B6jz3mVJWI-pqC_jPlAI';

    //         $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$origin}&destinations={$destinations}&key={$apiKey}";

    //         $response = file_get_contents($url);
    //         $response = json_decode($response, true);

    //         foreach ($data as $index => $item) {

    //             $distanceMeter = $response['rows'][0]['elements'][$index]['distance']['value'] ?? null;
    //             // $durationText = $response['rows'][0]['elements'][$index]['duration']['value'] ?? null;

    //             $item->distance_km = $distanceMeter ? $distanceMeter / 1000 : $item->haversine_distance;
    //             // $item->duration_min = $durationText ? $durationText / 60 : null;
    //         }
    //     }

    //     $totalFasilitasUser = count($request->fasilitas ?? []);

    //     foreach ($data as $item) {
    //         $listKategori = $request->kategori ?? [];
    //         if (!empty($listKategori)) {
    //             $cariKategori = $listKategori;
    //         } elseif (!empty($preferensiKuliner)) {
    //             $cariKategori = $preferensiKuliner;
    //         } else {
    //             $cariKategori = [];
    //         }

    //         $kategoriMatch = 0;
    //         if ($request->kategori) {
    //             $kategoriMatch = DB::table('kategori_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_kategori', $request->kategori)
    //                 ->count();
    //         }

    //         $fasilitasMatch = 0;
    //         if ($request->fasilitas) {
    //             $fasilitasMatch = DB::table('fasilitas_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_fasilitas', $request->fasilitas)
    //                 ->count();
    //         }

    //         // $item->distance_km = $response[$item->id]['distance'] ?? $item->haversine_distance;

    //         $distanceScore = 1 / (($item->distance_km ?? 999) + 1);
    //         $ratingScore = ($item->penilaian ?? 0) / 5;
    //         $hargaScore = 1 / (($item->harga_min ?? 1) + 1);

    //         $item->score =
    //             ($distanceScore * 40) +
    //             ($ratingScore * 25) +
    //             ($hargaScore * 20) +
    //             ($kategoriMatch * 10) +
    //             ($fasilitasMatch * 5);
    //     }

    //     // $data = $query->distinct()->get();
    //     $data = $data->sortByDesc('score')->values();


    //     return view('wisatawan.pencarian.hasil-pencarian', compact('data', 'kategori', 'fasilitas', 'favoritIds', 'keyword'));
    // }

    // public function search(Request $request)
    // {
    //     $keyword = $request->keyword ?? 'Rekomendasi Kuliner';
    //     $kategori = Kategori::all();
    //     $fasilitas = Fasilitas::all();
    //     $wisatawan = Wisatawan::where('user_id', Auth::id())->first();
    //     $favoritIds = [];
    //     if ($wisatawan) {
    //         $favoritIds = KulinerFavorit::where('id_wisatawan', $wisatawan->id_wisatawan)
    //             ->pluck('id_wisata_kuliner')
    //             ->toArray();
    //     }

    //     $query = WisataKuliner::query()->with(['fasilitas', 'kategori']);

    //     $lat = $request->lat;
    //     $lng = $request->lng;

    //     // keyword
    //     $keyword = trim($request->keyword ?? '');

    //     $isRekomendasi = false;

    //     if ($keyword === '' || strtolower($keyword) === 'Rekomendasi Kuliner') {
    //         $isRekomendasi = true;
    //     }

    //     if (!$isRekomendasi) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('nama', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kecamatan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kelurahan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('alamat', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('deskripsi', 'like', '%' . $request->keyword . '%');
    //         });
    //     }

    //     $data = $query->get();

    //     if (!$isRekomendasi && $data->isEmpty()) {
    //         $isRekomendasi = true;

    //         $data = WisataKuliner::with(['fasilitas', 'kategori'])->get();
    //     }

    //     $useHargaFilter =
    //         ($request->minharga && $request->minharga != 0) ||
    //         ($request->maxharga && $request->maxharga != 1000000);

    //     $useRatingFilter =
    //         ($request->minrating && $request->minrating != 0) ||
    //         ($request->maxrating && $request->maxrating != 5);

    //     $useJarakFilter =
    //         ($request->jarak && $request->jarak > 0);

    //     // penilaian
    //     if ($useRatingFilter) {
    //         $query->whereBetween('penilaian', [
    //             $request->minrating,
    //             $request->maxrating
    //         ]);
    //     }

    //     // harga
    //     if ($useHargaFilter) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('harga_max', '>=', $request->minharga)
    //                 ->where('harga_min', '<=', $request->maxharga);
    //         });
    //     }

    //     // haversine
    //     if ($request->lat && $request->lng && $request->jarak) {
    //         $lat = $request->lat;
    //         $lng = $request->lng;
    //         $jarak = $request->jarak;

    //         $query->selectRaw("
    //         *,
    //             (
    //                 6371 * 2 * ATAN2(
    //                     SQRT(
    //                         POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                         COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                         POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                     ),
    //                     SQRT(
    //                         1 - (
    //                             POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                             COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                             POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                         )
    //                     )
    //                 )
    //             ) AS haversine_distance
    //         ", [
    //             $lat,
    //             $lat,
    //             $lng,
    //             $lat,
    //             $lat,
    //             $lng
    //         ]);


    //         if ($useJarakFilter) {
    //             $query->having('distance_km', '<=', $request->jarak);
    //         }

    //         // $query->orderBy("distance", "asc");
    //     }

    //     $data = $query->limit(50)->get();

    //     // preferensi
    //     $preferensiKuliner = DB::table('preferensi')
    //         ->where('id_wisatawan', $wisatawan->id_wisatawan)
    //         ->pluck('id_kategori')
    //         ->toArray();

    //     if ($request->lat && $request->lng && count($data) > 0) {

    //         $origin = $request->lat . ',' . $request->lng;

    //         $destinations = $data->map(function ($item) {
    //             return $item->latitude . ',' . $item->longitude;
    //         })->join('|');

    //         $apiKey = 'AIzaSyD-gBdR_gqZTd8B6jz3mVJWI-pqC_jPlAI';

    //         $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$origin}&destinations={$destinations}&key={$apiKey}";

    //         $response = file_get_contents($url);
    //         $response = json_decode($response, true);

    //         foreach ($data as $index => $item) {

    //             $distanceMeter = $response['rows'][0]['elements'][$index]['distance']['value'] ?? null;
    //             // $durationText = $response['rows'][0]['elements'][$index]['duration']['value'] ?? null;

    //             $item->distance_km = $distanceMeter ? $distanceMeter / 1000 : $item->haversine_distance;
    //             // $item->duration_min = $durationText ? $durationText / 60 : null;
    //         }
    //     }

    //     $totalFasilitasUser = count($request->fasilitas ?? []);

    //     foreach ($data as $item) {
    //         $listKategori = $request->kategori ?? [];
    //         if (!empty($listKategori)) {
    //             $cariKategori = $listKategori;
    //         } elseif (!empty($preferensiKuliner)) {
    //             $cariKategori = $preferensiKuliner;
    //         } else {
    //             $cariKategori = [];
    //         }

    //         $kategoriMatch = 0;
    //         if ($request->kategori) {
    //             $kategoriMatch = DB::table('kategori_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_kategori', $request->kategori)
    //                 ->count();
    //         }

    //         $fasilitasMatch = 0;
    //         if ($request->fasilitas) {
    //             $fasilitasMatch = DB::table('fasilitas_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_fasilitas', $request->fasilitas)
    //                 ->count();
    //         }

    //         // $item->distance_km = $response[$item->id]['distance'] ?? $item->haversine_distance;

    //         $distanceScore = 1 / (($item->distance_km ?? 999) + 1);
    //         $ratingScore = ($item->penilaian ?? 0) / 5;
    //         $hargaScore = 1 / (($item->harga_min ?? 1) + 1);

    //         $item->score =
    //             ($distanceScore * 40) +
    //             ($ratingScore * 25) +
    //             ($hargaScore * 20) +
    //             ($kategoriMatch * 10) +
    //             ($fasilitasMatch * 5);
    //     }

    //     // $data = $query->distinct()->get();
    //     $data = $data->sortByDesc('score')->values();


    //     return view('wisatawan.pencarian.hasil-pencarian', compact('data', 'kategori', 'fasilitas', 'favoritIds', 'keyword'));
    // }

    // public function search(Request $request)
    // {
    //     $kategori = Kategori::all();
    //     $fasilitas = Fasilitas::all();

    //     $wisatawan = Wisatawan::where('user_id', Auth::id())->first();
    //     $favoritIds = [];
    //     $preferensiKuliner = [];
    //     if ($wisatawan) {
    //         $favoritIds = KulinerFavorit::where('id_wisatawan', $wisatawan->id_wisatawan)
    //             ->pluck('id_wisata_kuliner')
    //             ->toArray();

    //         $preferensiKuliner = DB::table('preferensi')
    //             ->where('id_wisatawan', $wisatawan->id_wisatawan)
    //             ->pluck('id_kategori')
    //             ->toArray();
    //     }

    //     $lat = $request->lat;
    //     $lng = $request->lng;

    //     $query = WisataKuliner::query()->with(['fasilitas', 'kategori']);

    //     // keyword
    //     $keyword        = trim($request->keyword ?? '');
    //     $isRekomendasi  = ($keyword === '' || strtolower($keyword) === 'rekomendasi kuliner');
    //     $displayKeyword = $isRekomendasi ? 'Rekomendasi Kuliner' : $keyword;
    //     $keyword = trim($request->keyword ?? '');

    //     $isRekomendasi = false;

    //     if ($keyword === '' || strtolower($keyword) === 'Rekomendasi Kuliner') {
    //         $isRekomendasi = true;
    //     }

    //     if (!$isRekomendasi) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('nama', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kecamatan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('kelurahan', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('alamat', 'like', '%' . $request->keyword . '%')
    //                 ->orWhere('deskripsi', 'like', '%' . $request->keyword . '%');
    //         });
    //     }

    //     $data = $query->get();

    //     if (!$isRekomendasi && $data->isEmpty()) {
    //         $isRekomendasi = true;

    //         $data = WisataKuliner::with(['fasilitas', 'kategori'])->get();
    //     }

    //     $useHargaFilter =
    //         ($request->minharga && $request->minharga != 0) ||
    //         ($request->maxharga && $request->maxharga != 1000000);

    //     $useRatingFilter =
    //         ($request->minrating && $request->minrating != 0) ||
    //         ($request->maxrating && $request->maxrating != 5);

    //     $useJarakFilter =
    //         ($request->jarak && $request->jarak > 0);

    //     // penilaian
    //     if ($useRatingFilter) {
    //         $query->whereBetween('penilaian', [
    //             $request->minrating,
    //             $request->maxrating
    //         ]);
    //     }

    //     // harga
    //     if ($useHargaFilter) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('harga_max', '>=', $request->minharga)
    //                 ->where('harga_min', '<=', $request->maxharga);
    //         });
    //     }

    //     // haversine
    //     if ($request->lat && $request->lng && $request->jarak) {
    //         $lat = $request->lat;
    //         $lng = $request->lng;
    //         $jarak = $request->jarak;

    //         $query->selectRaw("
    //         *,
    //             (
    //                 6371 * 2 * ATAN2(
    //                     SQRT(
    //                         POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                         COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                         POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                     ),
    //                     SQRT(
    //                         1 - (
    //                             POWER(SIN(RADIANS(latitude - ?) / 2), 2) +
    //                             COS(RADIANS(?)) * COS(RADIANS(latitude)) *
    //                             POWER(SIN(RADIANS(longitude - ?) / 2), 2)
    //                         )
    //                     )
    //                 )
    //             ) AS haversine_distance
    //         ", [
    //             $lat,
    //             $lat,
    //             $lng,
    //             $lat,
    //             $lat,
    //             $lng
    //         ]);


    //         if ($useJarakFilter) {
    //             $query->having('distance_km', '<=', $request->jarak);
    //         }

    //         // $query->orderBy("distance", "asc");
    //     }

    //     $data = $query->limit(50)->get();

    //     // preferensi
    //     $preferensiKuliner = DB::table('preferensi')
    //         ->where('id_wisatawan', $wisatawan->id_wisatawan)
    //         ->pluck('id_kategori')
    //         ->toArray();

    //     if ($request->lat && $request->lng && count($data) > 0) {

    //         $origin = $request->lat . ',' . $request->lng;

    //         $destinations = $data->map(function ($item) {
    //             return $item->latitude . ',' . $item->longitude;
    //         })->join('|');

    //         $apiKey = 'AIzaSyD-gBdR_gqZTd8B6jz3mVJWI-pqC_jPlAI';

    //         $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$origin}&destinations={$destinations}&key={$apiKey}";

    //         $response = file_get_contents($url);
    //         $response = json_decode($response, true);

    //         foreach ($data as $index => $item) {

    //             $distanceMeter = $response['rows'][0]['elements'][$index]['distance']['value'] ?? null;
    //             // $durationText = $response['rows'][0]['elements'][$index]['duration']['value'] ?? null;

    //             $item->distance_km = $distanceMeter ? $distanceMeter / 1000 : $item->haversine_distance;
    //             // $item->duration_min = $durationText ? $durationText / 60 : null;
    //         }
    //     }

    //     $totalFasilitasUser = count($request->fasilitas ?? []);

    //     foreach ($data as $item) {
    //         $listKategori = $request->kategori ?? [];
    //         if (!empty($listKategori)) {
    //             $cariKategori = $listKategori;
    //         } elseif (!empty($preferensiKuliner)) {
    //             $cariKategori = $preferensiKuliner;
    //         } else {
    //             $cariKategori = [];
    //         }

    //         $kategoriMatch = 0;
    //         if ($request->kategori) {
    //             $kategoriMatch = DB::table('kategori_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_kategori', $request->kategori)
    //                 ->count();
    //         }

    //         $fasilitasMatch = 0;
    //         if ($request->fasilitas) {
    //             $fasilitasMatch = DB::table('fasilitas_wisata_kuliner')
    //                 ->where('id_wisata_kuliner', $item->id_wisata_kuliner)
    //                 ->whereIn('id_fasilitas', $request->fasilitas)
    //                 ->count();
    //         }

    //         // $item->distance_km = $response[$item->id]['distance'] ?? $item->haversine_distance;

    //         $distanceScore = 1 / (($item->distance_km ?? 999) + 1);
    //         $ratingScore = ($item->penilaian ?? 0) / 5;
    //         $hargaScore = 1 / (($item->harga_min ?? 1) + 1);

    //         $item->score =
    //             ($distanceScore * 40) +
    //             ($ratingScore * 25) +
    //             ($hargaScore * 20) +
    //             ($kategoriMatch * 10) +
    //             ($fasilitasMatch * 5);
    //     }

    //     // $data = $query->distinct()->get();
    //     $data = $data->sortByDesc('score')->values();


    //     return view('wisatawan.pencarian.hasil-pencarian', compact('data', 'kategori', 'fasilitas', 'favoritIds', 'keyword'));
    // }

    // public function search(Request $request)
    // {
    //     $kategori  = Kategori::all();
    //     $fasilitas = Fasilitas::all();

    //     $wisatawan         = Wisatawan::where('user_id', Auth::id())->first();
    //     $favoritIds        = [];
    //     $preferensiKuliner = [];

    //     if ($wisatawan) {
    //         $favoritIds = KulinerFavorit::where('id_wisatawan', $wisatawan->id_wisatawan)
    //             ->pluck('id_wisata_kuliner')
    //             ->toArray();

    //         $preferensiKuliner = DB::table('preferensi')
    //             ->where('id_wisatawan', $wisatawan->id_wisatawan)
    //             ->pluck('id_kategori')
    //             ->toArray();
    //     }

    //     // keyword
    //     $keyword        = trim($request->keyword ?? '');
    //     $isRekomendasi  = ($keyword === '' || strtolower($keyword) === 'rekomendasi kuliner');
    //     $displayKeyword = $isRekomendasi ? 'Rekomendasi Kuliner' : $keyword;

    //     $query = WisataKuliner::query()->with(['fasilitas', 'kategori']);

    //     if (!$isRekomendasi) {
    //         $query->where(function ($q) use ($keyword) {
    //             $q->where('nama',        'like', "%{$keyword}%")
    //                 ->orWhere('kecamatan', 'like', "%{$keyword}%")
    //                 ->orWhere('kelurahan', 'like', "%{$keyword}%")
    //                 ->orWhere('alamat',    'like', "%{$keyword}%")
    //                 ->orWhere('deskripsi', 'like', "%{$keyword}%");
    //         });
    //     }

    //     // rating
    //     $useRatingFilter = ($request->filled('minrating') && $request->minrating != 0)
    //         || ($request->filled('maxrating') && $request->maxrating != 5);
    //     if ($useRatingFilter) {
    //         $query->whereBetween('penilaian', [$request->minrating, $request->maxrating]);
    //     }

    //     // harga
    //     $useHargaFilter = ($request->filled('minharga') && $request->minharga != 0)
    //         || ($request->filled('maxharga') && $request->maxharga != 1000000);
    //     if ($useHargaFilter) {
    //         $query->where('harga_max', '>=', $request->minharga)
    //             ->where('harga_min', '<=', $request->maxharga);
    //     }

    //     $data = $query->limit(50)->get();

    //     if (!$isRekomendasi && $data->isEmpty()) {
    //         $isRekomendasi  = true;
    //         $displayKeyword = 'Rekomendasi Kuliner';

    //         $query2 = WisataKuliner::query()->with(['fasilitas', 'kategori']);

    //         if ($useRatingFilter) {
    //             $query2->whereBetween('penilaian', [$request->minrating, $request->maxrating]);
    //         }
    //         if ($useHargaFilter) {
    //             $query2->where('harga_max', '>=', $request->minharga)
    //                 ->where('harga_min', '<=', $request->maxharga);
    //         }

    //         $data = $query2->limit(50)->get();
    //     }

    //     $lat = $request->lat;
    //     $lng = $request->lng;

    //     if ($lat && $lng && $data->isNotEmpty()) {
    //         foreach ($data as $item) {
    //             $dlat = deg2rad($item->latitude - $lat);
    //             $dlng = deg2rad($item->longitude - $lng);
    //             $a    = sin($dlat / 2) ** 2
    //                 + cos(deg2rad($lat)) * cos(deg2rad($item->latitude)) * sin($dlng / 2) ** 2;
    //             $item->distance_km = 6371 * 2 * atan2(sqrt($a), sqrt(1 - $a));
    //         }

    //         if ($request->filled('jarak') && $request->jarak > 0) {
    //             $data = $data->filter(fn($item) => $item->distance_km <= $request->jarak)->values();
    //         }

    //         // Google Distance Matrix (lebih akurat)
    //         try {
    //             $origin       = "{$lat},{$lng}";
    //             $destinations = $data->map(fn($i) => "{$i->latitude},{$i->longitude}")->join('|');
    //             $apiKey       = 'AIzaSyD-gBdR_gqZTd8B6jz3mVJWI-pqC_jPlAI';
    //             $url          = "https://maps.googleapis.com/maps/api/distancematrix/json"
    //                 . "?origins={$origin}&destinations={$destinations}&key={$apiKey}";

    //             $response = json_decode(file_get_contents($url), true);

    //             foreach ($data as $index => $item) {
    //                 $meter = $response['rows'][0]['elements'][$index]['distance']['value'] ?? null;
    //                 if ($meter !== null) {
    //                     $item->distance_km = $meter / 1000;
    //                 }
    //             }
    //         } catch (\Exception $e) {
    //         }
    //     }

    //     $kategoriFilter  = $request->kategori  ?? [];
    //     $fasilitasFilter = $request->fasilitas ?? [];
    //     $cariKategori    = !empty($kategoriFilter) ? $kategoriFilter : $preferensiKuliner;

    //     $kulinerIds = $data->pluck('id_wisata_kuliner')->toArray();

    //     $kategoriMatchMap = [];
    //     if (!empty($cariKategori)) {
    //         $kategoriMatchMap = DB::table('kategori_wisata_kuliner')
    //             ->whereIn('id_wisata_kuliner', $kulinerIds)
    //             ->whereIn('id_kategori', $cariKategori)
    //             ->select('id_wisata_kuliner', DB::raw('COUNT(*) as match_count'))
    //             ->groupBy('id_wisata_kuliner')
    //             ->pluck('match_count', 'id_wisata_kuliner')
    //             ->toArray();
    //     }

    //     $fasilitasMatchMap = [];
    //     if (!empty($fasilitasFilter)) {
    //         $fasilitasMatchMap = DB::table('fasilitas_wisata_kuliner')
    //             ->whereIn('id_wisata_kuliner', $kulinerIds)
    //             ->whereIn('id_fasilitas', $fasilitasFilter)
    //             ->select('id_wisata_kuliner', DB::raw('COUNT(*) as match_count'))
    //             ->groupBy('id_wisata_kuliner')
    //             ->pluck('match_count', 'id_wisata_kuliner')
    //             ->toArray();
    //     }

    //     foreach ($data as $item) {
    //         $id = $item->id_wisata_kuliner;

    //         $distanceScore  = 1 / (($item->distance_km ?? 999) + 1);
    //         $ratingScore    = ($item->penilaian ?? 0) / 5;
    //         $hargaScore     = 1 / (($item->harga_min ?? 1) + 1);
    //         $kategoriMatch  = $kategoriMatchMap[$id]  ?? 0;
    //         $fasilitasMatch = $fasilitasMatchMap[$id] ?? 0;

    //         $item->score =
    //             ($distanceScore  * 40) +
    //             ($ratingScore    * 25) +
    //             ($hargaScore     * 20) +
    //             ($kategoriMatch  * 10) +
    //             ($fasilitasMatch *  5);
    //     }

    //     $data = $data->sortByDesc('score')->values();

    //     return view('wisatawan.pencarian.hasil-pencarian', compact(
    //         'data',
    //         'kategori',
    //         'fasilitas',
    //         'favoritIds',
    //         'displayKeyword'
    //     ));
    // }

    public function search(Request $request)
    {
        $keyword = $request->keyword ?? 'Rekomendasi Kuliner';
        $kategori = Kategori::all();
        $fasilitas = Fasilitas::all();
        $wisatawan = Wisatawan::where('user_id', Auth::id())->first();
        $favoritIds = [];
        if ($wisatawan) {
            $favoritIds = KulinerFavorit::where('id_wisatawan', $wisatawan->id_wisatawan)
                ->pluck('id_wisata_kuliner')
                ->toArray();
        }
        $user = Auth::user();

        $kategoriUser = $user->wisatawan
            ? $user->wisatawan->preferensi()->pluck('id_kategori')->toArray()
            : [];

        $query = WisataKuliner::query()->with(['fasilitas', 'kategori'])->where('status', 'Ditampilkan');
        
        $lat = $request->lat;
        $lng = $request->lng;

        // keyword
        $keyword = trim($request->keyword ?? '');
        $keywordLower = strtolower($keyword);

        $isTerdekat =
            str_contains($keywordLower, 'terdekat') ||
            str_contains($keywordLower, 'dekat') ||
            str_contains($keywordLower, 'near');

        $isRekomendasi =
            ($keyword === '' ||
            str_contains($keywordLower, 'rekomendasi') ||
            str_contains($keywordLower, 'kuliner') ||
            str_contains($keywordLower, 'recommendation') ||
            str_contains($keywordLower, 'culinary')) && !$isTerdekat;

        $preferensiKuliner = [];
        if ($wisatawan) {
            $preferensiKuliner = DB::table('preferensi')
                ->where('id_wisatawan', $wisatawan->id_wisatawan)
                ->pluck('id_kategori')
                ->toArray();
        }

        // if ($isRekomendasi) {
        //     $request->merge([
        //         'minharga' => 0,
        //         'maxharga' => 500000,
        //         'minrating' => 0,
        //         'maxrating' => 5,
        //         'jarak' => 10,
        //     ]);

        //     if (!$request->has('kategori') || empty($request->kategori)) {
        //         if (!empty($preferensiKuliner)) {
        //             $request->merge([
        //                 'kategori' => $preferensiKuliner
        //             ]);
        //         }
        //     }
        // }
        // $data = $query->limit(50)->get();

        // $isRekomendasi = false;
        // $isFallback = false;

        
        // if ($keyword === '' || strtolower($keyword) === 'rekomendasi kuliner') {
        //     $isRekomendasi = true;
        // }

        if (!$isRekomendasi && !$isTerdekat) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->keyword . '%')
                    ->orWhere('kecamatan', 'like', '%' . $request->keyword . '%')
                    ->orWhere('kelurahan', 'like', '%' . $request->keyword . '%')
                    ->orWhere('alamat', 'like', '%' . $request->keyword . '%')
                    // ->orWhere('deskripsi', 'like', '%' . $request->keyword . '%')
                    ->orWhereHas('kategori', function ($q2) use ($request) {
                        $q2->where('nama', 'like', '%' . $request->keyword . '%');
                    });
            });
        }

        // $useHargaFilter =
        //     ($request->minharga && $request->minharga != 0) ||
        //     ($request->maxharga && $request->maxharga != 1000000);
        $useHargaFilter =
            ($request->minharga !== null && $request->minharga != 0) ||
            ($request->maxharga !== null && $request->maxharga != 1000000);

        $useRatingFilter =
            ($request->minrating && $request->minrating != 0) ||
            ($request->maxrating && $request->maxrating != 5);

        $useJarakFilter =
            ($request->jarak && $request->jarak > 0);

        // if ($useRatingFilter) {
        //     $query->whereBetween('penilaian', [
        //         $request->minrating,
        //         $request->maxrating
        //     ]);
        // }

        // if ($useHargaFilter) {
        //     $query->where(function ($q) use ($request) {
        //         $q->where('harga_max', '>=', $request->minharga)
        //             ->where('harga_min', '<=', $request->maxharga);
        //     });
        // }
        // if ($useHargaFilter) {
        //     $query->where(function ($q) use ($request) {
        //         if (!is_null($request->minharga) && !is_null($request->maxharga)) {
        //             $q->where('harga_max', '>=', $request->minharga)
        //                 ->where('harga_min', '<=', $request->maxharga);
        //         } elseif (!is_null($request->minharga)) {
        //             $q->where('harga_max', '>=', $request->minharga);
        //         } elseif (!is_null($request->maxharga)) {
        //             $q->where('harga_min', '<=', $request->maxharga);
        //         }
        //     });
        // }
        // $maxSliderHarga = 500000;

        // $query->where(function ($q) use ($request, $maxSliderHarga) {
        //     if (!is_null($request->minharga)) {
        //         $q->where(function ($sub) use ($request) {
        //             $sub->where('harga_max', '>=', $request->minharga)
        //                 ->orWhereNull('harga_max');
        //         });
        //     }

        //     if (!is_null($request->maxharga) && $request->maxharga < $maxSliderHarga) {
        //         $q->where('harga_min', '<=', $request->maxharga);
        //     }
        // });

        $data = $query->limit(50)->get();

        $isFallback = false;

        if ($data->isEmpty() && !$isTerdekat) {
            // $isRekomendasi = true;
            $isFallback = true;

            // $request->merge([
            //     'minharga' => null,
            //     'maxharga' => null,
            //     'minrating' => null,
            //     'maxrating' => null,
            //     'jarak' => null,
            // ]);
            // $fallback = WisataKuliner::with(['fasilitas','kategori'])
            //             ->where('status','Ditampilkan');

            // if ($useHargaFilter) {
            //     $fallback->where('harga_max', '>=', $request->minharga)
            //             ->where('harga_min', '<=', $request->maxharga);
            // }

            // if ($useRatingFilter) {
            //     $fallback->whereBetween('penilaian', [
            //         $request->minrating,
            //         $request->maxrating
            //     ]);
            // }

            // $data = $fallback->limit(50)->get();
            // $keyword = 'Rekomendasi Kuliner';

            // $keywordLower = strtolower($keyword);

            // $isKeywordKhusus =
            //     str_contains($keywordLower, 'rekomendasi') ||
            //     str_contains($keywordLower, 'kuliner') ||
            //     str_contains($keywordLower, 'terdekat') ||
            //     str_contains($keywordLower, 'dekat') ||
            //     str_contains($keywordLower, 'near');

            // $isRekomendasi = true;

            // $isFallback = !$isKeywordKhusus;

            $query2 = WisataKuliner::with(['fasilitas', 'kategori'])->where('status', 'Ditampilkan');
            // $query2 = WisataKuliner::query()
            //     ->with([
            //         'fasilitas' => function ($q) {
            //             $q->wherePivot('status', '!=', 'Belum Diverifikasi');
            //         },
            //         'kategori' => function ($q) {
            //             $q->wherePivot('status', '!=', 'Belum Diverifikasi');
            //         }
            //     ])
            //     ->where('status', 'Ditampilkan');

            // if ($useRatingFilter) {
            //     $query2->whereBetween('penilaian', [$request->minrating, $request->maxrating]);
            // }
            // if ($useHargaFilter) {
            //     $query2->where('harga_max', '>=', $request->minharga)
            //         ->where('harga_min', '<=', $request->maxharga);
            //     if ($useHargaFilter) {
            //     //     $query2->where(function ($q) use ($request) {
            //     //         if (!is_null($request->minharga) && !is_null($request->maxharga)) {
            //     //             $q->where('harga_max', '>=', $request->minharga)
            //     //                 ->where('harga_min', '<=', $request->maxharga);
            //     //         } elseif (!is_null($request->minharga)) {
            //     //             $q->where('harga_max', '>=', $request->minharga);
            //     //         } elseif (!is_null($request->maxharga)) {
            //     //             $q->where('harga_min', '<=', $request->maxharga);
            //     //         }
            //     //     });
            //             $query2->where(function ($q) use ($request) {
            //             if (!is_null($request->minharga) && !is_null($request->maxharga)) {
            //                 $q->where(function ($sub) use ($request) {
            //                     $sub->where('harga_max', '>=', $request->minharga)
            //                         ->orWhereNull('harga_max'); 
            //                 })
            //                 ->where('harga_min', '<=', $request->maxharga);
            //             } elseif (!is_null($request->minharga)) {
            //                 $q->where(function ($sub) use ($request) {
            //                     $sub->where('harga_max', '>=', $request->minharga)
            //                         ->orWhereNull('harga_max');
            //                 });
            //             } elseif (!is_null($request->maxharga)) {
            //                 $q->where('harga_min', '<=', $request->maxharga);
            //             }
            //         });
            //     }
                
            // }

            $data = $query2->limit(50)->get();
        }

        // $preferensiKuliner = [];
        // if ($wisatawan) {
        //     $preferensiKuliner = DB::table('preferensi')
        //         ->where('id_wisatawan', $wisatawan->id_wisatawan)
        //         ->pluck('id_kategori')
        //         ->toArray();
        // }

        if ($request->lat && $request->lng && count($data) > 0) {
            foreach ($data as $item) {
                $item->distance_km = 6371 * 2 * atan2(
                    sqrt(
                        pow(sin(deg2rad($item->latitude - $lat) / 2), 2) +
                            cos(deg2rad($lat)) * cos(deg2rad($item->latitude)) *
                            pow(sin(deg2rad($item->longitude - $lng) / 2), 2)
                    ),
                    sqrt(
                        1 - (
                            pow(sin(deg2rad($item->latitude - $lat) / 2), 2) +
                            cos(deg2rad($lat)) * cos(deg2rad($item->latitude)) *
                            pow(sin(deg2rad($item->longitude - $lng) / 2), 2)
                        )
                    )
                );
            }

            // if ($useJarakFilter) {
            //     $data = $data->filter(fn($item) => $item->distance_km <= $request->jarak)->values();
            // }

            $origin = $request->lat . ',' . $request->lng;

            $destinations = $data->map(function ($item) {
                return $item->latitude . ',' . $item->longitude;
            })->join('|');

            $apiKey = 'AIzaSyD-gBdR_gqZTd8B6jz3mVJWI-pqC_jPlAI';

            $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$origin}&destinations={$destinations}&key={$apiKey}&language=in";

            $response = file_get_contents($url);
            $response = json_decode($response, true);

            foreach ($data as $index => $item) {
                $distanceMeter = $response['rows'][0]['elements'][$index]['distance']['value'] ?? null;
                $item->distance_km = $distanceMeter ? $distanceMeter / 1000 : $item->distance_km; 
            }

            // if ($useJarakFilter) {
            //     $data = $data->filter(fn($item) => $item->distance_km <= $request->jarak)->values();
            // }
            $maxSliderJarak = 10;

            if ($useJarakFilter) {
                if ($request->jarak < $maxSliderJarak) {
                    $data = $data->filter(fn($item) => $item->distance_km <= $request->jarak)->values();
                } 
            }
        }

        $totalFasilitasUser = count($request->fasilitas ?? []);

        $kategoriFilter = $request->kategori ?? [];
        $fasilitasFilter = $request->fasilitas ?? [];
        $cariKategori = !empty($kategoriFilter) ? $kategoriFilter : $preferensiKuliner;

        $kulinerIds = $data->pluck('id_wisata_kuliner')->toArray();

        $kategoriMatchMap = [];
        if (!empty($cariKategori)) {
            $kategoriMatchMap = DB::table('kategori_wisata_kuliner')
                ->whereIn('id_wisata_kuliner', $kulinerIds)
                ->whereIn('id_kategori', $cariKategori)
                ->select('id_wisata_kuliner', DB::raw('COUNT(*) as match_count'))
                ->groupBy('id_wisata_kuliner')
                ->pluck('match_count', 'id_wisata_kuliner')
                ->toArray();
        }

        $fasilitasMatchMap = [];
        if (!empty($fasilitasFilter)) {
            $fasilitasMatchMap = DB::table('fasilitas_wisata_kuliner')
                ->whereIn('id_wisata_kuliner', $kulinerIds)
                ->whereIn('id_fasilitas', $fasilitasFilter)
                ->select('id_wisata_kuliner', DB::raw('COUNT(*) as match_count'))
                ->groupBy('id_wisata_kuliner')
                ->pluck('match_count', 'id_wisata_kuliner')
                ->toArray();
        }

        foreach ($data as $item) {
            $id = $item->id_wisata_kuliner;

            $listKategori = $request->kategori ?? [];
            if (!empty($listKategori)) {
                $cariKategori = $listKategori;
            } elseif (!empty($preferensiKuliner)) {
                $cariKategori = $preferensiKuliner;
            } else {
                $cariKategori = [];
            }

            $distanceScore = 1 / (($item->distance_km ?? 999) + 1);
            $ratingScore = ($item->penilaian ?? 0) / 5;
            // $hargaScore = 1 / (($item->harga_min ?? 1) + 1);
            $hargaScore = $item->harga_min 
            ? 1 / ($item->harga_min + 1) 
            : 0.1;
            $kategoriMatch = $kategoriMatchMap[$id] ?? 0;
            $fasilitasMatch = $fasilitasMatchMap[$id] ?? 0;

            $filterScore = 0;
            if (!$useJarakFilter || ($item->distance_km ?? 999) <= $request->jarak) {
                $filterScore++;
            }
            if (!$useRatingFilter || $item->penilaian >= $request->minrating) {
                $filterScore++;
            }
            if (
                !$useHargaFilter ||
                (
                    ($item->harga_min ?? 0) <= $request->maxharga &&
                    ($item->harga_max ?? 999999) >= $request->minharga
                )
            ) {
                $filterScore++;
            }
            if (empty($kategoriFilter) || $kategoriMatch > 0) {
                $filterScore++;
            }
            if (empty($fasilitasFilter) || $fasilitasMatch > 0) {
                $filterScore++;
            }
            $item->filter_score = $filterScore;

            $item->score =
                ($distanceScore * 40) +
                ($ratingScore * 25) +
                ($hargaScore * 20) +
                ($kategoriMatch * 10) +
                ($fasilitasMatch * 5);
        }

        // if ($isFallback && $data->isEmpty()) {
        //     $query3 = WisataKuliner::with(['fasilitas', 'kategori'])
        //         ->where('status', 'Ditampilkan');

        //     $data = $query3->limit(50)->get();

        //     $isFallback = true;
        // }
        // $data = $data->sortByDesc('score')->values();
        if ($isTerdekat && $request->lat && $request->lng) {
            $data = $data->sortBy('distance_km')->values();
        } else {
            // $data = $data->sortByDesc('score')->values();
            $data = $data->sortByDesc('filter_score') 
                 ->sortByDesc('score')        
                 ->values();
        }

        return view('wisatawan.pencarian.hasil-pencarian', compact('data', 'kategori', 'fasilitas', 'favoritIds', 'keyword', 'kategoriUser', 'isFallback'));
    }

    public function coba()
    {
        return view('wisatawan.hhhh');
    }
}
