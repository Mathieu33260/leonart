<div class="panel panel-default">

    <div id="map" class="col-lg-12" style="min-height: 300px"></div>
    <input id="mapsearch" placeholder="ville">
    <input id="latitude" placeholder="latitude">
    <input id="longitude" placeholder="longitude">
    <script>
        var map;
        var centre = {lat: 44.791213, lng: -0.608717};
        function initMap() {


            @if(isset($oeuvres) && !empty($oeuvres))
                    @foreach($oeuvres as $oeuvre)
                        centre = {lat: {{ $oeuvre->posX }}, lng: {{ $oeuvre->posY }} };
                    @endforeach
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
            marker.addListener('mouseover', function() {
                infowindow.setContent(this.contentString);
                infowindow.open(map, this);
            });

            marker.addListener('mouseout', function() {
                infowindow.close(map, this);
            });
            @endforeach


        }

        function codeAddress(address) {
            geocoder.geocode({ 'address': address }, function (results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                } else {
                    alert("Le geocodage n\'a pu etre effectue pour la raison suivante: " + status);
                }
            });
        }

        function codePos(lat,long) {
            var latlng = {lat: parseFloat(lat), lng: parseFloat(long)};
            geocoder.geocode({ 'location': latlng }, function (results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
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

        $("#latitude").on("input", function () {
            if($("#latitude").val().length !== 0 && $("#longitude").val().length !== 0)
            {
                codePos($("#latitude").val(),$("#longitude").val());
            }
        });

        $("#longitude").on("input", function () {
            if($("#latitude").val().length !== 0 && $("#longitude").val().length !== 0)
            {
                codePos($("#latitude").val(),$("#longitude").val());
            }
        });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWARvkaDg6P7iC40S1FF3BN3uZVKC1UFU&callback=initMap"
            async defer></script>
</div>