@extends('layout.app')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"> </script>

<nav class="navbar navbar-expand-sm navbar-light bg-faded">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" id="dropdownMenu">
    <span class="navbar-toggler-icon"></span>
  </button>
    <a class="navbar-brand" href="{{ url('/')}}">
        <img src="http://svgur.com/i/3yP.svg" height="30" class="d-inline-block align-top" alt="Logo de Leonart"></img>
    </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        @if (Auth::check())
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ route('home') === request()->getUri() ? 'active' : null }}">
                <a class="nav-link" href="{{route('home')}}">
                   <i class="fa fa-area-chart"></i> @lang("Tableau de bord")
                </a>
            </li>
            <li class="nav-item {{ request()->segment(1) === 'oeuvre' ? 'active' : null }}">
                <a class="nav-link" href="{{route('oeuvre:index')}}">
                    <i class="fa fa-paint-brush"></i> @lang("Oeuvre")
                </a>
            </li>
            <li class="nav-item {{ request()->segment(1) === 'artiste' ? 'active' : null }}">
                <a class="nav-link" href="{{route('artiste:index')}}">
                   <i class="fa fa-user"></i> @lang("Artiste")
                </a>
            </li>
            <li class="nav-item {{ request()->segment(1) === 'type' ? 'active' : null }}">
                <a class="nav-link" href="{{route('type:index')}}">
                    <i class="fa fa-sliders"></i> @lang("Type")
                </a>
            </li>
        </ul>

        @endif
        <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">@lang("Connexion")</a></li>
                    <li><a href="{{ route('register') }}">@lang("S'inscrire")</a></li>
                @else
                    <div class="dropdown show">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                       <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('user:profil:edit') }}" title="@lang('Modifier mon profil')">
                                    <i class="fa fa-user"></i> @lang("Profil")
                                </a>
                                <a class="dropdown-item" href="{{ route('page:index') }}" title="@lang('Accéder au site')">
                                    <i class="fa fa-caret-left"></i> @lang('Retour au site')
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                   <i class="fa fa-sign-out"></i> Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                        </div>
                    </div>
                @endif
            </ul>
    </div>
</nav>
