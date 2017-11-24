<nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <input class="form-control mr-sm-2" id="recherche" placeholder="Recherche" type="text" onkeyup="getSearch()">
                   <a href="{{ route('oeuvre:create') }}"><input type="button" class="btn btn-outline-success center-block" value="Ajouter"></a>
        </form>
</nav>