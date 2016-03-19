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
    <ul>
    @foreach($events as $event)
      <a href="{{URL::route('event',array('id'=>$event->id))}}">
        <div class="thumbnail">
          <li><h3>{{ $event->title }}</h3>{{ $event->description }}</li>
        </div>
      </a>
    @endforeach
    </ul>
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