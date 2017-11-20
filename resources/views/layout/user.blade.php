@extends('layout.app')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            @if (Auth::check())
                <ul class="nav navbar-nav">
                    <li class="{{ route('home') === request()->getUri() ? 'active' : null }}">
                        <a href="{{ route('home') }}">
                            @lang("Tableau de bord")
                        </a>
                    </li>
                    <li class="{{ request()->segment(1) === 'oeuvre' ? 'active' : null }}">
                        <a href="{{ route('oeuvre:index') }}">
                            @lang("Oeuvre")
                        </a>
                    </li>
                    <li class="{{ request()->segment(1) === 'artiste' ? 'active' : null }}">
                        <a href="{{ route('artiste:index') }}">
                            @lang("Artiste")
                        </a>
                    </li>
                    <li class="{{ request()->segment(1) === 'type' ? 'active' : null }}">
                        <a href="{{ route('type:index') }}">
                            @lang("Type")
                        </a>
                    </li>
                </ul>
            @endif
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">@lang("Connexion")</a></li>
                    <li><a href="{{ route('register') }}">@lang("S'inscrire")</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="{{ route('user:profil:edit') === request()->getUri() ? 'active' : null }}">
                                <a href="{{ route('user:profil:edit') }}" title="@lang("Modifier mon profil")">
                                    <span class="glyphicon glyphicon-user"></span> @lang("Profil")
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('page:index') }}" title="@lang("Accéder au site")">
                                    <span class="glyphicon glyphicon-log-out"></span> @lang("Retour au site")
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
