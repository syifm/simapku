<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAPKU | Beranda</title>
    <link rel="icon" type="image/png" href="{{ asset('simapku.png') }}">
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/multi-select-dropdown-js/MultiSelect.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        * {
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
            /* background: #fff; */
            /* padding: 30px; */
            border-radius: 10px;
            /* width: min(480px, 90%); */
            /* box-shadow: 0 5px 10px rgba(0, 0, 0, 0.25); */
        }

        /* .container h3 {
            font-size: 2rem;
        } */

        /* range slider styles */

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
            /* font-size: 1.5rem; */
            font-size: 15px;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            width: 115px;
            /* min-width: 64px; */
        }

        .range-rating {
            width: 100%;
            /* width: 60%; */
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

        /* INI NGGAK DIPAKE ------------------------------------------------------------------- */
        .range-slider-jarak {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            justify-content: space-between;
            /* gap: 20px; */
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
            /* font-size: 1.5rem; */
            font-size: 15px;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            width: 115px;
            /* min-width: 64px; */
        }

        .range-jarak {
            width: 100%;
            /* width: 60%; */
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

        /* INI NGGAK DIPAKE ------------------------------------------------------------------- */





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

        .kategori-btn {
            background: white;
            border: 1px solid #e5e7eb;
            font-weight: 600;
            transition: .2s;
        }

        .kategori-btn:hover {
            background: #FFA319;
            color: white;
        }
    </style>

</head>

{{-- <script>
    function toggleDropdown(id) {
        document.querySelectorAll('[id^="dropdown"]').forEach(el => {
            if (el.id !== id) {
                el.classList.add('hidden');
            }
        });

        document.getElementById(id).classList.toggle('hidden');
    }
</script> --}}

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

    @include('layouts.sidebar-wisatawan')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <div class="pt-[38px] pl-[350px] pr-[50px] pb-[30px] overflow-y-auto min-h-screen">
        <div class="flex flex-col gap-2">
            <form id="formCari" action="{{ route('wisatakulinerhalaman') }}" method="GET">
                @csrf
                <div class="relative w-full flex justify-center mb-6">
                    <div class="w-full max-w-2xl z-20">
                        <div
                            class="flex items-center w-full max-w-2xl border rounded-full overflow-hidden shadow-sm font-medium bg-white">
                            <input type="text" name="keyword" placeholder="Cari Kuliner Disini..." autocomplete="off"
                                class="flex-1 px-5 py-3 focus:outline-none" id="searchBar">
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
                                                value="10" min="0" max="10" />
                                        </div>

                                        <!-- .range -->
                                        <div class="range-jarak-dua">
                                            <input type="range" class="input-jarak-dua" value="10" min="0"
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
                                    {{-- <h3>Filter by Price</h3> --}}
                                    <label class="font-medium">Harga</label>

                                    <!-- .range-slider -->
                                    <div class="range-slider flex justify-between items-center">
                                        {{-- <input type="number" class="min-price" value="100000" min="500"
                                            max="1000000" />
                                        <input type="number" class="max-price" value="500000" min="500"
                                            max="1000000" /> --}}

                                        <div class="flex items-center border rounded-lg overflow-hidden text-[15px]">
                                            <span class="bg-gray-200 px-3 py-2 text-gray-800">Rp</span>
                                            <input type="number" name="minharga"
                                                class="min-price w-[95px] p-2 outline-none border-0" value="0"
                                                min="0" max="1000000" step="25000" />
                                        </div>

                                        <div class="flex items-center border rounded-lg overflow-hidden text-[15px]">
                                            <span class="bg-gray-200 px-3 py-2 text-gray-800">Rp</span>
                                            <input type="number" name="maxharga"
                                                class="max-price w-[95px] p-2 outline-none border-0" value="1000000"
                                                min="0" max="1000000" step="25000" />
                                        </div>

                                        <!-- .range -->
                                        <div class="range">
                                            <input type="range" class="min-input" value="0" min="0"
                                                max="1000000" step="25000" />
                                            <input type="range" class="max-input" value="1000000" min="0"
                                                max="1000000" step="25000" />

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
                                                class="min-rating w-[40px] p-2 outline-none border-0" value="0"
                                                min="0" max="5" />
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
                                                min="0" max="5" />
                                        </div>

                                        <!-- .range -->
                                        <div class="range">
                                            <input type="range" class="min-input-rating" value="0"
                                                min="0" max="5" />
                                            <input type="range" class="max-input-rating" value="5"
                                                min="0" max="5" />

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
                                                        value="40" min="0" max="100">
                                                    <span class="text-gray-400 text-xs pr-1">%</span>
                                                </div>
                                            </div>

                                            <div class="flex flex-col items-center">
                                                <span class="text-sm font-medium mb-1">Harga</span>
                                                <div
                                                    class="flex items-center border bg-white rounded-lg overflow-hidden shadow-sm w-full">
                                                    <input type="number" name="bobot_harga"
                                                        class="input-bobot w-full p-2 text-center text-sm font-semibold outline-none"
                                                        value="20" min="0" max="100">
                                                    <span class="text-gray-400 text-xs pr-1">%</span>
                                                </div>
                                            </div>

                                            <div class="flex flex-col items-center">
                                                <span class="text-sm font-medium mb-1">Nilai Kuliner</span>
                                                <div
                                                    class="flex items-center border bg-white rounded-lg overflow-hidden shadow-sm w-full">
                                                    <input type="number" name="bobot_rating"
                                                        class="input-bobot w-full p-2 text-center text-sm font-semibold outline-none"
                                                        value="25" min="0" max="100">
                                                    <span class="text-gray-400 text-xs pr-1">%</span>
                                                </div>
                                            </div>

                                            <div class="flex flex-col items-center">
                                                <span class="text-sm font-medium mb-1">Kategori</span>
                                                <div
                                                    class="flex items-center border bg-white rounded-lg overflow-hidden shadow-sm w-full">
                                                    <input type="number" name="bobot_kategori"
                                                        class="input-bobot w-full p-2 text-center text-sm font-semibold outline-none"
                                                        value="10" min="0" max="100">
                                                    <span class="text-gray-400 text-xs pr-1">%</span>
                                                </div>
                                            </div>

                                            <div class="flex flex-col items-center">
                                                <span class="text-sm font-medium mb-1">Fasilitas</span>
                                                <div
                                                    class="flex items-center border bg-white rounded-lg overflow-hidden shadow-sm w-full">
                                                    <input type="number" name="bobot_fasilitas"
                                                        class="input-bobot w-full p-2 text-center text-sm font-semibold outline-none"
                                                        value="5" min="0" max="100">
                                                    <span class="text-gray-400 text-xs pr-1">%</span>
                                                </div>
                                            </div>


                                        </div>
                                        {{-- <div class="w-full  bg-white p-3 rounded-xl border shadow-sm"> --}}
                                        <div
                                            class="flex flex-col sm:flex-row items-center justify-between bg-white p-3 rounded-xl border border-gray-200 shadow-sm gap-3">
                                            <div class="flex items-center gap-2">
                                                <span class="text-sm font-medium text-gray-700">Total Alokasi
                                                    Bobot:</span>
                                                <span id="labelTotalBobot"
                                                    class="text-base font-bold text-green-600">100%</span>
                                            </div>


                                        </div>

                                        <button type="submit" id="btnCariBobot"
                                            class="w-full sm:w-auto px-6 py-2 bg-[#FFA319] hover:bg-[#FFA319] text-white font-semibold text-sm rounded-xl shadow-sm transition-all duration-200 disabled:bg-gray-300 disabled:text-gray-500 disabled:cursor-not-allowed">
                                            Cari
                                        </button>
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

            {{-- </div>
            </div> --}}


        </div>

        <div class="mb-8">
            <p class="text-lg text-black font-bold mt-1 mb-4 text-center">
                Event Semarang
            </p>
            <div class="flex justify-center flex-wrap">
                <a href="{{ route('dugderan') }}"
                    class="relative inline-block group w-80 h-100 overflow-hidden group">
                    <img src="{{ asset('dugderan.jpg') }}" alt="dugderan"
                        class="w-full h-full object-cover transition duration-300 group-hover:scale-100">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition duration-300"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-white font-semibold text-lg">
                            Dugderan
                        </span>
                    </div>
                </a>
                <a href="{{ route('kulinerkauman') }}"
                    class="relative inline-block group w-80 h-100 overflow-hidden group">
                    <img src="{{ asset('kulinerkauman.png') }}" alt="kulinerkauman"
                        class="w-full h-full object-cover transition duration-300 group-hover:scale-100">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition duration-300">
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-white font-semibold text-lg">
                            Kuliner Kauman Johar
                        </span>
                    </div>
                </a>
                <a href="{{ route('semawis') }}"
                    class="relative inline-block group w-80 h-100 overflow-hidden group">
                    <img src="{{ asset('pasarimlek.jpg') }}" alt="semawis"
                        class="w-full h-full object-cover transition duration-300 group-hover:scale-100">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition duration-300"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-white font-semibold text-lg">
                            Waroeng Semawis
                        </span>
                    </div>
                </a>
            </div>

        </div>

        {{-- <div class="mb-6">

            <div class="flex gap-3 overflow-x-auto pb-2">

                <button onclick="pilihKategori('semua')" class="kategori-btn px-5 py-3 rounded-xl whitespace-nowrap">

                    Semua Kuliner
                </button>

                <button onclick="pilihKategori('rekomendasi')"
                    class="kategori-btn px-5 py-3 rounded-xl whitespace-nowrap">

                    Rekomendasi Untukmu
                </button>

                <button onclick="pilihKategori('baru')" class="kategori-btn px-5 py-3 rounded-xl whitespace-nowrap">

                    Baru Ditambahkan
                </button>

                <button onclick="pilihKategori('favorit')"
                    class="kategori-btn px-5 py-3 rounded-xl whitespace-nowrap">

                    Banyak Disukai
                </button>

                <button onclick="pilihKategori('tempat')" class="kategori-btn px-5 py-3 rounded-xl whitespace-nowrap">

                    Tempat
                </button>

                <button onclick="pilihKategori('hidangan')"
                    class="kategori-btn px-5 py-3 rounded-xl whitespace-nowrap">

                    Jenis Hidangan
                </button>

                <button onclick="pilihKategori('asal')" class="kategori-btn px-5 py-3 rounded-xl whitespace-nowrap">

                    Asal Kuliner
                </button>

            </div>

        </div>

        <div id="subKategoriContainer" class="mb-6">

        </div>

        @if ($kategoriAktif == 'Tempat')

            <div class="flex flex-wrap gap-2">

                @foreach ($tempat as $item)
                    <button onclick="pilihSubKategori('tempat', '{{ $item->id }}')"
                        class="px-4 py-2 bg-white border rounded-full">

                        {{ $item->nama }}

                    </button>
                @endforeach

            </div>

        @endif

        @if ($kategoriAktif == 'Jenis Hidangan')

            <div class="flex flex-wrap gap-2">

                @foreach ($jenisHidangan as $item)
                    <button onclick="pilihSubKategori('Jenis Hidangan', '{{ $item->id_kategori }}')"
                        class="px-4 py-2 bg-white border rounded-full">

                        {{ $item->nama }}

                    </button>
                @endforeach

            </div>

        @endif

        @if ($kategoriAktif == 'Asal Kuliner')

            <div class="flex flex-wrap gap-2">

                @foreach ($asalKuliner as $item)
                    <button onclick="pilihSubKategori('asal', '{{ $item->id }}')"
                        class="px-4 py-2 bg-white border rounded-full">

                        {{ $item->nama }}

                    </button>
                @endforeach

            </div>

        @endif

        <div id="hasilKuliner" class="mt-6">

        </div> --}}

        <div class="mb-2">

            <div class="flex gap-3 pb-2 overflow-visible">

                {{-- Semua --}}
                <a href="{{ route('beranda-Wisatawan') }}"
                    class="border px-4 py-2 rounded-xl shadow whitespace-nowrap {{ !$kategoriDipilih ? 'bg-[#FFA319] text-white' : 'bg-white text-black' }}">

                    Semua Kuliner

                </a>

                {{-- Tempat --}}
                <div class="relative">

                    <button onclick="klikKategori('tempatDropdown')"
                        class="border px-4 py-2 rounded-xl shadow whitespace-nowrap {{ $kategoriTempat->pluck('id_kategori')->contains($kategoriDipilih)
                            ? 'bg-[#FFA319] text-white'
                            : 'bg-white text-black' }}">

                        Tempat ▼

                    </button>

                    <div id="tempatDropdown"
                        class="hidden absolute top-full left-0 mt-2 bg-white rounded-xl shadow-lg w-56 z-50">

                        @foreach ($kategoriTempat as $item)
                            <a href="{{ route('beranda-Wisatawan', [
                                'kategori' => $item->id_kategori,
                            ]) }}"
                                class="block px-4 py-3 

                                {{ $kategoriDipilih == $item->id_kategori ? 'bg-[#FFA319] text-white' : 'hover:bg-gray-100' }}">

                                {{ $item->nama }}

                            </a>
                        @endforeach

                    </div>

                </div>

                {{-- Jenis Hidangan --}}
                <div class="relative">

                    <button onclick="klikKategori('jenisDropdown')"
                        class="border px-4 py-2 rounded-xl shadow whitespace-nowrap {{ $jenisHidangan->pluck('id_kategori')->contains($kategoriDipilih)
                            ? 'bg-[#FFA319] text-white'
                            : 'bg-white text-black' }}">

                        Jenis Hidangan ▼

                    </button>

                    <div id="jenisDropdown"
                        class="hidden absolute top-full left-0 mt-2 bg-white rounded-xl shadow-lg w-56 z-50">

                        @foreach ($jenisHidangan as $item)
                            <a href="{{ route('beranda-Wisatawan', [
                                'kategori' => $item->id_kategori,
                            ]) }}"
                                class="block px-4 py-3

                                {{ $kategoriDipilih == $item->id_kategori ? 'bg-[#FFA319] text-white' : 'hover:bg-gray-100' }}">
                                {{ $item->nama }}

                            </a>
                        @endforeach

                    </div>

                </div>

                {{-- Asal --}}
                <div class="relative">

                    <button onclick="klikKategori('asalDropdown')"
                        class="border px-4 py-2 rounded-xl shadow whitespace-nowrap {{ $asalKuliner->pluck('id_kategori')->contains($kategoriDipilih)
                            ? 'bg-[#FFA319] text-white'
                            : 'bg-white text-black' }}">

                        Asal Kuliner ▼

                    </button>

                    <div id="asalDropdown"
                        class="hidden absolute top-full left-0 mt-2 bg-white rounded-xl shadow-lg w-56 z-50">

                        @foreach ($asalKuliner as $item)
                            <a href="{{ route('beranda-Wisatawan', [
                                'kategori' => $item->id_kategori,
                            ]) }}"
                                class="block px-4 py-3

                                {{ $kategoriDipilih == $item->id_kategori ? 'bg-[#FFA319] text-white' : 'hover:bg-gray-100' }}">
                                {{ $item->nama }}

                            </a>
                        @endforeach

                    </div>

                </div>

            </div>

        </div>

        {{-- @if ($namaKategoriDipilih)
            <div class="mb-4">
                <h2 class="text-xl text-center font-bold text-gray-800">
                    {{ $namaKategoriDipilih }}
                </h2>
            </div>
        @endif --}}
        @if ($wisataKuliner->count() > 0)
            @if ($namaKategoriDipilih)
                <div class="mb-4">
                    <h2 class="text-xl text-center font-bold text-gray-800">
                        {{ $namaKategoriDipilih }}
                    </h2>
                </div>
            @endif
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">
                @foreach ($wisataKuliner as $item)
                    <div class="bg-white rounded-xl overflow-hidden shadow hover:shadow-lg transition"
                        onclick="klikWisataKuliner({{ $item->id_wisata_kuliner }})">
                        {{-- <a href="{{ route('detailkuliner', $item->id_wisata_kuliner) }}"
                            class="bg-white rounded-xl overflow-hidden shadow hover:shadow-lg transition"> --}}

                        <img src="{{ $item->foto ? asset('storage/' . $item->foto) : asset('storage/tidakadafoto.jpg') }}"
                            class="w-full h-40 object-cover">

                        <div class="p-3">

                            <h3 class="font-semibold">

                                {{ $item->nama }}

                            </h3>


                            {{-- <p class="text-sm text-gray-500 mt-1"> --}}

                            {{-- <span class="text-orange-400"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="currentColor" class="size-4">
                                    <path fill-rule="evenodd"
                                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span> {{ number_format($item->penilaian, 1) }} --}}
                            @if ($item->penilaian > 0)
                                <div class="text-sm mt-1 flex items-center gap-1">
                                    <span class="text-orange-400"><svg xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                            <path fill-rule="evenodd"
                                                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    <span class="font-semibold">
                                        {{ $item->penilaian }}
                                    </span>
                                </div>
                            @endif

                            {{-- </p> --}}

                        </div>

                        {{-- </a> --}}
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-xl shadow p-10 text-center mb-10">
                @if ($namaKategoriDipilih)
                    <div class="mb-4">
                        <h2 class="text-xl text-center font-bold text-gray-800">
                            {{ $namaKategoriDipilih }}
                        </h2>
                    </div>
                @endif
                <div class="flex justify-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-16 h-16 text-[#FFA319]">

                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636" />
                    </svg>
                </div>

                <h3 class="text-lg font-semibold text-gray-700">
                    Wisata Kuliner Belum Tersedia
                </h3>

                @if ($namaKategoriDipilih)
                    <p class="text-gray-500 mt-2">
                        Belum tersedia wisata kuliner pada kategori ini
                        {{-- <span class="font-medium">
                            {{ $namaKategoriDipilih }}
                        </span> --}}
                    </p>
                @endif

            </div>

        @endif

        <div id="detailKuliner"
            class="fixed inset-0 bg-black/40 hidden z-[9999] overflow-y-auto bg-black bg-opacity-40">
            <div class="relative top-5 bottom-5 mx-auto p-5 border w-[500px] shadow-lg rounded-xl bg-white">
                <div class="relative">
                    <button onclick="tutupDetailKuliner()"
                        class="absolute right-0 top-0 text-gray-400 hover:text-gray-500">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <div class="text-center">
                        <h3 class="text-lg font-semibold" id="modalTitleKuliner"></h3>
                    </div>
                </div>

                <div class="mt-4">
                    <div class="grid grid-cols-2 gap-2 text-xs">
                        <div class="flex justify-between w-32">
                            <strong>Status Operasional</strong>
                        </div>
                        <div class="grid grid-cols-[8px_2fr] gap-1 -ml-10">
                            <div>:</div>
                            <div class="text-justify"><span id="status_operasional"></span></div>
                        </div>

                        <div class="flex justify-between w-32">
                            <strong>Deskripsi</strong>
                        </div>
                        <div class="grid grid-cols-[8px_2fr] gap-1 -ml-10">
                            <div>:</div>
                            <div class="text-justify"><span id="deskripsi"></span></div>
                        </div>

                        <div class="flex justify-between w-32">
                            <strong>Alamat</strong>
                        </div>
                        <div class="grid grid-cols-[8px_2fr] gap-1 -ml-10">
                            <div>:</div>
                            <div class="text-justify"><span id="alamat"></span></div>
                        </div>

                        <div class="flex justify-between w-32">
                            <strong>Kecamatan</strong>
                        </div>
                        <div class="grid grid-cols-[8px_2fr] gap-1 -ml-10">
                            <div>:</div>
                            <div class="text-justify"><span id="kecamatan"></span></div>
                        </div>

                        <div class="flex justify-between w-32">
                            <strong>Kelurahan</strong>
                        </div>
                        <div class="grid grid-cols-[8px_2fr] gap-1 -ml-10">
                            <div>:</div>
                            <div class="text-justify"><span id="kelurahan"></span></div>
                        </div>

                        <div class="flex justify-between w-32">
                            <strong>Nomor Telepon</strong>
                        </div>
                        <div class="grid grid-cols-[8px_2fr] gap-1 -ml-10">
                            <div>:</div>
                            <div class="text-justify"><span id="nomor_telepon"></span></div>
                        </div>

                        <div class="flex justify-between w-32">
                            <strong>Fasilitas</strong>
                        </div>
                        <div class="grid grid-cols-[8px_2fr] gap-1 -ml-10">
                            <div>:</div>
                            <div class="text-justify"><span id="fasilitas"></span></div>
                        </div>

                        <div class="flex justify-between w-32">
                            <strong>Kategori</strong>
                        </div>
                        <div class="grid grid-cols-[8px_2fr] gap-1 -ml-10">
                            <div>:</div>
                            <div class="text-justify"><span id="kategori"></span></div>
                        </div>

                        <div class="flex justify-between w-32">
                            <strong>Sertifikat Halal</strong>
                        </div>
                        <div class="grid grid-cols-[8px_2fr] gap-1 -ml-10">
                            <div>:</div>
                            <div class="text-justify"><span id="sertifikat_halal"></span></div>
                        </div>

                        <div class="flex justify-between w-32">
                            <strong>Foto</strong>
                        </div>
                        <div class="grid grid-cols-[8px_2fr] gap-1 -ml-10">
                            <div>:</div>
                            <div>
                                <img id="foto" src="" alt="Foto Wisata Kuliner"
                                    class="w-full max-w-xs h-40 object-cover rounded-md border hidden">
                            </div>
                        </div>

                        <div class="flex justify-between w-32">
                            <strong>Latitude</strong>
                        </div>
                        <div class="grid grid-cols-[8px_2fr] gap-1 -ml-10">
                            <div>:</div>
                            <div class="text-justify"><span id="latitude"></span></div>
                        </div>

                        <div class="flex justify-between w-32">
                            <strong>Longitude</strong>
                        </div>
                        <div class="grid grid-cols-[8px_2fr] gap-1 -ml-10">
                            <div>:</div>
                            <div class="text-justify"><span id="longitude"></span></div>
                        </div>

                        <div class="flex justify-between w-32">
                            <strong>Lokasi</strong>
                        </div>
                        <div class="grid grid-cols-[8px_2fr] gap-1 -ml-10">
                            <div>:</div>
                            <div>
                                <div id="map" class="w-full h-48 rounded-md"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- @if ($kulinerBaru)
            <div class="mb-2">
                <p class="text-lg text-black font-bold mt-4 mb-4">
                    Kuliner Baru Ditambahkan
                </p>
                <div class="grid grid-cols-4 gap-8">
                    @foreach ($kulinerBaru as $item)
                        <a href="#"
                            class="pointer-events-none relative inline-block group w-80 h-40 rounded-xl overflow-hidden">

                            <img src="{{ asset('storage/' . $item->foto) }}"
                                class="w-full h-full object-cover transition duration-300 group-hover:scale-100">

                            <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50"></div>

                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="text-white font-semibold text-lg text-center px-2">
                                    {{ $item->nama }}
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        @if ($kulinerFavorit)
            <div class="mb-8">
                <p class="text-lg text-black font-bold mt-4 mb-4">
                    Kuliner Banyak Disukai
                </p>
                <div class="grid grid-cols-4 gap-8">
                    @foreach ($kulinerFavorit as $item)
                        <a href="#"
                            class="pointer-events-none relative inline-block group w-80 h-40 rounded-xl overflow-hidden">

                            <img src="{{ asset('storage/' . $item->foto) }}"
                                class="w-full h-full object-cover transition duration-300 group-hover:scale-100">

                            <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50"></div>

                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="text-white font-semibold text-lg text-center px-2">
                                    {{ $item->nama }}
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>

            </div>
        @endif --}}

    </div>

    <script src="https://cdn.jsdelivr.net/npm/multi-select-dropdown-js/MultiSelect.min.js"></script>

    <script>
        // document.addEventListener("DOMContentLoaded", function() {
        //     const inputs = document.querySelectorAll(".input-bobot");
        //     const labelTotal = document.getElementById("labelTotalBobot");
        //     const pesanError = document.getElementById("pesanErrorBobot");
        //     const formCari = document.getElementById("formCari");

        //     function updateBobotLimits() {
        //         let totalSekarang = 0;
        //         inputs.forEach(input => {
        //             let val = parseInt(input.value);
        //             if (isNaN(val) || val < 0) {
        //                 input.value = 0;
        //             }
        //         });

        //         inputs.forEach(input => {
        //             totalSekarang += parseInt(input.value) || 0;
        //         });

        //         if (totalSekarang > 100) {
        //             const activeInput = document.activeElement;
        //             if (activeInput && activeInput.classList.contains('input-bobot')) {
        //                 let nilaiActive = parseInt(activeInput.value) || 0;

        //                 let totalLain = 0;
        //                 inputs.forEach(input => {
        //                     if (input !== activeInput) totalLain += parseInt(input.value) || 0;
        //                 });

        //                 activeInput.value = 100 - totalLain;
        //             }

        //             totalSekarang = 0;
        //             inputs.forEach(input => {
        //                 totalSekarang += parseInt(input.value) || 0;
        //             });
        //         }

        //         labelTotal.textContent = totalSekarang + "%";

        //         // if (totalSekarang === 100) {
        //         //     labelTotal.className = "text-base font-bold text-green-600";
        //         //     pesanError.classList.add("hidden");
        //         // } else {
        //         //     labelTotal.className = "text-base font-bold text-red-500";
        //         // }

        //         inputs.forEach(input => {
        //             const nilaiInputIni = parseInt(input.value) || 0;
        //             let sisaKuota = 100 - (totalSekarang - nilaiInputIni);
        //             if (sisaKuota < 0) sisaKuota = 0;
        //             input.max = sisaKuota;
        //             if (totalSekarang >= 100 && nilaiInputIni === 0) {
        //                 input.max = 0;
        //             }
        //         });
        //     }

        //     inputs.forEach(input => {
        //         input.addEventListener("input", updateBobotLimits);
        //     });

        //     formCari.addEventListener("submit", function(e) {
        //         let totalAkhir = 0;
        //         inputs.forEach(input => {
        //             totalAkhir += parseInt(input.value) || 0;
        //         });

        //         if (totalAkhir !== 100) {
        //             e.preventDefault();
        //             pesanError.textContent =
        //                 `⚠️ Total bobot saat ini ${totalAkhir}%. Harus pas 100% agar perhitungan WSM valid!`;
        //             pesanError.classList.remove("hidden");

        //             pesanError.scrollIntoView({
        //                 behavior: 'smooth',
        //                 block: 'center'
        //             });
        //         }
        //     });

        //     updateBobotLimits();
        // });
        document.addEventListener("DOMContentLoaded", function() {
            const inputs = document.querySelectorAll(".input-bobot");
            const labelTotal = document.getElementById("labelTotalBobot");
            const pesanError = document.getElementById("pesanErrorBobot");
            const btnCari = document.getElementById("btnCariBobot");
            const formCari = document.getElementById("formCari");

            function updateBobotLimits() {
                let totalSekarang = 0;

                // 1. Sanitasi input: Bersihkan format minus atau angka kosong
                inputs.forEach(input => {
                    // Cek jika user memasukkan angka nol beruntun (0000)
                    if (input.value.length > 1 && input.value.startsWith('0')) {
                        input.value = parseInt(input.value) || 0;
                    }

                    let val = parseInt(input.value);
                    if (isNaN(val) || val < 0) {
                        input.value = 0;
                    }
                });

                // 2. Hitung total akumulasi bobot
                inputs.forEach(input => {
                    totalSekarang += parseInt(input.value) || 0;
                });

                // 3. Batasi jika total input melebihi angka 100% secara paksa
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

                // 4. Perbarui Teks Persentase di UI
                labelTotal.textContent = totalSekarang + "%";

                // 5. Logika Validasi Tombol & Tampilan Pesan Error Secara Real-Time
                if (totalSekarang === 100) {
                    labelTotal.className = "text-base font-bold text-green-600";
                    // pesanError.classList.add("hidden");

                    // Aktifkan tombol kembali
                    if (btnCari) btnCari.disabled = false;
                } else {
                    labelTotal.className = "text-base font-bold text-red-500";

                    // Kunci tombol agar tidak bisa diklik semenjak user mengetik data salah
                    if (btnCari) btnCari.disabled = true;
                }

                // 6. Set dinamis batas maksimal input tersisa
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

            // Pasang Event Listener ke seluruh kolom input bobot
            inputs.forEach(input => {
                input.addEventListener("input", updateBobotLimits);

                // Mempermudah user mengubah angka saat kolom diklik (auto-select)
                input.addEventListener("focus", function() {
                    this.select();
                });
            });

            // Validasi double-check saat form dikirimkan
            if (formCari) {
                formCari.addEventListener("submit", function(e) {
                    let totalAkhir = 0;
                    inputs.forEach(input => {
                        totalAkhir += parseInt(input.value) || 0;
                    });

                    if (totalAkhir !== 100) {
                        e.preventDefault(); // Gagalkan pengiriman data ke server Laravel

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

            // Jalankan fungsi saat pertama kali halaman dimuat
            updateBobotLimits();
        });

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

        // document.addEventListener('DOMContentLoaded', () => {
        //     const hamburger = document.getElementById('hamburger');
        //     const sidebar = document.querySelector('.sidebar');

        //     if (!hamburger || !sidebar) return;

        //     hamburger.addEventListener('click', () => {
        //         sidebar.classList.toggle('expanded');
        //     });
        // });

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

        function adaKriteria() {

            const kategori =
                document.getElementById('kategori')
                .selectedOptions.length;

            const fasilitas =
                document.getElementById('fasilitas')
                .selectedOptions.length;

            const jarak =
                parseInt(document.querySelector(
                    '[name="jarak"]'
                ).value);

            const minHarga =
                parseInt(document.querySelector(
                    '[name="minharga"]'
                ).value);

            const maxHarga =
                parseInt(document.querySelector(
                    '[name="maxharga"]'
                ).value);

            const minRating =
                parseInt(document.querySelector(
                    '[name="minrating"]'
                ).value);

            const maxRating =
                parseInt(document.querySelector(
                    '[name="maxrating"]'
                ).value);

            return (
                kategori > 0 ||
                fasilitas > 0 ||
                jarak < 10 ||
                minHarga > 0 ||
                maxHarga < 1000000 ||
                minRating > 0 ||
                maxRating < 5
            );
        }

        // const btnCariBobot =
        //     document.getElementById("btnCariBobot");

        const keyword =
            searchBar.value.trim();

        // const bolehCari =
        //     totalSekarang === 100 &&
        //     (
        //         keyword !== '' ||
        //         adaKriteria()
        //     );

        // btnCariBobot.disabled = !bolehCari;

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
                    document.getElementById("lat").value = -6.969054045894555;
                    document.getElementById("lng").value = 110.42432058292049;

                    e.target.submit();
                }
            );
        });

        function klikKulinerTerdekat(e) {
            e.preventDefault();
            e.stopPropagation();

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

                        const params = new URLSearchParams(window.location.search);

                        params.set('terdekat', 1);
                        params.set("lat", lat);
                        params.set("lng", lng);
                        // params.set("jarak", 5);
                        // params.set("minharga", 0);
                        // params.set("maxharga", 500000);
                        // params.set("minrating", 0);
                        // params.set("maxrating", 5);
                        // params.set("keyword", "Kuliner Terdekat");

                        window.location.href = "/wisata-kuliner-cari?" + params.toString();
                    },
                    function(error) {
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
                    title: 'Mohon Maaf',
                    text: 'Browser Anda tidak mendukung fitur untuk mengambil lokasi',
                    confirmButtonText: 'OK'
                });
            }
        }

        function initApp() {

            const semarang = {
                lat: -6.9667,
                lng: 110.4167
            };

            const map = new google.maps.Map(document.getElementById("map"), {
                center: semarang,
                zoom: 12,

                disableDefaultUI: true,
                gestureHandling: "none",

                styles: [{
                        featureType: "all",
                        elementType: "labels",
                        stylers: [{
                            visibility: "off"
                        }]
                    },
                    {
                        featureType: "poi",
                        stylers: [{
                            visibility: "off"
                        }]
                    }
                ]
            });

            new google.maps.Marker({
                position: semarang,
                map: map
            });
        }

        function klikKategori(id) {
            const semuaDropdown = [
                'tempatDropdown',
                'jenisDropdown',
                'asalDropdown'
            ];

            semuaDropdown.forEach(dropdown => {

                if (dropdown !== id) {
                    document
                        .getElementById(dropdown)
                        .classList
                        .add('hidden');
                }

            });

            document
                .getElementById(id)
                .classList
                .toggle('hidden');
        }

        document.addEventListener('click', function(e) {

            if (!e.target.closest('.relative')) {
                ['tempatDropdown', 'jenisDropdown', 'asalDropdown']
                .forEach(id => {

                    document
                        .getElementById(id)
                        .classList
                        .add('hidden');

                });
            }

        });

        let map = null;
        let marker = null;

        function klikWisataKuliner(id) {
            fetch(`/wisatawan/favorit/detail/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('modalTitleKuliner').textContent = data.nama;
                    document.getElementById('alamat').textContent = data.alamat;
                    document.getElementById('kecamatan').textContent = data.kecamatan;
                    document.getElementById('kelurahan').textContent = data.kelurahan;
                    document.getElementById('nomor_telepon').textContent = data.no_telp ?? '-';
                    document.getElementById('deskripsi').textContent = data.deskripsi;
                    document.getElementById('latitude').textContent = data.latitude;
                    document.getElementById('longitude').textContent = data.longitude;
                    document.getElementById('sertifikat_halal').textContent = data.sertifikat_halal;
                    const status = document.getElementById('status_operasional');
                    status.textContent = data.status_operasional;

                    if (data.status_operasional === 'Aktif') {
                        status.classList.add('text-green-600', 'font-semibold');
                    } else if (data.status_operasional === 'Tutup Sementara') {
                        status.classList.add('text-orange-500', 'font-semibold');
                    } else if (data.status_operasional === 'Tutup Permanen') {
                        status.classList.add('text-red-600', 'font-semibold');
                    }

                    const foto = document.getElementById('foto');

                    if (data.foto) {
                        foto.src = `/storage/${data.foto}`;
                    } else {
                        foto.src = `/storage/tidakadafoto.jpg`;
                    }

                    foto.classList.remove('hidden');

                    const lat = parseFloat(data.latitude);
                    const lng = parseFloat(data.longitude);

                    const position = {
                        lat: lat,
                        lng: lng
                    };

                    // Fasilitas
                    let fasilitas = data.fasilitas || [];
                    let container = document.getElementById('fasilitas');

                    container.innerHTML = '';
                    if (fasilitas.length > 0) {
                        fasilitas.forEach(f => {
                            let span = document.createElement('span');
                            span.textContent = f.nama;

                            span.style.display = 'inline-block';
                            span.style.padding = '4px 4px';
                            span.style.margin = '2px';
                            span.style.backgroundColor = '#dddddd';
                            span.style.borderRadius = '4px';
                            span.style.fontSize = '12px';

                            container.appendChild(span);
                        });
                    } else {
                        container.textContent = '-';
                    }

                    // Kategori
                    let kategori = data.kategori || [];
                    let containerKategori = document.getElementById('kategori');

                    containerKategori.innerHTML = '';
                    if (kategori.length > 0) {
                        kategori.forEach(k => {
                            let span = document.createElement('span');
                            span.textContent = k.nama;

                            span.style.display = 'inline-block';
                            span.style.padding = '4px 4px';
                            span.style.margin = '2px';
                            span.style.backgroundColor = '#dddddd';
                            span.style.borderRadius = '4px';
                            span.style.fontSize = '12px';

                            containerKategori.appendChild(span);
                        });
                    } else {
                        containerKategori.textContent = '-';
                    }

                    document.getElementById('detailKuliner').classList.remove('hidden');

                    if (!map) {
                        map = new google.maps.Map(document.getElementById("map"), {
                            center: position,
                            zoom: 16,
                            mapId: "5ee8a1d5bfc6676ac1b5f32c",
                            clickableIcons: false,
                        });

                        marker = new google.maps.marker.AdvancedMarkerElement({
                            position: position,
                            map: map,
                        });
                    } else {
                        map.setCenter(position);
                        marker.position = position;
                    }
                });
            document.body.style.overflow = 'hidden';
        }

        function tutupDetailKuliner() {
            document.getElementById('detailKuliner').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // function pilihKategori(kategori) {

        //     const params = new URLSearchParams(window.location.search);

        //     params.set('kategori_aktif', kategori);

        //     window.location.href =
        //         window.location.pathname + '?' + params.toString();
        // }
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-gBdR_gqZTd8B6jz3mVJWI-pqC_jPlAI&callback=initApp&libraries=maps,marker&v=weekly&language=in"
        async defer></script>
</body>

</html>
