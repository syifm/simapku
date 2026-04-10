<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAPKU | Edit Wisata Kuliner</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>




    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"
        rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        label {
            text-align: left;
        }

        .file-input-wrapper {
            display: flex;
            align-items: center;
            overflow: hidden;
            max-width: 300px;
        }

        .file-input-wrapper input[type="file"] {
            border: none;
            padding-top: 0.5rem;
            flex-grow: 1;
        }

        .hidden {
            display: none;
        }

        #map {
            height: 400px;
            width: 1075px;
            border-radius: 7px;
        }

        .ts-control {
            min-height: 45px;
        }

        .ts-wrapper.multi .ts-control>div {
            background: #0d6efd;
            color: white;
            border-radius: 15px;
            padding: 4px 10px;
        }

        /* .select2-container .select2-selection--single {
            height: 42px;
            border-radius: 0.375rem;
            border: 1px solid #e0e0e1;
            padding: 6px 10px;
        } */

        .select2-container--default .select2-selection--single:focus {
            outline: none;
            box-shadow: 0 0 0 2px #3b82f6;
        }

        .select2-container--default .select2-selection--single {
            height: 42px;
            border-radius: 0.375rem;
            border: 1px solid #e0e0e1;
            padding: 6px 10px;
            display: flex;
            align-items: center;
        }

        .select2-container--default .select2-selection__arrow {
            height: 100%;
            right: 10px;
            top: 0;
        }

        .select2-container--default .select2-selection__arrow b {
            display: none;
        }

        .select2-container--default .select2-selection__arrow::after {
            content: "";
            width: 6px;
            height: 6px;
            border-right: 2px solid #374151;
            border-bottom: 2px solid #374151;
            transform: rotate(45deg);
            position: absolute;
            top: 70%;
            right: 5px;
            margin-top: -4px;
        }

        .select2-container--default .select2-selection__clear {
            display: none !important;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
</head>

<body class="bg-gray-100 text-gray-800">
    @include('layouts.sidebar-admin')
    <div class="pt-[38px] pl-[350px] pr-[50px] pb-[30px] overflow-y-auto min-h-screen">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Konten -->
        <div class="flex-1 flex flex-col">
            <div class="flex-1 overflow-y-auto">
                <div class="mt-2 text-sm flex justify-start gap-6">
                    <a href="{{ route('kelolawisatakuliner') }}" class="back-btn flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                    </a>

                    <div class="-mt-1.5">
                        <h1 class="font-bold text-xl">Edit Wisata Kuliner</h1>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 mt-14">
                    <form action="{{ route('kelolawisatakuliner.update', $wisataKuliner->id_wisata_kuliner) }}"
                        method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')
                        <div class="w-full mx-auto space-y-6">
                            <p class="text-xs text-gray-600 mt-2 text-right">
                                Cari Wilayah dengan mengaktifkan GPS atau melalui
                                kolom Kecamatan dan Kelurahan
                            </p>
                            <div id="map">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <!-- Latitude -->
                                    <label class="block text-sm font-medium text-gray-800 mb-1"
                                        for="latitude"><span>Latitude</span>
                                        <span class="text-red-500 font-bold">*</span></label></label>
                                    <input type="number" step="any" min="-90" max="90"
                                        class="form-control w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        name="latitude" id="latitude"
                                        value="{{ old('latitude', $wisataKuliner->latitude) }}" required>
                                    @error('latitude')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <!-- Longitude -->
                                    <label class="block text-sm font-medium text-gray-800 mb-1"
                                        for="longitude"><span>Longitude</span>
                                        <span class="text-red-500 font-bold">*</span></label></label>
                                    <input type="number" step="any" min="-180" max="180"
                                        class="form-control w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        name="longitude" id="longitude"
                                        value="{{ old('longitude', $wisataKuliner->longitude) }}" required>
                                    @error('longitude')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Nama Wisata Kuliner -->
                            <div>
                                <label class="block text-sm font-medium text-gray-800 mb-1"><span>Nama Wisata
                                        Kuliner</span>
                                    <span class="text-red-500 font-bold">*</span></label>
                                <select id="selectmhsadmin" name="nama_wisata_kuliner"
                                    class="form-select w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    aria-label="Default select example" required>

                                </select>

                                <input type="hidden" name="nama" id="nama">

                                @error('nama_wisata_kuliner')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <!-- Kecamatan -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Kecamatan <span class="text-red-500">*</span>
                                    </label>
                                    <select id="kecamatan" name="kecamatan_kode" required
                                        class="w-full border rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500">
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                    @error('kecamatan')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Kelurahan -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Kelurahan <span class="text-red-500">*</span>
                                    </label>
                                    <select id="kelurahan" name="kelurahan_kode" required
                                        class="w-full border rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500">
                                        <option value="">Pilih Kelurahan</option>
                                    </select>
                                    @error('kelurahan')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <input type="hidden" name="kecamatan" id="kecamatan_nama"
                                    value="{{ old('kecamatan', $wisataKuliner->kecamatan) }}">
                                <input type="hidden" name="kelurahan" id="kelurahan_nama"
                                    value="{{ old('kelurahan', $wisataKuliner->kelurahan) }}">
                            </div>

                            <!-- Alamat -->
                            <div>
                                <label class="block text-sm font-medium text-gray-800 mb-1"
                                    for="alamat"><span>Alamat</span>
                                    <span class="text-red-500 font-bold">*</span></label>
                                <textarea id="alamat" name="alamat" rows="4"
                                    class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('alamat', $wisataKuliner->alamat) }}</textarea>
                                @error('alamat')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nomor Telepon -->
                            <div>
                                <label class="block text-sm font-medium text-gray-800 mb-1" for="no_telp"><span>Nomor
                                        Telepon</span>
                                    <span class="text-red-500 font-bold">*</span></label>
                                <input type="text" id="no_telp" name="no_telp"
                                    value="{{ old('no_telp', $wisataKuliner->no_telp) }}" required
                                    pattern="\d{10,15}" minlength="10" maxlength="15"
                                    class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('no_telp')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-medium text-gray-800 mb-1"
                                    for="email">Email</label>
                                <input type="email" id="email" name="email"
                                    value="{{ old('email', $wisataKuliner->email ?? '') }}"
                                    class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div>
                                <label class="block text-sm font-medium text-gray-800 mb-1"
                                    for="deskripsi"><span>Deskripsi</span>
                                    <span class="text-red-500 font-bold">*</span></label>
                                <textarea id="deskripsi" name="deskripsi" rows="4"
                                    class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('deskripsi', $wisataKuliner->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Fasilitas Wisata Kuliner -->
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-800 mb-1"><span>Fasilitas</span></label>
                                <select id="selectmkadmin" name="id_fasilitas[]"
                                    class="form-select w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    aria-label="Default select example">

                                </select>

                                @error('id_fasilitas')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Kategori Wisata Kuliner -->
                            <div>
                                <label class="block text-sm font-medium text-gray-800 mb-1">
                                    <span>Kategori</span>
                                    <span class="text-red-500 font-bold">*</span>
                                </label>

                                <select id="selectkategoriadmin" name="id_kategori[]"
                                    class="form-select w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required>
                                </select>

                                @error('id_kategori')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Foto Wisata Kuliner -->
                            <div>
                                <label class="block text-sm font-medium text-gray-800 mb-1" for="foto">
                                    <span>Foto</span>
                                    <span class="text-red-500 font-bold">*</span>
                                </label>

                                <input type="file" id="foto" name="foto" accept="image/*"
                                    class="file-input-wrapper" {{ empty($wisataKuliner->foto) ? 'required' : '' }}>

                                <div id="fotoError" class="text-red-500 text-sm mt-1 hidden"></div>

                                <!-- PREVIEW -->
                                <div id="previewWrapper"
                                    class="mt-3 relative w-40 {{ isset($wisataKuliner->foto) ? '' : 'hidden' }}">
                                    <img id="fotoPreview" class="rounded-md border w-full h-40 object-cover"
                                        src="{{ $wisataKuliner->foto ? asset('storage/' . $wisataKuliner->foto) : '' }}">
                                </div>

                                <p class="text-xs
                                        text-gray-600 mt-2">
                                    Format: JPG, JPEG, PNG | Max: 10MB
                                </p>
                            </div>

                            <!-- Submit -->
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="bg-[#FB991A] text-white px-12 py-2 rounded-md hover:bg-orange-600 transition duration-300 font-bold">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <style>
                .fade-in {
                    animation: fadeIn 1.5s ease-in-out forwards;
                }

                @keyframes fadeIn {
                    0% {
                        opacity: 0;
                        transform: translateY(10px);
                    }

                    100% {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }
            </style>
        </div>
    </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        // Kecamatan dan Kelurahan
        // const oldKecamatan = "{{ old('kecamatan_kode', $wisataKuliner->kecamatan_kode) }}";
        // const oldKelurahan = "{{ old('kelurahan_kode', $wisataKuliner->kelurahan_kode) }}";

        // document.addEventListener('DOMContentLoaded', function() {
        //     const kecamatanSelect = document.getElementById('kecamatan');
        //     const kelurahanSelect = document.getElementById('kelurahan');
        //     const kecamatanNama = document.getElementById('kecamatan_nama');
        //     const kelurahanNama = document.getElementById('kelurahan_nama');

        //     // LOAD KECAMATAN (pas halaman dibuka)
        //     fetch('/wisata/api/kecamatan')
        //         .then(res => res.json())
        //         .then(data => {
        //             data.forEach(item => {
        //                 const selected = item.code == oldKecamatan ? 'selected' : '';
        //                 kecamatanSelect.innerHTML += `
    //             <option value="${item.code}">
    //                 ${item.name}
    //             </option>
    //         `;
        //             });
        //             if (oldKecamatan) {
        //                 loadKelurahan(oldKecamatan);
        //             }
        //         })
        //         .catch(() => {
        //             alert('Gagal memuat data kecamatan');
        //         });

        //     // LOAD KELURAHAN (pas kecamatan berubah)
        //     kecamatanSelect.addEventListener('change', function() {
        //         const selectedOption = this.options[this.selectedIndex];
        //         kecamatanNama.value = selectedOption.text;

        //         const districtCode = this.value;
        //         kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';

        //         if (!districtCode) return;

        //         fetch(`/wisata/api/kelurahan/${districtCode}`)
        //             .then(res => res.json())
        //             .then(data => {
        //                 data.forEach(item => {
        //                     const selected = item.code == oldKelurahan ? 'selected' : '';
        //                     kelurahanSelect.innerHTML += `
    //                 <option value="${item.code}">
    //                     ${item.name}
    //                 </option>
    //             `;
        //                 });
        //             })
        //             .catch(() => {
        //                 alert('Gagal memuat data kelurahan');
        //             });
        //     });

        //     kelurahanSelect.addEventListener('change', function() {
        //         const selectedOption = this.options[this.selectedIndex];
        //         kelurahanNama.value = selectedOption.text;
        //     });
        // });

        //awalnya ini yaaa -------------------------------------------------------------------------------
        // const oldKecamatan = "{{ old('kecamatan', $wisataKuliner->kecamatan) }}";
        // const oldKelurahan = "{{ old('kelurahan', $wisataKuliner->kelurahan) }}";

        // document.addEventListener('DOMContentLoaded', function() {
        //     const kecamatanSelect = document.getElementById('kecamatan');
        //     const kelurahanSelect = document.getElementById('kelurahan');
        //     const kecamatanNama = document.getElementById('kecamatan_nama');
        //     const kelurahanNama = document.getElementById('kelurahan_nama');

        //     fetch('/wisata/api/kecamatan')
        //         .then(res => res.json())
        //         .then(data => {
        //             let savedKecamatanCode = null;

        //             data.forEach(item => {
        //                 const option = document.createElement('option');
        //                 option.value = item.name; // ✅ simpan nama
        //                 option.dataset.code = item.code; // ✅ simpan code di data attribute
        //                 option.textContent = item.name;

        //                 if (item.name == oldKecamatan) {
        //                     option.selected = true;
        //                     kecamatanNama.value = item.name;
        //                     savedKecamatanCode = item.code; // ✅ ambil code untuk load kelurahan
        //                 }

        //                 kecamatanSelect.appendChild(option);
        //             });

        //             if (savedKecamatanCode) {
        //                 loadKelurahan(savedKecamatanCode);
        //             }
        //         })
        //         .catch(() => alert('Gagal memuat data kecamatan'));

        //     function loadKelurahan(districtCode) {
        //         kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';

        //         fetch(`/wisata/api/kelurahan/${districtCode}`)
        //             .then(res => res.json())
        //             .then(data => {
        //                 data.forEach(item => {
        //                     const option = document.createElement('option');
        //                     option.value = item.name; // ✅ simpan nama
        //                     option.dataset.code = item.code;
        //                     option.textContent = item.name;

        //                     if (item.name == oldKelurahan) {
        //                         option.selected = true;
        //                         kelurahanNama.value = item.name;
        //                     }

        //                     kelurahanSelect.appendChild(option);
        //                 });
        //             })
        //             .catch(() => alert('Gagal memuat data kelurahan'));
        //     }

        //     kecamatanSelect.addEventListener('change', function() {
        //         const selectedOption = this.options[this.selectedIndex];
        //         kecamatanNama.value = selectedOption.text;
        //         kelurahanNama.value = '';

        //         const code = selectedOption.dataset.code; // ✅ ambil code dari data attribute
        //         if (code) {
        //             loadKelurahan(code);
        //         } else {
        //             kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
        //         }
        //     });

        //     kelurahanSelect.addEventListener('change', function() {
        //         kelurahanNama.value = this.options[this.selectedIndex].text;
        //     });
        // });


        // const oldKecamatan = "{{ old('kecamatan', $wisataKuliner->kecamatan) }}";
        // const oldKelurahan = "{{ old('kelurahan', $wisataKuliner->kelurahan) }}";

        // document.addEventListener('DOMContentLoaded', function() {
        //     const kecamatanSelect = document.getElementById('kecamatan');
        //     const kelurahanSelect = document.getElementById('kelurahan');
        //     const kecamatanNama = document.getElementById('kecamatan_nama');
        //     const kelurahanNama = document.getElementById('kelurahan_nama');

        //     // LOAD KECAMATAN
        //     fetch('/wisata/api/kecamatan')
        //         .then(res => res.json())
        //         .then(data => {
        //             let savedCode = null;

        //             data.forEach(item => {
        //                 const option = document.createElement('option');
        //                 option.value = item.code;
        //                 option.textContent = item.name;

        //                 if (item.name == oldKecamatan) {
        //                     option.selected = true;
        //                     savedCode = item.code;
        //                 }

        //                 kecamatanSelect.appendChild(option);
        //             });

        //             if (savedCode) {
        //                 loadKelurahan(savedCode);
        //             }
        //         })
        //         .catch(() => alert('Gagal memuat data kecamatan'));

        //     // Jadikan fungsi agar bisa dipanggil saat pre-load maupun saat user ganti
        //     function loadKelurahan(districtCode) {
        //         kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';

        //         fetch(`/wisata/api/kelurahan/${districtCode}`)
        //             .then(res => res.json())
        //             .then(data => {
        //                 data.forEach(item => {
        //                     const option = document.createElement('option');
        //                     option.value = item.code;
        //                     option.textContent = item.name;

        //                     // ✅ cocokkan nama kelurahan dari DB
        //                     if (item.name == oldKelurahan) {
        //                         option.selected = true;
        //                     }

        //                     kelurahanSelect.appendChild(option);
        //                 });
        //             })
        //             .catch(() => alert('Gagal memuat data kelurahan'));
        //     }

        //     // Saat user ganti kecamatan manual
        //     kecamatanSelect.addEventListener('change', function() {
        //         const selectedOption = this.options[this.selectedIndex];
        //         kecamatanNama.value = selectedOption.text; // update hidden input nama
        //         kelurahanNama.value = '';

        //         if (this.value) {
        //             loadKelurahan(this.value);
        //         } else {
        //             kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
        //         }
        //     });

        //     // Saat user ganti kelurahan manual
        //     kelurahanSelect.addEventListener('change', function() {
        //         const selectedOption = this.options[this.selectedIndex];
        //         kelurahanNama.value = selectedOption.text; // update hidden input nama
        //     });
        // });
        const kecamatanSelect = document.getElementById('kecamatan');
        const kelurahanSelect = document.getElementById('kelurahan');
        const kecamatanNama = document.getElementById('kecamatan_nama');
        const kelurahanNama = document.getElementById('kelurahan_nama');
        let isGPSActive = false;
        let pendingKelurahan = null;
        let isKecamatanLoaded = false;

        document.addEventListener('DOMContentLoaded', async function() {


            try {
                const res = await fetch('/wisata/api/kecamatan');
                const data = await res.json();
                let savedCode = null;

                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.code;
                    option.textContent = item.name;

                    if (item.name == oldKecamatan) {
                        option.selected = true;
                        savedCode = item.code;
                    }
                    kecamatanSelect.appendChild(option);
                    //                         kecamatanSelect.innerHTML += `
                //     <option value="${item.code}">
                //         ${item.name}
                //     </option>
                // `;
                });

                if (savedCode) {
                    await loadKelurahan(savedCode);
                }
                isKecamatanLoaded = true;
                updateAlamatDariKoordinat(
                    lastValidPosition.lat,
                    lastValidPosition.lng
                );

                // if (!isGPSActive) {
                //     updateAlamatDariKoordinat(
                //         lastValidPosition.lat,
                //         lastValidPosition.lng
                //     );
                // }
                // initGPS();

            } catch {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal memuat data kecamatan',
                    confirmButtonText: 'OK'
                });
            }

            kecamatanSelect.addEventListener('change', async function() {

                const selectedOption = this.options[this.selectedIndex];
                kecamatanNama.value = selectedOption.text;

                const districtCode = this.value;

                await loadKelurahan(districtCode);
            });

            kelurahanSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                kelurahanNama.value = selectedOption.text;
            });
        });

        // Kelurahan
        async function loadKelurahan(districtCode) {
            kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';

            if (!districtCode) return [];

            try {
                const res = await fetch(`/wisata/api/kelurahan/${districtCode}`);
                const data = await res.json();

                data.forEach(item => {
                    //     kelurahanSelect.innerHTML += `
                //     <option value="${item.code}">
                //         ${item.name}
                //     </option>
                // `;
                    const option = document.createElement('option');
                    option.value = item.code;
                    option.textContent = item.name;

                    if (item.name == oldKelurahan) {
                        option.selected = true;
                    }

                    if (pendingKelurahan) {
                        for (let j = 0; j < kelurahanSelect.options.length; j++) {
                            const namaKelOption = normalizeWilayah(kelurahanSelect.options[j].text);
                            const namaKelGeo = normalizeWilayah(pendingKelurahan);

                            if (namaKelOption === namaKelGeo) {
                                kelurahanSelect.selectedIndex = j;
                                kelurahanNama.value = kelurahanSelect.options[j].text;
                                break;
                            }
                        }
                        pendingKelurahan = null;
                    }

                    kelurahanSelect.appendChild(option);

                });
                kelurahanSelect.dispatchEvent(new Event('change'));
                return data;

            } catch (err) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal memuat data kelurahan',
                    confirmButtonText: 'OK'
                });
                return [];
            }
        }

        // Kecamatan
        async function loadKecamatan() {
            try {
                const res = await fetch('/wisata/api/kecamatan');
                const data = await res.json();

                let savedCode = null;

                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.code;
                    option.textContent = item.name;

                    if (item.name == oldKecamatan) {
                        option.selected = true;
                        savedCode = item.code;
                    }

                    kecamatanSelect.appendChild(option);
                });

                if (savedCode) {
                    await loadKelurahan(savedCode);
                }

                isKecamatanLoaded = true;

            } catch {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal memuat data kecamatan'
                });
            }
        }

        // Foto 
        const fotoInput = document.getElementById('foto');
        const fotoError = document.getElementById('fotoError');
        const previewWrapper = document.getElementById('previewWrapper');
        const fotoPreview = document.getElementById('fotoPreview');

        const MAX_SIZE = 10 * 1024 * 1024;
        const ALLOWED_TYPES = ['image/jpeg', 'image/png', 'image/jpg'];

        fotoInput.addEventListener('change', function() {
            const file = this.files[0];

            fotoError.classList.add('hidden');
            fotoError.textContent = '';
            // previewWrapper.classList.add('hidden');

            if (!file) return;

            if (!ALLOWED_TYPES.includes(file.type)) {
                showError('Format file tidak sesuai.');
                resetInput();
                return;
            }

            if (file.size > MAX_SIZE) {
                showError('Ukuran foto terlalu besar.');
                resetInput();
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                fotoPreview.src = e.target.result;
                previewWrapper.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        });

        function showError(message) {
            fotoError.textContent = message;
            fotoError.classList.remove('hidden');
        }

        function resetInput() {
            fotoInput.value = '';
            fotoPreview.src = '';
        }

        // Peta Latitude Longitude
        // const latInput = document.getElementById('latitude');
        // const lngInput = document.getElementById('longitude');

        // let lat = parseFloat(latInput.value);
        // let lng = parseFloat(lngInput.value);

        // let mapOptions = {
        //     center: [lat, lng],
        //     zoom: 10
        // }

        // let map = new L.map('map', mapOptions);

        // let layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
        // map.addLayer(layer);

        // let marker = L.marker(mapOptions.center, {
        //     draggable: true,
        // }).addTo(map);
        // marker.bindPopup(
        //     `<div style="text-align: center;"> <b>Klik</b> atau <b>Geser</b><br> untuk menentukan lokasi wisata kuliner! </div>`
        // ).openPopup();

        // document.getElementById('latitude').value = mapOptions.center[0];
        // document.getElementById('longitude').value = mapOptions.center[1];

        // marker.on('drag', function(e) {
        //     let latlng = e.target.getLatLng();
        //     document.getElementById('latitude').value = latlng.lat;
        //     document.getElementById('longitude').value = latlng.lng;
        // });

        // map.on('click', function(event) {
        //     marker.setLatLng(event.latlng);
        //     document.getElementById('latitude').value = event.latlng.lat;
        //     document.getElementById('longitude').value = event.latlng.lng;
        // });

        // // const latInput = document.getElementById('latitude');
        // // const lngInput = document.getElementById('longitude');

        // function updateMarkerFromInput() {
        //     let lat = parseFloat(latInput.value);
        //     let lng = parseFloat(lngInput.value);

        //     if (isNaN(lat) || isNaN(lng)) return;

        //     let newLatLng = [lat, lng];

        //     marker.setLatLng(newLatLng);
        //     map.setView(newLatLng, map.getZoom());
        // }

        // latInput.addEventListener('input', updateMarkerFromInput);
        // lngInput.addEventListener('input', updateMarkerFromInput);


        // document.getElementById('kelurahan').addEventListener('change', function() {
        //     const kelurahanText = this.options[this.selectedIndex].text;
        //     const kecamatanText = document.getElementById('kecamatan')
        //         .options[document.getElementById('kecamatan').selectedIndex].text;

        //     if (!kelurahanText || !kecamatanText) return;

        //     const alamat = `${kelurahanText}, ${kecamatanText}, Kota Semarang, Jawa Tengah, Indonesia`;

        //     cariKoordinatDariAlamat(alamat);
        // });

        // function cariKoordinatDariAlamat(alamat) {
        //     fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(alamat)}`)
        //         .then(res => res.json())
        //         .then(data => {
        //             if (data.length === 0) return;

        //             const lat = parseFloat(data[0].lat);
        //             const lng = parseFloat(data[0].lon);

        //             // update input
        //             latitude.value = lat;
        //             longitude.value = lng;

        //             // pindahin map & marker
        //             marker.setLatLng([lat, lng]);
        //             map.setView([lat, lng], 15);
        //         });
        // }


        let map;
        let marker;
        let geocoder;
        let isAutoUpdate = false;
        let lastAlamat = "";
        let lastValidPosition = {
            lat: -6.984168497010843,
            lng: 110.40926002563694
        };
        const latInput = document.getElementById('latitude');
        const lngInput = document.getElementById('longitude');
        let lat = parseFloat(latInput.value);
        let lng = parseFloat(lngInput.value);
        const alamatInput = document.getElementById('alamat');
        let activeInfoWindow = null;
        let dataKuliner = @json($wkuliner);
        let markers = [];
        let currentId = "{{ $wisataKuliner->id_wisata_kuliner }}";

        function clearMarkers() {
            markers.forEach(m => m.setMap(null));
            markers = [];
        }
        document.addEventListener('DOMContentLoaded', async function() {
            await loadKecamatan();
            await initMap();

        });

        // Init Map
        async function initMap() {
            const markerLib = await google.maps.importLibrary("marker");
            AdvancedMarkerElement = markerLib.AdvancedMarkerElement;
            PinElement = markerLib.PinElement;

            const infoWindow = new google.maps.InfoWindow({
                content: `<div style="
                            text-align: center;
                            font-size: 13px;
                            line-height: 1.4;
                        ">
                <b>Klik</b> atau <b>Geser</b><br>
                untuk menentukan lokasi wisata kuliner!
              </div>`,
            });

            const defaultPosition = {
                lat: lat,
                lng: lng
            };

            // Map
            map = new google.maps.Map(document.getElementById("map"), {
                center: defaultPosition,
                zoom: 16,
                mapId: "5ee8a1d5bfc6676ac1b5f32c",
                clickableIcons: false,
            });

            // Marker
            marker = new google.maps.marker.AdvancedMarkerElement({
                position: defaultPosition,
                map: map,
                gmpDraggable: true
            });

            // Geocoder
            geocoder = new google.maps.Geocoder();

            // Input Lat dan Lng
            latInput.value = defaultPosition.lat;
            lngInput.value = defaultPosition.lng;

            infoWindow.open({
                anchor: marker,
                map,
            });

            // Ubah Lat Lng Saat Drag
            marker.addListener('dragend', (e) => {
                infoWindow.close();
                const lat = e.latLng.lat();
                const lng = e.latLng.lng();

                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;

                updateAlamatDariKoordinat(lat, lng);
            });

            // Ubah Lat Lng Saat Klik
            map.addListener('click', (e) => {
                infoWindow.close();
                const lat = e.latLng.lat();
                const lng = e.latLng.lng();

                marker.position = {
                    lat,
                    lng
                };

                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;

                updateAlamatDariKoordinat(lat, lng);
            });

            // Ubah Marker Saat Input Lat Lng
            function updateMarkerFromInput() {
                const lat = parseFloat(latInput.value);
                const lng = parseFloat(lngInput.value);

                if (isNaN(lat) || isNaN(lng)) return;

                geocoder.geocode({
                    location: {
                        lat,
                        lng
                    },
                    language: "id"
                }, function(results, status) {
                    if (status === "OK" && results[0]) {
                        const components = results[0].address_components;

                        if (!isDalamSemarang(components)) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Lokasi Tidak Valid',
                                text: 'Lokasi harus berada di Kota Semarang!',
                                confirmButtonText: 'OK'
                            });

                            marker.position = marker.position;
                            map.setCenter(marker.position);

                            latInput.value = marker.position.lat;
                            lngInput.value = marker.position.lng;
                            return;
                        }
                        marker.position = {
                            lat,
                            lng
                        };
                        map.setCenter({
                            lat,
                            lng
                        });

                        lastValidPosition = {
                            lat,
                            lng
                        };

                        updateAlamatDariKoordinat(lat, lng);
                    }
                });
            }

            latInput.addEventListener('change', updateMarkerFromInput);
            lngInput.addEventListener('change', updateMarkerFromInput);

            // Cari Marker, Lat Lng, dan Alamat saat Ubah Kecamatan dan Kelurahan
            const kelurahanSelect = document.getElementById('kelurahan');

            kelurahanSelect.addEventListener('change', function() {

                const kelurahanText = this.options[this.selectedIndex].text;

                const kecamatanSelect = document.getElementById('kecamatan');
                const kecamatanText = kecamatanSelect.options[kecamatanSelect.selectedIndex]
                    .text;

                if (!kelurahanText || !kecamatanText) return;

                const alamat = `${kelurahanText}, ${kecamatanText}, Kota Semarang, Jawa Tengah`;

                cariKoordinatDariAlamat(alamat);
            });

            // Cari Marker dari Alamat
            alamatInput.addEventListener('change', function() {

                if (isAutoUpdate) {
                    isAutoUpdate = false;
                    return;
                }

                const alamat = this.value.trim();

                if (!alamat) return;

                const alamatLengkap = `${alamat}, Kota Semarang, Jawa Tengah`;

                cariKoordinatDariAlamat(alamatLengkap);

                lastAlamat = alamat;
            });

            tampilkanSemuaKuliner();
        }

        // Update Alamat Dari Koordinat
        async function updateAlamatDariKoordinat(lat, lng) {
            if (!isKecamatanLoaded) return;

            geocoder.geocode({
                location: {
                    lat,
                    lng
                },
                language: "id",
            }, async function(results, status) {

                if (status === "OK" && results[0]) {
                    const components = results[0].address_components;

                    if (!isDalamSemarang(components)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lokasi Tidak Valid',
                            text: 'Lokasi harus berada di Kota Semarang!',
                            confirmButtonText: 'OK'
                        });

                        marker.position = lastValidPosition;
                        map.setCenter(lastValidPosition);

                        latInput.value = lastValidPosition.lat;
                        lngInput.value = lastValidPosition.lng;

                        return;
                    }

                    lastValidPosition = {
                        lat,
                        lng
                    };

                    let kelurahan = "";
                    let kecamatan = "";
                    let kota = "";
                    let provinsi = "";
                    let kodepos = "";

                    components.forEach(comp => {
                        if (comp.types.includes("administrative_area_level_4")) {
                            kelurahan = comp.long_name;
                        }
                        if (comp.types.includes("administrative_area_level_3")) {
                            kecamatan = comp.long_name;
                        }
                        if (comp.types.includes("administrative_area_level_2")) {
                            kota = comp.long_name;
                        }
                        if (comp.types.includes("administrative_area_level_1")) {
                            provinsi = comp.long_name;
                        }
                        if (comp.types.includes("postal_code")) {
                            kodepos = comp.long_name;
                        }
                    });

                    const parts = [kelurahan, kecamatan, kota, provinsi]
                        .filter(part => part && part.trim() !== "");

                    let alamatCustom = parts.join(', ');

                    if (kodepos) {
                        alamatCustom += ` ${kodepos}`;
                    }

                    isAutoUpdate = true;

                    document.getElementById('alamat').value = alamatCustom;
                    lastAlamat = alamatCustom;
                    pendingKelurahan = kelurahan;
                    const kecamatanSelect = document.getElementById('kecamatan');
                    const kelurahanSelect = document.getElementById('kelurahan');

                    for (let i = 0; i < kecamatanSelect.options.length; i++) {

                        const namaOption = normalizeWilayah(kecamatanSelect.options[i].text);
                        const namaGeo = normalizeWilayah(kecamatan);

                        if (namaOption.includes(namaGeo) || namaGeo.includes(namaOption)) {

                            kecamatanSelect.selectedIndex = i;
                            kecamatanNama.value = kecamatanSelect.options[i].text;

                            const districtCode = kecamatanSelect.value;

                            (async () => {
                                await loadKelurahan(districtCode);

                                for (let j = 0; j < kelurahanSelect.options.length; j++) {
                                    const namaKelOption = normalizeWilayah(kelurahanSelect.options[
                                        j].text);
                                    const namaKelGeo = normalizeWilayah(kelurahan);

                                    if (namaKelOption.includes(namaKelGeo) || namaKelGeo.includes(
                                            namaKelOption)) {
                                        kelurahanSelect.selectedIndex = j;
                                        kelurahanNama.value = kelurahanSelect.options[j].text;
                                        break;
                                    }
                                }
                            })();

                            break;
                        }
                    }
                }
            });
        }

        function cariKoordinatDariAlamat(alamat) {
            geocoder.geocode({
                address: alamat,
                language: "id",
            }, function(results, status) {

                if (status === "OK" && results[0]) {

                    const components = results[0].address_components;
                    if (!isDalamSemarang(components)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lokasi Tidak Valid',
                            text: 'Lokasi harus berada di Kota Semarang!',
                            confirmButtonText: 'OK'
                        });

                        marker.position = lastValidPosition;
                        map.setCenter(lastValidPosition);

                        latInput.value = lastValidPosition.lat;
                        lngInput.value = lastValidPosition.lng;
                        return;
                    }

                    const location = results[0].geometry.location;
                    const lat = location.lat();
                    const lng = location.lng();

                    marker.position = {
                        lat,
                        lng
                    };
                    map.setCenter({
                        lat,
                        lng
                    });
                    map.setZoom(17);
                    lastValidPosition = {
                        lat,
                        lng
                    };

                    document.getElementById('latitude').value = lat;
                    document.getElementById('longitude').value = lng;

                    updateAlamatDariKoordinat(lat, lng);
                }
            });
        }

        function normalizeWilayah(nama) {
            return nama
                .toLowerCase()
                .replace("kecamatan", "")
                .replace("kec.", "")
                .replace("kelurahan", "")
                .replace("kel.", "")
                .replace("desa", "")
                .replace(/\s+/g, "")
                .trim();
        }

        function isDalamSemarang(components) {
            let kota = "";

            components.forEach(comp => {
                if (comp.types.includes("administrative_area_level_2")) {
                    kota = comp.long_name;
                }
            });

            return kota.toLowerCase().includes("semarang");
        }


        function tampilkanSemuaKuliner() {
            clearMarkers();

            dataKuliner.forEach(item => {
                if (item.latitude && item.longitude) {
                    if (item.id_wisata_kuliner == currentId) return;

                    let posisi = {
                        lat: parseFloat(item.latitude),
                        lng: parseFloat(item.longitude)
                    };

                    const pin = new PinElement({
                        background: "#FB991A",
                        borderColor: "#ffffff",
                        glyphColor: "#ffffff"
                    });

                    let marker = new google.maps.marker.AdvancedMarkerElement({
                        position: posisi,
                        map: map,
                        title: item.nama,
                        content: pin,
                    });

                    markers.push(marker);

                    let infoWindow = new google.maps.InfoWindow({
                        content: `
                            <div style="width:250px; font-family:sans-serif;">
                                <h3 style="margin:0 0 5px; font-size:16px;">
                                ${item.nama}
                                </h3>
                                <p style="margin:0 0 10px; color:#555;">
                                    ${item.alamat ?? '-'}
                                </p>
                            </div>  
                        `
                    });

                    marker.addEventListener("click", () => {
                        if (activeInfoWindow) {
                            activeInfoWindow.close();
                        }

                        infoWindow.open(map, marker);
                        activeInfoWindow = infoWindow;
                    });
                }
            });
        }

        $(document).ready(function() {
            let selectedWisata = {
                id: "{{ $wisataKuliner->id_wisata_kuliner ?? $wisataKuliner->id }}",
                text: "{{ $wisataKuliner->nama }}"
            };

            let option = new Option(selectedWisata.text, selectedWisata.id, true, true);
            $('#selectmhsadmin').append(option).trigger('change');

            $('#nama').val(selectedWisata.text);

            $("#selectmhsadmin").select2({
                tags: true,
                allowClear: true,

                createTag: function(params) {
                    var term = $.trim(params.term);

                    if (term === '') {
                        return null;
                    }

                    return {
                        id: term,
                        text: term,
                        newTag: true
                    };
                },

                templateResult: function(data) {
                    if (data.newTag) {
                        return $('<span style="color:black;">Tambah "<b>' +
                            data.text +
                            '</b>"</span>');
                    }
                    return data.text;
                },

                ajax: {
                    url: "{{ route('select.mhs.admin') }}",
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data.data ?? data, function(item) {
                                return {
                                    id: item.id_wisata_kuliner,
                                    text: item.nama
                                }
                            })
                        }
                    }
                }
            });
            // var idmhs = $("#selectmhsadmin").val();
            let selectedFasilitas = {!! $fasilitas->map(function ($f) {
                    return ['id' => $f->fasilitas->id_fasilitas, 'text' => $f->fasilitas->nama];
                })->toJson() !!};

            selectedFasilitas.forEach(function(f) {
                let option = new Option(f.text, f.id, true, true);
                $('#selectmkadmin').append(option).trigger('change');
            });
            $("#selectmkadmin").attr("multiple", "multiple");
            // $.get("{{ url('ngampumkadmin') }}/" + idmhs, function(data) {
            //     $('#selectmkadmin').html(data);
            // });
            $("#selectmkadmin").select2({
                // placeholder: 'Pilih Fasilitas',
                allowClear: true,
                tags: true,

                createTag: function(params) {
                    var term = $.trim(params.term);

                    if (term === '') {
                        return null;
                    }

                    return {
                        id: term,
                        text: term,
                        newTag: true
                    };
                },

                templateResult: function(data) {
                    if (data.newTag) {
                        return $('<span style="color:black;">Tambah "<b>' +
                            data.text +
                            '</b>"</span>');
                    }

                    return data.text;
                },

                ajax: {
                    url: function() {
                        return "{{ url('selectmkadmin') }}/" + $("#selectmhsadmin").val();
                    },
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data.data ?? data, function(item) {
                                return {
                                    id: item.id_fasilitas,
                                    text: item.nama
                                }
                            })
                        }
                    }
                }
            });

            let selectedKategori = {!! $kategori->map(function ($k) {
                    return ['id' => $k->kategori->id_kategori, 'text' => $k->kategori->nama];
                })->toJson() !!};

            selectedKategori.forEach(function(k) {
                let option = new Option(k.text, k.id, true, true);
                $('#selectkategoriadmin').append(option).trigger('change');
            });

            $("#selectkategoriadmin").attr("multiple", "multiple");
            $("#selectkategoriadmin").select2({
                allowClear: true,
                tags: true,

                createTag: function(params) {
                    var term = $.trim(params.term);

                    if (term === '') return null;

                    return {
                        id: term,
                        text: term,
                        newTag: true
                    };
                },

                templateResult: function(data) {
                    if (data.newTag) {
                        return $('<span style="color:black;">Tambah "<b>' +
                            data.text +
                            '</b>"</span>');
                    }
                    return data.text;
                },

                ajax: {
                    url: function() {
                        return "{{ url('selectkategoriadmin') }}/" + $("#selectmhsadmin")
                            .val();
                    },
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data.data ?? data, function(item) {
                                return {
                                    id: item.id_kategori,
                                    text: item.nama
                                }
                            })
                        }
                    }
                }
            });

            $("#selectmhsadmin").change(function() {
                var idmhs = $("#selectmhsadmin").val();

                $('#selectmkadmin').val(null).trigger("change");
                $('#selectkategoriadmin').val(null).trigger("change");

                if (idmhs) {
                    $.get("{{ url('ngampumkadmin') }}/" + idmhs, function(data) {
                        $('#selectmkadmin').html(data).trigger('change');
                    });

                    $.get("{{ url('ngampukategoriadmin') }}/" + idmhs, function(data) {
                        $('#selectkategoriadmin').html(data).trigger('change');
                    });
                }

                let selectedText = $('#selectmhsadmin').find(':selected').text();
                $('#nama').val(selectedText);
            });

            //save form
            $("#addForm").on('submit', function(e) {
                e.preventDefault();
                $("#saveBtn").html('Processing...').attr('disabled', 'disabled');
                var link = $("#addForm").attr('action');
                $.ajax({
                    url: link,
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $("#saveBtn").html('SIMPAN').removeAttr('disabled');
                        if (response.status) {
                            $('#selectkategoriadmin').val(null).trigger("change")
                            $('#selectmkadmin').val(null).trigger("change")
                            $('#selectmhsadmin').val(null).trigger("change")
                            alert(response.message);
                        }
                    },
                    error: function(response) {
                        $("#saveBtn").html('SIMPAN').removeAttr('disabled');
                        alert(response.message);
                    }
                });
            });
        });
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-gBdR_gqZTd8B6jz3mVJWI-pqC_jPlAI&libraries=marker&callback=initMap"
        async defer></script>
</body>

</html>
