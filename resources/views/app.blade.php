<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Airspire|{{ $title }}</title>

    <meta property="og:url"                content="http://www.ploegairspire.be" />
    <meta property="og:type"               content="website" />
    <meta property="og:title"              content="Ploeg Airspire" />
    <meta property="og:description"        content="De website van Ploeg Airspire!" />
    <meta property="og:image"              content="http://www.ploegairspire.be/images/Airspire_wit.png" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/scripts/bootstrap/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">



    <style>

        .cookie{
          position:fixed;
          bottom: 0px;
          width: 100%;
          background-color:#ece6e6;
          box-shadow: 0px 0px 2px 2px #000000;
        }

        .partner-col{
          height: 80px;
          position: relative;
        }

        .partner {
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          max-width: 85%;
          max-height: 90%;
        }

        .flag {
           box-shadow: 0px 0px 2px 2px #ece6e6;
        }

        html {
          position: relative;
          min-height: 100%;
        }

        body {
          /* Margin bottom by footer height */
          margin-bottom: 300px;
        }

        .footer {
          position: absolute;
          bottom: 0;
          width: 100%;
          background-color: #ece6e6;
          box-shadow: 0px 0px 6px 6px #ece6e6;
          /* Set the fixed height of the footer here */
          height: 200px;

        }

        #profilepic {
            max-height: 35px;
            max-width: 35px;
            margin-top:-100%;
            margin-bottom:-100%;
            margin-right: 0;

        }
        .social-media {
            min-width: 250px;
        }

        /* Set the fixed height of the footer here */

        @{{ Square navbar }}
        .navbar {
          border-radius: 0 !important;
        }

        @{{ Color section }}
        .navbar-default {
          background-color: #1351b7;
          border-color: #0f3f8e;
        }
        .navbar-default .navbar-brand {
          color: #ecf0f1;
        }
        .navbar-default .navbar-brand:hover,
        .navbar-default .navbar-brand:focus {
          color: #ecdbff;
        }
        .navbar-default .navbar-text {
          color: #ecf0f1;
        }
        .navbar-default .navbar-nav > li > a {
          color: #ecf0f1;
        }
        .navbar-default .navbar-nav > li > a:hover,
        .navbar-default .navbar-nav > li > a:focus {
          color: #ecdbff;
        }
        .navbar-default .navbar-nav > .active > a,
        .navbar-default .navbar-nav > .active > a:hover,
        .navbar-default .navbar-nav > .active > a:focus {
          color: #ffffff;
          background-color: #0f3f8e;
        }
        .navbar-default .navbar-nav > .open > a,
        .navbar-default .navbar-nav > .open > a:hover,
        .navbar-default .navbar-nav > .open > a:focus {
          color: #ecdbff;
          background-color: #0f3f8e;
        }
        .navbar-default .navbar-toggle {
          border-color: #0f3f8e;
        }
        .navbar-default .navbar-toggle:hover,
        .navbar-default .navbar-toggle:focus {
          background-color: #0f3f8e;
        }
        .navbar-default .navbar-toggle .icon-bar {
          background-color: #ecf0f1;
        }
        .navbar-default .navbar-collapse,
        .navbar-default .navbar-form {
          border-color: #ecf0f1;
        }
        .navbar-default .navbar-link {
          color: #ecf0f1;
        }
        .navbar-default .navbar-link:hover {
          color: #ecdbff;
        }

        @media (max-width: 767px) {
          .navbar-default .navbar-nav .open .dropdown-menu > li > a {
            color: #ecf0f1;
          }
          .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover,
          .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus {
            color: #ecdbff;
          }
          .navbar-default .navbar-nav .open .dropdown-menu > .active > a,
          .navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover,
          .navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus {
            color: #ecdbff;
            background-color: #0f3f8e;
          }
        }



        @{{ Sidebar color section }}

        .well {
          background-color: #1351b7;
          border-color: #0f3f8e;
          color: white;
        }

        @yield('css')
    </style>


</head>

<body>

<script>
    var loggedInFB = {{ json_encode($loggedin) }};

    var stringref = String(window.location.href);
    var lastIndex = stringref.indexOf('/', 10);
    var uri = stringref.substring(lastIndex+1, stringref.length);

