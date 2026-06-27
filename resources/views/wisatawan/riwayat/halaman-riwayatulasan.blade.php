@if ($ulasan->isEmpty())
    <div class="bg-white mt-4 overflow-x-auto">
        <table class="w-full table-auto border-collapse border border-black">
            {{-- <colgroup>
                <col style="width: 35px">
                <col style="width: 180px">
                <col style="width: 150px">
                <col style="width: 90px">
                <col style="width: 90px">
                <col style="width: 90px">
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
                        Status
                    </th>
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                        Update Terakhir
                    </th>
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <tr>
                    <td colspan="6" style="text-align: center" class="px-4 py-3 text-sm text-black">
                        Belum Tersedia Ulasan Wisata Kuliner</td>
                </tr>
            </tbody>
        </table>
    </div>
@else
    <div class="bg-white mt-4 overflow-x-auto">
        <table class="w-full table-auto border-collapse border-b-0 border-black">
            {{-- <colgroup>
                <col style="width: 35px">
                <col style="width: 180px">
                <col style="width: 150px">
                <col style="width: 90px">
                <col style="width: 90px">
                <col style="width: 90px">
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
                        Status
                    </th>
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                        Update Terakhir
                    </th>
                    <th class="px-4 py-3 text-sm font-bold text-white border border-black text-center bg-[#004440]">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($ulasan as $ulasankuliner)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                            {{ $ulasankuliner->nomor }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900 border border-black">
                            {{ $ulasankuliner->wisataKuliner->nama }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900 border border-black text-justify">
                            {{ \Illuminate\Support\Str::limit($ulasankuliner->ulasan, 50) }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                            {{ $ulasankuliner->status }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900 border border-black text-center">
                            {{ \Carbon\Carbon::parse($ulasankuliner->waktu_diubah)->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-4 py-3 text-sm border-b border-r border-black">
                            <div class="flex justify-center gap-2">
                                <button onclick="klikDetailUlasan({{ $ulasankuliner->id_ulasan }})"
                                    class="bg-[#004440] hover:bg-[#06362a] text-white px-6 py-2 rounded-full text-sm flex items-center gap-1 btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.7" stroke="currentColor" class="size-5">
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
        {{ $ulasan->appends(['tab' => 'ulasan'])->links('pagination::tailwind') }}
    </div>
@endif

<div id="detailUlasan" class="fixed inset-0 bg-black/40 hidden z-[9999] overflow-y-auto bg-black bg-opacity-40">
    <div class="relative top-40 mx-auto p-5 border w-[500px] shadow-lg rounded-xl bg-white">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-semibold flex-1 text-center" id="modalTitleUlasan">
                Ulasan</br></h3>
            <button onclick="tutupDetailUlasan()" class="text-gray-400 hover:text-gray-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
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

<script>
    function klikDetailUlasan(id) {
        fetch(`/wisatawan/riwayatpengajuan/detail/ulasan/${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('modalTitleUlasan').textContent = data.wisata_kuliner.nama;
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
</script>
