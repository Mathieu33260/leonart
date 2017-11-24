<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12 panel panel-default">
            <table class="table">
                <th><h3>Type :</h3></th>
                <th><h3><a href="{{ route('type:show',['id' => $type->id]) }}">{{ $type->libelle }}</a></h3></th>
                <tr>
                    <td><p>Libelle : {{ $type->libelle }}</p></td>
                </tr>
                <tr>
                    <td><a href="{{ route('type:edit', ['id' => $type->id]) }}"><button type="button" class="btn btn-outline-info">Modifier</button></a></td>
                    <td><a href="{{ route('type:destroy', ['id' => $type->id]) }}"><button type="button" class="btn btn-outline-danger" >Supprimer</button></a></td>
                </tr>
            </table>
        </div>
    </div>
</div>