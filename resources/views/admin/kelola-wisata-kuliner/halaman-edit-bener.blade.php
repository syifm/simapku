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

                {{-- <div id="map">
                </div> --}}


                <div class="bg-white rounded-lg shadow-md p-6 mt-14">
                    <form action="{{ route('kelolawisatakuliner.update', $wisataKuliner->id_wisata_kuliner) }}"
                        method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')
                        {{-- <p class="text-red-500 text-sm font-bold text-right">* Seluruh Isian Wajib Diisi</p1> --}}
                        <div class="w-full mx-auto space-y-6">
                            <!-- Nama Wisata Kuliner -->
                            <div>
                                <label class="block text-sm font-medium text-gray-800 mb-1"
                                    for="nama"><span>Nama</span>
                                    <span class="text-red-500 font-bold">*</span></label>
                                <select id="selectmhsadmin" name='id_wisata_kuliner'
                                    class="form-select w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    aria-label="Default select example">

                                </select>

                                @error('id_wisata_kuliner')
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

                                {{-- <input type="hidden" name="kecamatan" id="kecamatan_nama">
                                <input type="hidden" name="kelurahan" id="kelurahan_nama"> --}}
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
                                    value="{{ old('no_telp', $wisataKuliner->no_telp) }}" required pattern="\d{10,15}"
                                    minlength="10" maxlength="15"
                                    class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('no_telp')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-medium text-gray-800 mb-1" for="email">Email</label>
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

                            <div>
                                <label class="block text-sm font-medium text-gray-800 mb-1"
                                    for="fasilitas"><span>Fasilitas</span>
                                    <span class="text-red-500 font-bold">*</span></label>
                                <select id="selectmkadmin" name="id_fasilitas[]"
                                    class="form-select w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    aria-label="Default select example">

                                </select>

                                @error('id_fasilitas')
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

                                {{-- @if (!empty($wisataKuliner->foto))
                                    <div class="mt-2 w-40 relative">
                                        <img src="{{ asset('storage/' . $wisataKuliner->foto) }}"
                                            class="rounded-md border w-full h-40 object-cover">
                                    </div>
                                @endif --}}

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

                            <div id="map">
                            </div>


                            <!-- Submit -->
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="bg-[#FB991A] text-white px-12 py-2 rounded-md hover:bg-orange-600 transition duration-300 font-bold">
                                    Simpan
                                </button>
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


        const oldKecamatan = "{{ old('kecamatan', $wisataKuliner->kecamatan) }}";
        const oldKelurahan = "{{ old('kelurahan', $wisataKuliner->kelurahan) }}";

        document.addEventListener('DOMContentLoaded', function() {
            const kecamatanSelect = document.getElementById('kecamatan');
            const kelurahanSelect = document.getElementById('kelurahan');
            const kecamatanNama = document.getElementById('kecamatan_nama');
            const kelurahanNama = document.getElementById('kelurahan_nama');

            // LOAD KECAMATAN
            fetch('/wisata/api/kecamatan')
                .then(res => res.json())
                .then(data => {
                    let savedCode = null;

                    data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.code;
                        option.textContent = item.name;

                        // ✅ cocokkan nama dari DB dengan nama dari API
                        if (item.name == oldKecamatan) {
                            option.selected = true;
                            savedCode = item.code; // simpan code untuk load kelurahan
                        }

                        kecamatanSelect.appendChild(option);
                    });

                    // ✅ auto load kelurahan sesuai kecamatan yang tersimpan
                    if (savedCode) {
                        loadKelurahan(savedCode);
                    }
                })
                .catch(() => alert('Gagal memuat data kecamatan'));

            // Jadikan fungsi agar bisa dipanggil saat pre-load maupun saat user ganti
            function loadKelurahan(districtCode) {
                kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';

                fetch(`/wisata/api/kelurahan/${districtCode}`)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(item => {
                            const option = document.createElement('option');
                            option.value = item.code;
                            option.textContent = item.name;

                            // ✅ cocokkan nama kelurahan dari DB
                            if (item.name == oldKelurahan) {
                                option.selected = true;
                            }

                            kelurahanSelect.appendChild(option);
                        });
                    })
                    .catch(() => alert('Gagal memuat data kelurahan'));
            }

            // Saat user ganti kecamatan manual
            kecamatanSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                kecamatanNama.value = selectedOption.text; // update hidden input nama
                kelurahanNama.value = '';

                if (this.value) {
                    loadKelurahan(this.value);
                } else {
                    kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
                }
            });

            // Saat user ganti kelurahan manual
            kelurahanSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                kelurahanNama.value = selectedOption.text; // update hidden input nama
            });
        });

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
        const latInput = document.getElementById('latitude');
        const lngInput = document.getElementById('longitude');

        let lat = parseFloat(latInput.value);
        let lng = parseFloat(lngInput.value);

        let mapOptions = {
            center: [lat, lng],
            zoom: 10
        }

        let map = new L.map('map', mapOptions);

        let layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
        map.addLayer(layer);

        let marker = L.marker(mapOptions.center, {
            draggable: true,
        }).addTo(map);
        marker.bindPopup(
            `<div style="text-align: center;"> <b>Klik</b> atau <b>Geser</b><br> untuk menentukan lokasi wisata kuliner! </div>`
        ).openPopup();

        document.getElementById('latitude').value = mapOptions.center[0];
        document.getElementById('longitude').value = mapOptions.center[1];

        marker.on('drag', function(e) {
            let latlng = e.target.getLatLng();
            document.getElementById('latitude').value = latlng.lat;
            document.getElementById('longitude').value = latlng.lng;
        });

        map.on('click', function(event) {
            marker.setLatLng(event.latlng);
            document.getElementById('latitude').value = event.latlng.lat;
            document.getElementById('longitude').value = event.latlng.lng;
        });

        // const latInput = document.getElementById('latitude');
        // const lngInput = document.getElementById('longitude');

        function updateMarkerFromInput() {
            let lat = parseFloat(latInput.value);
            let lng = parseFloat(lngInput.value);

            if (isNaN(lat) || isNaN(lng)) return;

            let newLatLng = [lat, lng];

            marker.setLatLng(newLatLng);
            map.setView(newLatLng, map.getZoom());
        }

        latInput.addEventListener('input', updateMarkerFromInput);
        lngInput.addEventListener('input', updateMarkerFromInput);


        document.getElementById('kelurahan').addEventListener('change', function() {
            const kelurahanText = this.options[this.selectedIndex].text;
            const kecamatanText = document.getElementById('kecamatan')
                .options[document.getElementById('kecamatan').selectedIndex].text;

            if (!kelurahanText || !kecamatanText) return;

            const alamat = `${kelurahanText}, ${kecamatanText}, Kota Semarang, Jawa Tengah, Indonesia`;

            cariKoordinatDariAlamat(alamat);
        });

        function cariKoordinatDariAlamat(alamat) {
            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(alamat)}`)
                .then(res => res.json())
                .then(data => {
                    if (data.length === 0) return;

                    const lat = parseFloat(data[0].lat);
                    const lng = parseFloat(data[0].lon);

                    // update input
                    latitude.value = lat;
                    longitude.value = lng;

                    // pindahin map & marker
                    marker.setLatLng([lat, lng]);
                    map.setView([lat, lng], 15);
                });
        }

        $(document).ready(function() {
            let selectedWisata = {
                id: "{{ $wisataKuliner->id_wisata_kuliner ?? $wisataKuliner->id }}",
                text: "{{ $wisataKuliner->nama }}"
            };

            let option = new Option(selectedWisata.text, selectedWisata.id, true, true);
            $('#selectmhsadmin').append(option).trigger('change');

            $("#selectmhsadmin").select2({
                // placeholder: 'Tambah/Pilih Wisata Kuliner',
                tags: true,
                allowClear: true,
                // theme: "bootstrap-5",

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
            $("#selectmhsadmin").change(function() {
                var idmhs = $("#selectmhsadmin").val();

                $('#selectmkadmin').val(null).trigger("change");

                if (idmhs) {
                    $.get("{{ url('ngampumkadmin') }}/" + idmhs, function(data) {
                        $('#selectmkadmin').html(data).trigger('change');
                    });
                }
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
</body>

</html>
