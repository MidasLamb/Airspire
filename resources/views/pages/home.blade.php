@extends('app')

{{--*/ $title = 'Home' /*--}}


@section('active-home')
    "active"
@stop

@section('content')
  @if(session('acc_dev'))
    <div class="alert alert-danger" role="alert">
      <strong>Je hebt geen toegang tot deze pagina.</strong> Je moet speciale rechten hebben voor toegang tot deze pagina, sorry. We hebben je terug naar de Home-pagina gebracht.
    </div>
  @endif

  @if(session('page_acc'))
    <div class="alert alert-danger" role="alert">
      <strong>De pagina die je probeert te bezoeken bestaat niet.</strong> We hebben je terug naar de Home-pagina gebracht.
    </div>
  @endif

  @if(!$loggedin && date('Y-m-d   H:i:s', mktime(0, 0, 0, 4, 18, 2016)) > date('Y-m-d   H:i:s'))
  <div class="alert alert-info" role="alert">
    <strong><fb:login-button data-size="large" scope="public_profile,email,user_friends" onlogin="logInWithFacebook();">
    </fb:login-button> met facebook VOOR maandag om een extra kans te maken op de prijs.</strong> </br> Als je je minstens eenmaal hebt ingelogd krijg je een extra kans op de prijs. Per evenement dat je bijwoont op maandag/dinsdag krijg je nog een kans.
  </div>
  @endif
  <div>
    <h1>Welkom op de lollige website van PLOEG AIRSPIRE!</h1>
  </div>
  <div class="thumbnail">
    <div style="margin-left: 15px; margin-right: 15px; margin-top: 15px;">
      <p class="lead" style="font-size: 18px;">
        Lolploeg Airspire maakt deel uit van Kiesweek Ekonomika, welke zal doorgaan 18 en 19 april op het Ladeuzeplein te Leuven.
        Hier kan u alle info vinden over wie we zijn en wat we doen. Zo vindt u alles over onze activiteiten onder <a href="/events">Evenementen</a>, over onze lollige stewardessjes en captains onder <a href="/aboutus">About us</a> en nog vele meer!
      </p>
      <p class="lead" style="font-size: 18px;">Kom tijdens dit grootse evenement zeker eens een kijkje nemen op onze stand en geniet van allerlei leuke activiteiten en gadgets die we jullie te bieden hebben!
      </p>
    </div>
    &nbsp; <br>
    <video width="100%" controls>
      <source src="/video/pa.mp4" type="video/mp4">
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
      <h2 style="margin-left: 20px; margin-top: 10px;">Wedstrijden:</h2>
    </div>
    <div class="row">
      <div class="col-xs-12" style="position: relative;">
        <h3 style="margin-left: 10px;">Like and share</h3>
        <div class="lead" style="margin-left:15px;">

            <div style="top: -3px;"
                  class="fb-like"
                  data-share="false"
                  data-href="https://www.facebook.com/PloegAirspire"
                  data-colorscheme="dark"
                  data-show-faces="true"
                  data-layout="button"
                  style="padding: 7px; border-radius: 5px; background-color:white;">Like</div> onze pagina, <div style="top: -3px;" class="fb-share-button" data-href="https://www.facebook.com/PloegAirspire/posts/463969003801243" data-layout="button">deel</div> ons filmpje en maak kans op een tandem skydive! </br>

            <div style="margin-left:3px;">
              <small>
             Mede mogelijk gemaakt door <a href="https://www.skydivecerfontaine.be/nl/">Skydive Cerfontaine</a>. </br>
           </small>
           <br>

            Bekijk hier zeker al eens een voorproefje:
          </div>
        </div>

        <div style="display: flex; justify-content: center; align-items: center; margin-top: 10px;">
          <video width="85%" controls>
            <source src="/video/cerf.mp4" type="video/mp4">
            Your browser does not support the video tag.
          </video>
        </div>
        <h3 style="margin-left: 10px;">Snapchat</h3>
        <p style="margin-left:15px;" class="lead">
          Stuur ons de zotste, grappigste snapchat over je Airspire avonturen en maak kans op een ballonvaart! </br>
          <small>Mede mogelijk gemaakt door <a href="http://skaai.be/">Skaai</a>.</small>
        </p>
      </div>
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
