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

<div id="container"></div>

<script type="text/javascript">
	var renderer, scene, camera, mesh;

	init();
	animate();

	function init() {
		renderer = new THREE.WebGLRenderer();

		renderer.setSize( $(window).width(), $(window).height() );

		$('#container').append(renderer.domElement);

		scene = new THREE.Scene();
		camera =new THREE.PerspectiveCamera(50, window.innerWidth / window.innerHeight, 1, 10000);
		camera.position.set(0, 0, 1000);
		scene.add(camera);

		var geometry = new THREE.CubeGeometry($(window).width()/9, $(window).width()/9, $(window).width()/9);
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
