<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Map Wisata Kuliner</title>
    <style>
        #map {
            height: 400px;
            width: 400px;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
</head>

<body>
    <div class="bg-gray-200 rounded-lg shadow-md p-6 mt-14">
        <form action="{{ route('store') }}" method="post">
            @csrf
            <div class="mapform">
                <div class="row">
                    <div class="col-5">
                        <input type="text" class="form-control" placeholder="lat" name="lat" id="latitude">
                    </div>
                    <div class="col-5">
                        <input type="text" class="form-control" placeholder="lng" name="lng" id="longitude">
                    </div>
                </div>

                {{-- <div id="map" style="height:400px; width: 800px;" class="my-3"></div> --}}

                <input type="submit" class="btn btn-primary">
            </div>

            {{-- <div id="map">
            </div> --}}
        </form>

        <div class="bg-gray-300 rounded-lg shadow-md p-6 mt-14">
            <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- <p class="text-red-500 text-sm font-bold text-right">* Seluruh Isian Wajib Diisi</p1> --}}
                <div class="w-full mx-auto space-y-6">
                    <!-- Nama Wisata Kuliner -->
                    <div>
                        <label class="block text-sm font-medium text-gray-800 mb-1" for="nama"><span>Nama</span>
                            <span class="text-red-500 font-bold">*</span></label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required
                            class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <!-- Kecamatan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-800 mb-1"
                                for="kecamatan"><span>Kecamatan</span>
                                <span class="text-red-500 font-bold">*</span></label></label>
                            <input type="text" id="kecamatan" name="kecamatan" value="{{ old('kecamatan') }}"
                                required
                                class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>


                        <!-- Kelurahan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-800 mb-1"
                                for="kelurahan"><span>Kelurahan</span>
                                <span class="text-red-500 font-bold">*</span></label></label>
                            <input type="text" id="kelurahan" name="kelurahan" value="{{ old('kelurahan') }}"
                                required
                                class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label class="block text-sm font-medium text-gray-800 mb-1" for="alamat"><span>Alamat</span>
                            <span class="text-red-500 font-bold">*</span></label>
                        <textarea id="alamat" name="alamat" rows="4"
                            class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('alamat') }}</textarea>
                    </div>

                    <!-- Nomor Telepon -->
                    <div>
                        <label class="block text-sm font-medium text-gray-800 mb-1" for="no_telp"><span>Nomor
                                Telepon</span>
                            <span class="text-red-500 font-bold">*</span></label>
                        <input type="text" id="no_telp" name="no_telp" value="{{ old('no_telp') }}" required
                            type="text" pattern="\d{10,15}" minlength="10" maxlength="15"
                            class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-800 mb-1" for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label class="block text-sm font-medium text-gray-800 mb-1"
                            for="deskripsi"><span>Deskripsi</span>
                            <span class="text-red-500 font-bold">*</span></label>
                        <textarea id="deskripsi" name="deskripsi" rows="4"
                            class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('deskripsi') }}</textarea>
                    </div>

                    <!-- Foto Wisata Kuliner -->
                    {{-- <div>
                                <label class="block text-sm font-medium text-gray-800 mb-1" for="foto">
                                    <span>Foto</span>
                                    <span class="text-red-500 font-bold">*</span></label>
                                <div class="file-input-wrapper">
                                    <input type="file" id="foto" name="foto" accept="image/*" required>
                                </div>
                                <div id="fotoError" class="text-red-500 text-sm mt-1 hidden"></div>
                                <div class="mt-2">
                                    <p class="text-xs text-gray-600">Format: JPG, JPEG, PNG | Max: 5MB</p>
                                </div>
                            </div> --}}

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
                            <input type="number"
                                class="form-control w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                name="lat" id="latitude" value="{{ old('latitude') }}">
                        </div>
                        <div>
                            <!-- Longitude -->
                            <label class="block text-sm font-medium text-gray-800 mb-1"
                                for="longitude"><span>Longitude</span>
                                <span class="text-red-500 font-bold">*</span></label></label>
                            <input type="number"
                                class="form-control w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                name="lng" id="longitude" value="{{ old('longitude') }}">
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
                        <input type="hidden" id="tanggal_daftar" name="tanggal_daftar">
                    </div>
                </div>
            </form>
        </div>

    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
    <script>
        // var map = L.map('map').setView([-7.0270284616964656, 110.32846300591821], 13);
        // L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        //     maxZoom: 19,
        //     attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        // }).addTo(map);

        // // var marker = L.marker([-7.0270284616964656, 110.32846300591821]).addTo(map);
        // var marker = new L.marker([-7.0270284616964656, 110.32846300591821], {
        //     draggable: true,
        //     // autoPan: true
        // }).addTo(map);

        // google.maps.event.addListener(marker, 'position_changed',
        //     function() {
        //         let lat = marker.position.lat()
        //         let lng = marker.position.lng()
        //         $('#lat').val(lat)
        //         $('#lng').val(lng)
        //     })
        // var marker = (L.marker([-7.0270284616964656, 110.32846300591821], {
        //     draggable: true
        // }));
        // var marker = new L.marker([lat, lon], {
        //     draggable: true
        // }).addTo(map);

        // marker.on("drag", function(e) {
        //     var marker = e.target;
        //     var position = marker.getLatLng();
        //     map.panTo(new L.LatLng(position.lat, position.lng));
        // });

        // var circle = L.circle([-7.0270284616964656, 110.32846300591821], {
        //     color: 'red',
        //     fillColor: '#f03',
        //     fillOpacity: 0.5,
        //     radius: 500
        // }).addTo(map);

        // var polygon = L.polygon([
        //     [-7.0270284616964656, 110.32846300591821],
        //     [-7.0270284616964656, 110.32846300591821],
        //     [-7.0270284616964656, 110.32846300591821]
        // ]).addTo(map);

        // marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();
        // // circle.bindPopup("I am a circle.");
        // polygon.bindPopup("I am a polygon.");

        // var popup = L.popup()
        //     .setLatLng([-7.0270284616964656, 110.32846300591821])
        //     .setContent("I am a standalone popup.")
        //     .openOn(map);

        // function onMapClick(e) {
        //     alert("You clicked the map at " + e.latlng);
        // }

        // map.on('click', onMapClick);

        // var popup = L.popup();

        // function onMapClick(e) {
        //     popup
        //         .setLatLng(e.latlng)
        //         .setContent("You clicked the map at " + e.latlng.toString())
        //         .openOn(map);
        // }

        // map.on('click', onMapClick);
        // var map = L.map('map').setView([-7.0270284616964656, 110.32846300591821], 13);
        // L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        //     maxZoom: 19,
        //     attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        // }).addTo(map);
        // map.on('click', (event) => {
        //     L.marker(event.latLng.lat, event.latLng.lng).addTo(map);
        // })


        // let mapOptions = {
        //     center: [51.958, 9.141],
        //     zoom: 10
        // }

        // let map = new L.map('map', mapOptions);

        // let layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
        // map.addLayer(layer);
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

        //     L.Routing.control({
        //         waypoints: [
        //             L.latlng(-6.996418149883837, 110.41534564234345),
        //             L.latlng(-6.961944043665627, 110.38600824501671),
        //         ]
        //     }).addTo(map);
        // })





        // let mapOptions = {
        //     center: [-6.99, 110.41],
        //     zoom: 13
        // }

        // let map = new L.map('map', mapOptions);

        // let layer = new L.TileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
        // map.addLayer(layer);

        // let marker = null;
        // let routingControl = null;
        // let userLatLng = null;

        // // ambil lokasi user
        // navigator.geolocation.getCurrentPosition((position) => {
        //     userLatLng = L.latLng(position.coords.latitude, position.coords.longitude);

        //     // marker lokasi user
        //     L.marker(userLatLng).addTo(map).bindPopup("Lokasi Kamu").openPopup();

        //     map.setView(userLatLng, 14);
        // });

        // // klik map buat pilih tujuan
        // map.on('click', (event) => {

        //     if (marker !== null) {
        //         map.removeLayer(marker);
        //     }

        //     if (routingControl !== null) {
        //         map.removeControl(routingControl);
        //     }

        //     marker = L.marker([event.latlng.lat, event.latlng.lng], {
        //         draggable: true
        //     }).addTo(map);

        //     document.getElementById('latitude').value = event.latlng.lat;
        //     document.getElementById('longitude').value = event.latlng.lng;

        //     // buat routing
        //     if (userLatLng) {
        //         routingControl = L.Routing.control({
        //             waypoints: [
        //                 userLatLng,
        //                 L.latLng(event.latlng.lat, event.latlng.lng)
        //             ],
        //             routeWhileDragging: true
        //         }).addTo(map);
        //     }

        //     // update saat marker digeser
        //     marker.on('drag', function(e) {
        //         let latlng = e.target.getLatLng();

        //         document.getElementById('latitude').value = latlng.lat;
        //         document.getElementById('longitude').value = latlng.lng;

        //         if (routingControl) {
        //             routingControl.setWaypoints([
        //                 userLatLng,
        //                 latlng
        //             ]);
        //         }
        //     });

        // });



        let mapOptions = {
            center: [-6.99, 110.41],
            zoom: 13
        }

        let map = new L.map('map', mapOptions);

        let layer = new L.TileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
        map.addLayer(layer);

        let routingControl = null;

        // koordinat tujuan (fix)
        let destination = L.latLng(-6.996418149883837, 110.41534564234345);

        // ambil lokasi user
        navigator.geolocation.getCurrentPosition((position) => {
            let userLatLng = L.latLng(position.coords.latitude, position.coords.longitude);

            // marker lokasi user
            L.marker(userLatLng).addTo(map).bindPopup("Lokasi Kamu").openPopup();

            // marker tujuan
            L.marker(destination).addTo(map).bindPopup("Tujuan");

            map.setView(userLatLng, 14);

            // routing dari user ke tujuan
            routingControl = L.Routing.control({
                waypoints: [
                    userLatLng,
                    destination
                ],
                routeWhileDragging: false,

                lineOptions: {
                    styles: [{
                        color: 'red',
                        weight: 6
                    }]
                }

            }).addTo(map);
        });
    </script>

    {{-- <script>
        // let map;

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: -34.397,
                    lng: 150.644
                },
                zoom: 8,
                scrollwheel: true,
            });

            const uluru = {
                lat: -34.397,
                lng: 150.644
            };
            let marker = new google.maps.Marker({
                position: uluru,
                map: map,
                draggable: true
            });

            google.maps.event.addListener(marker, 'position_changed',
                function() {
                    let lat = marker.position.lat()
                    let lng = marker.position.lng()
                    $('#lat').val(lat)
                    $('#lng').val(lng)
                })

            google.maps.event.addListener(map, 'click',
                function(event) {
                    pos = event.latLng
                    marker.setPosition(pos)
                })
        }
    </script> --}}
</body>

</html>
