<template>
    <div id="map" class="col-lg-12" style="min-height: 300px"></div>

</template>

<script>

    export default {
        props: ['oeuvres'],
        name:'mapHome',
        data() {
            return {
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
                    scrollwheel: false,
                    zoom: 4
                })
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
                });
            }
        }
    }
</script>
