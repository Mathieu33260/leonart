<template>

    <div class="container">
        <div class="row">

            <div id="box" class="col-xs-12 col-md-5 col-lg-4">

            </div>

            <div class="col-lg-4">
                <div id="map" class="col-lg-12" style="min-height: 300px"></div>
            </div>

            <div class="col-lg-3">
                <div class="panel-heading lead">
                    <label>Rechercher une Oeuvre
                        <input id="recherche" type="text" v-on:keyup="getSearch()">
                    </label>
                </div>
                <ul class="right-list" v-on:scroll="lazyLoad()">
                    <li v-for="oeuvre in oeuvres">
                        <a href="#" v-on:click="getAjax(oeuvre.id,oeuvre.posX,oeuvre.posY)">
                            {{ oeuvre.nom }}
                        </a>
                    </li>
                </ul>


            </div>

            <div class="col-xs-12 col-md-5 col-lg-5">
                <a href="/oeuvre/create"><input type="button" class="btn center-block" value="Ajouter"></a>
            </div>


        </div>
    </div>

</template>

<script>

    export default {
        props: ['oeuvres'],
        name:'indexoeuvre',
        data() {
            return {
                map: null,
                geocoder: null,
                markers: [],
                center: {lat: 44.791213, lng: -0.608717},
                offset: 10
            }
        },
        mounted: function() {
            this.initMap();
        },
        methods: {
            initMap: function() {
                var geocoder = new google.maps.Geocoder();
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
                this.geocoder = geocoder;
            },
            placeMarker: function (position,id) {
                var map = this.map;
                var infowindow = new google.maps.InfoWindow({});
                var marker = new google.maps.Marker({
                    position: position,
                    map: map
                });
                map.panTo(position);
                marker.addListener('click', function() {
                    var lethis = this;
                    $.ajax({
                        type:'GET',
                        url:'/oeuvre/'+id,
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
                var map = this.map;
                var latlng = {lat: parseFloat(lat), lng: parseFloat(long)};
                this.geocoder.geocode({ 'location': latlng }, function (results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        map.setCenter(results[0].geometry.location);
                    } else {
                        console.log("Le geocodage n\'a pu etre effectue pour la raison suivante: " + status);
                    }
                });
            },
            getAjax: function (id, lat, long) {
                this.centerMap(lat,long);
                $.ajax({
                    type:'GET',
                    url:'/oeuvre/'+id,
                    success:function(data){
                        $('#box').empty();
                        $('#box').append(data);
                    }
                });
            },
            getSearch: function () {
                this.offset = 0;
                var lethis = this;
                $('.right-list').empty();
                $('.right-list').append('Chargement');
                $.ajax({
                    type:'GET',
                    url:'/oeuvre/indexAjax/'+lethis.offset+'/'+$('#recherche').val(),
                    success:function(data){
                        $('.right-list').empty();
                        lethis.deleteAllMarker();
                        $.each(data, function( index, value ) {
                            var pos = {lat: value.posX, lng: value.posY};
                            lethis.placeMarker(pos,value.id);
                            $('.right-list').append('<li><a href="#" v-on:click="getAjax('+ value.id +','+value.posX+','+value.posY+')">' +
                                ''+ value.nom +'</a></li>');
                        });
                        lethis.offset = lethis.offset + 10;
                    }
                });
            },
            lazyLoad: function () {
                var lethis = this;
                if ($('.right-list').scrollTop() ===
                    document.getElementsByClassName('right-list')[0].scrollHeight - $('.right-list').height()) {

                    $.ajax({
                        type : "GET",
                        url : '/oeuvre/indexAjax/'+lethis.offset+'/'+$('#recherche').val(),
                        success : function (data)
                        {
                            $('.loading-indicator').remove();
                            $.each(data, function( index, value ) {
                                var pos = {lat: value.posX, lng: value.posY};
                                lethis.placeMarker(pos,value.id);
                                $('.right-list').append('<li><a href="#" v-on:click="getAjax('+ value.id +','+value.posX+','+value.posY+')">' +
                                    ''+ value.nom +'</a></li>');
                            });
                            lethis.offset = lethis.offset + 10;
                        }
                    });
                }
            }
        }
    }
</script>
