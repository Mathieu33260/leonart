@extends('oeuvre.oeuvreLayout')

@section('subtitle', __("Oeuvres"))

@section('content')

@section('header')
    Vos Oeuvres
@endsection

@section('navSearch')
    {{ route('oeuvre:create') }}
@endsection

@include('layout.heading')
@include('layout.navSearch')
<div class="row">
    <div class="col-lg-2 col-md-2 right-list" onscroll="lazyLoad()">
        <div class="dark2">
            <table class="table table-striped table-dark list">
                @foreach($oeuvres as $oeuvre)
                    <tr>
                        <td>
                            <a onclick="twoCall('{{ $oeuvre->image }}',{{ $oeuvre->id }},{{ $oeuvre->posX }},{{ $oeuvre->posY }})">
                                <h4 class="text-light nameO">{{ $oeuvre->nom }}</h4>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class="col">
        <div id="loading">
            <img id="loading-image" src="{{ asset('images/Ellipsis.svg') }}" alt="Loading..." />
        </div>
        <div class="row">
            <div id="box" class="col-lg-7 col-md-5">
            </div>
            <div id="canvasthree" class="col-lg-5 col-md-7"></div>
        </div>
        <div class="row">
            <div id="containerMap" class="container-fluid">
                {!! $map !!}</div>
        </div>
    </div>


</div>


<script>
    $(document).ready(function() {
        $('#loading').hide();
        init(null);
        animate();
        $('#box').text('');
        $('#canvasthree').hide();
    });

    var renderer, scene, camera, mesh;

    function init(image) {
        renderer = new THREE.WebGLRenderer({ alpha: true});

        renderer.setSize( $(window).width()/3, $(window).height()/3 );

        $('#canvasthree').append(renderer.domElement);

        scene = new THREE.Scene();
        camera =new THREE.PerspectiveCamera(50, $(window).width() / $(window).height(), 1, 10000);
        camera.position.set(0, 0, 700);
        scene.add(camera);

        var geometry = new THREE.CubeGeometry($(window).width()/5, $(window).width()/5, $(window).width()/5);

        if(image === null || image === undefined || image === "")
        {
            var texture = new THREE.TextureLoader().load( "{{ asset('images/texture/leonart.png') }}");
        } else {
            var texture = new THREE.TextureLoader().load( "/storage/uploads/images/" + image);
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
        $('#canvasthree').text('');
        init(image);
        $('#canvasthree').show();
        getAjax(id, lat, long);
        $('#map').animate({
            "min-height": "400px"
        });
    }

    var offset = 20;

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
                    if(value.image !== null)
                    {
                        $('.list').append('<tr><td><a href="#" onclick="twoCall(\''+value.image+'\','+ value.id +','+value.posX+','+value.posY+')">' +
                            '<h4 class="text-light nameO">' +
                            ''+ value.nom +'</h4></a></td></tr>');
                    } else {
                        $('.list').append('<tr><td><a href="#" onclick="twoCall('+value.image+','+ value.id +','+value.posX+','+value.posY+')">' +
                            '<h4 class="text-light nameO">' +
                            ''+ value.nom +'</h4></a></td></tr>');
                    }
                });
                offset = offset + 20;
            }
        });
    }

    var send = false;

    function lazyLoad() {
        if (parseInt($('.right-list').scrollTop())+1 ===
            document.getElementsByClassName('right-list')[0].scrollHeight - parseInt($('.right-list').height())) {
            if(!send)
            {
                send = true;
                $.ajax({
                    type : "GET",
                    url : '/oeuvre/indexAjax/'+offset+'/'+$('#recherche').val(),
                    success : function (data)
                    {
                        $.each(data, function( index, value ) {
                            var pos = {lat: value.posX, lng: value.posY};
                            placeMarker(pos,map,value.id);
                            if(value.image !== null)
                            {
                                $('.list').append('<tr><td><a href="#" onclick="twoCall(\''+value.image+'\','+ value.id +','+value.posX+','+value.posY+')">' +
                                    '<h4 class="text-light nameO">' +
                                    ''+ value.nom +'</h4></a></td></tr>');
                            } else {
                                $('.list').append('<tr><td><a href="#" onclick="twoCall('+value.image+','+ value.id +','+value.posX+','+value.posY+')">' +
                                    '<h4 class="text-light nameO">' +
                                    ''+ value.nom +'</h4></a></td></tr>');
                            }
                        });
                        offset = offset + 20;
                        send = false;
                    }
                });
            }
        }
    }
</script>
@endsection
