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

<div id="container"></div>

<script type="text/javascript">
	var renderer, scene, camera, mesh;

	init();
	animate();

	function init() {
		renderer = new THREE.WebGLRenderer();

		renderer.setSize( window.innerWidth, window.innerHeight );

		$('#container').append(renderer.domElement);

		scene = new THREE.Scene();
		camera =new THREE.PerspectiveCamera(50, window.innerWidth / window.innerHeight, 1, 10000);
		camera.position.set(0, 0, 1000);
		scene.add(camera);

		var geometry = new THREE.CubeGeometry(200, 200, 200);
		var texture1 = new THREE.TextureLoader().load( "{{ asset('/images/texture/texture1.jpg')}}" );
		var texture2 = new THREE.TextureLoader().load( "{{ asset('/images/texture/texture2.jpg')}}" );
		var texture3 = new THREE.TextureLoader().load( "{{ asset('/images/texture/texture3.jpg')}}" );
		var texture4 = new THREE.TextureLoader().load( "{{ asset('/images/texture/texture4.jpg')}}" );
		var texture5 = new THREE.TextureLoader().load( "{{ asset('/images/texture/texture5.jpg')}}" );
		var texture6 = new THREE.TextureLoader().load( "{{ asset('/images/texture/texture6.jpg')}}" );

		var materials = [
	        new THREE.MeshBasicMaterial({
	            map: texture1
	        }),
	        new THREE.MeshBasicMaterial({
	            map: texture2
	        }),
	        new THREE.MeshBasicMaterial({
	            map: texture3
	        }),
	        new THREE.MeshBasicMaterial({
	            map: texture4
	        }),
	        new THREE.MeshBasicMaterial({
	            map: texture5
	        }),
	        new THREE.MeshBasicMaterial({
	            map: texture6
	        })
	     ];		mesh = new THREE.Mesh ( geometry, materials );
		scene.add( mesh );

		renderer.render( scene, camera );
	}

	function animate(){
    requestAnimationFrame( animate );
		mesh.rotation.x += .03;
		mesh.rotation.y += .03;
    renderer.render( scene, camera );
}

</script>











       <!-- <div class="col-md-8 col-lg-5">{!! $general !!}</div>

        <div class="col-md-8 col-lg-5">{!! $oeuvreV !!}</div>

        <div class="col-md-8">{!! $map !!}</div> -->
@endsection
