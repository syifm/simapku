<?php
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

        // $kategoriUser = $user->wisatawan
        //     ? $user->wisatawan->preferensi()->pluck('id_kategori')->toArray()
        //     : [];

        $query = WisataKuliner::query()->with(['fasilitas', 'kategori'])->where('status', 'Disetujui');

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

        // $preferensiKuliner = [];
        // if ($wisatawan) {
        //     $preferensiKuliner = DB::table('preferensi')
        //         ->where('id_wisatawan', $wisatawan->id_wisatawan)
        //         ->pluck('id_kategori')
        //         ->toArray();
        // }

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
            //             ->where('status','Disetujui');

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

            $query2 = WisataKuliner::with(['fasilitas', 'kategori'])->where('status', 'Disetujui');
            // $query2 = WisataKuliner::query()
            //     ->with([
            //         'fasilitas' => function ($q) {
            //             $q->wherePivot('status', '!=', 'Belum Diverifikasi');
            //         },
            //         'kategori' => function ($q) {
            //             $q->wherePivot('status', '!=', 'Belum Diverifikasi');
            //         }
            //     ])
            //     ->where('status', 'Disetujui');

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
            // foreach ($data as $item) {
            //     $item->distance_km = 6371 * 2 * atan2(
            //         sqrt(
            //             pow(sin(deg2rad($item->latitude - $lat) / 2), 2) +
            //                 cos(deg2rad($lat)) * cos(deg2rad($item->latitude)) *
            //                 pow(sin(deg2rad($item->longitude - $lng) / 2), 2)
            //         ),
            //         sqrt(
            //             1 - (
            //                 pow(sin(deg2rad($item->latitude - $lat) / 2), 2) +
            //                 cos(deg2rad($lat)) * cos(deg2rad($item->latitude)) *
            //                 pow(sin(deg2rad($item->longitude - $lng) / 2), 2)
            //             )
            //         )
            //     );
            // }

            // if ($useJarakFilter) {
            //     $data = $data->filter(fn($item) => $item->distance_km <= $request->jarak)->values();
            // }

            $origin = $request->lat . ',' . $request->lng;

            $destinations = $data->map(function ($item) {
                return $item->latitude . ',' . $item->longitude;
            })->join('|');

            $apiKey = 'AIzaSyC1G3FTNQXli1ZHjZNQNIpzOl_AcGNHctU';

            $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$origin}&destinations={$destinations}&key={$apiKey}&language=id";

            logger('GOOGLE API DIPANGGIL');
            $response = file_get_contents($url);
            $response = json_decode($response, true);

            foreach ($data as $index => $item) {
                $distanceMeter = $response['rows'][0]['elements'][$index]['distance']['value'] ?? null;
                // $item->distance_km = $distanceMeter ? $distanceMeter / 1000 : $item->distance_km; 
                $item->distance_km = $distanceMeter ? $distanceMeter / 1000 : null;
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
        $cariKategori = !empty($kategoriFilter) ? $kategoriFilter : [];

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
        //         ->where('status', 'Disetujui');

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

        return view('wisatawan.pencarian.hasil-pencarian', compact('data', 'kategori', 'fasilitas', 'favoritIds', 'keyword', 'isFallback'));
    }