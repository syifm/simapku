<?php

// $kategori = Kategori::withCount('wisataKuliner')
        //     ->orderBy('nama', 'asc')
        //     ->paginate(10, ['*'], 'kategori')
        //     ->withQueryString();

        // $kategori->getCollection()->transform(function ($item, $key) use ($kategori) {
        //     $item->nomor = ($kategori->currentPage() - 1) * $kategori->perPage() + $key + 1;
        //     return $item;
        // });

        // $wisataKuliner = WisataKuliner::with('kategori:id_kategori,nama')->get();

        // $fasilitas = Fasilitas::withCount('wisataKuliner')
        //     ->orderBy('nama', 'asc')
        //     ->paginate(10, ['*'], 'fasilitas')
        //     ->withQueryString();

        // $fasilitas->getCollection()->transform(function ($item, $key) use ($fasilitas) {
        //     $item->nomor = ($fasilitas->currentPage() - 1) * $fasilitas->perPage() + $key + 1;
        //     return $item;
        // });

        // $wisataKuliner = WisataKuliner::with('fasilitas:id_fasilitas,nama')->get();

        // return view('admin.kelola-wisata-kuliner.halaman-awal', compact(
        //     'wisataKuliner',
        //     'kategori',
        //     'fasilitas'
        // ));



        // public function hapus(int $id)
    // {
    //     try {

    //         $wisataKuliner = WisataKuliner::findOrFail($id);

    //         if ($wisataKuliner->foto && Storage::disk('public')->exists($wisataKuliner->foto)) {
    //             Storage::disk('public')->delete($wisataKuliner->foto);
    //         }

    //         $wisataKuliner->delete();

    //         return redirect()->back()->with('success', 'Wisata Kuliner berhasil dihapus');
    //     } catch (Exception $e) {
    //         return back()->with('error', 'Terjadi Kesalahan Saat Menghapus Wisata Kuliner.');
    //     }
    // }