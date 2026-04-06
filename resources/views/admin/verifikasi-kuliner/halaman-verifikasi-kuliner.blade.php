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
        <h1 class="font-bold text-xl">Verifikasi Wisata Kuliner</h1>

        <div class="flex-1 overflow-hidden ml-1">
            <div class="bg-white-100 pt-0">
                <div class="mt-14">
                    @if (!$statuswisatakuliner)
                        <table class="table-fixed w-full border-collapse border border-black">
                            <colgroup>
                                <col style="width: 60px">
                                <col style="width: 600px">
                                <col style="width: 300px">
                                <col style="width: 171px">
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
                                    <col style="width: 160px">
                                    <col style="width: 100px">
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
                                            Status Verifikasi
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
                                            <td
                                                class="px-4 py-3 text-sm border-b border-r border-black flex justify-center gap-2">
                                                @if ($kuliner->status == 'Belum Diverifikasi')
                                                    <button onclick="showDetail({{ $kuliner->id_wisata_kuliner }})"
                                                        class="bg-[#FFA319] hover:bg-[#F19305] text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor"
                                                            class="size-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                                                        </svg>
                                                        <span class="ml-1">Verifikasi</span>
                                                    </button>
                                                @else
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
                                                @endif
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
                        class="fixed left-[300px] right-0 top-0 bottom-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto">
                        <div class="relative top-5 mx-auto p-5 border w-[500px] shadow-lg rounded-xl bg-white">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold flex-1 text-center" id="modalTitle"></h3>
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
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-gBdR_gqZTd8B6jz3mVJWI-pqC_jPlAI&callback=initApp&libraries=maps,marker&v=weekly"
            async defer></script>
        <script>
            let map = null;
            let marker = null;

            function showDetail(id) {
                fetch(`/admin/verifikasiwisatakuliner/detail/${id}`)
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

                        if (data.status === 'Belum Diverifikasi') {
                            aksiDiv.innerHTML = `
                                <button
                                    onclick="aksiSetujui(${data.id_wisata_kuliner})"
                                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-full btn btn-primary">
                                    Setujui
                                </button>

                                <button
                                    onclick="aksiTolak(${data.id_wisata_kuliner})"
                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-full btn btn-primary">
                                    Tolak
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
                                styles: [{
                                    featureType: "poi.business",
                                    stylers: [{
                                        visibility: "off"
                                    }]
                                }]
                            });

                            marker = new google.maps.Marker({
                                position: position,
                                map: map,
                            });
                        } else {
                            map.setCenter(position);
                            marker.setPosition(position);
                        }
                    });
            }

            function tampilkanModalVerifikasi(id) {
                fetch(`/admin/verifikasiwisatakuliner/${id}`)
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

                        const aksiDiv = document.getElementById('aksiVerifikasi');
                        aksiDiv.innerHTML = '';

                        if (data.status == 'Belum Diverifikasi') {
                            `<div class="grid grid-cols-2 justify-end">
                                <button
                                    onclick="aksiSetujui(${data.id_wisata_kuliner})"
                                    class="bg-[#094B3C] hover:bg-[#06362a] text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor"
                                    class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m4.5 12.75 6 6 9-13.5" /></svg>
                                    <span class="ml-1">Setujui</span>
                                </button>

                                <button
                                    onclick="aksiTolak(${data.id_wisata_kuliner})"
                                    class="bg-[#094B3C] hover:bg-[#06362a] text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor"
                                    class="size-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                    <span class="ml-1">Tolak</span>
                                </button>
                            </div>`;
                        }

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
                    });
            }

            function tutupModalVerifikasi() {
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

            function aksiSetujui(id) {
                Swal.fire({
                    title: 'Verifikasi Wisata Kuliner',
                    text: 'Pilih tindakan',
                    icon: 'question',
                    showCancelButton: true,
                    showDenyButton: true,
                    confirmButtonText: 'Setujui & Tampilkan',
                    denyButtonText: 'Setujui Saja',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        kirimAksi(id, 'Tampilkan');
                    }
                    if (result.isDenied) {
                        kirimAksi(id, 'Disetujui');
                    }
                });
            }

            function aksiTolak(id) {
                Swal.fire({
                    title: 'Tolak Wisata Kuliner',
                    input: 'textarea',
                    inputLabel: 'Alasan Penolakan',
                    inputPlaceholder: 'Tulis alasan...',
                    showCancelButton: true,
                    confirmButtonText: 'Tolak',
                    cancelButtonText: 'Batal',
                    inputValidator: (value) => {
                        if (!value) return 'Komentar wajib diisi';
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        kirimAksi(id, 'Ditolak', result.value);
                    }
                });
            }

            function kirimAksi(id, status, komentar = null) {
                fetch(`/admin/verifikasiwisatakuliner/${id}`, {
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
                        Swal.fire('Berhasil', res.message, 'success')
                            .then(() => location.reload());
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