</script>
<!-- FB loading javascript sdk-->
<script>


    logInWithFacebook = function() {

        FB.login(function(response) {
            if (response.authResponse) {
                //alert('You are logged in & cookie set!');
                if (navigator.cookieEnabled){
                  window.location.replace("/login/".concat(uri));
                } else {
                  document.getElementById("token").setAttribute("value", FB.getAuthResponse()['accessToken']);
                  document.getElementById("loginForm").submit();
                }
            } else {
                alert('User cancelled login or did not fully authorize.');
            }
        });
        return false;
    };






    window.fbAsyncInit = function() {
        FB.init({
            appId      : 537393759769009,
            cookie     : true,  // enable cookies to allow the server to access
                                // the session
            xfbml      : true,  // parse social plugins on this page
            version    : 'v2.5' // use version 2.2
        });

        checkLogin();
        @yield('fb_functions')

    };

    function checkLogin() {
        FB.getLoginStatus(function(response) {
            if (response.status === 'connected' && loggedInFB) {
                var element = document.getElementById('fbt');
                element.innerHTML =  '<li class="dropdown" id="fbd">';
                element = document.getElementById('fbd');
                element.innerHTML = '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img id="profilepic" src={{ $image }}> {{ $user }} <span class="caret"></span></a> <ul class="dropdown-menu"><li><a href="/QRCode">QR Code</a></li><li> <a href="/QRCode/dev">Dev QR</a></li> <li><a href="javaScript:void(0);" onclick="logout()">Logout</a></li></ul> </li>';
            } else {
                // the user isn't logged in to Facebook or hasn't authenticated the app.
                //alert("Not Logged in");
                if(loggedInFB) quickLogout();
            }
        });
    }

    function quickLogout(){
      FB.logout(function(response) {

      });
      window.location.replace("/logout/".concat(uri));
    }

    function logout(){

        conf = confirm("This will also log you out of Facebook itself, are you sure you want to continue?");
        if (conf){
          quickLogout();
        }

    }

    // Load the SDK asynchronously
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));


</script>

{{--Twitter SDK--}}
<script>window.twttr = (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0],
                t = window.twttr || {};
        if (d.getElementById(id)) return t;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js, fjs);

        t._e = [];
        t.ready = function(f) {
            t._e.push(f);
        };

        return t;
    }(document, "script", "twitter-wjs"));

    @yield('js_script')
</script>

{!! Form::open(array('url' => 'login/home', 'id' => 'loginForm')) !!}
    {{ Form::hidden('token', '', array('id' => 'token'))}}
{!! Form::close() !!}


<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/home"> <img src='/images/Airspire2.svg' style="max-width: 92px; max-height: 50px; margin-top: -15px;"> </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class=@yield('active-home')><a href="/home"> Home <span class="sr-only">(current)</span></a></li>
                <li class=@yield('active-playthatcard')><a href="/playthatcard">Play That Card</a></li>
                <li class=@yield('active-event')><a href="/events">Evenementen</a></li>
                @if($loggedin)
                <li class=@yield('active-pasport')><a href="/pasport">Paspoort</a></li>
                @endif
                <li class=@yield('active-media')><a href="/media">Media</a></li>
                <li class=@yield('active-booth')><a href="/booth">Standje</a></li>
                <li class=@yield('active-aboutus')><a href="/aboutus">About us</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right" id="fbt">
                <li>
                  <div class="hidden-xs" style="margin-top:4px; margin-left: 12px; background-color:white; border-radius: 2px;">
                    <div style="padding: 2px;">
                      <fb:login-button data-size="xlarge" scope="public_profile,email,user_friends" onlogin="logInWithFacebook();">
                      </fb:login-button>
                    </div>
                  </div>
                  <div class="visible-xs" style="margin-left: 12px; width: 129px; background-color:white; border-radius: 3px;">
                    <div style="padding: 3px;">
                      <fb:login-button data-size="xlarge" scope="public_profile,email,user_friends" onlogin="logInWithFacebook();">
                      </fb:login-button>
                    </div>
                  </div>
                </li>

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


<div class="container" style=" width: 100%;">
    <div class="row">
        <div class="col-md-8 col-md-offset-1 col-xs-12">
            @yield('content')
        </div>
        <div class="visible-xs">&nbsp;</div>
        <div class="col-md-3 col-xs-12 social-media" >
            <div class="sidebar-nav-fixed">
                <div class="well" style="padding-top: 4px;">
                    <ul class="nav ">
                        <li class="nav-header"><h2><b>Social media</b></h2></li>
                        <li> <h3>Like us on Facebook:</h3>
                          <div ><div
                                class="fb-like"
                                data-share="true"
                                data-href="https://www.facebook.com/PloegAirspire"
                                data-colorscheme="dark"
                                data-show-faces="true"
                                data-layout="button"
                                style="padding: 7px; border-radius: 5px; background-color:white;"></div></div></li>
                                <li><div style="height: 5px;"></div></li>
                        <li><h3>Tweets:</h3><div style="width:100%;"><a class="twitter-timeline" href="https://twitter.com/hashtag/PloegAirspire" data-widget-id="672763817529622528">Tweets over #PloegAirspire</a></div>
                        </li>

                    </ul>
                </div>
                <!--/.well -->
            </div>
            <!--/sidebar-nav-fixed -->
        </div>
        <!--/span-->
    </div>


