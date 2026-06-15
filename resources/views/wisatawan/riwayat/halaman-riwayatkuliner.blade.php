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

    @php
        $activeTab = request('tab', 'wisatakuliner');
    @endphp

    @include('layouts.sidebar-wisatawan')
    <div class="pt-[38px] pl-[350px] pr-[50px] pb-[30px] overflow-y-auto min-h-screen">
        <h1 class="font-bold text-xl -mt-2">Riwayat Pengajuan</h1>

        <div class="ml-1 mr-1 mt-12">
            <div class="flex w-full border-b">
                <button id="tabKuliner"
                    class="tab-btn flex-1 px-4 py-3 text-center font-semibold border-b-2 {{ $activeTab === 'wisatakuliner' ? 'border-[#004440]' : 'border-[#d8d8d8]' }}">
                    Wisata Kuliner
                </button>
                <button id="tabUlasan"
                    class="tab-btn flex-1 px-4 py-3 text-center font-semibold border-b-2 {{ $activeTab === 'ulasan' ? 'border-[#004440]' : 'border-[#d8d8d8]' }}">
                    Ulasan
                </button>
            </div>
            <div class="flex-1 overflow-hidden ml-1 w-full">
                <div class="bg-white-100 pt-0">
                    <div id="contentKuliner" class="{{ $activeTab === 'wisatakuliner' ? '' : 'hidden' }}">
                        @if ($wisataKuliner->isEmpty())
                            <div class="bg-white rounded-lg mt-4">
                                <table class="table-fixed w-full border-collapse border border-black">
                                    <colgroup>
                                        <col style="width: 35px">
                                        <col style="width: 180px">
                                        <col style="width: 150px">
                                        <col style="width: 90px">
                                        <col style="width: 90px">
                                        <col style="width: 90px">
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
                                                Deskripsi
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
                                            <td colspan="6" style="text-align: center"
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
                                        <col style="width: 35px">
                                        <col style="width: 180px">
                                        <col style="width: 150px">
                                        <col style="width: 90px">
                                        <col style="width: 90px">
                                        <col style="width: 90px">
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
                                                Deskripsi
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
                                                    class="px-4 py-3 text-sm text-gray-900 border border-black text-justify">
                                                    {{ \Illuminate\Support\Str::limit($kuliner->deskripsi, 50) }}
                                                </td>
                                                <td
                                                    class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                                                    {{ $kuliner->status }}
                                                </td>
                                                <td
                                                    class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                                                    {{ \Carbon\Carbon::parse($kuliner->waktu_diubah)->format('d/m/Y H:i') }}
                                                </td>
                                                <td class="px-4 py-3 text-sm border-b border-r border-black">
                                                    <div class="flex justify-center gap-2">
                                                        <button
                                                            onclick="klikDetailKuliner({{ $kuliner->id_pengajuan }})"
                                                            class="bg-[#004440] hover:bg-[#06362a] text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.7"
                                                                stroke="currentColor" class="size-5">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                                            </svg>
                                                            <span class="ml-1">Detail</span>
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
                    <div id="contentUlasan" class="{{ $activeTab === 'ulasan' ? '' : 'hidden' }}">
                        @include('wisatawan.riwayat.halaman-riwayatulasan')
                    </div>
                </div>
            </div>

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
            // const tabKuliner = document.getElementById('tabKuliner');
            // const tabUlasan = document.getElementById('tabUlasan');

            // const contentKuliner = document.getElementById('contentKuliner');
            // const contentUlasan = document.getElementById('contentUlasan');

            // function aktifkanTab(tab) {

            //     if (tab === 'ulasan') {

            //         contentUlasan.classList.remove('hidden');
            //         contentKuliner.classList.add('hidden');

            //         tabUlasan.classList.add('border-b-2', 'border-[#004440]', 'text-[#004440]');
            //         tabKuliner.classList.remove('border-b-2', 'border-[#004440]', 'text-[#004440]');

            //     } else {

            //         contentKuliner.classList.remove('hidden');
            //         contentUlasan.classList.add('hidden');

            //         tabKuliner.classList.add('border-b-2', 'border-[#004440]', 'text-[#004440]');
            //         tabUlasan.classList.remove('border-b-2', 'border-[#004440]', 'text-[#004440]');
            //     }
            // }

            // tabKuliner.addEventListener('click', () => {
            //     aktifkanTab('wisatakuliner');
            // });

            // tabUlasan.addEventListener('click', () => {
            //     aktifkanTab('ulasan');
            // });

            // const params = new URLSearchParams(window.location.search);
            // const activeTab = params.get('tab');

            // aktifkanTab(activeTab);

            const tabKuliner = document.getElementById('tabKuliner');
            const tabUlasan = document.getElementById('tabUlasan');

            const contentKuliner = document.getElementById('contentKuliner');
            const contentUlasan = document.getElementById('contentUlasan');

            function aktifkanTab(tab) {
                const params = new URLSearchParams();
                params.set('tab', tab);

                const currentParams = new URLSearchParams(window.location.search);

                if (tab === 'wisatakuliner' && currentParams.has('wisatakuliner')) {
                    params.set('wisatakuliner', currentParams.get('wisatakuliner'));
                }

                if (tab === 'ulasan' && currentParams.has('ulasan')) {
                    params.set('ulasan', currentParams.get('ulasan'));
                }

                window.history.replaceState({},
                    '',
                    `${window.location.pathname}?${params.toString()}`
                );

                tabKuliner.classList.remove('border-[#004440]');
                tabUlasan.classList.remove('border-[#004440]');

                tabKuliner.classList.add('border-[#d8d8d8]');
                tabUlasan.classList.add('border-[#d8d8d8]');

                contentKuliner.classList.add('hidden');
                contentUlasan.classList.add('hidden');

                if (tab === 'wisatakuliner') {
                    contentKuliner.classList.remove('hidden');
                    contentUlasan.classList.add('hidden');

                    tabKuliner.classList.remove('border-[#d8d8d8]');
                    tabKuliner.classList.add('border-[#004440]');
                } else {
                    contentUlasan.classList.remove('hidden');
                    contentKuliner.classList.add('hidden');

                    tabUlasan.classList.remove('border-[#d8d8d8]');
                    tabUlasan.classList.add('border-[#004440]');
                }
            }

            tabKuliner.addEventListener('click', () => {
                aktifkanTab('wisatakuliner');
            });

            tabUlasan.addEventListener('click', () => {
                aktifkanTab('ulasan');
            });

            let map = null;
            let marker = null;

            function klikDetailKuliner(id) {
                fetch(`/wisatawan/riwayatpengajuan/detail/kuliner/${id}`)
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

            function tutupDetailKuliner() {
                document.getElementById('detailKuliner').classList.add('hidden');
            }
        </script>
</body>

</html>
