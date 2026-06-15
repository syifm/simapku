{{-- <div class="flex justify-end gap-4 -mt-2"> --}}
{{-- <div class="flex justify-end">
    <a onclick="tampilkanTambahKategori()"
        class="cursor-pointer bg-[#FFA319] hover:bg-[#F19305]
                btn btn-primary text-white rounded-full px-4 py-2 mt-14 text-sm flex items-center gap-1 transition mb-1">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor"
            class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        <span>Tambah</span>
    </a>
</div> --}}
<div class="flex justify-end">
    <a onclick="klikTambahKategori()"
        class="bg-[#FFA319] hover:bg-[#F19305]
                                btn btn-primary text-white rounded-full px-4 py-2 mt-6 text-sm flex items-center gap-1 transition mb-1">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor"
            class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>

        <span>Tambah</span>
    </a>
</div>
{{-- <div class="flex justify-end">
    <div class="flex justify-end">
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
</div> --}}

{{-- <div class="flex-1 overflow-hidden ml-1"> --}}
{{-- <div class="bg-white-100 pt-0"> --}}
{{-- <div id="contentKategori"> --}}
@if ($kategori->isEmpty())
    <div class="bg-white rounded-lg mt-4">
        <table class="table-fixed w-full border-collapse border border-black" id="tabelKategori">
            <colgroup>
                <col style="width: 30px">
                <col style="width: 120px">
                <col style="width: 70px">
                {{-- <col style="width: 70px"> --}}
                <col style="width: 70px">
                <col style="width: 150px">
            </colgroup>

            <thead>
                <tr>
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                        No
                    </th>
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black bg-[#004440]">
                        Kategori
                    </th>
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                        Jenis Kategori
                    </th>
                    {{-- <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                        Dimiliki Oleh
                    </th> --}}
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                        Status
                    </th>
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <tr>
                    <td colspan="6" style="text-align: center" class="px-4 py-3 text-sm text-black">
                        Belum Tersedia Kategori</td>
                </tr>
            </tbody>
        </table>
    </div>
@else
    <div class="bg-white rounded-lg mt-4">
        <table class="table-fixed w-full border-collapse border-b-0 border-black" id="tabelKategori">
            <colgroup>
                <col style="width: 30px">
                <col style="width: 120px">
                <col style="width: 70px">
                {{-- <col style="width: 70px"> --}}
                <col style="width: 70px">
                <col style="width: 150px">
            </colgroup>

            <thead>
                <tr>
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                        No
                    </th>
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                        Kategori
                    </th>
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                        Jenis Kategori
                    </th>
                    {{-- <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                        Dimiliki Oleh
                    </th> --}}
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                        Status
                    </th>
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
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
                        {{-- <td class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                            {{ $k->total_wisata }} Wisata Kuliner
                        </td> --}}
                        <td class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                            {{ $k->status }}
                        </td>
                        <td class="px-4 py-3 text-sm border-b border-r border-black">
                            <div class="flex justify-center gap-2 flex-wrap">
                                <button type="button"
                                    onclick="klikDetailKategori({{ $k->id_kategori }}, {{ $k->wisata_kuliner_count }})"
                                    class="bg-[#004440] hover:bg-[#06362a] text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.7" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                    </svg>
                                    <span class="ml-1">Detail</span>
                                </button>

                                <button type="button"
                                    onclick="klikEditKategori({{ $k->id_kategori }}, @js($k->nama), @js($k->jenis_kategori))"
                                    class="bg-[#FFA319] hover:bg-[#F19305] text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                    <span class="ml-1">Edit</span>
                                </button>

                                @if ($k->status === 'Aktif')
                                    <button onclick="klikHapusKategori({{ $k->id_kategori }}, '{{ $k->nama }}')"
                                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-full text-sm flex items-center gap-1">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.7" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>

                                        <span class="ml-1">Hapus</span>
                                    </button>
                                @else
                                    <button
                                        onclick="klikStatusKategori({{ $k->id_kategori }}, '{{ $k->nama }}')"
                                        class="bg-blue-800 hover:bg-blue-900 text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 6h.008v.008H6V6Z" />
                                        </svg>
                                        <span>Status</span>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $kategori->appends(['tab' => 'kategori'])->links('pagination::tailwind') }}
    </div>
@endif
{{-- </div> --}}

