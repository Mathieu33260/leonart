<div id="map" class="col-lg-12" style="min-height: 300px"></div>
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

        /*google.maps.event.addListener(marker, 'dragend', function(marker){
            var latLng = marker.latLng;
            currentLatitude = latLng.lat();
            currentLongitude = latLng.lng();
            $("#posX").val(currentLatitude);
            $("#posY").val(currentLongitude);
        });*/

        google.maps.event.addListener(marker, 'drag', function(marker){
            var latLng = marker.latLng;
            currentLatitude = latLng.lat();
            currentLongitude = latLng.lng();
            $("#posX").val(currentLatitude);
            $("#posY").val(currentLongitude);
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
            }
        }
    });


</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWARvkaDg6P7iC40S1FF3BN3uZVKC1UFU&callback=initMap"
        async defer></script>