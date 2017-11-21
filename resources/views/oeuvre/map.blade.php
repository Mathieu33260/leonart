<div class="panel panel-default">

    <div id="map" class="col-lg-12" style="min-height: 300px"></div>
    <script>
        var map;
        var centre = {lat: 44.791213, lng: -0.608717};
        var markertab = [];
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

            contentString += "<br><a href='{{ route('oeuvre:show',array('id'=>$oeuvre->id)) }}'>Consulter l'oeuvre</a>";

            var infowindow = new google.maps.InfoWindow({});

            var marker = new google.maps.Marker({
                position: {lat: {{ $oeuvre->posX }}, lng: {{ $oeuvre->posY }}},
                map: map,
                contentString: contentString
            });
            marker.addListener('click', function() {
                /*infowindow.setContent(this.contentString);
                infowindow.open(map, this);*/
                var lethis = this;
                $.ajax({
                    type:'GET',
                    url:'/oeuvre/'+{{$oeuvre->id}},
                    success:function(data){
                        infowindow.setContent(data);
                        infowindow.open(map, lethis);
                    }
                });
            });
            markertab.push(marker);
            /*marker.addListener('mouseout', function() {
                infowindow.close(map, this);
            });*/
            @endforeach


        }

        function centerMap(lat,long) {
            var latlng = {lat: parseFloat(lat), lng: parseFloat(long)};
            geocoder.geocode({ 'location': latlng }, function (results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                } else {
                    console.log("Le geocodage n\'a pu etre effectue pour la raison suivante: " + status);
                }
            });
        }

        function placeMarker(position, map) {
            var infowindow = new google.maps.InfoWindow({});
            var marker = new google.maps.Marker({
                position: position,
                map: map
            });
            map.panTo(position);
            marker.addListener('click', function() {
                /*infowindow.setContent(this.contentString);
                infowindow.open(map, this);*/
                var lethis = this;
                $.ajax({
                    type:'GET',
                    url:'/oeuvre/'+{{$oeuvre->id}},
                    success:function(data){
                        infowindow.setContent(data);
                        infowindow.open(map, lethis);
                    }
                });
            });
            markertab.push(marker);
        }

        function deleteAllMarker() {
            $.each(markertab, function() {
                this.setMap(null);
            });
        }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWARvkaDg6P7iC40S1FF3BN3uZVKC1UFU&callback=initMap"
            async defer></script>
</div>