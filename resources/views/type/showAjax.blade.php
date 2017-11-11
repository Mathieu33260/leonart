<div class="container">
    <div class="row">

        <div class="col-xs-12 col-md-5 col-lg-5 panel panel-default">
            <h3>Type <a href="{{ route('type:show',['id' => $type->id]) }}">{{ $type->libelle }}</a></h3>
            <p>Libelle : {{ $type->libelle }}</p>
            <a href="{{ route('type:edit', ['id' => $type->id]) }}">Modifier</a>
            <a href="{{ route('type:destroy', ['id' => $type->id]) }}">Supprimer</a>
        </div>


    </div>
</div>