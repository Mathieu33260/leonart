<div class="container">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="row">
                <div class="col sm-12 col-md-3 col-lg-3">
               <img src="/storage/uploads/images/{{$oeuvre->image}}" class="img-thumbnail mt-2" alt="tableau"/>
                </div>
                <div class="col sm-12 col-md-9 col-lg-6">
                <h3 class="mt-2 mb-0">Oeuvre : {{ $oeuvre->nom }}</h3>
                <p class="text-secondary">ID du iBeacon: {{ $oeuvre->idIbeacon }}</p>
                @if($oeuvre->type != null)
                            <p>Type :
                                <a href="{{ route('type:show',['id' => $oeuvre->type->id]) }}">
                                    {{ $oeuvre->type->libelle }}
                                </a>
                            </p>
                        @endif
                                                @if($oeuvre->artiste != null)
                            <p>Artiste :
                                <a href="{{ route('artiste:show',['id' => $oeuvre->artiste->id]) }}">
                                    {{ $oeuvre->artiste->nom }} {{ $oeuvre->artiste->prenom }}
                                </a>
                            </p>
                        @endif
                        <p class="">Ajouté par : {{ $oeuvre->user->name }}</p>

            </div>
            </div>
            <div class="row">
            <div class="col-8 mt-4">
                <p>{{ $oeuvre->description}}</p>
            </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <button type="button" data-toggle="modal" data-target=".bd-example-modal-lg"  aria-labelledby="myLargeModalLabel" aria-hidden="true" class="btn btn-outline-info">Modifier</button>
                    <a href="{{ route('oeuvre:destroy', ['id' => $oeuvre->id]) }}"><button type="button" class="btn btn-outline-danger" >Supprimer</button></a>
                </div>
                    <p>Audio : {{ $oeuvre->audio }}</p>
                </div>
     </div>

     <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg">
         <div class="modal-content"><div class="container">
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
                    {!! Form::model($oeuvre, array('route' => array('oeuvre:update', $oeuvre->id), 'method' => 'post')) !!}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                {!! Form::Label('nom', 'Nom') !!}
                                {!! Form::text('nom', $oeuvre->nom, array('required' => 'required', 'class' => 'form-control')) !!}
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
                        <div class="col-xs-12 col-md-6 col-lg-12">
                            {!! Form::Label('description', 'Description') !!}
                            {!! Form::textarea('description', null, array('class' => 'form-control',
                            'placeholder' => 'Description')) !!}
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
     </div>

</div>
