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

        #map {
            height: 400px;
            width: 400px;
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
                <div class="relative w-full flex justify-center mb-6">
                    <div class="w-full max-w-xl z-20">
                        <div id="searchBar"
                            class="flex items-center w-full max-w-xl border rounded-full overflow-hidden shadow-sm font-medium bg-white">
                            <input type="text" name="keyword" placeholder="Cari Kuliner Disini..." autocomplete="off"
                                class="flex-1 px-5 py-3 focus:outline-none">
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
        <div class="grid grid-cols-12 gap-6">

            <div class="col-span-7">
                @foreach ($data as $kuliner)
                    <div class="p-4 border rounded-lg mb-3 bg-white shadow-sm">
                        <h2 class="text-lg font-bold">{{ $kuliner->nama }}</h2>
                    </div>
                @endforeach
            </div>

            <div class="col-span-5">
                <div class="sticky top-24">
                    <iframe class="w-full h-[600px] rounded-xl border">
                    </iframe>
                    {{-- <div id="map" class="w-full h-[600px] rounded-xl border">
                    </div> --}}
                </div>
            </div>

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

        let mapOptions = {
            center: [51.958, 9.141],
            zoom: 10
        }

        let map = new L.map('map', mapOptions);

        let layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
        map.addLayer(layer);
        let marker = null;
        map.on('click', (event) => {
            if (marker !== null) {
                map.removeLayer(marker);
            }

            marker = L.marker([event.latlng.lat, event.latlng.lng], {
                draggable: true
            }).addTo(map);
            console.log(event);

            document.getElementById('latitude').value = event.latlng.lat;
            document.getElementById('longitude').value = event.latlng.lng;

            marker.on('drag', function(e) {
                let latlng = e.target.getLatLng();
                document.getElementById('latitude').value = latlng.lat;
                document.getElementById('longitude').value = latlng.lng;
            });
        })
    </script>


</body>

</html>
