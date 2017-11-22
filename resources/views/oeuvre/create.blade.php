@extends('oeuvre.oeuvreLayout')

@section('subtitle', __("Ajout"))

@section('content')
    <div id="app">
        <createoeuvre :types="{{ $types }}" :artistes="{{ $artistes }}" route="{{ route('oeuvre:store') }}"></createoeuvre>
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWARvkaDg6P7iC40S1FF3BN3uZVKC1UFU"
            async defer></script>
@endsection