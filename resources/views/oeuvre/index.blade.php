@extends('oeuvre.oeuvreLayout')

@section('subtitle', __("Accueil"))

@section('content')
    <div class="col-md-12 d-flex align-items-center justify-content-md-center" id="banner">
        <h1 class="display-1 text-white">Vos Oeuvres</h1>
    </div>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <input class="form-control mr-sm-2" id="recherche" placeholder="Recherche" type="text" onkeyup="getSearch()">
        </form>
        <a href="{{ route('oeuvre:create') }}"><input type="button" class="btn btn-outline-success center-block" value="Ajouter"></a>

    </nav>
        <div class="row">
            <div class="dark col-lg-3 right-list" onscroll="lazyLoad()">
                    <table class="table table-dark2 list">
                    @foreach($oeuvres as $oeuvre)
                            <tr>
                                <td>
                                    <a href="#" onclick="getAjax({{ $oeuvre->id }},{{ $oeuvre->posX }},{{ $oeuvre->posY }})">
                                        <h4 class="text-light nameO">{{ $oeuvre->nom }}</h4>
                                    </a>
                                </td>
                            </tr>
                    @endforeach
                    </table>
            </div>
            <div></div>
            <div class="col-lg-9">
                <div class="row">
                    <div id="box">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-md-12 col-lg-12 panel panel-default">
                                    <table class="table">
                                        <th> <h3>Oeuvre : {{ $oeuvre->nom }}</h3></th>
                                        <tr>
                                            <td><p>Nom : {{ $oeuvre->nom }}</p></td>
                                            <td>
                                                @if($oeuvre->type != null)
                                                    <p>Type :
                                                        <a href="{{ route('type:show',['id' => $oeuvre->type->id]) }}">
                                                            {{ $oeuvre->type->libelle }}
                                                        </a>
                                                    </p>
                                                @endif
                                            </td>
                                            <td>
                                                @if($oeuvre->artiste != null)
                                                    <p>Artiste :
                                                        <a href="{{ route('artiste:show',['id' => $oeuvre->artiste->id]) }}">
                                                            {{ $oeuvre->artiste->nom }} {{ $oeuvre->artiste->prenom }}
                                                        </a>
                                                    </p>
                                                @endif
                                            </td>
                                            <td><p>Id iBeacon : {{ $oeuvre->idIbeacon }}</p></td>
                                        </tr>
                                        <tr>
                                            <td><p>Latitude : {{ $oeuvre->posX }}</p></td>
                                            <td><p>Longitude : {{ $oeuvre->posY }}</p></td>
                                            <td><p>Audio : {{ $oeuvre->audio }}</p></td>
                                            <td><p>User : {{ $oeuvre->user->name }}</p></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td><a href="{{ route('oeuvre:edit', ['id' => $oeuvre->id]) }}"><button type="button" class="btn btn-outline-info">Modifier</button></a></td>
                                            <td><a href="{{ route('oeuvre:destroy', ['id' => $oeuvre->id]) }}"><button type="button" class="btn btn-outline-danger" >Supprimer</button></a></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class=" col-lg-6">{!! $map !!}</div>
                    <div class=" col-lg-6">
                        <h1>Image et 3D</h1>
                    </div>
                </div>
            </div>


        </div>

    <script>


        function getAjax(id,lat,long){
            centerMap(lat,long);
            $.ajax({
                type:'GET',
                url:'/oeuvre/'+id,
                success:function(data){
                    $('#box').empty();
                    $('#box').append(data);
                }
            });
        }

        var offset = 10;

        function getSearch(){
            offset = 0;
            $.ajax({
                type:'GET',
                url:'/oeuvre/indexAjax/'+offset+'/'+$('#recherche').val(),
                success:function(data){
                    $('.list').empty();
                    deleteAllMarker();
                    $.each(data, function( index, value ) {
                        var pos = {lat: value.posX, lng: value.posY};
                        placeMarker(pos,map);
                        $('.list').append('<tr><td><a href="#" onclick="getAjax('+ value.id +','+value.posX+','+value.posY+')"><h4 class="text-light nameO">' +
                            ''+ value.nom +'</h4></a></td></tr>');
                    });
                    offset = offset + 10;
                }
            });
        }

        function lazyLoad() {
            if ($('.right-list').scrollTop() ===
                document.getElementsByClassName('right-list')[0].scrollHeight - $('.right-list').height()) {
                $('.right-list').append('<img src="{{ asset('/images/ajax-loader.gif') }}" class="loading-indicator"/>');
                $.ajax({
                    type : "GET",
                    url : '/oeuvre/indexAjax/'+offset+'/'+$('#recherche').val(),
                    success : function (data)
                    {
                        $('.loading-indicator').remove();
                        $.each(data, function( index, value ) {
                            var pos = {lat: value.posX, lng: value.posY};
                            placeMarker(pos,map);
                            $('.right-list').append('<tr><td><a href="#" onclick="getAjax('+ value.id +','+value.posX+','+value.posY+')">' +
                                ''+ value.nom +'</a></td></tr>');
                        });
                        offset = offset + 10;
                    }
                });
            }
        }
    </script>
@endsection