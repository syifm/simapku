<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAPKU | Tambah Wisata Kuliner</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
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
                        <h1 class="font-bold text-xl">Tambah Wisata Kuliner</h1>
                    </div>
                </div>

                {{-- <div id="map">
                </div> --}}


                <div class="bg-white rounded-lg shadow-md p-6 mt-14">
                    <form action="{{ route('kelolawisatakuliner.simpan') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        {{-- <p class="text-red-500 text-sm font-bold text-right">* Seluruh Isian Wajib Diisi</p1> --}}
                        <div class="w-full mx-auto space-y-6">
                            <!-- Nama Wisata Kuliner -->
                            <div>
                                <label class="block text-sm font-medium text-gray-800 mb-1"
                                    for="nama"><span>Nama</span>
                                    <span class="text-red-500 font-bold">*</span></label>
                                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required
                                    class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('nama')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>


                            <div class="grid grid-cols-2 gap-4">
                                <!-- Kecamatan -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Kecamatan <span class="text-red-500">*</span>
                                    </label>
                                    <select id="kecamatan" name="kecamatan_kode" value="{{ old('kecamatan') }}" required
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
                                    <select id="kelurahan" name="kelurahan_kode" value="{{ old('kelurahan') }}" required
                                        class="w-full border rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500">
                                        <option value="">Pilih Kelurahan</option>
                                    </select>
                                    @error('kelurahan')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <input type="hidden" name="kecamatan" id="kecamatan_nama">
                                <input type="hidden" name="kelurahan" id="kelurahan_nama">
                            </div>

                            <!-- Alamat -->
                            <div>
                                <label class="block text-sm font-medium text-gray-800 mb-1"
                                    for="alamat"><span>Alamat</span>
                                    <span class="text-red-500 font-bold">*</span></label>
                                <textarea id="alamat" name="alamat" rows="4"
                                    class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nomor Telepon -->
                            <div>
                                <label class="block text-sm font-medium text-gray-800 mb-1" for="no_telp"><span>Nomor
                                        Telepon</span>
                                    <span class="text-red-500 font-bold">*</span></label>
                                <input type="text" id="no_telp" name="no_telp" value="{{ old('no_telp') }}"
                                    required pattern="\d{10,15}" minlength="10" maxlength="15"
                                    class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('no_telp')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-medium text-gray-800 mb-1" for="email">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
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
                                    class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Foto Wisata Kuliner -->
                            <div>
                                <label class="block text-sm font-medium text-gray-800 mb-1" for="foto">
                                    <span>Foto</span>
                                    <span class="text-red-500 font-bold">*</span>
                                </label>

                                <input type="file" id="foto" name="foto" accept="image/*" required
                                    class="file-input-wrapper">

                                <div id="fotoError" class="text-red-500 text-sm mt-1 hidden"></div>

                                <!-- PREVIEW -->
                                <div id="previewWrapper" class="mt-3 hidden relative w-40">
                                    <img id="fotoPreview" class="rounded-md border w-full h-40 object-cover">
                                    {{-- <button type="button" onclick="removeFoto()"
                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">
                                        ✕
                                    </button> --}}
                                </div>

                                <p class="text-xs text-gray-600 mt-2">
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
                                        name="latitude" id="latitude" value="{{ old('latitude') }}" required>
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
                                        name="longitude" id="longitude" value="{{ old('longitude') }}" required>
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
                                {{-- <input type="hidden" id="tanggal_daftar" name="tanggal_daftar"> --}}
                            </div>
                        </div>
                    </form>
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
        document.addEventListener('DOMContentLoaded', function() {
            const kecamatanSelect = document.getElementById('kecamatan');
            const kelurahanSelect = document.getElementById('kelurahan');
            const kecamatanNama = document.getElementById('kecamatan_nama');
            const kelurahanNama = document.getElementById('kelurahan_nama');

            // LOAD KECAMATAN (pas halaman dibuka)
            fetch('/wisata/api/kecamatan')
                .then(res => res.json())
                .then(data => {
                    data.forEach(item => {
                        kecamatanSelect.innerHTML += `
                    <option value="${item.code}">
                        ${item.name}
                    </option>
                `;
                    });
                })
                .catch(() => {
                    alert('Gagal memuat data kecamatan');
                });

            // LOAD KELURAHAN (pas kecamatan berubah)
            kecamatanSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                kecamatanNama.value = selectedOption.text;

                const districtCode = this.value;
                kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';

                if (!districtCode) return;

                fetch(`/wisata/api/kelurahan/${districtCode}`)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(item => {
                            kelurahanSelect.innerHTML += `
                        <option value="${item.code}">
                            ${item.name}
                        </option>
                    `;
                        });
                    })
                    .catch(() => {
                        alert('Gagal memuat data kelurahan');
                    });
            });

            kelurahanSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                kelurahanNama.value = selectedOption.text;
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
            previewWrapper.classList.add('hidden');

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

        function removeFoto() {
            resetInput();
            fotoError.classList.add('hidden');
            previewWrapper.classList.add('hidden');
        }

        // Peta Latitude Longitude
        let mapOptions = {
            center: [-6.984168497010843, 110.40926002563694],
            zoom: 10
        }

        let map = new L.map('map', mapOptions);

        let layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
        map.addLayer(layer);
        // let marker = null;
        // map.on('click', (event) => {
        //     if (marker !== null) {
        //         map.removeLayer(marker);
        //     }

        //     marker = L.marker([event.latlng.lat, event.latlng.lng], {
        //         draggable: true
        //     }).addTo(map);
        //     console.log(event);

        //     document.getElementById('latitude').value = event.latlng.lat;
        //     document.getElementById('longitude').value = event.latlng.lng;

        //     marker.on('drag', function(e) {
        //         let latlng = e.target.getLatLng();
        //         document.getElementById('latitude').value = latlng.lat;
        //         document.getElementById('longitude').value = latlng.lng;
        //     });
        // })

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

        const latInput = document.getElementById('latitude');
        const lngInput = document.getElementById('longitude');

        function updateMarkerFromInput() {
            let lat = parseFloat(latInput.value);
            let lng = parseFloat(lngInput.value);

            if (isNaN(lat) || isNaN(lng)) return;

            let newLatLng = [lat, lng];

            marker.setLatLng(newLatLng);
            map.setView(newLatLng, map.getZoom());
        }

        // pas user ngetik
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

        // const fotoInput = document.getElementById('foto');
        // const previewWrapper = document.getElementById('previewWrapper');
        // const fotoPreview = document.getElementById('fotoPreview');

        // fotoInput.addEventListener('change', function() {
        // const file = this.files[0];

        // if (!file) return;

        // if (file.size > 10 * 1024 * 1024) {
        // alert('Ukuran foto maksimal 10MB');
        // removeFoto();
        // return;
        // }
        // const reader = new FileReader();
        // reader.onload = function(e) {
        // fotoPreview.src = e.target.result;
        // previewWrapper.classList.remove('hidden');
        // };
        // reader.readAsDataURL(file);
        // });

        // function removeFoto() {
        // fotoInput.value = '';
        // fotoPreview.src = '';
        // previewWrapper.classList.add('hidden');
        // }







        // document.getElementById("durasi").addEventListener("input", hitungPeriodeSelesai);
        // document.getElementById("periode_mulai").addEventListener("change", hitungPeriodeSelesai);

        // function hitungPeriodeSelesai() {
        //     const periodeMulai = document.getElementById("periode_mulai").value;
        //     const durasi = parseInt(document.getElementById("durasi").value);
        //     const periodeSelesai = document.getElementById("periode_selesai");

        //     if (durasi > 0 && periodeMulai) {
        //         const namaBulan = [
        //             "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        //             "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        //         ];

        //         const [bulanMulai, tahunMulai] = periodeMulai.trim().split("-");
        //         const bulanMulaiAngka = namaBulan.indexOf(bulanMulai) + 1;
        //         const tahunMulaiAngka = parseInt(tahunMulai);

        //         if (bulanMulaiAngka >= 0 && !isNaN(tahunMulaiAngka)) {
        //             const totalBulan = (tahunMulaiAngka * 12 + bulanMulaiAngka) + (durasi + 1);
        //             const tahunSelesai = Math.floor(totalBulan / 12);
        //             const bulanSelesaiAngka = (totalBulan % 12);

        //             periodeSelesai.value = `${namaBulan[bulanSelesaiAngka - 1]} ${tahunSelesai}`;
        //         } else {
        //             periodeSelesai.value = "Format Periode Tidak Valid";
        //         }
        //     } else {
        //         periodeSelesai.value = "";
        //     }
        // }

        // document.querySelector('button[type="submit"]').addEventListener('click', function() {
        //     const tanggal = new Date().toLocaleDateString('id-ID');

        //     document.getElementById('tanggal_daftar').value = tanggal;
        // });

        // document.addEventListener("DOMContentLoaded", function() {
        //     // -------------------------------
        //     // Helper error display functions
        //     // -------------------------------
        //     function showError(input, message) {
        //         removeError(input);
        //         const error = document.createElement("p");
        //         error.className = "text-red-500 text-sm mt-1 error-message";
        //         error.innerText = message;
        //         input.classList.add("border-red-500");
        //         input.parentNode.appendChild(error);
        //     }

        //     function removeError(input) {
        //         const errorMsg = input.parentNode.querySelector(".error-message");
        //         if (errorMsg) errorMsg.remove();
        //         input.classList.remove("border-red-500");
        //     }

        //     // -------------------------------
        //     // File validation
        //     // -------------------------------
        //     function validateFile(input, maxSizeMB, allowedTypes) {
        //         const errorDiv = document.getElementById(input.id + 'Error');

        //         if (errorDiv) {
        //             errorDiv.classList.add('hidden');
        //             errorDiv.textContent = '';
        //         }

        //         const files = input.files;
        //         let valid = true;

        //         for (let i = 0; i < files.length; i++) {
        //             const file = files[i];
        //             const fileType = file.type;
        //             const fileSizeMB = file.size /
        //                 1024 / 1024;
        //             if (!allowedTypes.includes(fileType)) {
        //                 if (errorDiv) {
        //                     errorDiv.textContent = 'Format file tidak sesuai';
        //                     errorDiv.classList.remove('hidden');
        //                 }
        //                 valid = false;
        //                 break;
        //             } else if (fileSizeMB > maxSizeMB) {
        //                 if (errorDiv) {
        //                     errorDiv.textContent = 'Ukuran file terlalu besar';
        //                     errorDiv.classList.remove('hidden');
        //                 }
        //                 valid = false;
        //                 break;
        //             }
        //         }

        //         if (!valid) {
        //             input.value = '';
        //         }
        //     }

        //     // -------------------------------
        //     // Required text/date/number/select fields
        //     // -------------------------------
        //     function validateRequired(input, label) {
        //         removeError(input);
        //         if (!input.value.trim()) {
        //             showError(input, `${label} wajib diisi`);
        //         }
        //     }

        //     // -------------------------------
        //     // Radio validation
        //     // -------------------------------
        //     function validateRadio(name, label) {
        //         const inputs = document.querySelectorAll(`input[name="${name}"]`);
        //         const parent = inputs[0].parentNode.parentNode;
        //         const checked = [...inputs].some(input => input.checked);
        //         parent.querySelectorAll(".error-message").forEach(e => e.remove());

        //         if (!checked) {
        //             const error = document.createElement("p");
        //             error.className = "text-red-500 text-sm mt-1 error-message";
        //             error.innerText = `${label} wajib dipilih`;
        //             parent.appendChild(error);
        //         }
        //     }

        //     // -------------------------------
        //     // Event listeners
        //     // -------------------------------
        //     document.querySelectorAll(
        //         "input[type='text'], input[type='number'], textarea, select, input[type='date']").forEach(
        //         input => {
        //             input.addEventListener("input", () => {
        //                 validateRequired(input, input.labels[0]?.innerText || input.name);
        //             });
        //         });

        //     document.querySelectorAll("input[type='file']").forEach(input => {
        //         input.addEventListener("change", () => {
        //             const id = input.id;
        //             const docTypes = ["application/pdf", "application/msword",
        //                 "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
        //             ];
        //             const imageTypes = ["image/jpeg", "image/png", "image/jpg"];

        //             if (id === "surat_permohonan") {
        //                 validateFile(input, 2, docTypes);
        //             } else if (id === "foto") {
        //                 validateFile(input, 5, imageTypes);
        //             } else {
        //                 validateFile(input, 10, docTypes);
        //             }
        //         });
        //     });

        //     document.querySelectorAll("input[type='radio']").forEach(input => {
        //         input.addEventListener("change", () => {
        //             validateRadio(input.name, input.name.charAt(0).toUpperCase() + input.name.slice(
        //                 1));
        //         });
        //     });

        //     // -------------------------------
        //     // Final form submit check
        //     // -------------------------------
        //     document.querySelector('form').addEventListener("submit", function(e) {
        //         let isValid = true;

        //         document.querySelectorAll(".error-message").forEach(e => e.remove());

        //         this.querySelectorAll(
        //                 "input[type='text'], input[type='number'], textarea, select, input[type='date']")
        //             .forEach(input => {
        //                 if (!input.value.trim()) {
        //                     validateRequired(input, input.labels[0]?.innerText || input.name);
        //                     isValid = false;
        //                 }
        //             });

        //         this.querySelectorAll("input[type='file']").forEach(input => {
        //             if (input.required && !input.files.length) {
        //                 showError(input,
        //                     `File ${input.labels[0]?.innerText || input.name} wajib diunggah`);
        //                 isValid = false;
        //             }
        //         });

        //         validateRadio("jenis_kelamin", "Jenis Kelamin");

        //         if (!isValid) e.preventDefault();
        //     });

        //     // -------------------------------
        //     // Hitung periode selesai otomatis
        //     // -------------------------------
        //     document.getElementById("durasi")?.addEventListener("input", hitungPeriodeSelesai);
        //     document.getElementById("periode_mulai")?.addEventListener("change", hitungPeriodeSelesai);

        //     function hitungPeriodeSelesai() {
        //         const periodeMulai = document.getElementById("periode_mulai").value.trim();
        //         console.log("periodeMulai:", periodeMulai); // <-- log DI DALAM fungsi const
        //         durasi = parseInt(document.getElementById("durasi").value);
        //         const
        //             periodeSelesai = document.getElementById("periode_selesai");
        //         const namaBulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
        //             "September", "Oktober", "November", "Desember"
        //         ];
        //         if (durasi > 0 && periodeMulai) {
        //             const match = periodeMulai.match(/^([A-Za-z]+)\s+(\d{4})$/);

        //             if (!match) {
        //                 console.log("Periode format tidak valid:", periodeMulai);
        //                 periodeSelesai.value = "Format Periode Tidak Valid";
        //                 return;
        //             }

        //             const bulanMulai = match[1].charAt(0).toUpperCase() + match[1].slice(1).toLowerCase();
        //             const tahunMulaiAngka = parseInt(match[2]);
        //             const bulanMulaiAngka = namaBulan.indexOf(bulanMulai);

        //             console.log("Bulan:", bulanMulai, "Tahun:", tahunMulaiAngka);

        //             if (bulanMulaiAngka >= 0 && !isNaN(tahunMulaiAngka)) {
        //                 const tanggalMulai = new Date(tahunMulaiAngka, bulanMulaiAngka, 1);
        //                 tanggalMulai.setMonth(tanggalMulai.getMonth() + durasi - 1);

        //                 const bulanSelesai = namaBulan[tanggalMulai.getMonth()];
        //                 const tahunSelesai = tanggalMulai.getFullYear();

        //                 periodeSelesai.value = `${bulanSelesai} ${tahunSelesai}`;
        //             } else {
        //                 periodeSelesai.value = "Format Periode Tidak Valid";
        //             }
        //         } else {
        //             periodeSelesai.value = "";
        //         }
        //     }

        //     // -------------------------------
        //     // Isi otomatis tanggal daftar
        //     // -------------------------------
        //     document.querySelector('button[type="submit"]')?.addEventListener('click', function() {
        //         const tanggal = new Date().toLocaleDateString('id-ID');
        //         const tanggalField = document.getElementById('tanggal_daftar');
        //         if (tanggalField) tanggalField.value = tanggal;
        //     });
        // });

        // document.addEventListener('DOMContentLoaded', function() {
        //     const periodeMulai = document.getElementById('periode_mulai');
        //     const durasi = document.getElementById('durasi');
        //     const periodeSelesai = document.getElementById('periode_selesai');
        //     const bidangSelect = document.getElementById('bidang');
        //     const warningBidang = document.getElementById('warning_bidang');

        //     function updatePeriodeSelesai() {
        //         const value = periodeMulai.value;
        //         const dur = parseInt(durasi.value);

        //         if (value && dur) {
        //             const [bulanRaw, tahun] = value.split(' ');
        //             const bulan = bulanRaw.charAt(0).toUpperCase() + bulanRaw.slice(1).toLowerCase();
        //             const namaBulan = [
        //                 "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        //                 "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        //             ];
        //             const bulanIndex = namaBulan.indexOf(bulan);
        //             const start = new Date(tahun, bulanIndex, 1);
        //             const selesai = new Date(start);
        //             selesai.setMonth(start.getMonth() + dur - 1);

        //             const options = {
        //                 year: 'numeric',
        //                 month: 'long'
        //             };
        //             periodeSelesai.value = selesai.toLocaleDateString('id-ID', options);
        //         } else {
        //             periodeSelesai.value = '';
        //         }
        //     }

        //     function loadBidang() {
        //         const mulai = periodeMulai.value;
        //         const dur = durasi.value;

        //         bidangSelect.innerHTML = '<option value="">Loading...</option>';
        //         warningBidang.innerHTML = '';

        //         if (mulai && dur) {
        //             const url = `/get-bidang-tersedia?periode_mulai=${encodeURIComponent(mulai)}&durasi=${dur}`;
        //             fetch(url)
        //                 .then(response => response.json())
        //                 .then(data => {
        //                     bidangSelect.innerHTML =
        //                         '<option value="" disabled selected>--- Pilih Bidang ---</option>';
        //                     data.forEach(bid => {
        //                         const option = document.createElement('option');
        //                         option.value = bid.id;
        //                         option.text = bid.nama + (bid.tersedia ? '' : ' (Tidak tersedia)');

        //                         if (!bid.tersedia) {
        //                             option.disabled = true;
        //                             option.title = bid.warning ||
        //                                 'Bidang tidak tersedia untuk periode ini. Silakan pilih periode atau bidang lain.';
        //                         }

        //                         bidangSelect.appendChild(option);
        //                     });
        //                     console.log("Respon dari server:", data);
        //                 });
        //         }
        //     }

        //     periodeMulai.addEventListener('change', () => {
        //         updatePeriodeSelesai();
        //         if (durasi.value) loadBidang();
        //     });

        //     durasi.addEventListener('input', () => {
        //         updatePeriodeSelesai();
        //         if (periodeMulai.value) loadBidang();
        //     });

        //     bidangSelect.addEventListener('change', function() {
        //         const selectedOption = bidangSelect.options[bidangSelect.selectedIndex];
        //         const tersedia = selectedOption.dataset.tersedia === 'true';
        //         const warning = selectedOption.dataset.warning;

        //         warningBidang.innerHTML = '';

        //         if (!tersedia && warning) {
        //             const warn = document.createElement('div');
        //             warn.textContent = `❗ ${warning}`;
        //             warningBidang.appendChild(warn);
        //         }
        //     });
        // });

        // document.getElementById('nim_nisn').addEventListener('input', function() {
        //     const input = this;
        //     const value = input.value.trim();
        //     const nilaiAwal = input.dataset.nilaiAwal;
        //     const errorDiv = document.getElementById('nim_nisnError');

        //     errorDiv.textContent = '';
        //     errorDiv.classList.add('hidden');
        //     input.classList.remove('border-red-500');

        //     if (value === nilaiAwal) {
        //         return;
        //     }

        //     if (value.length > 0) {
        //         fetch(`/check-nim-nisn?nim_nisn=${encodeURIComponent(value)}`)
        //             .then(response => response.json())
        //             .then(data => {
        //                 if (data.exists) {
        //                     errorDiv.textContent = 'NIM/NISN sudah terdaftar';
        //                     errorDiv.classList.remove('hidden');
        //                     input.classList.add('border-red-500');
        //                 }
        //             })
        //             .catch(error => console.error('Error:', error));
        //     }
        // });

        // document.getElementById('nik').addEventListener('input', function() {
        //     const input = this;
        //     const value = input.value.trim();
        //     const errorDiv = document.getElementById('nikError');

        //     if (errorDiv) {
        //         errorDiv.textContent = '';
        //         errorDiv.classList.add('hidden');
        //     }
        //     input.classList.remove('border-red-500');

        //     if (value.length == 16) {
        //         fetch(`/check-nik?nik=${value}`)
        //             .then(response => response.json())
        //             .then(data => {
        //                 if (data.exists) {
        //                     if (errorDiv) {
        //                         errorDiv.textContent = 'NIK sudah terdaftar';
        //                         errorDiv.classList.remove('hidden');
        //                     }
        //                     input.classList.add('border-red-500');
        //                 }
        //             })
        //             .catch(error => console.error('Error:', error));
        //     }
        // });

        // // const btnDaftarUlang = document.getElementById('btnDaftarUlang');
        // // const formPendaftaran = document.getElementById('formPendaftaran');

        // // if (btnDaftarUlang) {
        // // btnDaftarUlang.addEventListener('click', () => {
        // // formPendaftaran.classList.remove('hidden');
        // // window.scrollTo({
        // // top: formPendaftaran.offsetTop - 50,
        // // behavior: 'smooth'
        // // });
        // // });
        // // }

        // // document.addEventListener('DOMContentLoaded', () => {
        // // if (window.location.hash === '#formPendaftaran') {
        // // const form = document.getElementById('formPendaftaran');
        // // if (form) {
        // // form.classList.remove('hidden');
        // // form.scrollIntoView({ behavior: 'smooth' });
        // // }
        // // }
        // // });

        // document.addEventListener('DOMContentLoaded', () => {
        //     if (window.location.search.includes('ulang=ya')) {
        //         const form = document.getElementById('formPendaftaran');
        //         const blokDiterima = document.getElementById('blokDiterima');
        //         if (form) form.classList.remove('hidden');
        //         if (blokDiterima) blokDiterima.classList.add('hidden');
        //         form?.scrollIntoView({
        //             behavior: 'smooth'
        //         });
        //     }
        // });

        // // if (window.location.search.includes('ulang=ya')) {
        // // const form = document.getElementById('formPendaftaran');
        // // const blokDiterima = document.getElementById('blokDiterima');
        // // if (form) form.classList.remove('hidden');
        // // if (blokDiterima) blokDiterima.classList.add('hidden');
        // // }

        // document.getElementById('formPendaftaran').addEventListener('submit', function(e) {
        //     const errorField = document.querySelector('.error-message:not(.hidden)');
        //     if (errorField) {
        //         e.preventDefault();
        //         const input = errorField.closest('div').querySelector('input, select, textarea');
        //         if (input) input.focus();
        //     }
        // });
    </script>
</body>

</html>
