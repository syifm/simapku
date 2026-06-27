<div class="flex justify-end">
    <a onclick="klikTambahFasilitas()"
        class="bg-[#FFA319] hover:bg-[#F19305]
                                btn btn-primary text-white rounded-full px-4 py-2 mt-6 text-sm flex items-center gap-1 transition mb-1">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor"
            class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>

        <span>Tambah</span>
    </a>
</div>


@if ($fasilitas->isEmpty())
    <div class="bg-white mt-4 overflow-x-auto">
        <table class="w-full table-auto border-collapse border border-black" id="tabelFasilitas">
            {{-- <colgroup>
                <col style="width: 30px">
                <col style="width: 140px">
                <col style="width: 60px">
                <col style="width: 60px">
                <col style="width: 160px">
            </colgroup> --}}

            <thead>
                <tr>
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                        No
                    </th>
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black bg-[#004440]">
                        Fasilitas
                    </th>
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                        Dimiliki Oleh
                    </th>
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
                    <td colspan="5" style="text-align: center" class="px-4 py-3 text-sm text-black">
                        Belum Tersedia Fasilitas</td>
                </tr>
            </tbody>
        </table>
    </div>
@else
    <div class="bg-white mt-4 overflow-x-auto">
        <table class="w-full table-auto border-collapse border-b-0 border-black" id="tabelFasilitas">
            {{-- <colgroup>
                <col style="width: 30px">
                <col style="width: 140px">
                <col style="width: 60px">
                <col style="width: 60px">
                <col style="width: 160px">
            </colgroup> --}}

            <thead>
                <tr>
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                        No
                    </th>
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                        Fasilitas
                    </th>
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                        Dimiliki Oleh
                    </th>
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                        Status
                    </th>
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($fasilitas as $f)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                            {{ $f->nomor }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900 border border-black">
                            {{ $f->nama }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                            {{ $f->total_wisata }} Wisata Kuliner
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                            {{ $f->status }}
                        </td>
                        <td class="px-4 py-3 text-sm border-b border-r border-black">
                            <div class="flex justify-center gap-2 flex-wrap">
                                <button type="button"
                                    onclick="klikDetailFasilitas({{ $f->id_fasilitas }}, {{ $f->wisata_kuliner_count }})"
                                    class="bg-[#004440] hover:bg-[#06362a] text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.7" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                    </svg>
                                    <span class="ml-1">Detail</span>
                                </button>

                                <button type="button"
                                    onclick="klikEditFasilitas({{ $f->id_fasilitas }}, @js($f->nama))"
                                    class="bg-[#FFA319] hover:bg-[#F19305] text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                    <span class="ml-1">Edit</span>
                                </button>
                                @if ($f->status === 'Aktif')
                                    <button onclick="klikHapusFasilitas({{ $f->id_fasilitas }}, '{{ $f->nama }}')"
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
                                        onclick="klikAktifkanFasilitas({{ $f->id_fasilitas }}, '{{ $f->nama }}')"
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
        {{ $fasilitas->links('pagination::tailwind') }}
    </div>
@endif

<div id="detailFasilitas"
    class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center overflow-y-auto">
    {{-- <div class="bg-white p-6 rounded-xl w-[400px] relative"> --}}
    <div class="bg-white p-6 rounded-xl w-full max-w-lg relative">
        {{-- <button onclick="tutupDetailFasilitas()" class="absolute top-3 right-3 text-lg">✕</button>
                        <h2 class="text-lg font-semibold mb-2 text-center">Detail Fasilitas <span
                                id="namaFasilitas"></span></h2> --}}

        <div class="relative">
            <button onclick="tutupDetailFasilitas()" class="absolute right-0 top-0 text-gray-400 hover:text-gray-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="text-center">
                <h3 class="text-lg font-semibold">Detail Fasilitas <span id="namaFasilitas"></span>
                </h3>
            </div>
        </div>

        <div class="max-h-64 overflow-y-auto border rounded-lg mt-4">
            {{-- <table class="w-full text-sm">
                <thead class="bg-gray-100 sticky top-0">
                    <tr>
                        <th class="p-2 text-center">Wisata Kuliner</th>
                        <th class="p-2 text-center">Status</th>
                    </tr>
                </thead>

                <tbody id="bodyDetailFasilitas">

                </tbody>
            </table> --}}
            <table class="w-full text-sm table-fixed border border-gray-200">
                <thead class="bg-gray-100 sticky top-0">
                    <tr>
                        <th class="p-3 text-center border-r border-gray-200 w-2/3">
                            Wisata Kuliner
                        </th>
                        <th class="p-3 text-center w-1/3">
                            Status
                        </th>
                    </tr>
                </thead>

                <tbody id="bodyDetailFasilitas"></tbody>
            </table>
        </div>

    </div>
</div>

<div id="tambaheditFasilitas"
    class="fixed left-0 right-0 top-0 bottom-0 bg-black bg-opacity-40 hidden overflow-y-auto z-50 items-center justify-center">
    <div class="relative left-[30px] top-[220px] mx-auto p-5 border w-[400px] max-w-md shadow-lg rounded-xl bg-white">
        {{-- <button type="button" onclick="tutupEditFasilitas()"
                            class="absolute right-4 top-3 text-xl">✕</button> --}}

        <div class="relative">
            <button onclick="tutupTambahEditFasilitas()"
                class="absolute right-0 top-0 text-gray-400 hover:text-gray-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="text-center mb-4">
                <h3 class="text-lg font-semibold" id="judulTambahEditFasilitas"> <span id="namafasilitas"></span>
                </h3>
            </div>
        </div>
        {{-- <h2 id="modalTitle" class="text-lg font-semibold mb-4"></h2> --}}

        <form id="formFasilitas" method="POST">
            @csrf
            <input type="hidden" name="_method" id="methodFieldF">

            <input type="text" name="nama" id="namaFasilitasTambahEdit"
                class="w-full border rounded-lg px-3 py-2 mb-4" placeholder="Nama fasilitas" required>

            <div class="flex justify-end gap-2">
                <button type="submit" class="bg-[#FB991A] hover:bg-orange-600  text-white px-4 py-2 rounded-lg">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>


<script>
    // function tampilkanDetailFasilitas(id) {
    //     const tbody = document.getElementById('bodyDetailFasilitas');
    //     tbody.innerHTML = "";

    //     const fasilitas = allFasilitas.find(f => f.id_fasilitas == id);

    //     if (!fasilitas) {
    //         console.log('Fasilitas tidak ditemukan');
    //         return;
    //     }

    //     document.getElementById('namaFasilitas').innerText = fasilitas.nama;

    //     const kulinerTerpakai = allKulinerFasilitas.filter(k =>
    //         k.fasilitas.some(f => f.id_fasilitas == id)
    //     );

    //     if (kulinerTerpakai.length > 0) {
    //         kulinerTerpakai.forEach(item => {
    //             // let statuskuliner = '';

    //             // if (item.status === 'Aktif') {
    //             //     statuskuliner = '<span class="text-xs font-medium">Aktif</span>';
    //             // } else if (item.status === 'Belum Diverifikasi') {
    //             //     statuskuliner = '<span class="text-xs font-medium">Belum Verifikasi</span>';
    //             // } else if (item.status === 'Disetujui') {
    //             //     statuskuliner = '<span class="text-xs font-medium">Disetujui</span>';
    //             // } else if (item.status === 'Ditolak') {
    //             //     statuskuliner = '<span class="text-red-600 text-xs font-medium">Ditolak</span>';
    //             // }

    //             //         tbody.innerHTML += `
    //             //     <tr class="border-t">
    //             //         <td class="p-2 text-left">${item.nama}</td>
    //             //         <td class="p-2 text-center">${item.status}</td>
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
    //         tbody.innerHTML = `
    //                 <tr class="border-t">
    //                     <td colspan="2" class="p-2 text-center text-gray-500">
    //                         Fasilitas belum dimiliki
    //                     </td>
    //                 </tr>
    //             `;
    //     }

    //     document.getElementById('detailFasilitas').classList.remove('hidden');
    // }

    function klikDetailFasilitas(id) {
        fetch(`/admin/kelolafasilitas/detail/${id}`)
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('bodyDetailFasilitas');
                tbody.innerHTML = '';
                document.getElementById('namaFasilitas').innerText =
                    data.fasilitas;

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
                            Fasilitas belum dimiliki
                        </td>
                    </tr>
                `;
                }

                document
                    .getElementById('detailFasilitas')
                    .classList.remove('hidden');
            });
    }

    function tutupDetailFasilitas() {
        document.getElementById('detailFasilitas').classList.add('hidden');
    }

    document.addEventListener("DOMContentLoaded", function() {
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
                            document.getElementById("tambaheditFasilitas").classList
                                .add(
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
                            document.getElementById("tambaheditFasilitas").classList
                                .add(
                                    "hidden");
                            location.reload();
                        });
                    }
                });
        });
    });

    function klikTambahFasilitas() {
        document.getElementById('judulTambahEditFasilitas').innerText = "Tambah Fasilitas";

        const form = document.getElementById('formFasilitas');
        form.action = "/admin/kelolafasilitas";

        document.getElementById('methodField').value = "";
        document.getElementById('namaFasilitasTambahEdit').value = "";

        document.getElementById('tambaheditFasilitas').classList.remove('hidden');
    }

    function klikEditFasilitas(id, nama) {
        document.getElementById('judulTambahEditFasilitas').innerText = "Edit Fasilitas";
        const form = document.getElementById('formFasilitas');
        form.action = `/admin/kelolafasilitas/${id}`;

        document.getElementById('methodFieldF').value = "PUT";
        document.getElementById('namaFasilitasTambahEdit').value = nama;

        document.getElementById('tambaheditFasilitas').classList.remove('hidden');
    }

    function tutupTambahEditFasilitas() {
        document.getElementById('tambaheditFasilitas').classList.add('hidden');
    }

    function klikHapusFasilitas(id, nama) {
        fetch(`/admin/kelolafasilitas/hapus/${id}`, {
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
                        `Nonaktifkan Fasilitas?` : `Hapus Fasilitas?`,
                    html: `
                            <div style="text-align:center;">
                                <div><b>Fasilitas:</b> ${nama}</div>
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

                    fetch(`/admin/kelolafasilitas/hapus/${id}`, {
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
                                reloadSetelahHapus('fasilitas', 'tabelFasilitas');
                            });
                        });
                });
            });
    }

    function klikAktifkanFasilitas(id, nama) {
        Swal.fire({
            title: `Aktifkan Fasilitas?`,
            html: `
                    <div style="text-align:center;">
                        <div><b>Fasilitas:</b> ${nama}</div>
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

            fetch(`/admin/kelolafasilitas/aktifkan/${id}`, {
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
