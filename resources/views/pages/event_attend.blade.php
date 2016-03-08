@extends('app')


{{--*/ $title = 'Event attendence' /*--}}

@section('fb_functions')
  share();
@stop

@section('js_script')
<script>
function share(){
  FB.ui({
  method: 'share',
  href: 'https://developers.facebook.com/docs/',
  caption: 'An example caption',
  display: 'page',
  }, function(response){});
}
</script>
@stop

@section('content')

@stop
