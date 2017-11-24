@extends('oeuvre.oeuvreLayout')

@section('subtitle', __("Oeuvres"))

@section('content')

@section('header')
Vos Oeuvres
@endsection

@include('layout.heading')

<style>
</style>

    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <input class="form-control mr-sm-2" id="recherche" placeholder="Recherche" type="text" onkeyup="getSearch()">
                   <a href="{{ route('oeuvre:create') }}"><input type="button" class="btn btn-outline-success center-block" value="Ajouter"></a>
        </form>


    </nav>
        <div class="row">
            <div class="col-lg-2 col-md-2 right-list" onscroll="lazyLoad()">
                <div class="dark2">
                    <table class="table table-striped table-dark list">
                    @foreach($oeuvres as $oeuvre)
                            <tr>
                                <td>
                                    <a href="#" onclick="twoCall('{{ $oeuvre->image }}',{{ $oeuvre->id }},{{ $oeuvre->posX }},{{ $oeuvre->posY }})">
                                        <h4 class="text-light nameO">{{ $oeuvre->nom }}</h4>
                                    </a>
                                </td>
                            </tr>
                    @endforeach
                    </table>
                </div>
            </div>
            <div></div>
            <div class="col">
                <div id="loading">
                    <img id="loading-image" src="{{ asset('images/Ellipsis.svg') }}" alt="Loading..." />
                </div>
                <div class="row">
                    <div id="box">
                    </div>
                </div>
                <div class="row">
                    <div id="containerMap" class="container-fluid">
                    {!! $map !!}</div>
                    <div id="canvasthree"><div class=" col-lg-6">
                      <div id="container"></div>
                    </div></div>
                </div>
            </div>


        </div>


    <script>
        $(document).ready(function() {
         $('#loading').hide();
          init('null');
          animate();
          $('#box').text('');
          $('#canvasthree').hide();
        })

        var renderer, scene, camera, mesh;

        function init(image) {
            renderer = new THREE.WebGLRenderer({ alpha : true });

            renderer.setSize( $(window).width()/2, $(window).height()/2 );

            $('#container').append(renderer.domElement);

            scene = new THREE.Scene();
            camera =new THREE.PerspectiveCamera(50, $(window).width() / $(window).height(), 1, 10000);
            camera.position.set(200, -100, 1000);
            scene.add(camera);

            var geometry = new THREE.CubeGeometry($(window).width()/5, $(window).width()/5, $(window).width()/5);

            try {
              var texture = new THREE.TextureLoader().load( "/storage/uploads/images/" + image);
            } catch(exception) {
              var texture = new THREE.TextureLoader().load( "{{ asset('images/texture/leonart.png') }}");
            }

            var materials = [
                  new THREE.MeshBasicMaterial({
                      map: texture
                  }),
                  new THREE.MeshBasicMaterial({
                      map: texture
                  }),
                  new THREE.MeshBasicMaterial({
                      map: texture
                  }),
                  new THREE.MeshBasicMaterial({
                      map: texture
                  }),
                  new THREE.MeshBasicMaterial({
                      map: texture
                  }),
                  new THREE.MeshBasicMaterial({
                      map: texture
                  })
               ];		mesh = new THREE.Mesh ( geometry, materials );
            scene.add( mesh );

          }

          function animate(){
            requestAnimationFrame( animate );
            mesh.rotation.x += .01;
            mesh.rotation.y += .005;
            renderer.render( scene, camera );
        }

        function getAjax(id,lat,long){
            centerMap   (lat,long);
            $.ajax({
                type:'GET',
                url:'/oeuvre/'+id,
                    beforeSend: function(){
                    $('#loading').show();
                     },
                success:function(data){
                    $('#loading').remove();
                    $('#box').empty();
                    $('#box').append(data);
                }
            });
        }

        function twoCall(image, id, lat, long) {
          init(image);
          getAjax(id, lat, long);
          $('#map').animate({
            "min-height": "400px"
        });
          $('#canvasthree').show();
        }

        var offset = 10;

        function getSearch(){
            offset = 0;
            $.ajax({
                type:'GET',
                url:'/oeuvre/indexAjax/'+offset+'/'+$('#recherche').val(),

                success:function(data){

                    $('.list').empty();
                    deleteAllMarker();
                    $.each(data, function( index, value ) {
                        var pos = {lat: value.posX, lng: value.posY};
                        placeMarker(pos,map,value.id);
                        $('.list').append('<tr><td><a href="#" onclick="getAjax('+ value.id +','+value.posX+','+value.posY+')"><h4 class="text-light nameO">' +
                            ''+ value.nom +'</h4></a></td></tr>');
                    });
                    offset = offset + 10;
                }
            });
        }

        function lazyLoad() {
            if ($('.right-list').scrollTop() ===
                document.getElementsByClassName('right-list')[0].scrollHeight - $('.right-list').height()) {
                $('.right-list').append('<img src="{{ asset('/images/ajax-loader.gif') }}" class="loading-indicator"/>');
                $.ajax({
                    type : "GET",
                    url : '/oeuvre/indexAjax/'+offset+'/'+$('#recherche').val(),
                    success : function (data)
                    {
                        $.each(data, function( index, value ) {
                            var pos = {lat: value.posX, lng: value.posY};
                            placeMarker(pos,map,value.id);
                            $('.right-list').append('<tr><td><a href="#" onclick="getAjax('+ value.id +','+value.posX+','+value.posY+')"><h4 class="text-light nameO">' +
                                ''+ value.nom +'</h4></a></td></tr>');
                        });
                        offset = offset + 10;
                    }
                });
            }
        }
    </script>
@endsection
