<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAPKU | Kelola Kategori</title>
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
                <h1 class="font-bold text-xl">Daftar Kategori</h1>
            </div>
        </div>

        <div class="flex justify-end gap-4 -mt-2">
            <a onclick="tampilkanTambahKategori()"
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
                <div id="contentKategori">
                    @if (!$kategori)
                        <div class="bg-white rounded-lg mt-4">
                            <table class="table-fixed w-full border-collapse border border-black">
                                <colgroup>
                                    <col style="width: 20px">
                                    <col style="width: 100px">
                                    <col style="width: 60px">
                                    <col style="width: 60px">
                                    <col style="width: 150px">
                                </colgroup>

                                <thead>
                                    <tr>
                                        <th
                                            class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                                            No
                                        </th>
                                        <th
                                            class="px-4 py-3 text-sm font-bold text-white border border-black bg-[#004440]">
                                            Kategori
                                        </th>
                                        <th
                                            class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                                            Dimiliki Oleh
                                        </th>
                                        <th
                                            class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    <tr>
                                        <td colspan="3" style="text-align: center"
                                            class="px-4 py-3 text-sm text-black">
                                            Belum Tersedia Kategori</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="bg-white rounded-lg mt-4">
                            <table class="table-fixed w-full border-collapse border-b-0 border-black">
                                <colgroup>
                                    <col style="width: 20px">
                                    <col style="width: 100px">
                                    <col style="width: 60px">
                                    <col style="width: 60px">
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
                                            Kategori
                                        </th>
                                        <th
                                            class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                                            Jenis Kategori
                                        </th>
                                        <th
                                            class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                                            Dimiliki Oleh
                                        </th>
                                        <th
                                            class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach ($kategori as $k)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                                                {{ $k->nomor }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-900 border border-black">
                                                {{ $k->nama }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                                                {{ $k->jenis_kategori }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                                                {{ $k->total_wisata }} Wisata Kuliner
                                            </td>
                                            <td class="px-4 py-3 text-sm border-b border-r border-black">
                                                <div class="flex justify-center gap-2 flex-wrap">
                                                    <button type="button"
                                                        onclick="tampilkanDetailKategori({{ $k->id_kategori }}, {{ $k->wisata_kuliner_count }})"
                                                        class="bg-[#004440] hover:bg-[#06362a] text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor"
                                                            class="size-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                                        </svg>
                                                        <span class="ml-1">Detail</span>
                                                    </button>

                                                    <button type="button"
                                                        onclick="tampilkanEditKategori({{ $k->id_kategori }}, @js($k->nama))"
                                                        class="bg-[#FFA319] hover:bg-[#F19305] text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                            class="size-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                        </svg>
                                                        <span class="ml-1">Edit</span>
                                                    </button>
                                                    <button
                                                        onclick="konfirmasiHapusKategori({{ $k->id_kategori }}, '{{ $k->nama }}', {{ $k->wisata_kuliner_count + $k->pengajuanwisata_kuliner_count }})"
                                                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.7"
                                                            stroke="currentColor" class="size-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>
                                                        <span class="ml-1">Hapus</span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $kategori->links('pagination::tailwind') }}
                        </div>
                    @endif
                </div>

                <div id="detailKategori"
                    class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center overflow-y-auto">
                    <div class="bg-white p-6 rounded-xl w-[400px] relative">
                        {{-- <button onclick="tutupDetailKategori()" class="absolute top-3 right-3 text-lg">✕</button>
                        <h2 class="text-lg font-semibold mb-2 text-center">Detail Kategori <span
                                id="namaKategori"></span></h2> --}}

                        <div class="relative">
                            <button onclick="tutupDetailKategori()"
                                class="absolute right-0 top-0 text-gray-400 hover:text-gray-500">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>

                            <div class="text-center">
                                <h3 class="text-lg font-semibold">Detail Kategori <span id="namaKategori"></span></h3>
                            </div>
                        </div>

                        <div class="max-h-64 overflow-y-auto border rounded-lg mt-4">
                            <table class="w-full text-sm">
                                <thead class="bg-gray-100 sticky top-0">
                                    <tr>
                                        <th class="p-2 text-center">Wisata Kuliner</th>
                                    </tr>
                                </thead>

                                <tbody id="bodyDetailKategori">

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <div id="tambaheditKategori"
                    class="fixed left-0 right-0 top-0 bottom-0 bg-black bg-opacity-40 hidden overflow-y-auto z-50 items-center justify-center">
                    <div
                        class="relative left-[30px] top-[220px] mx-auto p-5 border w-[400px] max-w-md shadow-lg rounded-xl bg-white">
                        {{-- <button type="button" onclick="tutupEditKategori()"
                            class="absolute right-4 top-3 text-xl">✕</button> --}}

                        <div class="relative">
                            <button onclick="tutupTambahEditKategori()"
                                class="absolute right-0 top-0 text-gray-400 hover:text-gray-500">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>

                            <div class="text-center mb-4">
                                <h3 class="text-lg font-semibold" id="judulTambahEdit"> <span
                                        id="namakategori"></span>
                                </h3>
                            </div>
                        </div>
                        {{-- <h2 id="modalTitle" class="text-lg font-semibold mb-4"></h2> --}}

                        <form id="formKategori" method="POST">
                            @csrf
                            <input type="hidden" name="_method" id="methodField">

                            <input type="text" name="nama" id="namaKategoriTambahEdit"
                                class="w-full border rounded-lg px-3 py-2 mb-4" placeholder="Nama kategori" required>

                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-1">
                                    Jenis Kategori
                                </label>

                                <select name="jenis_kategori" id="jenisKategori"
                                    class="w-full border rounded-lg px-3 py-2" required>

                                    <option value="" disabled selected>Pilih Jenis Kategori</option>

                                    <option value="Tempat">Tempat</option>

                                    <option value="Jenis Hidangan">Jenis Hidangan</option>

                                    <option value="Asal Kuliner">Asal Kuliner</option>
                                </select>
                            </div>

                            <div class="flex justify-end gap-2">
                                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">
                                    Simpan
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

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-gBdR_gqZTd8B6jz3mVJWI-pqC_jPlAI&libraries=maps,marker&v=weekly&language=in"
        async defer></script>
    <script>
        const allKategori = @json($kategori->items());;
        const allKuliner = @json($allKuliner);

        function tampilkanDetailKategori(id) {
            const tbody = document.getElementById('bodyDetailKategori');
            tbody.innerHTML = "";

            // const kategori = allKategori.data?.find(k => k.id_kategori == id);

            // if (!kategori) return;

            const listKategori = allKategori.data ?? allKategori;

            const kategori = listKategori.find(k => k.id_kategori == id);
            document.getElementById('namaKategori').innerText = kategori.nama;
            if (!kategori) {
                console.log('Kategori tidak ditemukan');
                return;
            }

            const kulinerTerpakai = allKuliner.filter(k =>
                k.kategori.some(kt => kt.id_kategori == id)
            );

            if (kulinerTerpakai.length > 0) {
                kulinerTerpakai.forEach(item => {
                    tbody.innerHTML += `
                    <tr class="border-t text-center ">
                        <td class="p-2 text-left">${item.nama}</td>
                    </tr>
                `;
                });
            } else {
                tbody.innerHTML += `
                    <tr class="border-t">
                        <td class="p-2 text-center text-gray-500">
                            Kategori belum dimiliki
                        </td>
                    </tr>
                `;
            }

            document.getElementById('detailKategori').classList.remove('hidden');
        }

        function tutupDetailKategori() {
            document.getElementById('detailKategori').classList.add('hidden');
        }

        // let kategoriDihapus = null;

        // function openHapusModal(id, jumlah) {
        //     kategoriDihapus = id;

        //     if (jumlah == 0) {
        //         Swal.fire({
        //             title: 'Hapus Kategori?',
        //             icon: 'warning',
        //             showCancelButton: true,
        //             confirmButtonColor: '#dc2626',
        //             cancelButtonColor: '#6b7280',
        //             confirmButtonText: 'Ya',
        //             cancelButtonText: 'Batal'
        //         }).then(result => {
        //             if (result.isConfirmed) {
        //                 const form = document.getElementById('formHapus');
        //                 form.action = `/admin/kelolakategori/hapus/${id}`;
        //                 form.submit();
        //             }
        //         });
        //         return;
        //     }

        //     document.getElementById('jumlahDipakai').innerText = jumlah;

        //     const form = document.getElementById('formHapus');
        //     form.action = `/admin/kelolakategori/hapus/${id}`;

        //     const tbody = document.getElementById('tableBody');
        //     const globalSelect = document.getElementById('globalSelect');

        //     tbody.innerHTML = "";
        //     globalSelect.innerHTML = '<option value="">Pilih kategori</option>';

        //     const kategoriValid = allKategori.filter(k => k.id_kategori != id);
        //     kategoriValid.forEach(k => {
        //         globalSelect.innerHTML += `<option value="${k.id_kategori}">${k.nama}</option>`;
        //     });

        //     const kulinerTerpakai = allKuliner.filter(k =>
        //         k.kategori.some(kt => kt.id_kategori == id)
        //     );

        //     kulinerTerpakai.forEach(item => {
        //         const kategoriDipakai = item.kategori.map(k => k.id_kategori);
        //         const kategoriTersedia = allKategori.filter(k =>
        //             k.id_kategori != id &&
        //             !kategoriDipakai.includes(k.id_kategori)
        //         );
        //         let select = `<select name="reassign[${item.id_wisata_kuliner}]" class="reassign-select border px-2 py-1 rounded w-[200px] min-w-[140px] max-w-full">
    // <option value="">Pilih Kategori</option>`;

        //         if (kategoriTersedia.length > 0) {
        //             kategoriTersedia.forEach(k => {
        //                 select += `<option value="${k.id_kategori}">${k.nama}</option>`;
        //             });
        //         } else {
        //             select = `<div class="h-[38px] flex items-center justify-center text-gray-400 text-sm">
    //             Tidak tersedia
    //         </div>`;
        //         }

        //         // kategoriValid.forEach(k => {
        //         //     select += `<option value="${k.id_kategori}">${k.nama}</option>`;
        //         // });

        //         select += `</select>`;

        //         tbody.innerHTML += `
    //         <tr class="border-t">
    //             <td class="p-2">${item.nama}</td>
    //             <td class="p-2 text-center">${select}<p class="text-red-500 text-xs mt-1 hidden error-text">
    //                 Pilih kategori atau hapus
    //             </p></td>
    //             <td class="p-2 text-center">
    //                 <div class="flex justify-center">
    //                 <button type="button" onclick="toggleHapusItem(event, ${item.id_wisata_kuliner})" class=" hover:text-red-700 text-red-500 px-4 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary justify-center">
    //                     <svg xmlns="http://www.w3.org/2000/svg" fill="none"
    //                         viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor"
    //                         class="size-5">
    //                         <path stroke-linecap="round" stroke-linejoin="round"
    //                             d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
    //                     </svg>
    //                 </button>
    //                 </div>
    //             </td>
    //         </tr>
    //     `;
        //     });

        //     globalSelect.addEventListener('change', function() {
        //         const val = this.value;

        //         document.querySelectorAll("select[name^='reassign']").forEach(s => {
        //             s.value = val;
        //         });
        //     });

        //     document.getElementById('modalHapus').classList.remove('hidden');
        // }

        // function hapusItem(e, id) {

        //     const kuliner = allKuliner.find(k => k.id_wisata_kuliner == id);
        //     if (!kuliner) return;

        //     if (kuliner.kategori.length <= 1) {
        //         Swal.fire({
        //             icon: 'warning',
        //             title: 'Tidak Dapat Dihapus',
        //             text: 'Kuliner ini hanya memiliki 1 kategori. Silakan pindahkan ke kategori lain terlebih dahulu'
        //         });
        //         return;
        //     }

        //     let input = document.createElement('input');
        //     input.type = "hidden";
        //     input.name = "hapus_ids[]";
        //     input.value = id;

        //     document.getElementById('formHapus').appendChild(input);

        //     const row = e.target.closest('tr');

        //     row.setAttribute('data-deleted', 'true');

        //     const select = row.querySelector('.reassign-select');
        //     if (select) select.disabled = true;

        //     row.classList.add('opacity-50');
        // }

        // document.getElementById('formHapus').addEventListener('submit', function(e) {

        //     let valid = true;
        //     const rows = document.querySelectorAll("#tableBody tr");

        //     rows.forEach(row => {

        //         const select = row.querySelector(".reassign-select");
        //         const errorText = row.querySelector(".error-text");
        //         const isDeleted = row.getAttribute('data-deleted') === 'true';

        //         const id = select?.name.match(/\d+/)?.[0];
        //         const kuliner = allKuliner.find(k => k.id_wisata_kuliner == id);

        //         if (!kuliner) return;

        //         const jumlahKategori = kuliner.kategori.length;

        //         if (!isDeleted && !select.value) {
        //             valid = false;
        //             errorText.classList.remove('hidden');
        //             select.classList.add('border-red-500');
        //         } else {
        //             errorText.classList.add('hidden');
        //             select.classList.remove('border-red-500');
        //         }

        //     });

        //     if (!valid) {
        //         e.preventDefault();

        //         Swal.fire({
        //             icon: 'warning',
        //             title: 'Tidak Dapat Dihapus',
        //             text: 'Semua wisata kuliner harus dihapus atau dipindahkan ke kategori lain terlebih dahulu'
        //         });

        //         return;
        //     }

        //     e.preventDefault();

        //     Swal.fire({
        //         title: 'Hapus Kategori?',
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#dc2626',
        //         cancelButtonColor: '#6b7280',
        //         confirmButtonText: 'Ya',
        //         cancelButtonText: 'Batal'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             e.target.submit();
        //         }
        //     });

        // });

        // function toggleHapusItem(e, id) {

        //     const row = e.target.closest('tr');
        //     const form = document.getElementById('formHapus');
        //     const select = row.querySelector('.reassign-select');
        //     const btn = row.querySelector('.btn-hapus');

        //     const kuliner = allKuliner.find(k => k.id_wisata_kuliner == id);
        //     if (!kuliner) return;

        //     const isDeleted = row.getAttribute('data-deleted') === 'true';

        //     if (!isDeleted) {

        //         if (kuliner.kategori.length <= 1) {
        //             Swal.fire({
        //                 icon: 'warning',
        //                 title: 'Tidak Dapat Dihapus',
        //                 text: 'Kuliner ini hanya memiliki 1 kategori. Silakan pindahkan ke kategori lain terlebih dahulu'
        //             });
        //             return;
        //         }

        //         let input = document.createElement('input');
        //         input.type = "hidden";
        //         input.name = "hapus_ids[]";
        //         input.value = id;
        //         input.setAttribute('data-id', id);

        //         form.appendChild(input);

        //         row.setAttribute('data-deleted', 'true');
        //         row.classList.add('opacity-50');

        //         if (select) select.disabled = true;

        //         btn.classList.remove('bg-red-600');
        //         btn.classList.add('bg-gray-500');

        //     } else {
        //         const input = form.querySelector(`input[name="hapus_ids[]"][value="${id}"]`);
        //         if (input) input.remove();

        //         row.setAttribute('data-deleted', 'false');
        //         row.classList.remove('opacity-50');

        //         if (select) select.disabled = false;
        //         btn.classList.remove('bg-gray-500');
        //         btn.classList.add('bg-red-600');
        //     }
        // }

        // function closeHapusModal() {
        //     document.getElementById('modalHapus').classList.add('hidden');
        // }

        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("formKategori").addEventListener("submit", function(e) {
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
                                document.getElementById("tambaheditKategori").classList.add(
                                    "hidden");
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
                                document.getElementById("tambaheditKategori").classList.add(
                                    "hidden");
                                location.reload();
                            });
                        }
                    });
            });
        });

        function tampilkanTambahKategori() {
            document.getElementById('judulTambahEdit').innerText = "Tambah Kategori";

            const form = document.getElementById('formKategori');
            form.action = "/admin/kelolakategori";

            // document.getElementById('methodField').value = "POST";
            document.getElementById('methodField').value = "";
            document.getElementById('namaKategoriTambahEdit').value = "";

            document.getElementById('tambaheditKategori').classList.remove('hidden');
        }

        function tampilkanEditKategori(id, nama) {
            document.getElementById('judulTambahEdit').innerText = "Edit Kategori";
            // document.getElementById('namaKategori').innerText = nama;
            const form = document.getElementById('formKategori');
            form.action = `/admin/kelolakategori/${id}`;

            document.getElementById('methodField').value = "PUT";
            document.getElementById('namaKategoriTambahEdit').value = nama;

            document.getElementById('tambaheditKategori').classList.remove('hidden');
        }

        function tutupTambahEditKategori() {
            document.getElementById('tambaheditKategori').classList.add('hidden');
        }

        // function konfirmasiHapus(id, nama) {
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

        //                 if (data.error) {
        //                     Swal.fire({
        //                         icon: 'error',
        //                         title: 'Tidak Dapat Dihapus',
        //                         text: data.error,
        //                     });
        //                 }

        //                 if (data.success) {
        //                     Swal.fire({
        //                         icon: 'success',
        //                         title: 'Berhasil',
        //                         text: data.success,
        //                         timer: 1500,
        //                         showConfirmButton: false
        //                     }).then(() => location.reload());
        //                 }
        //             });
        //     });
        // }
        function konfirmasiHapusKategori(id, nama, totalWisata) {
            if (totalWisata > 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Tidak Dapat Dihapus',
                    text: 'Kategori masih dimiliki oleh wisata kuliner',
                    timer: 2000,
                    showConfirmButton: false
                });
                return;
            }

            Swal.fire({
                title: `Hapus kategori "${nama}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (!result.isConfirmed) return;

                fetch(`/admin/kelolakategori/hapus/${id}`, {
                        method: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        Swal.fire({
                            icon: data.status,
                            title: data.title,
                            text: data.text,
                            timer: data.status === 'success' ? 1500 : undefined,
                            showConfirmButton: data.status !== 'success'
                        }).then(() => {
                            if (data.status === 'success') location.reload();
                        });
                    });
            });
        }
    </script>
</body>

</html>
