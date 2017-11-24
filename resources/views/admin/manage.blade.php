@extends('layout.user')

@section('title', __("Admin"))
@section('subtitle', __("Gestion des droits"))

@section('content')

@section('header')
    Bienvenue {{ Auth::user()->name }}
@endsection

    @include('layout.heading')

    <section>

        <div class="container">
            <div id="row">
                <div class="col-lg-6">
                    <div class="panel-body">
                        <div class="row">
                            @foreach($users as $user)
                                <div class="col-3 m-2">
                                    <div class="titleHead">
                                        <h2 class="display-4 p-2 pl-4">{{ $user->name }}</h2>
                                        {!! Form::open(['route' => array('admin:manageStore', $user->id), 'method' => 'patch'])!!}

                                        {!! Form::Label('visiteur', 'Visiteur') !!}
                                        {!! Form::checkbox('visiteur', $user->visiteur, $user->visiteur) !!}

                                        {!! Form::Label('admin', 'Admin') !!}
                                        {!! Form::checkbox('admin', $user->admin, $user->admin) !!}

                                        <button type="submit" class="btn btn-success">
                                            @lang("Sauvegarder") <span class="glyphicon glyphicon-ok"></span>
                                        </button>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection