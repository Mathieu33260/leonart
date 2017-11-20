@extends('layout.navbarFront')

@section('title', __("Contact"))

@section('content')
    <div class="container">
      <div class="row justify-content-center">
        <h2 class="text-dark text-center col-lg-12" id="title_h2">Contactez-nous&nbsp;!</h2>
      </div>
        <div class="row justify-content-center">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-xs-12 col-md-9 col-lg-9 panel panel-default ">
                {!! Form::open(['route'=>'page:contactPost']) !!}
                <div class="panel-body">
                    <div class="row ">
                        <div class="col-xs-12 col-md-6">
                          {!! Form::label('Nom') !!}
                          {!! Form::text('Nom', null,
                          array('required',
                          'class'=>'form-control',
                          'placeholder'=>'Votre Nom')) !!}
                        </div>
                        <div class="col-xs-12 col-md-6">
                          {!! Form::label('Email') !!}
                          {!! Form::email('Email', null,
                          array('required',
                          'class'=>'form-control',
                          'placeholder'=>'Votre adresse Email')) !!}
                        </div>
                        <div class="col-xs-12 col-md-12">
                          {!! Form::label('Message') !!}
                          {!! Form::textarea('Message', null,
                          array('required',
                          'class'=>'form-control',
                          'placeholder'=>'Votre message')) !!}
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-right">
                  {!! Form::submit('Envoyer',
                  array('class'=>'btn btn-success')) !!}

                </div>
                {!! Form::close() !!}
            </div>


        </div>
    </div>
@endsection
