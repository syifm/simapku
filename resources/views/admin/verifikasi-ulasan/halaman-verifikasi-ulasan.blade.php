<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAPKU | Verifikasi Ulasan</title>
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
        <h1 class="font-bold text-xl">Verifikasi Ulasan</h1>

        <div class="flex-1 overflow-hidden ml-1">
            <div class="bg-white-100 pt-0">
                <div class="mt-14">
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
                                            class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#094B3C]">
                                            No
                                        </th>
                                        <th
                                            class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#094B3C]">
                                            Wisata Kuliner
                                        </th>
                                        <th
                                            class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#094B3C]">
                                            Ulasan
                                        </th>
                                        <th
                                            class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#094B3C]">
                                            Status Verifikasi
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
                                            class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#094B3C]">
                                            No
                                        </th>
                                        <th
                                            class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#094B3C]">
                                            Wisata Kuliner
                                        </th>
                                        <th
                                            class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#094B3C]">
                                            Ulasan
                                        </th>
                                        <th
                                            class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#094B3C]">
                                            Status Verifikasi
                                        </th>
                                        <th
                                            class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#094B3C]">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach ($penilaianDanUlasan as $ulasan)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                                                {{ $ulasan->nomor }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                                                {{ $ulasan->wisataKuliner->nama }}
                                            </td>
                                            <td
                                                class="px-4 py-3 text-sm text-gray-900 border border-black text-justify">
                                                {{ \Illuminate\Support\Str::limit($ulasan->ulasan, 50) }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                                                {{ $ulasan->status }}
                                            </td>
                                            <td class="px-4 py-3 text-sm border-b border-r border-black align-middle">
                                                <div class="flex justify-center items-center h-full gap-2">
                                                    @if ($ulasan->status == 'Belum Diverifikasi')
                                                        <button
                                                            onclick="tampilkanModalVerifikasi({{ $ulasan->id_penilaian_dan_ulasan }})"
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
                                                        <button
                                                            onclick="tampilkanModalVerifikasi({{ $ulasan->id_penilaian_dan_ulasan }})"
                                                            class="bg-[#094B3C] hover:bg-[#06362a] text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.7"
                                                                stroke="currentColor" class="size-5">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                                            </svg>
                                                            <span class="ml-1">Detail</span>
                                                        </button>
                                                        <form id="delete-form-{{ $ulasan->id_ulasan }}"
                                                            action="{{ route('ulasan.hapus', $ulasan->id_penilaian_dan_ulasan) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button"
                                                                onclick="konfirmasiHapus({{ $ulasan->id_penilaian_dan_ulasan }})"
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
                                                    @endif
                                                </div>
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

                    <div id="detailModal"
                        class="fixed left-[300px] right-0 top-0 bottom-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto">
                        <div class="relative top-20 mx-auto p-5 border w-[500px] shadow-lg rounded-xl bg-white">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold flex-1 text-center" id="modalTitle">Penilaian dan
                                    Ulasan</br></h3>
                                <button onclick="tutupModalVerifikasi()" class="text-gray-400 hover:text-gray-500">
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
                                <div id="aksiVerifikasi" class="flex justify-end gap-4 mt-6 text-sm"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="flex flex-col items-center gap-2">
                <div
                    class="flex items-center w-full max-w-xl border rounded-full overflow-hidden shadow-sm font-medium">
                    <input type="text" placeholder="Cari Kuliner Disini..."
                        class="flex-1 px-5 py-3 focus:outline-none">
                    <button class="bg-[#FFA319] px-4 py-3 text-white hover:bg-[#F19305] transition">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>

                </div>
            </div> --}}
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
            function tampilkanModalVerifikasi(id) {
                fetch(`/admin/verifikasiulasan/detail/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('modalTitle').textContent = data.wisata_kuliner.nama;
                        document.getElementById('nilai').textContent = data.penilaian;
                        document.getElementById('ulasan').textContent = data.ulasan;
                        document.getElementById('email_pengulas').textContent = data.email_pengulas;

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

                        const aksiDiv = document.getElementById('aksiVerifikasi');
                        aksiDiv.innerHTML = '';

                        if (data.status === 'Belum Diverifikasi') {
                            aksiDiv.innerHTML = `
                                <button
                                    onclick="aksiSetujui(${data.id_penilaian_dan_ulasan})"
                                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-full btn btn-primary">
                                    Setujui
                                </button>

                                <button
                                    onclick="aksiTolak(${data.id_penilaian_dan_ulasan})"
                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-full btn btn-primary">
                                    Tolak
                                </button>
                            `;
                        }

                        document.getElementById('detailModal').classList.remove('hidden');
                    });
            }

            function tutupModalVerifikasi() {
                document.getElementById('detailModal').classList.add('hidden');
            }

            function konfirmasiHapus(id) {
                Swal.fire({
                    title: 'Yakin untuk hapus ulasan?',
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

            function aksiSetujui(id) {
                Swal.fire({
                    title: 'Setujui Penilaian dan Ulasan?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#16a34a',
                    confirmButtonText: 'Setujui',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        kirimAksi(id, 'Disetujui');
                    }
                });
            }

            function aksiTolak(id) {
                Swal.fire({
                    title: 'Tolak Penilaian dan Ulasan',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    confirmButtonText: 'Tolak',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        kirimAksi(id, 'Ditolak', result.value);
                    }
                });
            }

            function kirimAksi(id, status, komentar = null) {
                fetch(`/admin/verifikasiulasan/${id}`, {
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
