@extends('layout.user')

@section('title', __("Admin"))
@section('subtitle', __("Gestion des droits"))

@section('content')

@section('header')
    Bienvenue {{ Auth::user()->name }}
@endsection

    @include('layout.heading')

<nav class="navbar navbar-light bg-light">
    <form class="form-inline">
        <input class="form-control mr-sm-2" id="recherche" placeholder="Recherche" type="text" onkeyup="getSearch()">
    </form>
</nav>

    <section>

        <div class="container">
            <div class="row d-flex justify-content-between" id="adminSearch">
                @foreach($users as $user)
                    <div class="col-3 m-3 border border-secondary rounded">
                        <div class="titleHead">
                            <h2 class="display-4 p-2 pl-4">{{ $user->name }}</h2>
                            {!! Form::open(['route' => array('admin:manageStore', $user->id), 'method' => 'post'])!!}
                            {{csrf_field()}}
                            @if(!$user->visiteur && !$user->admin)
                                <h4>Rôle : Utilisateur</h4>
                                <button type="submit" class="btn btn-success">
                                    @lang("Changer en Visiteur") <span class="glyphicon glyphicon-ok"></span>
                                </button>
                            @endif

                            @if($user->visiteur && !$user->admin)
                                <h4>Rôle : Visiteur</h4>
                                <button type="submit" class="btn btn-success">
                                    @lang("Changer en Utilisateur") <span class="glyphicon glyphicon-ok"></span>
                                </button>
                            @endif
                            {!! Form::close() !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <script>

            var offset = 9;

            function getSearch(){
                offset = 0;
                $('#adminSearch').empty();
                $('#adminSearch').append('<div id="loading">' +
                    '                    <img id="loading-image" src="{{ asset('images/Ellipsis.svg') }}" alt="Loading..." />' +
                    '                </div>');
                $.ajax({
                    type:'GET',
                    url:'/admin/manageAjax/'+offset+'/'+$('#recherche').val(),

                    success:function(data){
                        $('#adminSearch').empty();
                        $.each(data, function( index, value ) {
                            var role = "";
                            var role2 = "";
                            if(!value.visiteur && !value.admin)
                            {
                                role = "Utilisateur";
                                role2 = "Visiteur";
                            }
                            if(value.visiteur && !value.admin)
                            {
                                role = "Visiteur";
                                role2 = "Utilisateur";
                            }
                            $('#adminSearch').append(
                                '<div class="col-3 m-3 border border-secondary rounded">' +
                                    '<div class="titleHead">' +
                                        '<h2 class="display-4 p-2 pl-4">'+value.name+'</h2>' +
                                        '<form onsubmit="submitForm('+value.id+');return false;">' +
                                           '<h4>Rôle : '+role+'</h4>' +
                                            '<button type="submit" class="btn btn-success">' +
                                                'Changer en '+role2 + '<span class="glyphicon glyphicon-ok"></span>' +
                                            '</button>' +
                                        '</form>' +
                                    '</div>' +
                                '</div>'
                            );
                        });
                        offset = offset + 9;
                    }
                });
            }

            function submitForm(iduser) {
                $('#adminSearch').empty();
                $('#adminSearch').append('<div id="loading">' +
                    '                    <img id="loading-image" src="{{ asset('images/Ellipsis.svg') }}" alt="Loading..." />' +
                    '                </div>');
                $.ajax({
                    type:'POST',
                    url:'manageStore/'+iduser+'',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

                    success:function(){
                        location.reload();
                    }
                });
            }

            var send = false;

            $(window).scroll(function() {
                console.log(parseInt($(window).scrollTop()));
                console.log($(document).height() - $(window).height());
                console.log('');
                if(parseInt($(window).scrollTop())+1 === $(document).height() - $(window).height()) {
                    console.log('scroll');
                    if(!send)
                    {
                        $('#adminSearch').append('<div id="loading" class="col-12">' +
                            '                    <img id="loading-image" src="{{ asset('images/Ellipsis.svg') }}" alt="Loading..." />' +
                            '                </div>');
                        send = true;
                        $.ajax({
                            type : "GET",
                            url : '/admin/manageAjax/'+offset+'/'+$('#recherche').val(),
                            success : function (data)
                            {
                                $('#loading').remove();
                                $.each(data, function( index, value ) {
                                    var role = "";
                                    var role2 = "";
                                    if(!value.visiteur && !value.admin)
                                    {
                                        role = "Utilisateur";
                                        role2 = "Visiteur";
                                    }
                                    if(value.visiteur && !value.admin)
                                    {
                                        role = "Visiteur";
                                        role2 = "Utilisateur";
                                    }
                                    $('#adminSearch').append(
                                        '<div class="col-3 m-3 border border-secondary rounded">' +
                                        '<div class="titleHead">' +
                                        '<h2 class="display-4 p-2 pl-4">'+value.name+'</h2>' +
                                        '<form onsubmit="submitForm('+value.id+');return false;">' +
                                        '<h4>Rôle : '+role+'</h4>' +
                                        '<button type="submit" class="btn btn-success">' +
                                        'Changer en '+role2 + '<span class="glyphicon glyphicon-ok"></span>' +
                                        '</button>' +
                                        '</form>' +
                                        '</div>' +
                                        '</div>'
                                    );
                                });
                                offset = offset + 9;
                                send = false;
                            }
                        });
                    }
                }
            });

            function lazyLoad() {
                if ($('#adminSearch').scrollTop() ===
                    document.getElementById('adminSearch').scrollHeight - $('#adminSearch').height()) {
                    console.log('scroll');
                    $('#adminSearch').append('<div id="loading">' +
                        '                    <img id="loading-image" src="{{ asset('images/Ellipsis.svg') }}" alt="Loading..." />' +
                        '                </div>');
                    $.ajax({
                        type : "GET",
                        url : '/admin/manageAjax/'+offset+'/'+$('#recherche').val(),
                        success : function (data)
                        {
                            $('#loading').remove();
                            $.each(data, function( index, value ) {
                                $('#adminSearch').append('<tr><td><a href="#" onclick="getAjax('+ value.id +','+value.posX+','+value.posY+')"><h4 class="text-light nameO">' +
                                    ''+ value.nom +'</h4></a></td></tr>');
                            });
                            offset = offset + 9;
                        }
                    });
                }
            }
        </script>


    </section>
@endsection