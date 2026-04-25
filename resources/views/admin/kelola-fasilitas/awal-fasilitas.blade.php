<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAPKU | Kelola Fasilitas</title>
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
        <div class="mt-3 text-sm flex justify-start gap-6">
            <a href="{{ route('kelolawisatakuliner') }}"
                class="back-btn w-10 flex items-center justify-center group relative cursor-pointer">
                <span
                    class="absolute w-10 h-10 rounded-full bg-gray-200 
               scale-0 group-hover:scale-100 
               transition duration-50"></span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                    stroke="currentColor" class="size-5 relative z-10">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>
            <div class="-mt-1">
                <h1 class="font-bold text-xl">Daftar Fasilitas</h1>
            </div>
        </div>

        <div class="flex justify-end gap-4 -mt-2">
            <a onclick="openTambahModal()"
                class="cursor-pointer bg-[#FFA319] hover:bg-[#F19305]
                btn btn-primary text-white rounded-full px-4 py-2 mt-14 text-sm flex items-center gap-1 transition mb-1">
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
                    @if (!$fasilitas)
                        <div class="bg-white rounded-lg mt-4">
                            <table class="table-fixed w-full border-collapse border border-black">
                                <colgroup>
                                    <col style="width: 20px">
                                    <col style="width: 140px">
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
                                            Fasilitas
                                        </th>
                                        <th
                                            class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#094B3C]">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    <tr>
                                        <td colspan="3" style="text-align: center"
                                            class="px-4 py-3 text-sm text-black">
                                            Belum Tersedia Fasilitas</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="bg-white rounded-lg mt-4">
                            <table class="table-fixed w-full border-collapse border-b-0 border-black">
                                <colgroup>
                                    <col style="width: 20px">
                                    <col style="width: 140px">
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
                                            Fasilitas
                                        </th>
                                        <th
                                            class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#094B3C]">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach ($fasilitas as $k)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                                                {{ $k->nomor }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                                                {{ $k->nama }}
                                            </td>
                                            <td
                                                class="px-4 py-3 text-sm border-b border-r border-black flex justify-center gap-2">
                                                <button type="button"
                                                    onclick="openDetailModal({{ $k->id_fasilitas }}, {{ $k->wisata_kuliner_count }})"
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
                                                    onclick="openEditModal({{ $k->id_fasilitas }}, @js($k->nama))"
                                                    class="bg-[#FFA319] hover:bg-[#F19305] text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                        class="size-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                    </svg>
                                                    <span class="ml-1">Edit</span>
                                                </button>
                                                <button type="button"
                                                    onclick="openHapusModal({{ $k->id_fasilitas }}, {{ $k->wisata_kuliner_count }})"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor"
                                                        class="size-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>
                                                    <span class="ml-1">Hapus</span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $fasilitas->links('pagination::tailwind') }}
                        </div>
                    @endif
                </div>

                <div id="modalDetail"
                    class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center overflow-y-auto">
                    <div class="bg-white p-6 rounded-xl w-[700px] relative">
                        <button onclick="closeDetailModal()" class="absolute top-3 right-3 text-lg">✕</button>
                        <h2 class="text-lg font-semibold mb-2">Detail Fasilitas</h2>

                        <p class="text-sm text-gray-600 mb-4">
                            Digunakan oleh <span id="jumlahDipakaiDetail" class="font-bold"></span> wisata kuliner
                        </p>

                        <div class="max-h-64 overflow-y-auto border rounded-lg">
                            <table class="w-full text-sm">
                                <thead class="bg-gray-100 sticky top-0">
                                    <tr>
                                        <th class="p-2 text-center">Wisata Kuliner</th>
                                    </tr>
                                </thead>

                                <tbody id="tableBodyDetail">

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <div id="modalFasilitas"
                    class="fixed left-0 right-0 top-0 bottom-0 bg-black bg-opacity-40 hidden overflow-y-auto z-50 items-center justify-center">
                    <div
                        class="relative left-[30px] top-[220px] mx-auto p-5 border w-[400px] shadow-lg rounded-xl bg-white">
                        <button type="button" onclick="closeModal()"
                            class="absolute right-4 top-3 text-xl">✕</button>

                        <h2 id="modalTitle" class="text-lg font-semibold mb-4"></h2>

                        <form id="formFasilitas" method="POST">
                            @csrf
                            <input type="hidden" name="_method" id="methodField">

                            <input type="text" name="nama" id="namaFasilitas"
                                class="w-full border rounded-lg px-3 py-2 mb-4" placeholder="Nama fasilitas">

                            <div class="flex justify-end gap-2">
                                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">
                                    Simpan
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

                <div id="modalHapus"
                    class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center overflow-y-auto">

                    <div class="bg-white p-6 rounded-xl w-[700px] relative">

                        <button onclick="closeHapusModal()" class="absolute top-3 right-3 text-lg">✕</button>

                        <h2 class="text-lg font-semibold mb-2">Hapus Fasilitas</h2>

                        <p class="text-sm text-gray-600 mb-4">
                            Digunakan oleh <span id="jumlahDipakai" class="font-bold"></span> wisata kuliner
                        </p>

                        <form id="formHapus" method="POST">
                            @csrf
                            @method('DELETE')

                            <div class="mb-4">
                                <label class="text-sm">Pindahkan fasilitas:</label>
                                <select id="globalSelect" class="w-full border px-3 py-2 rounded-lg">
                                    <option value="">-- Pilih fasilitas --</option>
                                </select>
                            </div>

                            <div class="max-h-64 overflow-y-auto border rounded-lg">
                                <table class="w-full text-sm">
                                    <thead class="bg-gray-100 sticky top-0">
                                        <tr>
                                            <th class="p-2 text-center">Wisata Kuliner</th>
                                            <th class="p-2">Fasilitas</th>
                                            <th class="p-2">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody id="tableBody">

                                    </tbody>
                                </table>
                            </div>

                            <div class="flex justify-end mt-4">
                                <button class="bg-red-600 text-white px-4 py-2 rounded-lg">
                                    Hapus Fasilitas
                                </button>
                            </div>
                        </form>
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
        const allFasilitas = @json($fasilitas->items());;
        const allKuliner = @json($wisataKuliner);

        let fasilitasDihapus = null;

        function openHapusModal(id, jumlah) {
            fasilitasDihapus = id;

            if (jumlah == 0) {
                Swal.fire({
                    title: 'Hapus Fasilitas?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal'
                }).then(result => {
                    const form = document.getElementById('formHapus');
                        form.action = `/admin/kelolafasilitas/hapus/${id}`;
                        form.submit();
                });
                return;
            }

            document.getElementById('jumlahDipakai').innerText = jumlah;

            const form = document.getElementById('formHapus');
            form.action = `/admin/kelolafasilitas/hapus/${id}`;

            const tbody = document.getElementById('tableBody');
            const globalSelect = document.getElementById('globalSelect');

            tbody.innerHTML = "";
            globalSelect.innerHTML = '<option value="">Pilih fasilitas</option>';

            const fasilitasValid = allFasilitas.filter(k => k.id_fasilitas != id);
            fasilitasValid.forEach(k => {
                globalSelect.innerHTML += `<option value="${k.id_fasilitas}">${k.nama}</option>`;
            });

            const kulinerTerpakai = allKuliner.filter(k =>
                k.fasilitas.some(kt => kt.id_fasilitas == id)
            );

            kulinerTerpakai.forEach(item => {
                const fasilitasDipakai = item.fasilitas.map(k => k.id_fasilitas);
                const fasilitasTersedia = allFasilitas.filter(k =>
                    k.id_fasilitas != id &&
                    !fasilitasDipakai.includes(k.id_fasilitas)
                );
                let select = `<select name="reassign[${item.id_wisata_kuliner}]" class="reassign-select border px-2 py-1 rounded w-[200px] min-w-[140px] max-w-full">
            <option value="">Pilih Fasilitas</option>`;

                if (fasilitasTersedia.length > 0) {
                    fasilitasTersedia.forEach(k => {
                        select += `<option value="${k.id_fasilitas}">${k.nama}</option>`;
                    });
                } else {
                    select = `<div class="h-[38px] flex items-center justify-center text-gray-400 text-sm">
                        Tidak tersedia
                    </div>`;
                }

                select += `</select>`;

                tbody.innerHTML += `
                    <tr class="border-t">
                        <td class="p-2">${item.nama}</td>
                        <td class="p-2 text-center">${select}<p class="text-red-500 text-xs mt-1 hidden error-text">
                            Pilih fasilitas atau hapus
                        </p></td>
                        <td class="p-2 text-center">
                            <div class="flex justify-center">
                            <button type="button" onclick="toggleHapusItem(event, ${item.id_wisata_kuliner})" class=" hover:text-red-700 text-red-500 px-4 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor"
                                    class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                            </div>
                        </td>
                    </tr>
                `;
            });

            globalSelect.addEventListener('change', function() {
                const val = this.value;

                document.querySelectorAll("select[name^='reassign']").forEach(s => {
                    s.value = val;
                });
            });

            document.getElementById('modalHapus').classList.remove('hidden');
        }

        function hapusItem(e, id) {

            const kuliner = allKuliner.find(k => k.id_wisata_kuliner == id);
            if (!kuliner) return;

            // if (kuliner.fasilitas.length <= 1) {
            //     Swal.fire({
            //         icon: 'warning',
            //         title: 'Tidak Dapat Dihapus',
            //         text: 'Kuliner ini hanya memiliki 1 fasilitas. Silakan pindahkan ke fasilitas lain terlebih dahulu'
            //     });
            //     return;
            // }

            let input = document.createElement('input');
            input.type = "hidden";
            input.name = "hapus_ids[]";
            input.value = id;

            document.getElementById('formHapus').appendChild(input);

            const row = e.target.closest('tr');

            row.setAttribute('data-deleted', 'true');

            const select = row.querySelector('.reassign-select');
            if (select) select.disabled = true;

            row.classList.add('opacity-50');
        }

        document.getElementById('formHapus').addEventListener('submit', function(e) {

            let valid = true;
            const rows = document.querySelectorAll("#tableBody tr");

            rows.forEach(row => {

                const select = row.querySelector(".reassign-select");
                const errorText = row.querySelector(".error-text");
                const isDeleted = row.getAttribute('data-deleted') === 'true';

                const id = select?.name.match(/\d+/)?.[0];
                const kuliner = allKuliner.find(k => k.id_wisata_kuliner == id);

                if (!kuliner) return;

                const jumlahFasilitas = kuliner.fasilitas.length;

                if (!isDeleted && !select.value) {
                    valid = false;
                    errorText.classList.remove('hidden');
                    select.classList.add('border-red-500');
                } else {
                    errorText.classList.add('hidden');
                    select.classList.remove('border-red-500');
                }

            });

            if (!valid) {
                e.preventDefault();

                Swal.fire({
                    icon: 'warning',
                    title: 'Tidak Dapat Dihapus',
                    text: 'Semua wisata kuliner harus dihapus atau dipindahkan ke fasilitas lain terlebih dahulu'
                });

                return;
            }

            e.preventDefault();

            Swal.fire({
                title: 'Hapus Fasilitas?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.submit();
                }
            });

        });


        function toggleHapusItem(e, id) {

            const row = e.target.closest('tr');
            const form = document.getElementById('formHapus');
            const select = row.querySelector('.reassign-select');
            const btn = row.querySelector('.btn-hapus');

            const kuliner = allKuliner.find(k => k.id_wisata_kuliner == id);
            if (!kuliner) return;

            const isDeleted = row.getAttribute('data-deleted') === 'true';

            if (!isDeleted) {

                // if (kuliner.fasilitas.length <= 1) {
                //     Swal.fire({
                //         icon: 'warning',
                //         title: 'Tidak Dapat Dihapus',
                //         text: 'Kuliner ini hanya memiliki 1 fasilitas. Silakan pindahkan ke fasilitas lain terlebih dahulu'
                //     });
                //     return;
                // }

                let input = document.createElement('input');
                input.type = "hidden";
                input.name = "hapus_ids[]";
                input.value = id;
                input.setAttribute('data-id', id);

                form.appendChild(input);

                row.setAttribute('data-deleted', 'true');
                row.classList.add('opacity-50');

                if (select) select.disabled = true;

                btn.classList.remove('bg-red-600');
                btn.classList.add('bg-gray-500');

            } else {
                const input = form.querySelector(`input[name="hapus_ids[]"][value="${id}"]`);
                if (input) input.remove();

                row.setAttribute('data-deleted', 'false');
                row.classList.remove('opacity-50');

                if (select) select.disabled = false;
                btn.classList.remove('bg-gray-500');
                btn.classList.add('bg-red-600');
            }
        }

        function closeHapusModal() {
            document.getElementById('modalHapus').classList.add('hidden');
        }

        document.getElementById("formFasilitas").addEventListener("submit", function(e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);

            fetch(form.action, {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: data.error,
                            timer: 2000,
                            showConfirmButton: false,
                        });

                    } else if (data.info) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Info',
                            text: data.info,
                            timer: 2000,
                            showConfirmButton: false,
                        }).then(() => {
                            document.getElementById("modalFasilitas").classList.add("hidden");
                            location.reload();
                        });

                    } else if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.success,
                            timer: 2000,
                            showConfirmButton: false,
                        }).then(() => {
                            document.getElementById("modalFasilitas").classList.add("hidden");
                            location.reload();
                        });
                    }
                });
        });


        function openDetailModal(id, jumlah) {
            document.getElementById('jumlahDipakaiDetail').innerText = jumlah;

            const tbody = document.getElementById('tableBodyDetail');
            tbody.innerHTML = "";
            const kulinerTerpakai = allKuliner.filter(k =>
                k.fasilitas.some(kt => kt.id_fasilitas == id)
            );

            console.log(jumlah);
            if (kulinerTerpakai.length > 0) {
                kulinerTerpakai.forEach(item => {
                    tbody.innerHTML += `
                    <tr class="border-t text-center ">
                        <td class="p-2">${item.nama}</td>
                    </tr>
                `;
                });
            } else {
                tbody.innerHTML += `
                    <tr class="border-t">
                        <td class="p-2 text-center text-gray-500">
                            Fasilitas belum digunakan
                        </td>
                    </tr>
                `;
            }

            document.getElementById('modalDetail').classList.remove('hidden');
        }

        function closeDetailModal() {
            document.getElementById('modalDetail').classList.add('hidden');
        }


        function openTambahModal() {
            document.getElementById('modalTitle').innerText = "Tambah Fasilitas";

            const form = document.getElementById('formFasilitas');
            form.action = "/admin/kelolafasilitas";

            document.getElementById('methodField').value = "";
            document.getElementById('namaFasilitas').value = "";

            document.getElementById('modalFasilitas').classList.remove('hidden');
        }

        function openEditModal(id, nama) {
            document.getElementById('modalTitle').innerText = "Edit Fasilitas";

            const form = document.getElementById('formFasilitas');
            form.action = `/admin/kelolafasilitas/${id}`;

            document.getElementById('methodField').value = "PUT";
            document.getElementById('namaFasilitas').value = nama;

            document.getElementById('modalFasilitas').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modalFasilitas').classList.add('hidden');
        }
    </script>
</body>

</html>
