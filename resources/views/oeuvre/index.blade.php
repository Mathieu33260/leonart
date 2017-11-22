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
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="row" onscroll="lazyLoad()">
                    @foreach($oeuvres as $oeuvre)
                        <div class="row">
                            <div class="col-lg-7">
                                <img src="{{asset('images/oeuvre1.jpg')}}" alt="">
                            </div>
                            <div class="col-lg-5">
                                <a href="#" onclick="getAjax({{ $oeuvre->id }},{{ $oeuvre->posX }},{{ $oeuvre->posY }})">
                                    <h4 class="text-dark nameO">{{ $oeuvre->nom }}</h4>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>


            </div>
            <div class="col-lg-4">{!! $map !!}</div>
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