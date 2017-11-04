@extends('layout.user')

@section('title', __("Gestion du profil"))

@section('content')
    <div class="container">
        <div class="row">

            <div id="box" class="col-xs-12 col-md-5 col-lg-5 panel panel-default p-3">

            </div>

            <div class="col-xs-12 col-md-5 col-lg-5 panel panel-default p-3 m-3">
                <div class="panel-heading lead">
                    <label>Rechercher une Oeuvre
                        <input id="recherche" type="text" onkeyup="getTypes()">
                    </label>
                </div>
                <ul class="right-list">
                        @foreach($oeuvres as $oeuvre)
                        <li>
                            <a href="#" onclick="getAjax({{ $oeuvre->id }})">
                                {{ $oeuvre->nom }}
                            </a>
                        </li>
                        @endforeach
                </ul>


            </div>


        </div>
    </div>
    <script>
        function getAjax(id){
            $.ajax({
                type:'GET',
                url:'oeuvre/showAjax/'+id,
                success:function(data){
                    $('#box').empty();
                    var modele = "";
                    var audio = "";
                    if(data.oeuvre.modele !== null)
                    {
                        modele = data.oeuvre.modele;
                    }
                    if(data.oeuvre.audio !== null)
                    {
                        audio = data.oeuvre.audio;
                    }
                    $('#box').append('<h3>Oeuvre '+ data.oeuvre.nom +'</h3>\n' +
                        '                <p>Nom : '+ data.oeuvre.nom +'</p>\n' +
                        '                <p>Modèle : '+ modele +'</p>\n' +
                        '                <p>Id iBeacon : '+ data.oeuvre.idIbeacon +'</p>\n' +
                        '                <p>Latitude : '+ data.oeuvre.posX +'</p>\n' +
                        '                <p>Longitude : '+ data.oeuvre.posY +'</p>\n' +
                        '                <p>Audio : '+ audio +'</p>');
                    if(data.type !== null)
                    {
                        $('#box').append('<p>Type :\n' +
                            '                    <a href="/type/'+ data.type.id +'">\n' +
                            '                        '+ data.type.libelle +'\n' +
                            '                    </a>\n' +
                            '                </p>');
                    }
                    if(data.artiste !== null)
                    {
                        $('#box').append('<p>Artiste :\n' +
                            '                    <a href="/artiste/'+ data.artiste.id +'">\n' +
                            '                        '+ data.artiste.nom +' '+ data.artiste.prenom +'\n' +
                            '                    </a>\n' +
                            '                </p>');
                    }
                    $('#box').append('<p>User : '+ data.user.name +'</p>\n' +
                        '                <a href="/oeuvre/edit/'+ data.oeuvre.id +'">Modifier</a>\n' +
                        '                <a href="/oeuvre/destroy/'+ data.oeuvre.id +'">Supprimer</a>');
                }
            });
        }

        function getTypes(){
            $.ajax({
                type:'GET',
                url:'oeuvre/indexAjax/'+$('#recherche').val(),
                success:function(data){
                    $('.right-list').empty();
                    $.each(data, function( index, value ) {
                        $('.right-list').append('<li><a href="#" onclick="getAjax('+ value.id +')">' +
                            ''+ value.nom +'</a></li>');
                    });

                }
            });
        }
    </script>
@endsection