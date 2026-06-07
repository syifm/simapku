<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAPKU | Wisata Kuliner</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Multi Select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>


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
            width: 1330px;
            border-radius: 7px;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
</head>

<body class="bg-gray-100 text-gray-800">
    @include('layouts.header-wisatawan')
    @include('layouts.sidebar-wisatawan')
    <div class="pt-[10px] pl-28 pr-[25px] pb-[30px]">
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
            <div class="flex-1">
                <div class="mt-4 flex text-2xl justify-center gap-6">
                    <div class="-mt-1.5">
                        <h1 class="font-bold">Tambah Wisata Kuliner</h1>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 mt-6">
                    <form action="{{ route('simpanwisatakuliner') }}" action="post" method="POST"
                        enctype="multipart/form-data">
                        @csrf
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
                                        class="w-full border rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500 ts-dropdown">
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

                            <!-- Fasilitas Wisata Kuliner -->
                            <div>
                                <label class="block text-sm font-medium text-gray-800 mb-1"
                                    for="fasilitas"><span>Fasilitas</span>
                                    <span class="text-red-500 font-bold">*</span></label>
                                {{-- <select id="fasilitas" name="fasilitas[]" multiple class="w-full"> --}}
                                <select id="fasilitas" name="fasilitas[]" multiple="multiple">
                                    {{-- @foreach ($fasilitas as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->nama_fasilitas }}
                                        </option>
                                    @endforeach --}}
                                </select>
                                @error('fasilitas')
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
                                    <button type="button" onclick="removeFoto()"
                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">
                                        ✕
                                    </button>
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
            fetch('/wisatawan/wisata/api/kecamatan')
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

                fetch(`/wisatawan/wisata/api/kelurahan/${districtCode}`)
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

            $(document).ready(function() {

                $('.tags').select2({
                    placeholder: 'select',
                    allowclear: true,
                })

                $("#tags").select2({
                    ajax: {
                        url: "{{ route('get-category') }}",
                        type: "post",
                        delay: 250,
                        dataType: 'json',
                        data: function(params) {
                            return {
                                name: params.term,
                                "_token": "{{ csrf_token() }}"
                            }
                        },

                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        id.item.id,
                                        text: item.title
                                    }
                                })
                            }
                        }
                    }
                })
            })
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
            center: [-6.969054045894555, 110.42432058292049],
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

        // new TomSelect("#fasilitas", {
        //     plugins: ['remove_button'],
        //     create: true
        // });
    </script>
</body>

</html>
