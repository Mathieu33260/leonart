@extends('layout.app')

@section('title', __("Contact"))

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
            <div class="col-xs-12 col-md-8 col-lg-8 panel panel-default">
                {!! BootForm::open()->action(route('page:contactPost'))->post() !!}
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            {!! BootForm::text(__("Nom"), 'nom')->required() !!}
                        </div>
                        <div class="col-xs-12 col-md-6">
                            {!! BootForm::text(__("Email"), 'email')->required() !!}
                        </div>
                        <div class="col-xs-12 col-md-6">
                            {!! BootForm::text(__("Texte"), 'texte')->required() !!}
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-right">
                    <button type="submit" class="btn btn-success">
                        @lang("Envoyer") <span class="glyphicon glyphicon-ok"></span>
                    </button>
                </div>
                {!! BootForm::close() !!}
            </div>


        </div>
    </div>
@endsection