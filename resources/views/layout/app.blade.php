<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" prefix="og: http://ogp.me/ns#">
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

    {{-- Description & keywords --}}
    <meta name="description" content="@yield('description', __(config('app.description')))" />
    <meta name="keywords" content="@yield('keywords', __(config('app.keywords')))" />

    {{-- OpenGraph --}}
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url('/') }}" />
    <meta property="og:title" content="{{ config('app.name') }}: @yield('title')" />
    <meta property="og:description" content="@yield('description', __(config('app.description')))" />
    <meta property="og:image" content="{{ asset('img/social/facebook.png') }}" />
    <meta property="og:image:secure_url" content="{{ asset('img/social/facebook.png') }}" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image:width" content="526" />
    <meta property="og:image:height" content="275" />

    {{-- Twitter --}}
    <meta property="twitter:card" content="summary" />
    <meta property="twitter:url" content="{{ url('/') }}" />
    <meta property="twitter:title" content="{{ config('app.name') }}: @yield('title')" />
    <meta property="twitter:description" content="@yield('description', __(config('app.description')))" />
    <meta property="twitter:image" content="{{ asset('img/social/twitter.png') }}" />

    {{-- Navbar color --}}
    <meta name="theme-color" content="#2c3e50" />
    <meta name="msapplication-navbutton-color" content="#2c3e50" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#2c3e50" />

    {{-- Page title --}}
    <title>{{ config('app.name') }}: @yield('title') | @yield('subtitle')</title>

    {{-- Favicons --}}
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">


    {{-- Stylesheets --}}
    @section('style')
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @show
</head>
<body>
<div id="">
    @yield('nav')

    @yield('content')
</div>

{{-- Scripts --}}
@section('script')
    @if (config('settings.analytics_id'))
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-109925365-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-109925365-1');
        </script>
    @endif
    <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
@show
</body>
</html>