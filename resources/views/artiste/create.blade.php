@extends('artiste.artisteLayout')

@section('subtitle', __("Ajout"))

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-md-8 col-lg-8 panel panel-default">
                {!! BootForm::open()->action(route('artiste:store'))->patch() !!}
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            {!! BootForm::text(__("Nom"), 'nom')->required() !!}
                        </div>
                        <div class="col-xs-12 col-md-6">
                            {!! BootForm::text(__("Prénom"), 'prenom')->required() !!}
                        </div>
                        <div class="col-xs-12 col-md-6">
                            {!! BootForm::date(__("Date de naissance"), 'dateN')->required() !!}
                        </div>
                        <div class="col-xs-12 col-md-6">
                            {!! BootForm::date(__("Date de mort"), 'dateM') !!}
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-right">
                    <button type="submit" class="btn btn-success">
                        @lang("Sauvegarder") <span class="glyphicon glyphicon-ok"></span>
                    </button>
                </div>
                {!! BootForm::close() !!}
            </div>


        </div>
    </div>
@endsection