<div class="panel panel-default">
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            min-height: 300px;
            width: 100%;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
    <div id="map"></div>
    <input id="mapsearch">
    <script>
        var map;
        function initMap() {
            geocoder = new google.maps.Geocoder();
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -34.397, lng: 150.644},
                zoom: 8
            });
        }

        function codeAddress(address) {
            /* Appel au service de geocodage avec l'adresse en paramètre */
            geocoder.geocode({ 'address': address }, function (results, status) {
                /* Si l'adresse a pu être géolocalisée */
                if (status === google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                    /* Affichage du marker */
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location
                    });
                    /* Permet de supprimer le marker précédemment affiché */
                    markers.push(marker);
                    if (markers.length > 1)
                        markers[(i - 1)].setMap(null);
                    i++;
                } else {
                    alert("Le geocodage n\'a pu etre effectue pour la raison suivante: " + status);
                }
            });
        }

        $("#mapsearch").on("input", function () {
            if($("#mapsearch").val().length !== 0)
            {
                codeAddress($("#mapsearch").val());
            }
        });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWARvkaDg6P7iC40S1FF3BN3uZVKC1UFU&callback=initMap"
            async defer></script>
</div>