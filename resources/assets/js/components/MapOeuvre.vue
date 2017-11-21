<template>
    <div id="map" class="col-lg-12" style="min-height: 300px"></div>

</template>

<script>

    export default {
        props: ['oeuvres'],
        name:'mapHome',
        data() {
            return {
                map: null,
                markers: [],
                center: {lat: 44.791213, lng: -0.608717}
            }
        },
        mounted: function() {
            this.initMap();
        },
        methods: {
            initMap: function() {
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: this.center,
                    zoom: 4
                });
                var tab = this.markers;
                this.oeuvres.forEach(function (value,index,array) {
                    var centre = {lat: value.posX, lng: value.posY };
                    //this.markers.push(centre);
                    var marker = new google.maps.Marker({
                        position: centre,
                        map: map,
                        label: ""+value.id+""
                    });
                    var infowindow = new google.maps.InfoWindow({});
                    marker.addListener('click', function() {
                        var lethis = this;
                        $.ajax({
                            type:'GET',
                            url:'/oeuvre/'+value.id,
                            success:function(data){
                                infowindow.setContent(data);
                                infowindow.open(map, lethis);
                            }
                        });
                    });
                    tab.push(marker);
                });
                this.markers = tab;
                this.map = map;
            },
            placeMarker: function (position) {
                console.log(position);
                var map = this.map;
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
                        url:'/oeuvre/'+loeuvre.id,
                    success:function(data){
                        infowindow.setContent(data);
                        infowindow.open(map, lethis);
                    }
                });
                });
                this.markers.push(marker);
            },
            deleteAllMarker: function () {
                $.each(this.markers, function() {
                    this.setMap(null);
                });
            },
            centerMap: function (lat,long) {
                var latlng = {lat: parseFloat(lat), lng: parseFloat(long)};
                geocoder.geocode({ 'location': latlng }, function (results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        map.setCenter(results[0].geometry.location);
                    } else {
                        console.log("Le geocodage n\'a pu etre effectue pour la raison suivante: " + status);
                    }
                });
            }
        }
    }
</script>
