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

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
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
        <div class="flex flex-col items-center gap-2 -ml-12">
            <div>
                <p class="text-m text-black font-medium mt-2">
                    Ingin memasukkan kuliner yang Anda ketahui?
                    <a href="{{ route('tambahwisatakuliner') }}" class="text-[#FFA319]  hover:underline">
                        Tambah Kuliner
                    </a>
                </p>
            </div>

            <form action="{{ route('wisatakulinerhalaman') }}" method="GET">
                <div class="relative w-full flex justify-center">

                    <div class="absolute top-4 w-full max-w-3xl z-50 ml-[190px]">
                        <div id="searchBar"
                            class="flex items-center w-full max-w-xl border rounded-full overflow-hidden shadow-sm font-medium">
                            <input type="text" name="keyword" placeholder="Cari Kuliner Disini..." autocomplete="off"
                                class="flex-1 px-5 py-3 focus:outline-none">
                            <button class="bg-[#FFA319] px-4 py-3 text-white hover:bg-[#F19305] transition">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </div>

                        <div id="searchPanel"
                            class="hidden left-0 w-full max-w-xl mt-2 bg-white rounded-2xl shadow-lg p-4 z-50">

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

                                {{-- <input type="number" name="jarak" placeholder="Jarak (km)" class="w-full border rounded-lg p-2"> --}}

                                {{-- <input type="number" name="harga" placeholder="Harga Maksimal"
                                class="w-full border rounded-lg p-2"> --}}

                                {{-- <select class="w-full border rounded-lg p-2" name="jenis">
                                <option>Jenis Makanan</option>
                                <option>Bakso</option>
                                <option>Soto</option>
                                <option>Seafood</option>
                            </select> --}}

                                <select class="w-full border rounded-lg p-2" name="rating">
                                    <option>Rating Minimal</option>
                                    <option>⭐ 3+</option>
                                    <option>⭐ 4+</option>
                                    <option>⭐ 4.5+</option>
                                </select>

                                {{-- <select class="w-full border rounded-lg p-2" name="fasilitas[]" multiple>
                                <option>Fasilitas</option>
                                <option>Wifi</option>
                                <option>Parkir</option>
                                <option>AC</option>
                            </select> --}}

                                <input type="checkbox" name="fasilitas[]" value="1"> Wifi
                                <input type="checkbox" name="fasilitas[]" value="2"> Parkir
                                <input type="checkbox" name="fasilitas[]" value="3"> AC

                                <button class="w-full bg-orange-500 text-white p-2 rounded-lg">
                                    Cari
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div>
            @foreach ($data as $kuliner)
                <div class="p-4 border rounded-lg mb-3">
                    <h2 class="text-lg font-bold">{{ $kuliner->nama }}</h2>
                    {{-- <p>Rating: ⭐ {{ $kuliner->penilaian }}</p> --}}
                </div>
            @endforeach
        </div>

        <div class="mb-8 mt-[85px]">
            <p class="text-lg text-black font-bold mt-4 mb-4">
                Event Semarang
            </p>
            <div class="grid grid-cols-4 gap-8">
                {{-- <a href="{{ route('event') }}"
                    class="relative inline-block group w-80 h-40 rounded-xl overflow-hidden group">
                    <img src="{{ asset('dugderan.jpg') }}" alt="dugderan"
                        class="w-full h-full object-cover transition duration-300 group-hover:scale-100">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition duration-300"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-white font-semibold text-lg">
                            Dugderan
                        </span>
                    </div>
                </a> --}}
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
                {{-- <a href="{{ route('event') }}"
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
                </a> --}}
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


        <a href="{{ route('map-WisataKuliner') }}" class="text-[#FFA319]  hover:underline">
            Map Wisata Kuliner
        </a>

        <a href="{{ route('map-WisataKuliner2') }}" class="text-[#FFA319]  hover:underline">
            Map Wisata Kuliner 2
        </a>
    </div>


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
    </script>


</body>

</html>
