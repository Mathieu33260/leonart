@extends('type.typeLayout')

@section('subtitle', __("Ajout"))

@section('content')

@section('header')
    Ajouter un type
@endsection

@include('layout.heading')

<div class="container fluid pt-4">
    <div class="row justify-content-md-center">

        {!! Form::open(['route' => 'type:store', 'method' => 'post'])!!}

        <div class="row justify-content-md-center">
            <div class="card">
                <div class="card-block" style="width: 40rem;">
                    <div class="row justify-content-md-center">
                        <div class="col-8 col-md-6 col-lg-6 text-center">
                            <h6>{!! Form::Label('libelle', 'Libellé du type') !!}</h6>
                            {!! Form::text('libelle', null, array('required' => 'required', 'class' => 'form-control',
                            'placeholder' => 'Libellé')) !!}
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="buttonFix col-8 col-md-6 col-lg-6 text-center mt-4 mb-4">
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