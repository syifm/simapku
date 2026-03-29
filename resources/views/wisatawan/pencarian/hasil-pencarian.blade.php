<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Beranda</title>
    {{-- <link rel="icon" type="image/png" href="{{ asset('simapku.png') }}"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/3.0.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/4.0.0/uicons-regular-straight/css/uicons-regular-straight.css'>
    {{-- <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/4.0.0/uicons-solid-straight/css/uicons-solid-straight.css'>
    <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/4.0.0/uicons-solid-rounded/css/uicons-solid-rounded.css'> --}}

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        #donutChart {
            width: 300px;
            height: 300px;
            margin: 0 auto;
        }

        .no-data-message {
            background-color: #f9fafb;
            border: 1px dashed #d1d5db;
            border-radius: 0.5rem;
            padding: 2rem;
            text-align: center;
            color: #6b7280;
        }

        .no-data-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #9ca3af;
        }

        /* #map {
            height: 500px;
            width: 570px;
        } */
        #map {
            height: 100%;
            width: 100%;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
</head>

<body class="bg-gray-100 text-gray-800">
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false,
                position: 'center',
                target: document.body
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#dc2626',
                target: document.body
            });
        </script>
    @endif

    @include('layouts.header-wisatawan')
    @include('layouts.sidebar-wisatawan')

    <div class="pt-[10px] pl-28 pr-[30px] pb-[30px]">
        <div class="flex flex-col gap-2">
            <div>
                <p class="text-m text-black font-medium mt-2 mb-2 text-center">
                    Ingin memasukkan kuliner yang Anda ketahui?
                    <a href="{{ route('tambahwisatakuliner') }}" class="text-[#FFA319]  hover:underline">
                        Tambah Kuliner
                    </a>
                </p>
            </div>

            <!-- search bar -->
            <form action="{{ route('wisatakulinerhalaman') }}" method="GET">
                @csrf
                <div class="relative w-full flex justify-center mb-6">
                    <div class="w-full max-w-xl z-20">
                        <div
                            class="flex items-center w-full max-w-xl border rounded-full overflow-hidden shadow-sm font-medium bg-white">
                            <input type="text" name="keyword" placeholder="Cari Kuliner Disini..." autocomplete="off"
                                class="flex-1 px-5 py-3 focus:outline-none" id="searchBar">
                            <button class="bg-[#FFA319] px-4 py-3 text-white hover:bg-[#F19305] transition">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>

                        <div id="searchPanel"
                            class="hidden absolute w-full max-w-xl mt-2 bg-white rounded-2xl shadow-lg p-4 z-50">
                            <!-- Kuliner Terdekat -->
                            <div class="p-3 rounded-xl bg-white shadow-md hover:bg-gray-100 cursor-pointer">
                                Kuliner Terdekat
                            </div>

                            <!-- Advanced Search -->
                            <div id="advancedBtn" class="flex gap-4 items-center p-3 rounded-xl cursor-pointer">
                                <span>Advanced Search</span>
                                <span class="leading-none">
                                    {{-- <i class="fi fi-br-angle-small-down text-xl"></i> --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="3" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    </svg>

                                </span>
                            </div>

                            <!-- Filter Advanced -->
                            <div id="advancedFilter" class="hidden mt-3 space-y-3">

                                <select class="w-full border rounded-lg p-2" name="rating">
                                    <option>Rating Minimal</option>
                                    <option>⭐ 3+</option>
                                    <option>⭐ 4+</option>
                                    <option>⭐ 4.5+</option>
                                </select>


                                <input type="checkbox" name="fasilitas[]" value="1"> Wifi
                                <input type="checkbox" name="fasilitas[]" value="2"> Parkir
                                <input type="checkbox" name="fasilitas[]" value="3"> AC
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        {{-- <div>
            @foreach ($data as $kuliner)
                <div class="p-4 border rounded-lg mb-3">
                    <h2 class="text-lg font-bold">{{ $kuliner->nama }}</h2>
                    <p>Rating: ⭐ {{ $kuliner->penilaian }}</p>
                </div>
            @endforeach
        </div> --}}

        <!-- hasil-->
        {{-- <div class="grid grid-cols-12 gap-6"> --}}
        <div class="grid grid-cols-12 gap-6 h-[calc(100vh-230px)] overflow-hidden">

            {{-- <div class="col-span-7">
                @foreach ($data as $kuliner)
                    <div class="p-4 border rounded-lg mb-3 bg-white shadow-sm">
                        <h2 class="text-lg font-bold">{{ $kuliner->nama }}</h2>
                    </div>
                @endforeach
            </div> --}}
            {{-- <div class="col-span-7 space-y-4"> --}}
            <div id="listKuliner" class="col-span-7 space-y-4 overflow-y-auto pr-2">
                @foreach ($data as $kuliner)
                    {{-- <div
                        class="flex items-center justify-between bg-white rounded-2xl shadow-md p-4 hover:shadow-lg transition"> --}}
                    {{-- <div class="card-kuliner flex items-center justify-between bg-white rounded-2xl shadow-md p-4 hover:shadow-lg transition cursor-pointer"
                        data-lat="{{ $kuliner->latitude }}" data-lng="{{ $kuliner->longitude }}"> --}}
                    <div class="card-kuliner flex items-center justify-between bg-white rounded-2xl shadow-md p-4 hover:shadow-lg transition cursor-pointer"
                        data-id="{{ $kuliner->id_wisata_kuliner }}" data-nama="{{ $kuliner->nama }}"
                        data-alamat="{{ $kuliner->alamat }}" data-harga="Rp{{ number_format($kuliner->harga_min) }}+"
                        data-foto="{{ asset('storage/' . $kuliner->foto) }}" data-lat="{{ $kuliner->latitude }}"
                        data-lng="{{ $kuliner->longitude }}">

                        <div class="flex gap-4 items-center">

                            <img src="{{ asset('storage/' . $kuliner->foto) }}"
                                class="w-32 h-24 object-cover rounded-xl">

                            <div>
                                <h2 class="text-lg font-semibold">
                                    {{ $kuliner->nama }}
                                </h2>

                                <p class="text-gray-600 text-sm">
                                    {{ $kuliner->alamat }}
                                </p>

                                {{-- <p class="text-gray-600 text-sm">
                                    Buka {{ $kuliner->jam_buka }}
                                </p> --}}

                                {{-- <p class="text-gray-600 text-sm">
                                    {{ $kuliner->kategori }} • {{ $kuliner->fasilitas }}
                                </p> --}}

                                {{-- <p class="text-gray-700 text-sm font-medium"> --}}
                                <p class="text-gray-700 text-sm">
                                    Rp{{ number_format($kuliner->harga_min) }}+
                                </p>
                            </div>

                        </div>

                        <div class="text-right">

                            <div class="flex items-center gap-1 justify-end -mt-10">
                                <span class="text-orange-400"><svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                        <path fill-rule="evenodd"
                                            d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <span class="font-semibold">
                                    {{ $kuliner->penilaian ?? '4.5' }}
                                </span>
                            </div>

                            {{-- <p class="text-gray-700 text-sm">
                                Rp{{ number_format($kuliner->harga_min) }}+
                            </p> --}}

                            {{-- <p class="text-gray-500 text-sm mt-1">
                                {{ $kuliner->jarak ?? '100 m' }}
                            </p> --}}

                        </div>

                    </div>
                @endforeach
            </div>

            {{-- <div id="detailPanel"
                class="fixed top-0 left-0 w-full h-full bg-black/40 hidden z-50 flex justify-center items-center">

                <div class="bg-white w-[500px] max-h-[90vh] overflow-y-auto rounded-2xl p-6 relative">

                    <button onclick="closeDetail()" class="absolute top-3 right-4 text-xl">✕</button>

                    <img id="detailFoto" class="w-full h-48 object-cover rounded-xl mb-4">

                    <h2 id="detailNama" class="text-xl font-bold"></h2>

                    <p id="detailAlamat" class="text-gray-600"></p>

                    <p id="detailHarga" class="mt-2 font-semibold"></p>

                </div>

            </div> --}}

            {{-- <div class="col-span-5">
                <div class="sticky top-24"> --}}
            <div class="col-span-5 h-full">
                <div class="h-full sticky top-0">
                    {{-- <iframe class="w-full h-[600px] rounded-xl border">
                    </iframe> --}}
                    <div id="map" class="w-full rounded-xl border shadow-md hover:shadow-lg">
                    </div>
                </div>
            </div>
        </div>

        {{-- <div id="modalUlasan" class="fixed inset-0 bg-black/40 hidden z-50 flex items-center justify-center"> --}}
        <div id="modalUlasan"
            class="fixed left-0 right-0 top-0 bottom-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto z-50 items-center justify-center">
            <form action="{{ route('penilaianulasan.simpan') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- <div class="bg-white w-[500px] rounded-2xl p-6 relative"> --}}
                <div
                    class="relative left-[30px] top-[90px] mx-auto p-5 border w-[600px] shadow-lg rounded-xl bg-white">


                    <button onclick="closeModal()" class="absolute right-4 top-3 text-xl">✕</button>

                    <h2 class="text-xl font-bold mb-4 text-center">Tambah Ulasan</h2>

                    {{-- <textarea id="inputUlasan" class="w-full border rounded-xl p-3 mb-3"></textarea> --}}
                    <input type="hidden" id="id_wisata_kuliner" name="id_wisata_kuliner">
                    {{-- <input type="hidden" id="penilaian" value="0"> --}}
                    <!-- Penilaian -->
                    <label class="block text-sm font-medium text-gray-800 mb-2">
                        Penilaian
                        <span class="text-red-500 font-bold">*</span>
                    </label>

                    <div id="ratingStars" class="flex gap-1 cursor-pointer">

                        <svg data-value="1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-400 star">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                        </svg>

                        <svg data-value="2" class="w-8 h-8 text-gray-400 star" fill="none" stroke="currentColor"
                            stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                        </svg>

                        <svg data-value="3" class="w-8 h-8 text-gray-400 star" fill="none" stroke="currentColor"
                            stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                        </svg>

                        <svg data-value="4" class="w-8 h-8 text-gray-400 star" fill="none" stroke="currentColor"
                            stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                        </svg>

                        <svg data-value="5" class="w-8 h-8 text-gray-400 star" fill="none" stroke="currentColor"
                            stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                        </svg>
                    </div>

                    <input type="hidden" id="penilaian" name="penilaian">

                    <!-- Ulasan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-800 mb-1" for="ulasan"><span>Ulasan</span>
                            <span class="text-red-500 font-bold">*</span></label>
                        <textarea id="ulasan" name="ulasan" rows="4"
                            class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('deskripulasansi') }}</textarea>
                        @error('ulasan')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Total Harga -->
                    <div>
                        <label class="block text-sm font-medium text-gray-800 mb-1" for="harga_total"><span>Harga
                                Total</span>
                            <span class="text-red-500 font-bold">*</span></label>
                        <input type="number" id="harga_total" name="harga_total" rows="6"
                            class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>{{ old('harga_total') }}</input>
                        @error('harga_total')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Foto Ulasan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-800 mt-1 mb-1" for="foto">
                            <span>Foto</span>
                        </label>

                        {{-- <input type="file" id="foto" name="foto" accept="image/*" required --}}
                        {{-- <input type="file" name="foto_ulasan" id="foto_ulasan" accept="image/*" required
                            class="file-input-wrapper"> --}}
                        <input type="file" name="foto_ulasan" id="foto_ulasan" accept="image/*"
                            class="file-input-wrapper">


                        <div id="fotoError" class="text-red-500 text-sm mt-1 hidden"></div>

                        <!-- PREVIEW -->
                        <div id="previewWrapper" class="mt-3 hidden relative w-40">
                            <img id="fotoPreview" class="rounded-md border w-full h-40 object-cover">
                        </div>

                        <p class="text-xs text-gray-600 mt-2">
                            Format: JPG, JPEG, PNG | Max: 10MB
                        </p>
                    </div>

                    <!-- Submit -->
                    {{-- <button onclick="kirimUlasan(kulinerAktif)"
                        class="bg-[#FB991A] text-white px-12 py-2 mt-2 rounded-md hover:bg-orange-600 transition duration-300 font-bold w-full">
                        Kirim
                    </button> --}}
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-[#FB991A] text-white px-12 py-2 rounded-md hover:bg-orange-600 transition duration-300 font-bold">
                            Simpan
                        </button>
                    </div>
                    {{-- <div class="flex justify-end">
                        <button
                            class="bg-[#FB991A] text-white px-12 py-2 rounded-md hover:bg-orange-600 transition duration-300 font-bold"
                            onclick="simpanUlasan()">Simpan</button>
                    </div> --}}

                </div>
            </form>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const hamburger = document.getElementById('hamburger');
            const sidebar = document.querySelector('.sidebar');

            if (!hamburger || !sidebar) return;

            hamburger.addEventListener('click', () => {
                sidebar.classList.toggle('expanded');
            });
        });

        const searchBar = document.getElementById("searchBar");
        const searchPanel = document.getElementById("searchPanel");

        searchBar.addEventListener("click", () => {
            searchPanel.classList.toggle("hidden");
        });

        const advancedBtn = document.getElementById("advancedBtn");
        const advancedFilter = document.getElementById("advancedFilter");

        advancedBtn.addEventListener("click", () => {
            advancedFilter.classList.toggle("hidden");
        });

        document.addEventListener("click", function(e) {

            if (!searchBar.contains(e.target) && !searchPanel.contains(e.target)) {
                searchPanel.classList.add("hidden");
            }

        });

        let dataKuliner = @json($data)

        console.log(dataKuliner)

        let mapOptions = {
            center: [-6.99, 110.42],
            zoom: 10
        }

        let map = new L.map('map', mapOptions);

        let layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
        map.addLayer(layer);

        let markerGroup = L.layerGroup().addTo(map)

        dataKuliner.forEach(function(item) {

            if (item.latitude && item.longitude) {

                L.marker([item.latitude, item.longitude])
                    .addTo(markerGroup)
                    .bindPopup(item.nama)

            }

        })

        // navigator.geolocation.watchPosition(success, error);

        // function success(pos) {
        //     const lat = pos.coords.latitude;
        //     const lng = pos.coords.longitude;
        //     const accuracy = pos.coords.accuracy;

        //     L.marker([lat, lng]).addTo(map);
        //     L.circle([lat, lng], {
        //         radius: accuracy
        //     }).addTo(map);

        //     map.fitBounds(circle, getBounds())
        // }

        let userMarker = null;
        let userCircle = null;

        let userIcon = L.icon({
            iconUrl: 'https://cdn-icons-png.flaticon.com/512/64/64113.png',
            iconSize: [32, 32]
        });

        navigator.geolocation.watchPosition(success, error, {
            enableHighAccuracy: true
        });

        function success(pos) {
            const lat = pos.coords.latitude;
            const lng = pos.coords.longitude;
            // const accuracy = pos.coords.accuracy;

            // hapus marker lama
            if (userMarker) {
                map.removeLayer(userMarker);
                // map.removeLayer(userCircle);
            }

            // pakai icon di sini
            userMarker = L.marker([lat, lng], {
                icon: userIcon
            }).addTo(map).bindPopup("Lokasi Saya");

            // userCircle = L.circle([lat, lng], {
            //     radius: accuracy,
            //     color: 'blue'
            // }).addTo(map);

            map.setView([lat, lng], 15);
        }

        function error(err) {
            console.log("ERROR:", err.message);
            alert("Gagal ambil lokasi: " + err.message);
        }

        // let bounds = []

        // dataKuliner.forEach(function(item) {

        //     if (item.latitude && item.longitude) {

        //         let latlng = [item.latitude, item.longitude]

        //         bounds.push(latlng)

        //         L.marker(latlng)
        //             .addTo(map)
        //             .bindPopup(item.nama)

        //     }

        // })

        let bounds = []

        dataKuliner.forEach(function(item) {

            if (item.latitude && item.longitude) {

                let latlng = [item.latitude, item.longitude]

                bounds.push(latlng)

            }

        })

        if (bounds.length) {
            map.fitBounds(bounds)
        }


        let activeMarker = null

        document.querySelectorAll('.card-kuliner').forEach(card => {

            card.addEventListener('click', function() {

                let nama = this.dataset.nama
                let alamat = this.dataset.alamat
                let harga = this.dataset.harga
                let foto = this.dataset.foto
                let lat = this.dataset.lat
                let lng = this.dataset.lng
                let id = this.dataset.id

                document.getElementById('listKuliner').innerHTML = `
        
                <div class="bg-white rounded-2xl shadow-md p-5">

                    <button onclick="backToList()" class="mb-4 text-black"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>
                        </button>

                    <img src="${foto}" class="w-full h-56 object-cover rounded-xl mb-4">

                    <h2 class="text-2xl font-bold">${nama}</h2>

                    <p class="text-gray-600">${alamat}</p>

                    <p class="mt-2 font-semibold">${harga}</p>

                    <hr class="my-4">

                    <h3 class="font-bold mb-2">Penilaian dan Ulasan</h3>

                    <button onclick="openModal(${id})"
                        class="bg-gray-100 w-full text-gray-500 border px-4 py-2 rounded-xl mt-4 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                        </svg>
                        <span class="ml-1">Beri Penilaian dan Ulasan</span>
                    </button>

                    <div id="ulasanArea"></div>

                </div>
    
        `
                loadUlasan(id)
                markerGroup.clearLayers()

                L.marker([lat, lng])
                    .addTo(markerGroup)
                    .bindPopup(nama)
                    .openPopup()


                map.setView([lat, lng], 16)

            })

        })

        function backToList() {
            location.reload()
        }

        // Foto 
        const fotoInput = document.getElementById('foto_ulasan');
        const fotoError = document.getElementById('fotoError');
        const previewWrapper = document.getElementById('previewWrapper');
        const fotoPreview = document.getElementById('fotoPreview');

        const MAX_SIZE = 10 * 1024 * 1024;
        const ALLOWED_TYPES = ['image/jpeg', 'image/png', 'image/jpg'];

        fotoInput.addEventListener('change', function() {
            const file = this.files[0];

            fotoError.classList.add('hidden');
            fotoError.textContent = '';
            previewWrapper.classList.add('hidden');

            if (!file) return;

            if (!ALLOWED_TYPES.includes(file.type)) {
                showError('Format file tidak sesuai.');
                resetInput();
                return;
            }

            if (file.size > MAX_SIZE) {
                showError('Ukuran foto terlalu besar.');
                resetInput();
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                fotoPreview.src = e.target.result;
                previewWrapper.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        });

        function showError(message) {
            fotoError.textContent = message;
            fotoError.classList.remove('hidden');
        }

        function resetInput() {
            fotoInput.value = '';
            fotoPreview.src = '';
        }

        // function kirimUlasan(idKuliner) {

        //     let isi = document.getElementById('inputUlasan').value

        //     fetch(`/ulasan/store`, {
        //             method: 'POST',
        //             headers: {
        //                 'Content-Type': 'application/json',
        //                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //             },
        //             body: JSON.stringify({
        //                 ulasan: isi,
        //                 kuliner_id: idKuliner
        //             })
        //         })
        //         .then(res => res.json())
        //         .then(res => {

        //             document.getElementById('inputUlasan').value = ''

        //             loadUlasan(idKuliner)

        //         })

        // }

        function loadUlasan(idKuliner) {

            fetch(`/ulasan/${idKuliner}`)
                .then(res => res.json())
                .then(data => {

                    let html = ''
                    if (data.length === 0) {
                        html = `<p class="text-gray-500">Belum ada ulasan</p>`
                    } else {
                        // data.forEach(item => {
                        //     html += `
                    //     <div class="border rounded-xl p-3">
                    //         ⭐ ${item.penilaian ?? 5} <br>
                    //         ${item.ulasan}
                    //     </div>
                    //     `
                        // })
                        data.forEach(item => {

                            html += `
                        <div class="border-b py-3">
                            <div class="font-semibold">${item.nama ?? 'Anonymous'}</div>

                            <div class="text-yellow-500 text-sm">
                                ⭐ ${item.penilaian}
                            </div>

                            <div class="text-gray-600 text-sm">
                                ${item.ulasan}
                            </div>
                        </div>
                    `
                        })
                    }
                    document.getElementById('ulasanArea').innerHTML = html

                })

        }

        let kulinerAktif = null

        // function openModal(id) {
        //     kulinerAktif = id
        //     document.getElementById('modalUlasan').classList.remove('hidden')
        // }

        // function closeModal() {
        //     document.getElementById('modalUlasan').classList.add('hidden')
        // }
        function openModal(id) {
            kulinerAktif = id
            document.getElementById('id_wisata_kuliner').value = id
            document.getElementById('modalUlasan').classList.remove('hidden')
            document.body.style.overflow = 'hidden'
        }

        function closeModal() {
            document.getElementById('modalUlasan').classList.add('hidden')
            document.body.style.overflow = ''
        }

        // Penilaian
        document.addEventListener('DOMContentLoaded', function() {

            let ratingValue = 0

            let stars = document.querySelectorAll('#ratingStars .star')

            stars.forEach(star => {

                star.addEventListener('click', function() {

                    ratingValue = parseInt(this.dataset.value)

                    document.getElementById('penilaian').value = ratingValue

                    renderStars(ratingValue)

                })

            })

            function renderStars(val) {

                stars.forEach((star, index) => {

                    if (index + 1 <= val) {

                        star.setAttribute("fill", "currentColor")
                        star.classList.remove("text-gray-400")
                        star.classList.add("text-yellow-400")

                    } else {

                        star.setAttribute("fill", "none")
                        star.classList.remove("text-yellow-400")
                        star.classList.add("text-gray-400")

                    }

                })

            }

        })

        document.querySelector('#modalUlasan form').addEventListener('submit', function(e) {
            const penilaian = document.getElementById('penilaian').value
            if (!penilaian || penilaian == 0) {
                e.preventDefault()
                alert('Mohon pilih penilaian bintang terlebih dahulu.')
            }
        })

        // async function simpanUlasan() {

        //     let formData = new FormData()

        //     formData.append('id_wisata_kuliner', document.getElementById('id_wisata_kuliner').value)
        //     formData.append('penilaian', document.getElementById('penilaian').value)
        //     formData.append('ulasan', document.getElementById('ulasan').value)
        //     formData.append('harga_total', document.getElementById('harga_total').value)

        //     let file = document.getElementById('foto_ulasan').files[0]
        //     if (file) {
        //         formData.append('foto_ulasan', file)
        //     }

        //     let response = await fetch("{{ route('penilaianulasan.simpan') }}", {
        //         method: "POST",
        //         headers: {
        //             "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        //         },
        //         body: formData
        //     })

        //     let result = await response.text()

        //     console.log(result)

        //     // alert('Ulasan berhasil disimpan 👍')
        //     if (response.ok) {
        //         alert('Ulasan berhasil disimpan 👍')
        //     } else {
        //         alert('Gagal simpan 😭')
        //     }
        //     location.reload()

        // }

        // function renderStars(val) {

        //     let stars = document.querySelectorAll('#ratingStars i')

        //     stars.forEach((star, index) => {

        //         if (index + 1 <= val) {

        //             star.classList.remove('text-gray-300')
        //             star.classList.add('text-yellow-400')

        //         } else {

        //             star.classList.remove('text-yellow-400')
        //             star.classList.add('text-gray-300')

        //         }

        //     })

        // }

        // document.getElementById('btnKirimUlasan').onclick = function() {

        //     let teks = document.getElementById('inputUlasan').value
        //     let file = document.getElementById('fotoUlasan').files[0]

        //     let formData = new FormData()

        //     formData.append('kuliner_id', kulinerAktif)
        //     formData.append('ulasan', teks)
        //     formData.append('rating', ratingDipilih)

        //     if (file) {
        //         formData.append('foto', file)
        //     }

        //     fetch('/ulasan/store', {
        //             method: 'POST',
        //             headers: {
        //                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //             },
        //             body: formData
        //         })
        //         .then(res => res.json())
        //         .then(res => {

        //             closeModal()

        //             document.getElementById('inputUlasan').value = ''
        //             document.getElementById('fotoUlasan').value = ''

        //             loadUlasan(kulinerAktif)

        //         })

        // }
    </script>


</body>

</html>
