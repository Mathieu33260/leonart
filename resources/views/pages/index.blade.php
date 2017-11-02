@extends('layout.app')

@section('title', __("Accueil"))
@section('script')
    @parent
    <script type="application/javascript">
        function animationBtnContact(hover) {
            if(hover)
            {
                document.getElementById('btnContact').setAttribute(
                    'class','mr-3 p-1 pl-4 pr-4 font-weight-bold text-secondary dark border border-secondary radius nodeco'
                );
            } else {
                document.getElementById('btnContact').setAttribute(
                    'class','mr-3 p-1 pl-4 pr-4 font-weight-bold text-dark white-grey border-0 radius nodeco'
                );
            }
        }
        function animationBtnSuivre(hover) {
            if(hover)
            {
                document.getElementById('btnSuivre').setAttribute(
                    'class','ml-3 p-1 pl-4 pr-4 font-weight-bold text-dark white-grey border-0 radius nodeco'
                );
            } else {
                document.getElementById('btnSuivre').setAttribute(
                    'class','ml-3 p-1 pl-4 pr-4 font-weight-bold text-secondary dark border border-secondary radius nodeco'
                );
            }
        }
    </script>
@endsection
@section('content')
<section>
<div class="flex-center position-ref full-height">

    <div class="top-right links">


        @guest
            <a class="p-3" href="{{ route('login') }}">Login</a>
            <a class="p-3" href="{{ route('register') }}">Register</a>
            @else
                    <a href="{{ route('user:profil:edit') }}"  role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                @endguest

    </div>


    <div class="content">
        <div class="title m-b-md">
            <img src="{{ asset('/images/leonart.svg') }}" alt="{{ __("Logo Leonart") }}" >
        </div>

        <div class="linksUnder">
            <a class="text-success" href="">L'art dans la poche</a>

        </div>
    </div>
</div>
</section>
<!---------------------------------------------------------->
<section>
<div class="flex-center position-ref full-height dark">


    <div class="container">
        <div class="row justify-content-center">
            <h2 class="text-uppercase text-light text-center col-lg-12">Présentation</h2>
            <p class="text-light col-lg-8 text-center font-weight-bold">_____</p>
            <p class="text-light col-lg-6 text-center font-weight-bold mr-1 ml-1">Nous sommes une start-up avec une idée originale qui
                souhaite révolutionner l'art en apportant une touche de modernité.</p>
            <p class="text-light col-lg-6 text-center font-weight-bold">En effet, Leonart vous offre une application web capable
                de faire revivre à vos visiteurs les oeuvres d'arts qu'ils ont déjà découvert, en réalité augmentée.</p>

            <div class="row justify-content-center mt-4">

                <div class="card col-lg-3 mr-4 shadow">
                    <img class="card-img-top" src="..." alt="Card image cap">
                    <div class="card-body text-dark font-weight-bold">
                        <h4 class="card-title text-center font-weight-bold">Carte iBeacons</h4>
                        <p class="card-text text-center">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>

                <div class="card col-lg-3 ml-4 shadow">
                    <img class="card-img-top" src="..." alt="Card image cap">
                    <div class="card-body text-dark font-weight-bold">
                        <h4 class="card-title text-center font-weight-bold">Compte</h4>
                        <p class="card-text text-center">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
</section>
<!---------------------------------------------------------->
<section>
<div class="flex-center position-ref full-height">



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 ml-3">
                <img src="" alt="iBeacon">
            </div>
            <div class="col-lg-5 mr-3 text-dark font-weight-bold">
                <p>L'iBeacon, est une balise de géolocalisation bluetooth précise, qui permet de détecter
                    et d'intéragir avec un visiteur.<br>
                    Il peut par exemple lui envoyer des informations sur une oeuvre.</p>
                <p>La balise iBeacon est discrète est peut se cacher derrière une oeuvre.</p>
            </div>
        </div>
    </div>
</div>
</section>
<!---------------------------------------------------------->
<section>
<div class="flex-center position-ref bandeau-height dark">



    <div class="container">
        <div class="row justify-content-center">
            <h2 class="text-light text-center col-lg-12 p-4">
                Prolongez votre visite jusqu'à votre poche !
            </h2>
        </div>
    </div>
</div>
</section>
<!-------------------Phone------------------------->
<section>
<div class="flex-center position-ref full-height">



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 p-3 pr-5 mr-3 text-dark font-weight-bold border-yellow-right">
                <p class="text-right">Notre application proposera à vos visiteurs une expérience immersive
                    dans l'art grâce à la réalité augmentée.</p>
                <p class="text-right">Une fois découverte, l'oeuvre d'art sera disponible à la consultation
                    dans le smartphone.</p>
            </div>
            <div class="col-lg-5 ml-5">
                <img src="" alt="Carte et smartphone">
            </div>
        </div>
    </div>
</div>
</section>
<!-------------------Contact---------------------->
<section>
<div class="flex-center position-ref middle-height dark">



    <div class="container">
        <div class="row justify-content-center">
            <h2 class="text-light text-center col-lg-12">Contactez nous</h2>
            <p class="text-light text-center col-lg-4">zeurhgv paieuvhaps hvapihvfa pkHFVLKDSh vpBDSF OKJSBd vlkQBDSVL QBSDLKJBVQ SDLJHBQSd kvc bql bvclS DBCV</p>
        </div>

        <div class="row justify-content-center">
            <a id="btnContact" href="" class="mr-3 p-1 pl-4 pr-4 font-weight-bold
                    text-dark white-grey border-0 radius nodeco" onmouseover="animationBtnContact(true);"
               onmouseout="animationBtnContact(false)">Contact</a>

            <a id="btnSuivre" href="" class="ml-3 p-1 pl-4 pr-4 text-secondary font-weight-bold
                    dark border border-secondary radius nodeco" onmouseover="animationBtnSuivre(true);"
               onmouseout="animationBtnSuivre(false)">Suivre</a>

        </div>
    </div>
</div>
</section>
@endsection