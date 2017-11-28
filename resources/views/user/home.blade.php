@extends('layout.user')

@section('title', __("Gestion"))
@section('subtitle', __("Home"))

@section('content')

@section('header') 
Bienvenue {{ Auth::user()->name }}
@endsection

@include('layout.heading')


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
						@foreach($oeuvres as $oeuvre)
							<div class="row">
								<div class="col-lg-2">
									@if($oeuvre->image != null)
									<img width="100%" src="/storage/uploads/images/{{$oeuvre->image}}" alt="{{$oeuvre->nom}}">
                                    @endif
								</div>
								<div class="col-lg-6">
									<h1>{{ $oeuvre->nom }}</h1>
									<p>{{ $oeuvre->user->name }}</p>
								</div>
							</div>
						@endforeach
					</div>
				</div>
           	</div>
        <div class="row p-5 justify-content-center pl-5">
        	<div class="separationBar d-flex align-items-center justify-content-md-center">
        	</div>
        </div>
        <div class="row justify-content-center">
        	<div class="col-lg-3 col-md-5 col-sm-10 mt-3">
        		<div class="titleHead">
        			<h2 class="display-4 p-2 d-flex align-items-center justify-content-md-center">Oeuvres par Type</h2>
                    {!! $oeuvreT !!}
                </div>
           	</div>
           	<div class="col-lg-3 col-md-5 col-sm-10 mt-3">
        		<div class="titleHead">
        			<h2 class="display-4 p-2 d-flex align-items-center justify-content-md-center">Répartition</h2>
                    {!! $general !!}
                </div>
            </div>
           	<div class="col-lg-3 col-md-5 col-sm-10 mt-3">
        		<div class="titleHead">
        			<h2 class="display-4 p-2 d-flex align-items-center justify-content-md-center">Oeuvres par Artiste</h2>
                    {!! $oeuvreA !!}
                </div>
            </div>
        </div>
       	</div>

</div>


</section>

@endsection
