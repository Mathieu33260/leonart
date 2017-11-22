@extends('layout.user')

@section('title', __("Gestion"))
@section('subtitle', __("Home"))

@section('content')
    	<div class="col-md-12 d-flex align-items-center justify-content-md-center" id="banner">
			<h1 class="display-1 text-white">Bienvenue {{ Auth::user()->name }}</h1>
    	</div>

<section>
<div class="position-ref dark pb-4">
        <div class="container-fluid pt-4">
            <div class="row">
            	<div class="col-1">
            	</div>
            	<div class="col-5">
            		<div class="titleHead">
           			<h2 class="display-4 p-2 pl-4"><i class="fa fa-map-marker pr-2"></i>Lieu des oeuvres</h2>
           			{!! $map !!}
           			</div>
           		</div>
           		<div class="col-5">
           		<div class="titleHead">
           			<h2 class="display-4 p-2 pl-4"><i class="fa fa-paint-brush pr-2"></i>Vos oeuvres</h2>
           			{!! $general !!}
           		</div>
           		</div>
           	</div>
        <div class="row p-5 justify-content-center pl-5">
        	<div class="separationBar d-flex align-items-center justify-content-md-center">
        	</div>
        </div>
        <div class="row justify-content-center">
        	<div class="col-3">
        		<div class="titleHead">
        			<h2 class="display-4 p-2 d-flex align-items-center justify-content-md-center">Lieu des oeuvres</h2>
           			{!! $oeuvreV !!}
           			</div>
           	</div>
           	<div class="col-3">
        		<div class="titleHead">
        			<h2 class="display-4 p-2 d-flex align-items-center justify-content-md-center">Lieu des oeuvres</h2>
           			{!! $general !!}
           			</div>
           	</div>
           	<div class="col-3">
        		<div class="titleHead">
        			<h2 class="display-4 p-2 d-flex align-items-center justify-content-md-center">Lieu des oeuvres</h2>
           			{!! $oeuvreV !!}
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
