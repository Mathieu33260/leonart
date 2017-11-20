@extends('artiste.artisteLayout')

@section('subtitle', __("Modification"))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading lead">
                        {{ $artiste->nom }} {{ $artiste->prenom }}
                    </div>
                    {!! Form::model($artiste, array('route' => array('artiste:update', $artiste->id), 'method' => 'post')) !!}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                {!! Form::Label('nom', 'Nom') !!}
                                {!! Form::text('nom', $artiste->nom, array('required' => 'required', 'class' => 'form-control')) !!}
                            </div>
                            <div class="col-xs-12 col-md-6">
                                {!! Form::Label('prenom', 'Prénom') !!}
                                {!! Form::text('prenom', $artiste->prenom, array('required' => 'required', 'class' => 'form-control')) !!}
                            </div>
                            <div class="col-xs-12 col-md-6">
                                {!! Form::Label('dateN', 'Date de naissance') !!}
                                {!! Form::date('dateN', $artiste->dateN, array('required' => 'required', 'class' => 'form-control')) !!}
                            </div>
                            <div class="col-xs-12 col-md-6">
                                @if($artiste->dateM != null)
                                    {!! Form::Label('dateM', 'Date de mort') !!}
                                    {!! Form::date('dateM', $artiste->dateM, array('required' => 'required', 'class' => 'form-control')) !!}
                                @else
                                    {!! Form::Label('dateM', 'Date de mort') !!}
                                    {!! Form::date('dateM', null, array('class' => 'form-control')) !!}
                                @endif
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
    </div>
@endsection