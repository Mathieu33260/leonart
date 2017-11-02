@extends('layout.user')

@section('title', __("Gestion du profil"))

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-md-5 col-lg-5 panel panel-default p-3">

            </div>

            <div class="col-xs-12 col-md-5 col-lg-5 panel panel-default p-3 m-3">
                <ul>
                        @foreach($artistes as $artiste)
                        <li>
                            <a href="{{ route('artiste:show',['id' => $artiste->id]) }}">
                                {{ $artiste->nom }} {{ $artiste->prenom }}
                            </a>
                        </li>
                        @endforeach
                </ul>


            </div>


        </div>
    </div>
@endsection