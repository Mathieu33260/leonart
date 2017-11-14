@extends('layout.app')

@section('title', __("Contact"))

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-white">
  <a class="navbar-brand" href="{{ route('page:index') }}"><img src="{{ asset('/images/leonart.svg') }}" alt="{{ __("Logo Leonart") }}" ></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
    <div class="navbar-nav links ">
      <a class="p-3 font-weight-bold nav-item nav-link" href="#">Login</a>
      <a class="p-3 font-weight-bold nav-item nav-link" href="#">Register</a>
    </div>
  </div>
</nav>
    <div class="container">
      <div class="row justify-content-center">
        <h2 class="text-dark text-center col-lg-12 ">Contactez-nous !</h2>
      </div>
        <div class="row justify-content-center">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-xs-12 col-md-8 col-lg-8 panel panel-default ">
                {!! BootForm::open()->action(route('page:contactPost'))->post() !!}
                <div class="panel-body ">
                    <div class="row ">
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
