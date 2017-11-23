@extends('artiste.artisteLayout')

@section('subtitle', __("Artiste"))

@section('content')

@section('header') 
Vos Artistes
@endsection

@include('layout.heading')

    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <input class="form-control mr-sm-2" id="recherche" placeholder="Recherche" type="text" onkeyup="getSearch()">
        </form>
        <a href="{{ route('artiste:create') }}"><input type="button" class="btn btn btn-outline-success center-block" value="Ajouter"></a>

    </nav>
    <div class="row">
        <div class=" col-lg-2 right-listA" onscroll="lazyLoad()">
            <div class="dark2">
                <table class="table table-striped table-dark list">
                @foreach($artistes as $artiste)
                    <tr>
                        <td>
                        <a href="#" onclick="getAjax({{ $artiste->id }})">
                            <h4 class="text-light nameO">{{ $artiste->nom }} {{ $artiste->prenom }}</h4>
                        </a>
                        </td>
                    </tr>
                @endforeach
            </table>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="row">
                <div id="box">
                    @if(isset($artiste))
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-12 panel panel-default">
                                <table class="table">
                                    <th><h3>Artiste</h3></th>
                                    <th><h3><a href="{{ route('artiste:show',['id' => $artiste->id]) }}">{{ $artiste->nom }} {{ $artiste->prenom }}</a></h3></th>
                                    <tr>
                                        <td><p>Nom : {{ $artiste->nom }}</p></td>
                                        <td><p>Prénom : {{ $artiste->prenom }}</p></td>
                                        <td><p>Date de naissance : {{ $artiste->dateN }}</p></td>
                                        <td><p>Date de mort : {{ $artiste->dateM }}</p></td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{ route('artiste:edit', ['id' => $artiste->id]) }}"><button type="button" class="btn btn-outline-info">Modifier</button></a></td>
                                        <td><a href="{{ route('artiste:destroy', ['id' => $artiste->id]) }}"><button type="button" class="btn btn-outline-danger" >Supprimer</button></a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    @else
                        Pas d'artistes
                    @endif
                </div>

            </div>
        </div>
    </div>
    <script>

        function getAjax(id){
            $.ajax({
                type:'GET',
                url:'/artiste/'+id,
                success:function(data){
                    $('#box').empty();
                    $('#box').append(data);
                }
            });
        }

        var offset = 5;

        function getSearch(){
            offset = 0;
            $.ajax({
                type:'GET',
                url:'/artiste/indexAjax/'+offset+'/'+$('#recherche').val(),
                success:function(data){
                    $('.list').empty();
                    $.each(data, function( index, value ) {
                        $('.list').append('<tr><td><a href="#" onclick="getAjax('+ value.id +')"><h4 class="text-light nameO">' +
                            ''+ value.nom +' '+ value.prenom +'</h4></a></td></tr>');
                    });
                    offset = offset + 5;
                }
            });
        }

        function lazyLoad() {
            if ($('.right-listA').scrollTop() ===
                document.getElementsByClassName('right-listA')[0].scrollHeight - $('.right-listA').height()) {
                $('.right-listA').append('<img src="{{ asset('/images/ajax-loader.gif') }}" class="loading-indicator"/>');
                $.ajax({
                    type : "GET",
                    url : '/artiste/indexAjax/'+offset+'/'+$('#recherche').val(),
                    success : function (data)
                    {
                        $('.loading-indicator').remove();
                        $.each(data, function( index, value ) {
                            $('.list').append('<tr><td><a href="#" onclick="getAjax('+ value.id +')"><h4 class="text-light nameO">' +
                                ''+ value.nom +' '+ value.prenom +'</h4></a></td></tr>');
                        });
                        offset = offset + 5;
                    }
                });
            }
        }
    </script>
@endsection