@extends('layout.navbarFront')

@section('title', __("Connexion"))
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <h2 class="text-dark text-center col-lg-12 mt-4 mb-4">Se connecter&nbsp;</h2>
  </div>
    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-9 col-lg-9 panel panel-default ">
          <form class="form-horizontal" method="POST" action="{{ route('login') }}">
              {{ csrf_field() }}
            <div class="panel-body">
                <div class="row justify-content-center">
                    <div class="col-xs-12 col-md-8 ">
                      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="control-label">Adresse mail</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                          <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                        @endif
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-8">
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
                    <div class="col-xs-12 col-md-8">
                      <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-8">
                      <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Se connecter
                            </button>

                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                    </div>
                </div>
            </div>
          </form>
        </div>


    </div>
</div>
@endsection
