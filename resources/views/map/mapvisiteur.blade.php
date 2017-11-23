<div class="panel panel-default">

    <div id="map" class="col-lg-12" style="min-height: 500px"></div>
    <div id="test"></div>

    <script>
      @foreach($oeuvres as $oeuvre)
      
    function initMap() {


      var iut = {lat: 44.791346, lng:-0.608779};
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 5,
        center: iut
      });


      @foreach($oeuvres as $oeuvre)

      var infowindow = new google.maps.InfoWindow({});

      var marker = new google.maps.Marker({
        position:{lat: {{$oeuvre->posX}}, lng:{{$oeuvre->posY}} },
        map:map,
        contentString: '{{$oeuvre->nom}}'
      });
      marker.addListener('click', function() {
        infowindow.setContent(this.contentString);
          infowindow.open(map, this);
        });





      @endforeach


    }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWARvkaDg6P7iC40S1FF3BN3uZVKC1UFU&callback=initMap" async defer></script>

</div>
