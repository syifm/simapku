<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIMAPKU | Kelola Ulasan</title>
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
        <h1 class="font-bold text-xl">Kelola Ulasan</h1>

        <div class="flex-1 overflow-hidden ml-1">
            <div class="bg-white-100 pt-0">
                <div class="mt-14">
                    @if ($ulasankuliner->isEmpty())
                        <div class="bg-white rounded-lg mt-4">
                            <table class="table-fixed w-full border-collapse border border-black">
                                <colgroup>
                                    <col style="width: 30px">
                                    <col style="width: 90px">
                                    <col style="width: 90px">
                                    <col style="width: 40px">
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
                                            Status
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
                                            Belum Tersedia Ulasan Wisata Kuliner</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="bg-white rounded-lg mt-4">
                            <table class="table-fixed w-full border-collapse border-b-0 border-black">
                                <colgroup>
                                    <col style="width: 30px">
                                    <col style="width: 90px">
                                    <col style="width: 90px">
                                    <col style="width: 40px">
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
                                            Status
                                        </th>
                                        <th
                                            class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach ($ulasankuliner as $ulasan)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                                                {{ $ulasan->nomor }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-900 border border-black">
                                                {{ $ulasan->wisataKuliner->nama }}
                                            </td>
                                            <td
                                                class="px-4 py-3 text-sm text-gray-900 border border-black text-justify">
                                                {{ \Illuminate\Support\Str::limit($ulasan->ulasan, 50) }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                                                {{ $ulasan->status_penampilan }}
                                            </td>
                                            <td class="px-4 py-3 text-sm border-b border-r border-black">
                                                <div class="flex justify-center items-center h-full gap-2">
                                                    <button onclick="klikDetail({{ $ulasan->id_ulasan }})"
                                                        class="bg-[#004440] hover:bg-[#06362a] text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor"
                                                            class="size-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                                        </svg>
                                                        <span class="ml-1">Detail</span>
                                                    </button>
                                                    <button
                                                        onclick="klikStatus(
                                                                {{ $ulasan->id_ulasan }},
                                                                '{{ $ulasan->status_penampilan }}'
                                                            )"
                                                        class="bg-blue-800 hover:bg-blue-900 text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="size-5">
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
                            {{ $ulasankuliner->links('pagination::tailwind') }}
                        </div>
                    @endif

                    <div id="detailUlasan" {{-- class="fixed left-[300px] right-0 top-0 bottom-0 bg-black bg-opacity-40 hidden overflow-y-auto"> --}}
                        class="fixed inset-0 bg-black/40 hidden z-[9999] overflow-y-auto bg-black bg-opacity-40">
                        <div class="relative top-20 mx-auto p-5 border w-[500px] shadow-lg rounded-xl bg-white">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold flex-1 text-center" id="modalTitle">Ulasan</br></h3>
                                <button onclick="tutupDetailUlasan()" class="text-gray-400 hover:text-gray-500">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <div class="mt-4">
                                <h4 class="font-semibold text-sm border-b pb-1 mb-3">
                                    Identitas Pengulas
                                </h4>
                                <div class="grid grid-cols-2 gap-2 text-xs">
                                    <div class="flex justify-between w-32">
                                        <strong>Nama</strong>
                                    </div>

                                    <div class="grid grid-cols-[8px_2fr] gap-1 -ml-10">
                                        <div>:</div>
                                        <div><span id="nama_pengulas"></span></div>
                                    </div>

                                    <div class="flex justify-between w-32">
                                        <strong>Email</strong>
                                    </div>

                                    <div class="grid grid-cols-[8px_2fr] gap-1 -ml-10">
                                        <div>:</div>
                                        <div><span id="email"></span></div>
                                    </div>
                                </div>

                                <h4 class="font-semibold text-sm border-b pb-1 mb-3 mt-6">
                                    Detail Wisata Kuliner
                                </h4>
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
                                        <div>
                                            <img id="foto_ulasan" src="" alt="Foto Ulasan"
                                                class="w-full max-w-xs h-40 object-cover rounded-md border hidden">
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

        <script>
            function klikDetail(id) {
                fetch(`/admin/kelolaulasan/detail/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('modalTitle').textContent = data.wisata_kuliner.nama;
                        document.getElementById('nama_pengulas').textContent = data.nama_pengulas;
                        document.getElementById('email').textContent = data.email;
                        document.getElementById('nilai').textContent = data.penilaian;
                        document.getElementById('ulasan').textContent = data.ulasan;

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
                        const foto = document.getElementById('foto_ulasan');

                        if (data.foto_ulasan) {
                            // container.innerHTML =
                            //     `<img src="/storage/${data.foto_ulasan}" class="object-cover rounded">`;
                            foto.src = `/storage/${data.foto_ulasan}`;
                        } else {
                            foto.src = `/storage/tidakadafoto.jpg`;
                        }
                        foto.classList.remove('hidden');

                        document.getElementById('detailUlasan').classList.remove('hidden');
                    });
            }

            function tutupDetailUlasan() {
                document.getElementById('detailUlasan').classList.add('hidden');
            }

            function klikStatus(id, status) {
                let statusBaru = '';
                let pertanyaan = '';

                if (status === 'Tampil') {
                    statusBaru = 'Tidak Tampil';
                    pertanyaan = 'Sembunyikan Ulasan?';
                } else {
                    statusBaru = 'Tampil';
                    pertanyaan = 'Tampilkan Ulasan?';
                }

                Swal.fire({
                    title: pertanyaan,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#16A34A',
                    cancelButtonColor: '#6B7280',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/admin/kelolaulasan/ubahstatus/${id}`, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                },
                                body: JSON.stringify({
                                    status: statusBaru
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: data.message,
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            })
                            .catch(() => {
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat mengubah status.',
                                    'error'
                                );
                            });
                    }
                });
            }
        </script>
</body>

</html>
