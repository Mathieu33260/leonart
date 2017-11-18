@extends('layout.app')

@section('nav')
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <a class="navbar-brand" href="{{ route('page:index') }}"><img src="{{ asset('/images/leonart.svg') }}" alt="{{ __("Logo Leonart") }}" ></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
            @guest
            <div class="navbar-nav links ">
                <a class="p-3 font-weight-bold nav-item nav-link" href="{{ route('login') }}">Login</a>
                <a class="p-3 font-weight-bold nav-item nav-link" href="{{ route('register') }}">Register</a>
            </div>
            @else
                    <div class="navbar-nav links ">
                        <a class="p-3 font-weight-bold nav-item nav-link" href="{{ route('home') }}">
                            {{ Auth::user()->name }}
                        </a>

                        <a class="p-3 font-weight-bold nav-item nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
            @endguest
        </div>
    </nav>
@endsection