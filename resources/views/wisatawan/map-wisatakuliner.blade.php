<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Map Wisata Kuliner</title>
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
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-gBdR_gqZTd8B6jz3mVJWI-pqC_jPlAI&libraries=maps,marker&v=weekly&internal_usage_attribution_ids=gmp_git_jsapisamples_v1_web-components&language=in"
        defer></script>
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
