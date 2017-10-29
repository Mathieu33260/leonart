@extends('layouts.app')

@section('title', __("Gestion du profil"))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading lead">
                        {{ $type->libelle }}
                    </div>
                    {!! BootForm::open()->action(route('type:update', ['id' => $type->id]))->patch() !!}
                    {!! BootForm::bind($type) !!}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                {!! BootForm::text(__("Libelle"), 'libelle')->required() !!}
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
    </div>
@endsection