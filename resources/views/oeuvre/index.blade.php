@extends('oeuvre.oeuvreLayout')

@section('subtitle', __("Accueil"))

@section('content')
    <div class="container">
        <div class="row">



            <div id="box" class="col-xs-12 col-md-5 col-lg-4">

            </div>

            <div class="col-lg-4">{!! $map !!}</div>

            <div class="col-lg-3">
                <div class="panel-heading lead">
                    <label>Rechercher une Oeuvre
                        <input id="recherche" type="text" onkeyup="getSearch()">
                    </label>
                </div>
                <ul class="right-list" onscroll="lazyLoad()">
                        @foreach($oeuvres as $oeuvre)
                        <li>
                            <a href="#" onclick="getAjax({{ $oeuvre->id }},{{ $oeuvre->posX }},{{ $oeuvre->posY }})">
                                {{ $oeuvre->nom }}
                            </a>
                        </li>
                        @endforeach
                </ul>


            </div>

            <div class="col-xs-12 col-md-5 col-lg-5">
                <a href="{{ route('oeuvre:create') }}"><input type="button" class="btn center-block" value="Ajouter"></a>
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
                    $('.right-list').empty();
                    deleteAllMarker();
                    $.each(data, function( index, value ) {
                        var pos = {lat: value.posX, lng: value.posY};
                        placeMarker(pos,map);
                        $('.right-list').append('<li><a href="#" onclick="getAjax('+ value.id +','+value.posX+','+value.posY+')">' +
                            ''+ value.nom +'</a></li>');
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
                            $('.right-list').append('<li><a href="#" onclick="getAjax('+ value.id +','+value.posX+','+value.posY+')">' +
                                ''+ value.nom +'</a></li>');
                        });
                        offset = offset + 10;
                    }
                });
            }
        }
    </script>
@endsection