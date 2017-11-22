<div class="container">
    <div class="row">

        <div class="col-xs-12 col-md-12 col-lg-12 panel panel-default">
            <table class="table">
                <th> <h3>Oeuvre <a href="{{ route('oeuvre:show',['id' => $oeuvre->id]) }}">{{ $oeuvre->nom }}</a></h3></th>
                <tr>
                    <td><p>Nom : {{ $oeuvre->nom }}</p></td>
                    <td>
                        @if($oeuvre->type != null)
                            <p>Type :
                                <a href="{{ route('type:show',['id' => $oeuvre->type->id]) }}">
                                    {{ $oeuvre->type->libelle }}
                                </a>
                            </p>
                        @endif
                    </td>
                    <td>
                        @if($oeuvre->artiste != null)
                            <p>Artiste :
                                <a href="{{ route('artiste:show',['id' => $oeuvre->artiste->id]) }}">
                                    {{ $oeuvre->artiste->nom }} {{ $oeuvre->artiste->prenom }}
                                </a>
                            </p>
                        @endif
                    </td>
                    <td><p>Id iBeacon : {{ $oeuvre->idIbeacon }}</p></td>
                </tr>
                <tr>
                    <td><p>Modèle : {{ $oeuvre->modele }}</p></td>
                    <td><p>Latitude : {{ $oeuvre->posX }}</p></td>
                    <td><p>Longitude : {{ $oeuvre->posY }}</p></td>
                    <td><p>Audio : {{ $oeuvre->audio }}</p></td>
                </tr>
                <tr>
                    <td><p>User : {{ $oeuvre->user->name }}</p></td>
                    <td><a type="button" class="btn btn-outline-info" href="{{ route('oeuvre:edit', ['id' => $oeuvre->id]) }}">Modifier</a></td>
                    <td><a type="button" class="btn btn-outline-danger" href="{{ route('oeuvre:destroy', ['id' => $oeuvre->id]) }}">Supprimer</a></td>
                </tr>
            </table>
        </div>


    </div>
</div>