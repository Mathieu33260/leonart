@extends('layouts.app')

@section('title', __("Gestion du profil"))

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-md-5 col-lg-5 panel panel-default p-3">

            </div>

            <div class="col-xs-12 col-md-5 col-lg-5 panel panel-default p-3 m-3">
                <ul>
                        @foreach($oeuvres as $oeuvre)
                        <li>
                            <a href="{{ route('oeuvre:show',['id' => $oeuvre->id]) }}">
                                {{ $oeuvre->nom }}
                            </a>
                        </li>
                        @endforeach
                </ul>


            </div>


        </div>
    </div>
@endsection