<style>
.buttonArtiste{
    height: 100px;
}
</style>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12 panel panel-default">
            <div class="col sm-12 col-md-12 col-lg-12">
                <h3 class="mt-2 mb-0">Artiste : {{ $artiste->prenom }} {{ $artiste->nom }}</h3>
                <p class="text-secondary">Nom: {{ $artiste->nom }}</p>
                <p class="text-secondary">Prénom: {{ $artiste->prenom }}</p>
                <p>Date de naissance: {{ $artiste->dateN->day }}/{{ $artiste->dateN->month }}/{{ $artiste->dateN->year }}</p>
                <p>Date de mort: {{ $artiste->dateM->day }}/{{ $artiste->dateM->month }}/{{ $artiste->dateM->year }}</p>
            </div>
            <div class="buttonFix col sm-12 col-md-12 col-12-12">
                        <button type="button" data-toggle="modal" data-target=".bd-example-modal-lg"
                                aria-labelledby="myLargeModalLabel" aria-hidden="true"
                                class="btn btn-outline-info">
                            Modifier
                        </button>
                        <button type="button" data-toggle="modal" data-target=".modal-supp"
                                aria-labelledby="labelSuppModal" aria-hidden="true"
                                class="btn btn-outline-danger">
                            Supprimer
                        </button>
                    </div>

        </div>
    </div>


    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="container">
                    <div class="row justify-content-center">
                        <h4 class="mt-3 center"> Modifier l'artiste </h4>
                        <div class="col-xs-11 col-md-11 mt-3">
                            <div class="panel panel-default">
                                {!! Form::model($artiste, array('route' => array('artiste:update', $artiste->id), 'method' => 'post')) !!}
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6">
                                            {!! Form::Label('nom', 'Nom') !!}
                                            {!! Form::text('nom', $artiste->nom, array('required' => 'required', 'class' => 'form-control')) !!}
                                        </div>
                                        <div class="col-xs-12 col-md-6">
                                            {!! Form::Label('prenom', 'Prénom') !!}
                                            {!! Form::text('prenom', $artiste->prenom, array('required' => 'required', 'class' => 'form-control')) !!}
                                        </div>
                                        <div class="col-xs-12 col-md-6">
                                            {!! Form::Label('dateN', 'Date de naissance') !!}
                                            {!! Form::date('dateN', $artiste->dateN, array('required' => 'required', 'class' => 'form-control')) !!}
                                        </div>
                                        <div class="col-xs-12 col-md-6">
                                            @if($artiste->dateM != null)
                                                {!! Form::Label('dateM', 'Date de mort') !!}
                                                {!! Form::date('dateM', $artiste->dateM, array('required' => 'required', 'class' => 'form-control')) !!}
                                            @else
                                                {!! Form::Label('dateM', 'Date de mort') !!}
                                                {!! Form::date('dateM', null, array('class' => 'form-control')) !!}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer text-right">
                                    <button type="submit" class="btn btn-success mt-2">
                                        @lang("Sauvegarder") <i class="fa fa-check"></i>
                                    </button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade modal-supp" tabindex="-1" role="dialog" aria-labelledby="labelSuppModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="container">
                    <div class="row justify-content-center">
                        <h4 class="mt-3 center"> Êtes vous sûr de vouloir supprimer cet artiste ? </h4>
                        <div class="row col-12 justify-content-center">
                            <a href="{{ route('artiste:destroy', ['id' => $artiste->id]) }}" class="m-4">
                                <button type="button" class="btn btn-outline-danger" >
                                    Oui
                                </button>
                            </a>
                            <button type="button" data-dismiss="modal" class="btn btn-outline-info m-4">
                                Non
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
