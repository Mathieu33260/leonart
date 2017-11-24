@extends('type.typeLayout')

@section('subtitle', __("Accueil"))

@section('content')

@section('header') 
Vos Types
@endsection

@include('layout.heading')
@include('layout.navSearch')
<div class="row">
    <div class="col-lg-2 right-list" onscroll="lazyLoad()">
        <div class="dark2">
            <table class="table table-striped table-dark list">
                    @foreach($types as $type)
                    <tr>
                        <td>
                            <a href="#" onclick="getAjax({{ $type->id }})">
                                <h4 class="text-light nameO">{{ $type->libelle }}</h4>
                            </a>
                        </td>
                    </tr>
                    @endforeach
            </table>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="row">
            <div id="box"></div>
        </div>
    </div>
</div>
    <script>

        function getAjax(id){
            $.ajax({
                type:'GET',
                url:'/type/'+id,
                success:function(data){
                    $('#box').empty();
                    $('#box').append(data);
                }
            });
        }

        var offset = 10;

        function getSearch(){
            offset = 0;
            $.ajax({
                type:'GET',
                url:'/type/indexAjax/'+offset+'/'+$('#recherche').val(),
                success:function(data){
                    $('.list').empty();
                    $.each(data, function( index, value ) {
                        $('.list').append('<tr><td><a href="#" onclick="getAjax('+ value.id +')"><h4 class="text-light nameO">' +
                            ''+ value.libelle +'</h4></a></td></tr>');
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
                    url : '/type/indexAjax/'+offset+'/'+$('#recherche').val(),
                    success : function (data)
                    {
                        $('.loading-indicator').remove();
                        $.each(data, function( index, value ) {
                            $('.list').append('<tr><td><a href="#" onclick="getAjax('+ value.id +')"><h4 class="text-light nameO">' +
                                ''+ value.libelle +'</h4></a></td></tr>');
                        });
                        offset = offset + 10;
                    }
                });
            }
        }
    </script>
@endsection

