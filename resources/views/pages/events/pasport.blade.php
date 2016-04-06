@extends('app')

{{--*/ $title = 'Paspoort' /*--}}

@section('css')
  .hoverable:hover{
    cursor: pointer; cursor: hand;
  }
@stop

@section('js_script')
  function toggleVisible(id){
    var nowArray = document.getElementById(id).className.split(" ");
    document.getElementById(id).className = "";
    nowArray.forEach(function(entry) {
      if (entry == "hidden"){
        document.getElementById(id).className += "visible";
      }else if (entry == "visible"){
        document.getElementById(id).className += "hidden";
      } else {
        document.getElementById(id).className += entry;
      }
    });
  }
@stop

@section('active-pasport')
  "active"
@stop

@section('content')
  <div>
    <h1>Jouw Paspoort</h1>
    <h3> Aantal aanwezigheden: {{ count($evats)}} / {{ count($passed_events)}} </h3>
  </div>
  <div class="thumbnail hoverable" onclick="toggleVisible('uitleg')">
    <div style="margin-left: 15px;">
      <h3>Uitleg: <span class="caret"></span></h3>
      <div id="uitleg" class="hidden ">
        <div style="margin-left: 5px;"
          <p>
            Welkom bij je eigen unieke paspoort! Hieronder vind je een overzicht terug van alle activiteiten.
          </p>
          <p>
            Het doel is om aan zoveel mogelijk activiteiten deel te nemen. Des te meer activiteiten je meedoet, des te meer kans je maakt op een fantastische prijs!
          </p>
          <p>
            Elk land bevat één activiteit, deze zijn elk gelinkt aan een unieke QR code die je kan scannen op de activiteiten. Wanneer je een land bezocht hebt en dus hebt deelgenomen aan die specifieke activiteit, wordt de vlag hieronder bestempeld. Hopelijk kan jij met ons de wereldreis voltooien!
          </p>
          <p>
            Veel succes namens ploeg Airspire
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="thumbnail hoverable" onclick="toggleVisible('stats')">
    <div style="margin-left: 15px;">
      <h3>Stats: <span class="caret"></span></h3>
      <div id="stats" class="hidden ">
        <ul>
          <li> Jouw aanwezigheden op events: {{ count($evats)}} / {{ count($passed_events)}}
          <li> Aantal gebruikers met meer aanwezigheden op evenementen: {{ $users_with_more_att }}</li>
          <li> Aantal personen die op alle events aanwezig zijn geweest: {{ $users_with_all_att }}</li>
        </ul>
      </div>
    </div>
  </div>
  <div class="row">
    @foreach($passed_events as $event)
      <a href="{{URL::route('event',array('id'=>$event->id))}}">
        <div class="col-lg-4">
          <div class="thumbnail">
            <div>
              <img class="flag" alt="Flag of {{$event->country_name}}" src="/flags/{{$event->country_flag}}" style="width: 200px; position: relative; margin-left: 30px; margin-top: 10px;">

              @if(in_array($event->id, $evats))
                <img alt="Flag of {{$event->country_name}}" src="/flags/stamps.png" style="width: 200px; position: absolute; top: 15px; left: 50px;">
              @endif
            </div>
            <div style="margin-left: 30px;">
              <h3>{{ $event->title }}</h3>
            </div>
          </div>
        </div>
      </a>
    @endforeach
  </div>
@stop
