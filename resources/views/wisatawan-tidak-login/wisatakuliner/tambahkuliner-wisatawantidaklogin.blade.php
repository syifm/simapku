<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAPKU | Tambah Wisata Kuliner</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        label {
            text-align: left;
        }

        .file-input-wrapper {
            display: flex;
            align-items: center;
            max-width: 300px;
        }

        .file-input-wrapper input[type="file"] {
            border: none;
            padding-top: 0.5rem;
            flex-grow: 1;
        }

        .hidden {
            display: none;
        }

        #map {
            height: 400px;
            width: 1330px;
            border-radius: 7px;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">
    @include('layouts.header-wisatawan')
    @include('layouts.sidebar-wisatawantidaklogin')
    <div class="pt-[10px] pl-28 pr-[30px] pb-[30px]">
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2000,
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    showConfirmButton: false,
                    timer: 2000,
                });
            </script>
        @endif

        <!-- Konten -->
        <div class="flex-1 flex flex-col">
            <div class="flex-1">
                <div class="bg-white ml-[350px] mt-[120px] p-10 max-w-2xl mx-auto rounded-lg shadow-lg text-center">
                    <div class="flex flex-col items-center">
                        <div
                            class="relative w-20 h-20 flex items-center justify-center bg-red-200 rounded-full shadow-md">
                            <svg class="w-12 h-12 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>

                        <h2 class="text-2xl font-bold text-red-600 mt-4">Mohon Maaf Halaman Tidak Dapat Diakses</h2>
                        <p class="text-gray-700 mt-2">Mohon login terlebih dahulu untuk mengakses halaman ini.</p>
                        <a href="{{ route('login') }}"
                            class="bg-[#FB991A] text-white font-bold py-2 px-4 rounded-lg hover:bg-orange-600 mt-5">
                            Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
