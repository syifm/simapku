<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAPKU | Diari Kuliner</title>
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
            /* overflow: hidden; */
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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
</head>

<body class="bg-gray-100 text-gray-800">
    @include('layouts.header-wisatawan')
    @include('layouts.sidebar-wisatawan')
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
                <div class="mt-2 mb-6 grid grid-cols-3 items-center text-2xl">
                    <div class="flex justify-start">
                    </div>

                    <div class="flex justify-center">
                        <h1 class="font-bold">
                            Diari Kuliner
                        </h1>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('diarikuliner.tambah') }}"
                            class="bg-[#FFA319] hover:bg-[#F19305] btn btn-primary text-white rounded-lg px-2 py-2 text-sm flex items-center transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </a>
                    </div>
                </div>

                @if ($diariKuliner->isNotEmpty())
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ($diariKuliner as $diari)
                            <div class="bg-white shadow rounded-lg cursor-pointer hover:shadow-2xl transition"
                                onclick="showDetail({{ $diari->id_diari_kuliner }})">
                                <img src="{{ asset('storage/' . $diari->foto) }}"
                                    class="w-full h-48 object-cover rounded-lg">

                                <div class="p-4">
                                    <div class="grid grid-cols-[2fr_16px]">
                                        <h2 class="font-bold text-lg">
                                            {{ $diari->judul }}
                                        </h2>

                                        <div class="relative inline-block">
                                            <button
                                                onclick="event.stopPropagation(); toggleMenu({{ $diari->id_diari_kuliner }})"
                                                class="text-2xl font-bold">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                                </svg>
                                            </button>

                                            <div id="menu-{{ $diari->id_diari_kuliner }}"
                                                onclick="event.stopPropagation()"
                                                class="hidden absolute right-0 mt-2 w-[120px] bg-white rounded-lg overflow-hidden border border-gray-300 shadow-lg z-50">

                                                <a href="/wisatawan/diarikuliner/edit/{{ $diari->id_diari_kuliner }}"
                                                    class="px-2 w-full flex items-center justify-left gap-2 py-2 hover:bg-gray-100 text-[#FFA319] border-b border-gray-300">
                                                    <div class="grid grid-cols-2"></div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                        class="size-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                    </svg>
                                                    <span>Edit</span>
                                                </a>

                                                <form
                                                    action="/wisatawan/diarikuliner/hapus/{{ $diari->id_diari_kuliner }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-4 w-full flex items-center justify-left gap-2 py-2 hover:bg-gray-100 text-red-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor"
                                                            class="size-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>
                                                        <span>Hapus</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <p class="text-gray-500 text-xs">
                                        {{ \Carbon\Carbon::parse($diari->waktu_diubah)->format('d.m.Y') }}
                                    </p>

                                    <p class="text-sm mt-2 text-justify">
                                        {{ Str::limit($diari->deskripsi, 150) }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white ml-[415px] mt-24 p-10 max-w-xl mx-auto rounded-lg shadow-lg text-center">
                        <div class="flex flex-col items-center">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-[#FFA319]">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                </svg>
                            </div>

                            <h2 class="text-2xl font-bold text-[#FFA319] mt-4">Diari Kuliner Anda Belum Tersedia
                            </h2>
                            <p class="text-gray-700">Silakan buat diari kuliner Anda!</p>

                            <a href="{{ route('diarikuliner.tambah') }}"
                                class="bg-[#FFA319] hover:bg-[#F19305] btn btn-primary text-white rounded-full mt-2 px-4 py-2 text-sm flex items-center transition">
                                <span>Tambah Diari Kuliner</span>
                            </a>
                        </div>
                    </div>
                @endif

                <div id="detailModal"
                    class="fixed left-[90px] right-0 top-20 bottom-0 bg-black bg-opacity-40 hidden overflow-y-auto">
                    <div class="relative top-20 mx-auto p-5 border w-[450px] shadow-lg rounded-xl bg-white">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold flex-1 text-center" id="modalTitle"></h3>
                            <div class="gap-20">
                                <button onclick="closeModal()" class="text-gray-600 hover:text-gray-700">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="mt-4">
                            {{-- <div class="flex text-xs justify-center items-center"> --}}
                            <div class="grid grid-row-3">
                                <div class="flex justify-center">
                                    <img id="foto" src="" alt="Foto Wisata Kuliner"
                                        class="w-full h-40 object-cover rounded-md border hidden">
                                </div>

                                <div class="flex justify-left mt-4 font-bold text-md">
                                    <span id="judul"></span>
                                </div>

                                <div class="flex justify-left text-gray-500 text-xs mt-1">
                                    <span id="waktu_diubah"></span>
                                </div>

                                <div class="flex text-sm mt-4">
                                    <div class="text-justify"><span id="deskripsi"></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    .fade-in {
                        animation: fadeIn 1.5s ease-in-out forwards;
                    }

                    @keyframes fadeIn {
                        0% {
                            opacity: 0;
                            transform: translateY(10px);
                        }

                        100% {
                            opacity: 1;
                            transform: translateY(0);
                        }
                    }
                </style>
            </div>
        </div>
    </div>

    <script>
        // Foto 
        const fotoInput = document.getElementById('foto');
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

        function removeFoto() {
            resetInput();
            fotoError.classList.add('hidden');
            previewWrapper.classList.add('hidden');
        }

        function showDetail(id) {
            fetch(`/wisatawan/diarikuliner/detail/${id}`)
                .then(response => response.json())
                .then(data => {

                    // let tanggal = new Date(data.waktu_diubah);

                    // let formatted =
                    //     String(tanggal.getDate()).padStart(2, '0') + '.' +
                    //     String(tanggal.getMonth() + 1).padStart(2, '0') + '.' +
                    //     tanggal.getFullYear();
                    // document.getElementById('modalTitle').textContent = data.judul;
                    document.getElementById('waktu_diubah').textContent = data.waktu_diubah;
                    document.getElementById('judul').textContent = data.judul;
                    document.getElementById('deskripsi').textContent = data.deskripsi;
                    const foto = document.getElementById('foto');

                    if (data.foto) {
                        foto.src = `/storage/${data.foto}`;
                        foto.classList.remove('hidden');
                    } else {
                        foto.classList.add('hidden');
                    }

                    document.getElementById('detailModal').classList.remove('hidden');
                });
        }

        function closeModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }

        function toggleMenu(id) {
            let menu = document.getElementById('menu-' + id);
            menu.classList.toggle('hidden');
        }

        document.addEventListener('click', function(e) {
            if (!e.target.closest('.relative')) {
                document.querySelectorAll('[id^="menu-"]').forEach(menu => {
                    menu.classList.add('hidden');
                });
            }
        });
    </script>
</body>

</html>
