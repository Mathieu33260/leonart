@extends('artiste.artisteLayout')

@section('subtitle', __("Ajout"))

@section('content')

@section('header')
    Ajouter un artiste
@endsection

@include('layout.heading')
<style>
    .imgArtiste{
        margin: 0 auto;
    }
</style>

<div class="container fluid pt-4">
    <div class="row justify-content-md-center">

        {!! Form::open(['route' => 'artiste:store', 'method' => 'post']) !!}

        <div class="row justify-content-md-center">
            <div class="card">
                <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/51136-200.png" alt="Card img" class="imgArtiste" width="100px" height="100px">
                <div class="card-block" style="width: 40rem;">
                    <div class="row justify-content-md-center">
                        <div class="col-xs-10 col-md-6 col-lg-6 text-center">
                            {!! Form::Label('nom', 'Nom de l\'artiste') !!}
                            {!! Form::text('nom', null, array('required' => 'required',
                            'placeholder' => 'Nom',
                             'class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-xs-10 col-md-6 col-lg-6 text-center">
                            {!! Form::Label('prenom', 'Prénom de l\'artiste') !!}
                            {!! Form::text('prenom', null, array('required' => 'required', 'class' => 'form-control',
                            'placeholder' => 'Prénom')) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-10 col-md-6">
                            {!! Form::Label('dateN', 'Date de naissance') !!}
                            {!! Form::date('dateN', null, array('required' => 'required', 'class' => 'form-control')) !!}
                        </div>
                        <div class="col-xs-10 col-md-6">
                            {!! Form::Label('dateM', 'Date de mort') !!}
                            {!! Form::date('dateM', null, array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-xs-12 col-md-6 col-lg-6 text-center mt-4 mb-4">
                            <button type="submit" class="btn btn-success">
                                @lang("Sauvegarder") <span class="glyphicon glyphicon-ok"></span>
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection