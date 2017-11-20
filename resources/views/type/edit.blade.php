@extends('type.typeLayout')

@section('subtitle', __("Modification"))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading lead">
                        {{ $type->libelle }}
                    </div>
                    {!! Form::model($type, array('route' => array('type:update', $type->id), 'method' => 'post')) !!}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                {!! Form::Label('libelle', 'Libelle') !!}
                                {!! Form::text('libelle', $type->libelle, array('required' => 'required', 'class' => 'form-control')) !!}
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