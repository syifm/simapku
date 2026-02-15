<?php

namespace App\Http\Controllers;

use App\Models\WisataKuliner;
use Illuminate\Http\Request;


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
}
