@extends('layout.user')

@section('title', __("Gestion"))
@section('subtitle', __("Home"))

@section('content')
<style>
	#banner{
		background-image: url("https://files.slack.com/files-pri/T7AAFMCF6-F84KAH5PH/dim.jpg");
		height: 35%;
		width: 100%;

	}
</style>
    	<div class="col-md-12 d-flex align-items-center justify-content-md-center" id="banner">
			<h1 class="display-1 text-white">Bienvenue {{ Auth::user()->name }}</h1>
    	</div>

<section>
<div class="position-ref full-height dark">
    <h1 class="p-4 text-center text-light display-1">Vos options</h1>
        <div class="container">
            <div class="row">
            	<div class="col-sm">
           		<div class="jumbotron ">
           			<h2 class="display-4 d-flex align-items-center justify-content-md-center">Lieu des oeuvres</h2>
           			{!! $map !!}
           		</div>
           		</div>
           		<div class="col-sm">
           		<div class="jumbotron">
           			<h2 class="display-4 d-flex align-items-center justify-content-md-center">Vos oeuvres</h2>
           			{!! $general !!}
           		</div>
           		</div>
           	</div>
        </div>
</div>
</section>
       <!-- <div class="col-md-8 col-lg-5">{!! $general !!}</div>

        <div class="col-md-8 col-lg-5">{!! $oeuvreV !!}</div>

        <div class="col-md-8">{!! $map !!}</div> -->
@endsection
