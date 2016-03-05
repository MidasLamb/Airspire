

@extends('app')


@section('uri')
  {{ $uri }}
@stop

{{--*/ $title = 'Event attendence' /*--}}

@section('content')
<script>
FB.ui({
  method: 'feed',
  link: 'https://developers.facebook.com/docs/',
  caption: 'An example caption',
}, function(response){});
</script>
@stop
