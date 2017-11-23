@extends('layout.user')

@section('title', __("Visiteur"))
@section('subtitle', __("Home"))

@section('content')
    	<div class="col-md-12 d-flex align-items-center justify-content-md-center" id="banner">
			<h1 class="display-1 text-white">Bienvenue {{ Auth::user()->name }}</h1>
    	</div>

<section>

Home visiteur


</section>

@endsection
