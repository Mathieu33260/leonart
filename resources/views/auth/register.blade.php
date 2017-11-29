@extends('layout.navbarFront')
@section('title', __("S'enregistrer"))
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <h2 class="text-dark text-center col-lg-12 mt-4 mb-4" >S'enregistrer</h2>
    </div>
    <div class="row justify-content-center">
      <div class="col-xs-12 col-md-9 col-lg-9 panel panel-default ">
        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
          {{ csrf_field() }}
          <div class="panel-body">
            <div class="row justify-content-center">
              <div class="col-xs-12 col-md-7 ">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name" class="control-label">Nom</label>
                  <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                  @if ($errors->has('name'))
                    <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
                  @endif
                </div>
              </div>
              <div class="col-xs-12 col-md-7">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label for="email" class="control-label">Adresse mail</label>
                  <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                  @if ($errors->has('email'))
                    <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              <div class="col-xs-12 col-md-7">
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <label for="password" class="control-label">Mot de passe</label>
                  <input id="password" type="password" class="form-control" name="password" required>
                  @if ($errors->has('password'))
                    <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
                  @endif
                </div>
              </div>
              <div class="col-xs-12 col-md-7">
                <div class="form-group">
                  <label for="password-confirm" class="control-label">Confirmation du mot de passe</label>
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
              </div>
              <div class="col-xs-12 col-md-7">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input">
                    En cochant cette case, vous acceptez l'intégralité des <a href="#" data-toggle="modal" data-target=".modal-cgu"
                    aria-labelledby="cguModal" aria-hidden="true">conditions générales d'utilisation</a>
                </label>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">
                    S'enregistrer
                  </button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="modal fade modal-cgu" tabindex="-1" role="dialog" aria-labelledby="cguModal" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="row justify-content-center">
            <h4 class="mt-3 center"> Conditions Générales d'Utilisation </h4>
            <div class="row col-12 justify-content-center">
              <div class="modal-body">
                  Le présent document a pour objet de définir les modalités et conditions dans lesquelles d'une part, Leonart,ci-après dénommé l'EDITEUR,
                  met à la disposition de ses utilisateurs le site, et les services disponibles sur le site et d'autre part,
                  la manière par laquelle l'utilisateur accède au site et utilise ses services.
                  Toute connexion au site est subordonnée au respect des présentes conditions.
                  Pour l'utilisateur, le simple accès au site de l'EDITEUR à l'adresse URL suivante leon-art.fr implique
                  l'acceptation de l'ensemble des conditions décrites ci-après.

                  <h4 class="mt-3 center">Propriété intellectuelle</h4>

                  Aucune reproduction, même partielle prévue à l'article L.122-5 du Code de la propriété intellectuelle,
                  ne peut être faite de ce site sans l'autorisation du directeur de publication.

                  <h4 class="mt-3 center">Liens hypertextes</h4>

                  Le site leon-art.fr peut contenir des liens hypertextes vers d'autres sites présents sur le réseau Internet.
                  Les liens vers ces autres ressources vous font quitter le site leon-art.fr
                  Il est possible de créer un lien vers la page de présentation de ce site sans autorisation expresse de l'EDITEUR.
                  Aucune autorisation ou demande d'information préalable ne peut être exigée par l'éditeur à l'égard d'un site qui souhaite établir un
                  lien vers le site de l'éditeur. Il convient toutefois d'afficher ce site dans une nouvelle fenêtre du navigateur. Cependant, l'EDITEUR se réserve le
                  droit de demander la suppression d'un lien qu'il estime non conforme à l'objet du site leon-art.fr

                  <h4 class="mt-3 center">Accès au site</h4>

                  L'éditeur s'efforce de permettre l'accès au site 24 heures sur 24, 7 jours sur 7, sauf en cas de force majeure ou d'un événement hors du contrôle de l'EDITEUR,
                  et sous réserve des éventuelles pannes et interventions de maintenance nécessaires au bon fonctionnement du site et des services.
                  Par conséquent, l'EDITEUR ne peut garantir une disponibilité du site et/ou des services,
                  une fiabilité des transmissions et des performances en terme de temps de réponse ou de qualité.
                  Il n'est prévu aucune assistance technique vis à vis de l'utilisateur que ce soit par des moyens électronique ou téléphonique.
                  La responsabilité de l'éditeur ne saurait être engagée en cas d'impossibilité d'accès à ce site et/ou d'utilisation des services.
                  Par ailleurs, l'EDITEUR peut être amené à interrompre le site ou une partie des services, à tout moment sans préavis, le tout sans droit à indemnités.
                  L'utilisateur reconnaît et accepte que l'EDITEUR ne soit pas responsable des interruptions, et des conséquences qui peuvent en découler pour l'utilisateur ou tout tiers.

                  <h4 class="mt-3 center">Modification des conditions d'utilisation</h4>

                  L'EDITEUR se réserve la possibilité de modifier, à tout moment et sans préavis, les présentes conditions
                  d'utilisation afin de les adapter aux évolutions du site et/ou de son exploitation.

                  <h4 class="mt-3 center">Règles d'usage d'Internet</h4>

                  L'utilisateur déclare accepter les caractéristiques et les limites d'Internet, et notamment reconnaît que :
                  L'EDITEUR n'assume aucune responsabilité sur les services accessibles par Internet et n'exerce aucun contrôle de quelque forme que ce soit sur
                  la nature et les caractéristiques des données qui pourraient transiter par l'intermédiaire de son centre serveur.
                  L'utilisateur reconnaît que les données circulant sur Internet ne sont pas protégées notamment contre les détournements éventuels. La présence du logo institue une présomption
                  simple de validité. La communication de toute information jugée par l'utilisateur de nature sensible ou confidentielle se fait à ses risques et périls.
                  L'utilisateur reconnaît que les données circulant sur Internet peuvent être réglementées en termes d'usage ou être protégées par un droit de propriété.
                  L'utilisateur est seul responsable de l'usage des données qu'il consulte, interroge et transfère sur Internet.
                  L'utilisateur reconnaît que l'EDITEUR ne dispose d'aucun moyen de contrôle sur le contenu des services accessibles sur Internet.

                  <h4 class="mt-3 center">Droit applicable</h4>

                  Tant le présent site que les modalités et conditions de son utilisation sont régis par le droit français, quel que soit le lieu d'utilisation.
                  En cas de contestation éventuelle, et après l'échec de toute tentative de recherche d'une solution amiable,
                  les tribunaux français seront seuls compétents pour connaître de ce litige.
                  Pour toute question relative aux présentes conditions d'utilisation du site, vous pouvez nous écrire à l'adresse suivante : leonartfr@gmail.com.

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
