<div class="container">
    <div class="row">

        <div class="col-xs-12 col-md-5 col-lg-5 panel panel-default">
            <h3>Artiste <a href="{{ route('artiste:show',['id' => $artiste->id]) }}">{{ $artiste->nom }} {{ $artiste->prenom }}</a></h3>
            <p>Nom : {{ $artiste->nom }}</p>
            <p>Prénom : {{ $artiste->prenom }}</p>
            <p>Date de naissance : {{ $artiste->dateN }}</p>
            <p>Date de mort : {{ $artiste->dateM }}</p>
            <a href="{{ route('artiste:edit', ['id' => $artiste->id]) }}">Modifier</a>
            <a href="{{ route('artiste:destroy', ['id' => $artiste->id]) }}">Supprimer</a>
        </div>


    </div>
</div>