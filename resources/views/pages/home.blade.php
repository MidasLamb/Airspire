@extends('app')

{{--*/ $title = 'Home' /*--}}


@section('active-home')
    "active"
@stop

@section('content')
  <div>
    <h1>Welkom op de site van Ploeg Airspire!</h1>
  </div>

  <h2> Ons promo-filmpje! </h2>
  <div class="thumbnail">

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
            <div class="col-lg-3">
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
              <div class="col-md-3">
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
        @foreach($upcoming_events as $event)
          <a href="{{URL::route('event',array('id'=>$event->id))}}">
            <div class="col-lg-3">
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
              <div class="col-lg-3">
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
