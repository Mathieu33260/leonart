@extends('layout.app')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="http://mrdoob.github.com/three.js/build/three.min.js"></script>

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
            <li class="nav-item dropdown {{ request()->segment(1) === 'oeuvre' ? 'active' : null }}">
                <a class="nav-link" data-toggle="dropdown" href="{{route('oeuvre:index')}}">
                    <i class="fa fa-paint-brush"></i> @lang("Oeuvre")
                </a>
                <div class="dropdown-menu">
                    <a class="nav-link dropdown-item" href="{{route('oeuvre:index')}}">
                    @lang("Mes oeuvres")
                </a>
                <a class="nav-link dropdown-item" href="{{route('oeuvre:create')}}">
                    @lang("Ajouter une oeuvre")
                </a>
            </div>
            </li>
            <li class="nav-item dropdown {{ request()->segment(1) === 'artiste' ? 'active' : null }}">
                <a class="nav-link" data-toggle="dropdown" href="{{route('artiste:index')}}">
                   <i class="fa fa-user"></i> @lang("Artiste")
                </a>
                <div class="dropdown-menu">
                    <a class="nav-link dropdown-item" href="{{route('artiste:index')}}">
                    @lang("Mes artistes")
                </a>
                <a class="nav-link dropdown-item" href="{{route('artiste:create')}}">
                    @lang("Ajouter un artiste")
                </a>
            </div>
            </li>
            <li class="nav-item dropdown {{ request()->segment(1) === 'type' ? 'active' : null }}">
                <a class="nav-link" data-toggle="dropdown" href="{{route('type:index')}}">
                    <i class="fa fa-sliders"></i> @lang("Type")
                </a>
                <div class="dropdown-menu">
                    <a class="nav-link dropdown-item" href="{{route('type:index')}}">
                    @lang("Mes types")
                </a>
                <a class="nav-link dropdown-item" href="{{route('type:create')}}">
                    @lang("Ajouter un type")
                </a>
            </div>
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