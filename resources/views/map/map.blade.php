<div class="panel panel-default">

    <div id="map" class="col-lg-12" style="min-height: 300px"></div>
    <input id="mapsearch">
    <script>
        var map;
        function initMap() {

            @if(isset($oeuvres) && !empty($oeuvres))
                    @foreach($oeuvres as $oeuvre)
                        var centre = {lat: {{ $oeuvre->posX }}, lng: {{ $oeuvre->posY }} };
                    @endforeach
            @else
                    var centre = {lat: -34.397, lng: 150.644};
            @endif

            geocoder = new google.maps.Geocoder();
            map = new google.maps.Map(document.getElementById('map'), {
                center: centre,
                zoom: 10
            });

            @foreach($oeuvres as $oeuvre)

            var contentString = "{{ $oeuvre->nom }}, ";
                    @if($oeuvre->type != null)
                        contentString  += "{{ $oeuvre->type->libelle }}, ";
                    @endif

                    @if($oeuvre->artiste != null)
                        contentString  += "{{ $oeuvre->artiste->nom }} {{ $oeuvre->artiste->prenom }}, ";
                    @endif

            contentString += "{{ $oeuvre->idIbeacon }}, {{ $oeuvre->posX }}, {{ $oeuvre->posY }}";

            var infowindow = new google.maps.InfoWindow({});

                var marker = new google.maps.Marker({
                    position: {lat: {{ $oeuvre->posX }}, lng: {{ $oeuvre->posY }}},
                    map: map,
                    label: '{{ $oeuvre->id }}',
                    title: '{{$oeuvre->nom}}',
                    contentString: contentString
                });
            marker.addListener('click', function() {
                infowindow.setContent(this.contentString);
                infowindow.open(map, this);
            });
            @endforeach


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