<div id="detailKategori"
    class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center overflow-y-auto">
    {{-- <div class="bg-white p-6 rounded-xl w-[400px] relative"> --}}
    <div class="bg-white p-6 rounded-xl w-full max-w-lg relative">

        {{-- <button onclick="tutupDetailKategori()" class="absolute top-3 right-3 text-lg">✕</button>
                        <h2 class="text-lg font-semibold mb-2 text-center">Detail Kategori <span
                                id="namaKategori"></span></h2> --}}

        <div class="relative">
            <button onclick="tutupDetailKategori()" class="absolute right-0 top-0 text-gray-400 hover:text-gray-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="text-center">
                <h3 class="text-lg font-semibold">Detail Kategori <span id="namaKategori"></span></h3>
            </div>
        </div>

        <div class="max-h-64 overflow-y-auto border rounded-lg mt-4">
            <table class="w-full text-sm table-fixed border border-gray-200">
                <thead class="bg-gray-100 sticky top-0">
                    <tr>
                        {{-- <th class="p-3 text-center border-r border-gray-200 w-2/3">
                            No
                        </th> --}}
                        <th class="p-3 text-center border-r border-gray-200 w-2/3">
                            Wisata Kuliner
                        </th>
                        <th class="p-3 text-center w-1/3">
                            Status
                        </th>
                    </tr>
                </thead>

                <tbody id="bodyDetailKategori"></tbody>
            </table>
        </div>

    </div>
</div>

<div id="tambaheditKategori"
    class="fixed left-0 right-0 top-0 bottom-0 bg-black bg-opacity-40 hidden overflow-y-auto z-50 items-center justify-center">
    <div class="relative left-[30px] top-[220px] mx-auto p-5 border w-[400px] max-w-md shadow-lg rounded-xl bg-white">
        {{-- <button type="button" onclick="tutupEditKategori()"
                            class="absolute right-4 top-3 text-xl">✕</button> --}}

        <div class="relative">
            <button onclick="tutupTambahEditKategori()"
                class="absolute right-0 top-0 text-gray-400 hover:text-gray-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="text-center mb-4">
                <h3 class="text-lg font-semibold" id="judulTambahEdit"> <span id="namakategori"></span>
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

                <select name="jenis_kategori" id="jenisKategori" class="w-full border rounded-lg px-3 py-2" required>

                    <option value="" disabled selected>Pilih Jenis Kategori</option>

                    <option value="Tempat">Tempat</option>

                    <option value="Jenis Hidangan">Jenis Hidangan</option>

                    <option value="Asal Kuliner">Asal Kuliner</option>
                </select>
            </div>

            <div class="flex justify-end gap-2">
                <button type="submit" class="bg-[#FB991A] hover:bg-orange-600  text-white px-4 py-2 rounded-md">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
{{-- </div> --}}
{{-- </div> --}}
{{-- </div> --}}

