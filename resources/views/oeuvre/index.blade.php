@extends('oeuvre.oeuvreLayout')

@section('subtitle', __("Accueil"))

@section('content')

    <div id="app">
        <indexoeuvre :oeuvres="{{ $oeuvres }}"></indexoeuvre>
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWARvkaDg6P7iC40S1FF3BN3uZVKC1UFU"
            async defer></script>

@endsection