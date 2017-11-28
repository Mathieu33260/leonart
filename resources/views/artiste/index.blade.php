@extends('artiste.artisteLayout')

@section('subtitle', __("Artiste"))

@section('content')

@section('header')
Vos Artistes
@endsection

@section('navSearch')
{{ route('artiste:create') }}
@endsection

@include('layout.heading')
@include('layout.navSearch')
    <div class="row">
        <div class=" col-lg-2 right-listA" onscroll="lazyLoad()">
            <div class="dark2">
                <table class="table table-striped table-dark list">
                @foreach($artistes as $artiste)
                    <tr>
                        <td>
                        <a href="#" onclick="getAjax({{ $artiste->id }})">
                            <h4 class="text-light nameO">{{ $artiste->nom }} {{ $artiste->prenom }}</h4>
                        </a>
                        </td>
                    </tr>
                @endforeach
            </table>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="row">
                <div id="box">

                </div>

            </div>
        </div>
    </div>
    <script>

        function getAjax(id){
            $.ajax({
                type:'GET',
                url:'/artiste/'+id,
                success:function(data){
                    $('#box').empty();
                    $('#box').append(data);
                }
            });
        }

        var offset = 5;

        function getSearch(){
            offset = 0;
            $.ajax({
                type:'GET',
                url:'/artiste/indexAjax/'+offset+'/'+$('#recherche').val(),
                success:function(data){
                    $('.list').empty();
                    $.each(data, function( index, value ) {
                        $('.list').append('<tr><td><a href="#" onclick="getAjax('+ value.id +')"><h4 class="text-light nameO">' +
                            ''+ value.nom +' '+ value.prenom +'</h4></a></td></tr>');
                    });
                    offset = offset + 5;
                }
            });
        }

        function lazyLoad() {
            if ($('.right-listA').scrollTop() ===
                document.getElementsByClassName('right-listA')[0].scrollHeight - $('.right-listA').height()) {
                $('.right-listA').append('<img src="{{ asset('/images/ajax-loader.gif') }}" class="loading-indicator"/>');
                $.ajax({
                    type : "GET",
                    url : '/artiste/indexAjax/'+offset+'/'+$('#recherche').val(),
                    success : function (data)
                    {
                        $('.loading-indicator').remove();
                        $.each(data, function( index, value ) {
                            $('.list').append('<tr><td><a href="#" onclick="getAjax('+ value.id +')"><h4 class="text-light nameO">' +
                                ''+ value.nom +' '+ value.prenom +'</h4></a></td></tr>');
                        });
                        offset = offset + 5;
                    }
                });
            }
        }
    </script>
@endsection
