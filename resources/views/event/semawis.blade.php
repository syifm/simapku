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
            width: 1330px;
            border-radius: 7px;
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

    @if (Auth::check())
        @include('layouts.header-wisatawan')
        @include('layouts.sidebar-wisatawan')
    @else
        @include('layouts.header-wisatawan')
        @include('layouts.sidebar-wisatawantidaklogin')
    @endif

    {{-- <div class="pt-[100px] p-28 overflow-y-auto min-h-screen"> --}}
    <div class="pt-[10px] pl-28 pr-[30px] pb-[30px]">
        <div class="mb-8 mt-[10px]">
            <div class="mt-4 relative text-2xl">
                <a onclick="history.back()"
                    class="absolute left-0 top-1/2 -translate-y-1/2 w-10 h-10 
          flex items-center justify-center group cursor-pointer">

                    <span
                        class="absolute inset-0 rounded-full bg-gray-200 
                 scale-0 group-hover:scale-100 
                 duration-50"></span>

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                        stroke="currentColor" class="size-5 relative z-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                </a>

                <h1 class="font-bold text-center">
                    Waroeng Semawis
                </h1>

            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6 mt-6">
            <img src="{{ asset('pasarimlek.jpg') }}" alt="pasarimlek"
                class="w-80 h-60 object-cover transition duration-300 group-hover:scale-100 mx-auto rounded-md">
            <h1 class="text-lg font-bold mt-4">Tentang Waroeng Semawis</h1>
            <p class="text-justify">Waroeng Semawis yang berlokasi tepatnya di Gang Warung ini beroperasi mulai dari
                hari Jumat hingga Minggu pada pukul 18.00 hingga 22.00 WIB. Waroeng semawis ini menyediakan berbagai
                hidangan khas Semarang. Selain itu, fasilitas yang disediakan sangat baik. Terdapat area indoor dan juga
                tersedia Toilet dan Mushola. Di Waroeng Semawis ini juga diadakan berbagai kegiatan-kegiatan seperti
                ketika merayakan Imlek. Ketika menyambut Imlek akan diadakan Pasar Imlek yang dilaksanakan selama 3
                hari. Ketika dilaksanakan Pasar Imlek ini tidak hanya kuliner saja, tetapi terdapat kegiatan lainnya
                seperti performa barongsai.</p>

            <p class="text-justify font-semibold mt-6">Informasi lebih lanjut: <a
                    href="https://www.instagram.com/waroengsemawissemarang/" target="_blank"
                    class="text-blue-400">Instagram
                    Waroeng Semawis</a>
            </p>
            <div id="map" class="mt-4">
            </div>
        </div>


    </div>

    <script>
        let map;
        let marker;

        async function initMap() {
            const defaultPosition = {
                lat: -6.974478157124043,
                lng: 110.42631793156626,
                nama: "Lokasi Waroeng Semawis"
            };

            const infoWindow = new google.maps.InfoWindow();

            const {
                AdvancedMarkerElement
            } = await google.maps.importLibrary("marker");

            // Map
            map = new google.maps.Map(document.getElementById("map"), {
                center: defaultPosition,
                zoom: 16,
                mapId: "5ee8a1d5bfc6676ac1b5f32c",
                clickableIcons: false
            });

            // Marker statis
            marker = new AdvancedMarkerElement({
                map: map,
                position: defaultPosition,
                title: "Lokasi Wisata Kuliner"
            });

            marker.addListener("click", () => {
                infoWindow.setContent(`
                        <div style="font-size:14px;">
                            <b>${defaultPosition.nama}</b><br>
                        </div>
                    `);

                infoWindow.open({
                    anchor: marker,
                    map,
                });
            });
        }
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-gBdR_gqZTd8B6jz3mVJWI-pqC_jPlAI&libraries=marker&callback=initMap&language=in"
        async defer></script>
</body>

</html>
