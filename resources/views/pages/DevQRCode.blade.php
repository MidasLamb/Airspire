@extends('app')

{{--*/ $title = 'Developer QR Code' /*--}}

@section('uri')
    QRCode
@stop

@section('content')
  <ul>
  @foreach($events as $event)
    <li><a href="/QRCode/{{ $event->id }}"> {{ $event->title }} </a></li>
  @endforeach
  </ul>
@stop
