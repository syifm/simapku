@if ($ulasankuliner->isEmpty())
    <div class="bg-white mt-4 overflow-x-auto">
        <table class="w-full table-auto border-collapse border border-black">
            {{-- <colgroup>
                <col style="width: 30px">
                <col style="width: 200px">
                <col style="width: 150px">
                <col style="width: 90px">
                <col style="width: 80px">
            </colgroup> --}}

            <thead>
                <tr>
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                        No
                    </th>
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                        Wisata Kuliner
                    </th>
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                        Ulasan
                    </th>
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                        Status Verifikasi
                    </th>
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <tr>
                    <td colspan="5" style="text-align: center" class="px-4 py-3 text-sm text-black">
                        Belum Tersedia Ulasan Wisata Kuliner</td>
                </tr>
            </tbody>
        </table>
    </div>
@else
    <div class="bg-white mt-4 overflow-x-auto">
        <table class="w-full table-auto border-collapse border-b-0 border-black">
            {{-- <colgroup>
                <col style="width: 30px">
                <col style="width: 200px">
                <col style="width: 150px">
                <col style="width: 90px">
                <col style="width: 80px">
            </colgroup> --}}

            <thead>
                <tr>
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                        No
                    </th>
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                        Wisata Kuliner
                    </th>
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                        Ulasan
                    </th>
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                        Status Verifikasi
                    </th>
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
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
                        <td class="px-4 py-3 text-sm text-gray-900 border border-black text-justify">
                            {{ \Illuminate\Support\Str::limit($ulasan->ulasan, 50) }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                            {{ $ulasan->status }}
                        </td>
                        <td class="px-4 py-3 text-sm border-b border-r border-black">
                            {{-- <div class="flex justify-center items-center h-full gap-2">
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
                                                            class="bg-[#004440] hover:bg-[#06362a] text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.7"
                                                                stroke="currentColor" class="size-5">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                                            </svg>
                                                            <span class="ml-1">Detail</span>
                                                        </button>
                                                        <form id="delete-form-{{ $ulasan->id_penilaian_dan_ulasan }}"
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
                                                </div> --}}
                            <div class="flex justify-center items-center h-full gap-2">
                                <button onclick="klikVerifikasiUlasan({{ $ulasan->id_ulasan }})"
                                    class="{{ $ulasan->status == 'Belum Diverifikasi'
                                        ? 'bg-[#FFA319] hover:bg-[#F19305]'
                                        : 'bg-[#004440] hover:bg-[#06362a]' }}
                                                        text-white px-6 py-2 rounded-full text-sm flex justify-center items-center gap-1 btn btn-primary">

                                    @if ($ulasan->status == 'Belum Diverifikasi')
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.7" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.7" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                        </svg>
                                    @endif

                                    <span class="ml-1">
                                        {{ $ulasan->status == 'Belum Diverifikasi' ? 'Verifikasi' : 'Detail' }}
                                    </span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $ulasankuliner->appends(['tab' => 'ulasan'])->links('pagination::tailwind') }}
    </div>
@endif

<div id="detailUlasan" {{-- class="fixed left-[300px] right-0 top-0 bottom-0 bg-black bg-opacity-40 hidden overflow-y-auto"> --}}
    class="fixed inset-0 bg-black/40 hidden overflow-y-auto bg-black bg-opacity-40">
    <div class="relative top-20 mx-auto p-5 border w-[500px] shadow-lg rounded-xl bg-white">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-semibold flex-1 text-center" id="modalTitle">Ulasan</br></h3>
            <button onclick="tutupModalUlasan()" class="text-gray-400 hover:text-gray-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
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
                    <div><span id="email_pengulas"></span></div>
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
            <div id="aksiVerifikasi" class="flex justify-end gap-4 mt-6 text-sm"></div>
        </div>
    </div>
</div>

<script>
    // Ulasan
    function klikVerifikasiUlasan(id) {
        fetch(`/admin/verifikasiulasan/detail/${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('modalTitle').textContent = data.wisata_kuliner.nama;
                document.getElementById('nama_pengulas').textContent = data.nama_pengulas;
                document.getElementById('email_pengulas').textContent = data.email;
                document.getElementById('nilai').textContent = data.penilaian;
                document.getElementById('ulasan').textContent = data.ulasan;

                // Harga
                let min = data.harga_min ?? 0;
                let max = data.harga_max ?? 0;

                let text = '';

                if (min == 0) {
                    if (max == 0) {
                        text = '-';
                    } else {
                        text = `≤ Rp ${max.toLocaleString('id-ID')}`;
                    }
                } else {
                    if (min == 500000) {
                        text = `Rp ${min.toLocaleString('id-ID')}+`;
                    } else {
                        text = `Rp ${min.toLocaleString('id-ID')} - ${max.toLocaleString('id-ID')}`;
                    }
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

                const aksiDiv = document.getElementById('aksiVerifikasi');
                aksiDiv.innerHTML = '';

                if (data.status === 'Belum Diverifikasi') {
                    aksiDiv.innerHTML = `
                                <button
                                    onclick="verifikasiUlasan(${data.id_ulasan}, 'Setujui')"
                                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-full btn btn-primary">
                                    Setujui
                                </button>

                                <button
                                    onclick="verifikasiUlasan(${data.id_ulasan}, 'Tolak')"
                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-full btn btn-primary">
                                    Tolak
                                </button>
                            `;
                }

                document.getElementById('detailUlasan').classList.remove('hidden');
            });
    }

    function tutupModalUlasan() {
        document.getElementById('detailUlasan').classList.add('hidden');
    }

    function verifikasiUlasan(id, status) {
        if (status === 'Setujui') {
            Swal.fire({
                title: 'Setujui ulasan?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Setujui',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#16a34a',
                cancelButtonColor: '#6b7280',
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/verifikasiulasan/${id}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                status: 'Setujui'
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
                title: 'Tolak ulasan?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Tolak',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/verifikasiulasan/${id}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                status: 'Tolak'
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
