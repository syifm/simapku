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

    @include('layouts.sidebar-admin')
    <div class="pt-[38px] pl-[350px] pr-[50px] pb-[30px] overflow-y-auto min-h-screen">
        <h1 class="font-bold text-xl">Daftar Wisata Kuliner</h1>
        <div class="flex justify-between items-center">
            <div class="flex gap-4">
                <a href="{{ route('kelolawisatakuliner.tambah') }}"
                    class="bg-[#094B3C] hover:bg-[#06362a]
                btn btn-primary text-white rounded-full px-4 py-2 mt-14 text-sm flex items-center gap-2 transition mb-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                    </svg>
                    <span>Kelola Fasilitas</span>
                </a>
                <a href="{{ route('kelolakategori') }}"
                    class="bg-[#094B3C] hover:bg-[#06362a]
                btn btn-primary text-white rounded-full px-4 py-2 mt-14 text-sm flex items-center gap-2 transition mb-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                    </svg>
                    <span>Kelola Kategori</span>
                </a>
            </div>
            <div class="flex justify-end gap-4">
                <a href="{{ route('kelolawisatakuliner.tambah') }}"
                    class="bg-[#FFA319] hover:bg-[#F19305]
                btn btn-primary text-white rounded-full px-4 py-2 mt-14 text-sm flex items-center gap-1 transition mb-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>Tambah</span>
                </a>
            </div>
        </div>

        <div class="flex-1 overflow-hidden ml-1">
            <div class="bg-white-100 pt-0">
                <div id="informatika-content">
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
                                            class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#094B3C]">
                                            No
                                        </th>
                                        <th
                                            class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#094B3C]">
                                            Wisata Kuliner
                                        </th>
                                        <th
                                            class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#094B3C]">
                                            Status
                                        </th>
                                        <th
                                            class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#094B3C]">
                                            Update Terakhir
                                        </th>
                                        <th
                                            class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#094B3C]">
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
                                            class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#094B3C]">
                                            No
                                        </th>
                                        <th
                                            class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#094B3C]">
                                            Wisata Kuliner
                                        </th>
                                        <th
                                            class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#094B3C]">
                                            Status
                                        </th>
                                        <th
                                            class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#094B3C]">
                                            Update Terakhir
                                        </th>
                                        <th
                                            class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#094B3C]">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach ($wisataKuliner as $kuliner)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                                                {{ $kuliner->nomor }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                                                {{ $kuliner->nama }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                                                {{ $kuliner->status }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                                                {{ \Carbon\Carbon::parse($kuliner->waktu_diubah)->format('d/m/Y H:i') }}
                                            </td>
                                            <td
                                                class="px-4 py-3 text-sm border-b border-r border-black flex justify-center gap-2">
                                                <button onclick="showDetail({{ $kuliner->id_wisata_kuliner }})"
                                                    class="bg-[#094B3C] hover:bg-[#06362a] text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor"
                                                        class="size-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                                    </svg>
                                                    <span class="ml-1">Detail</span>
                                                </button>
                                                <button type="button"
                                                    onclick="window.location.href='{{ route('kelolawisatakuliner.edit', $kuliner->id_wisata_kuliner) }}'"
                                                    class="bg-[#FFA319] hover:bg-[#F19305] text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                        class="size-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                    </svg>
                                                    <span class="ml-1">Edit</span>
                                                </button>
                                                <form id="delete-form-{{ $kuliner->id_wisata_kuliner }}"
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
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>
                                                        <span class="ml-1">Hapus</span>
                                                    </button>
                                                </form>
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

                    <div id="detailModal"
                        class="fixed left-[300px] right-0 top-0 bottom-0 bg-black bg-opacity-40 hidden overflow-y-auto">
                        <div
                            class="relative top-5 bottom-5 mx-auto p-5 border w-[500px] shadow-lg rounded-xl bg-white">
                            <div class="relative">
                                <button onclick="closeModal()"
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
                                <div id="aksiVerifikasi" class="flex justify-end gap-4 mt-6 text-sm"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {{-- </div> --}}

            {{-- <a href="{{ route('beranda.Admin') }}"
            class="menu-item flex items-center p-2 rounded
                {{ request()->routeIs('beranda.Admin') ? 'active' : 'text-white' }}">
            <div class="-ml-1.2 mr-3 -mt-0.5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
            </div>
            <span class="font-bold">Beranda</span>
        </a> --}}
            {{-- @if (!$statuswisatakuliner)
            <div class="mt-[50px] bg-white p-10 rounded-lg shadow-lg text-center fade-in border border-gray-300">
                <div class="flex flex-col items-center">
                    <div class="relative w-20 h-20 flex items-center justify-center bg-gray-100 rounded-full shadow-lg">
                        <svg class="w-14 h-14 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="orange"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 2a5 5 0 00-5 5v4H6a2 2 0 00-2 2v7a2 2 0 002 2h12a2 2 0 002-2v-7a2 2 0 00-2-2h-1V7a5 5 0 00-5-5zm-3 9V7a3 3 0 016 0v4H9zm3 4a1.5 1.5 0 110 3 1.5 1.5 0 010-3z" />
                        </svg>
                    </div>

                    <h2 class="text-2xl font-bold text-gray-800 mt-4">Mohon maaf, halaman ini tidak dapat diakses.</h2>
                    <p class="text-gray-600 mt-2">Daftar wisata kuliner belum tersedia.</p>
                </div>
            </div> --}}
            {{-- @else
            <div class="bg-white rounded-lg shadow-md h-[calc(100vh-120px)] overflow-auto fade-in">
                {{-- <div class="ml-6 mt-4">
                    <form method="GET" action="{{ route('logaktivitas') }}">
                        <select name="bulantahun" onchange="this.form.submit()">
                            @foreach ($months as $m)
                                <option value="{{ $m['bulan'] }}-{{ $m['tahun'] }}"
                                    {{ (int) $bulan_angka == $m['bulan'] && $tahun == $m['tahun'] ? 'selected' : '' }}>
                                    {{ $m['label'] }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>

                <table border="1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Wisata Kuliner</th>
                            <th>Update Terakhir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wisataKuliner as $wkuliner)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $wkuliner->nama }}</td>
                                <td>
                                    {{-- Detail
                                    <a href="{{ route('wkuliner.detail', $wkuliner->id) }}">
                                        Detail
                                    </a>

                                    {{-- Edit
                                    <a href="{{ route('wkuliner.edit', $produk->id) }}">
                                        Edit
                                    </a>

                                    <!-- Hapus -->
                                    <form action="{{ route('wkuliner.hapus', $produk->id) }}" method="POST"
                                        style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin mau hapus?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> --}}



            {{-- <div class="ml-6 mt-4 mr-6 mb-4">
                    <table class="w-full table-auto border-collapse border border-gray-300">
                        <thead class="bg-blue-900 text-white">
                            <tr>
                                <th class="py-2 px-3 border text-sm w-12">No</th>
                                <th class="py-2 px-3 border text-sm">Wisata Kuliner</th>
                                <th class="py-2 px-3 border text-sm">Update Terakhir</th>
                                <th class="py-2 px-3 border text-sm w-20">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i <= $wisataKuliner; $i++)
                                <tr class="odd:bg-gray-100 even:bg-gray-200">
                                    <td class="py-2 px-3 border text-sm text-center">{{ $i }}</td>
                                    <td class="py-2 px-3 border text-sm text-center">{{ $i }}</td>

                                    <td class="py-2 px-3 border text-sm text-center"><a
                                            href="{{ asset('storage/' . $logs[$i]->file_bukti) }}" target="_blank"
                                            class="inline-flex items-center px-3 py-1 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700 transition">
                                            Lihat
                                        </a></td>
                                    <td class="py-2 px-3 border text-sm text-center">{{ $i }}</td>

                                    <td class="py-2 px-3 border text-sm text-center w-40">
                                        @if ($i <= $currentWeekInSelectedMonth)
                                            @if (isset($logs[$i]) && $logs[$i]->file_bukti)
                                                <a href="{{ asset('storage/' . $logs[$i]->file_bukti) }}"
                                                    target="_blank"
                                                    class="inline-flex items-center px-3 py-1 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700 transition">
                                                    Lihat
                                                </a>
                                            @else
                                                @if ($i < $currentWeekInSelectedMonth)
                                                    <span
                                                        class="inline-block text-red-600 px-2 py-1 rounded text-sm font-medium">
                                                        Tidak Tersedia
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-block text-gray-400 px-2 py-1 rounded text-sm font-medium">
                                                        Belum Tersedia
                                                    </span>
                                                @endif
                                            @endif
                                        @else
                                            <span
                                                class="inline-block text-gray-400 px-2 py-1 rounded text-sm font-medium">
                                                Belum Tersedia
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-2 px-3 border text-sm text-center w-40">
                                        @if ($i <= $currentWeekInSelectedMonth)
                                            @if (isset($logs[$i]))
                                                @if ($i < $currentWeekInSelectedMonth)
                                                    <span
                                                        class="inline-block text-red-600 px-2 py-1 rounded text-sm font-medium">
                                                        Sudah Berlalu
                                                    </span>
                                                @elseif(
                                                    $pendaftar->status_magang === 'Lulus' ||
                                                        $pendaftar->status_magang === 'Tidak Lulus' ||
                                                        $pendaftar->status_magang == 'Proses Pemeriksaan')
                                                    <button disabled
                                                        class="px-3 py-1 bg-gray-400 text-white rounded cursor-not-allowed text-sm">
                                                        Edit
                                                    </button>
                                                @else
                                                    <a href="{{ route('log.create', ['minggu' => $i, 'bulan' => $bulan, 'tahun' => $tahun]) }}"
                                                        class="inline-flex items-center px-3 py-1 bg-orange-600 text-white text-sm font-medium rounded hover:bg-orange-700 transition">
                                                        Edit
                                                    </a>
                                                @endif
                                            @else
                                                @if ($i < $currentWeekInSelectedMonth)
                                                    <span
                                                        class="inline-block text-red-600 px-2 py-1 rounded text-sm font-medium">
                                                        Sudah Berlalu
                                                    </span>
                                                @elseif(
                                                    $pendaftar->status_magang === 'Lulus' ||
                                                        $pendaftar->status_magang === 'Tidak Lulus' ||
                                                        $pendaftar->status_magang == 'Proses Pemeriksaan')
                                                    <button disabled
                                                        class="px-3 py-1 bg-gray-400 text-white rounded cursor-not-allowed text-sm">
                                                        Tambah
                                                    </button>
                                                @else
                                                    <a href="{{ route('log.create', ['minggu' => $i, 'bulan' => $bulan, 'tahun' => $tahun]) }}"
                                                        class="inline-flex items-center transition bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                                        Tambah
                                                    </a>
                                                @endif
                                            @endif
                                        @else
                                            <span
                                                class="inline-block text-gray-400 px-2 py-1 rounded text-sm font-medium">
                                                Belum Tersedia
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-2 px-3 border text-sm text-center">
                                        @if ($i <= $currentWeekInSelectedMonth)
                                            @if (isset($logs[$i]) && $logs[$i]->updated_at)
                                                {{ \Carbon\Carbon::parse($logs[$i]->updated_at)->locale('id')->isoFormat('D MMMM Y') }}
                                            @else
                                                @if ($i < $currentWeekInSelectedMonth)
                                                    <span
                                                        class="inline-block text-red-600 px-2 py-1 rounded text-sm font-medium">
                                                        Tidak Tersedia
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-block text-gray-400 px-2 py-1 rounded text-sm font-medium">
                                                        Belum Tersedia
                                                    </span>
                                                @endif
                                            @endif
                                        @else
                                            <span
                                                class="inline-block text-gray-400 px-2 py-1 rounded text-sm font-medium">
                                                Belum Tersedia
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div> --}}

            {{-- <style>
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
                </style> --}}
            {{-- @endif --}}
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
            let map = null;
            let marker = null;

            function showDetail(id) {
                fetch(`/admin/kelolawisatakuliner/detail/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('modalTitle').textContent = data.nama;
                        document.getElementById('alamat').textContent = data.alamat;
                        document.getElementById('kecamatan').textContent = data.kecamatan;
                        document.getElementById('kelurahan').textContent = data.kelurahan;
                        document.getElementById('nomor_telepon').textContent = data.no_telp ?? '-';
                        document.getElementById('email').textContent = data.email ?? '-';
                        document.getElementById('deskripsi').textContent = data.deskripsi;
                        document.getElementById('latitude').textContent = data.latitude;
                        document.getElementById('longitude').textContent = data.longitude;
                        document.getElementById('email_pengaju').textContent = data.email_pengaju;

                        // Harga
                        let min = data.harga_min;
                        let max = data.harga_max;

                        let text = '';

                        if (min && max) {
                            text = `Rp ${min.toLocaleString('id-ID')} - ${max.toLocaleString('id-ID')}`;
                        } else if (min && !max) {
                            text = `Rp ${min.toLocaleString('id-ID')}+`;
                        } else if (!min && max) {
                            text = `≤ Rp ${max.toLocaleString('id-ID')}`;
                        } else {
                            text = '-';
                        }

                        document.getElementById('harga').textContent = text;

                        // Rating
                        let rating = parseFloat(data.penilaian) || 0;

                        if (rating > 0) {
                            document.getElementById('ratingStars').innerHTML = `
                            <span class="text-sm text-black mr-1">${rating}</span>
                            ${generateStars(rating)}
                        `;
                        } else {
                            document.getElementById('ratingStars').innerHTML = '';
                        }

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

                        // Foto
                        const foto = document.getElementById('foto');

                        if (data.foto) {
                            foto.src = `/storage/${data.foto}`;
                            foto.classList.remove('hidden');
                        } else {
                            foto.classList.add('hidden');
                        }

                        // Map
                        const lat = parseFloat(data.latitude);
                        const lng = parseFloat(data.longitude);

                        const aksiDiv = document.getElementById('aksiVerifikasi');
                        aksiDiv.innerHTML = '';

                        if (data.status === 'Disetujui') {
                            aksiDiv.innerHTML = `
                                <button
                                    onclick="aksiTampilkan(${data.id_wisata_kuliner})"
                                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-full btn btn-primary">
                                    Tampilkan
                                </button>
                            `;
                        }

                        document.getElementById('detailModal').classList.remove('hidden');

                        const position = {
                            lat: lat,
                            lng: lng
                        };

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

            function closeModal() {
                document.getElementById('detailModal').classList.add('hidden');
            }

            function generateStars(rating) {
                let roundedRating = Math.round(rating * 2) / 2;
                let stars = '';
                let fullStars = Math.floor(roundedRating);
                let halfStar = roundedRating % 1 === 0.5;
                let emptyStars = 5 - fullStars - (halfStar ? 1 : 0);

                for (let i = 1; i <= 5; i++) {
                    if (i <= fullStars) {
                        stars += `<i class="fas fa-star text-yellow-400"></i>`;
                    } else if (i === fullStars + 1 && halfStar) {
                        stars += `<i class="fas fa-star-half-alt text-yellow-400"></i>`;
                    } else {
                        stars += `<i class="far fa-star text-gray-300"></i>`;
                    }
                }

                return stars;
            }

            function konfirmasiHapus(id) {
                Swal.fire({
                    title: 'Hapus wisata kuliner?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            }

            function aksiTampilkan(id) {
                Swal.fire({
                    title: 'Tampilkan Wisata Kuliner?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Tampilkan',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#16a34a',
                    cancelButtonColor: '#6b7280',
                }).then((result) => {
                    if (result.isConfirmed) {
                        kirimAksi(id, 'Ditampilkan');
                    }
                });
            }

            function kirimAksi(id, status, komentar = null) {
                fetch(`/admin/tampilkanwisatakuliner/${id}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            status: status,
                            komentar: komentar
                        })
                    })
                    .then(res => res.json())
                    .then(res => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: res.message,
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        }).then(() => location.reload());
                    });
            }
        </script>
</body>

</html>
