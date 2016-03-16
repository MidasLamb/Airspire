@extends('app')

@section('active-event')
  "active"
@stop

@section('uri')
  event
@stop

{{--*/ $title = 'Event' /*--}}

@section('content')
  <div class="row">
      <div class="col-md-8">
        <h1>{{ $event->title }}</h1>
        {{ $event->description }}
      </div>
      <div class="col-md-4">
        <div class="thumbnail">
          <img alt="Flag of {{$event->country_name}}" src="/flags/{{$event->country_flag}}" style="width: 250px; position: relative; margin-top: 10px; margin-bottom: 10px;">
          {{ $event->description }}
        </div>
      </div>
    </div>
@stop
