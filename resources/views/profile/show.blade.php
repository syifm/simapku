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

    @if ($user->peran == 'Wisatawan')
        @include('layouts.header-wisatawan')
    @endif

    @if ($user->peran == 'Admin')
        @include('layouts.sidebar-admin')
    @elseif ($user->peran == 'Wisatawan')
        @include('layouts.sidebar-wisatawan')
    @endif

    @if ($user->peran === 'Admin')
        <div class="pt-[38px] pl-[350px] pr-[50px] pb-[20px]">
        @elseif($user->peran === 'Wisatawan')
            <div class="pt-[20px] pl-28 pr-[30px] pb-[20px]">
    @endif

    <h1 class="text-2xl font-bold mb-8 text-center">Profil</h1>
    @if ($user->peran === 'Admin')
        <div class="flex justify-center mb-6 mt-[70px]">
        @elseif($user->peran === 'Wisatawan')
            <div class="flex justify-center mb-6 mt-10">
    @endif
    <img id="preview"
        src="{{ Auth::user()->foto && file_exists(storage_path('app/public/' . Auth::user()->foto))
            ? asset('storage/' . Auth::user()->foto)
            : asset('profil.png') }}"
        alt="fotoprofil" class="w-40 h-40 object-cover rounded-lg">
    </div>

    @if ($user->peran === 'Admin')
        <div class="flex justify-end mt-[70px] mb-4">
        @elseif($user->peran === 'Wisatawan')
            <div class="flex justify-end mt-4 mb-4">
    @endif
    <a href="{{ route('profile.edit') }}"
        class="py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-white bg-[#FB991A] hover:bg-orange-600 transition duration-300">
        Edit Profil
    </a>
    </div>

    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl">
            <h3 class="text-lg font-semibold mb-4">Data Akun</h3>
            <div class="grid grid-cols-1 gap-6">
                <!-- Nama -->
                <div class="flex items-center">
                    <label class="w-60 text-sm font-medium text-gray-700">Nama</label>
                    <div class="mt-1 ml-4 block w-full">{{ $user->nama }}</div>
                </div>

                <!-- Peran -->
                <div class="flex items-center">
                    <label class="w-60 text-sm font-medium text-gray-700">Peran</label>
                    <div class="mt-1 ml-4 block w-full">{{ $user->peran }}</div>
                </div>

                <!-- Email -->
                <div class="flex items-center">
                    <label class="w-60 text-sm font-medium text-gray-700">Email</label>
                    <div class="mt-1 ml-4 block w-full">{{ $user->email }}</div>
                </div>

                <!-- Preferensi -->
                @if ($wisatawan)
                    <div class="flex items-center">
                        <label class="w-[178px] text-sm font-medium text-gray-700">Preferensi</label>

                        <div class="mt-1 flex flex-wrap gap-2">
                            @foreach ($preferensi as $p)
                                <span class="px-2 py-1 bg-gray-200 text-black rounded-md">
                                    {{ $p->kategori->nama }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>




</body>

</html>
