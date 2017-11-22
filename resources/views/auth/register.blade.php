@extends('layout.navbarFront')
@section('title', __("S'enregistrer"))
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <h2 class="text-dark text-center col-lg-12 mt-4 mb-4" >S'enregistrer</h2>
  </div>
  <div class="row justify-content-center">
    <div class="col-xs-12 col-md-9 col-lg-9 panel panel-default ">
      <form class="form-horizontal" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}
        <div class="panel-body">
          <div class="row justify-content-center">
            <div class="col-xs-12 col-md-7 ">
              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="control-label">Nom</label>
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                @if ($errors->has('name'))
                <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="col-xs-12 col-md-7">
              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="control-label">Adresse mail</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                  <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="col-xs-12 col-md-7">
              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="control-label">Mot de passe</label>
                <input id="password" type="password" class="form-control" name="password" required>
                @if ($errors->has('password'))
                <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="col-xs-12 col-md-7">
              <div class="form-group">
                <label for="password-confirm" class="control-label">Confirmation du mot de passe</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
              </div>
            </div>
            <div class="col-xs-12 col-md-7">
              <div class="form-group">
                <button type="submit" class="btn btn-primary">
                S'enregistrer
                </button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
