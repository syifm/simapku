<?php

namespace App\Http\Controllers;

use App\Models\WisataKuliner;
use Illuminate\Http\Request;

class WisatawanController extends Controller
{
    public function berandaWisatawan()
    {
        return view('wisatawan.beranda');
    }

    public function mapWisataKuliner()
    {
        return view('wisatawan.map-wisatakuliner');
    }

    public function mapWisataKuliner2()
    {
        return view('wisatawan.map-wisatakuliner2');
    }

    public function store(Request $request)
    {
        WisataKuliner::create([
            'latitude' => $request->lat,
            'longitude' => $request->lng
        ]);
        return view('wisatawan.beranda');
    }

    public function event()
    {
        return view('wisatawan.event');
    }
}
