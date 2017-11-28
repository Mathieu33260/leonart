@extends('type.typeLayout')

@section('subtitle', __("Ajout"))

@section('content')

@section('header')
    Ajouter un type
@endsection

@include('layout.heading')
<div class="container">
    <div class="row">

        <div class="col-xs-12 col-md-8 col-lg-8 panel panel-default">
            {!! Form::open(['route' => 'type:store', 'method' => 'post'])!!}
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        {!! Form::Label('libelle', 'Libelle') !!}
                        {!! Form::text('libelle', null, array('required' => 'required', 'class' => 'form-control')) !!}
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