@extends('layout.user')

@section('title', __("Gestion du profil"))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading lead">
                        {{ $user->name }}
                        <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                    </div>
                    {!! BootForm::open()->action(route('user:profil:save'))->patch() !!}
                    {!! BootForm::bind($user) !!}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                {!! BootForm::text(__("Nom"), 'name')->required() !!}
                            </div>
                            <div class="col-xs-12 col-md-6">
                                {!! BootForm::email(__("Adresse e-mail"), 'email')->required() !!}
                            </div>
                            <div class="col-xs-12 col-md-6">
                                {!! BootForm::password(__("Mot de passe"), 'password') !!}
                            </div>
                            <div class="col-xs-12 col-md-6">
                                {!! BootForm::password(__("Confirmation"), 'password_confirmation') !!}
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