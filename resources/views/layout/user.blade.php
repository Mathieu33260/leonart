<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    {{-- Basic metas --}}
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="language" content="{{ app()->getLocale() }}" />
    <meta name="copyright" content="{{ url('/') }}" />
    <meta name="author" content="Leon-art.fr" />

    {{-- CSRF meta --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Navbar color --}}
    <meta name="theme-color" content="#2c3e50" />
    <meta name="msapplication-navbutton-color" content="#2c3e50" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#2c3e50" />

    {{-- Page title --}}
    <title>{{ config('app.name') }}: @yield('title') | @lang("User")</title>

    {{-- Favicons --}}
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">

    {{-- Stylesheets --}}
    @section('style')
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @show
</head>
<body>
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
                    <li class="{{ request()->segment(2) === 'Oeuvre' ? 'active' : null }}">
                        <a href="{{ route('oeuvre:index') }}">
                            @lang("Oeuvre")
                        </a>
                    </li>
                    <li class="{{ request()->segment(2) === 'Artiste' ? 'active' : null }}">
                        <a href="{{ route('artiste:index') }}">
                            @lang("Artiste")
                        </a>
                    </li>
                    <li class="{{ request()->segment(2) === 'Type' ? 'active' : null }}">
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

                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<div class="container">

</div>
@yield('content')

{{-- Scripts --}}
@section('script')
    <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
@show
</body>
</html>