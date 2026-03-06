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
        <div class="flex justify-end">
            <a href="{{ route('kelolawisatakuliner.tambah') }}"
                class="bg-[#FFA319] hover:bg-[#F19305]
                btn btn-primary text-white rounded-full px-4 py-2 mt-14 text-sm flex items-center gap-1 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>Tambah</span>
            </a>
        </div>

        <div class="flex-1 overflow-hidden ml-1">
            <div class="bg-white-100 pt-0">
                <div id="informatika-content">
                    @if (!$statuswisatakuliner)
                        <table class="table-fixed w-full border-collapse border border-black">
                            <colgroup>
                                <col style="width: 30px">
                                <col style="width: 200px">
                                <col style="width: 80px">
                                <col style="width: 160px">
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
                                    <td colspan="8" style="text-align: center" class="px-4 py-3 text-sm text-black">
                                        Belum Tersedia Wisata Kuliner</td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        <div class="bg-white rounded-lg mt-4">
                            <table class="table-fixed w-full border-collapse border-b-0 border-black">
                                <colgroup>
                                    <col style="width: 30px">
                                    <col style="width: 200px">
                                    <col style="width: 80px">
                                    <col style="width: 160px">
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
                                                            viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor"
                                                            class="size-5">
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

                        <div class="mb-4">
                            {{ $wisataKuliner->links('pagination::bootstrap-5') }}
                        </div>
                    @endif

                    <div id="detailModal"
                        class="fixed left-[300px] right-0 top-0 bottom-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto">
                        <div class="relative top-20 mx-auto p-5 border w-[450px] shadow-lg rounded-xl bg-white">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold flex-1 text-center" id="modalTitle"></h3>
                                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <div class="mt-4">
                                <div class="grid grid-cols-2 gap-2 text-xs">
                                    <div class="flex justify-between w-32">
                                        <strong>Alamat</strong>
                                    </div>
                                    <div class="grid grid-cols-[8px_2fr] gap-1 -ml-10">
                                        <div>:</div>
                                        <div class="text-justify"><span id="alamat"></span></div>
                                    </div>
                                    {{-- <div>
                                        <div class="-ml-10"><span id="alamat"></span></div>
                                    </div> --}}


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
                                        <strong>Deskripsi</strong>
                                    </div>
                                    <div class="grid grid-cols-[8px_2fr] gap-1 -ml-10">
                                        <div>:</div>
                                        <div class="text-justify"><span id="deskripsi"></span></div>
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
            {{-- </div> --}}

            {{-- <a href="{{ route('beranda-Admin') }}"
            class="menu-item flex items-center p-2 rounded
                {{ request()->routeIs('beranda-Admin') ? 'active' : 'text-white' }}">
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

        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
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

                        document.getElementById('detailModal').classList.remove('hidden');

                        if (!map) {
                            map = L.map('map').setView([lat, lng], 16);

                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; OpenStreetMap'
                            }).addTo(map);

                            marker = L.marker([lat, lng]).addTo(map);
                        } else {
                            map.setView([lat, lng], 16);
                            marker.setLatLng([lat, lng]);
                        }

                        map.invalidateSize();
                        // var map = L.map('map').setView([lat, lng], 50);
                        // // let mapOptions = {
                        // //     center: [51.958, 9.141],
                        // //     zoom: 10
                        // // }

                        // // let map = new L.map('map', mapOptions);

                        // let layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
                        // map.addLayer(layer);
                        // var marker = L.marker([lat, lng]).addTo(map);
                    });
            }

            function closeModal() {
                document.getElementById('detailModal').classList.add('hidden');
            }

            function konfirmasiHapus(id) {
                Swal.fire({
                    title: 'Yakin untuk hapus wisata kuliner?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            }
        </script>
        {{-- <script>
        function showDetail(id) {
            fetch(`/dekan/jadwal-kuliah/detail/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('modalTitle').textContent = data.nama_mk;
                    document.getElementById('hari').textContent = data.hari;
                    document.getElementById('waktu').textContent = data.waktu_mulai.substr(0, 5) + '-' + data
                        .waktu_selesai.substr(0, 5);
                    document.getElementById('kode').textContent = data.kode_mk;
                    document.getElementById('mata_kuliah').textContent = data.nama_mk;
                    document.getElementById('jenis_mata_kuliah').textContent = data.tipe_mata_kuliah;
                    document.getElementById('sks').textContent = data.sks;
                    document.getElementById('semester').textContent = data.semester;
                    document.getElementById('tahun_ajaran').textContent = data.nama;
                    document.getElementById('kelas').textContent = data.nama_kelas;
                    document.getElementById('ruang').textContent = data.nama_ruang;
                    document.getElementById('kuota').textContent = data.kuota;
                    document.getElementById('dosen_pengampu').innerHTML = data.dosen_pengampu;

                    document.getElementById('detailModal').classList.remove('hidden');
                });
        }

        function closeModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }

        function approveAllSchedules() {
            const button = document.getElementById('approveAllButton');
            const idsemaktif = "20241";

            fetch(`/update-status/${idsemaktif}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        tahun_ajaran: idsemaktif,
                    })
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        button.textContent = 'Telah Disetujui';
                        button.classList.remove("hover:bg-gray-400", "bg-gray-300");
                        button.classList.add("bg-gray-400", "cursor-not-allowed");
                        button.disabled = true;

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: "Jadwal Kuliah Berhasil Disetujui",
                            timer: 1500,
                            showConfirmButton: false
                        });
                    } else {
                        alert(result.message);
                    }
                })
                .catch(error => {
                    console.error('Terjadi kesalahan:', error);
                    alert('Terjadi kesalahan saat menyetujui jadwal.');
                });
        }

        function displayContent() {
            const selectedValue = document.getElementById("programDropdown").value;

            localStorage.setItem("selectedDepartment", selectedValue);

            const contents = document.querySelectorAll(".content");
            contents.forEach(content => content.classList.add("hidden"));

            const selectedContent = document.getElementById(`${selectedValue}-content`);
            if (selectedContent) {
                selectedContent.classList.remove("hidden");
            }
        }

        function setDropdownFromLocalStorage() {
            const selectedValue = localStorage.getItem("selectedDepartment");

            const dropdown = document.getElementById("programDropdown");

            if (selectedValue) {
                dropdown.value = selectedValue;

                const contents = document.querySelectorAll(".content");
                contents.forEach(content => content.classList.add("hidden"));

                const selectedContent = document.getElementById(`${selectedValue}-content`);
                if (selectedContent) {
                    selectedContent.classList.remove("hidden");
                }
            } else {
                dropdown.value = "pilihdepartemen";

                const contents = document.querySelectorAll(".content");
                contents.forEach(content => content.classList.add("hidden"));

                const defaultContent = document.getElementById("pilihdepartemen-content");
                if (defaultContent) {
                    defaultContent.classList.remove("hidden");
                }
            }
        }

        document.addEventListener("DOMContentLoaded", setDropdownFromLocalStorage);
    </script> --}}

</body>

</html>
