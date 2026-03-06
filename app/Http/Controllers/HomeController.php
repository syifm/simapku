<?php

namespace App\Http\Controllers;

use App\Models\WisataKuliner;
use App\Models\Fasilitas;
use App\Models\FasilitasWisataKuliner;
use Exception;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = FasilitasWisataKuliner::with('fasilitas', 'wisata_kuliner')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('wisatawan.wisata-kuliner.hahaha');
    }

    // public function getngampu($id)
    // {
    //     $mk = FasilitasWisataKuliner::with('fasilitas')->where('id_wisata_kuliner', $id)->get();
    //     $data = '';
    //     foreach ($mk as $row) {

    //         $data .= "<option value='$row->id_fasilitas' selected>{$row->fasilitas->nama}</option>";
    //     }
    //     return $data;
    // }
    // public function getngampu($id = null)
    // {
    //     if (!$id || $id == "null") {
    //         return '';
    //     }

    //     $mk = FasilitasWisataKuliner::where('id_wisata_kuliner', $id)->get();

    //     $data = '';

    //     foreach ($mk as $row) {
    //         if ($row->fasilitas) {
    //             $data .= "<option value='{$row->id_fasilitas}' selected>
    //                     {$row->fasilitas->nama}
    //                   </option>";
    //         }
    //     }

    //     return $data;
    // }
    public function getngampu($id = null)
    {
        if (!$id || $id == "null") {
            return '';
        }

        $mk = FasilitasWisataKuliner::with('fasilitas')
            ->where('id_wisata_kuliner', $id)
            ->get();

        $data = '';

        foreach ($mk as $row) {
            if ($row->fasilitas) {
                $data .= "<option value='{$row->id_fasilitas}' selected>
                        {$row->fasilitas->nama}
                      </option>";
            }
        }

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     try {
    //         //get data
    //         $id = $request->id_wisata_kuliner;
    //         $dataMK = $request->id_fasilitas;
    //         // $insertData = [];
    //         // for ($i = 0; $i < count($dataMK); $i++) {
    //         //     array_push($insertData, ['id_wisata_kuliner' => $id, 'id_fasilitas' => $dataMK[$i]]);
    //         // }

    //         // FasilitasWisataKuliner::insertOrIgnore($insertData);
    //         $idWisata = $request->id_wisata_kuliner;

    //         // Kalau bukan numeric → berarti input baru
    //         if (!is_numeric($idWisata)) {

    //             $wisata = WisataKuliner::whereRaw(
    //                 'LOWER(nama) = ?',
    //                 [strtolower(trim($idWisata))]
    //             )->first();

    //             if (!$wisata) {
    //                 $wisata = WisataKuliner::create([
    //                     'nama' => trim($idWisata)
    //                 ]);
    //             }

    //             $idWisata = $wisata->id_wisata_kuliner;
    //         }

    //         $insertData = [];

    //         foreach ($dataMK as $item) {

    //             if (is_numeric($item)) {
    //                 $fasilitasId = $item;
    //             } else {
    //                 $fasilitas = Fasilitas::whereRaw(
    //                     'LOWER(nama) = ?',
    //                     [strtolower(trim($item))]
    //                 )->first();

    //                 if (!$fasilitas) {
    //                     $fasilitas = Fasilitas::create([
    //                         'nama' => trim($item)
    //                     ]);
    //                 }

    //                 $fasilitasId = $fasilitas->id_fasilitas;
    //             }

    //             $insertData[] = [
    //                 'id_wisata_kuliner' => $idWisata,
    //                 'id_fasilitas' => $fasilitasId
    //             ];
    //         }

    //         FasilitasWisataKuliner::insertOrIgnore($insertData);

    //         return response()->json(['status' => true, 'message' => "Berhasil Simpan"]);
    //     } catch (Exception $e) {
    //         return response()->json(['status' => false, 'message' => $e->getMessage()]);
    //     }
    // }




    public function store(Request $request)
    {
        try {

            $dataMK = $request->id_fasilitas ?? [];
            $idWisata = $request->id_wisata_kuliner;

            // 🔥 1. Handle wisata baru
            if (!is_numeric($idWisata)) {

                $wisata = WisataKuliner::firstOrCreate([
                    'nama' => trim($idWisata)
                ]);

                $idWisata = $wisata->id_wisata_kuliner;
            }

            // 🔥 2. Ubah semua fasilitas jadi ID
            $fasilitasIds = [];

            foreach ($dataMK as $item) {

                if (is_numeric($item)) {
                    $fasilitasId = $item;
                } else {

                    $fasilitas = Fasilitas::firstOrCreate([
                        'nama' => trim($item)
                    ]);

                    $fasilitasId = $fasilitas->id_fasilitas;
                }

                $fasilitasIds[] = $fasilitasId;
            }

            // 🔥 3. SYNC DI SINI
            $wisata = WisataKuliner::find($idWisata);

            $wisata->fasilitas()->sync($fasilitasIds);

            return response()->json([
                'status' => true,
                'message' => "Berhasil Simpan"
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }


    // public function store(Request $request)
    // {
    //     try {

    //         $id = $request->id_wisata_kuliner;
    //         $dataMK = $request->id_fasilitas ?? [];

    //         if (!is_array($dataMK)) {
    //             $dataMK = [$dataMK];
    //         }

    //         $insertData = [];

    //         foreach ($dataMK as $fasilitasId) {
    //             $insertData[] = [
    //                 'id_wisata_kuliner' => $id,
    //                 'id_fasilitas' => $fasilitasId
    //             ];
    //         }

    //         dd($dataMK);
    //         // FasilitasWisataKuliner::insertOrIgnore($insertData);
    //         FasilitasWisataKuliner::insert($insertData);

    //         return response()->json([
    //             'status' => true,
    //             'message' => "Berhasil Simpan"
    //         ]);
    //     } catch (Exception $e) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => $e->getMessage()
    //         ]);
    //     }
    // }
    // public function store(Request $request)
    // {
    //     try {

    //         $id = $request->id_wisata_kuliner;
    //         $dataMK = $request->id_fasilitas ?? [];

    //         if (!is_array($dataMK)) {
    //             $dataMK = [$dataMK];
    //         }

    //         if (empty($dataMK)) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Fasilitas kosong'
    //             ]);
    //         }

    //         $insertData = [];

    //         foreach ($dataMK as $fasilitasId) {
    //             $insertData[] = [
    //                 'id_wisata_kuliner' => $id,
    //                 'id_fasilitas' => $fasilitasId
    //             ];
    //         }

    //         FasilitasWisataKuliner::insert($insertData);

    //         return response()->json([
    //             'status' => true,
    //             'message' => "Berhasil Simpan"
    //         ]);
    //     } catch (\Throwable $e) {

    //         return response()->json([
    //             'status' => false,
    //             'message' => $e->getMessage()
    //         ]);
    //     }
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = FasilitasWisataKuliner::with(['wisata_kuliner', 'fasilitas'])->find($id);
        return view('edit_hahaha', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function selectmhs()
    {
        $data = WisataKuliner::where('nama', 'LIKE', '%' . request('q') . '%')->paginate(10);

        return response()->json($data);
    }

    // public function selectmk($id)
    // {
    //     //get data nilai berdasarkan idmhs;
    //     $mk = FasilitasWisataKuliner::select('id_fasilitas')->where('id_wisata_kuliner', $id)->get();
    //     $data = Fasilitas::whereNotIn('id', $mk)->where('nama', 'LIKE', '%' . request('q') . '%')->paginate(10);

    //     return response()->json($data);
    // }

    // public function selectmk($id)
    // {
    //     $mk = FasilitasWisataKuliner::where('id_wisata_kuliner', $id)
    //         ->pluck('id_fasilitas');

    //     $data = Fasilitas::whereNotIn('id_fasilitas', $mk)
    //         ->where('nama', 'LIKE', '%' . request('q') . '%')
    //         ->paginate(10);

    //     return response()->json($data);
    // }


    public function selectmk($id)
    {
        $data = Fasilitas::where('nama', 'LIKE', '%' . request('q') . '%')
            ->paginate(10);

        return response()->json($data);
    }
}
