@extends('app')

{{--*/ $title = 'Home' /*--}}


@section('active-home')
    "active"
@stop

@section('content')
  <div>
    <h1>Welkom op de site van Ploeg Airspire!</h1>
  </div>
    @if($loggedin)
    <div class="thumbnail">
      <div class="row">
        <h3 style="margin-left: 20px; margin-top: 10px;">Aankomende evenementen:</h3>
      </div>
      <div class="row">
        @foreach($upcoming_events as $event)
          <a href="{{URL::route('event',array('id'=>$event->id))}}">
            <div class="col-lg-3">
              <div>
                <img alt="Flag of {{$event->country_name}}" src="/flags/{{$event->country_flag}}" style="width: 200px; position: relative; margin-left: 30px; margin-top: 10px; margin-bottom: 10px;">
              </div>
            </div>
          </a>
        @endforeach
      </div>
    </div>


    <div class="thumbnail">
      <div class="row">
        <h3 style="margin-left: 20px; margin-top: 10px;">Bijgewoonde evenementen: {{ $nb_attended_events }}/{{ $nb_passed_events }}</h3>
      </div>
      <div class="row">
        @foreach($upcoming_events as $event)
          <a href="{{URL::route('event',array('id'=>$event->id))}}">
            <div class="col-lg-3">
              <div>
                <img alt="Flag of {{$event->country_name}}" src="/flags/{{$event->country_flag}}" style="width: 200px; position: relative; margin-left: 30px; margin-top: 10px; margin-bottom: 10px;">
              </div>
            </div>
          </a>
        @endforeach
      </div>
    </div>
    @else

    @endif


@stop
