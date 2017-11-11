@extends('artiste.artisteLayout')

@section('subtitle', __($artiste->nom." ".$artiste->prenom))

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-md-8 col-lg-8 panel panel-default">
                <h3>Artiste {{ $artiste->nom }} {{ $artiste->prenom }}</h3>
                <p>Nom : {{ $artiste->nom }}</p>
                <p>Prénom : {{ $artiste->prenom }}</p>
                <p>Date de naissance : {{ $artiste->dateN }}</p>
                <p>Date de mort : {{ $artiste->dateM }}</p>
                <a href="{{ route('artiste:edit', ['id' => $artiste->id]) }}">Modifier</a>
                <a href="{{ route('artiste:destroy', ['id' => $artiste->id]) }}">Supprimer</a>
            </div>


        </div>
    </div>
@endsection






