@extends('artiste.artisteLayout')

@section('subtitle', __("Accueil"))

@section('content')
    <div class="container">
        <div class="row">

            <div id="box" class="col-xs-12 col-md-5 col-lg-5 p-3">

            </div>

            <div class="col-xs-12 col-md-5 col-lg-5 panel panel-default p-3 m-3">
                <div class="panel-heading lead">
                    <label>Rechercher un Artiste
                        <input id="recherche" type="text" onkeyup="getSearch()">
                    </label>
                </div>
                <ul class="right-list" onscroll="lazyLoad()">
                        @foreach($artistes as $artiste)
                        <li>
                            <a href="#" onclick="getAjax({{ $artiste->id }})">
                                {{ $artiste->nom }} {{ $artiste->prenom }}
                            </a>
                        </li>
                        @endforeach
                </ul>


            </div>

            <div class="col-xs-12 col-md-5 col-lg-5">
                <a href="{{ route('artiste:create') }}"><input type="button" class="btn center-block" value="Ajouter"></a>
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

        var offset = 10;

        function getSearch(){
            offset = 0;
            $.ajax({
                type:'GET',
                url:'/artiste/indexAjax/'+offset+'/'+$('#recherche').val(),
                success:function(data){
                    $('.right-list').empty();
                    $.each(data, function( index, value ) {
                        $('.right-list').append('<li><a href="#" onclick="getAjax('+ value.id +')">' +
                            ''+ value.nom +' '+ value.prenom +'</a></li>');
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
                    url : '/artiste/indexAjax/'+offset+'/'+$('#recherche').val(),
                    success : function (data)
                    {
                        $('.loading-indicator').remove();
                        $.each(data, function( index, value ) {
                            $('.right-list').append('<li><a href="#" onclick="getAjax1('+ value.id +')">' +
                                ''+ value.nom +' '+ value.prenom +'</a></li>');
                        });
                        offset = offset + 10;
                    }
                });
            }
        }
    </script>
@endsection