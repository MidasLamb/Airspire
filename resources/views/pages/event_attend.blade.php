

@extends('app')


@section('uri')
  {{ $uri }}
@stop

{{--*/ $title = 'Event attendence' /*--}}

@section('fb_functions')
  share();
@stop

@section('js_function')
<script>
function share() = FB.ui({
  method: 'share',
  link: 'https://developers.facebook.com/docs/',
  caption: 'An example caption',
}, function(response){});
</script>
@stop
