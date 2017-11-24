    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading lead">
                        {{ $oeuvre->nom }}
                    </div>
                    {!! Form::model($oeuvre, array('route' => array('oeuvre:update', $oeuvre->id), 'method' => 'post')) !!}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                {!! Form::Label('nom', 'Nom') !!}
                                {!! Form::text('nom', $oeuvre->nom, array('required' => 'required', 'class' => 'form-control')) !!}
                            </div>
                            <div class="col-xs-12 col-md-6">
                                @if($oeuvre->modele != null)
                                    {!! Form::Label('modele', 'Modèle') !!}
                                    {!! Form::text('modele', $oeuvre->modele, array('class' => 'form-control')) !!}
                                @else
                                    {!! Form::Label('modele', 'Modèle') !!}
                                    {!! Form::text('modele', null, array('class' => 'form-control')) !!}
                                @endif
                            </div>
                            <div class="col-xs-12 col-md-6">
                                {!! Form::Label('idIbeacon', 'Id iBeacon') !!}
                                {!! Form::number('idIbeacon',$oeuvre->idIbeacon , array('required' => 'required', 'class' => 'form-control')) !!}
                            </div>
                            <div class="col-xs-12 col-md-6">
                                {!! Form::Label('posX', 'Latitude') !!}
                                {!! Form::text('posX',$oeuvre->posX, array('required' => 'required', 'class' => 'form-control')) !!}
                            </div>
                            <div class="col-xs-12 col-md-6">
                                {!! Form::Label('posY', 'Longitude') !!}
                                {!! Form::text('posY',$oeuvre->posY ,array('required' => 'required', 'class' => 'form-control')) !!}
                            </div>
                            <div class="col-xs-12 col-md-6">
                                {!! Form::Label('audio', 'Audio') !!}
                                {!! Form::file('audio', array('class' => 'form-control', 'accept' => 'audio/*')) !!}
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6">
                                {!! Form::Label('image', 'Image') !!}
                                {!! Form::file('image', array('class' => 'form-control')) !!}
                            </div>
                            @if($oeuvre->type != null)
                                <div class="col-xs-12 col-md-6">
                                    {!! Form::Label('typeId', 'Type') !!}
                                    {!! Form::select('typeId',array(null => 'Aucun') + $types, $oeuvre->type->id, array('class' => 'form-control') ) !!}

                                </div>
                            @else
                                <div class="col-xs-12 col-md-6">
                                    {!! Form::Label('typeId', 'Type') !!}
                                    {!! Form::select('typeId',array(null => 'Aucun') + $types, null, array('class' => 'form-control') ) !!}

                                </div>
                            @endif

                            @if($oeuvre->artiste != null)
                            <div class="col-xs-12 col-md-6">
                                {!! Form::Label('artisteId', 'Artiste') !!}
                                {!! Form::select('artisteId',array(null => 'Aucun') + $artistes, $oeuvre->artiste->id, array('class' => 'form-control') ) !!}

                            </div>
                            @else
                                <div class="col-xs-12 col-md-6">
                                    {!! Form::Label('artisteId', 'Artiste') !!}
                                    {!! Form::select('artisteId',array(null => 'Aucun') + $artistes, null, array('class' => 'form-control') ) !!}

                                </div>
                            @endif
                            <div class="col-xs-12 col-md-6 col-lg-12">
                                {!! Form::Label('description', 'Description') !!}
                                {!! Form::textarea('description', $oeuvre->description, array('class' => 'form-control')) !!}
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
