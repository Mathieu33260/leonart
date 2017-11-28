@extends('layout.app')

@section('title', __("Accueil"))
@section('script')
    @parent
    <script type="application/javascript">
        var silver = [
            {
                elementType: 'geometry',
                stylers: [{color: '#f5f5f5'}]
            },
            {
                elementType: 'labels.icon',
                stylers: [{visibility: 'off'}]
            },
            {
                elementType: 'labels.text.fill',
                stylers: [{color: '#616161'}]
            },
            {
                elementType: 'labels.text.stroke',
                stylers: [{color: '#f5f5f5'}]
            },
            {
                featureType: 'administrative.land_parcel',
                elementType: 'labels.text.fill',
                stylers: [{color: '#bdbdbd'}]
            },
            {
                featureType: 'poi',
                elementType: 'geometry',
                stylers: [{color: '#eeeeee'}]
            },
            {
                featureType: 'poi',
                elementType: 'labels.text.fill',
                stylers: [{color: '#757575'}]
            },
            {
                featureType: 'poi.park',
                elementType: 'geometry',
                stylers: [{color: '#e5e5e5'}]
            },
            {
                featureType: 'poi.park',
                elementType: 'labels.text.fill',
                stylers: [{color: '#9e9e9e'}]
            },
            {
                featureType: 'road',
                elementType: 'geometry',
                stylers: [{color: '#ffffff'}]
            },
            {
                featureType: 'road.arterial',
                elementType: 'labels.text.fill',
                stylers: [{color: '#757575'}]
            },
            {
                featureType: 'road.highway',
                elementType: 'geometry',
                stylers: [{color: '#dadada'}]
            },
            {
                featureType: 'road.highway',
                elementType: 'labels.text.fill',
                stylers: [{color: '#616161'}]
            },
            {
                featureType: 'road.local',
                elementType: 'labels.text.fill',
                stylers: [{color: '#9e9e9e'}]
            },
            {
                featureType: 'transit.line',
                elementType: 'geometry',
                stylers: [{color: '#e5e5e5'}]
            },
            {
                featureType: 'transit.station',
                elementType: 'geometry',
                stylers: [{color: '#eeeeee'}]
            },
            {
                featureType: 'water',
                elementType: 'geometry',
                stylers: [{color: '#c9c9c9'}]
            },
            {
                featureType: 'water',
                elementType: 'labels.text.fill',
                stylers: [{color: '#9e9e9e'}]
            }
        ];

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
                    'class','ml-3 p-1 pl-4 pr-4 font-weight-bold text-secondary dark border border-secondary radius nodeco'
                );
            } else {
                document.getElementById('btnSuivre').setAttribute(
                    'class','ml-3 p-1 pl-4 pr-4 font-weight-bold text-dark white-grey border-0 radius nodeco'
                );
            }
        }
        function initMap() {

            var iut = {lat: 44.791346, lng:-0.608779};
            var map = new google.maps.Map(document.getElementById('map_index'), {
                zoom: 14,
                center: iut
            });
            map.setOptions({styles: silver});
            var marker = new google.maps.Marker({
                position: iut,
                map: map
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWARvkaDg6P7iC40S1FF3BN3uZVKC1UFU&callback=initMap" async defer></script>
@endsection
@section('content')
    <section>
        <div class="flex-center position-ref full-height">

            <div class="top-right">
                <nav class="navbar navbar-expand-lg navbar-light bg-white">
                    <a class="navbar-brand" href="#"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        @guest
                            <div class="navbar-nav links ">
                                <a class="font-weight-bold nav-item nav-link" href="{{ route('login') }}">Connexion</a>
                                <a class="font-weight-bold nav-item nav-link" href="{{ route('register') }}">S'enregistrer</a>
                            </div>
                            @else

                                <div class="navbar-nav links ">
                                    @if(!Auth::user()->visiteur && !Auth::user()->admin)
                                        <a class="font-weight-bold nav-item nav-link" href="{{ route('user:home') }}">
                                            {{ Auth::user()->name }}
                                        </a>
                                    @endif
                                    @if(Auth::user()->visiteur && !Auth::user()->admin)
                                        <a class="font-weight-bold nav-item nav-link" href="{{ route('guestuser:home') }}">
                                            {{ Auth::user()->name }}
                                        </a>
                                    @endif
                                    @if(Auth::user()->admin)
                                        <a class="font-weight-bold nav-item nav-link" href="{{ route('admin:manage') }}">
                                            Gérer les droits
                                        </a>
                                    @endif

                                    <a class="font-weight-bold nav-item nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                                @endguest
                    </div>
                </nav>
            </div>


            <div class="content">
                <div class="title m-b-md">
                    <a href="{{ route('page:index') }}"><img src="{{ asset('/images/leonart.svg') }}" alt="{{ __("Logo Leonart") }}" ></a>
                </div>

                <div class="linksUnder">
                    <h4 class="text-success">L'art dans la poche</h4>

                </div>
            </div>
        </div>
    </section>
    <!---------------------------------------------------------->
    <section>
        <div class="position-ref dark">
            <div class="container">
                <div class="row justify-content-center">
                    <h2 class="title text-uppercase text-light text-center col-lg-12 mt-4 mb-4">Présentation</h2>
                    <div class="line mb-3"></div>
                    <div class="row justify-content-center mt-3 mb-3">
                        <p class="col-md-8 text-light text-center">Nous sommes une start-up avec une idée originale qui
                            souhaite révolutionner l'art en apportant une touche de modernité.</p>
                        <p class="col-md-8 text-light text-center ">En effet, Leonart vous offre une application web capable
                            de faire revivre à vos visiteurs les oeuvres d'arts qu'ils ont déjà découvert, en réalité augmentée.</p>
                    </div>


                    <div class="row justify-content-center">
                        <div class="card col-md-3 col-sm-8  mb-4 mr-4 shadow">
                            <div class="row justify-content-center">
                                <a href="{{ route('page:map') }}" class="text-center"><img class="card-img-top mt-3" src="{{ asset('/images/Pins_maps.svg') }}" alt="Pins map"></a>
                            </div>
                            <div class="card-body text-dark">
                                <h4 class="card-title text-center font-weight-bold">Carte iBeacons</h4>
                                <p class="card-text text-center">Découvrer l'ensemble des oeuvres et monuments à voir ou à revoir.</p>
                            </div>
                        </div>

                        <div class="card col-md-3 col-sm-8 mb-4 mr-4 shadow">
                            <div class="row justify-content-center">
                                @guest
                                    <a href="#" class="text-center"><img class="card-img-top mt-3" src="{{ asset('/images/MonCompte.svg') }}" alt="Mon compte"></a>
                                    @else
                                        @if(!Auth::user()->visiteur && !Auth::user()->admin)
                                            <a href="{{ route('user:home') }}" class="text-center"><img class="card-img-top mt-3" src="{{ asset('/images/MonCompte.svg') }}" alt="Mon compte"></a>

                                        @endif

                                        @if(Auth::user()->visiteur && !Auth::user()->admin)
                                            <a href="{{ route('guestuser:home') }}" class="text-center"><img class="card-img-top mt-3" src="{{ asset('/images/MonCompte.svg') }}" alt="Mon compte"></a>

                                        @endif

                                        @if(Auth::user()->admin)
                                            <a href="{{ route('admin:manage') }}" class="text-center"><img class="card-img-top mt-3" src="{{ asset('/images/MonCompte.svg') }}" alt="Mon compte"></a>

                                        @endif
                                        @endguest
                            </div>
                            <div class="card-body text-dark">
                                <h4 class="card-title text-center font-weight-bold">Compte</h4>
                                <p class="card-text text-center">Acceder à l'ensemble des details de votre compte, vos oeuvres, vos artistes,&nbsp;etc.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!---------------------------------------------------------->
    <section id=iBeacon>
        <div class="position-ref">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <img class="img-fluid" src="{{ asset('/images/Ibeacon.png') }}" alt="iBeacon">
                    </div>
                    <div class="texte align-self-center col-md-6 text-dark  ">
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
        <div class="row">
            <div class="col-md-12">
                <div class="flex-center  dark">
                    <h2 class="text-light text-center pt-2 pb-2">Prolongez votre visite jusqu'à votre poche !</h2>
                </div>
            </div>
        </div>
    </section>
    <!-------------------Phone------------------------->
    <section id=phone>
        <div class="position-ref">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="texte align-self-center col-md-6 p-3 pr-5  text-dark border-yellow-right">
                        <p class="text-right">Notre application proposera à vos visiteurs une expérience immersive
                            dans l'art grâce à la réalité augmentée.</p>
                        <p class="text-right">Une fois découverte, l'oeuvre d'art sera disponible à la consultation
                            dans le smartphone.</p>
                    </div>
                    <div class="col-md-6 ">
                        <img class="img-fluid" src="{{ asset('/images/phone.png') }}" alt="Carte et smartphone">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-------------------Contact---------------------->
    <section>
        <div class="position-ref dark">
            <div class="container-fluid ">
                <div class="row d-flex align-items-center">
                    <div class="col-md-6 pl-5">
                        <div class="row ">
                            <h4 class="text-light text-center col-lg-12 mt-3">Nous contacter :</h4>
                        </div>
                        <div class="row ">
                            <h5 class="text-light">Nos bureaux </h5>
                        </div>
                        <div class="row ">
                            <p class="text-light">Adresse : 15, rue Naudet, 33175 Gradignan  </p>
                        </div>
                        <div class="row ">
                            <p class="text-light">Email : contact@leon-art.fr</p>
                        </div>
                        <div class="row justify-content-center mb-3">
                            <a id="btnContact" href="{{ route('page:contact') }}" class=" p-1 pl-4 pr-4 font-weight-bold
                          text-dark white-grey border-0 radius nodeco" onmouseover="animationBtnContact(true);"
                               onmouseout="animationBtnContact(false)">Nous contacter</a>
                        </div>
                    </div>
                    <div class="col-md-6 map_container">
                        <div id="map_index"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
