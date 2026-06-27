<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAPKU | Kelola Wisata Kuliner</title>
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

    @php
        $activeTab = request('tab', 'wisatakuliner');
    @endphp

    @include('layouts.sidebar-admin')
    <div class="pt-[38px] pl-[350px] pr-[50px] pb-[30px] overflow-y-auto min-h-screen">
        <h1 class="font-bold text-xl -mt-2">Kelola Wisata Kuliner</h1>
        {{-- <div class="flex-1 flex flex-col">

        </div> --}}
        <div class="ml-1 mr-1 mt-12">
            <div class="flex w-full border-b">
                <button id="tabKuliner"
                    class="tab-btn flex-1 px-4 py-3 text-center border-b-2 font-semibold {{ $activeTab === 'wisatakuliner' ? 'border-[#004440]' : 'border-[#d8d8d8]' }}">
                    Wisata Kuliner
                </button>
                <button id="tabKategori"
                    class="tab-btn flex-1 px-4 py-3 text-center border-b-2 font-semibold {{ $activeTab === 'kategori' ? 'border-[#004440]' : 'border-[#d8d8d8]' }}">
                    Kategori
                </button>
                <button id="tabFasilitas"
                    class="tab-btn flex-1 px-4 py-3 text-center border-b-2 font-semibold {{ $activeTab === 'fasilitas' ? 'border-[#004440]' : 'border-[#d8d8d8]' }}">
                    Fasilitas
                </button>
            </div>
            <div class="flex-1 overflow-hidden ml-1 w-full">
                <div class="bg-white-100 pt-0">
                    <div id="contentKuliner" class="{{ $activeTab === 'wisatakuliner' ? '' : 'hidden' }}">
                        <div class="flex justify-end">
                            <a href="#" onclick="klikTambahWKuliner(event)"
                                class="bg-[#FFA319] hover:bg-[#F19305]
                                btn btn-primary text-white rounded-full px-4 py-2 mt-6 text-sm flex items-center gap-1 transition mb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="3" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>

                                <span>Tambah</span>
                            </a>
                        </div>
                        @if ($wisataKuliner->isEmpty())
                            <div class="bg-white mt-4 overflow-x-auto">
                                <table class="w-full table-auto border-collapse border border-black"
                                    id="tabelWisataKuliner">
                                    {{-- <colgroup>
                                        <col style="width: 30px">
                                        <col style="width: 140px">
                                        <col style="width: 70px">
                                        <col style="width: 70px">
                                        <col style="width: 160px">
                                    </colgroup> --}}

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
                            <div class="bg-white mt-4 overflow-x-auto">
                                <table class="w-full table-auto border-collapse border-b-0 border-black"
                                    id="tabelWisataKuliner">
                                    {{-- <colgroup>
                                        <col style="width: 30px">
                                        <col style="width: 140px">
                                        <col style="width: 70px">
                                        <col style="width: 70px">
                                        <col style="width: 160px">
                                    </colgroup> --}}

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
                                                <td class="px-4 py-3 text-sm text-gray-900 border border-black">
                                                    {{ $kuliner->nama }}
                                                </td>
                                                <td
                                                    class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                                                    {{ $kuliner->status_operasional }}
                                                </td>
                                                <td
                                                    class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                                                    {{ \Carbon\Carbon::parse($kuliner->waktu_diubah)->format('d/m/Y H:i') }}
                                                </td>
                                                <td
                                                    class="px-4 py-3 text-sm border-b border-r border-black justify-center gap-2">
                                                    <div class="flex justify-center gap-2">
                                                        <button
                                                            onclick="klikDetailWKuliner({{ $kuliner->id_wisata_kuliner }})"
                                                            class="bg-[#004440] hover:bg-[#06362a] text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.7"
                                                                stroke="currentColor" class="size-5">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                                            </svg>
                                                            <span class="ml-1">Detail</span>
                                                        </button>
                                                        <button type="button"
                                                            onclick="klikEditWKuliner({{ $kuliner->id_wisata_kuliner }})"
                                                            class="bg-[#FFA319] hover:bg-[#F19305] text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="2"
                                                                stroke="currentColor" class="size-4">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                            </svg>
                                                            <span class="ml-1">Edit</span>
                                                        </button>
                                                        {{-- <form id="delete-form-{{ $kuliner->id_wisata_kuliner }}"
                                                            action="{{ route('kelolawisatakuliner.hapus', $kuliner->id_wisata_kuliner) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button"
                                                                onclick="konfirmasiHapus({{ $kuliner->id_wisata_kuliner }})"
                                                                class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.7"
                                                                    stroke="currentColor" class="size-5">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                </svg>
                                                                <span class="ml-1">Hapus</span>
                                                            </button>
                                                        </form> --}}
                                                        {{-- <button
                                                            onclick="konfirmasiHapus({{ $kuliner->id_wisata_kuliner }})"
                                                            class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.7"
                                                                stroke="currentColor" class="size-5">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                            </svg>
                                                            <span class="ml-1">Hapus</span>
                                                        </button> --}}
                                                        {{-- <button
                                                            onclick="ubahStatusOperasional({{ $kuliner->id_wisata_kuliner }}, '{{ $kuliner->status_operasional }}')"
                                                            class="{{ $kuliner->status_operasional == 'Aktif' ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} 
                                                                text-white px-6 py-2 rounded-full text-sm flex items-center gap-1">

                                                            @if ($kuliner->status_operasional == 'Aktif')
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="size-5">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="M6 6h.008v.008H6V6Z" />
                                                                </svg>



                                                                <span>Status</span>
                                                            @else
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.7"
                                                                    stroke="currentColor" class="size-5">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="M9 12.75 11.25 15 15 9.75m6 2.25a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                                </svg>

                                                                <span>Aktifkan</span>
                                                            @endif
                                                        </button> --}}
                                                        <button
                                                            onclick="klikStatusWKuliner(
                                                                {{ $kuliner->id_wisata_kuliner }},
                                                                '{{ $kuliner->status_operasional }}'
                                                            )"
                                                            class="bg-blue-800 hover:bg-blue-900 text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="size-5">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M6 6h.008v.008H6V6Z" />
                                                            </svg>

                                                            <span>Status</span>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-4">
                                {{ $wisataKuliner->appends(['tab' => 'wisatakuliner'])->links('pagination::tailwind') }}
                            </div>
                        @endif
                    </div>
                    <div id="contentKategori" class="{{ $activeTab === 'kategori' ? '' : 'hidden' }}">
                        @include('admin.kelola-wisata-kuliner.halaman-kategori')
                    </div>
                    <div id="contentFasilitas" class="{{ $activeTab === 'fasilitas' ? '' : 'hidden' }}">
                        @include('admin.kelola-wisata-kuliner.halaman-fasilitas')
                    </div>
                </div>
            </div>

            <div id="detailModalKuliner"
                class="fixed inset-0 bg-black/40 hidden z-[9999] overflow-y-auto bg-black bg-opacity-40">
                <div class="relative top-5 bottom-5 mx-auto p-5 border w-[500px] shadow-lg rounded-xl bg-white">
                    <div class="relative">
                        <button onclick="tutupModalKuliner()"
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
                        <h4 class="font-semibold text-sm border-b pb-1 mb-3">
                            Identitas Pengaju
                        </h4>

                        <div class="grid grid-cols-2 gap-2 text-xs">

                            <div class="flex justify-between w-32">
                                <strong>Nama</strong>
                            </div>

                            <div class="grid grid-cols-[8px_2fr] gap-1 -ml-10">
                                <div>:</div>
                                <div><span id="nama_pengaju"></span></div>
                            </div>

                            <div class="flex justify-between w-32">
                                <strong>Email</strong>
                            </div>

                            <div class="grid grid-cols-[8px_2fr] gap-1 -ml-10">
                                <div>:</div>
                                <div><span id="email"></span></div>
                            </div>

                            <div class="flex justify-between w-32">
                                <strong>Peran</strong>
                            </div>

                            <div class="grid grid-cols-[8px_2fr] gap-1 -ml-10">
                                <div>:</div>
                                <div><span id="peran"></span></div>
                            </div>
                        </div>

                        <h4 class="font-semibold text-sm border-b pb-1 mb-3 mt-6">
                            Detail Wisata Kuliner
                        </h4>

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
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-gBdR_gqZTd8B6jz3mVJWI-pqC_jPlAI&libraries=maps,marker&v=weekly&language=in"
        async defer></script>
    <script>
        const tabKuliner = document.getElementById('tabKuliner');
        const tabKategori = document.getElementById('tabKategori');
        const tabFasilitas = document.getElementById('tabFasilitas');

        const contentKuliner = document.getElementById('contentKuliner');
        const contentKategori = document.getElementById('contentKategori');
        const contentFasilitas = document.getElementById('contentFasilitas');

        function aktifkanTab(tab) {
            const params = new URLSearchParams();
            params.set('tab', tab);

            const currentParams = new URLSearchParams(window.location.search);

            if (tab === 'wisatakuliner' && currentParams.has('wisatakuliner')) {
                params.set('wisatakuliner', currentParams.get('wisatakuliner'));
            }

            if (tab === 'kategori' && currentParams.has('kategori')) {
                params.set('kategori', currentParams.get('kategori'));
            }

            if (tab === 'fasilitas' && currentParams.has('fasilitas')) {
                params.set('fasilitas', currentParams.get('fasilitas'));
            }

            window.history.replaceState({},
                '',
                `${window.location.pathname}?${params.toString()}`
            );

            tabKuliner.classList.remove('border-[#004440]');
            tabKategori.classList.remove('border-[#004440]');
            tabFasilitas.classList.remove('border-[#004440]');

            tabKuliner.classList.add('border-[#d8d8d8]');
            tabKategori.classList.add('border-[#d8d8d8]');
            tabFasilitas.classList.remove('border-[#004440]');

            contentKuliner.classList.add('hidden');
            contentKategori.classList.add('hidden');
            contentFasilitas.classList.add('hidden');

            // <button id="tabFasilitas"
            //         class="tab-btn flex-1 px-4 py-3 text-center border-b-2 border-[#d8d8d8] text-[#004440] font-semibold">
            //         Fasilitas
            //     </button>
            if (tab === 'wisatakuliner') {
                contentKuliner.classList.remove('hidden');
                contentKategori.classList.add('hidden');
                contentFasilitas.classList.add('hidden');

                tabKuliner.classList.remove('border-[#d8d8d8]');
                tabKuliner.classList.add('border-[#004440]');
                // tabKategori.classList.remove('border-b-2', 'border-[#d8d8d8]', 'text-[#004440]');
                // tabFasilitas.classList.remove('border-b-2', 'border-[#004440]', 'text-[#004440]');
            } else if (tab === 'kategori') {
                contentKategori.classList.remove('hidden');
                contentKuliner.classList.add('hidden');
                contentFasilitas.classList.add('hidden');

                tabKategori.classList.remove('border-[#d8d8d8]');
                tabKategori.classList.add('border-[#004440]');
                // tabFasilitas.classList.remove('border-b-2', 'border-[#004440]', 'text-[#004440]');
            } else {
                contentFasilitas.classList.remove('hidden');
                contentKuliner.classList.add('hidden');
                contentKategori.classList.add('hidden');

                tabFasilitas.classList.remove('border-[#d8d8d8]');
                tabFasilitas.classList.add('border-[#004440]');
                // contentFasilitas.classList.remove('hidden');
                // contentKategori.classList.add('hidden');
                // contentKuliner.classList.add('hidden');

                // tabFasilitas.classList.add('border-b-2', 'border-[#004440]', 'text-[#004440]');
                // tabKategori.classList.remove('border-b-2', 'border-[#004440]', 'text-[#004440]');
                // tabKuliner.classList.remove('border-b-2', 'border-[#004440]', 'text-[#004440]');
            }
        }

        tabKuliner.addEventListener('click', () => {
            aktifkanTab('wisatakuliner');
        });

        tabKategori.addEventListener('click', () => {
            aktifkanTab('kategori');
        });

        tabFasilitas.addEventListener('click', () => {
            aktifkanTab('fasilitas');
        });

        // const params = new URLSearchParams(window.location.search);
        // const activeTab = params.get('tab');

        // aktifkanTab(activeTab || 'wisatakuliner');

        let map = null;
        let marker = null;

        function klikDetailWKuliner(id) {
            fetch(`/admin/kelolawisatakuliner/detail/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('modalTitleKuliner').textContent = data.nama;
                    document.getElementById('nama_pengaju').textContent = data.nama_pengaju;
                    document.getElementById('email').textContent = data.email;
                    document.getElementById('peran').textContent = data.peran;
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

                    status.classList.remove(
                        'text-green-600',
                        'text-orange-500',
                        'text-red-600',
                        'font-semibold'
                    );

                    if (data.status_operasional === 'Aktif') {
                        status.classList.add('text-green-600', 'font-semibold');
                    } else if (data.status_operasional === 'Tutup Sementara') {
                        status.classList.add('text-orange-500', 'font-semibold');
                    } else if (data.status_operasional === 'Tutup Permanen') {
                        status.classList.add('text-red-600', 'font-semibold');
                    }

                    const foto = document.getElementById('foto');

                    // if (data.foto) {
                    //     foto.src = `/storage/${data.foto}`;
                    //     foto.classList.remove('hidden');
                    // } else {
                    //     foto.classList.add('hidden');
                    // }

                    // const foto = document.getElementById('foto');

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

                    document.getElementById('detailModalKuliner').classList.remove('hidden');

                    if (!map) {
                        map = new google.maps.Map(document.getElementById("map"), {
                            center: position,
                            zoom: 16,
                            mapId: "5ee8a1d5bfc6676ac1b5f32c",
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

        function tutupModalKuliner() {
            document.getElementById('detailModalKuliner').classList.add('hidden');
        }

        function reloadSetelahHapus(paramPage, tableId) {
            const params = new URLSearchParams(window.location.search);

            const currentPage = parseInt(params.get(paramPage) || 1);
            const totalRows = document.querySelectorAll(`#${tableId} tbody tr`).length;

            if (currentPage > 1 && totalRows === 1) {
                params.set(paramPage, currentPage - 1);
            }

            window.location.href = `${window.location.pathname}?${params.toString()}`;
        }

        function klikTambahWKuliner(e) {
            e.preventDefault();

            const redirect = encodeURIComponent(window.location.href);

            window.location.href =
                `/admin/tambahwisatakuliner?redirect=${redirect}`;
        }

        function klikEditWKuliner(id) {
            const redirect = encodeURIComponent(window.location.href);

            window.location.href =
                `/admin/editwisatakuliner/edit/${id}?redirect=${redirect}`;
        }

        function klikStatusWKuliner(id, status) {
            let confirmText = '';
            let denyText = '';

            if (status === 'Aktif') {
                confirmText = 'Tutup Sementara';
                denyText = 'Tutup Permanen';
            } else if (status === 'Tutup Sementara') {
                confirmText = 'Aktif';
                denyText = 'Tutup Permanen';
            } else if (status === 'Tutup Permanen') {
                confirmText = 'Aktif';
                denyText = 'Tutup Sementara';
            }

            function getButtonColor(statustombol) {
                if (statustombol === 'Aktif') return '#28a745';
                if (statustombol === 'Tutup Sementara') return '#FFA319';
                if (statustombol === 'Tutup Permanen') return '#DC2626';
                return '#6B7280';
            }

            Swal.fire({
                title: 'Ubah Status Operasional Wisata Kuliner',
                icon: 'question',

                showConfirmButton: true,
                showDenyButton: true,
                showCancelButton: true,

                confirmButtonText: confirmText,
                denyButtonText: denyText,
                cancelButtonText: 'Batal',

                confirmButtonColor: getButtonColor(confirmText),
                denyButtonColor: getButtonColor(denyText)
            }).then((result) => {
                if (result.isConfirmed) {
                    pilihStatus(id, confirmText);
                } else if (result.isDenied) {
                    pilihStatus(id, denyText);
                }
            });
        }

        function pilihStatus(id, statusBaru) {
            window.location.href =
                `/admin/kelolawisatakuliner/ubahstatus/${id}?status=${encodeURIComponent(statusBaru)}`;

        }
        // function konfirmasiHapus(id) {
        //     Swal.fire({
        //         title: 'Hapus Wisata Kuliner?',
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#dc2626',
        //         cancelButtonColor: '#6b7280',
        //         confirmButtonText: 'Ya',
        //         cancelButtonText: 'Batal'
        //     }).then((result) => {
        //         // if (result.isConfirmed) {
        //         //     document.getElementById('delete-form-' + id).submit();
        //         // }
        //         const params = new URLSearchParams(window.location.search);
        //         const currentPage = parseInt(params.get('wisatakuliner') || 1);
        //         const totalRows = document.querySelectorAll('#tabelWisataKuliner tbody tr').length;

        //         if (currentPage > 1 && totalRows === 1) {
        //             params.set('wisatakuliner', currentPage - 1);
        //         }

        //         const form = document.getElementById('delete-form-' + id);
        //         form.action += '?' + params.toString();
        //         form.submit();
        //     });
        // }

        // function konfirmasiHapus(id) {
        //     Swal.fire({
        //         title: 'Hapus Wisata Kuliner?',
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#dc2626',
        //         cancelButtonColor: '#6b7280',
        //         confirmButtonText: 'Ya',
        //         cancelButtonText: 'Batal'
        //     }).then((result) => {
        //         if (!result.isConfirmed) return;

        //         fetch(`/admin/kelolawisatakuliner/hapus/${id}`, {
        //                 method: "DELETE",
        //                 headers: {
        //                     'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
        //                     'Accept': 'application/json'
        //                 }
        //             })
        //             .then(res => res.json())
        //             .then(data => {
        //                 Swal.fire({
        //                     icon: data.status,
        //                     title: data.title,
        //                     text: data.text,
        //                     timer: data.status === 'success' ? 1500 : undefined,
        //                     showConfirmButton: data.status !== 'success'
        //                 }).then(() => {
        //                     // if (data.status === 'success') location.reload();
        //                     reloadSetelahHapus('wisatakuliner', 'tabelWisataKuliner');
        //                 });
        //             });
        //     });
        // }




        // function konfirmasiHapusKategori(id, nama, totalWisata) {
        //     if (totalWisata > 0) {
        //         Swal.fire({
        //             icon: 'error',
        //             title: 'Tidak Dapat Dihapus',
        //             text: 'Kategori masih dimiliki oleh wisata kuliner',
        //             timer: 2000,
        //             showConfirmButton: false
        //         });
        //         return;
        //     }

        //     Swal.fire({
        //         title: `Hapus kategori "${nama}"?`,
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#dc2626',
        //         cancelButtonColor: '#6b7280',
        //         confirmButtonText: 'Ya',
        //         cancelButtonText: 'Batal'
        //     }).then((result) => {
        //         if (!result.isConfirmed) return;

        //         fetch(`/admin/kelolakategori/hapus/${id}`, {
        //                 method: "DELETE",
        //                 headers: {
        //                     'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
        //                     'Accept': 'application/json'
        //                 }
        //             })
        //             .then(res => res.json())
        //             .then(data => {
        //                 Swal.fire({
        //                     icon: data.status,
        //                     title: data.title,
        //                     text: data.text,
        //                     timer: data.status === 'success' ? 1500 : undefined,
        //                     showConfirmButton: data.status !== 'success'
        //                 }).then(() => {
        //                     // if (data.status === 'success') location.reload();
        //                     reloadSetelahHapus('kategori', 'tabelKategori');
        //                 });
        //             });
        //     });
        // }





        // Fasilitas
        // const allFasilitas = @json($fasilitas->items());

        // function tampilkanDetailFasilitas(id) {
        //     const tbody = document.getElementById('bodyDetailFasilitas');
        //     tbody.innerHTML = "";

        //     const listFasilitas = allFasilitas.data ?? allFasilitas;

        //     const fasilitas = listFasilitas.find(k => k.id_fasilitas == id);
        //     document.getElementById('namaFasilitas').innerText = fasilitas.nama;
        //     if (!fasilitas) {
        //         console.log('Fasilitas tidak ditemukan');
        //         return;
        //     }
        // const fasilitas = allFasilitas.find(f => f.id_fasilitas == id);

        // if (!fasilitas) {
        //     console.log('Fasilitas tidak ditemukan');
        //     return;
        // }

        // document.getElementById('namaFasilitas').innerText = fasilitas.nama;
        // const kulinerTerpakai = allKulinerFasilitas.filter(k =>
        //     k.fasilitas?.some(f => f.id_fasilitas == id)
        // );


        // const kulinerTerpakai = allKulinerFasilitas.filter(k =>
        //     k.fasilitas.some(kt => kt.id_fasilitas == id)
        // ).sort((a, b) => a.nama.localeCompare(b.nama, 'id'));
        // const kulinerTerpakai = allKulinerFasilitas
        //     .filter(k => ['Disetujui', 'Belum Diverifikasi'].includes(k.status))
        //     .filter(k =>
        //         k.fasilitas.some(f => f.id_fasilitas == id)
        //     )
        //     .filter((item, index, self) =>
        //         index === self.findIndex(k => k.id_wisata_kuliner === item.id_wisata_kuliner)
        //     )
        //     .sort((a, b) => a.nama.localeCompare(b.nama, 'id'));

        // const kulinerTerpakai = allKuliner
        //     .filter(k =>
        //         k.fasilitas?.some(f => f.id_fasilitas == id)
        //     )
        //     .filter((item, index, self) =>
        //         index === self.findIndex(k => k.nama === item.nama)
        //     )
        //     .sort((a, b) => {
        //         const statusA = a.status_tampil || a.status;
        //         const statusB = b.status_tampil || b.status;

        //         return urutanStatus[statusA] - urutanStatus[statusB];
        //     });

        // if (kulinerTerpakai.length > 0) {
        //     kulinerTerpakai.forEach(item => {
        //         tbody.innerHTML += `
    //     <tr class="border-t text-center ">
    //         <td class="p-2 text-left">${item.nama}</td>
    //     </tr>
    // `;
        //             kulinerTerpakai.forEach(item => {
        //                 const badge =
        //                     item.status === 'Disetujui' ?
        //                     '<span class="text-green-600 text-xs font-medium">(Disetujui)</span>' :
        //                     '<span class="text-orange-500 text-xs font-medium">(Menunggu Verifikasi)</span>';

        //                 tbody.innerHTML += `
    //     <tr class="border-t">
    //         <td class="p-2 text-left flex justify-between items-center">
    //             <span>${item.nama}</span>
    //             ${badge}
    //         </td>
    //     </tr>
    // `;
        //         });
        //     } else {
        //         tbody.innerHTML += `
    //             <tr class="border-t">
    //                 <td class="p-2 text-center text-gray-500">
    //                     Fasilitas belum dimiliki
    //                 </td>
    //             </tr>
    //         `;
        //     }

        //     document.getElementById('detailFasilitas').classList.remove('hidden');
        // }



        // function konfirmasiHapusFasilitas(id, nama, totalWisata) {
        //     if (totalWisata > 0) {
        //         Swal.fire({
        //             icon: 'error',
        //             title: 'Tidak Dapat Dihapus',
        //             text: 'Fasilitas masih dimiliki oleh wisata kuliner',
        //             timer: 2000,
        //             showConfirmButton: false
        //         });
        //         return;
        //     }

        //     Swal.fire({
        //         title: `Hapus fasilitas "${nama}"?`,
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#dc2626',
        //         cancelButtonColor: '#6b7280',
        //         confirmButtonText: 'Ya',
        //         cancelButtonText: 'Batal'
        //     }).then((result) => {
        //         if (!result.isConfirmed) return;

        //         fetch(`/admin/kelolafasilitas/hapus/${id}`, {
        //                 method: "DELETE",
        //                 headers: {
        //                     'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
        //                     'Accept': 'application/json'
        //                 }
        //             })
        //             .then(res => res.json())
        //             .then(data => {
        //                 Swal.fire({
        //                     icon: data.status,
        //                     title: data.title,
        //                     text: data.text,
        //                     timer: data.status === 'success' ? 1500 : undefined,
        //                     showConfirmButton: data.status !== 'success'
        //                 }).then(() => {
        //                     // if (data.status === 'success') location.reload();
        //                     reloadSetelahHapus('fasilitas', 'tabelFasilitas');
        //                 });
        //             });
        //     });
        // }

        // function ubahStatusOperasional(id, statusSekarang) {
        //     let confirmText = '';
        //     let denyText = '';

        //     if (statusSekarang === 'Aktif') {
        //         confirmText = 'Tutup Sementara';
        //         denyText = 'Tutup Permanen';
        //     } else if (statusSekarang === 'Tutup Sementara') {
        //         confirmText = 'Aktif';
        //         denyText = 'Tutup Permanen';
        //     } else if (statusSekarang === 'Tutup Permanen') {
        //         confirmText = 'Aktif';
        //         denyText = 'Tutup Sementara';
        //     }

        //     Swal.fire({
        //         title: 'Ubah Status Operasional',
        //         text: `Status saat ini: ${statusSekarang}`,
        //         icon: 'question',
        //         showConfirmButton: true,
        //         showDenyButton: true,
        //         showCancelButton: true,

        //         confirmButtonText: confirmText,
        //         denyButtonText: denyText,
        //         cancelButtonText: 'Batal',

        //         confirmButtonColor: '#004440',
        //         denyButtonColor: '#FFA319'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             pilihStatus(id, confirmText);
        //         } else if (result.isDenied) {
        //             pilihStatus(id, denyText);
        //         }
        //     });
        // }
    </script>
</body>

</html>
