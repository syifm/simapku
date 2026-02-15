<!DOCTYPE html>
<html lang="en">

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

</html>
