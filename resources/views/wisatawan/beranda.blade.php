<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/multi-select-dropdown-js/MultiSelect.min.css">

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-multiselect@0.9.13/dist/css/bootstrap-multiselect.css"> --}}


    {{-- <script src="https://refinedguides.com/assets/social.js?linkColor=%23fff&textColor=%23000" defer></script> --}}
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



        /* @import url("https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600&display=swap"); */

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

        body {
            background: var(--yellow-color);
            display: flex;
            align-items: center;
            flex-direction: column;
            min-height: 100dvh;
        }

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
    </style>

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
    {{-- <div class="h-screen flex flex-col">
        @include('layouts.header-wisatawan')

        <div class="flex flex-1 overflow-hidden">
             @include('layouts.sidebar-wisatawan') 

            <div class="flex-1 p-6 overflow-y-auto">
                <h2 class="text-2xl text-black font-bold mb-4">
                    Selamat datang, Wisatawan!
                </h2>

                
            </div>
        </div>
    </div> --}}

    {{-- <div class="h-screen flex flex-col">
    @include('layouts.header-wisatawan')

    <div class="flex flex-1">
        @include('layouts.sidebar-wisatawan')

        <div class="flex-1 p-6 overflow-y-auto">
            <h2 class="text-2xl text-black font-bold mb-4">
                Selamat datang, Wisatawan!
            </h2>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </div>
    </div>
    </div> --}}

    @include('layouts.header-wisatawan')
    @include('layouts.sidebar-wisatawan')

    {{-- <div class="pt-[100px] p-28 overflow-y-auto min-h-screen"> --}}
    <div class="pt-[10px] pl-28 pr-[30px] pb-[30px]">
        <div class="flex flex-col gap-2">
            {{-- <h2 class="text-2xl text-black font-bold mb-4">
                Selamat datang di SIMAPKU Semarang, temukan kuliner Semarang yang cocok untuk Anda disini!
            </h2> --}}
            <div>
                <p class="text-m text-black font-medium mt-2 mb-2 text-center">
                    Ingin memasukkan kuliner yang Anda ketahui?
                    <a href="{{ route('tambahwisatakuliner') }}" class="text-[#FFA319]  hover:underline">
                        Tambah Kuliner
                    </a>
                </p>
            </div>


            <form id="formCari" action="{{ route('wisatakulinerhalaman') }}" method="GET">
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
                            {{-- <div class="p-3 rounded-xl bg-white shadow-md hover:bg-gray-100 cursor-pointer">
                                Kuliner Terdekat
                            </div> --}}
                            <div onclick="cariKulinerTerdekat()"
                                class="p-3 rounded-xl bg-white shadow-md hover:bg-gray-100 cursor-pointer">
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
                            {{-- <div id="advancedFilter" class="hidden mt-3 space-y-3"> --}}
                            <div id="advancedFilter" class="hidden mt-3 grid grid-cols-2 gap-3 ml-3 mr-3">

                                {{-- <input type="hidden" name="lat" id="lat">
                                <input type="hidden" name="lng" id="lng"> --}}
                                {{-- <div>
                                    <select class="w-full border rounded-lg p-2" name="rating">
                                        <option>Rating Minimal</option>
                                        <option>⭐ 3+</option>
                                        <option>⭐ 4+</option>
                                        <option>⭐ 4.5+</option>
                                    </select>
                                </div> --}}

                                {{-- <label>Rating</label> --}}

                                {{-- <input type="range" id="minRating" min="1" max="5" value="1">
                                <input type="range" id="maxRating" min="1" max="5" value="5">

                                <p>
                                    Min: <span id="minVal">1</span> ⭐ -
                                    Max: <span id="maxVal">5</span> ⭐
                                </p> --}}

                                {{-- <input type="hidden" name="min_rating" id="min_rating">
                                <input type="hidden" name="max_rating" id="max_rating"> --}}







                                {{-- <div class="container">
                                    <label class="font-medium">Jarak</label>

                                    <!-- .range-slider -->
                                    <div class="range-slider-jarak flex justify-between items-center">
                                        <div class="flex items-center border rounded-lg overflow-hidden text-[15px]">
                                            <span class="bg-gray-200 px-3 py-2 text-gray-800">Km</span>
                                            <input type="number" name="minjarak"
                                                class="min-jarak w-[40px] p-2 outline-none border-0" value="1"
                                                min="1" max="5" />
                                        </div>

                                        <div
                                            class="flex items-center text-center border rounded-lg overflow-hidden text-[15px]">
                                            <span class="bg-gray-200 px-3 py-2 text-gray-800">Km</span>
                                            <input type="number" name="maxjarak"
                                                class="max-jarak w-[40px] p-2 outline-none border-0" value="5"
                                                min="1" max="5" />
                                        </div>

                                        <!-- .range -->
                                        <div class="range">
                                            <input type="range" class="min-input-jarak" value="1" min="1"
                                                max="5" />
                                            <input type="range" class="max-input-jarak" value="5" min="1"
                                                max="5" />

                                            <div class="slider">
                                                <div class="progress-jarak"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}


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



                                {{-- <select id="darkmode" name="darkmode[]" data-placeholder="Dark mode active..."
                                    data-theme="light" multiple data-multi-select>
                                    <option value="1">Dark Option 1</option>
                                    <option value="2">Dark Option 2</option>
                                    <option value="3">Dark Option 3</option>
                                    <option value="4">Dark Option 4</option>
                                    <option value="5">Dark Option 5</option>
                                    <option value="6">Dark Option 6</option>
                                </select> --}}

                                {{-- <select id="minimal-multiselect" multiple="multiple">
                                    <option value="cheese">Cheese</option>
                                    <option value="tomatoes">Tomatoes</option>
                                    <option value="mozarella">Mozzarella</option>
                                    <option value="mushrooms">Mushrooms</option>
                                    <option value="pepperoni">Pepperoni</option>
                                    <option value="onions">Onions</option>
                                </select> --}}

                                {{-- <div>
                                    <input type="checkbox" name="fasilitas[]" value="1"> Wifi
                                    <input type="checkbox" name="fasilitas[]" value="2"> Parkir
                                    <input type="checkbox" name="fasilitas[]" value="3"> AC
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>

        <div class="mb-8">
            <p class="text-lg text-black font-bold mt-1 mb-4">
                Event Semarang
            </p>
            <div class="grid grid-cols-4 gap-8">
                <a href="{{ route('event') }}"
                    class="relative inline-block group w-80 h-40 rounded-xl overflow-hidden group">
                    <img src="{{ asset('dugderan.jpg') }}" alt="dugderan"
                        class="w-full h-full object-cover transition duration-300 group-hover:scale-100">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition duration-300"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-white font-semibold text-lg">
                            Dugderan
                        </span>
                    </div>
                </a>
                <a href="{{ route('event') }}"
                    class="relative inline-block group w-80 h-40 rounded-xl overflow-hidden group">
                    <img src="{{ asset('pasarsentiling.jpg') }}" alt="dugderan"
                        class="w-full h-full object-cover transition duration-300 group-hover:scale-100">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition duration-300"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-white font-semibold text-lg">
                            Festival Kota Lama
                        </span>
                    </div>
                </a>
                <a href="{{ route('event') }}"
                    class="relative inline-block group w-80 h-40 rounded-xl overflow-hidden group">
                    <img src="{{ asset('pasarimlek.jpg') }}" alt="dugderan"
                        class="w-full h-full object-cover transition duration-300 group-hover:scale-100">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition duration-300"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-white font-semibold text-lg">
                            Pasar Imlek Semawis
                        </span>
                    </div>
                </a>
                <a href="{{ route('event') }}"
                    class="relative inline-block group w-80 h-40 rounded-xl overflow-hidden group">
                    <img src="{{ asset('chengho.jpg') }}" alt="dugderan"
                        class="w-full h-full object-cover transition duration-300 group-hover:scale-100">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition duration-300">
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-white font-semibold text-lg">
                            Festival Arak-Arakan Cheng Ho
                        </span>
                    </div>
                </a>
                <a href="{{ route('event') }}"
                    class="relative inline-block group w-80 h-40 rounded-xl overflow-hidden group">
                    <img src="{{ asset('snc.jpg') }}" alt="dugderan"
                        class="w-full h-full object-cover transition duration-300 group-hover:scale-100">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition duration-300">
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-white font-semibold text-lg">
                            Semarang Night Carnival
                        </span>
                    </div>
                </a>
            </div>

        </div>

        <p class="text-lg text-black font-bold mt-4 mb-4">
            Kuliner Terbaru
        </p>
        <p class="text-lg text-black font-bold mt-4 mb-4">
            Kuliner Populer
        </p>

        {{-- <div class="wrapper">
            <button class="nav left" onclick="geser(-1)">❮</button>

            <div class="slider" id="slider">
                <div class="card">
                    <img src="https://picsum.photos/120/90" />
                    <div class="info">
                        <h4>Pesta Keboen <span>⭐ 4.5</span></h4>
                        <p>Jl. Veteran No.29</p>
                        <p>Buka 08.00 WIB</p>
                        <p>Sajian Indonesia • Wi-Fi</p>
                        <strong>Rp50.000+</strong>
                    </div>
                </div>

                <div class="card">
                    <img src="https://picsum.photos/120/90" />
                    <div class="info">
                        <h4>Pesta Keboen <span>⭐ 4.5</span></h4>
                        <p>Jl. Veteran No.29</p>
                        <p>Buka 08.00 WIB</p>
                        <p>Sajian Indonesia • Wi-Fi</p>
                        <strong>Rp50.000+</strong>
                    </div>
                </div>
                <div class="card">
                    <img src="https://picsum.photos/120/90" />
                    <div class="info">
                        <h4>Pesta Keboen <span>⭐ 4.5</span></h4>
                        <p>Jl. Veteran No.29</p>
                        <p>Buka 08.00 WIB</p>
                        <p>Sajian Indonesia • Wi-Fi</p>
                        <strong>Rp50.000+</strong>
                    </div>
                </div>
                <div class="card">
                    <img src="https://picsum.photos/120/90" />
                    <div class="info">
                        <h4>Pesta Keboen <span>⭐ 4.5</span></h4>
                        <p>Jl. Veteran No.29</p>
                        <p>Buka 08.00 WIB</p>
                        <p>Sajian Indonesia • Wi-Fi</p>
                        <strong>Rp50.000+</strong>
                    </div>
                </div>
                <div class="card">
                    <img src="https://picsum.photos/120/90" />
                    <div class="info">
                        <h4>Pesta Keboen <span>⭐ 4.5</span></h4>
                        <p>Jl. Veteran No.29</p>
                        <p>Buka 08.00 WIB</p>
                        <p>Sajian Indonesia • Wi-Fi</p>
                        <strong>Rp50.000+</strong>
                    </div>
                </div>
            </div>

            <button class="nav right" onclick="geser(1)">❯</button>
        </div> --}}


        {{-- <div class="slider-container">
            <div class="slider" id="slider">
                <div class="card">CARD 1</div>
                <div class="card">CARD 2</div>
                <div class="card">CARD 3</div>
                <div class="card">CARD 1</div>
                <div class="card">CARD 2</div>
                <div class="card">CARD 3</div>
            </div>

            <div class="dots" id="dots"></div>
        </div> --}}

        {{-- <div class="slider-wrapper">
            <button onclick="prev()">❮</button>

            <div class="viewport gap-6">
                <div class="slider" id="slider">
                    <div class="card">
                        <div>ISI CARD NANTI</div>
                    </div>

                    <div class="card">1</div>
                    <div class="card">2</div>
                    <div class="card">3</div>
                    <div class="card">4</div>
                    <div class="card">5</div>
                    <div class="card">6</div>
                    <div class="card">7</div>
                    <div class="card">8</div>
                    <div class="card">9</div>
                </div>
            </div>

            <button onclick="next()">❯</button>
        </div>

        <div class="dots" id="dots"></div> --}}









        {{-- <div class="slider-wrapper">
            <button class="arrow left" onclick="prev()"><i class="fas fa-chevron-left"
                    style="color: #ffffff;"></i></button>

            <div class="viewport">
                <div class="slider" id="slider">
                    <div class="card">1</div>
                    <div class="card">2</div>
                    <div class="card">3</div>
                    <div class="card">4</div>
                    <div class="card">5</div>
                    <div class="card">6</div>
                    <div class="card">7</div>
                    <div class="card">8</div>
                    <div class="card">9</div>
                </div>
            </div>

            <button class="arrow right" onclick="next()"><i class="fas fa-chevron-right"
                    style="color: #ffffff;"></i></button>
        </div>

        <div class="dots" id="dots"></div> --}}





        <a href="{{ route('map-WisataKuliner') }}" class="text-[#FFA319]  hover:underline">
            Map Wisata Kuliner
        </a>

        <a href="{{ route('map-WisataKuliner2') }}" class="text-[#FFA319]  hover:underline">
            Map Wisata Kuliner 2
        </a>

        {{-- <a href="{{ route('map-WisataKuliner3') }}" class="text-[#FFA319]  hover:underline">
            Map Wisata Kuliner 3
        </a> --}}
    </div>



    {{-- <section class="services">
        <div class="container-services">

            <div class="section-heading text-center mb-4">
                <h2>Bidang yang Dimagangkan</h2>
            </div>

            <div class="owl-carousel owl-theme bidang-carousel">

                <div class="service-item">
                    <div class="icon"><i class="fas fa-university"></i></div>
                    <h4>Sistem Pemerintahan Berbasis Elektronik</h4>
                    <p>
                        - Keamanan Informasi dan Persandian<br>
                        - Pengembangan Aplikasi<br>
                        - Tata Kelola TI
                    </p>
                </div>

                <div class="service-item">
                    <div class="icon"><i class="fas fa-lock"></i></div>
                    <h4>Pengelolaan Informasi</h4>
                    <p>
                        - Media & Aspirasi<br>
                        - PPID<br>
                        - Keterbukaan Informasi
                    </p>
                </div>

                <div class="service-item">
                    <div class="icon"><i class="fas fa-rss"></i></div>
                    <h4>Infrastruktur</h4>
                    <p>
                        - Internet & Intranet<br>
                        - Jaringan<br>
                        - TIK
                    </p>
                </div>

                <div class="service-item">
                    <div class="icon"><i class="fas fa-chart-area"></i></div>
                    <h4>Statistik</h4>
                    <p>
                        - Statistik Sektoral<br>
                        - Geospasial
                    </p>
                </div>

                <div class="service-item">
                    <div class="icon"><i class="fas fa-bullhorn"></i></div>
                    <h4>Komunikasi Publik</h4>
                    <p>
                        - Strategi Komunikasi<br>
                        - Monitoring Media
                    </p>
                </div>

                <div class="service-item">
                    <div class="icon"><i class="fas fa-users"></i></div>
                    <h4>Sekretariat</h4>
                    <p>
                        - Kepegawaian<br>
                        - Keuangan
                    </p>
                </div>

            </div>
        </div>
    </section> --}}

    {{-- <section class="services">
        <div class="container-fluid-services">

            <div class="section-heading text-center mb-4">
                <h2>Bidang yang Dimagangkan</h2>
            </div>

            <div class="carousel-wrapper">
                <div class="owl-carousel owl-theme bidang-carousel">

                    <!-- ITEM -->
                    <div class="service-item">
                        <div class="icon"><i class="fas fa-university"></i></div>
                        <h4>SPBE</h4>
                        <p>- Keamanan Informasi<br>- Pengembangan Aplikasi</p>
                    </div>

                    <div class="service-item">
                        <div class="icon"><i class="fas fa-lock"></i></div>
                        <h4>Pengelolaan Informasi</h4>
                        <p>- Media<br>- PPID</p>
                    </div>

                    <div class="service-item">
                        <div class="icon"><i class="fas fa-rss"></i></div>
                        <h4>Infrastruktur</h4>
                        <p>- Internet<br>- TIK</p>
                    </div>

                    <div class="service-item">
                        <div class="icon"><i class="fas fa-chart-area"></i></div>
                        <h4>Statistik</h4>
                        <p>- Statistik Sektoral</p>
                    </div>

                    <div class="service-item">
                        <div class="icon"><i class="fas fa-bullhorn"></i></div>
                        <h4>Komunikasi Publik</h4>
                        <p>- Strategi Komunikasi</p>
                    </div>

                    <div class="service-item">
                        <div class="icon"><i class="fas fa-users"></i></div>
                        <h4>Sekretariat</h4>
                        <p>- Kepegawaian</p>
                    </div>

                </div>
            </div>
        </div>
    </section> --}}




    {{-- @include('layouts.header-wisatawan')

    <div class="wrapper">
        @include('layouts.sidebar-wisatawan')

        <div class="main-content">
            @yield('content')
        </div>
    </div> --}}
    <script src="https://cdn.jsdelivr.net/npm/multi-select-dropdown-js/MultiSelect.min.js"></script>

    <script>
        // const menuBtn = document.getElementById('menuBtn');
        // const sidebar = document.getElementById('sidebar');
        // const texts = document.querySelectorAll('.sidebar-text');

        // if (menuBtn && sidebar) {
        //     menuBtn.addEventListener('click', () => {
        //         sidebar.classList.toggle('w-16');
        //         sidebar.classList.toggle('w-64');

        //         texts.forEach(t => t.classList.toggle('hidden'));
        //     });
        // }
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


        // const sliderJarak = document.querySelector(".range-slider-jarak");
        // const progressJarak = sliderJarak.querySelector(".progress-jarak");
        // const minJarakInput = sliderJarak.querySelector(".min-jarak");
        // const maxJarakInput = sliderJarak.querySelector(".max-jarak");
        // const minInputJarak = sliderJarak.querySelector(".min-input-jarak");
        // const maxInputJarak = sliderJarak.querySelector(".max-input-jarak");

        // const updateProgressJarak = () => {
        //     const minValueJarak = parseInt(minInputJarak.value);
        //     const maxValueJarak = parseInt(maxInputJarak.value);

        //     const totalRangeJarak = maxInputJarak.max - minInputJarak.min;
        //     const valueRangeJarak = maxValueJarak - minValueJarak;

        //     const widthJarak = (valueRangeJarak / totalRangeJarak) * 100;
        //     const minOffsetJarak = ((minValueJarak - minInputJarak.min) / totalRangeJarak) * 100;

        //     progressJarak.style.width = widthJarak + "%";
        //     progressJarak.style.left = minOffsetJarak + "%";

        //     minJarakInput.value = minValueJarak;
        //     maxJarakInput.value = maxValueJarak;
        // };

        // const updateRangeJarak = (event) => {
        //     const inputJarak = event.target;

        //     let minJarak = parseInt(minJarakInput.value);
        //     let maxJarak = parseInt(maxJarakInput.value);

        //     if (inputJarak === minJarakInput && minJarak > maxJarak) {
        //         maxJarak = minJarak;
        //         maxJarakInput.value = maxJarak;
        //     } else if (inputJarak === maxJarakInput && maxJarak < minJarak) {
        //         minJarak = maxJarak;
        //         minJarakInput.value = minJarak;
        //     }

        //     minInputJarak.value = minJarak;
        //     maxInputJarak.value = maxJarak;

        //     updateProgressJarak();
        // };

        // minJarakInput.addEventListener("input", updateRangeJarak);
        // maxJarakInput.addEventListener("input", updateRangeJarak);

        // minInputJarak.addEventListener("input", () => {
        //     if (parseInt(minInputJarak.value) >= parseInt(maxInputJarak.value)) {
        //         maxInputJarak.value = minInputJarak.value;
        //     }
        //     updateProgressJarak();
        // });

        // maxInputJarak.addEventListener("input", () => {
        //     if (parseInt(maxInputJarak.value) <= parseInt(minInputJarak.value)) {
        //         minInputJarak.value = maxInputJarak.value;
        //     }
        //     updateProgressJarak();
        // });

        // let isDraggingJarak = false;
        // let startOffsetXJarak;

        // progressJarak.addEventListener("mousedown", (e) => {
        //     e.preventDefault();

        //     isDraggingJarak = true;
        //     startOffsetXJarak = e.clientX - progressJarak.getBoundingClientRect().left;

        //     sliderJarak.classList.toggle("dragging", isDraggingJarak);
        // });

        // document.addEventListener("mousemove", (e) => {
        //     if (isDraggingJarak) {
        //         const sliderRectJarak = sliderJarak.getBoundingClientRect();
        //         const progressWidthJarak = parseFloat(progressJarak.style.width || 0);

        //         let newLeftJarak =
        //             ((e.clientX - sliderRectJarak.left - startOffsetXJarak) / sliderRectJarak.width) * 100;

        //         newLeftJarak = Math.min(Math.max(newLeftJarak, 0), 100 - progressWidthJarak);

        //         progressJarak.style.left = newLeftJarak + "%";

        //         const totalRangeJarak = maxInputJarak.max - minInputJarak.min;
        //         const newMinJarak = Math.round((newLeftJarak / 100) * totalRangeJarak) + parseInt(minInputJarak
        //             .min);
        //         const newMaxJarak = newMinJarak + parseInt(maxInputJarak.value) - parseInt(minInputJarak.value);

        //         minInputJarak.value = newMinJarak;
        //         maxInputJarak.value = newMaxJarak;

        //         updateProgressJarak();
        //     }

        //     sliderJarak.classList.toggle("dragging", isDraggingJarak);
        // });

        // document.addEventListener("mouseup", () => {
        //     if (isDraggingJarak) {
        //         isDraggingJarak = false;
        //     }
        //     sliderJarak.classList.toggle("dragging", isDraggingJarak);
        // });

        // updateProgressJarak();



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

        document.getElementById("formCari").addEventListener("submit", function(e) {

            e.preventDefault(); // tahan submit dulu

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {

                    document.getElementById("lat").value = position.coords.latitude;
                    document.getElementById("lng").value = position.coords.longitude;

                    // submit ulang setelah dapet lokasi
                    e.target.submit();

                }, function(error) {
                    alert("Gagal ambil lokasi, pakai pencarian biasa aja");
                    e.target.submit(); // tetap submit tanpa lokasi
                });
            } else {
                alert("Browser tidak support lokasi");
                e.target.submit();
            }

        });

        // const range = document.getElementById("rangeJarak");
        // const value = document.getElementById("valueJarak");

        // range.addEventListener("input", function() {
        // value.innerText = this.value;
        // });









        // document.addEventListener("DOMContentLoaded", function() {
        // const lat = localStorage.getItem('user_lat');
        // const lng = localStorage.getItem('user_lng');

        // if (lat && lng) {
        // document.getElementById('lat').value = lat;
        // document.getElementById('lng').value = lng;
        // }
        // });


        // function geser(arah) {
        // const slider = document.getElementById("slider");
        // slider.scrollBy({
        // left: arah * 360,
        // behavior: "smooth"
        // });
        // }

        // const slider = document.getElementById("slider");
        // const dotsContainer = document.getElementById("dots");
        // const cards = document.querySelectorAll(".card");

        // // bikin dots
        // cards.forEach((_, i) => {
        // const dot = document.createElement("div");
        // dot.classList.add("dot");
        // if (i === 0) dot.classList.add("active");
        // dotsContainer.appendChild(dot);
        // });

        // // update dot saat geser
        // slider.addEventListener("scroll", () => {
        // const index = Math.round(slider.scrollLeft / cards[0].offsetWidth);
        // document.querySelectorAll(".dot").forEach((dot, i) => {
        // dot.classList.toggle("active", i === index);
        // });
        // });

        // ------
        // const slider = document.getElementById("slider");
        // const cards = document.querySelectorAll(".card");
        // const dotsContainer = document.getElementById("dots");

        // const perPage = 3;
        // const totalPage = Math.ceil(cards.length / perPage);
        // let page = 0;

        // // bikin dots
        // for (let i = 0; i < totalPage; i++) { // const dot=document.createElement("div"); // dot.className = "dot" +
        // (i === 0 ? " active" : ""); // dot.onclick=()=> goToPage(i);
        // dotsContainer.appendChild(dot);
        // }

        // function updateSlider() {
        // slider.style.transform = `translateX(-${page * 100}%)`;
        // document.querySelectorAll(".dot").forEach((d, i) => {
        // d.classList.toggle("active", i === page);
        // });
        // }

        // function next() {
        // if (page < totalPage - 1) { // page++; // updateSlider(); // } // } // function prev() { // if (page> 0) {
        // page--;
        // updateSlider();
        // }
        // }

        // function goToPage(i) {
        // page = i;
        // updateSlider();
        // }
        // ---------

        // const slider = document.getElementById("slider");
        // const card = document.querySelector(".card");
        // let index = 0;

        // function next() {
        // const maxIndex = slider.children.length - 3;
        // if (index < maxIndex) { // index++; // geser(); // } // } // function prev() { // if (index> 0) {
        // index--;
        // geser();
        // }
        // }

        // function geser() {
        // const cardWidth = card.offsetWidth + 20; // 20 = gap
        // slider.style.transform = `translateX(-${index * cardWidth}px)`;
        // }


        // -----------
        // $(document).ready(function() {

        // const itemsPerPage = 3;

        // const owl = $('.bidang-carousel').owlCarousel({
        // loop: true,
        // margin: 20,
        // nav: true,
        // dots: true,
        // items: 3,
        // slideBy: 1, // 👉 panah geser 1–1
        // autoplay: true,
        // autoplayTimeout: 3000,
        // autoplayHoverPause: true
        // });

        // owl.on('changed.owl.carousel', function(event) {
        // const totalItems = event.item.count;
        // const currentIndex = event.item.index - event.relatedTarget._clones.length / 2;

        // const realIndex = (currentIndex + totalItems) % totalItems;

        // const pageIndex = Math.floor(realIndex / itemsPerPage);

        // // reset semua dots
        // $('.owl-dot').removeClass('active');

        // // aktifkan dot sesuai halaman (1–3 / 4–6)
        // $('.owl-dot').eq(pageIndex).addClass('active');
        // });

        // });
    </script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-multiselect@0.9.13/dist/js/bootstrap-multiselect.js"></script>
    <script>
        $(document).ready(function() {
            $('#minimal-multiselect').multiselect();
        });
    </script> --}}

</body>

</html>
