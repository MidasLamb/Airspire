@extends('app')

@section('active-playthatcard')
  "active"
@stop

{{--*/ $title = 'Play That Card' /*--}}

@section('content')
  <h1> Play That Card </h1>
  <!-- Computer -->
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
    <div class="row" style="height: 10px;"></div>
    <div class="row" style="background-color: #ece6e6; border-radius: 7px;">
      <div style="margin-top: 20px; margin-left: 20px;">
        <p class="lead">
          Voor meer informatie over <b>Play That Card</b>, klik <b><a href="https://www.playthatcard.com/nl_BE/?#discover" target="_blank">hier</a></b>!</p>
        <p class="lead">
          Om een reis naar <b>Cyprus</b> te winnen, klik <b><a href="https://www.playthatcard.com/app/competition-jetair/visit?&locale=nl_be/" target="_blank">hier</a></b>!</p>
      </div>
    </div>
  </div>


  <!-- mobile -->
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

    <div class="row" style="height: 20px;"></div>
    <div class="row" style="background-color: #ece6e6; border-radius: 7px;">
      <div style="margin-top: 20px; margin-left: 20px;">
        <p class="lead">
          Voor meer informatie over <b>Play That Card</b>, klik <b><a href="https://www.playthatcard.com/nl_BE/?#discover" target="_blank">hier</a></b>!</p>
        <p class="lead">
          Om een reis naar <b>Cyprus</b> te winnen, klik <b><a href="https://www.playthatcard.com/app/competition-jetair/visit?&locale=nl_be/" target="_blank">hier</a></b>!</p>
      </div>
    </div>

  </div>
@stop
