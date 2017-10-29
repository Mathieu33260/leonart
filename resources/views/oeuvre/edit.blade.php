@extends('layouts.app')

@section('title', __("Gestion du profil"))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading lead">
                        {{ $oeuvre->nom }}
                    </div>
                    {!! BootForm::open()->action(route('oeuvre:update', ['id' => $oeuvre->id]))->patch() !!}
                    {!! BootForm::bind($oeuvre) !!}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                {!! BootForm::text(__("Nom"), 'nom')->required() !!}
                            </div>
                            <div class="col-xs-12 col-md-6">
                                {!! BootForm::text(__("Modèle"), 'modele')->required() !!}
                            </div>
                            <div class="col-xs-12 col-md-6">
                                {!! Form::Label('IdiBeacon', 'Id iBeacon :') !!}
                                {!! Form::number(__("IdiBeacon"), 'idIbeacon', array('required' => 'required')) !!}
                            </div>
                            <div class="col-xs-12 col-md-6">
                                {!! Form::Label('Latitude', 'Latitude :') !!}
                                {!! Form::number(__("Latitude"), 'posX', array('required' => 'required')) !!}
                            </div>
                            <div class="col-xs-12 col-md-6">
                                {!! Form::Label('Longitude', 'Longitude :') !!}
                                {!! Form::number(__("Longitude"), 'posY', array('required' => 'required')) !!}
                            </div>
                            <div class="col-xs-12 col-md-6">
                                {!! BootForm::text(__("Audio"), 'audio') !!}
                            </div>
                            <div class="col-xs-12 col-md-6">
                                {!! Form::select('types', $types, $oeuvre->type->id ) !!}

                            </div>
                            @if($oeuvre->artiste != null)
                            <div class="col-xs-12 col-md-6">
                                {!! Form::select('artistes', $artistes, $oeuvre->artiste->id ) !!}

                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="panel-footer text-right">
                        <button type="submit" class="btn btn-success">
                            @lang("Sauvegarder") <span class="glyphicon glyphicon-ok"></span>
                        </button>
                    </div>
                    {!! BootForm::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection