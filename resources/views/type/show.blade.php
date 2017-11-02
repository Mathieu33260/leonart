@extends('layout.user')

@section('title', __("Gestion du profil"))

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-md-8 col-lg-8 panel panel-default">
                <h3>Type {{ $type->libelle }}</h3>
                <p>Libelle : {{ $type->libelle }}</p>
                <a href="{{ route('type:edit', ['id' => $type->id]) }}">Modifier</a>
                <a href="{{ route('type:destroy', ['id' => $type->id]) }}">Supprimer</a>
            </div>


        </div>
    </div>
@endsection