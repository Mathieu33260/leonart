<!DOCTYPE html>
<html>
  <head>
    {{-- Basic metas --}}
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="language" content="{{ app()->getLocale() }}" />
    <meta name="copyright" content="{{ url('/') }}" />
    <meta name="author" content="Leon-art.fr" />

    {{-- Description & keywords --}}
    <meta name="description" content="@yield('description', __(config('app.description')))" />
    <meta name="keywords" content="@yield('keywords', __(config('app.keywords')))" />

    {{-- Page title --}}
    <title>{{ config('app.name') }}: @yield('title') | @yield('subtitle')</title>

    {{-- Favicons --}}
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">

    {{-- Stylesheets --}}
      <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/404.css') }}">
    @show
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

  </head>
  <body>
    <nav>
      <a class="navbar-brand col-sm-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3" href="{{ route('page:index') }}">
        <img src="{{ asset('/images/leonart.svg') }}" alt="{{ __("Logo Leonart") }}" ></a>
    </nav>
    <section>
      <div class="col-sm-12 col-md-12 col-lg-7 offset-lg-3">
        <div class="col-sm-9 offset-sm-4 col-md-10 offset-md-4 col-lg-12 offset-lg-3">
          <img id="textPicture" src="{{ asset ('/images/notfound.svg')}}" alt="Not found Text">
        </div>
        <div class="col-sm-10 offset-sm-2 col-md-8 offset-md-3 col-lg-11 offset-lg-1 ">
          <img id="picture404" src="{{ asset ('/images/404.svg')}}" alt="404 Picture">
          <img id="breathingCircle" src="{{ asset ('/images/circle.svg')}}" alt="Circle Animation">
        </div>
      </div>
    </section>
        @include('layout.footer')
  </body>
</html>
