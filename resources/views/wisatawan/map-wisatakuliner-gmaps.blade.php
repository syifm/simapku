<!DOCTYPE html>
{{-- <html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Map Wisata Kuliner</title>
    <style>
        #map {
            height: 100vh;
            width: 100%;
        }
    </style>
</head>

<body>
    <div id="map"></div>

    <script>
        function initMap() {
            const ny = {
                lat: 40.7128,
                lng: -74.0060
            };

            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 5,
                center: ny
            })

            new google.maps.Marker({
                position: ny,
                map: ny,
                title: "New York City !!!"
            })
        }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_CM3lH19159L5LAd8GJoK9pwb5raOiFk=&callback=initMap"
        type="text/javascript"></script>
</body>

</html> --}}

{{-- <html lang="en"> --}}

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Map Wisata Kuliner</title>
    {{-- <style>
        #map {
            height: 100vh;
            width: 100%;
        }
    </style> --}}

    {{-- <head>
    <title>Add a Map with Markers using HTML</title> --}}
    <style>
        gmp-map {
            height: 100%;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-gBdR_gqZTd8B6jz3mVJWI-pqC_jPlAI&libraries=maps,marker&v=weekly&internal_usage_attribution_ids=gmp_git_jsapisamples_v1_web-components"
        defer></script>
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADTN5C7v__Ok0Z2gETuYxRwbWGJxvADYE8&callback=initMap"
        async defer></script> --}}
    <script>
        function initMap() {
            const ny = {
                lat: 40.7128,
                lng: -74.0060
            };

            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 5,
                center: ny
            })

            new google.maps.Marker({
                position: ny,
                map: ny,
                title: "New York City !!!"
            })
        }
    </script>
</head>

<body>
    <gmp-map center="41.027748173921374, -92.41852445367961" zoom="13" map-id="DEMO_MAP_ID">
        <gmp-advanced-marker position="41.027748173921374, -92.41852445367961" title="Ottumwa, IA"></gmp-advanced-marker>
    </gmp-map>
</body>

</html>
