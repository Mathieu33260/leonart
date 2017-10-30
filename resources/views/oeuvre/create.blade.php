@extends('layouts.app')

@section('title', __("Gestion du profil"))

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-md-8 col-lg-8 panel panel-default">
                {!! BootForm::open()->action(route('oeuvre:store'))->patch() !!}
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
                            {!! Form::number(__("Latitude"), 'posX', array('required' => 'required', 'step' => '0.00000001')) !!}
                        </div>
                        <div class="col-xs-12 col-md-6">
                            {!! Form::Label('Longitude', 'Longitude :') !!}
                            {!! Form::number(__("Longitude"), 'posY', array('required' => 'required', 'step' => '0.00000001')) !!}
                        </div>
                        <div class="col-xs-12 col-md-6">
                            {!! BootForm::text(__("Audio"), 'audio')->defaultValue(""); !!}
                        </div>
                        <div class="col-xs-12 col-md-6">
                            {!! Form::select('types', $types, null, ['required']) !!}

                        </div>
                        <div class="col-xs-12 col-md-6">
                            {!! Form::select('artistes', array(null => 'Please select one option') + $artistes, null) !!}

                        </div>
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
@endsection