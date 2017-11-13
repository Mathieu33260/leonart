@extends('layout.user')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-8 col-lg-5">{!! $general !!}</div>

        <div class="col-md-8 col-lg-5">{!! $oeuvreV !!}</div>

        <div class="col-md-8 col-md-offset-2">{!! $map !!}</div>
    </div>
</div>
@endsection
