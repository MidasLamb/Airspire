@extends('app')

{{--*/ $title = 'Home' /*--}}


@section('active-home')
    "active"
@stop

@section('content')
  <div>
    <h1>>Welkom op de lollige website van PLOEG AIRSPIRE!</h1>
  </div>
  <div class="thumbnail">
    <div style="margin-left: 15px; margin-right: 15px;"> 
      <p class="lead" style="font-size: 18px;">
        Lolploeg Airspire maakt deel uit van Kiesweek Ekonomika, welke zal doorgaan 18 en 19 april op het Ladeuzeplein te Leuven.
        Hier kan u alle info vinden over wie we zijn en wat we doen. Zo vindt u alles over onze activiteiten onder <a href="/events">‘events’</a>, over onze lollige stewardessjes en captains onder <a href="/aboutus">‘about us’</a> en nog vele meer!
      </p>
      <p class="lead" style="font-size: 18px;">Kom tijdens dit grootse evenement zeker eens een kijkje nemen op onze stand en geniet van allerlei leuke activiteiten en gadgets die we jullie te bieden hebben!
      </p>
    </div>
    &nbsp; <br>
    <video width="100%" controls autoplay>
      <source src="/video/Braumix.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>
  </div>
  <div class="thumbnail">
    <div class="row">
      <h3 style="margin-left: 20px; margin-top: 10px;">Actieve evenementen:</h3>
    </div>
    <div class="row">
      @if(count($active_events) > 0)
        @foreach($active_events as $event)
          <a href="{{URL::route('event',array('id'=>$event->id))}}">
            <div class="col-md-3 col-xs-6">
              <div>
                <img class="flag" alt="Flag of {{$event->country_name}}" src="/flags/{{$event->country_flag}}" style="max-width: 90%; margin-bottom: 10px; margin-left: 5%; margin-right: 5%;">
              </div>
            </div>
          </a>
        @endforeach
      @else
      <div class="col-md-12">
        <p style="margin-left:15px;">Spijtig genoeg zijn er nu geen evenementen bezig :( </p>
      </div>
      @endif
    </div>
  </div>

    <div class="thumbnail">
      <div class="row">
        <h3 style="margin-left: 20px; margin-top: 10px;">Aankomende evenementen:</h3>
      </div>
      <div class="row">
        @if(count($upcoming_events) > 0)
          @foreach($upcoming_events as $event)
            <a href="{{URL::route('event',array('id'=>$event->id))}}">
              <div class="col-md-3 col-xs-6">
                <div>
                  <img class="flag" alt="Flag of {{$event->country_name}}" src="/flags/{{$event->country_flag}}" style="max-width: 90%; margin-bottom: 10px; margin-left: 5%; margin-right: 5%;">
                </div>
              </div>
            </a>
          @endforeach
        @else
          <div class="col-md-12">
            <p style="margin-left:15px;">Er komen geen evenementen meer :( </p>
          </div>
        @endif
      </div>
    </div>

  @if($loggedin)
    <div class="thumbnail">
      <div class="row">
        <h3 style="margin-left: 20px; margin-top: 10px;">Bijgewoonde evenementen: {{ $nb_attended_events }}/{{ $nb_passed_events + $nb_active_events}}</h3>
      </div>
      <div class="row">
        @foreach($attended_events as $event)
          <a href="{{URL::route('event',array('id'=>$event->id))}}">
            <div class="col-md-3 col-xs-6">
              <div>
                <img class="flag" alt="Flag of {{$event->country_name}}" src="/flags/{{$event->country_flag}}" style="max-width: 90%; margin-bottom: 10px; margin-left: 5%; margin-right: 5%;">
              </div>
            </div>
          </a>
        @endforeach
      </div>
    </div>
    @else

    @endif

    @if(count($passed_events)>0)
      <div class="thumbnail">
        <div class="row">
          <h3 style="margin-left: 20px; margin-top: 10px;">Afgelopen evenementen:</h3>
        </div>
        <div class="row">
          @foreach($passed_events as $event)
            <a href="{{URL::route('event',array('id'=>$event->id))}}">
              <div class="col-md-3 col-xs-6">
                <div>
                  <img class="flag" alt="Flag of {{$event->country_name}}" src="/flags/{{$event->country_flag}}" style="max-width: 90%; margin-bottom: 10px; margin-left: 5%; margin-right: 5%;">
                </div>
              </div>
            </a>
          @endforeach
        </div>
      </div>
    @endif


@stop
