<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAPKU | Riwayat Pengajuan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
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
                title: 'Berhasil',
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

    @if (session('info'))
        <script>
            Swal.fire({
                icon: 'info',
                title: 'Info',
                text: "{{ session('info') }}",
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    @include('layouts.header-wisatawan')
    @include('layouts.sidebar-wisatawan')
    <div class="pt-[10px] pl-28 pr-[30px] pb-[30px]">
        <div class="flex-1 flex flex-col">
            <div class="flex-1">
                <div class="mt-2 mb-6 grid grid-cols-3 items-center text-2xl">
                    <div class="flex justify-start">
                    </div>

                    <div class="flex justify-center">
                        <h1 class="font-bold">
                            Riwayat Pengajuan
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="ml-1 mr-1 -mt-4">
            <div class="flex w-full border-b mb-4">
                <button id="tabKuliner"
                    class="tab-btn flex-1 px-4 py-3 text-center border-b-2 border-[#004440] text-[#004440] font-semibold">
                    Wisata Kuliner
                </button>

                <button id="tabUlasan" class="tab-btn flex-1 px-4 py-3 text-center text-gray-500">
                    Ulasan
                </button>
            </div>
            <div class="flex-1 overflow-hidden ml-1 w-full">
                <div class="bg-white-100 pt-0">
                    <div id="contentKuliner">
                        @if (!$statuswisatakuliner)
                            <div class="bg-white rounded-lg mt-4">
                                <table class="table-fixed w-full border-collapse border border-black">
                                    <colgroup>
                                        <col style="width: 30px">
                                        <col style="width: 140px">
                                        <col style="width: 60px">
                                        <col style="width: 70px">
                                        <col style="width: 150px">
                                    </colgroup>

                                    <thead>
                                        <tr>
                                            <th
                                                class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                                                No
                                            </th>
                                            <th
                                                class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                                                Wisata Kuliner
                                            </th>
                                            <th
                                                class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                                                Status
                                            </th>
                                            <th
                                                class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                                                Update Terakhir
                                            </th>
                                            <th
                                                class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        <tr>
                                            <td colspan="5" style="text-align: center"
                                                class="px-4 py-3 text-sm text-black">
                                                Belum Tersedia Wisata Kuliner</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="bg-white rounded-lg mt-4">
                                <table class="table-fixed w-full border-collapse border-b-0 border-black">
                                    <colgroup>
                                        <col style="width: 30px">
                                        <col style="width: 140px">
                                        <col style="width: 60px">
                                        <col style="width: 70px">
                                        <col style="width: 150px">
                                    </colgroup>

                                    <thead>
                                        <tr>
                                            <th
                                                class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                                                No
                                            </th>
                                            <th
                                                class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                                                Wisata Kuliner
                                            </th>
                                            <th
                                                class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                                                Status
                                            </th>
                                            <th
                                                class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                                                Update Terakhir
                                            </th>
                                            <th
                                                class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        @foreach ($wisataKuliner as $kuliner)
                                            <tr class="hover:bg-gray-50">
                                                <td
                                                    class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                                                    {{ $kuliner->nomor }}
                                                </td>
                                                <td
                                                    class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                                                    {{ $kuliner->nama }}
                                                </td>
                                                <td
                                                    class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                                                    {{ $kuliner->status }}
                                                </td>
                                                <td
                                                    class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                                                    {{ \Carbon\Carbon::parse($kuliner->waktu_diubah)->format('d/m/Y H:i') }}
                                                </td>
                                                <td
                                                    class="px-4 py-3 text-sm border-b border-r border-black flex justify-center gap-2">
                                                    <button
                                                        onclick="tampilkanModalKuliner({{ $kuliner->id_wisata_kuliner }})"
                                                        class="bg-[#004440] hover:bg-[#06362a] text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor"
                                                            class="size-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                                        </svg>
                                                        <span class="ml-1">Detail</span>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-4">
                                {{ $wisataKuliner->links('pagination::tailwind') }}
                            </div>
                        @endif


                    </div>


                    <div id="contentUlasan" class="hidden">
                        @if (!$statusUlasan)
                            <div class="bg-white rounded-lg mt-4">
                                <table class="table-fixed w-full border-collapse border border-black">
                                    <colgroup>
                                        <col style="width: 35px">
                                        <col style="width: 200px">
                                        <col style="width: 150px">
                                        <col style="width: 100px">
                                        <col style="width: 80px">
                                    </colgroup>

                                    <thead>
                                        <tr>
                                            <th
                                                class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                                                No
                                            </th>
                                            <th
                                                class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                                                Wisata Kuliner
                                            </th>
                                            <th
                                                class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                                                Ulasan
                                            </th>
                                            <th
                                                class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                                                Status Verifikasi
                                            </th>
                                            <th
                                                class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        <tr>
                                            <td colspan="5" style="text-align: center"
                                                class="px-4 py-3 text-sm text-black">
                                                Belum Tersedia Penilaian dan Ulasan Wisata Kuliner</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="bg-white rounded-lg mt-4">
                                <table class="table-fixed w-full border-collapse border-b-0 border-black">
                                    <colgroup>
                                        <col style="width: 35px">
                                        <col style="width: 200px">
                                        <col style="width: 150px">
                                        <col style="width: 90px">
                                        <col style="width: 150px">
                                    </colgroup>

                                    <thead>
                                        <tr>
                                            <th
                                                class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                                                No
                                            </th>
                                            <th
                                                class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                                                Wisata Kuliner
                                            </th>
                                            <th
                                                class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                                                Ulasan
                                            </th>
                                            <th
                                                class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                                                Status Verifikasi
                                            </th>
                                            <th
                                                class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        @foreach ($penilaianDanUlasan as $ulasan)
                                            <tr class="hover:bg-gray-50">
                                                <td
                                                    class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                                                    {{ $ulasan->nomor }}
                                                </td>
                                                <td
                                                    class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                                                    {{ $ulasan->wisataKuliner->nama }}
                                                </td>
                                                <td
                                                    class="px-4 py-3 text-sm text-gray-900 border border-black text-justify">
                                                    {{ \Illuminate\Support\Str::limit($ulasan->ulasan, 50) }}
                                                </td>
                                                <td
                                                    class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                                                    {{ $ulasan->status }}
                                                </td>
                                                <td
                                                    class="px-4 py-3 text-sm border-b border-r border-black flex justify-center gap-2">
                                                    <button
                                                        onclick="tampilkanModalUlasan({{ $ulasan->id_penilaian_dan_ulasan }})"
                                                        class="bg-[#004440] hover:bg-[#06362a] text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.7"
                                                            stroke="currentColor" class="size-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                                        </svg>
                                                        <span class="ml-1">Detail</span>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-4">
                                {{ $penilaianDanUlasan->links('pagination::tailwind') }}
                            </div>
                        @endif
                    </div>

                    <div id="detailModalUlasan"
                        class="fixed left-[300px] right-0 top-0 bottom-0 bg-black bg-opacity-40 hidden overflow-y-auto">
                        <div class="relative top-20 mx-auto p-5 border w-[500px] shadow-lg rounded-xl bg-white">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold flex-1 text-center" id="modalTitle">Penilaian dan
                                    Ulasan</br></h3>
                                <button onclick="tutupModalUlasan()" class="text-gray-400 hover:text-gray-500">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <div class="mt-4">
                                <div class="grid grid-cols-2 gap-2 text-xs">
                                    <div class="flex justify-between w-32">
                                        <strong>Nilai</strong>
                                    </div>
                                    <div class="grid grid-cols-[8px_2fr] gap-1 -ml-10">
                                        <div>:</div>
                                        <div class="text-justify"><span id="nilai"></span></div>
                                    </div>

                                    <div class="flex justify-between w-32">
                                        <strong>Ulasan</strong>
                                    </div>
                                    <div class="grid grid-cols-[8px_2fr] gap-1 -ml-10">
                                        <div>:</div>
                                        <div class="text-justify"><span id="ulasan"></span></div>
                                    </div>

                                    <div class="flex justify-between w-32">
                                        <strong>Email Pengulas</strong>
                                    </div>
                                    <div class="grid grid-cols-[8px_2fr] gap-1 -ml-10">
                                        <div>:</div>
                                        <div class="text-justify"><span id="email_pengulas"></span></div>
                                    </div>

                                    <div class="flex justify-between w-32">
                                        <strong>Harga</strong>
                                    </div>
                                    <div class="grid grid-cols-[8px_2fr] gap-1 -ml-10">
                                        <div>:</div>
                                        <div class="text-justify"><span id="harga"></span></div>
                                    </div>

                                    <div class="flex justify-between w-32">
                                        <strong>Foto</strong>
                                    </div>
                                    <div class="grid grid-cols-[8px_2fr] gap-1 -ml-10">
                                        <div>:</div>
                                        <div class="text-justify">
                                            <div id="foto_container"><img id="foto_ulasan" /></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="detailModalKuliner"
                        class="fixed left-[300px] right-0 top-0 bottom-0 bg-black bg-opacity-40 hidden overflow-y-auto">
                        <div
                            class="relative top-5 bottom-5 mx-auto p-5 border w-[500px] shadow-lg rounded-xl bg-white">
                            <div class="relative">
                                <button onclick="tutupModalKuliner()"
                                    class="absolute right-0 top-0 text-gray-400 hover:text-gray-500">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>

                                <div class="text-center">
                                    <h3 class="text-lg font-semibold" id="modalTitle"></h3>
                                    <div id="ratingStars" class="text-sm text-yellow-400 mt-1"></div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <div class="grid grid-cols-2 gap-2 text-xs">
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
                                        <strong>Email</strong>
                                    </div>
                                    <div class="grid grid-cols-[8px_2fr] gap-1 -ml-10">
                                        <div>:</div>
                                        <div class="text-justify"><span id="email"></span></div>
                                    </div>

                                    <div class="flex justify-between w-32">
                                        <strong>Harga</strong>
                                    </div>
                                    <div class="grid grid-cols-[8px_2fr] gap-1 -ml-10">
                                        <div>:</div>
                                        <div class="text-justify"><span id="harga"></span></div>
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
                                        <strong>Email Pengaju</strong>
                                    </div>
                                    <div class="grid grid-cols-[8px_2fr] gap-1 -ml-10">
                                        <div>:</div>
                                        <div class="text-justify"><span id="email_pengaju"></span></div>
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
            </div>
        </div>

        @push('styles')
            <style>
                .container {
                    max-width: 1200px;
                    margin-left: 20px;
                    margin-right: 20px;
                }

                .hidden {
                    display: none;
                }
            </style>
        @endpush

        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1G3FTNQXli1ZHjZNQNIpzOl_AcGNHctU&libraries=maps,marker&v=weekly&language=in"
            async defer></script>
        <script>
            const tabKuliner = document.getElementById('tabKuliner');
            const tabUlasan = document.getElementById('tabUlasan');

            const contentKuliner = document.getElementById('contentKuliner');
            const contentUlasan = document.getElementById('contentUlasan');

            tabKuliner.addEventListener('click', () => {
                contentKuliner.classList.remove('hidden');
                contentUlasan.classList.add('hidden');

                tabKuliner.classList.add('border-b-2', 'border-[#004440]', 'text-[#004440]');
                tabUlasan.classList.remove('border-b-2', 'border-[#004440]', 'text-[#004440]');
            });

            tabUlasan.addEventListener('click', () => {
                contentUlasan.classList.remove('hidden');
                contentKuliner.classList.add('hidden');

                tabUlasan.classList.add('border-b-2', 'border-[#004440]', 'text-[#004440]');
                tabKuliner.classList.remove('border-b-2', 'border-[#004440]', 'text-[#004440]');
            });

            let map = null;
            let marker = null;

            function tampilkanModalKuliner(id) {
                fetch(`/wisatawan/riwayatpengajuan/detail/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('modalTitle').textContent = data.nama;
                        document.getElementById('alamat').textContent = data.alamat;
                        document.getElementById('kecamatan').textContent = data.kecamatan;
                        document.getElementById('kelurahan').textContent = data.kelurahan;
                        document.getElementById('nomor_telepon').textContent = data.no_telp;
                        document.getElementById('email').textContent = data.email ?? '-';
                        document.getElementById('deskripsi').textContent = data.deskripsi;
                        document.getElementById('latitude').textContent = data.latitude;
                        document.getElementById('longitude').textContent = data.longitude;
                        document.getElementById('email_pengaju').textContent = data.email_pengaju;
                        const foto = document.getElementById('foto');

                        if (data.foto) {
                            foto.src = `/storage/${data.foto}`;
                            foto.classList.remove('hidden');
                        } else {
                            foto.classList.add('hidden');
                        }

                        const lat = parseFloat(data.latitude);
                        const lng = parseFloat(data.longitude);

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

                        document.getElementById('detailModalKuliner').classList.remove('hidden');

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

            function tampilkanModalUlasan(id) {
                fetch(`/wisatawan/riwayatpengajuan/detail/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('modalTitle').textContent = data.wisata_kuliner.nama;
                        document.getElementById('nilai').textContent = data.penilaian;
                        document.getElementById('ulasan').textContent = data.ulasan;
                        document.getElementById('email_pengulas').textContent = data.email_pengulas;

                        // Harga
                        let min = data.harga_min ?? 0;
                        let max = data.harga_max ?? 0;

                        let text = '';

                        if (min == 0) {
                            if (max == 0) {
                                text = '-';
                            } else {
                                text = `≤ Rp ${max.toLocaleString('id-ID')}`;
                            }
                        } else {
                            if (min == 500000) {
                                text = `Rp ${min.toLocaleString('id-ID')}+`;
                            } else {
                                text = `Rp ${min.toLocaleString('id-ID')} - ${max.toLocaleString('id-ID')}`;
                            }
                        }

                        document.getElementById('harga').textContent = text;

                        // Foto
                        // const foto_ulasan = document.getElementById('foto_ulasan');

                        // if (data.foto_ulasan) {
                        //     foto_ulasan.src = `/storage/${data.foto_ulasan}`;
                        //     foto_ulasan.classList.remove('hidden');
                        // } else {
                        //     foto_ulasan.classList.add('hidden');
                        // }
                        const container = document.getElementById('foto_container');

                        if (data.foto_ulasan) {
                            container.innerHTML =
                                `<img src="/storage/${data.foto_ulasan}" class="object-cover rounded">`;
                        } else {
                            container.innerHTML = `<span>-</span>`;
                        }

                        document.getElementById('detailModalUlasan').classList.remove('hidden');
                    });
            }

            function tutupModalKuliner() {
                document.getElementById('detailModalKuliner').classList.add('hidden');
            }

            function tutupModalUlasan() {
                document.getElementById('detailModalUlasan').classList.add('hidden');
            }
        </script>
</body>

</html>
