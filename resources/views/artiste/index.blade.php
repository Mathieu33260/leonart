@extends('layout.user')

@section('title', __("Gestion du profil"))

@section('content')
    <div class="container">
        <div class="row">

            <div id="box" class="col-xs-12 col-md-5 col-lg-5 panel panel-default p-3">

            </div>

            <div class="col-xs-12 col-md-5 col-lg-5 panel panel-default p-3 m-3">
                <ul>
                        @foreach($artistes as $artiste)
                        <li>
                            <a href="#" onclick="getAjax({{ $artiste->id }})">
                                {{ $artiste->nom }} {{ $artiste->prenom }}
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
                url:'artiste/showAjax/'+id,
                success:function(data){
                    $('#box').empty();
                    var dateMort = "";
                    if(data.dateM !== null)
                    {
                        dateMort = data.dateM;
                    }
                    $('#box').append('<h3>Artiste <a href="/artiste/'+ data.id +'">'+ data.nom + ' '+ data.prenom +'</a></h3>\n' +
                        '                <p>Nom : '+ data.nom +'</p>\n' +
                        '                <p>Prénom : '+ data.prenom +'</p>\n' +
                        '                <p>Date de naissance : '+ data.dateN +'</p>\n' +
                        '                <p>Date de mort : '+ dateMort +'</p>\n' +
                        '                <a href="/artiste/edit/'+ data.id +'">Modifier</a>\n' +
                        '                <a href="/artiste/destroy/'+ data.id +'">Supprimer</a>\n');
                }
            });
        }
    </script>
@endsection