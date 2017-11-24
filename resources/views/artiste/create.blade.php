@extends('artiste.artisteLayout')

@section('subtitle', __("Ajout"))

@section('content')

@section('header') 
Ajouter un artiste
@endsection

@include('layout.heading')
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-md-8 col-lg-8 panel panel-default">
                {!! Form::open(['route' => 'artiste:store', 'method' => 'post']) !!}
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            {!! Form::Label('nom', 'Nom') !!}
                            {!! Form::text('nom', null, array('required' => 'required', 'class' => 'form-control')) !!}
                        </div>
                        <div class="col-xs-12 col-md-6">
                            {!! Form::Label('prenom', 'Prénom') !!}
                            {!! Form::text('prenom', null, array('required' => 'required', 'class' => 'form-control')) !!}
                        </div>
                        <div class="col-xs-12 col-md-6">
                            {!! Form::Label('dateN', 'Date de naissance') !!}
                            {!! Form::date('dateN', null, array('required' => 'required', 'class' => 'form-control')) !!}
                        </div>
                        <div class="col-xs-12 col-md-6">
                            {!! Form::Label('dateM', 'Date de mort') !!}
                            {!! Form::date('dateM', null, array('class' => 'form-control')) !!}
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-right">
                    <button type="submit" class="btn btn-success">
                        @lang("Sauvegarder") <span class="glyphicon glyphicon-ok"></span>
                    </button>
                </div>
                {!! Form::close() !!}
            </div>


        </div>
    </div>
@endsection