<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAPKU | Verifikasi Wisata Kuliner</title>
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
    <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/3.0.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

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

    @include('layouts.sidebar-admin')
    <div class="pt-[38px] pl-[350px] pr-[50px] pb-[30px] overflow-y-auto min-h-screen">
        <h1 class="font-bold text-xl">Verifikasi Wisata Kuliner dan Ulasan</h1>

        <div class="flex-1 overflow-hidden ml-1">
            <div class="bg-white-100 pt-0">
                <div class="mt-14">
                    @if ($wisataKuliner->isEmpty())
                        <div class="bg-white rounded-lg mt-4">
                            <table class="table-fixed w-full border-collapse border border-black">
                                <colgroup>
                                    <col style="width: 30px">
                                    <col style="width: 280px">
                                    <col style="width: 90px">
                                    <col style="width: 90px">
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
                                            Status Verifikasi
                                        </th>
                                        <th
                                            class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                                            Keterangan
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
                                    <col style="width: 280px">
                                    <col style="width: 90px">
                                    <col style="width: 90px">
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
                                            Status Verifikasi
                                        </th>
                                        <th
                                            class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                                            Keterangan
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
                                                {{ $kuliner->jenis_pengajuan }}
                                            </td>
                                            <td
                                                class="px-4 py-3 text-sm border-b border-r border-black flex justify-center gap-2">
                                                {{-- @if ($kuliner->status == 'Belum Diverifikasi')
                                                    @if ($kuliner->id_wisata_kuliner)
                                                        <button
                                                            onclick="showDetailPerubahan({{ $kuliner->id_pengajuan }})"
                                                            class="bg-[#FFA319] hover:bg-[#F19305] text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.7"
                                                                stroke="currentColor" class="size-5">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                                                            </svg>
                                                            <span class="ml-1">Verifikasi</span>
                                                        </button>
                                                    @else
                                                        <button onclick="showDetailBaru({{ $kuliner->id_pengajuan }})"
                                                            class="bg-[#FFA319] hover:bg-[#F19305] text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.7"
                                                                stroke="currentColor" class="size-5">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                                                            </svg>
                                                            <span class="ml-1">Verifikasi</span>
                                                        </button>
                                                    @endif
                                                @else
                                                    <button onclick="showDetailBaru({{ $kuliner->id_pengajuan }})"
                                                        class="bg-[#004440] hover:bg-[#06362a] text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor"
                                                            class="size-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                                        </svg>
                                                        <span class="ml-1">Detail</span>
                                                    </button>
                                                @endif --}}

                                                <button onclick="tampilkanDetail({{ $kuliner->id_pengajuan }})"
                                                    class="{{ $kuliner->status == 'Belum Diverifikasi'
                                                        ? 'bg-[#FFA319] hover:bg-[#F19305]'
                                                        : 'bg-[#004440] hover:bg-[#06362a]' }}
                                                        text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">

                                                    @if ($kuliner->status == 'Belum Diverifikasi')
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor"
                                                            class="size-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                                                        </svg>
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor"
                                                            class="size-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                                        </svg>
                                                    @endif

                                                    <span class="ml-1">
                                                        {{ $kuliner->status == 'Belum Diverifikasi' ? 'Verifikasi' : 'Detail' }}
                                                    </span>
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

                    <div id="detailBaru" {{-- class="fixed left-[300px] right-0 top-0 bottom-0 bg-black bg-opacity-40 hidden overflow-y-auto"> --}}
                        class="fixed inset-0 bg-black/40 hidden z-[9999] overflow-y-auto bg-black bg-opacity-40">
                        <div class="relative top-5 mx-auto p-5 border w-[500px] shadow-lg rounded-xl bg-white">
                            <div class="col-span-7 flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold flex-1 text-center" id="modalTitle"></h3>
                                <button onclick="tutupDetailBaru()" class="text-gray-400 hover:text-gray-500">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
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
                                <div id="aksiVerifikasi" class="flex justify-end gap-4 mt-6 text-sm"></div>

                            </div>
                        </div>
                    </div>

                    {{-- <div id="detailPerubahan"
                        class="fixed left-[300px] right-0 top-0 bottom-0 bg-black bg-opacity-40 hidden overflow-y-auto">
                        <div class="relative top-5 mx-auto p-5 border w-[1000px] shadow-lg rounded-xl bg-white">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold flex-1 text-center" id="modalTitlePerubahan">Detail
                                    Perubahan</h3>
                                <button onclick="tutupDetailPerubahan()" class="text-gray-400 hover:text-gray-500">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <div class="mt-4">
                                <div class="grid grid-cols-[1fr_auto_1fr] gap-8">
                                    <div>
                                        <h4 class="font-semibold text-md pb-1 mb-3 text-center">
                                            Aktif
                                        </h4>

                                        <h4 class="font-semibold text-sm pb-1 mb-3">
                                            Identitas Pengaju
                                        </h4>

                                        <div class="grid grid-cols-[140px_10px_1fr] gap-y-2 text-xs">
                                            <div>
                                                <strong>Nama</strong>
                                            </div>
                                            <div>:</div>
                                            <div class="text-justify"><span id="nama_pengaju_lama"></span></div>

                                            <div><strong>Email</strong></div>
                                            <div>:</div>
                                            <div class="text-justify"><span id="email_lama"></span></div>

                                            <div>
                                                <strong>Peran</strong>
                                            </div>
                                            <div>:</div>
                                            <div class="text-justify"><span id="peran_lama"></span></div>
                                        </div>

                                        <h4 class="font-semibold text-sm pt-3 mt-3 mb-3 border-t">
                                            Detail Wisata Kuliner
                                        </h4>

                                        <div class="grid grid-cols-[140px_10px_1fr] gap-y-2 text-xs">
                                            <div>
                                                <strong>Status Operasional</strong>
                                            </div>
                                            <div>:</div>
                                            <div class="text-justify"><span id="status_operasional_lama"></span>
                                            </div>

                                            <div>
                                                <strong>Nama</strong>
                                            </div>
                                            <div>:</div>
                                            <div class="text-justify"><span id="nama_lama"></span></div>

                                            <div>
                                                <strong>Deskripsi</strong>
                                            </div>
                                            <div>:</div>
                                            <div class="text-justify"><span id="deskripsi_lama"></span></div>

                                            <div>
                                                <strong>Alamat</strong>
                                            </div>
                                            <div>:</div>
                                            <div class="text-justify"><span id="alamat_lama"></span></div>

                                            <div>
                                                <strong>Kecamatan</strong>
                                            </div>
                                            <div>:</div>
                                            <div class="text-justify"><span id="kecamatan_lama"></span></div>

                                            <div>
                                                <strong>Kelurahan</strong>
                                            </div>
                                            <div>:</div>
                                            <div class="text-justify"><span id="kelurahan_lama"></span></div>

                                            <div>
                                                <strong>Nomor Telepon</strong>
                                            </div>
                                            <div>:</div>
                                            <div class="text-justify"><span id="nomor_telepon_lama"></span>
                                            </div>

                                            <div>
                                                <strong>Fasilitas</strong>
                                            </div>
                                            <div>:</div>
                                            <div class="text-justify"><span id="fasilitas_lama"></span></div>

                                            <div>
                                                <strong>Kategori</strong>
                                            </div>
                                            <div>:</div>
                                            <div class="text-justify"><span id="kategori_lama"></span></div>

                                            <div>
                                                <strong>Sertifikat Halal</strong>
                                            </div>
                                            <div>:</div>
                                            <div class="text-justify"><span id="sertifikat_halal_lama"></span>
                                            </div>

                                            <div>
                                                <strong>Foto</strong>
                                            </div>
                                            <div>:</div>
                                            <div>
                                                <img id="foto_lama" src="" alt="Foto Wisata Kuliner"
                                                    class="w-full max-w-xs h-40 object-cover rounded-md border hidden">
                                            </div>

                                            <div>
                                                <strong>Latitude</strong>
                                            </div>
                                            <div>:</div>
                                            <div class="text-justify"><span id="latitude_lama"></span></div>

                                            <div>
                                                <strong>Longitude</strong>
                                            </div>
                                            <div>:</div>
                                            <div class="text-justify"><span id="longitude_lama"></span></div>

                                            <div>
                                                <strong>Lokasi</strong>
                                            </div>
                                            <div>:</div>
                                            <div id="map_lama" class="w-full h-48 rounded-md"></div>
                                        </div>
                                    </div>

                                    <div class="w-px bg-gray-300 self-stretch"></div>

                                    <div>
                                        <h4 class="font-semibold text-md pb-1 mb-3 text-center">
                                            Pengajuan
                                        </h4>

                                        <h4 class="font-semibold text-sm pb-1 mb-3">
                                            Identitas Pengaju
                                        </h4>

                                        <div class="grid grid-cols-[140px_10px_1fr] gap-y-2 text-xs">
                                            <div>
                                                <strong>Nama</strong>
                                            </div>
                                            <div>:</div>
                                            <div class="text-justify"><span id="nama_pengaju_baru"></span></div>

                                            <div>
                                                <strong>Email</strong>
                                            </div>
                                            <div>:</div>
                                            <div class="text-justify"><span id="email_baru"></span></div>

                                            <div>
                                                <strong>Peran</strong>
                                            </div>
                                            <div>:</div>
                                            <div class="text-justify"><span id="peran_baru"></span></div>
                                        </div>

                                        <h4 class="font-semibold text-sm pt-3 mt-3 mb-3 border-t">
                                            Detail Wisata Kuliner
                                        </h4>

                                        <div class="grid grid-cols-[140px_10px_1fr] gap-y-2 text-xs">
                                            <div>
                                                <strong>Status Operasional</strong>
                                            </div>
                                            <div>:</div>
                                            <div class="text-justify"><span id="status_operasional_baru"></span>
                                            </div>

                                            <div>
                                                <strong>Nama</strong>
                                            </div>
                                            <div>:</div>
                                            <div class="text-justify"><span id="nama_baru"></span></div>

                                            <div>
                                                <strong>Deskripsi</strong>
                                            </div>
                                            <div>:</div>
                                            <div class="text-justify"><span id="deskripsi_baru"></span></div>

                                            <div>
                                                <strong>Alamat</strong>
                                            </div>
                                            <div>:</div>
                                            <div class="text-justify"><span id="alamat_baru"></span></div>

                                            <div>
                                                <strong>Kecamatan</strong>
                                            </div>
                                            <div>:</div>
                                            <div class="text-justify"><span id="kecamatan_baru"></span></div>

                                            <div>
                                                <strong>Kelurahan</strong>
                                            </div>
                                            <div>:</div>
                                            <div class="text-justify"><span id="kelurahan_baru"></span></div>

                                            <div>
                                                <strong>Nomor Telepon</strong>
                                            </div>
                                            <div>:</div>
                                            <div class="text-justify"><span id="nomor_telepon_baru"></span>
                                            </div>

                                            <div>
                                                <strong>Fasilitas</strong>
                                            </div>
                                            <div>:</div>
                                            <div class="text-justify"><span id="fasilitas_baru"></span></div>

                                            <div>
                                                <strong>Kategori</strong>
                                            </div>
                                            <div>:</div>
                                            <div class="text-justify"><span id="kategori_baru"></span></div>

                                            <div>
                                                <strong>Sertifikat Halal</strong>
                                            </div>
                                            <div>:</div>
                                            <div class="text-justify"><span id="sertifikat_halal_baru"></span>
                                            </div>

                                            <div>
                                                <strong>Foto</strong>
                                            </div>
                                            <div>:</div>
                                            <div>
                                                <img id="foto_baru" src="" alt="Foto Wisata Kuliner"
                                                    class="w-full max-w-xs h-40 object-cover rounded-md border hidden">
                                            </div>

                                            <div>
                                                <strong>Latitude</strong>
                                            </div>
                                            <div>:</div>
                                            <div class="text-justify"><span id="latitude_baru"></span></div>

                                            <div>
                                                <strong>Longitude</strong>
                                            </div>
                                            <div>:</div>
                                            <div class="text-justify"><span id="longitude_baru"></span></div>

                                            <div>
                                                <strong>Lokasi</strong>
                                            </div>
                                            <div>:</div>
                                            <div id="map_baru" class="w-full h-48 rounded-md"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="aksiVerifikasiPerubahan" class="flex justify-end gap-4 mt-6 text-sm">
                            </div>
                        </div>
                    </div> --}}

                    <div id="detailPerubahan"
                        class="fixed left-[300px] right-0 top-0 bottom-0 bg-black bg-opacity-40 hidden overflow-y-auto">

                        <div class="relative top-5 mx-auto p-5 border w-[1000px] shadow-lg rounded-xl bg-white">

                            <div class="flex justify-between items-center mb-3 pb-3">
                                <h3 class="text-lg font-semibold flex-1 text-center" id="modalTitlePerubahan">
                                    Detail Perubahan
                                </h3>
                                <button onclick="tutupDetailPerubahan()" class="text-gray-400 hover:text-gray-500">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <div class="relative grid gap-x-3 gap-y-1.5 text-xs items-start"
                                style="grid-template-columns: 140px 10px minmax(0,1fr) 40px 140px 10px minmax(0,1fr);">

                                <div
                                    class="absolute top-0 bottom-0 left-1/2 w-[1px] bg-gray-300 -translate-x-1/2 pointer-events-none">
                                </div>

                                <div class="col-span-3 text-center text-sm font-semibold pb-1 mb-1">Aktif</div>
                                <div></div>
                                <div class="col-span-3 text-center text-sm font-semibold pb-1 mb-1">Pengajuan
                                </div>

                                <div class="col-span-3 font-semibold text-sm pb-1">Identitas Pengaju</div>
                                <div></div>
                                <div class="col-span-3 font-semibold text-sm pb-1">Identitas Pengaju</div>

                                <div><strong>Nama</strong></div>
                                <div>:</div>
                                <div class="text-justify"><span id="nama_pengaju_lama"></span></div>
                                <div></div>
                                <div><strong>Nama</strong></div>
                                <div>:</div>
                                <div class="text-justify"><span id="nama_pengaju_baru"></span></div>

                                <div><strong>Email</strong></div>
                                <div>:</div>
                                <div class="text-justify"><span id="email_lama"></span></div>
                                <div></div>
                                <div><strong>Email</strong></div>
                                <div>:</div>
                                <div class="text-justify"><span id="email_baru"></span></div>

                                <div><strong>Peran</strong></div>
                                <div>:</div>
                                <div class="text-justify"><span id="peran_lama"></span></div>
                                <div></div>
                                <div><strong>Peran</strong></div>
                                <div>:</div>
                                <div class="text-justify"><span id="peran_baru"></span></div>

                                <div class="col-span-3 font-semibold text-sm pt-3 pb-1 mt-3 border-t">Detail Wisata
                                    Kuliner</div>
                                <div></div>
                                <div class="col-span-3 font-semibold text-sm pt-3 pb-1 mt-3 border-t">Detail Wisata
                                    Kuliner</div>

                                <div><strong>Status Operasional</strong></div>
                                <div>:</div>
                                <div class="text-justify"><span id="status_operasional_lama"></span></div>
                                <div></div>
                                <div><strong>Status Operasional</strong></div>
                                <div>:</div>
                                <div class="text-justify"><span id="status_operasional_baru"></span></div>

                                <div><strong>Nama</strong></div>
                                <div>:</div>
                                <div class="text-justify"><span id="nama_lama"></span></div>
                                <div></div>
                                <div><strong>Nama</strong></div>
                                <div>:</div>
                                <div class="text-justify"><span id="nama_baru"></span></div>

                                <div><strong>Deskripsi</strong></div>
                                <div>:</div>
                                <div class="text-justify"><span id="deskripsi_lama"></span></div>
                                <div></div>
                                <div><strong>Deskripsi</strong></div>
                                <div>:</div>
                                <div class="text-justify"><span id="deskripsi_baru"></span></div>

                                <div><strong>Alamat</strong></div>
                                <div>:</div>
                                <div class="text-justify"><span id="alamat_lama"></span></div>
                                <div></div>
                                <div><strong>Alamat</strong></div>
                                <div>:</div>
                                <div class="text-justify"><span id="alamat_baru"></span></div>

                                <div><strong>Kecamatan</strong></div>
                                <div>:</div>
                                <div class="text-justify"><span id="kecamatan_lama"></span></div>
                                <div></div>
                                <div><strong>Kecamatan</strong></div>
                                <div>:</div>
                                <div class="text-justify"><span id="kecamatan_baru"></span></div>

                                <div><strong>Kelurahan</strong></div>
                                <div>:</div>
                                <div class="text-justify"><span id="kelurahan_lama"></span></div>
                                <div></div>
                                <div><strong>Kelurahan</strong></div>
                                <div>:</div>
                                <div class="text-justify"><span id="kelurahan_baru"></span></div>

                                <div><strong>Nomor Telepon</strong></div>
                                <div>:</div>
                                <div class="text-justify"><span id="nomor_telepon_lama"></span></div>
                                <div></div>
                                <div><strong>Nomor Telepon</strong></div>
                                <div>:</div>
                                <div class="text-justify"><span id="nomor_telepon_baru"></span></div>

                                <div><strong>Fasilitas</strong></div>
                                <div>:</div>
                                <div class="text-justify"><span id="fasilitas_lama"></span></div>
                                <div></div>
                                <div><strong>Fasilitas</strong></div>
                                <div>:</div>
                                <div class="text-justify"><span id="fasilitas_baru"></span></div>

                                <div><strong>Kategori</strong></div>
                                <div>:</div>
                                <div class="text-justify"><span id="kategori_lama"></span></div>
                                <div></div>
                                <div><strong>Kategori</strong></div>
                                <div>:</div>
                                <div class="text-justify"><span id="kategori_baru"></span></div>

                                <div><strong>Sertifikat Halal</strong></div>
                                <div>:</div>
                                <div class="text-justify"><span id="sertifikat_halal_lama"></span></div>
                                <div></div>
                                <div><strong>Sertifikat Halal</strong></div>
                                <div>:</div>
                                <div class="text-justify"><span id="sertifikat_halal_baru"></span></div>

                                <div><strong>Foto</strong></div>
                                <div>:</div>
                                <div><img id="foto_lama" src="" alt="Foto Wisata Kuliner"
                                        class="w-full max-w-xs h-40 object-cover rounded-md border hidden"></div>
                                <div></div>
                                <div><strong>Foto</strong></div>
                                <div>:</div>
                                <div><img id="foto_baru" src="" alt="Foto Wisata Kuliner"
                                        class="w-full max-w-xs h-40 object-cover rounded-md border hidden"></div>

                                <div><strong>Latitude</strong></div>
                                <div>:</div>
                                <div class="text-justify"><span id="latitude_lama"></span></div>
                                <div></div>
                                <div><strong>Latitude</strong></div>
                                <div>:</div>
                                <div class="text-justify"><span id="latitude_baru"></span></div>

                                <div><strong>Longitude</strong></div>
                                <div>:</div>
                                <div class="text-justify"><span id="longitude_lama"></span></div>
                                <div></div>
                                <div><strong>Longitude</strong></div>
                                <div>:</div>
                                <div class="text-justify"><span id="longitude_baru"></span></div>

                                <div><strong>Lokasi</strong></div>
                                <div>:</div>
                                <div id="map_lama" class="w-full h-48 rounded-md"></div>
                                <div></div>
                                <div><strong>Lokasi</strong></div>
                                <div>:</div>
                                <div id="map_baru" class="w-full h-48 rounded-md"></div>

                            </div>

                            <div id="aksiVerifikasiPerubahan" class="flex justify-end gap-4 mt-6 text-sm">
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
            let map = null;
            let map_lama = null;
            let map_baru = null;
            let marker = null;
            let marker_lama = null;
            let marker_baru = null;

            function tampilkanDetail(id) {
                fetch(`/admin/verifikasiwisatakuliner/detail/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        if (data.jenis_pengajuan === 'Baru') {
                            tampilkanDetailBaru(data);
                        } else {
                            tampilkanDetailPerubahan(data);
                        }
                    });
            }

            function tampilkanDetailBaru(data) {
                let baru = data.baru;
                let pengaju_baru = data.pengaju_baru;

                document.getElementById('modalTitle').textContent = baru.nama;
                document.getElementById('nama_pengaju').textContent = pengaju_baru.nama;
                document.getElementById('email').textContent = pengaju_baru.email;
                document.getElementById('peran').textContent = pengaju_baru.peran;
                document.getElementById('alamat').textContent = baru.alamat;
                document.getElementById('kecamatan').textContent = baru.kecamatan;
                document.getElementById('kelurahan').textContent = baru.kelurahan;
                document.getElementById('nomor_telepon').textContent = baru.no_telp ?? '-';
                document.getElementById('deskripsi').textContent = baru.deskripsi;
                document.getElementById('latitude').textContent = baru.latitude;
                document.getElementById('longitude').textContent = baru.longitude;
                document.getElementById('sertifikat_halal').textContent = baru.sertifikat_halal;

                // Foto
                const foto = document.getElementById('foto');
                if (baru.foto) {
                    foto.src = `/storage/${baru.foto}`;
                } else {
                    foto.src = `/storage/tidakadafoto.jpg`;
                }
                foto.classList.remove('hidden');

                // Fasilitas
                let fasilitas = baru.fasilitas || [];
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
                let kategori = baru.kategori || [];
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

                // Map
                const lat = parseFloat(baru.latitude);
                const lng = parseFloat(baru.longitude);

                const aksiDiv = document.getElementById('aksiVerifikasi');
                aksiDiv.innerHTML = '';

                if (baru.status === 'Belum Diverifikasi') {
                    aksiDiv.innerHTML = `
                                <button
                                    onclick="verifikasi(${baru.id_pengajuan}, 'Disetujui')"
                                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-full btn btn-primary">
                                    Setujui
                                </button>

                                <button
                                   onclick="verifikasi(${baru.id_pengajuan}, 'Ditolak')"
                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-full btn btn-primary">
                                    Tolak
                                </button>
                            `;
                }

                document.getElementById('detailBaru').classList.remove('hidden');

                const position = {
                    lat: lat,
                    lng: lng
                };

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
            }

            function tampilkanDetailPerubahan(data) {
                let lama = data.lama;
                let baru = data.baru;
                let pengaju_lama = data.pengaju_lama;
                let pengaju_baru = data.pengaju_baru;

                // lama
                document.getElementById('nama_lama').textContent = lama.nama;
                document.getElementById('nama_pengaju_lama').textContent = pengaju_lama.nama;
                document.getElementById('email_lama').textContent = pengaju_lama.email;
                document.getElementById('peran_lama').textContent = pengaju_lama.peran;
                document.getElementById('alamat_lama').textContent = lama.alamat;
                document.getElementById('kecamatan_lama').textContent = lama.kecamatan;
                document.getElementById('kelurahan_lama').textContent = lama.kelurahan;
                document.getElementById('nomor_telepon_lama').textContent = lama.no_telp ?? '-';
                document.getElementById('deskripsi_lama').textContent = lama.deskripsi;
                document.getElementById('latitude_lama').textContent = lama.latitude;
                document.getElementById('longitude_lama').textContent = lama.longitude;
                document.getElementById('sertifikat_halal_lama').textContent = lama.sertifikat_halal;

                // baru
                document.getElementById('nama_baru').textContent = baru.nama;
                document.getElementById('nama_pengaju_baru').textContent = pengaju_baru.nama;
                document.getElementById('email_baru').textContent = pengaju_baru.email;
                document.getElementById('peran_baru').textContent = pengaju_baru.peran;
                document.getElementById('alamat_baru').textContent = baru.alamat;
                document.getElementById('kecamatan_baru').textContent = baru.kecamatan;
                document.getElementById('kelurahan_baru').textContent = baru.kelurahan;
                document.getElementById('nomor_telepon_baru').textContent = baru.no_telp ?? '-';
                document.getElementById('deskripsi_baru').textContent = baru.deskripsi;
                document.getElementById('latitude_baru').textContent = baru.latitude;
                document.getElementById('longitude_baru').textContent = baru.longitude;
                document.getElementById('sertifikat_halal_baru').textContent = baru.sertifikat_halal;


                const statusLama = document.getElementById('status_operasional_lama');
                statusLama.textContent = lama.status_operasional;

                if (lama.status_operasional === 'Aktif') {
                    statusLama.classList.add('text-green-600', 'font-semibold');
                } else if (lama.status_operasional === 'Tutup Sementara') {
                    statusLama.classList.add('text-orange-500', 'font-semibold');
                } else if (lama.status_operasional === 'Tutup Permanen') {
                    statusLama.classList.add('text-red-600', 'font-semibold');
                }

                const statusBaru = document.getElementById('status_operasional_baru');
                statusBaru.textContent = baru.status_operasional;

                if (baru.status_operasional === 'Aktif') {
                    statusBaru.classList.add('text-green-600', 'font-semibold');
                } else if (baru.status_operasional === 'Tutup Sementara') {
                    statusBaru.classList.add('text-orange-500', 'font-semibold');
                } else if (baru.status_operasional === 'Tutup Permanen') {
                    statusBaru.classList.add('text-red-600', 'font-semibold');
                }

                // Foto
                // lama
                const foto_lama = document.getElementById('foto_lama');

                if (lama.foto) {
                    foto_lama.src = `/storage/${lama.foto}`;
                } else {
                    foto_lama.src = `/storage/tidakadafoto.jpg`;
                }
                foto_lama.classList.remove('hidden');
                // baru
                const foto_baru = document.getElementById('foto_baru');

                if (baru.foto) {
                    foto_baru.src = `/storage/${baru.foto}`;
                } else {
                    foto_baru.src = `/storage/tidakadafoto.jpg`;
                }
                foto_baru.classList.remove('hidden');

                // Fasilitas
                // lama
                let fasilitas_lama = lama.fasilitas || [];
                let container_lama = document.getElementById('fasilitas_lama');

                container_lama.innerHTML = '';
                if (fasilitas_lama.length > 0) {
                    fasilitas_lama.forEach(fl => {
                        let span = document.createElement('span');
                        span.textContent = fl.nama;

                        span.style.display = 'inline-block';
                        span.style.padding = '4px 4px';
                        span.style.margin = '2px';
                        span.style.backgroundColor = '#dddddd';
                        span.style.borderRadius = '4px';
                        span.style.fontSize = '12px';

                        container_lama.appendChild(span);
                    });
                } else {
                    container_lama.textContent = '-';
                }
                // baru
                let fasilitas_baru = baru.fasilitas || [];
                let container_baru = document.getElementById('fasilitas_baru');

                container_baru.innerHTML = '';
                if (fasilitas_baru.length > 0) {
                    fasilitas_baru.forEach(fb => {
                        let span = document.createElement('span');
                        span.textContent = fb.nama;

                        span.style.display = 'inline-block';
                        span.style.padding = '4px 4px';
                        span.style.margin = '2px';
                        span.style.backgroundColor = '#dddddd';
                        span.style.borderRadius = '4px';
                        span.style.fontSize = '12px';

                        container_baru.appendChild(span);
                    });
                } else {
                    container_baru.textContent = '-';
                }

                // Kategori
                // lama 
                let kategori_lama = lama.kategori || [];
                let containerKategori_lama = document.getElementById('kategori_lama');

                containerKategori_lama.innerHTML = '';
                if (kategori_lama.length > 0) {
                    kategori_lama.forEach(kl => {
                        let span = document.createElement('span');
                        span.textContent = kl.nama;

                        span.style.display = 'inline-block';
                        span.style.padding = '4px 4px';
                        span.style.margin = '2px';
                        span.style.backgroundColor = '#dddddd';
                        span.style.borderRadius = '4px';
                        span.style.fontSize = '12px';

                        containerKategori_lama.appendChild(span);
                    });
                } else {
                    containerKategori_lama.textContent = '-';
                }
                // baru 
                let kategori_baru = baru.kategori || [];
                let containerKategori_baru = document.getElementById('kategori_baru');

                containerKategori_baru.innerHTML = '';
                if (kategori_baru.length > 0) {
                    kategori_baru.forEach(kb => {
                        let span = document.createElement('span');
                        span.textContent = kb.nama;

                        span.style.display = 'inline-block';
                        span.style.padding = '4px 4px';
                        span.style.margin = '2px';
                        span.style.backgroundColor = '#dddddd';
                        span.style.borderRadius = '4px';
                        span.style.fontSize = '12px';

                        containerKategori_baru.appendChild(span);
                    });
                } else {
                    containerKategori_baru.textContent = '-';
                }

                // Map
                const lat_lama = parseFloat(lama.latitude);
                const lng_lama = parseFloat(lama.longitude);
                const lat_baru = parseFloat(baru.latitude);
                const lng_baru = parseFloat(baru.longitude);

                const aksiDivPerubahan = document.getElementById('aksiVerifikasiPerubahan');
                aksiDivPerubahan.innerHTML = '';

                if (baru.status === 'Belum Diverifikasi') {
                    aksiDivPerubahan.innerHTML = `
                                <button
                                    onclick="verifikasi(${baru.id_pengajuan}, 'Disetujui')"
                                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-full btn btn-primary">
                                    Setujui
                                </button>

                                <button
                                   onclick="verifikasi(${baru.id_pengajuan}, 'Ditolak')"
                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-full btn btn-primary">
                                    Tolak
                                </button>
                            `;
                }

                document.getElementById('detailPerubahan').classList.remove('hidden');

                const position_lama = {
                    lat: lat_lama,
                    lng: lng_lama
                };

                const position_baru = {
                    lat: lat_baru,
                    lng: lng_baru
                };

                if (!map_lama) {
                    map_lama = new google.maps.Map(document.getElementById("map_lama"), {
                        center: position_lama,
                        zoom: 16,
                        mapId: "b434fd3b6bf402cdbbb8f248",
                        clickableIcons: false,
                    });

                    marker_lama = new google.maps.marker.AdvancedMarkerElement({
                        position: position_lama,
                        map: map_lama,
                    });
                } else {
                    map_lama.setCenter(position_lama);
                    marker_lama.position = position_lama;
                }

                if (!map_baru) {
                    map_baru = new google.maps.Map(document.getElementById("map_baru"), {
                        center: position_baru,
                        zoom: 16,
                        mapId: "b434fd3b6bf402cdbbb8f248",
                        clickableIcons: false,
                    });

                    marker_baru = new google.maps.marker.AdvancedMarkerElement({
                        position: position_baru,
                        map: map_baru,
                    });
                } else {
                    map_baru.setCenter(position_baru);
                    marker_baru.position = position_baru;
                }
            }

            function tutupDetailBaru() {
                document.getElementById('detailBaru').classList.add('hidden');
            }

            function tutupDetailPerubahan() {
                document.getElementById('detailPerubahan').classList.add('hidden');
            }

            function verifikasi(id, status) {
                if (status === 'Disetujui') {
                    Swal.fire({
                        title: 'Setujui wisata kuliner?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Setujui',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#16a34a',
                        cancelButtonColor: '#6b7280',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/admin/verifikasiwisatakuliner/${id}`, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        status: 'Disetujui'
                                    })
                                })
                                .then(res => res.json())
                                .then(res => {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: res.message,
                                        timer: 2000,
                                        showConfirmButton: false
                                    }).then(() => location.reload());
                                });
                        }
                    });

                } else {
                    Swal.fire({
                        title: 'Tolak wisata kuliner?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Tolak',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#dc2626',
                        cancelButtonColor: '#6b7280',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/admin/verifikasiwisatakuliner/${id}`, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        status: 'Ditolak'
                                    })
                                })
                                .then(res => res.json())
                                .then(res => {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: res.message,
                                        timer: 2000,
                                        showConfirmButton: false
                                    }).then(() => location.reload());
                                });
                        }
                    });
                }
            }
        </script>
</body>

</html>
