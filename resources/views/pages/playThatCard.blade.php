@extends('app')

@section('active-playthatcard')
  "active"
@stop

{{--*/ $title = 'Play That Card' /*--}}

@section('content')
  <h1> Play That Card </h1>
  <div class= "hidden-xs">
    <div class="row">
      <div class="col-sm-6">
        <h2>Speel je graag eens een kaartspel met vrienden of familie? Vanaf nu kan dit altijd en overal!</h2>
        <div class="col-sm-6">
          <a href="https://itunes.apple.com/app/play-that-card/id922502860?ls=1&amp;mt=8" target="_blank"><img id="header-appstore" src="https://www.playthatcard.com/assets/images/btn_appstore.png" alt="" style="width:100%"></a>
        </div>
        <div class="col-sm-6">
          <a href="https://play.google.com/store/apps/details?id=com.cartamundidigital.bulldog" target="_blank"><img id="header-googleplay" src="https://www.playthatcard.com/assets/images/btn_googleplay.png" alt="" style="width:100%"></a>
        </div>
      </div>
      <div class= "col-sm-6">
        <img src="https://www.playthatcard.com/assets/images/img_headertablet.png" alt="Play That Card - playable on tablets" style="max-width:90%;">
      </div>
    </div>
    <div class="row">
      
    </div>
  </div>


  <div class= "visible-xs">
    <div class= "row">
      <div class="col-md-6">
        <h3>Speel je graag eens een kaartspel met vrienden of familie? Vanaf nu kan dit altijd en overal!</h3>
      </div>
      <div class= "col-md-6">
        <img src="https://www.playthatcard.com/assets/images/img_headertablet.png" alt="Play That Card - playable on tablets" style="max-width:100%;">
      </div>
    </div>
    <div class= "row">
      <div class="col-xs-6">
        <a href="https://itunes.apple.com/app/play-that-card/id922502860?ls=1&amp;mt=8" target="_blank"><img id="header-appstore" src="https://www.playthatcard.com/assets/images/btn_appstore.png" alt="" style="width:100%"></a>
      </div>
      <div class="col-xs-6">
        <a href="https://play.google.com/store/apps/details?id=com.cartamundidigital.bulldog" target="_blank"><img id="header-googleplay" src="https://www.playthatcard.com/assets/images/btn_googleplay.png" alt="" style="width:100%"></a>
      </div>
    </div>
  </div>
@stop
