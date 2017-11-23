@extends('layout.user')

@section('title', __("Gestion du profil"))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading lead">
                        {{ $user->name }}
                        <small class="text-muted">(account created {{ $user->created_at->diffForHumans() }})</small>
                    </div>
                    {!! Form::model($user, array('route' => array('user:profil:save'), 'method' => 'patch')) !!}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                {!! Form::Label('name', 'Nom') !!}
                                {!! Form::text('name', $user->name, array('required' => 'required', 'class' => 'form-control')) !!}
                            </div>
                            <div class="col-xs-12 col-md-6">
                                {!! Form::Label('email', 'Adresse e-mail') !!}
                                {!! Form::text('email', $user->email, array('required' => 'required', 'class' => 'form-control')) !!}
                            </div>
                            <div class="col-xs-12 col-md-6">
                                {!! Form::Label('password', 'Mot de passe') !!}
                                {!! Form::password('password', array('class' => 'form-control')) !!}
                            </div>
                            <div class="col-xs-12 col-md-6">
                                {!! Form::Label('password_confirmation', 'Confirmation') !!}
                                {!! Form::password('password_confirmation', array('class' => 'form-control')) !!}
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