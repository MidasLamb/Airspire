@extends('app')

{{--*/ $title = 'Standje' /*--}}

@section('active-booth')
  "active"
@stop

@section('content')
  <h1>Info over het standje</h1>
  <div class="row">
    <div class="col-xs-3">
      <h2>Locatie:</h2>
    </div>
    <div class="col-xs-9">
      <div class="thumbnail">
        <h3>Kaart:</h3>
        <div id="googlemap" style="width: 100%; height: 400px"></div>
      </div>
      <div>
    </div>
  </div>

  </div>
    <script>
      var map;
      var langAndLong = {lat: 0, lng: 0};
      function initMap() {
        map = new google.maps.Map(document.getElementById('googlemap'), {
          center: langAndLong,
          zoom: 8
          });

        var marker = new google.maps.Marker({
          position: langAndLong,
          map: map,
          title: 'Standje Ploeg Airspire',
          animation: google.maps.Animation.DROP,
        });
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAz4Ht8RxQaj_P843W8Rq17bX382D81HqY&callback=initMap"
    async defer></script>
@stop
