@extends('admin.adminLayout')

@section('subtitle', __("Gestion des droits"))

@section('content')
    <div class="col-md-12 d-flex align-items-center justify-content-md-center" id="banner">
        <h1 class="display-1 text-white">Bienvenue {{ Auth::user()->name }}</h1>
    </div>

    <section>

        Gestion des droits


    </section>
@endsection