<template>

    <div class="container">
        <div class="row">


            <div class="col-xs-12 col-md-8 col-lg-5">
                <form method="post" v-bind:action="route" id="leform">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom" required/>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <label for="modele">Modèle</label>
                            <input type="text" id="modele" name="modele" class="form-control" placeholder="Modèle"/>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <label for="idIbeacon">Id iBeacon</label>
                            <input type="number" id="idIbeacon" name="idIbeacon" class="form-control" placeholder="Id iBeacon" required/>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <label for="posX">Latitude</label>
                            <input v-on:input="moveLatLng()" type="text" id="posX" name="posX" class="form-control" placeholder="Latitude" required/>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <label for="posY">Longitude</label>
                            <input v-on:input="moveLatLng()" type="text" id="posY" name="posY" class="form-control" placeholder="Longitude" required/>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <label for="audio">Audio</label>
                            <input type="text" id="audio" name="audio" class="form-control" placeholder="Audio"/>
                        </div>
                        <div class="col-xs-12 col-md-6">
                                <label for="typeId">Type</label>
                                <select id="typeId" class="form-control" form="leform">
                                    <option v-for="type in types" v-bind:value="type.id">
                                        {{ type.libelle }}
                                    </option>
                                </select>
                            </div>
                                <div class="col-xs-12 col-md-6">
                                    <label for="artisteId">Artiste</label>
                                    <select id="artisteId" class="form-control" form="leform">
                                        <option v-bind="artiste_selected">Sélectionner un artiste</option>
                                        <option v-for="artiste in artistes" v-bind:value="artiste.id">
                                            {{ artiste.nom }} {{ artiste.prenom }}
                                        </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-right">
                    <button type="submit" class="btn btn-success">
                        Sauvegarder <span class="glyphicon glyphicon-ok"></span>
                    </button>
                </div>
                </form>
            </div>

            <div class="col-xs-12 col-md-8 col-lg-5">
                <div id="map" class="col-lg-12" style="min-height: 300px"></div>
            </div>


        </div>
    </div>

</template>

<script>

    export default {
        props: ['types', 'artistes', 'route'],
        name:'createoeuvre',
        data() {
            return {
                map: null,
                geocoder: null,
                markers: [],
                center: {lat: 44.791213, lng: -0.608717},
                offset: 10,
                type_selected: null,
                artiste_selected: null,
                route: this.route
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
                this.map = map;
                this.geocoder = geocoder;
            },
            placeMarker: function (position,id) {
                var map = this.map;
                var infowindow = new google.maps.InfoWindow({});
                var marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    draggable: true
                });
                map.panTo(position);

                google.maps.event.addListener(marker, 'drag', function(marker){
                    var latLng = marker.latLng;
                    currentLatitude = latLng.lat();
                    currentLongitude = latLng.lng();
                    $("#posX").val(currentLatitude);
                    $("#posY").val(currentLongitude);
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
            },
            moveLatLng: function () {
                var lethis = this;
                if($("#posX").val().length !== 0 && $("#posY").val().length !== 0)
                {
                    var posX = $("#posX").val().replace(",", ".");
                    var posY = $("#posY").val().replace(",", ".");
                    if($.isNumeric(posX) && $.isNumeric(posY))
                    {
                        lethis.deleteAllMarker();
                        var pos = {lat: parseFloat(posX), lng: parseFloat(posY)};
                        lethis.placeMarker(pos,map);
                    }
                }
            }
        }
    }
</script>
