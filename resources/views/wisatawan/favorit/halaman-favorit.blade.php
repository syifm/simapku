<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIMAPKU | Kuliner Favorit</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/3.0.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
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

        /* #map {
            height: 400px;
            width: 1330px;
            border-radius: 7px;
        } */
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
</head>

<body class="bg-gray-100 text-gray-800">
    {{-- @include('layouts.header-wisatawan') --}}
    @include('layouts.sidebar-wisatawan')
    <div class="min-h-screen overflow-y-auto pt-6 md:pt-10 px-4 md:px-8 lg:px-12 ml-0 md:ml-[280px] lg:ml-[320px]">
        {{-- <div class="pt-[38px] pl-[350px] pr-[50px] pb-[30px] overflow-y-auto min-h-screen"> --}}
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
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
                <div class="mb-12 grid grid-cols-3 items-center text-2xl">
                    {{-- <div class="flex justify-start">
                    </div> --}}

                    @if ($kulinerFavorit->isNotEmpty())
                        <div class="flex justify-start">
                            <h1 class="font-bold">
                                <h1 class="font-bold text-xl -mt-2">Kuliner Favorit</h1>
                            </h1>
                        </div>
                    @endif
                </div>

                @if ($kulinerFavorit->isNotEmpty())
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach ($kulinerFavorit as $favorit)
                            <div class="bg-white shadow rounded-lg hover:shadow-2xl transition"
                                onclick="klikWisataKuliner({{ $favorit->id_wisata_kuliner }})">
                                <img src="{{ $favorit->wisatakuliner->foto ? asset('storage/' . $favorit->wisatakuliner->foto) : asset('storage/tidakadafoto.jpg') }}"
                                    class="w-full h-48 object-cover rounded-t-lg">

                                <div class="p-4">
                                    <div class="flex justify-between items-start">
                                        <h2 class="font-bold text-lg">
                                            {{ $favorit->wisatakuliner->nama }}
                                        </h2>

                                        {{-- <form action="{{ route('favorit.hapusdarilist') }}" method="POST"
                                            onsubmit="return confirm('Hapus dari favorit?')">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id_wisata_kuliner"
                                                value="{{ $favorit->id_wisata_kuliner }}">

                                            <button type="submit" class="text-red-500 hover:text-red-700 mt-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor"
                                                    class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </form> --}}
                                        {{-- <form action="{{ route('favorit.hapusdarilist') }}" method="POST"
                                            class="form-hapus">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id_wisata_kuliner"
                                                value="{{ $favorit->id_wisata_kuliner }}">

                                            <button type="button"
                                                class="btn-hapus p-1 rounded-full hover:bg-red-100 text-red-500 mt-[3px]">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor"
                                                    class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </form> --}}
                                        <button type="button"
                                            onclick="klikHapus(event, {{ $favorit->id_wisata_kuliner }}, '{{ $favorit->wisatakuliner->nama }}')"
                                            class="btn-hapus p-1 rounded-full hover:bg-gray-200 mt-[3px]">
                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.7" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg> --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="black"
                                                stroke="none" class="w-4 h-4">
                                                <path
                                                    d="M7.493 18.5c-.425 0-.82-.236-.975-.632A7.48 7.48 0 0 1 6 15.125c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75A.75.75 0 0 1 15 2a2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23h-.777ZM2.331 10.727a11.969 11.969 0 0 0-.831 4.398 12 12 0 0 0 .52 3.507C2.28 19.482 3.105 20 3.994 20H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 0 1-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227Z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <p class="text-gray-500 text-xs mt-1">
                                        Ditambahkan pada
                                        {{ \Carbon\Carbon::parse($favorit->waktu_dibuat)->format('d.m.Y') }}
                                    </p>

                                    {{-- @if ($favorit->komentar)
                                        <p class="text-sm mt-2 text-justify">
                                            {{ $favorit->komentar }}
                                        </p>
                                    @endif --}}

                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex justify-center items-center min-h-[70vh]">
                        <div class="bg-white p-6 md:p-10 max-w-xl rounded-lg shadow-lg text-center">
                            <div class="flex flex-col items-center">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-[#FFA319]">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                    </svg>
                                </div>

                                <h2 class="text-2xl font-bold text-[#FFA319] mt-4">Kuliner Favorit Belum Tersedia
                                </h2>
                                <p class="text-gray-700">Silakan cari wisata kuliner terlebih dahulu dan tambahkan ke
                                    favorit untuk mendapatkan rekomendasi kuliner selanjutnya yang memiliki kesamaan
                                    dengan wisata kuliner yang difavoritkan</p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- <div id="detailModal"
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
                </div> --}}
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
                showError('Format dokumen tidak sesuai.');
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
                            mapId: "b434fd3b6bf402cdbbb8f248",
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
        }

        function tutupDetailKuliner() {
            document.getElementById('detailKuliner').classList.add('hidden');
        }

        function klikHapus(event, id, nama) {
            event.stopPropagation();
            Swal.fire({
                title: "Hapus dari Kuliner Favorit?",
                html: `<b>Wisata Kuliner:</b> ${nama}`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {

                if (!result.isConfirmed) return;

                fetch(`/wisatawan/favorit/hapus/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        Swal.fire({
                            icon: data.status,
                            title: data.title,
                            text: data.text,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });
                    });
            });
        }
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1G3FTNQXli1ZHjZNQNIpzOl_AcGNHctU&libraries=maps,marker&v=weekly&language=in"
        async defer></script>
</body>

</html>
