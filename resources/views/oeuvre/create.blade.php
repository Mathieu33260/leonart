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


            <div class="col-xs-12 col-md-8 col-lg-5">
                {!! Form::open(['route' => 'oeuvre:store', 'method' => 'post']) !!}
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            {!! Form::Label('nom', 'Nom') !!}
                            {!! Form::text('nom', null, array('required' => 'required', 'class' => 'form-control',
                             'placeholder' => 'Nom')) !!}
                        </div>
                        <div class="col-xs-12 col-md-6">
                            {!! Form::Label('modele', 'Modèle') !!}
                            {!! Form::text('modele', null, array('class' => 'form-control',
                            'placeholder' => 'Modèle')) !!}
                        </div>
                        <div class="col-xs-12 col-md-6">
                            {!! Form::Label('idIbeacon', 'Id iBeacon') !!}
                            {!! Form::number('idIbeacon', null, array('required' => 'required','class' => 'form-control',
                            'placeholder' => 'Id iBeacon')) !!}
                        </div>
                        <div class="col-xs-12 col-md-6">
                            {!! Form::Label('posX', 'Latitude') !!}
                            {!! Form::text('posX', null, array('required' => 'required', 'class' => 'form-control',
                            'placeholder' => 'Latitude')) !!}
                        </div>
                        <div class="col-xs-12 col-md-6">
                            {!! Form::Label('posY', 'Longitude') !!}
                            {!! Form::text('posY', null, array('required' => 'required', 'class' => 'form-control',
                            'placeholder' => 'Longitude')) !!}
                        </div>
                        <div class="col-xs-12 col-md-6">
                            {!! Form::Label('audio', 'Audio') !!}
                            {!! Form::text('audio', null, array('class' => 'form-control',
                            'placeholder' => 'Audio')) !!}
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
                {!! Form::close() !!}
            </div>

                <div class="col-xs-12 col-md-8 col-lg-5">
                    <button id="btnDefautMarker" type="button" class="btn btn-success">
                        @lang("Placer un marqueur au centre") <span class="glyphicon glyphicon-ok"></span>
                    </button>
                    {!! $map !!}
                </div>




        </div>
    </div>
@endsection