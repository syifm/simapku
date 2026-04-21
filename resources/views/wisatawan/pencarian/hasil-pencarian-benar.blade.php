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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/3.0.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/4.0.0/uicons-regular-straight/css/uicons-regular-straight.css'>
    {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" /> --}}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/multi-select-dropdown-js/MultiSelect.min.css">
    <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/4.0.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>


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

        * {
            /* font-family: "Jost", sans-serif; */
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        :root {
            /* --blue-color: #357ded; */
            --yellow-color: #FFA319;
            --green-color: #094B3C;
            --gray-color: #77889926;
        }

        /* body {
            background: var(--yellow-color);
            display: flex;
            align-items: center;
            flex-direction: column;
            min-height: 100dvh;
        } */

        .container {
            margin-block: auto;
            border-radius: 10px;
        }

        .range-slider {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            justify-content: space-between;
            /* gap: 20px; */
            gap: 5px;
            padding-block: 5px;
        }

        .range-slider.dragging {
            cursor: ew-resize;
        }

        .range-slider>input {
            border: none;
            outline: none;
            background: var(--gray-color);
            /* font-size: 1.5rem; */
            font-size: 15px;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            width: 115px;
            /* min-width: 64px; */
        }

        .range {
            width: 100%;
            /* width: 60%; */
            display: grid;
            position: relative;
            z-index: 5;
        }

        .range input {
            grid-row: 2;
            grid-column: 1;
            pointer-events: none;
            appearance: none;
            background: transparent;
        }

        .range input::-webkit-slider-thumb {
            pointer-events: auto;
            appearance: none;
            width: 20px;
            height: 20px;
            background: var(--yellow-color);
            border-radius: 50%;
            cursor: pointer;
        }

        .slider {
            position: absolute;
            height: 5px;
            width: 100%;
            background: var(--gray-color);
            top: 50%;
            transform: translateY(-50%);
            border-radius: 5px;
            overflow: hidden;
            z-index: -1;
        }

        .progress {
            position: absolute;
            height: 100%;
            background: var(--yellow-color);
            cursor: ew-resize;
        }

        .range-slider-rating {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            justify-content: space-between;
            /* gap: 20px; */
            gap: 5px;
            padding-block: 5px;
        }

        .range-slider-rating.dragging {
            cursor: ew-resize;
        }

        .range-slider-rating>input {
            border: none;
            outline: none;
            background: var(--gray-color);
            font-size: 15px;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            width: 115px;
        }

        .range-rating {
            width: 100%;
            display: grid;
            position: relative;
            z-index: 5;
        }

        .range-rating input {
            grid-row: 2;
            grid-column: 1;
            pointer-events: none;
            appearance: none;
            background: transparent;
        }

        .range-rating input::-webkit-slider-thumb {
            pointer-events: auto;
            appearance: none;
            width: 20px;
            height: 20px;
            background: var(--yellow-color);
            border-radius: 50%;
            cursor: pointer;
        }

        .slider-rating {
            position: absolute;
            height: 5px;
            width: 100%;
            background: var(--gray-color);
            top: 50%;
            transform: translateY(-50%);
            border-radius: 5px;
            overflow: hidden;
            z-index: -1;
        }

        .progress-rating {
            position: absolute;
            height: 100%;
            background: var(--yellow-color);
            cursor: ew-resize;
        }

        .range-slider-jarak {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            justify-content: space-between;
            gap: 5px;
            padding-block: 5px;
        }

        .range-slider-jarak.dragging {
            cursor: ew-resize;
        }

        .range-slider-jarak>input {
            border: none;
            outline: none;
            background: var(--gray-color);
            font-size: 15px;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            width: 115px;
        }

        .range-jarak {
            width: 100%;
            display: grid;
            position: relative;
            z-index: 5;
        }

        .range-jarak input {
            grid-row: 2;
            grid-column: 1;
            pointer-events: none;
            appearance: none;
            background: transparent;
        }

        .range-jarak input::-webkit-slider-thumb {
            pointer-events: auto;
            appearance: none;
            width: 20px;
            height: 20px;
            background: var(--yellow-color);
            border-radius: 50%;
            cursor: pointer;
        }

        .slider-jarak {
            position: absolute;
            height: 5px;
            width: 100%;
            background: var(--gray-color);
            top: 50%;
            transform: translateY(-50%);
            border-radius: 5px;
            overflow: hidden;
            z-index: -1;
        }

        .progress-jarak {
            position: absolute;
            height: 100%;
            background: var(--yellow-color);
            cursor: ew-resize;
        }

        .range-slider-jarak-dua {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            justify-content: space-between;
            gap: 5px;
            padding-block: 5px;
        }

        .range-jarak-dua {
            width: 100%;
            display: grid;
            position: relative;
            z-index: 5;
        }

        .range-jarak-dua input {
            grid-row: 1;
            grid-column: 1;
            pointer-events: none;
            appearance: none;
            background: transparent;
        }

        .range-jarak-dua input::-webkit-slider-thumb {
            pointer-events: auto;
            appearance: none;
            width: 20px;
            height: 20px;
            background: var(--yellow-color);
            border-radius: 50%;
            cursor: pointer;
        }

        .slider-jarak-dua {
            position: absolute;
            height: 5px;
            width: 100%;
            background: var(--gray-color);
            top: 50%;
            transform: translateY(-50%);
            border-radius: 5px;
            overflow: hidden;
            z-index: -1;
        }

        .progress-jarak-dua {
            position: absolute;
            height: 100%;
            background: var(--yellow-color);
        }
    </style>
    {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" /> --}}
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
                    <div class="w-full max-w-2xl z-20">
                        <div
                            class="flex items-center w-full max-w-2xl border rounded-full overflow-hidden shadow-sm font-medium bg-white">
                            <input type="text" name="keyword" placeholder="Cari Kuliner Disini..." autocomplete="off"
                                class="flex-1 px-5 py-3 focus:outline-none" id="searchBar">
                            <button class="bg-[#FFA319] px-4 py-3 text-white hover:bg-[#F19305] transition">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>

                        <div id="searchPanel"
                            class="hidden absolute w-full max-w-2xl mt-2 bg-white rounded-2xl shadow-lg p-4 z-50">
                            <!-- Kuliner Terdekat -->
                            <div onclick="cariKulinerTerdekat()"
                                class="p-3 rounded-xl bg-white shadow-md hover:bg-gray-100 cursor-pointer">
                                Kuliner Terdekat
                            </div>

                            <!-- Advanced Search -->
                            <div id="advancedBtn" class="flex gap-4 items-center p-3 rounded-xl cursor-pointer">
                                <span>Advanced Search</span>
                                <span class="leading-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="3" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    </svg>

                                </span>
                            </div>
                            <!-- Filter Advanced -->
                            <div id="advancedFilter" class="hidden mt-3 grid grid-cols-2 gap-3 ml-3 mr-3">
                                <input type="hidden" name="lat" id="lat">
                                <input type="hidden" name="lng" id="lng">

                                <div class="container">
                                    <label class="font-medium">Jarak</label>

                                    <div class="range-slider-jarak-dua flex justify-between items-center">
                                        <div class="flex items-center border rounded-lg overflow-hidden text-[15px]">
                                            <span class="bg-gray-200 px-3 py-2 text-gray-800">Km</span>
                                            <input type="number" name="jarak"
                                                class="nilai-jarak-dua w-[60px] p-2 outline-none border-0"
                                                value="1" min="1" max="10" />
                                        </div>

                                        <!-- .range -->
                                        <div class="range-jarak-dua">
                                            <input type="range" class="input-jarak-dua" value="1" min="1"
                                                max="10" />

                                            <div class="slider-jarak-dua">
                                                <div class="progress-jarak-dua"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label class="font-medium">Kategori</label>
                                    <select id="kategori" name="kategori[]" data-placeholder="Pilih Kategori..."
                                        data-theme="light" multiple data-multi-select>
                                        @foreach ($kategori as $item)
                                            <option value="{{ $item->id_kategori }}">
                                                {{ $item->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="container">
                                    <label class="font-medium">Harga</label>

                                    <!-- .range-slider -->
                                    <div class="range-slider flex justify-between items-center">
                                        <div class="flex items-center border rounded-lg overflow-hidden text-[15px]">
                                            <span class="bg-gray-200 px-3 py-2 text-gray-800">Rp</span>
                                            <input type="number" name="minharga"
                                                class="min-price w-[95px] p-2 outline-none border-0" value="1"
                                                min="1" max="1000000" />
                                        </div>

                                        <div class="flex items-center border rounded-lg overflow-hidden text-[15px]">
                                            <span class="bg-gray-200 px-3 py-2 text-gray-800">Rp</span>
                                            <input type="number" name="maxharga"
                                                class="max-price w-[95px] p-2 outline-none border-0" value="1000000"
                                                min="1" max="1000000" />
                                        </div>

                                        <!-- .range -->
                                        <div class="range">
                                            <input type="range" class="min-input" value="1" min="1"
                                                max="1000000" />
                                            <input type="range" class="max-input" value="1000000" min="1"
                                                max="1000000" />

                                            <div class="slider">
                                                <div class="progress"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label class="font-medium">Fasilitas</label>
                                    <select id="fasilitas" name="fasilitas[]" data-placeholder="Pilih Fasilitas..."
                                        data-theme="light" multiple data-multi-select>
                                        @foreach ($fasilitas as $item)
                                            <option value="{{ $item->id_fasilitas }}">
                                                {{ $item->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="container">
                                    <label class="font-medium">Nilai Kuliner</label>

                                    <!-- .range-slider -->
                                    <div class="range-slider-rating flex justify-between items-center">
                                        <div class="flex items-center border rounded-lg overflow-hidden text-[15px]">
                                            <svg class="w-5 h-5 text-[#FFA319] star ml-2" fill="#FFA319"
                                                stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                            </svg>
                                            <input type="number" name="minrating"
                                                class="min-rating w-[40px] p-2 outline-none border-0" value="1"
                                                min="1" max="5" />
                                        </div>

                                        <div
                                            class="flex items-center text-center border rounded-lg overflow-hidden text-[15px]">
                                            <svg class="w-5 h-5 text-[#FFA319] star ml-2" fill="#FFA319"
                                                stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                            </svg>
                                            <input type="number" name="maxrating"
                                                class="max-rating w-[40px] p-2 outline-none border-0" value="5"
                                                min="1" max="5" />
                                        </div>

                                        <!-- .range -->
                                        <div class="range">
                                            <input type="range" class="min-input-rating" value="1"
                                                min="1" max="5" />
                                            <input type="range" class="max-input-rating" value="5"
                                                min="1" max="5" />

                                            <div class="slider">
                                                <div class="progress-rating"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                        data-alamat="{{ $kuliner->alamat }}" data-min="{{ $kuliner->harga_min }}"
                        data-max="{{ $kuliner->harga_max }}" data-foto="{{ asset('storage/' . $kuliner->foto) }}"
                        data-fasilitas='@json($kuliner->fasilitas)' data-kategori='@json($kuliner->kategori)'
                        data-lat="{{ $kuliner->latitude }}" data-lng="{{ $kuliner->longitude }}">

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

                                <p class="text-gray-700 text-sm harga-text">
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
                        <label class="block text-sm font-medium text-gray-800 mb-1" for="harga_per_orang"><span>Harga
                                Total</span>
                            <span class="text-red-500 font-bold">*</span></label>
                        <input type="number" id="harga_per_orang" name="harga_per_orang" rows="6"
                            class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>{{ old('harga_per_orang') }}</input>
                        @error('harga_per_orang')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Foto Ulasan -->
                    <div>
                        {{-- <label class="block text-sm font-medium text-gray-800 mt-1 mb-1" for="foto">
                            <span>Foto</span>
                        </label> --}}
                        <label class="block text-sm font-medium text-gray-800 mt-1 mb-1">
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

        <!-- Modal: Belum Login -->
        <div id="modalLogin"
            class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
            <div class="bg-white rounded-2xl p-6 w-80 shadow-xl text-center">
                <h3 class="text-lg font-bold mb-2">Login Diperlukan</h3>
                <p class="text-gray-500 text-sm mb-4">Kamu harus login dulu untuk menyimpan favorit.</p>
                <div class="flex gap-2 justify-center">
                    <button onclick="closeModalLogin()"
                        class="px-4 py-2 rounded-xl border text-gray-500">Batal</button>
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-xl bg-blue-500 text-white">Login</a>
                </div>
            </div>
        </div>

        <!-- Modal: Komentar Opsional -->
        <div id="modalKomentar"
            class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
            <div class="bg-white rounded-2xl p-6 w-80 shadow-xl">
                <h3 class="text-lg font-bold mb-2">Tambah ke Favorit</h3>
                <p class="text-gray-500 text-sm mb-3">Mau tambahkan komentar? (opsional)</p>
                <textarea id="inputKomentar" rows="3" placeholder="Tulis komentar kamu..."
                    class="w-full border rounded-xl p-2 text-sm resize-none focus:outline-none focus:ring-2 focus:ring-blue-300"></textarea>
                <div class="flex gap-2 mt-4">
                    <button onclick="closeModalKomentar()"
                        class="flex-1 px-4 py-2 rounded-xl border text-gray-500">Batal</button>
                    <button onclick="submitKomentar()"
                        class="flex-1 px-4 py-2 rounded-xl bg-blue-500 text-white">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/multi-select-dropdown-js/MultiSelect.min.js"></script>

    {{-- <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_CM3lH19159L5LAd8GJoK9pwb5raOiFk&callback=getUserLocation&language=in"
        async defer></script> --}}
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_CM3lH19159L5LAd8GJoK9pwb5raOiFk&callback=initApp&language=in" async
        defer></script> --}}
    {{-- <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-gBdR_gqZTd8B6jz3mVJWI-pqC_jPlAI&libraries=maps,marker&v=weekly&internal_usage_attribution_ids=gmp_git_jsapisamples_v1_web-components&language=in"
        defer></script> --}}

    <script>
        // slider Jarak
        const sliderJarakDua = document.querySelector(".range-slider-jarak-dua");
        const progressJarakDua = sliderJarakDua.querySelector(".progress-jarak-dua");
        const nilaiJarakDua = sliderJarakDua.querySelector(".nilai-jarak-dua");
        const inputJarakDua = sliderJarakDua.querySelector(".input-jarak-dua");

        const updateProgressJarakDua = () => {
            const valueJarakDua = parseInt(inputJarakDua.value);
            const minJarakDua = parseInt(inputJarakDua.min);
            const maxJarakDua = parseInt(inputJarakDua.max);

            const totalRangeJarakDua = maxJarakDua - minJarakDua;
            const widthJarakDua = ((valueJarakDua - minJarakDua) / totalRangeJarakDua) * 100;

            progressJarakDua.style.width = widthJarakDua + "%";
            progressJarakDua.style.left = "0%";

            nilaiJarakDua.value = valueJarakDua;
        };

        inputJarakDua.addEventListener("input", () => {
            updateProgressJarakDua();
        });

        nilaiJarakDua.addEventListener("input", () => {
            let valJarakDua = parseInt(nilaiJarakDua.value);
            const minJarakDua = parseInt(inputJarakDua.min);
            const maxJarakDua = parseInt(inputJarakDua.max);

            // Clamp value dalam batas min-max
            if (valJarakDua < minJarakDua) valJarakDua = minJarakDua;
            if (valJarakDua > maxJarakDua) valJarakDua = maxJarakDua;

            inputJarakDua.value = valJarakDua;
            updateProgressJarakDua();
        });

        updateProgressJarakDua();

        // slider Harga
        const slider = document.querySelector(".range-slider");
        const progress = slider.querySelector(".progress");
        const minPriceInput = slider.querySelector(".min-price");
        const maxPriceInput = slider.querySelector(".max-price");
        const minInput = slider.querySelector(".min-input");
        const maxInput = slider.querySelector(".max-input");

        const updateProgress = () => {
            const minValue = parseInt(minInput.value);
            const maxValue = parseInt(maxInput.value);

            // get the total range of the slider
            const range = maxInput.max - minInput.min;
            // get the selected value range of the progress
            const valueRange = maxValue - minValue;
            // calculate the width percentage
            const width = (valueRange / range) * 100;
            // calculate the min thumb offset
            const minOffset = ((minValue - minInput.min) / range) * 100;

            // update the progress width
            progress.style.width = width + "%";
            // update the progress left position
            progress.style.left = minOffset + "%";

            // update the number inputs
            minPriceInput.value = minValue;
            maxPriceInput.value = maxValue;
        };

        const updateRange = (event) => {
            const input = event.target;

            let min = parseInt(minPriceInput.value);
            let max = parseInt(maxPriceInput.value);

            if (input === minPriceInput && min > max) {
                max = min;
                maxPriceInput.value = max;
            } else if (input === maxPriceInput && max < min) {
                min = max;
                minPriceInput.value = min;
            }

            minInput.value = min;
            maxInput.value = max;

            updateProgress();
        };

        minPriceInput.addEventListener("input", updateRange);
        maxPriceInput.addEventListener("input", updateRange);

        minInput.addEventListener("input", () => {
            if (parseInt(minInput.value) >= parseInt(maxInput.value)) {
                maxInput.value = minInput.value;
            }
            updateProgress();
        });

        maxInput.addEventListener("input", () => {
            if (parseInt(maxInput.value) <= parseInt(minInput.value)) {
                minInput.value = maxInput.value;
            }
            updateProgress();
        });

        let isDragging = false;
        let startOffsetX;

        progress.addEventListener("mousedown", (e) => {
            e.preventDefault(); // prevent text selection

            isDragging = true;

            startOffsetX = e.clientX - progress.getBoundingClientRect().left;

            slider.classList.toggle("dragging", isDragging);
        });

        document.addEventListener("mousemove", (e) => {
            if (isDragging) {
                // get the size and position of the slider
                const sliderRect = slider.getBoundingClientRect();
                const progressWidth = parseFloat(progress.style.width || 0);

                // calculate the new left position for the progress element
                let newLeft =
                    ((e.clientX - sliderRect.left - startOffsetX) / sliderRect.width) * 100;

                // ensure the progress is not exceeding the slider boundaries
                newLeft = Math.min(Math.max(newLeft, 0), 100 - progressWidth);

                // update the progress position
                progress.style.left = newLeft + "%";

                // calculate the new min thumb position
                const range = maxInput.max - minInput.min;
                const newMin = Math.round((newLeft / 100) * range) + parseInt(minInput.min);
                const newMax = newMin + parseInt(maxInput.value) - parseInt(minInput.value);

                // update the min input
                minInput.value = newMin;
                maxInput.value = newMax;

                // update the progress
                updateProgress();
            }
            slider.classList.toggle("dragging", isDragging);
        });

        document.addEventListener("mouseup", () => {
            if (isDragging) {
                isDragging = false;
            }
            slider.classList.toggle("dragging", isDragging);
        });

        updateProgress();

        // slider Penilaian
        const sliderRating = document.querySelector(".range-slider-rating");
        const progressRating = sliderRating.querySelector(".progress-rating");
        const minRatingInput = sliderRating.querySelector(".min-rating");
        const maxRatingInput = sliderRating.querySelector(".max-rating");
        const minInputRating = sliderRating.querySelector(".min-input-rating");
        const maxInputRating = sliderRating.querySelector(".max-input-rating");

        const updateProgressRating = () => {
            const minValueRating = parseInt(minInputRating.value);
            const maxValueRating = parseInt(maxInputRating.value);

            const totalRangeRating = maxInputRating.max - minInputRating.min;
            const valueRangeRating = maxValueRating - minValueRating;

            const widthRating = (valueRangeRating / totalRangeRating) * 100;
            const minOffsetRating = ((minValueRating - minInputRating.min) / totalRangeRating) * 100;

            progressRating.style.width = widthRating + "%";
            progressRating.style.left = minOffsetRating + "%";

            minRatingInput.value = minValueRating;
            maxRatingInput.value = maxValueRating;
        };

        const updateRangeRating = (event) => {
            const inputRating = event.target;

            let minRating = parseInt(minRatingInput.value);
            let maxRating = parseInt(maxRatingInput.value);

            if (inputRating === minRatingInput && minRating > maxRating) {
                maxRating = minRating;
                maxRatingInput.value = maxRating;
            } else if (inputRating === maxRatingInput && maxRating < minRating) {
                minRating = maxRating;
                minRatingInput.value = minRating;
            }

            minInputRating.value = minRating;
            maxInputRating.value = maxRating;

            updateProgressRating();
        };

        minRatingInput.addEventListener("input", updateRangeRating);
        maxRatingInput.addEventListener("input", updateRangeRating);

        minInputRating.addEventListener("input", () => {
            if (parseInt(minInputRating.value) >= parseInt(maxInputRating.value)) {
                maxInputRating.value = minInputRating.value;
            }
            updateProgressRating();
        });

        maxInputRating.addEventListener("input", () => {
            if (parseInt(maxInputRating.value) <= parseInt(minInputRating.value)) {
                minInputRating.value = maxInputRating.value;
            }
            updateProgressRating();
        });

        let isDraggingRating = false;
        let startOffsetXRating;

        progressRating.addEventListener("mousedown", (e) => {
            e.preventDefault();

            isDraggingRating = true;
            startOffsetXRating = e.clientX - progressRating.getBoundingClientRect().left;

            sliderRating.classList.toggle("dragging", isDraggingRating);
        });

        document.addEventListener("mousemove", (e) => {
            if (isDraggingRating) {
                const sliderRectRating = sliderRating.getBoundingClientRect();
                const progressWidthRating = parseFloat(progressRating.style.width || 0);

                let newLeftRating =
                    ((e.clientX - sliderRectRating.left - startOffsetXRating) / sliderRectRating.width) * 100;

                newLeftRating = Math.min(Math.max(newLeftRating, 0), 100 - progressWidthRating);

                progressRating.style.left = newLeftRating + "%";

                const totalRangeRating = maxInputRating.max - minInputRating.min;
                const newMinRating = Math.round((newLeftRating / 100) * totalRangeRating) + parseInt(minInputRating
                    .min);
                const newMaxRating = newMinRating + parseInt(maxInputRating.value) - parseInt(minInputRating.value);

                minInputRating.value = newMinRating;
                maxInputRating.value = newMaxRating;

                updateProgressRating();
            }

            sliderRating.classList.toggle("dragging", isDraggingRating);
        });

        document.addEventListener("mouseup", () => {
            if (isDraggingRating) {
                isDraggingRating = false;
            }
            sliderRating.classList.toggle("dragging", isDraggingRating);
        });

        updateProgressRating();

        document.addEventListener('DOMContentLoaded', () => {
            const hamburger = document.getElementById('hamburger');
            const sidebar = document.querySelector('.sidebar');

            if (!hamburger || !sidebar) return;

            hamburger.addEventListener('click', () => {
                sidebar.classList.toggle('expanded');
            });

            const params = new URLSearchParams(window.location.search);
            const detailId = params.get('detail');

            if (detailId) {
                openDetailFromId(detailId);
            }
        });

        function openDetailFromId(id) {
            let card = document.querySelector(`.card-kuliner[data-id="${id}"]`);
            if (card) card.click();
        }

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

        // MAPS --------------------------------------------------------------------------------
        let map;
        let userMarker = null;
        let markers = [];
        let userLat = null;
        let userLng = null;

        let directionsService;
        let directionsRenderer;

        let dataKuliner = @json($data);
        let activeInfoWindow = null;

        async function initApp() {
            let defaultLocation = {
                lat: -6.99,
                lng: 110.42
            };

            const markerLib = await google.maps.importLibrary("marker");
            AdvancedMarkerElement = markerLib.AdvancedMarkerElement;
            PinElement = markerLib.PinElement;

            map = new google.maps.Map(document.getElementById("map"), {
                center: defaultLocation,
                zoom: 10,
                mapId: "5ee8a1d5bfc6676ac1b5f32c",
                clickableIcons: false,
            });

            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer();
            directionsRenderer.setMap(map);

            tampilkanSemuaKuliner();

            navigator.geolocation.watchPosition(success, error, {
                enableHighAccuracy: true
            });
        }

        function success(pos) {
            const lat = pos.coords.latitude;
            const lng = pos.coords.longitude;

            userLat = lat;
            userLng = lng;

            updateUserLocation(lat, lng);

            // cariKulinerTerdekat();
        }

        function error(err) {
            console.log("ERROR:", err.message);
            alert("Gagal ambil lokasi: " + err.message);
        }

        function updateUserLocation(lat, lng) {
            let posisi = {
                lat: lat,
                lng: lng
            };

            if (userMarker) {
                userMarker.position = posisi;
            } else {
                userMarker = new google.maps.marker.AdvancedMarkerElement({
                    position: posisi,
                    map: map,
                    title: "Lokasi Saya",
                    // icon: "https://cdn-icons-png.flaticon.com/512/64/64113.png"
                });
            }

            map.setCenter(posisi);
        }

        function clearMarkers() {
            markers.forEach(marker => marker.setMap(null));
            markers = [];
        }

        function tampilkanSemuaKuliner() {
            clearMarkers();
            dataKuliner.forEach(item => {
                if (item.latitude && item.longitude) {
                    let posisi = {
                        lat: parseFloat(item.latitude),
                        lng: parseFloat(item.longitude)
                    };

                    const pin = new PinElement({
                        background: "#FB991A",
                        borderColor: "#ffffff",
                        glyphColor: "#ffffff"
                    });

                    let marker = new google.maps.marker.AdvancedMarkerElement({
                        position: posisi,
                        map: map,
                        title: item.nama,
                        content: pin,
                    });

                    markers.push(marker);

                    let infoWindow = new google.maps.InfoWindow({
                        content: `
                            <div style="width:250px; font-family:sans-serif;">
                                <h3 style="margin:0 0 5px; font-size:16px;">
                                ${item.nama}
                                </h3>
                                <p style="margin:0 0 10px; color:#555;">
                                    ${item.alamat ?? '-'}
                                </p>
                            </div>  
                        `
                    });

                    marker.addEventListener("click", () => {
                        if (activeInfoWindow) {
                            activeInfoWindow.close();
                        }

                        infoWindow.open(map, marker);
                        activeInfoWindow = infoWindow;
                    });
                }
            });
        }


        function lihatRute(destLat, destLng) {
            if (!userLat || !userLng) {
                alert("Lokasi user belum tersedia");
                return;
            }

            let request = {
                origin: {
                    lat: userLat,
                    lng: userLng
                },
                destination: {
                    lat: destLat,
                    lng: destLng
                },
                travelMode: 'DRIVING'
            };

            directionsService.route(request, function(result, status) {
                if (status === 'OK') {
                    directionsRenderer.setDirections(result);
                } else {
                    alert("Gagal menampilkan rute");
                }
            });
        }

        function editWisataKuliner(id) {

            // window.location.href = `/wisatawan/editwisatakuliner/${id}`;
            window.location.href =
                `/wisatawan/editwisatakuliner/${id}?from=` + encodeURIComponent(window.location.href);
        }


        const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
        const favoritIds =
            {{ Auth::check()
                ? json_encode(
                    \App\Models\KulinerFavorit::where(
                        'id_wisatawan',
                        \App\Models\Wisatawan::where('user_id', Auth::id())->value('id_wisatawan'),
                    )->pluck('id_wisata_kuliner'),
                )
                : '[]' }};

        function simpanFavorit(id, el) {
            // Belum login
            if (!isLoggedIn) {
                showModalLogin();
                return;
            }

            let isFavorit = el.classList.contains('favorit-aktif');

            if (isFavorit) {
                fetch(`/favorit/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        el.classList.remove('favorit-aktif', 'text-red-500');
                        el.classList.add('text-white');
                    })
                    .catch(err => console.error(err));

            } else {
                showModalKomentar(id, el);
            }
        }

        function simpanFavoritDenganKomentar(id, el, komentar = null) {
            fetch(`/favorit`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        id_wisata_kuliner: id,
                        komentar: komentar
                    })
                })
                .then(res => res.json())
                .then(data => {
                    el.classList.add('favorit-aktif', 'text-red-500');
                    el.classList.remove('text-white');
                })
                .catch(err => console.error(err));
        }

        let favoritTarget = {
            id: null,
            el: null
        };

        function showModalLogin() {
            document.getElementById('modalLogin').classList.remove('hidden');
        }

        function closeModalLogin() {
            document.getElementById('modalLogin').classList.add('hidden');
        }

        function showModalKomentar(id, el) {
            favoritTarget = {
                id,
                el
            };
            document.getElementById('inputKomentar').value = '';
            document.getElementById('modalKomentar').classList.remove('hidden');
        }

        function closeModalKomentar() {
            document.getElementById('modalKomentar').classList.add('hidden');
            favoritTarget = {
                id: null,
                el: null
            };
        }

        function submitKomentar() {
            let komentar = document.getElementById('inputKomentar').value.trim() || null;
            closeModalKomentar();
            simpanFavoritDenganKomentar(favoritTarget.id, favoritTarget.el, komentar);
        }

        document.querySelectorAll('.card-kuliner').forEach(card => {

            card.addEventListener('click', function() {

                let nama = this.dataset.nama;
                let alamat = this.dataset.alamat;
                let foto = this.dataset.foto;
                let lat = parseFloat(this.dataset.lat);
                let lng = parseFloat(this.dataset.lng);
                let id = this.dataset.id;

                let min = parseInt(this.dataset.min) || null;
                let max = parseInt(this.dataset.max) || null;

                let harga = formatHarga(min, max);

                // let fasilitas = JSON.parse(this.dataset.fasilitas || '[]');
                // let container = document.getElementById('fasilitas');

                // container.innerHTML = '';
                // if (fasilitas.length > 0) {
                //     fasilitas.forEach(f => {
                //         let span = document.createElement('span');
                //         span.textContent = f.nama;

                //         span.style.display = 'inline-block';
                //         span.style.padding = '4px 4px';
                //         span.style.margin = '2px';
                //         span.style.backgroundColor = '#dddddd';
                //         span.style.borderRadius = '4px';
                //         span.style.fontSize = '12px';

                //         container.appendChild(span);
                //     });
                // } else {
                //     container.textContent = '-';
                // }

                // <button onclick="backToList()" class="mb-4 text-black"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                //         <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                //         </svg>
                //         </button>

                let fasilitas = [];

                try {
                    fasilitas = JSON.parse(this.dataset.fasilitas);
                    if (!Array.isArray(fasilitas)) {
                        fasilitas = [];
                    }
                } catch (e) {
                    fasilitas = [];
                }
                // Kategori
                let kategori = [];

                try {
                    kategori = JSON.parse(this.dataset.kategori);
                    if (!Array.isArray(kategori)) {
                        kategori = [];
                    }
                } catch (e) {
                    kategori = [];
                }

                let kategoriHTML = kategori.length > 0 ?
                    kategori.map(k =>
                        `<span class="inline-block px-2 py-1 bg-gray-200 text-black rounded-md text-sm">${k.nama}</span>`
                    ).join('') :
                    '';

                // Fasilitas
                let fasilitasHTML = fasilitas.length > 0 ?
                    fasilitas.map(f =>
                        `<span class="inline-block px-2 py-1 bg-gray-200 text-black rounded-md text-sm">${f.nama}</span>`
                    ).join('') :
                    '';

                const url = new URL(window.location.href);
                url.searchParams.set('detail', id);
                history.pushState(null, '', url);

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

                <div class="mt-3">
                    <p class="text-sm font-semibold text-gray-500">Kategori</p>
                    <div class="flex flex-wrap gap-2 mt-1">
                        ${kategoriHTML}
                    </div>
                </div>

                <div class="mt-3">
                    <p class="text-sm font-semibold text-gray-500">Fasilitas</p>
                    <div class="flex flex-wrap gap-2 mt-1">
                        ${fasilitasHTML}
                    </div>
                </div>

                <div class="flex justify-end gap-2 mt-6">
                    <button <button onclick="simpanFavorit(${id}, this, event)"
                        class="bg-blue-500 text-white px-4 py-2 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                        </svg>
                    </button>

                    <button onclick="lihatRute(${lat}, ${lng})"
                        class="bg-blue-500 text-white px-4 py-2 rounded-xl">
                        Lihat Rute
                    </button>

                    <button onclick="editWisataKuliner(${id})"
                        class="bg-green-500 text-white px-4 py-2 rounded-xl">
                        Edit Wisata Kuliner
                    </button>
                </div>

                <hr class="my-4">

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
        `;

                loadUlasan(id);

                clearMarkers();

                const pin = new PinElement({
                    background: "#FB991A",
                    borderColor: "#ffffff",
                    glyphColor: "#ffffff"
                });

                let posisi = {
                    lat: lat,
                    lng: lng
                };

                let marker = new google.maps.marker.AdvancedMarkerElement({
                    position: posisi,
                    map: map,
                    title: nama,
                    content: pin,
                });

                markers.push(marker);

                map.setCenter(posisi);
                map.setZoom(16);

                let infoWindow = new google.maps.InfoWindow({
                    content: `
                            <div style="width:250px; font-family:sans-serif;">
                                <h3 style="margin:0 0 5px; font-size:16px;">
                                ${nama}
                                </h3>
                                <p style="margin:0 0 10px; color:#555;">
                                    ${alamat ?? '-'}
                                </p>
                            </div>  
                        `
                });

                marker.addEventListener("click", () => {
                    if (activeInfoWindow) {
                        activeInfoWindow.close();
                    }

                    infoWindow.open(map, marker);
                    activeInfoWindow = infoWindow;
                });
            });

        });

        function backToList() {
            const url = new URL(window.location.href);
            url.searchParams.delete('detail');
            history.pushState(null, '', url);
            location.reload()
        }

        document.querySelectorAll('.card-kuliner').forEach(card => {
            let min = parseInt(card.dataset.min) || null;
            let max = parseInt(card.dataset.max) || null;

            // let text = '';

            // if (min && max) {
            //     text = `Rp ${min.toLocaleString('id-ID')} - ${max.toLocaleString('id-ID')}`;
            // } else if (min && !max) {
            //     text = `Rp ${min.toLocaleString('id-ID')}+`;
            // } else if (!min && max) {
            //     text = `≤ Rp ${max.toLocaleString('id-ID')}`;
            // } else {
            //     text = '';
            // }

            let hargaEl = card.querySelector('.harga-text');
            if (hargaEl) {
                hargaEl.textContent = formatHarga(min, max);
            }
        });

        function formatHarga(min, max) {
            if (min && max) {
                return `Rp ${min.toLocaleString('id-ID')} - ${max.toLocaleString('id-ID')}`;
            } else if (min && !max) {
                return `Rp ${min.toLocaleString('id-ID')}+`;
            } else if (!min && max) {
                return `≤ Rp ${max.toLocaleString('id-ID')}`;
            }
            return '';
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

        // async function cariKulinerTerdekat() {

        //     let params = new URLSearchParams({
        //         lat: userLat,
        //         lng: userLng,
        //         radius: 5 // km (bisa dari input)
        //     });

        //     let response = await fetch(`/api/kuliner-terdekat?${params}`);
        //     let data = await response.json();

        //     tampilkanSemuaKuliner(data);
        // }


        // async function cariKulinerTerdekat() {

        //     if (!userLat || !userLng) {
        //         alert("Lokasi belum tersedia");
        //         return;
        //     }

        //     let params = new URLSearchParams({
        //         lat: userLat,
        //         lng: userLng,
        //         radius: 5 // bisa kamu ubah nanti
        //     });

        //     try {
        //         let response = await fetch(`/api/kuliner-terdekat?${params}`);
        //         let data = await response.json();

        //         console.log("HASIL TERDEKAT:", data);

        //         tampilkanHasilTerdekat(data);

        //     } catch (error) {
        //         console.error("Error:", error);
        //     }
        // }


        // function tampilkanHasilTerdekat(data) {

        //     clearMarkers();

        //     let bounds = new google.maps.LatLngBounds();

        //     data.forEach(item => {

        //         let posisi = {
        //             lat: parseFloat(item.latitude),
        //             lng: parseFloat(item.longitude)
        //         };

        //         let marker = new google.maps.Marker({
        //             position: posisi,
        //             map: map,
        //             title: item.nama,
        //             icon: "http://maps.google.com/mapfiles/ms/icons/green-dot.png"
        //         });

        //         markers.push(marker);
        //         bounds.extend(posisi);

        //     });

        //     if (data.length > 0) {
        //         map.fitBounds(bounds);
        //     } else {
        //         alert("Tidak ada kuliner dalam radius ini");
        //     }
        // }



        // async function simpanUlasan() {

        //     let formData = new FormData()

        //     formData.append('id_wisata_kuliner', document.getElementById('id_wisata_kuliner').value)
        //     formData.append('penilaian', document.getElementById('penilaian').value)
        //     formData.append('ulasan', document.getElementById('ulasan').value)
        //     formData.append('harga_per_orang', document.getElementById('harga_per_orang').value)

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
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-gBdR_gqZTd8B6jz3mVJWI-pqC_jPlAI&callback=initApp&libraries=maps,marker&v=weekly&language=in"
        async defer></script>

    <script>
        < script >
            const csrfToken = "{{ csrf_token() }}";

        // slider Jarak
        const sliderJarakDua = document.querySelector(".range-slider-jarak-dua");
        const progressJarakDua = sliderJarakDua.querySelector(".progress-jarak-dua");
        const nilaiJarakDua = sliderJarakDua.querySelector(".nilai-jarak-dua");
        const inputJarakDua = sliderJarakDua.querySelector(".input-jarak-dua");

        document.querySelectorAll('.harga-text').forEach(el => {
            let min = parseInt(el.dataset.min) || null;
            let max = parseInt(el.dataset.max) || null;

            el.textContent = formatHarga(min, max);
        });

        const updateProgressJarakDua = () => {
            const valueJarakDua = parseInt(inputJarakDua.value);
            const minJarakDua = parseInt(inputJarakDua.min);
            const maxJarakDua = parseInt(inputJarakDua.max);

            const totalRangeJarakDua = maxJarakDua - minJarakDua;
            const widthJarakDua = ((valueJarakDua - minJarakDua) / totalRangeJarakDua) * 100;

            progressJarakDua.style.width = widthJarakDua + "%";
            progressJarakDua.style.left = "0%";

            nilaiJarakDua.value = valueJarakDua;
        };

        inputJarakDua.addEventListener("input", () => {
            updateProgressJarakDua();
        });

        nilaiJarakDua.addEventListener("input", () => {
            let valJarakDua = parseInt(nilaiJarakDua.value);
            const minJarakDua = parseInt(inputJarakDua.min);
            const maxJarakDua = parseInt(inputJarakDua.max);

            // Clamp value dalam batas min-max
            if (valJarakDua < minJarakDua) valJarakDua = minJarakDua;
            if (valJarakDua > maxJarakDua) valJarakDua = maxJarakDua;

            inputJarakDua.value = valJarakDua;
            updateProgressJarakDua();
        });

        updateProgressJarakDua();

        // slider Harga
        const slider = document.querySelector(".range-slider");
        const progress = slider.querySelector(".progress");
        const minPriceInput = slider.querySelector(".min-price");
        const maxPriceInput = slider.querySelector(".max-price");
        const minInput = slider.querySelector(".min-input");
        const maxInput = slider.querySelector(".max-input");

        const updateProgress = () => {
            const minValue = parseInt(minInput.value);
            const maxValue = parseInt(maxInput.value);

            // get the total range of the slider
            const range = maxInput.max - minInput.min;
            // get the selected value range of the progress
            const valueRange = maxValue - minValue;
            // calculate the width percentage
            const width = (valueRange / range) * 100;
            // calculate the min thumb offset
            const minOffset = ((minValue - minInput.min) / range) * 100;

            // update the progress width
            progress.style.width = width + "%";
            // update the progress left position
            progress.style.left = minOffset + "%";

            // update the number inputs
            minPriceInput.value = minValue;
            maxPriceInput.value = maxValue;
        };

        const updateRange = (event) => {
            const input = event.target;

            let min = parseInt(minPriceInput.value);
            let max = parseInt(maxPriceInput.value);

            if (input === minPriceInput && min > max) {
                max = min;
                maxPriceInput.value = max;
            } else if (input === maxPriceInput && max < min) {
                min = max;
                minPriceInput.value = min;
            }

            minInput.value = min;
            maxInput.value = max;

            updateProgress();
        };

        minPriceInput.addEventListener("input", updateRange);
        maxPriceInput.addEventListener("input", updateRange);

        minInput.addEventListener("input", () => {
            if (parseInt(minInput.value) >= parseInt(maxInput.value)) {
                maxInput.value = minInput.value;
            }
            updateProgress();
        });

        maxInput.addEventListener("input", () => {
            if (parseInt(maxInput.value) <= parseInt(minInput.value)) {
                minInput.value = maxInput.value;
            }
            updateProgress();
        });

        let isDragging = false;
        let startOffsetX;

        progress.addEventListener("mousedown", (e) => {
            e.preventDefault(); // prevent text selection

            isDragging = true;

            startOffsetX = e.clientX - progress.getBoundingClientRect().left;

            slider.classList.toggle("dragging", isDragging);
        });

        document.addEventListener("mousemove", (e) => {
            if (isDragging) {
                // get the size and position of the slider
                const sliderRect = slider.getBoundingClientRect();
                const progressWidth = parseFloat(progress.style.width || 0);

                // calculate the new left position for the progress element
                let newLeft =
                    ((e.clientX - sliderRect.left - startOffsetX) / sliderRect.width) * 100;

                // ensure the progress is not exceeding the slider boundaries
                newLeft = Math.min(Math.max(newLeft, 0), 100 - progressWidth);

                // update the progress position
                progress.style.left = newLeft + "%";

                // calculate the new min thumb position
                const range = maxInput.max - minInput.min;
                const newMin = Math.round((newLeft / 100) * range) + parseInt(minInput.min);
                const newMax = newMin + parseInt(maxInput.value) - parseInt(minInput.value);

                // update the min input
                minInput.value = newMin;
                maxInput.value = newMax;

                // update the progress
                updateProgress();
            }
            slider.classList.toggle("dragging", isDragging);
        });

        document.addEventListener("mouseup", () => {
            if (isDragging) {
                isDragging = false;
            }
            slider.classList.toggle("dragging", isDragging);
        });

        updateProgress();

        // slider Penilaian
        const sliderRating = document.querySelector(".range-slider-rating");
        const progressRating = sliderRating.querySelector(".progress-rating");
        const minRatingInput = sliderRating.querySelector(".min-rating");
        const maxRatingInput = sliderRating.querySelector(".max-rating");
        const minInputRating = sliderRating.querySelector(".min-input-rating");
        const maxInputRating = sliderRating.querySelector(".max-input-rating");

        const updateProgressRating = () => {
            const minValueRating = parseInt(minInputRating.value);
            const maxValueRating = parseInt(maxInputRating.value);

            const totalRangeRating = maxInputRating.max - minInputRating.min;
            const valueRangeRating = maxValueRating - minValueRating;

            const widthRating = (valueRangeRating / totalRangeRating) * 100;
            const minOffsetRating = ((minValueRating - minInputRating.min) / totalRangeRating) * 100;

            progressRating.style.width = widthRating + "%";
            progressRating.style.left = minOffsetRating + "%";

            minRatingInput.value = minValueRating;
            maxRatingInput.value = maxValueRating;
        };

        const updateRangeRating = (event) => {
            const inputRating = event.target;

            let minRating = parseInt(minRatingInput.value);
            let maxRating = parseInt(maxRatingInput.value);

            if (inputRating === minRatingInput && minRating > maxRating) {
                maxRating = minRating;
                maxRatingInput.value = maxRating;
            } else if (inputRating === maxRatingInput && maxRating < minRating) {
                minRating = maxRating;
                minRatingInput.value = minRating;
            }

            minInputRating.value = minRating;
            maxInputRating.value = maxRating;

            updateProgressRating();
        };

        minRatingInput.addEventListener("input", updateRangeRating);
        maxRatingInput.addEventListener("input", updateRangeRating);

        minInputRating.addEventListener("input", () => {
            if (parseInt(minInputRating.value) >= parseInt(maxInputRating.value)) {
                maxInputRating.value = minInputRating.value;
            }
            updateProgressRating();
        });

        maxInputRating.addEventListener("input", () => {
            if (parseInt(maxInputRating.value) <= parseInt(minInputRating.value)) {
                minInputRating.value = maxInputRating.value;
            }
            updateProgressRating();
        });

        let isDraggingRating = false;
        let startOffsetXRating;

        progressRating.addEventListener("mousedown", (e) => {
            e.preventDefault();

            isDraggingRating = true;
            startOffsetXRating = e.clientX - progressRating.getBoundingClientRect().left;

            sliderRating.classList.toggle("dragging", isDraggingRating);
        });

        document.addEventListener("mousemove", (e) => {
            if (isDraggingRating) {
                const sliderRectRating = sliderRating.getBoundingClientRect();
                const progressWidthRating = parseFloat(progressRating.style.width || 0);

                let newLeftRating =
                    ((e.clientX - sliderRectRating.left - startOffsetXRating) / sliderRectRating.width) * 100;

                newLeftRating = Math.min(Math.max(newLeftRating, 0), 100 - progressWidthRating);

                progressRating.style.left = newLeftRating + "%";

                const totalRangeRating = maxInputRating.max - minInputRating.min;
                const newMinRating = Math.round((newLeftRating / 100) * totalRangeRating) + parseInt(minInputRating
                    .min);
                const newMaxRating = newMinRating + parseInt(maxInputRating.value) - parseInt(minInputRating.value);

                minInputRating.value = newMinRating;
                maxInputRating.value = newMaxRating;

                updateProgressRating();
            }

            sliderRating.classList.toggle("dragging", isDraggingRating);
        });

        document.addEventListener("mouseup", () => {
            if (isDraggingRating) {
                isDraggingRating = false;
            }
            sliderRating.classList.toggle("dragging", isDraggingRating);
        });

        updateProgressRating();

        document.addEventListener('DOMContentLoaded', () => {
            const hamburger = document.getElementById('hamburger');
            const sidebar = document.querySelector('.sidebar');

            if (!hamburger || !sidebar) return;

            hamburger.addEventListener('click', () => {
                sidebar.classList.toggle('expanded');
            });

            const params = new URLSearchParams(window.location.search);
            const detailId = params.get('detail');

            if (detailId) {
                openDetailFromId(detailId);
            }
        });

        function openDetailFromId(id) {
            let card = document.querySelector(`.card-kuliner[data-id="${id}"]`);
            if (card) card.click();
        }

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

        // MAPS --------------------------------------------------------------------------------
        let map;
        let userMarker = null;
        let markers = [];
        let userLat = null;
        let userLng = null;

        let directionsService;
        let directionsRenderer;

        let dataKuliner = @json($data);
        let activeInfoWindow = null;

        async function initApp() {
            let defaultLocation = {
                lat: -6.99,
                lng: 110.42
            };

            const markerLib = await google.maps.importLibrary("marker");
            AdvancedMarkerElement = markerLib.AdvancedMarkerElement;
            PinElement = markerLib.PinElement;

            map = new google.maps.Map(document.getElementById("map"), {
                center: defaultLocation,
                zoom: 10,
                mapId: "5ee8a1d5bfc6676ac1b5f32c",
                clickableIcons: false,
            });

            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer();
            directionsRenderer.setMap(map);

            tampilkanSemuaKuliner();

            navigator.geolocation.watchPosition(success, error, {
                enableHighAccuracy: true
            });
        }

        function success(pos) {
            const lat = pos.coords.latitude;
            const lng = pos.coords.longitude;

            userLat = lat;
            userLng = lng;

            updateUserLocation(lat, lng);

            // cariKulinerTerdekat();
        }

        function error(err) {
            console.log("ERROR:", err.message);
            alert("Gagal ambil lokasi: " + err.message);
        }

        function updateUserLocation(lat, lng) {
            let posisi = {
                lat: lat,
                lng: lng
            };

            if (userMarker) {
                userMarker.position = posisi;
            } else {
                userMarker = new google.maps.marker.AdvancedMarkerElement({
                    position: posisi,
                    map: map,
                    title: "Lokasi Saya",
                    // icon: "https://cdn-icons-png.flaticon.com/512/64/64113.png"
                });
            }

            map.setCenter(posisi);
        }

        function clearMarkers() {
            markers.forEach(marker => marker.setMap(null));
            markers = [];
        }

        function tampilkanSemuaKuliner() {
            clearMarkers();
            dataKuliner.forEach(item => {
                if (item.latitude && item.longitude) {
                    let posisi = {
                        lat: parseFloat(item.latitude),
                        lng: parseFloat(item.longitude)
                    };

                    const pin = new PinElement({
                        background: "#FB991A",
                        borderColor: "#ffffff",
                        glyphColor: "#ffffff"
                    });

                    let marker = new google.maps.marker.AdvancedMarkerElement({
                        position: posisi,
                        map: map,
                        title: item.nama,
                        content: pin,
                    });

                    markers.push(marker);

                    let infoWindow = new google.maps.InfoWindow({
                        content: `
                            <div style="width:250px; font-family:sans-serif;">
                                <h3 style="margin:0 0 5px; font-size:16px;">
                                ${item.nama}
                                </h3>
                                <p style="margin:0 0 10px; color:#555;">
                                    ${item.alamat ?? '-'}
                                </p>
                            </div>  
                        `
                    });

                    marker.addEventListener("click", () => {
                        if (activeInfoWindow) {
                            activeInfoWindow.close();
                        }

                        infoWindow.open(map, marker);
                        activeInfoWindow = infoWindow;
                    });
                }
            });
        }

        // Isi card
        let favoritIds = @json($favoritIds);

        document.querySelectorAll('.card-kuliner').forEach(card => {

            card.addEventListener('click', function() {

                let nama = this.dataset.nama;
                let alamat = this.dataset.alamat;
                let foto = this.dataset.foto;
                let lat = parseFloat(this.dataset.lat);
                let lng = parseFloat(this.dataset.lng);
                let id = this.dataset.id;

                let min = parseInt(this.dataset.min) || null;
                let max = parseInt(this.dataset.max) || null;

                let harga = formatHarga(min, max);
                let isFavorit = favoritIds.includes(parseInt(id));

                let fasilitas = [];

                try {
                    fasilitas = JSON.parse(this.dataset.fasilitas);
                    if (!Array.isArray(fasilitas)) {
                        fasilitas = [];
                    }
                } catch (e) {
                    fasilitas = [];
                }
                // Kategori
                let kategori = [];

                try {
                    kategori = JSON.parse(this.dataset.kategori);
                    if (!Array.isArray(kategori)) {
                        kategori = [];
                    }
                } catch (e) {
                    kategori = [];
                }

                let kategoriHTML = '';

                if (kategori.length > 0) {
                    let isiKategori = kategori.map(k =>
                        `<span class="inline-block px-2 py-1 bg-gray-200 text-black rounded-md text-sm">${k.nama}</span>`
                    ).join('');

                    kategoriHTML = `
                    <p class="text-sm font-semibold text-gray-500">Kategori</p>
                    <div class="flex flex-wrap gap-2 mt-1">
                        ${isiKategori}
                    </div>
                `;
                }

                // Fasilitas
                let fasilitasHTML = '';

                if (fasilitas.length > 0) {
                    let isiFasilitas = fasilitas.map(f =>
                        `<span class="inline-block px-2 py-1 bg-gray-200 text-black rounded-md text-sm">${f.nama}</span>`
                    ).join('');

                    fasilitasHTML = `
                        <p class="text-sm font-semibold text-gray-500">Fasilitas</p>
                        <div class="flex flex-wrap gap-2 mt-1">
                            ${isiFasilitas}
                        </div>
                    `;
                }

                const url = new URL(window.location.href);
                url.searchParams.set('detail', id);
                history.pushState(null, '', url);

                document.getElementById('listKuliner').innerHTML = `
            <div class="bg-white rounded-2xl shadow-md p-5">

                <button onclick="backToList()" class="mb-4 text-black"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>
                        </button>

                <img src="${foto}" class="w-full h-56 object-cover rounded-xl mb-4">

                <h2 class="text-2xl font-bold">${nama}</h2>

                <p class="text-gray-600">${harga}</p>

                <p class="text-gray-600">${alamat}</p>


                <div class="mt-3">
                    ${kategoriHTML}
                </div>

                <div class="mt-3">
                    ${fasilitasHTML}
                </div>

                <div class="flex justify-end gap-2 mt-6">
                    <button onclick="handleFavorit(${id}, this)"
                        class="px-4 py-2 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="${isFavorit ? 'black' : 'none'}" stroke="${isFavorit ?'none' : 'currentColor'}" class="size-6">
                            <path d="M7.493 18.5c-.425 0-.82-.236-.975-.632A7.48 7.48 0 0 1 6 15.125c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75A.75.75 0 0 1 15 2a2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23h-.777ZM2.331 10.727a11.969 11.969 0 0 0-.831 4.398 12 12 0 0 0 .52 3.507C2.28 19.482 3.105 20 3.994 20H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 0 1-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227Z" />
                        </svg>
                    </button>

                    <button onclick="lihatRute(${lat}, ${lng})"
                        class="bg-blue-500 text-white px-4 py-2 rounded-xl">
                        Lihat Rute
                    </button>

                    <button onclick="editWisataKuliner(${id})"
                        class="bg-green-500 text-white px-4 py-2 rounded-xl">
                        Edit Wisata Kuliner
                    </button>
                </div>

                <hr class="my-4">

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
        `;

                loadUlasan(id);

                clearMarkers();

                const pin = new PinElement({
                    background: "#FB991A",
                    borderColor: "#ffffff",
                    glyphColor: "#ffffff"
                });

                let posisi = {
                    lat: lat,
                    lng: lng
                };

                let marker = new google.maps.marker.AdvancedMarkerElement({
                    position: posisi,
                    map: map,
                    title: nama,
                    content: pin,
                });

                markers.push(marker);

                map.setCenter(posisi);
                map.setZoom(16);

                let infoWindow = new google.maps.InfoWindow({
                    content: `
                            <div style="width:250px; font-family:sans-serif;">
                                <h3 style="margin:0 0 5px; font-size:16px;">
                                ${nama}
                                </h3>
                                <p style="margin:0 0 10px; color:#555;">
                                    ${alamat ?? '-'}
                                </p>
                            </div>  
                        `
                });

                marker.addEventListener("click", () => {
                    if (activeInfoWindow) {
                        activeInfoWindow.close();
                    }

                    infoWindow.open(map, marker);
                    activeInfoWindow = infoWindow;
                });
            });

        });

        function backToList() {
            const url = new URL(window.location.href);
            url.searchParams.delete('detail');
            history.pushState(null, '', url);
            location.reload()
        }

        // Card
        document.querySelectorAll('.card-kuliner').forEach(card => {
            let min = parseInt(card.dataset.min) || null;
            let max = parseInt(card.dataset.max) || null;

            let hargaEl = card.querySelector('.harga-text');
            if (hargaEl) {
                hargaEl.textContent = formatHarga(min, max);
            }
        });

        // Format Harga
        function formatHarga(min, max) {
            if (min && max) {
                return `Rp ${min.toLocaleString('id-ID')} - ${max.toLocaleString('id-ID')}`;
            } else if (min && !max) {
                return `Rp ${min.toLocaleString('id-ID')}+`;
            } else if (!min && max) {
                return `≤ Rp ${max.toLocaleString('id-ID')}`;
            }
            return '';
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

        function loadUlasan(idKuliner) {

            fetch(`/ulasan/${idKuliner}`)
                .then(res => res.json())
                .then(data => {

                    let html = ''
                    if (data.length === 0) {
                        html = `<p class="text-gray-500">Belum ada ulasan</p>`
                    } else {
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

        // Lihat rute
        function lihatRute(destLat, destLng) {
            if (!userLat || !userLng) {
                alert("Lokasi user belum tersedia");
                return;
            }

            let request = {
                origin: {
                    lat: userLat,
                    lng: userLng
                },
                destination: {
                    lat: destLat,
                    lng: destLng
                },
                travelMode: 'DRIVING'
            };

            directionsService.route(request, function(result, status) {
                if (status === 'OK') {
                    directionsRenderer.setDirections(result);
                } else {
                    alert("Gagal menampilkan rute");
                }
            });
        }

        // Edit Wisata Kuliner
        function editWisataKuliner(id) {

            // window.location.href = `/wisatawan/editwisatakuliner/${id}`;
            window.location.href =
                `/wisatawan/editwisatakuliner/${id}?from=` + encodeURIComponent(window.location.href);
        }

        // Favorit
        let kulinerAktif = null

        function handleFavorit(id, btn) {
            let isFavorit = favoritIds.includes(parseInt(id));

            if (isFavorit) {
                hapusFavorit(id, btn);
            } else {
                openModalFavorit(id);
            }
        }

        function openModalFavorit(id) {
            kulinerAktif = id
            document.getElementById('id_wisata_kuliner_favorit').value = id
            document.getElementById('modalFavorit').classList.remove('hidden')
            document.body.style.overflow = 'hidden'
        }

        function closeModalFavorit() {
            document.getElementById('modalFavorit').classList.add('hidden')
            document.body.style.overflow = ''
        }

        document.getElementById('formFavorit').addEventListener('submit', function(e) {
            e.preventDefault();

            let id = document.getElementById('id_wisata_kuliner_favorit').value;
            let komentar = document.getElementById('komentar').value;

            fetch("{{ route('favorit.simpan') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        id_wisata_kuliner_favorit: id,
                        komentar: komentar
                    })
                })
                .then(res => res.json())
                .then(data => {
                    let btn = document.querySelector(`button[onclick="handleFavorit(${id}, this)"]`);
                    if (btn) {
                        let svg = btn.querySelector('svg');
                        svg.setAttribute('fill', 'black');
                        svg.setAttribute('stroke', 'none');
                    }

                    favoritIds.push(parseInt(id));

                    closeModalFavorit();

                    document.getElementById('formFavorit').reset();

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Berhasil ditambahkan ke Kuliner Favorit',
                        timer: 1500,
                        showConfirmButton: false
                    });

                })
                .catch(err => {
                    console.error(err);

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Gagal menyimpan favorit'
                    });
                });
        });

        function hapusFavorit(id, btn) {
            fetch(`/favorit/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(res => res.json())
                .then(data => {
                    let svg = btn.querySelector('svg');

                    svg.setAttribute('fill', 'none');
                    svg.setAttribute('stroke', 'currentColor');

                    favoritIds = favoritIds.filter(f => f !== parseInt(id));

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Berhasil dihapus dari Kuliner Favorit',
                        showConfirmButton: false,
                        timer: 3000
                    });
                });
        }

        // Ulasan
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
    </script>
</body>

</html>
