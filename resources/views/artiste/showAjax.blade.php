<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12 panel panel-default">
            <table class="table">
                <th><h3>Artiste :</h3></th>
                <th><h3><a href="{{ route('artiste:show',['id' => $artiste->id]) }}">{{ $artiste->nom }} {{ $artiste->prenom }}</a></h3></th>
                <tr>
                    <td><p>Nom : {{ $artiste->nom }}</p></td>
                    <td><p>Prénom : {{ $artiste->prenom }}</p></td>
                    <td><p>Date de naissance : {{ $artiste->dateN }}</p></td>
                    <td><p>Date de mort : {{ $artiste->dateM }}</p></td>
                </tr>
                <tr>
                    <td><a href="{{ route('artiste:edit', ['id' => $artiste->id]) }}"><button type="button" class="btn btn-outline-info">Modifier</button></a></td>
                    <td><a href="{{ route('artiste:destroy', ['id' => $artiste->id]) }}"><button type="button" class="btn btn-outline-danger" >Supprimer</button></a></td>
                </tr>
            </table>

        </div>
    </div>
</div>