<button id="btnDefautMarker" type="button" class="btn btn-outline-success mb-4 pull-left">
    @lang("Placer un marqueur")
</button>
<div id="map" class="col-lg-12 mb-4" style="min-height: 600px"></div>


<script>
    var map;
    var centre = {lat: 44.791213, lng: -0.608717};
    var markertab = [];
    function initMap() {

        geocoder = new google.maps.Geocoder();
        map = new google.maps.Map(document.getElementById('map'), {
            center: centre,
            zoom: 10
        });

    }

    function centerMap(lat,long) {
        var latlng = {lat: parseFloat(lat), lng: parseFloat(long)};
        geocoder.geocode({ 'location': latlng }, function (results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                centre = latlng;
            } else {
                console.log("Le geocodage n\'a pu etre effectue pour la raison suivante: " + status);
            }
        });
    }

    function placeMarker(position, map) {

        var marker = new google.maps.Marker({
            position: position,
            map: map,
            draggable:true
        });
        map.panTo(position);

        google.maps.event.addListener(marker, 'drag', function(marker){
            var latLng = marker.latLng;
            currentLatitude = latLng.lat();
            currentLongitude = latLng.lng();
            $("#posX").val(currentLatitude);
            $("#posY").val(currentLongitude);
            centre = {lat: parseFloat(latLng.lat()), lng: parseFloat(latLng.lng())};
        });

        markertab.push(marker);
    }

    function deleteAllMarker() {
        $.each(markertab, function() {
            this.setMap(null);
        });
    }


    $("#posX").on("input", function () {
        if($("#posX").val().length !== 0 && $("#posY").val().length !== 0)
        {
            var posX = $("#posX").val().replace(",", ".");
            var posY = $("#posY").val().replace(",", ".");
            if($.isNumeric(posX) && $.isNumeric(posY))
            {
                deleteAllMarker();
                var pos = {lat: parseFloat(posX), lng: parseFloat(posY)};
                placeMarker(pos,map);
                centre = pos;
            }
        }
    });

    $("#posY").on("input", function () {
        if($("#posX").val().length !== 0 && $("#posY").val().length !== 0)
        {
            var posX = $("#posX").val().replace(",", ".");
            var posY = $("#posY").val().replace(",", ".");
            if($.isNumeric(posX) && $.isNumeric(posY))
            {
                deleteAllMarker();
                var pos = {lat: parseFloat(posX), lng: parseFloat(posY)};
                placeMarker(pos,map);
                centre = pos;
            }
        }
    });

    $("#btnDefautMarker").click(function () {
        deleteAllMarker();
        placeMarker(map.getCenter(),map);
        $("#posX").val(markertab[0].position.lat());
        $("#posY").val(markertab[0].position.lng());
    });


</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWARvkaDg6P7iC40S1FF3BN3uZVKC1UFU&callback=initMap"
        async defer></script>