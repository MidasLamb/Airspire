@extends('app')


{{--*/ $title = 'Event attendence' /*--}}

@section('fb_functions')

@stop

@section('js_script')

function share(){
  FB.ui({
  method: 'share',
  href: 'https://developers.facebook.com/docs/',
  caption: 'An example caption',
  }, function(response){});
}

@stop

@section('content')
  @if($loggedin)
    @if($succes || $already_attended)
      <h3>Je aanwezigheid is geregistreerd!</h3>
      Deel het met je vrienden!
      <div class="fb-share-button"
    		data-href="http://www.ploegairspire.be/event/{{ $event_id }}"
    		data-layout="button">
  	 </div>
    @else
      @if(!$succes )
        @if(!$in_time)
          <h3>Het duurde te lang voor je op de link hebt geklikt</h3>
          Gelieve de QRCode opnieuw te scannen.
        @else
          <h3>Er is iets misgelopen</h3>
          Gelieve de QRCode opnieuw te scannen.
        @endif
      @endif
    @endif
  @else
    <h3>Log in om je aanwezigheid te registreren</h3>
    <fb:login-button data-size="large" scope="public_profile,email,user_friends" onlogin="logInWithFacebook();">
    </fb:login-button>
  @endif
@stop
