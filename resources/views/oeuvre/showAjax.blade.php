<div class="container">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="row">
                <div class="col-4">
               <img src="http://www.peintures-sur-toile.com/images/Image/Image/PST3671.jpg?1459244346559" class="img-thumbnail mt-2" alt="tableau"/>
                </div>
                <div class="col-8">
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
                    <a href="{{ route('oeuvre:edit', ['id' => $oeuvre->id]) }}"><button type="button" class="btn btn-outline-info">Modifier</button></a>
                    <a href="{{ route('oeuvre:destroy', ['id' => $oeuvre->id]) }}"><button type="button" class="btn btn-outline-danger" >Supprimer</button></a>
                </div>
                    <p>Audio : {{ $oeuvre->audio }}</p>
                </div>
     </div>
</div>