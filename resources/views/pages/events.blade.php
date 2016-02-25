@extends('app')

@section('active-event', '"active"')

@section('uri', 'events')

@section('title', 'Events')

@section('content')
    <h1>Events</h1>

    @if (count($events) > 0)
    <ul>
    @foreach($events as $event)
        <li><h3>{{ $event->title }}</h3>{{ $event->description }}</li>
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
