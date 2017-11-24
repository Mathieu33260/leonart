@extends('oeuvre.oeuvreLayout')

@section('subtitle', __("Ajout"))

@section('content')

@section('header') 
Ajouter une oeuvre
@endsection

@include('layout.heading')
<style type="text/css">
    input {font-family:FontAwesome, sans-serif;}
</style>
    <div class="container-fluid pt-4 ">
        <div class="row justify-content-md-center">
            
            <div class="col-md-5">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                {!! Form::open(['route' => 'oeuvre:store', 'files' => true, 'method' => 'post']) !!}
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-6 col-lg-12">
                         {!! Form::Label('nom', 'Nom') !!}
                            {!! Form::text('nom', null, array('required' => 'required', 'class' => 'form-control',
                             'placeholder' => '&#xf007; Nom')) !!}
                        </div>
                        <div class="col-xs-12 col-md-6">
                            {!! Form::Label('posX', 'Latitude') !!}
                            {!! Form::text('posX', null, array('required' => 'required', 'class' => 'form-control',
                            'placeholder' => '&#xf041; Latitude')) !!}
                        </div>
                        <div class="col-xs-12 col-md-6">
                            {!! Form::Label('posY', 'Longitude') !!}
                            {!! Form::text('posY', null, array('required' => 'required', 'class' => 'form-control',
                            'placeholder' => '&#xf041; Longitude')) !!}
                        </div>
                        <div class="col-xs-12 col-md-6">
                            {!! Form::Label('idIbeacon', 'Id iBeacon') !!}
                            {!! Form::number('idIbeacon', null, array('required' => 'required','class' => 'form-control',
                            'placeholder' => '&#xf129; Id iBeacon')) !!}
                        </div>
                        <div class="col-xs-12 col-md-6">
                            {!! Form::Label('audio', 'Audio') !!}
                            {!! Form::file('audio', array('class' => 'form-control',
                            'accept' => 'image/*')) !!}
                        </div>
                        <div class="col-xs-12 col-md-6">
                            {!! Form::Label('typeId', 'Type') !!}
                            {!! Form::select('typeId',array(null => 'Sélectionnez un type') + $types, null,  array('class' => 'form-control')) !!}

                        </div>
                        <div class="col-xs-12 col-md-6">
                            {!! Form::Label('artisteId', 'Artiste') !!}
                            {!! Form::select('artisteId', array(null => 'Sélectionnez un artiste') + $artistes, null,  array('class' => 'form-control')) !!}
                        </div>
                        <div class="col-xs-12 col-md-6 col-lg-12">
                            {!! Form::Label('description', 'Description') !!}
                            {!! Form::textarea('description', null, array('class' => 'form-control',
                            'placeholder' => 'Description')) !!}
                        </div>
                        <div class="col-xs-12 col-md-6 col-lg-7">
                            {!! Form::Label('image', 'Image') !!}
                            {!! Form::file('image', array('class' => 'form-control')) !!}
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

                <div class="col-md-6">  
                    {!! $map !!}
                </div>
        </div>
    </div>

@endsection