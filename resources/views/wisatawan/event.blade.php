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

    @include('layouts.header-wisatawan')
    @include('layouts.sidebar-wisatawan')

    {{-- <div class="pt-[100px] p-28 overflow-y-auto min-h-screen"> --}}
    <div class="pt-[10px] pl-28 pr-[30px] pb-[30px]">
        <div class="mb-8 mt-[10px]">

            {{-- <p class="text-2xl text-black font-bold mt-4 mb-4">
                Event Semarang
            </p> --}}
            <div class="flex justify-center text-2xl">
                <h1 class="font-bold">
                    Dugderan
                </h1>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6 mt-6">
            <img src="{{ asset('dugderan.jpg') }}" alt="dugderan"
                class="w-60 h-60 object-cover transition duration-300 group-hover:scale-100 mx-auto rounded-md">
            <h1 class="text-lg font-bold mt-4">Sejarah</h1>
            <p class="text-justify">Dugderan adalah tradisi perayaan untuk menyambut bulan Ramadhan oleh masyarakat
                Semarang. Dugderan
                berasal dari 'dug' dari suara bedug sebagai penanda masuknya bulan Ramadhan dan 'der' dari suara meriam
                yang menandakan datangnya Idul Fitri, yang kemudian disebutlah Dugderan. Di tradisi ini terdapat
                maskotnya yaitu Warak Ngendog. Warak ngendong adalah binatang rekaan bertubuh kambing, berkepala naga,
                bersisik yang terbuat dari kertas warna-warni, dan dilengkapi dengan 'endog' yaitu telur rebus. Warak
                Ngendong ini mengandung arti warak yang sedang bertelur, dimana dahulu sedang terjadi krisis pangan di
                masyarakat dan telur menjadi makanan yang mewah.</p>
            <h1 class="text-lg font-bold mt-4">Pelaksanaan</h1>
            <h2 class="font-bold mt-1">Pasar Dugderan</h2>
            <p class="text-justify">Pertama, akan dilaksanakan Pasar
                Dugderan. Di Pasar Dugderan ini terdapat wahana permainan, bazar UMKM yang menyediakan kuliner, pakaian,
                hingga mainan. Serta, terdapat pertunjukan budaya khas Dugderan. Pasar Dugderan dilaksanakan selama
                kurang lebih 10 hari menjelang bulan Ramadhan di Alun-Alun Masjid Agung Kota Semarang yang terletak di
                dekat Pasar Johar dan Masjid Kauman.</p>
            <h2 class="font-bold mt-1">Kirab Budaya dan Pengumuman Awal Puasa</h2>
            <p class="text-justify">Kemudian akan dilakukan kirab budaya dimana ditampilkan tari-tarian termasuk tarian
                Warak Ngendong. Kirab budaya ini dimulai dari Balaikota Semarang hingga berakhir di Masjid Agung Kota
                Semarang. Kemudian akan dilakukan pengumuman awal bulan Ramadhan ditandai dengan pemukulan bedug dan
                diakhiri dengan doa bersama.</p>
        </div>
    </div>




</body>

</html>