{{-- @push('styles')
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
@endpush --}}
<script>
    // Kategori

    // function tampilkanDetailKategori(id) {
    //     const tbody = document.getElementById('bodyDetailKategori');
    //     tbody.innerHTML = "";

    //     const kategori = allKategori.find(k => k.id_kategori == id);

    //     if (!kategori) {
    //         console.log('Kategori tidak ditemukan');
    //         return;
    //     }

    //     // const kategori = allKategori.data?.find(k => k.id_kategori == id);

    //     // if (!kategori) return;

    //     // const listKategori = allKategori.data ?? allKategori;

    //     // const kategori = listKategori.find(k => k.id_kategori == id);
    //     // document.getElementById('namaKategori').innerText = kategori.nama;
    //     // if (!kategori) {
    //     //     console.log('Kategori tidak ditemukan');
    //     //     return;
    //     // }

    //     // const kulinerTerpakai = allKulinerKategori.filter(k =>
    //     //     k.kategori.some(kt => kt.id_kategori == id)
    //     // ).sort((a, b) => a.nama.localeCompare(b.nama, 'id'));

    //     document.getElementById('namaKategori').innerText = kategori.nama;

    //     const kulinerTerpakaiK = allKulinerKategori.filter(k =>
    //         k.kategori.some(k => k.id_kategori == id)
    //     );

    //     if (kulinerTerpakaiK.length > 0) {
    //         kulinerTerpakaiK.forEach(item => {
    //             //     tbody.innerHTML += `
    //             //     <tr class="border-t text-center ">
    //             //         <td class="p-2 text-left">${item.nama}</td>
    //             //     </tr>
    //             // `;
    //             tbody.innerHTML += `
    //                 <tr class="border-t border-gray-200">
    //                     <td class="p-3 text-left border-r border-gray-200">
    //                         ${item.nama}
    //                     </td>
    //                     <td class="p-3 text-center">
    //                         ${item.status}
    //                     </td>
    //                 </tr>
    //             `;
    //         });
    //     } else {
    //         tbody.innerHTML += `
    //                 <tr class="border-t">
    //                     <td colspan="2" class="p-2 text-center text-gray-500">
    //                         Kategori belum dimiliki
    //                     </td>
    //                 </tr>
    //             `;
    //     }

    //     document.getElementById('detailKategori').classList.remove('hidden');
    // }
    function klikDetailKategori(id) {
        fetch(`/admin/kelolakategori/detail/${id}`)
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('bodyDetailKategori');
                tbody.innerHTML = '';
                document.getElementById('namaKategori').innerText =
                    data.kategori;

                if (data.detail.length > 0) {
                    // data.detail.forEach((item, index) => {
                    data.detail.forEach(item => {
                        tbody.innerHTML += `
                        <tr class="border-t border-gray-200">
                            <td class="p-3 text-left border-r border-gray-200">
                                ${item.nama}
                            </td>
                            <td class="p-3 text-center">
                                ${item.status}
                            </td>
                        </tr>
                    `;
                    });

                } else {
                    tbody.innerHTML = `
                    <tr>
                        <td colspan="2"
                            class="p-3 text-center text-gray-500">
                            Kategori belum dimiliki
                        </td>
                    </tr>
                `;
                }

                document
                    .getElementById('detailKategori')
                    .classList.remove('hidden');
            });
    }

    function tutupDetailKategori() {
        document.getElementById('detailKategori').classList.add('hidden');
    }

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
                            title: 'Berhasil',
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

    function klikTambahKategori() {
        document.getElementById('judulTambahEdit').innerText = "Tambah Kategori";

        const form = document.getElementById('formKategori');
        form.action = "/admin/kelolakategori";

        // document.getElementById('methodField').value = "POST";
        document.getElementById('methodField').value = "";
        document.getElementById('namaKategoriTambahEdit').value = "";

        document.getElementById('tambaheditKategori').classList.remove('hidden');
    }

    function klikEditKategori(id, nama, jeniskategori) {
        document.getElementById('judulTambahEdit').innerText = "Edit Kategori";
        // document.getElementById('namaKategori').innerText = nama;
        const form = document.getElementById('formKategori');
        form.action = `/admin/kelolakategori/${id}`;

        document.getElementById('methodField').value = "PUT";
        document.getElementById('namaKategoriTambahEdit').value = nama;
        document.getElementById('jenisKategori').value = jeniskategori;

        document.getElementById('tambaheditKategori').classList.remove('hidden');
    }

    function tutupTambahEditKategori() {
        document.getElementById('tambaheditKategori').classList.add('hidden');
    }

    function klikHapusKategori(id, nama) {
        fetch(`/admin/kelolakategori/hapus/${id}`, {
                method: "DELETE",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    hapusataunonaktif: false
                })
            })
            .then(res => res.json())
            .then(data => {

                if (data.action === 'tdkblhhapus') {
                    Swal.fire({
                        icon: 'error',
                        title: data.title,
                        text: data.text,
                        timer: 2000,
                        showConfirmButton: false,
                    });
                    return;
                }

                Swal.fire({
                    title: data.action === 'nonaktif' ?
                        `Nonaktifkan Kategori?` : `Hapus Kategori?`,
                    html: `
                                <div style="text-align:center;">
                                <div><b>Kategori:</b> ${nama}</div>
                                ${data.text ? `<div style="margin-top:4px;">${data.text}</div>` : ''}
                            </div>
                        `,
                    icon: 'question',
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
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                hapusataunonaktif: true
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            Swal.fire({
                                icon: data.status,
                                title: data.title,
                                text: data.text,
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                reloadSetelahHapus('kategori', 'tabelKategori');
                            });
                        });
                });
            });
    }

    function klikStatusKategori(id, nama) {
        Swal.fire({
            title: `Aktifkan Kategori?`,
            html: `
                    <div style="text-align:center;">
                        <div><b>Kategori:</b> ${nama}</div>
                    </div>
                `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#16A34A',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (!result.isConfirmed) return;

            fetch(`/admin/kelolakategori/aktifkan/${id}`, {
                    method: "PUT",
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
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                });
        });
    }
</script>
