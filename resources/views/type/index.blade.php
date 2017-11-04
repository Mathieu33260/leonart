@extends('layout.user')

@section('title', __("Gestion du profil"))

@section('content')
    <div class="container">
        <div class="row">

            <div id="box" class="col-xs-12 col-md-5 col-lg-5 panel panel-default p-3">

            </div>

            <div class="col-xs-12 col-md-5 col-lg-5 panel panel-default p-3 m-3">
                <div class="panel-heading lead">
                    <label>Rechercher un Type
                        <input id="recherche" type="text" onkeyup="getTypes()">
                    </label>
                </div>
                <ul class="right-list">
                    @foreach($types as $type)
                        <li><a href="#" onclick="getAjax({{ $type->id }})">{{ $type->libelle }}</a></li>
                    @endforeach
                </ul>


            </div>


        </div>
    </div>
    <script>
        function getAjax(id){
            $.ajax({
                type:'GET',
                url:'type/showAjax/'+id,
                success:function(data){
                    $('#box').empty();
                    $('#box').append('<h3>Type <a href="/type/'+ data.id +'">'+ data.libelle +'</a></h3>\n' +
                        '                <p>Libelle : ' + data.libelle + '</p>\n' +
                        '                <a href="/type/edit/'+ data.id +'">Modifier</a>\n' +
                        '                <a href="/type/destroy/'+ data.id +'">Supprimer</a>');
                }
            });
        }

        function getTypes(){
            $.ajax({
                type:'GET',
                url:'type/indexAjax/'+$('#recherche').val(),
                success:function(data){
                    $('.right-list').empty();
                    $.each(data, function( index, value ) {
                        $('.right-list').append('<li><a href="#" onclick="getAjax('+ value.id +')">' +
                            ''+ value.libelle +'</a></li>');
                    });

                }
            });
        }
    </script>
@endsection