<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Airspire|{{ $title }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>


    <style>
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
    var lastIndex = stringref.lastIndexOf('/');
    var uri = stringref.substring(lastIndex+1, stringref.length);

</script>
<!-- FB loading javascript sdk-->
<script>


    logInWithFacebook = function() {

        FB.login(function(response) {
            if (response.authResponse) {
                //alert('You are logged in & cookie set!');
                window.location.replace("/login/".concat(uri));
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
                element.innerHTML = '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img id="profilepic" src={{ $image }}> {{ $user }} <span class="caret"></span></a> <ul class="dropdown-menu"><li><a href="/QRCode">QR Code</a></li> <li><a href="" onclick="logout()">Logout</a></li></ul> </li>';
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

        conf = confirm("This will also log you out of Facebook itself, are you sure you want to continue?")
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
                <li class=@yield('active-event')><a href="/events">Events</a></li>
                @if($loggedin)
                <li class=@yield('active-pasport')><a href="/pasport">Pasport</a></li>
                @endif
                <li class=@yield('active-media')><a href="/media">Media</a></li>
                <li class=@yield('active-aboutus')><a href="/aboutus">About us</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right" id="fbt">
                <li><fb:login-button data-size="xlarge" scope="public_profile,email,user_friends,user_posts,publish_actions" onlogin="logInWithFacebook();">
                    </fb:login-button></li>
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
        <div class="col-md-3 col-xs-6 social-media" >
            <div class="sidebar-nav-fixed">
                <div class="well">
                    <ul class="nav ">
                        <li class="nav-header"><h4><b>Social media</b></h4></li>
                        <li><div><a class="twitter-timeline" href="https://twitter.com/hashtag/Airspire" data-widget-id="672763817529622528">Tweets over #Airspire</a></div>
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




<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

<script>
  @yield('end_js')
</script>
</body>

</html>