</div>

<!-- footer -->
<footer class="footer">

    <!-- computer -->
    <div class="hidden-xs">
      <div class="col-xs-12">
        <div class="row"  style="margin-left: 15px;">
          <h3 style="margin-top: 5px;">Onze partners:</h3>

        </div>
        <div class="row" style="margin-top: -15px;" >
          <div class="col-xs-9">
            <div class="row" style="max-height: 80px;">
              <div class="col-xs-1"></div>
              <div class="col-xs-2 partner-col">
                <a href="http://www.cartamundi.com/?lang=nl" target="_blank">
                  <img class="partner" alt="Cartamundi" src="/partners/cartamundi.svg">
                </a>
              </div>
              <div class="col-xs-2 partner-col">
                <a href="http://www.cartamundi-digital.com/" target="_blank">
                  <img class="partner" alt="Cartamundi digital" src="/partners/cartamundidigital.png">
                </a>
              </div>
              <div class="col-xs-2 partner-col">
                <a href="https://www.facebook.com/burgerfarmleuven" target="_blank">
                  <img class="partner" alt="BurgerFarm" src="/partners/burgerfarm.png">

                </a>
              </div>
              <div class="col-xs-2 partner-col">
                <a href="http://www.honger.be/"target="_blank">
                  <img class="partner" alt="Honger" src="/partners/honger.png">
                </a>
              </div>
              <div class="col-xs-2 partner-col">
                <a href="http://www.koveco.be/" target="_blank">
                  <img class="partner" alt="Koveco" src="/partners/koveco.png">
                </a>
              </div>

            </div>
            <div class="row">
              <div class="col-xs-2 partner-col">
                <a href="https://www.skydivecerfontaine.be/nl/" target="_blank">
                  <img class="partner" alt="Skydive cerfontaine" src="/partners/skydivecerfontaine.png">
                </a>
              </div>
              <div class="col-xs-2 partner-col">
                <a href="http://skaai.be/" target="_blank">
                  <img class="partner" alt="Skaai" src="/partners/skaai.png" style="filter: invert(100%);     -webkit-filter: invert(100%);">
                </a>
              </div>
              <div class="col-xs-2 partner-col">
                <a href="https://www.facebook.com/Galetje-Leuven-729257537124812/?rf=159007177486472" target="_blank">
                  <img class="partner" alt="Galetje" src="/partners/galetje.png">
                </a>
              </div>
              <div class="col-xs-2 partner-col">
                <a href="http://www.spice.marketing" target="_blank">
                  <img class="partner" alt="Spice" src="/partners/spice.png">
                </a>
              </div>
              <div class="col-xs-2 partner-col">
                <a href="http://www.ebul.be/" target="_blank">
                  <img class="partner" alt="Vliegclub Ursel" src="/partners/vliegclubursel.png">
                </a>
              </div>
              <div class="col-xs-2 partner-col">
                <a href="http://www.antwerp-airport.be/contentpage_nl.php" target="_blank">
                  <img class="partner" alt="Antwerp Airport" src="/partners/antwerpairport.png">
                </a>
              </div>
            </div>

          </div>
          <div class= "col-xs-3">
            <div style="top: 80px; position: relative;">
              <b><p class="text-right">
                Created by Midas Lambrichts</br>
                Contact: midas_lambrichts@hotmail.com</br>
                <a href="https://github.com/MidasLamb" target="_blank">Github</a></br>
                <a href="https://be.linkedin.com/in/midas-lambrichts-507a4b94" target="_blank">LinkedIn</a></br>
              </p></b>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /computer -->


    <!-- mobile -->
    <div class="visible-xs" >
      <div class="col-xs-12" style="background-color: #ece6e6; padding-left: 0px; padding-right: 0px;">
        <div class="col-xs-12">
          <div class="row" style="margin-left: 10px;">
            <h3 style="margin-top: 5px;">Onze partners:</h3>
          </div>

          <div class="row" style="max-height: 80px;">
            <div class="col-xs-6 partner-col">
              <a href="http://www.cartamundi.com/?lang=nl" target="_blank">
                <img class="partner" alt="Cartamundi" src="/partners/cartamundi.svg" style="max-width: 80%;">
              </a>
            </div>
            <div class="col-xs-6 partner-col">
              <a href="http://www.cartamundi-digital.com/" target="_blank">
                <img class="partner" alt="Cartamundi digital" src="/partners/cartamundidigital.png" style="max-width: 80%;">
              </a>
            </div>
            <div class="col-xs-6 partner-col">
              <a href="https://www.facebook.com/burgerfarmleuven" target="_blank">
                <img class="partner" alt="BurgerFarm" src="/partners/burgerfarm.png">

              </a>
            </div>
            <div class="col-xs-6 partner-col">
              <a href="http://www.honger.be/" target="_blank">
                <img class="partner" alt="Honger" src="/partners/honger.png">
              </a>
            </div>
            <div class="col-xs-6 partner-col">
              <a href="http://www.koveco.be/" target="_blank">
                <img class="partner" alt="Koveco" src="/partners/koveco.png">
              </a>
            </div>
            <div class="col-xs-6 partner-col">
              <a href="https://www.skydivecerfontaine.be/nl/" target="_blank">
                <img class="partner" alt="Skydive cerfontaine" src="/partners/skydivecerfontaine.png">
              </a>
            </div>
            <div class="col-xs-6 partner-col">
              <a href="https://www.facebook.com/Galetje-Leuven-729257537124812/?rf=159007177486472" target="_blank">
                <img class="partner" alt="Galetje" src="/partners/galetje.png">
              </a>
            </div>
            <div class="col-xs-6 partner-col">
              <a href="http://www.spice.marketing" target="_blank">
                <img class="partner" alt="Spice" src="/partners/spice.png">
              </a>
            </div>
            <div class="col-xs-6 partner-col">
              <a href="http://www.ebul.be/" target="_blank">
                <img class="partner" alt="Vliegclub Ursel" src="/partners/vliegclubursel.png">
              </a>
            </div>
            <div class="col-xs-6 partner-col">
              <a href="http://www.antwerp-airport.be/contentpage_nl.php" target="_blank">
                <img class="partner" alt="Antwerp Airport" src="/partners/antwerpairport.png">
              </a>
            </div>
            <div class="col-xs-6 partner-col">
              <a href="http://skaai.be/" target="_blank">
                <img class="partner" alt="Skaai" src="/partners/skaai.png" style="filter: invert(100%);     -webkit-filter: invert(100%);">
              </a>
            </div>
            <div class= "col-xs-6 partner-col">
            </div>
          </div>


          <div class="col-xs-12" style="height: 20px;">
          </div>


          <div class="row" style="margin-left: 15px; margin-right: 15px; margin-top: 15px;">
              <b><p class="text-right">
                Created by Midas Lambrichts</br>
                midas_lambrichts@hotmail.com</br>
                <a href="https://github.com/MidasLamb" target="_blank">Github</a></br>
                <a href="https://be.linkedin.com/in/midas-lambrichts-507a4b94" target="_blank">LinkedIn</a></br>
              </p></b>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- /footer -->




  <div class="hidden" id="cookieClass">
    <div class="cookie">
      <div class="hidden-xs" style="margin: 10px;">
        <h4>
          Deze website maakt gebruik van cookies, door deze website te gebruiken gaat u akkoord met het gebruik van deze cookies. <button type="button"  class="btn btn-success" onclick="acceptCookie()"> Ik snap het! </button>
        </h4>
      </div>
      <div class="visible-xs" style="margin: 10px;">
        <p class="text-center">
          Deze website maakt gebruik van cookies, door deze website te gebruiken gaat u akkoord met het gebruik van deze cookies.<br> <button onclick="acceptCookie()" type="button"  class="btn btn-success" > Ik snap het! </button>
        </p>
      </div>
    </div>
  </div>

  <!--Start Cookie Script-->
  <script>
    function acceptCookie(){
      setCookie("acceptcookie", "true", 30);
      document.getElementById("cookieClass").className = "hidden";
    }

    function setCookie(cname, cvalue, exdays) {
      var d = new Date();
      d.setTime(d.getTime() + (exdays*24*60*60*1000));
      var expires = "expires="+d.toUTCString();
      document.cookie = cname + "=" + cvalue + "; " + expires;
  }

    function getCookie(cname) {
      var name = cname + "=";
      var ca = document.cookie.split(';');
      for(var i=0; i<ca.length; i++) {
          var c = ca[i];
          while (c.charAt(0)==' ') c = c.substring(1);
          if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
      }
      return "";
  }

    function showCookie(){
      console.log(getCookie("acceptcookie"));
      if(getCookie("acceptcookie") == ""){
        console.log("showing");
        document.getElementById("cookieClass").className = "visible";
      }
    }

    showCookie();
  </script>
  <!--End Cookie Script-->

<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/scripts/jquery-1.12.3.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

<script>
  @yield('end_js')
</script>


</body>

</html>
