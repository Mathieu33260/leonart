<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12 panel panel-default">
            <div class="col sm-12 col-md-12 col-lg-12">
                <h3 class="mt-2 mb-0">Type : {{ $type->libelle }}</h3>
                <p class="text-secondary">Libellé: {{ $type->libelle }}</p>
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
                <div class="row justify-content-center">
                    <h4 class="mt-3 ml-3 center"> Modifier le type </h4>
                    <div class="col-xs-11 col-md-11">
                        <div class="panel panel-default center">
                            {!! Form::model($type, array('route' => array('type:update', $type->id), 'method' => 'post')) !!}
                            <div class="panel-body">
                                <div class="row ">
                                    <div class="col-xs-12 col-md-6">
                                        <h6>{!! Form::Label('libelle', 'Libelle :') !!}</h6>
                                        {!! Form::text('libelle', $type->libelle, array('required' => 'required', 'class' => 'form-control')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer text-right">
                                <button type="submit" class="btn btn-success">
                                    @lang("Sauvegarder") <span class="glyphicon glyphicon-ok"></span>
                                </button>
                            </div>
                            {!! Form::close() !!}
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
                        <h4 class="mt-3 center"> Êtes vous sûr de vouloir supprimer ce type ? </h4>
                        <div class="row col-12 justify-content-center">
                            <a href="{{ route('type:destroy', ['id' => $type->id]) }}" class="m-4">
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
