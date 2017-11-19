@extends('oeuvre.oeuvreLayout')

@section('subtitle', __("Modification"))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
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
                                {!! BootForm::text(__("Modèle"), 'modele') !!}
                            </div>
                            <div class="col-xs-12 col-md-6">
                                {!! Form::Label('idIbeacon', 'Id iBeacon') !!}
                                {!! Form::number('idIbeacon',$oeuvre->idIbeacon , array('required' => 'required', 'class' => 'form-control')) !!}
                            </div>
                            <div class="col-xs-12 col-md-6">
                                {!! Form::Label('posX', 'Latitude') !!}
                                {!! Form::number('posX',$oeuvre->posX, array('required' => 'required', 'class' => 'form-control', 'step' => '0.000001')) !!}
                            </div>
                            <div class="col-xs-12 col-md-6">
                                {!! Form::Label('posY', 'Longitude') !!}
                                {!! Form::number('posY',$oeuvre->posY ,array('required' => 'required', 'class' => 'form-control', 'step' => '0.000001')) !!}
                            </div>
                            <div class="col-xs-12 col-md-6">
                                {!! BootForm::text(__("Audio"), 'audio') !!}
                            </div>
                            @if($oeuvre->type != null)
                                <div class="col-xs-12 col-md-6">
                                    {!! Form::Label('typeId', 'Type') !!}
                                    {!! Form::select('typeId',array(null => 'Aucun') + $types, $oeuvre->type->id, array('class' => 'form-control') ) !!}

                                </div>
                            @else
                                <div class="col-xs-12 col-md-6">
                                    {!! Form::Label('typeId', 'Type') !!}
                                    {!! Form::select('typeId',array(null => 'Aucun') + $types, null, array('class' => 'form-control') ) !!}

                                </div>
                            @endif

                            @if($oeuvre->artiste != null)
                            <div class="col-xs-12 col-md-6">
                                {!! Form::Label('artisteId', 'Artiste') !!}
                                {!! Form::select('artisteId',array(null => 'Aucun') + $artistes, $oeuvre->artiste->id, array('class' => 'form-control') ) !!}

                            </div>
                            @else
                                <div class="col-xs-12 col-md-6">
                                    {!! Form::Label('artisteId', 'Artiste') !!}
                                    {!! Form::select('artisteId',array(null => 'Aucun') + $artistes, null, array('class' => 'form-control') ) !!}

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