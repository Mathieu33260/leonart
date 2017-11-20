@extends('oeuvre.oeuvreLayout')

@section('subtitle', __("Ajout"))

@section('content')
    <div class="container">
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="col-xs-12 col-md-8 col-lg-8 panel panel-default">
                {!! BootForm::open()->action(route('oeuvre:store'))->patch() !!}
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            {!! BootForm::text(__("Nom"), 'nom')->required() !!}
                        </div>
                        <div class="col-xs-12 col-md-6">
                            {!! BootForm::text(__("Modèle"), 'modele') !!}
                        </div>
                        <div class="col-xs-12 col-md-6">
                            {!! Form::Label('idIbeacon', 'Id iBeacon') !!}
                            {!! Form::number('idIbeacon', null, array('required' => 'required','class' => 'form-control')) !!}
                        </div>
                        <div class="col-xs-12 col-md-6">
                            {!! Form::Label('posX', 'Latitude') !!}
                            {!! Form::number('posX', null, array('required' => 'required', 'class' => 'form-control', 'step' => '0.000001')) !!}
                        </div>
                        <div class="col-xs-12 col-md-6">
                            {!! Form::Label('posY', 'Longitude') !!}
                            {!! Form::number('posY', null, array('required' => 'required', 'class' => 'form-control', 'step' => '0.000001')) !!}
                        </div>
                        <div class="col-xs-12 col-md-6">
                            {!! BootForm::text(__("Audio"), 'audio'); !!}
                        </div>
                        <div class="col-xs-12 col-md-6">
                            {!! Form::Label('typeId', 'Type') !!}
                            {!! Form::select('typeId',array(null => 'Sélectionnez un type') + $types, null,  array('class' => 'form-control')) !!}

                        </div>
                        <div class="col-xs-12 col-md-6">
                            {!! Form::Label('artisteId', 'Artiste') !!}
                            {!! Form::select('artisteId', array(null => 'Sélectionnez un artiste') + $artistes, null,  array('class' => 'form-control')) !!}

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