<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIMAPKU | Wisata Kuliner</title>
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

        * {
            /* font-family: "Jost", sans-serif; */
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        :root {
            /* --blue-color: #357ded; */
            --yellow-color: #FFA319;
            --green-color: #004440;
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
                title: 'Berhasil',
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

    @if (session('info'))
        <script>
            Swal.fire({
                icon: 'info',
                title: 'Info',
                text: "{{ session('info') }}",
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    @if (session('swal'))
        <script>
            Swal.fire({
                icon: '{{ session('swal.icon') }}',
                title: '{{ session('swal.title') }}',
                text: '{{ session('swal.text') }}',
                timer: 2000,
                showConfirmButton: false,
            });
        </script>
    @endif

    {{-- @include('layouts.header-wisatawan') --}}
    @if (Auth::check())
        @include('layouts.sidebar-wisatawan')
    @else
        @include('layouts.sidebar-wisatawantidaklogin')
    @endif
    @include('wisatawan.pencarian.halaman-tambahulasan')

    <div class="pt-[38px] pl-[350px] pr-[50px] pb-[30px] overflow-y-auto min-h-screen">
        <div class="flex flex-col gap-2">
            {{-- <div>
                <p class="text-m text-black font-medium mt-2 mb-2 text-center">
                    Ingin memasukkan kuliner yang Anda ketahui?
                    <a href="{{ route('wisatakuliner.tambah') }}" class="text-[#FFA319]  hover:underline">
                        Tambah Kuliner
                    </a>
                </p>
            </div> --}}

            <!-- search bar -->
            {{-- <form id="formCari" action="{{ route('wisatakulinerhalaman') }}" method="GET">
                @csrf
                <div class="relative w-full flex justify-center mb-6">
                    <div class="w-full max-w-2xl z-20">
                        <div
                            class="flex items-center w-full max-w-2xl border rounded-full overflow-hidden shadow-sm font-medium bg-white">
                            <input type="text" name="keyword" placeholder="Cari Kuliner Disini..." autocomplete="off"
                                class="flex-1 px-5 py-3 focus:outline-none" id="searchBar"
                                value="{{ request('keyword') }}">
                            <button class="bg-[#FFA319] px-4 py-3 text-white hover:bg-[#F19305] transition">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>

                        <div id="searchPanel"
                            class="hidden absolute w-full max-w-2xl mt-2 bg-white rounded-2xl shadow-lg p-4 z-50">
                            <!-- Kuliner Terdekat -->
                            <div onclick="klikKulinerTerdekat()"
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
                                <input type="hidden" name="lat" id="lat" value="{{ request('lat') }}">
                                <input type="hidden" name="lng" id="lng" value="{{ request('lng') }}">

                                <div class="container">
                                    <label class="font-medium">Jarak</label>

                                    <div class="range-slider-jarak-dua flex justify-between items-center">
                                        <div class="flex items-center border rounded-lg overflow-hidden text-[15px]">
                                            <span class="bg-gray-200 px-3 py-2 text-gray-800">Km</span>
                                            <input type="number" name="jarak"
                                                class="nilai-jarak-dua w-[60px] p-2 outline-none border-0"
                                                value="{{ request('jarak', 10) }}" min="0" max="10" />
                                        </div>

                                        <!-- .range -->
                                        <div class="range-jarak-dua">
                                            <input type="range" class="input-jarak-dua"
                                                value="{{ request('jarak', 10) }}" min="0" max="10" />

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
                                            <option value="{{ $item->id_kategori }}"
                                                {{ in_array($item->id_kategori, request('kategori', [])) ? 'selected' : '' }}>
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
                                                class="min-price w-[95px] p-2 outline-none border-0"
                                                value="{{ request('minharga', 0) }}" min="0" max="500000"
                                                step="25000" />
                                        </div>

                                        <div class="flex items-center border rounded-lg overflow-hidden text-[15px]">
                                            <span class="bg-gray-200 px-3 py-2 text-gray-800">Rp</span>
                                            <input type="number" name="maxharga"
                                                class="max-price w-[95px] p-2 outline-none border-0"
                                                value="{{ request('maxharga', 500000) }}" min="0"
                                                max="1000000" step="25000" />
                                        </div>

                                        <!-- .range -->
                                        <div class="range">
                                            <input type="range" class="min-input"
                                                value="{{ request('minharga', 0) }}" min="0" max="500000"
                                                step="25000" />
                                            <input type="range" class="max-input"
                                                value="{{ request('maxharga', 500000) }}" min="0"
                                                max="500000" step="25000" />

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
                                            <option value="{{ $item->id_fasilitas }}"
                                                {{ in_array($item->id_fasilitas, request('fasilitas', [])) ? 'selected' : '' }}>
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
                                                class="min-rating w-[40px] p-2 outline-none border-0"
                                                value="{{ request('minrating', 0) }}" min="0"
                                                max="5" />
                                        </div>

                                        <div
                                            class="flex items-center text-center border rounded-lg overflow-hidden text-[15px]">
                                            <svg class="w-5 h-5 text-[#FFA319] star ml-2" fill="#FFA319"
                                                stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                            </svg>
                                            <input type="number" name="maxrating"
                                                class="max-rating w-[40px] p-2 outline-none border-0"
                                                value="{{ request('maxrating', 5) }}" min="0"
                                                max="5" />
                                        </div>

                                        <!-- .range -->
                                        <div class="range">
                                            <input type="range" class="min-input-rating"
                                                value="{{ request('minrating', 0) }}" min="0"
                                                max="5" />
                                            <input type="range" class="max-input-rating"
                                                value="{{ request('maxrating', 5) }}" min="0"
                                                max="5" />

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
            </form> --}}
            <form id="formCari" action="{{ route('wisatakulinerhalaman') }}" method="GET">
                {{-- @csrf --}}
                <input type="hidden" name="terdekat" id="inputTerdekat" value="0">
                <div class="relative w-full flex justify-center mb-6">
                    <div class="w-full max-w-2xl z-20">
                        <div
                            class="flex items-center w-full max-w-2xl border rounded-full overflow-hidden shadow-sm font-medium bg-white">
                            <input type="text" name="keyword" placeholder="Cari Kuliner Disini..." autocomplete="off"
                                class="flex-1 px-5 py-3 focus:outline-none" value="{{ request('keyword') }}"
                                id="searchBar">
                            <button type="submit" id="btnSearchKeyword"
                                class="bg-[#FFA319] px-4 py-3 text-white enabled:hover:bg-[#F19305] transition">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>

                        <div id="searchPanel"
                            class="hidden absolute w-full max-w-2xl mt-2 bg-white rounded-2xl shadow-lg p-4 z-50">
                            <!-- Kuliner Terdekat -->
                            <div onclick="klikKulinerTerdekat(event)"
                                class="p-3 rounded-xl bg-white shadow-md hover:bg-gray-100 cursor-pointer">
                                Kuliner Terdekat
                            </div>

                            <!-- Advanced Search -->
                            <div id="advancedBtn" class="flex gap-4 items-center p-3 rounded-xl cursor-pointer">
                                <span>Pencarian dengan Pengaturan Kriteria</span>
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
                                                value="{{ request('jarak', 20) }}" min="0" max="20" />
                                        </div>

                                        <!-- .range -->
                                        <div class="range-jarak-dua">
                                            <input type="range" class="input-jarak-dua"
                                                value="{{ request('jarak', 20) }}" min="0" max="20" />

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
                                            {{-- <option value="{{ $item->id_kategori }}">
                                                {{ $item->nama }}
                                            </option> --}}
                                            <option value="{{ $item->id_kategori }}" {{-- {{ in_array($item->id_kategori, request('kategori', [])) ? 'selected' : '' }}> --}}
                                                {{ in_array($item->id_kategori, (array) request('kategori', [])) ? 'selected' : '' }}>
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
                                                class="min-price w-[95px] p-2 outline-none border-0"
                                                value="{{ request('minharga', 0) }}" min="0" max="500000"
                                                step="25000" />
                                        </div>

                                        <div class="flex items-center border rounded-lg overflow-hidden text-[15px]">
                                            <span class="bg-gray-200 px-3 py-2 text-gray-800">Rp</span>
                                            <input type="number" name="maxharga"
                                                class="max-price w-[95px] p-2 outline-none border-0"
                                                value="{{ request('maxharga', 500000) }}" min="0"
                                                max="1000000" step="25000" />
                                        </div>

                                        <!-- .range -->
                                        <div class="range">
                                            <input type="range" class="min-input"
                                                value="{{ request('minharga', 0) }}" min="0" max="500000"
                                                step="25000" />
                                            <input type="range" class="max-input"
                                                value="{{ request('maxharga', 500000) }}" min="0"
                                                max="500000" step="25000" />

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
                                            {{-- <option value="{{ $item->id_fasilitas }}">
                                                {{ $item->nama }}
                                            </option> --}}
                                            <option value="{{ $item->id_fasilitas }}" {{-- {{ in_array($item->id_fasilitas, request('fasilitas', [])) ? 'selected' : '' }}> --}}
                                                {{ in_array($item->id_fasilitas, (array) request('fasilitas', [])) ? 'selected' : '' }}>
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
                                                class="min-rating w-[40px] p-2 outline-none border-0"
                                                value="{{ request('minrating', 0) }}" min="0"
                                                max="5" />
                                        </div>

                                        <div
                                            class="flex items-center text-center border rounded-lg overflow-hidden text-[15px]">
                                            <svg class="w-5 h-5 text-[#FFA319] star ml-2" fill="#FFA319"
                                                stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                            </svg>
                                            <input type="number" name="maxrating"
                                                class="max-rating w-[40px] p-2 outline-none border-0"
                                                value="{{ request('maxrating', 5) }}" min="0"
                                                max="5" />
                                        </div>

                                        <!-- .range -->
                                        <div class="range">
                                            <input type="range" class="min-input-rating"
                                                value="{{ request('minrating', 0) }}" min="0"
                                                max="5" />
                                            <input type="range" class="max-input-rating"
                                                value="{{ request('maxrating', 5) }}" min="0"
                                                max="5" />

                                            <div class="slider">
                                                <div class="progress-rating"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-span-2 border-t pt-4 mt-4">
                                    <label class="font-semibold block mb-3 text-center">
                                        Pengaturan Bobot Pencarian
                                    </label>
                                    <div class="bg-gray-50 rounded-2xl border ">
                                        <div class="grid grid-cols-5 gap-2 p-3 mb-3">

                                            <div class="flex flex-col items-center">
                                                <span class="text-sm font-medium mb-1">Jarak</span>
                                                <div
                                                    class="flex items-center border bg-white rounded-lg overflow-hidden shadow-sm w-full">
                                                    <input type="number" name="bobot_jarak"
                                                        class="input-bobot w-full p-2 text-center text-sm font-semibold outline-none"
                                                        value="{{ request('bobot_jarak', 40) }}" min="0"
                                                        max="100">
                                                    <span class="text-gray-400 text-xs pr-1">%</span>
                                                </div>
                                            </div>

                                            <div class="flex flex-col items-center">
                                                <span class="text-sm font-medium mb-1">Harga</span>
                                                <div
                                                    class="flex items-center border bg-white rounded-lg overflow-hidden shadow-sm w-full">
                                                    <input type="number" name="bobot_harga"
                                                        class="input-bobot w-full p-2 text-center text-sm font-semibold outline-none"
                                                        value="{{ request('bobot_harga', 20) }}" min="0"
                                                        max="100">
                                                    <span class="text-gray-400 text-xs pr-1">%</span>
                                                </div>
                                            </div>

                                            <div class="flex flex-col items-center">
                                                <span class="text-sm font-medium mb-1">Nilai Kuliner</span>
                                                <div
                                                    class="flex items-center border bg-white rounded-lg overflow-hidden shadow-sm w-full">
                                                    <input type="number" name="bobot_rating"
                                                        class="input-bobot w-full p-2 text-center text-sm font-semibold outline-none"
                                                        value="{{ request('bobot_rating', 25) }}" min="0"
                                                        max="100">
                                                    <span class="text-gray-400 text-xs pr-1">%</span>
                                                </div>
                                            </div>

                                            <div class="flex flex-col items-center">
                                                <span class="text-sm font-medium mb-1">Kategori</span>
                                                <div
                                                    class="flex items-center border bg-white rounded-lg overflow-hidden shadow-sm w-full">
                                                    <input type="number" name="bobot_kategori"
                                                        class="input-bobot w-full p-2 text-center text-sm font-semibold outline-none"
                                                        value="{{ request('bobot_kategori', 10) }}" min="0"
                                                        max="100">
                                                    <span class="text-gray-400 text-xs pr-1">%</span>
                                                </div>
                                            </div>

                                            <div class="flex flex-col items-center">
                                                <span class="text-sm font-medium mb-1">Fasilitas</span>
                                                <div
                                                    class="flex items-center border bg-white rounded-lg overflow-hidden shadow-sm w-full">
                                                    <input type="number" name="bobot_fasilitas"
                                                        class="input-bobot w-full p-2 text-center text-sm font-semibold outline-none"
                                                        value="{{ request('bobot_fasilitas') }}" min="0"
                                                        max="100">
                                                    <span class="text-gray-400 text-xs pr-1">%</span>
                                                </div>
                                            </div>


                                        </div>
                                        {{-- <div class="w-full  bg-white p-3 rounded-xl border shadow-sm"> --}}
                                        <div class="flex justify-between items-center px-3 mt-1 mb-3">
                                            <div class="flex items-center gap-2">
                                                <span class="text-sm font-medium text-gray-700">
                                                    Total Bobot:
                                                </span>
                                                <span id="labelTotalBobot" class="text-base font-bold">
                                                    100%
                                                </span>
                                            </div>

                                            <button type="submit" id="btnCariBobot"
                                                class="px-6 py-2 bg-[#FFA319] hover:bg-[#F19305]
                                                text-white font-semibold text-sm rounded-xl shadow-sm
                                                transition-all duration-200
                                                disabled:bg-gray-300 disabled:text-gray-500 disabled:cursor-not-allowed">
                                                Cari
                                            </button>
                                        </div>
                                    </div>
                                    {{-- </div> --}}


                                    {{-- <p id="pesanErrorBobot"
                                        class="text-red-500 text-xs font-semibold mt-2 text-center hidden">
                                        Total alokasi harus pas 100% sebelum mencari!
                                    </p> --}}
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
        <div class="grid grid-cols-12 gap-6 h-[calc(100vh-142px)] overflow-hidden">

            {{-- <div class="col-span-7">
                @foreach ($data as $kuliner)
                    <div class="p-4 border rounded-lg mb-3 bg-white shadow-sm">
                        <h2 class="text-lg font-bold">{{ $kuliner->nama }}</h2>
                    </div>
                @endforeach
            </div> --}}
            {{-- <div class="col-span-7 space-y-4"> --}}
            <div id="listKuliner" class="col-span-7 space-y-4 overflow-y-auto pr-2">
                @if ($isFallback)
                    <div class="text-center text-sm text-gray-500 mb-3">
                        Hasil tidak ditemukan untuk
                        <span class="font-semibold">"{{ $keyword }}"</span>.
                        Menampilkan rekomendasi kuliner yang mungkin Anda suka
                    </div>
                @endif
                {{-- @foreach ($data as $kuliner) --}}
                @forelse ($data as $kuliner)
                    {{-- <div
                        class="flex items-center justify-between bg-white rounded-2xl shadow-md p-4 hover:shadow-lg transition"> --}}
                    {{-- <div class="card-kuliner flex items-center justify-between bg-white rounded-2xl shadow-md p-4 hover:shadow-lg transition cursor-pointer"
                        data-lat="{{ $kuliner->latitude }}" data-lng="{{ $kuliner->longitude }}"> --}}

                    <div class="card-kuliner flex items-center justify-between bg-white rounded-2xl shadow-md p-4 hover:shadow-lg transition cursor-pointer"
                        data-id="{{ $kuliner->id_wisata_kuliner }}" data-nama="{{ $kuliner->nama }}"
                        data-alamat="{{ $kuliner->alamat }}" data-min="{{ $kuliner->harga_min }}"
                        data-max="{{ $kuliner->harga_max }}"
                        data-foto="{{ $kuliner->foto ? asset('storage/' . $kuliner->foto) : asset('storage/tidakadafoto.jpg') }}"
                        data-fasilitas='@json($kuliner->fasilitas)' data-kategori='@json($kuliner->kategori)'
                        data-lat="{{ $kuliner->latitude }}" data-lng="{{ $kuliner->longitude }}"
                        data-no_telp="{{ $kuliner->no_telp }}" data-email="{{ $kuliner->email }}"
                        data-deskripsi="{{ $kuliner->deskripsi }}"
                        data-status_operasional="{{ $kuliner->status_operasional }}"
                        data-sertifikat_halal="{{ $kuliner->sertifikat_halal }}">

                        <div class="flex gap-4 items-center flex-1">

                            <img src="{{ $kuliner->foto ? asset('storage/' . $kuliner->foto) : asset('storage/tidakadafoto.jpg') }}"
                                class="w-32 h-24 object-cover rounded-xl">

                            <div>
                                <h2 class="text-lg font-semibold">
                                    {{ $kuliner->nama }}
                                </h2>

                                <p class="text-gray-600 text-sm harga-text">
                                </p>

                                <p class="text-gray-600 text-sm">
                                    {{ $kuliner->alamat }}

                                </p>

                                {{-- <div>
                                    @if (isset($kuliner->score) && $kuliner->score > 0)
                                        <div
                                            class="bg-blue-50 border border-blue-200 rounded-lg px-2 py-1 inline-block text-right">
                                            <span
                                                class="text-[11px] text-blue-600 block font-medium leading-none mb-0.5">Kesesuaian</span>
                                            <span class="text-sm font-bold text-blue-700 leading-none">
                                                {{ round($kuliner->score * 100, 2) }}%
                                            </span>
                                        </div>
                                    @endif
                                </div> --}}
                                <div class="mt-4 flex flex-wrap gap-2">
                                    @foreach ($kuliner->kategori as $k)
                                        <span class="inline-block px-2 py-1 bg-gray-200 text-black rounded-md text-sm">
                                            {{ $k->nama }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>

                        </div>

                        <div class="text-right min-w-[120px]">
                            @if ($kuliner->penilaian)
                                @if (!($kuliner->harga_min && $kuliner->harga_max))
                                    <div class="flex items-center gap-1 justify-end -mt-14">
                                        <span class="text-orange-400"><svg xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                                <path fill-rule="evenodd"
                                                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                        <span class="font-semibold">
                                            {{ $kuliner->penilaian }}
                                        </span>
                                    </div>

                                    <p class="text-gray-500 text-sm mt-1 text-right">
                                        {{ number_format($kuliner->distance_km ?? $kuliner->haversine_distance, 1) }}
                                        km
                                    </p>
                                @else
                                    <div class="flex items-center gap-1 justify-end -mt-[66px]">
                                        <span class="text-orange-400"><svg xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                                <path fill-rule="evenodd"
                                                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                        <span class="font-semibold">
                                            {{ $kuliner->penilaian }}
                                        </span>
                                    </div>

                                    <p class="text-gray-500 text-sm mt-1 text-right">
                                        {{ number_format($kuliner->distance_km ?? $kuliner->haversine_distance, 1) }}
                                        km
                                    </p>
                                @endif
                            @else
                                <p class="text-gray-500 text-sm text-right -mt-[50px]">
                                    {{ number_format($kuliner->distance_km ?? $kuliner->haversine_distance, 1) }} km
                                </p>
                            @endif
                        </div>

                    </div>
                    {{-- @endforeach --}}
                @empty
                    <div class="col-span-7 -mt-5 flex items-center justify-center h-full">
                        <div class="text-center">
                            <p class="text-gray-800 text-lg font-semibold">
                                Mohon Maaf Wisata Kuliner Tidak Ditemukan
                            </p>
                            <p class="text-gray-600 text-sm mt-2">
                                Coba ubah keyword atau filter pencarian Anda
                            </p>
                        </div>
                    </div>
                @endforelse
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

        {{-- <div id="modalKomentar"
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
        </div> --}}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/multi-select-dropdown-js/MultiSelect.min.js"></script>

    <script>
        const isUserLoggedIn = {{ auth()->check() ? 'true' : 'false' }};

        function handleLogin() {
            if (!isUserLoggedIn) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Tidak Dapat Diakses',
                    text: 'Mohon maaf tidak dapat mengakses fitur ini. Silakan login terlebih dahulu',
                    showCancelButton: true,
                    confirmButtonColor: '#fb991a',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Login',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/login';
                    }
                });
                return false;
            }
            return true;
        }

        document.addEventListener("DOMContentLoaded", function() {
            const inputs = document.querySelectorAll(".input-bobot");
            const labelTotal = document.getElementById("labelTotalBobot");
            const pesanError = document.getElementById("pesanErrorBobot");
            const btnCari = document.getElementById("btnCariBobot");
            const formCari = document.getElementById("formCari");

            function updateBobotLimits() {
                let totalSekarang = 0;

                inputs.forEach(input => {
                    if (input.value.length > 1 && input.value.startsWith('0')) {
                        input.value = parseInt(input.value) || 0;
                    }

                    let val = parseInt(input.value);
                    if (isNaN(val) || val < 0) {
                        input.value = 0;
                    }
                });

                inputs.forEach(input => {
                    totalSekarang += parseInt(input.value) || 0;
                });

                if (totalSekarang > 100) {
                    const activeInput = document.activeElement;
                    if (activeInput && activeInput.classList.contains('input-bobot')) {
                        let totalLain = 0;
                        inputs.forEach(input => {
                            if (input !== activeInput) totalLain += parseInt(input.value) || 0;
                        });
                        activeInput.value = 100 - totalLain;
                    }

                    totalSekarang = 0;
                    inputs.forEach(input => {
                        totalSekarang += parseInt(input.value) || 0;
                    });
                }

                labelTotal.textContent = totalSekarang + "%";

                if (totalSekarang === 100) {
                    // labelTotal.className = "text-base font-bold text-green-600";
                    // pesanError.classList.add("hidden");

                    if (btnCari) btnCari.disabled = false;
                } else {
                    // labelTotal.className = "text-base font-bold text-red-500";

                    if (btnCari) btnCari.disabled = true;
                }

                inputs.forEach(input => {
                    const nilaiInputIni = parseInt(input.value) || 0;
                    let sisaKuota = 100 - (totalSekarang - nilaiInputIni);
                    if (sisaKuota < 0) sisaKuota = 0;
                    input.max = sisaKuota;
                    if (totalSekarang >= 100 && nilaiInputIni === 0) {
                        input.max = 0;
                    }
                });
            }

            inputs.forEach(input => {
                input.addEventListener("input", updateBobotLimits);

                input.addEventListener("focus", function() {
                    this.select();
                });
            });

            if (formCari) {
                formCari.addEventListener("submit", function(e) {
                    let totalAkhir = 0;
                    inputs.forEach(input => {
                        totalAkhir += parseInt(input.value) || 0;
                    });

                    if (totalAkhir !== 100) {
                        e.preventDefault();

                        pesanError.textContent =
                            `Total bobot harus tepat 100%`;
                        pesanError.classList.remove("hidden");

                        pesanError.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }
                });
            }

            updateBobotLimits();
        });

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

            const range = maxInput.max - minInput.min;
            const valueRange = maxValue - minValue;
            const width = (valueRange / range) * 100;
            const minOffset = ((minValue - minInput.min) / range) * 100;

            progress.style.width = width + "%";
            progress.style.left = minOffset + "%";
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
            e.preventDefault();
            isDragging = true;

            startOffsetX = e.clientX - progress.getBoundingClientRect().left;

            slider.classList.toggle("dragging", isDragging);
        });

        document.addEventListener("mousemove", (e) => {
            if (isDragging) {
                const sliderRect = slider.getBoundingClientRect();
                const progressWidth = parseFloat(progress.style.width || 0);

                let newLeft =
                    ((e.clientX - sliderRect.left - startOffsetX) / sliderRect.width) * 100;

                newLeft = Math.min(Math.max(newLeft, 0), 100 - progressWidth);

                progress.style.left = newLeft + "%";

                const range = maxInput.max - minInput.min;
                const newMin = Math.round((newLeft / 100) * range) + parseInt(minInput.min);
                const newMax = newMin + parseInt(maxInput.value) - parseInt(minInput.value);

                minInput.value = newMin;
                maxInput.value = newMax;

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
            // const hamburger = document.getElementById('hamburger');
            // const sidebar = document.querySelector('.sidebar');

            // if (!hamburger || !sidebar) return;

            // hamburger.addEventListener('click', () => {
            //     sidebar.classList.toggle('expanded');
            // });

            const params = new URLSearchParams(window.location.search);
            const detailId = params.get('detail');

            if (detailId) {
                klikDetail(detailId);
            }
        });

        function klikDetail(id) {
            let card = document.querySelector(`.card-kuliner[data-id="${id}"]`);

            console.log("DETAIL", id);
            console.log("CARD", card);
            if (card) card.click();
        }
        // function klikDetail(id) {
        //     let card = document.querySelector(`.card-kuliner[data-id="${id}"]`);

        //     // if (!card) return;

        //     if (card) card.click();

        //     const latwk = parseFloat(card.dataset.lat);
        //     const lngwk = parseFloat(card.dataset.lng);

        //     if (!userLat || !userLng) {
        //         alert("Lokasi Wisatawan Belum Tersedia");
        //         return;
        //     }

        //     directionsRenderer.setDirections({
        //         routes: []
        //     });

        //     if (routePolyline) {
        //         routePolyline.setMap(null);
        //         routePolyline = null;
        //     }

        //     let request = {
        //         origin: {
        //             lat: userLat,
        //             lng: userLng
        //         },
        //         destination: {
        //             lat: latwk,
        //             lng: lngwk
        //         },
        //         travelMode: 'DRIVING'
        //     };

        //     directionsService.route(request, function(result, status) {
        //         if (status === 'OK') {

        //             directionsRenderer.setDirections(result);

        //             const route = result.routes[0].overview_path;
        //             const lastPoint = route[route.length - 1];

        //             routePolyline = new google.maps.Polyline({
        //                 path: [
        //                     lastPoint,
        //                     {
        //                         lat: latwk,
        //                         lng: lngwk
        //                     }
        //                 ],
        //                 geodesic: true,
        //                 strokeColor: "#4285F4",
        //                 strokeOpacity: 1.0,
        //                 strokeWeight: 4,
        //                 map: map
        //             });

        //             routeVisible = true;
        //         } else {
        //             alert("Gagal Menampilkan Rute");
        //         }
        //     });
        // }

        const btnSearchKeyword = document.getElementById("btnSearchKeyword");
        const searchBar = document.getElementById("searchBar");
        const searchPanel = document.getElementById("searchPanel");

        function updateKeywordButton() {

            const keyword = searchBar.value.trim();

            if (keyword !== '') {

                btnSearchKeyword.disabled = false;

                btnSearchKeyword.classList.remove(
                    'cursor-not-allowed'
                );

                btnSearchKeyword.classList.add(
                    'cursor-pointer'
                );

            } else {

                btnSearchKeyword.disabled = true;

                btnSearchKeyword.classList.remove(
                    'cursor-pointer'
                );

                btnSearchKeyword.classList.add(
                    'cursor-not-allowed'
                );
            }
        }

        searchBar.addEventListener(
            'input',
            updateKeywordButton
        );

        updateKeywordButton();

        const keyword =
            searchBar.value.trim();

        searchBar.addEventListener("click", () => {
            searchPanel.classList.toggle("hidden");
        });

        const advancedBtn = document.getElementById("advancedBtn");
        const advancedFilter = document.getElementById("advancedFilter");

        advancedBtn.addEventListener("click", () => {
            advancedFilter.classList.toggle("hidden");
        });

        // const defaultText = 'Rekomendasi Kuliner';
        // searchBar.addEventListener('blur', function() {
        //     if (this.value.trim() === '') {
        //         this.value = defaultText;
        //     }
        // });

        document.addEventListener("click", function(e) {

            if (!searchBar.contains(e.target) && !searchPanel.contains(e.target)) {
                searchPanel.classList.add("hidden");
            }

        });

        // MAPS --------------------------------------------------------------------------------
        let defaultLat = -6.969293174776291;
        let defaultLng = 110.42436387257949;

        let map;
        let userMarker = null;
        let markers = [];
        let userLat = defaultLat;
        let userLng = defaultLng;

        let directionsService;
        let directionsRenderer;
        let routeVisible = false;
        let routePolyline = null;

        let dataKuliner = @json($data);
        let activeInfoWindow = null;

        async function initApp() {
            let defaultLocation = {
                lat: -6.969293174776291,
                lng: 110.42436387257949
            };

            const markerLib = await google.maps.importLibrary("marker");
            AdvancedMarkerElement = markerLib.AdvancedMarkerElement;
            PinElement = markerLib.PinElement;

            map = new google.maps.Map(document.getElementById("map"), {
                center: defaultLocation,
                zoom: 10,
                mapId: "b434fd3b6bf402cdbbb8f248",
                clickableIcons: false,
            });

            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer({
                suppressMarkers: true
            });
            directionsRenderer.setMap(map);

            tampilkanSemuaKuliner();

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(success, error);
            } else {
                updateUserLocation(defaultLat, defaultLng);
            };
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
            // console.log("ERROR:", err.message);
            // alert("Gagal ambil lokasi: " + err.message);
            updateUserLocation(defaultLat, defaultLng);
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
                        borderColor: "#FFFFFF",
                        glyphColor: "#FFFFFF"
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

        let favoritIds = @json($favoritIds);
        document.querySelectorAll('.card-kuliner').forEach(card => {

            card.addEventListener('click', function() {

                let nama = this.dataset.nama;
                let alamat = this.dataset.alamat;
                let no_telp = this.dataset.no_telp;
                let email = this.dataset.email;
                let penilaian = this.dataset.penilaian;
                let deskripsi = this.dataset.deskripsi;
                let status_operasional = this.dataset.status_operasional;
                let sertifikat_halal = this.dataset.sertifikat_halal;

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

                let statusHTML = '';

                if (status_operasional === 'Tutup Sementara') {
                    statusHTML = `
                        <div class="inline-flex items-center gap-2 px-3 py-1 bg-[#FFA319] text-white rounded-full text-sm mt-2">
                            <i class="fi fi-rs-triangle-warning relative top-[2px]"></i>
                            <span>Tutup Sementara</span>
                        </div>
                    `;
                } else if (status_operasional === 'Tutup Permanen') {
                    statusHTML = `
                        <div class="inline-flex items-center gap-2 px-3 py-1 bg-red-600 text-white rounded-full text-sm mt-2">
                            <i class="fi fi-rs-triangle-warning relative top-[2px]"></i>
                            <span>Tutup Permanen</span>
                        </div>
                    `;
                }

                // let halalHTML = '';

                // if (sertifikat_halal === 'Sudah') {
                //     halalHTML = `
            //         <div class="inline-flex items-center gap-2 px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm mt-2">
            //             <i class="fi fi-rs-check-circle"></i>
            //             <span>Bersertifikat Halal</span>
            //         </div>
            //     `;
                // }
                let halalHTML = '';

                if (sertifikat_halal === 'Sudah') {
                    halalHTML =

                        `<div class="flex items-center gap-2 text-sm text-green-700 mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <span>Halal</span>
                        </div>`;
                }
                // let kontakHTML = '';


                // if (no_telp || email) {
                //     let isiKontak = '';

                //     if (no_telp) {
                //         isiKontak += `
            //             <div class="flex items-center gap-2 text-sm text-gray-700">
            //                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
            //                     <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.110-.902.055-1.173.417l-.970 1.293c-.282.376-.769.542-1.210.380a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.380-1.210l1.293-.970c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
            //                 </svg>
            //                 <span>${no_telp}</span>
            //             </div>
            //         `;
                //     }

                //     if (email) {
                //         isiKontak += `
            //             <div class="flex items-center gap-2 text-sm text-gray-700">
            //                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
            //                     <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.070 1.916l-7.500 4.615a2.25 2.25 0 0 1-2.360 0L3.320 8.91a2.25 2.25 0 0 1-1.070-1.916V6.75" />
            //                 </svg>
            //                 <span>${email}</span>
            //             </div>
            //         `;
                //     }

                //     kontakHTML = `
            //         <div class="flex flex-col gap-2 mt-1">
            //             ${isiKontak}
            //         </div>
            //     `;
                // }
                let hargaHTML = '';
                let notelpHTML = '';
                let emailHTML = '';

                if (harga) {
                    hargaHTML = `<div class="flex items-center gap-2 text-sm text-gray-700 mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                            </svg>
                            <span>${harga}</span>
                        </div>`;
                }

                if (no_telp) {
                    notelpHTML = `<div class="flex items-center gap-2 text-sm text-gray-700 mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.110-.902.055-1.173.417l-.970 1.293c-.282.376-.769.542-1.210.380a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.380-1.210l1.293-.970c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                            </svg>
                            <span>${no_telp}</span>
                        </div>`;
                }

                if (email) {
                    emailHTML = `<div class="flex items-center gap-2 text-sm text-gray-700 mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.070 1.916l-7.500 4.615a2.25 2.25 0 0 1-2.360 0L3.320 8.91a2.25 2.25 0 0 1-1.070-1.916V6.75" />
                            </svg>
                            <span>${email}</span>
                        </div>`;
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

                <h2 class="flex text-2xl font-bold justify-normal">${nama}</h2>

                <p class="flex gap-2 text-gray-700 justify-normal">${deskripsi}</p>

                <p class="flex gap-2 text-gray-700 justify-normal">${statusHTML}</p>


                <div class="mt-4">  
                    <div class="flex items-center gap-2 text-sm text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        <span>${alamat}</span>
                    </div>

                    ${hargaHTML}
                    ${notelpHTML}
                    ${emailHTML}
                    ${halalHTML}
                </div>  
                <div class="mt-2">
                    ${kategoriHTML}
                </div>

                <div class="mt-2">
                    ${fasilitasHTML}
                </div>

                <div class="flex justify-end gap-2 mt-6">
                    <button title="Favorit" onclick="${isUserLoggedIn ? `klikFavorit(${id}, this)` : 'handleLogin()'}"
                        class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-200 transition">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="${isFavorit ? 'black' : 'none'}"
                            stroke="${isFavorit ? 'none' : 'currentColor'}"
                            class="w-6 h-6">
                            <path d="M7.493 18.5c-.425 0-.82-.236-.975-.632A7.48 7.48 0 0 1 6 15.125c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75A.75.75 0 0 1 15 2a2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23h-.777ZM2.331 10.727a11.969 11.969 0 0 0-.831 4.398 12 12 0 0 0 .52 3.507C2.28 19.482 3.105 20 3.994 20H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 0 1-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227Z" />
                        </svg>
                    </button>

                    <button title="Edit" onclick="${isUserLoggedIn ? `klikEdit(${id})` : 'handleLogin()'}"
                        class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-200 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                        </svg>

                        
                    </button>
                </div>

                <hr class="my-4">

                <button onclick="${isUserLoggedIn ? `klikUlasan(${id})` : 'handleLogin()'}"
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
                    borderColor: "#FFFFFF",
                    glyphColor: "#FFFFFF"
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

                if (userLat && userLng) {

                    directionsRenderer.setDirections({
                        routes: []
                    });

                    if (routePolyline) {
                        routePolyline.setMap(null);
                        routePolyline = null;
                    }

                    directionsService.route({
                        origin: {
                            lat: userLat,
                            lng: userLng
                        },
                        destination: posisi,
                        travelMode: google.maps.TravelMode.DRIVING
                    }, function(result, status) {

                        if (status === "OK") {

                            directionsRenderer.setDirections(result);

                            const route = result.routes[0].overview_path;
                            const lastPoint = route[route.length - 1];

                            routePolyline = new google.maps.Polyline({
                                path: [
                                    lastPoint,
                                    posisi
                                ],
                                geodesic: true,
                                strokeColor: "#4285F4",
                                strokeOpacity: 1,
                                strokeWeight: 4,
                                map: map
                            });

                            routeVisible = true;
                        } else {
                            console.log(status);
                        }
                    });
                }

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
                if (min == 0) {
                    if (max == 0) {
                        return '';
                    } else {
                        return `≤ Rp ${max.toLocaleString('id-ID')}`;
                    }
                } else {
                    if (min == 500000) {
                        return `Rp ${min.toLocaleString('id-ID')}+`;
                    } else {
                        return `Rp ${min.toLocaleString('id-ID')} - ${max.toLocaleString('id-ID')}`;
                    }
                }
            }

            // let min = data.harga_min ?? 0;
            // let max = data.harga_max ?? 0;

            // let text = '';

            // if (((min && max) != 0) && ((min && max) != 500000)) {
            //     text = `Rp ${min.toLocaleString('id-ID')} - ${max.toLocaleString('id-ID')}`;
            // } else {
            //     if (min == 0) {
            //         if (max != 0) {
            //             text = `≤ Rp ${max.toLocaleString('id-ID')}`;
            //         } else {
            //             text = '-';
            //         }
            //     } else {
            //         text = `Rp ${min.toLocaleString('id-ID')}+`;
            //     }
            // }
        }

        function loadUlasan(idKuliner) {

            fetch(`/wisatawan/ulasan/detail/${idKuliner}`)
                .then(res => res.json())
                .then(data => {
                    let html = ''
                    if (data.length === 0) {
                        html = `<p class="text-gray-500 mt-5 text-center">Ulasan Belum Tersedia</p>`
                    } else {
                        data.forEach(item => {

                            let menuHapus = '';
                            console.log(item.punya_sendiri);
                            console.log(typeof item.punya_sendiri);
                            if (item.punya_sendiri) {
                                menuHapus = `
                                    <div class="relative">
                                        <button onclick="klikHapus(${item.id_ulasan})"
                                            class="p-1 rounded-full text-red-600 hover:bg-red-100 hover:text-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.7" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </div>
                                `;
                            }

                            let namaUser = item.punya_sendiri ?
                                'Anda' :
                                (item.nama);

                            let fotoUlasan = '';

                            if (item.foto_ulasan) {
                                fotoUlasan = `
                            <img src="/storage/${item.foto_ulasan}" 
                                 class="mt-2 w-40 h-40 object-cover rounded-md border">
                        `;
                            }

                            //         html += `
                        //     <div class="border-b py-3">
                        //         <div class="font-semibold">${namaUser}</div>

                        //         <div class="flex items-center gap-1">
                        //             <span class="text-orange-400"><svg xmlns="http://www.w3.org/2000/svg"
                        //                     viewBox="0 0 24 24" fill="currentColor" class="size-4">
                        //                     <path fill-rule="evenodd"
                        //                         d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                        //                         clip-rule="evenodd" />
                        //                 </svg>
                        //             </span>
                        //             <span class="font-semibold">
                        //                 ${item.penilaian}
                        //             </span>
                        //         </div>

                        //         <div class="text-gray-600 text-sm">
                        //             ${item.ulasan}
                        //         </div>

                        //         ${fotoUlasan}
                        //     </div>
                        // `
                            html += `
                            <div class="border-b py-4 flex gap-3">


                                <!-- Konten -->
                                <div class="flex-1">
                                    <div class="flex justify-between items-start text-sm">
                                        <div class="flex items-center gap-2">
                                            <span class="font-semibold">${namaUser}</span>
                                            <span class="text-gray-700">•</span>
                                            <span class="text-gray-700">${formatTanggal(item.waktu_dibuat)}</span>
                                        </div>
                                        ${menuHapus}
                                    </div>

                                    <!-- Rating -->
                                    <div class="text-yellow-500 text-sm flex items-center gap-1">
                                        <span class="text-orange-400"><svg xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                                <path fill-rule="evenodd"
                                                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                        <span class="font-semibold">
                                            ${item.penilaian}
                                        </span>
                                    </div>

                                    <!-- Ulasan -->
                                    <div class="text-gray-600 text-sm mt-1">
                                        ${item.ulasan}
                                    </div>

                                    <!-- Foto -->
                                    ${fotoUlasan}

                                </div>
                            </div>
                        `;
                        })
                    }
                    document.getElementById('ulasanArea').innerHTML = html

                })

        }

        function toggleMenu(id) {
            document.getElementById(`menu-${id}`).classList.toggle('hidden');
        }

        function klikHapus(id) {

            Swal.fire({
                title: 'Hapus Ulasan?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
            }).then((result) => {

                if (result.isConfirmed) {

                    fetch(`/wisatawan/ulasan/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]'
                                ).content,
                                'Accept': 'application/json'
                            }
                        })
                        .then(res => res.json())
                        .then(data => {

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: data.message,
                                timer: 2000,
                                showConfirmButton: false,
                            });

                        }).then(() => {
                            // loadUlasan(idKulinerAktif);
                            location.reload();
                        });
                }

            });

        }

        // function tampilkanRute(latwk, lngwk) {
        //     const icon = btn.querySelector('i');
        //     if (routeVisible) {

        //         directionsRenderer.setDirections({
        //             routes: []
        //         });

        //         if (routePolyline) {
        //             routePolyline.setMap(null);
        //             routePolyline = null;
        //         }

        //         btn.classList.remove('bg-blue-100');
        //         icon.className = 'fi fi-rs-route text-md';
        //         // icon.style.color = '#6b7280';

        //         routeVisible = false;
        //         return;
        //     }

        //     if (!userLat || !userLng) {
        //         alert("Lokasi user belum tersedia");
        //         return;
        //     }

        //     let request = {
        //         origin: {
        //             lat: userLat,
        //             lng: userLng
        //         },
        //         destination: {
        //             lat: latwk,
        //             lng: lngwk
        //         },
        //         travelMode: 'DRIVING'
        //     };

        //     directionsService.route(request, function(result, status) {
        //         if (status === 'OK') {
        //             directionsRenderer.setDirections(result);

        //             const route = result.routes[0].overview_path;
        //             const lastPoint = route[route.length - 1];
        //             routePolyline = new google.maps.Polyline({
        //                 path: [
        //                     lastPoint,
        //                     {
        //                         lat: latwk,
        //                         lng: lngwk
        //                     }
        //                 ],
        //                 geodesic: true,
        //                 strokeColor: "#4285F4",
        //                 strokeOpacity: 1.0,
        //                 strokeWeight: 4,
        //                 map: map
        //             });

        //             icon.className = 'fi fi-bs-route text-md';
        //             // icon.style.color = '#fb991a';
        //             routeVisible = true;
        //         } else {
        //             alert("Gagal menampilkan rute");
        //         }
        //     });
        // }

        // const btnRute = document.getElementById('btnRute');

        // if (routeVisible) {
        //     btnRute.classList.add('bg-blue-100');
        // } else {
        //     btnRute.classList.remove('bg-blue-100');
        // }

        function formatTanggal(tanggal) {
            if (!tanggal) return '';

            // Ambil hanya bagian tanggal sebelum 'T'
            const datePart = tanggal.split('T')[0];
            const [year, month, day] = datePart.split('-').map(Number);

            return new Date(year, month - 1, day).toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
        }

        // Edit Wisata Kuliner
        function klikEdit(id) {

            // window.location.href = `/wisatawan/editwisatakuliner/${id}`;
            window.location.href =
                `/wisatawan/editwisatakuliner/${id}?from=` + encodeURIComponent(window.location.href);
        }

        function klikUlasan(id) {
            kulinerAktif = id
            document.getElementById('id_wisata_kuliner').value = id
            fetch(`/wisatawan/ulasan/modalulasan/${id}`)
                .then(res => res.json())
                .then(data => {

                    if (data && data.id_ulasan) {
                        document.getElementById('ulasan').value = data.ulasan;
                        document.getElementById('penilaian').value = data.penilaian;

                        document.querySelector('.min-price-hargaulasan').value =
                            data.harga_min ?? 0;

                        document.querySelector('.max-price-hargaulasan').value =
                            data.harga_max ?? 500000;

                        document.querySelector('.min-input-hargaulasan').value =
                            data.harga_min ?? 0;

                        document.querySelector('.max-input-hargaulasan').value =
                            data.harga_max ?? 500000;

                        updateProgressHargaulasan();
                        // document.getElementById('harga_per_orang').value =
                        //     data.harga_min + "-" + data.harga_max;
                        const statusBox = document.getElementById('statusUlasan');
                        const submitBtn = document.querySelector(
                            '#formUlasan button[type="submit"]'
                        );

                        // statusBox.classList.add('hidden');
                        // document.getElementById('ulasan').readOnly = false;
                        // submitBtn.classList.remove('hidden');
                        statusBox.classList.add('hidden');
                        setReadonlyUlasan(false);

                        setRatingStars(data.penilaian);

                        if (data.status === 'Belum Diverifikasi') {

                            statusBox.classList.remove('hidden');
                            statusBox.className =
                                'mb-4 rounded-lg p-3 bg-yellow-100 text-yellow-700';

                            statusBox.innerHTML =
                                'Ulasan sedang menunggu verifikasi admin';

                            // document.getElementById('ulasan').readOnly = true;
                            setReadonlyUlasan(true);
                        } else if (data.status === 'Ditolak') {

                            statusBox.classList.remove('hidden');
                            statusBox.className =
                                'mb-4 rounded-lg p-3 bg-red-100 text-red-700';

                            statusBox.innerHTML =
                                'Ulasan ditolak. Silakan perbaiki dan kirim ulang.';
                        } else if (data.status === 'Disetujui') {

                            statusBox.classList.remove('hidden');
                            statusBox.className =
                                'mb-4 rounded-lg p-3 bg-green-100 text-green-700';

                            statusBox.innerHTML =
                                'Ulasan telah disetujui.';
                        }

                        if (data.foto_ulasan) {
                            document.getElementById('previewWrapper').classList.remove('hidden');
                            document.getElementById('fotoPreview').src = `/storage/${data.foto_ulasan}`;
                        }
                    } else {
                        document.getElementById('formUlasan').reset();
                        setRatingStars(0);
                    }

                })
                .catch(err => {
                    console.error('Tidak dapat mengambil ulasan:', err);
                });
            document.getElementById('modalUlasan').classList.remove('hidden')
            document.body.style.overflow = 'hidden'
        }

        // Favorit
        let kulinerAktif = null

        function klikFavorit(id, btn) {
            let isFavorit = favoritIds.includes(parseInt(id));

            if (isFavorit) {
                hapusFavorit(id, btn);
            } else {
                // openModalFavorit(id);
                simpanFavorit(id, btn);
            }
        }

        function simpanFavorit(id, btn) {
            fetch(`/wisatawan/favorit/simpan/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        id_wisata_kuliner: id,
                    })
                })
                .then(res => res.json())
                .then(data => {
                    let svg = btn.querySelector('svg');

                    svg.setAttribute('fill', 'black');
                    svg.setAttribute('stroke', 'none');

                    // favoritIds = favoritIds.filter(f => f !== parseInt(id));
                    favoritIds.push(parseInt(id));

                    Swal.fire({
                        icon: data.status,
                        title: data.title,
                        text: data.text,
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
        }

        function hapusFavorit(id, btn) {
            fetch(`/wisatawan/favorit/hapus/${id}`, {
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
                    // favoritIds.push(parseInt(id));

                    Swal.fire({
                        icon: data.status,
                        title: data.title,
                        text: data.text,
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
        }

        document.getElementById("formCari").addEventListener("submit", function(e) {
            // if (searchBar.value.trim() === '') {
            //     searchBar.value = defaultText;
            // }
            e.preventDefault();

            const keyword = document.querySelector("input[name='keyword']").value.toLowerCase();

            // const isTerdekat =
            //     keyword.includes("terdekat") ||
            //     keyword.includes("dekat") ||
            //     keyword.includes("near");

            // if (isTerdekat) {

            //     if (!navigator.geolocation) {
            //         Swal.fire({
            //             icon: "error",
            //             title: "GPS tidak tersedia",
            //             text: "Silakan lakukan pencarian dengan keyword selain 'dekat' dan 'terdekat'",
            //             showConfirmButton: false,
            //             timer: 2000
            //         });
            //         return;
            //     }

            //     navigator.geolocation.getCurrentPosition(
            //         function(position) {
            //             const lat = position.coords.latitude;
            //             const lng = position.coords.longitude;

            //             inputJarakDua.value = 5;
            //             nilaiJarakDua.value = 5;
            //             updateProgressJarakDua();

            //             minInput.value = 0;
            //             maxInput.value = 500000;
            //             minPriceInput.value = 0;
            //             maxPriceInput.value = 500000;
            //             updateProgress();

            //             const minRating = document.querySelector(".min-rating");
            //             const maxRating = document.querySelector(".max-rating");

            //             if (minRating && maxRating) {
            //                 minRating.value = 0;
            //                 maxRating.value = 5;
            //             }

            //             document.getElementById("lat").value = lat;
            //             document.getElementById("lng").value = lng;

            //             e.target.submit();
            //         },

            //         function() {
            //             Swal.fire({
            //                 icon: "warning",
            //                 title: 'Lokasi Tidak Tersedia',
            //                 text: 'Silakan nyalakan GPS untuk mencari kuliner terdekat atau cari kuliner dengan keyword yang berbeda',
            //                 showConfirmButton: false,
            //                 timer: 2000
            //             });
            //         }
            //     );

            //     return;
            // }

            navigator.geolocation.getCurrentPosition(
                function(position) {
                    document.getElementById("lat").value = position.coords.latitude;
                    document.getElementById("lng").value = position.coords.longitude;
                    e.target.submit();
                },
                function() {
                    document.getElementById("lat").value = -6.969293174776291;
                    document.getElementById("lng").value = 110.42436387257949;
                    e.target.submit();
                }
            );
        });

        function klikKulinerTerdekat() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;

                    // inputJarakDua.value = 5;
                    // nilaiJarakDua.value = 5;
                    // updateProgressJarakDua();

                    // minInput.value = 0;
                    // maxInput.value = 500000;
                    // minPriceInput.value = 0;
                    // maxPriceInput.value = 500000;
                    // updateProgress();

                    // const minRating = document.querySelector(".min-rating");
                    // const maxRating = document.querySelector(".max-rating");

                    // if (minRating && maxRating) {
                    //     minRating.value = 0;
                    //     maxRating.value = 5;
                    // }
                    // document.getElementById('inputLat').value = lat;
                    // document.getElementById('inputLng').value = lng;
                    document.getElementById('lat').value = lat;
                    document.getElementById('lng').value = lng;

                    // 2. Set input terdekat menjadi 1
                    document.getElementById('inputTerdekat').value = 1;

                    // 3. Submit form secara otomatis
                    document.getElementById('formCari').submit();
                    // document.getElementById('inputTerdekat').value = 1;

                    // const params = new URLSearchParams(window.location.search);

                    // params.set('terdekat', 1);

                    // params.set("lat", lat);
                    // params.set("lng", lng);

                    // params.set("jarak", 5);
                    // params.set("minharga", 0);
                    // params.set("maxharga", 500000);
                    // params.set("minrating", 0);
                    // params.set("maxrating", 5);
                    // params.set("keyword", "Kuliner Terdekat");

                    window.location.href =
                        window.location.pathname + "?" + params.toString();
                }, function(error) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Lokasi Tidak Tersedia',
                        text: 'Silakan nyalakan GPS Anda untuk mencari kuliner terdekat',
                        showConfirmButton: false,
                        timer: 2000
                    });
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Browser Anda tidak mendukung fitur lokasi',
                    confirmButtonText: 'OK'
                });
            }
        }



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

        //     let response = await fetch("{{ route('ulasan.simpan') }}", {
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
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1G3FTNQXli1ZHjZNQNIpzOl_AcGNHctU&callback=initApp&libraries=maps,marker&v=weekly&language=in"
        async defer></script>

</body>

</html>
