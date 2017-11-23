@extends('oeuvre.oeuvreLayout')

@section('subtitle', __($oeuvre->nom))

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-md-8 col-lg-12">
                <h3>Oeuvre {{ $oeuvre->nom }}</h3>
                <p>Nom : {{ $oeuvre->nom }}</p>
                <p>Modèle : {{ $oeuvre->modele }}</p>
                <p>Id iBeacon : {{ $oeuvre->idIbeacon }}</p>
                <p>Latitude : {{ $oeuvre->posX }}</p>
                <p>Longitude : {{ $oeuvre->posY }}</p>
                <p>Audio : {{ $oeuvre->audio }}</p>
                @if($oeuvre->type != null)
                <p>Type :
                    <a href="{{ route('type:show',['id' => $oeuvre->type->id]) }}">
                        {{ $oeuvre->type->libelle }}
                    </a>
                </p>
                @endif
                @if($oeuvre->artiste != null)
                <p>Artiste :
                    <a href="{{ route('artiste:show',['id' => $oeuvre->artiste->id]) }}">
                        {{ $oeuvre->artiste->nom }} {{ $oeuvre->artiste->prenom }}
                    </a>
                </p>
                @endif
                <p>User : {{ $oeuvre->user->name }}</p>
                <p>Description : {{ $oeuvre->description }}</p>
                <img height="300px" src="/storage/uploads/images/{{ $oeuvre->image }}"/>
                <a href="{{ route('oeuvre:edit', ['id' => $oeuvre->id]) }}">Modifier</a>
                <a href="{{ route('oeuvre:destroy', ['id' => $oeuvre->id]) }}">Supprimer</a>
            </div>


        </div>
    </div>
@endsection