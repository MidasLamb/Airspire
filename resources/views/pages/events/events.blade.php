@extends('app')

@section('active-event')
  "active"
@stop

@section('uri')
  events
@stop

{{--*/ $title = 'Events' /*--}}

@section('content')
    <h1>Events</h1>

    @if (count($events) > 0)
      <!-- <ul> -->
      @foreach($events as $event)
        <a href="{{URL::route('event',array('id'=>$event->id))}}">
          <div class="thumbnail">
              <!-- <li> -->
                <div class= "media">
                  <img class="media-object pull-right flag" alt="Flag of {{$event->country_name}}" src="/flags/{{$event->country_flag}}" style="max-width:30%; padding: 0px; margin-bottom: 5px;">
                  <div class= "media-body">
                    <h3>{{ $event->title }}</h3>
                    {{ $event->excerpt }}
                  </div>
                </div>

              <!-- </li> -->
          </div>
        </a>
      @endforeach
      <!-- </ul> -->
    @else
        No events planned.
    @endif

    <div
            class="fb-like"
            data-share="true"
            data-href="http://www.google.com"
            data-width="450"
            data-show-faces="true">
    </div>
@stop
