<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Under development</title>

    <style>

    </style>


</head>

<body>

<script>
    var loggedInFB = {{ json_encode($loggedin) }};
    console.log(loggedInFB);

</script>
<!-- FB loading javascript sdk-->
<script>


    logInWithFacebook = function() {

        FB.login(function(response) {
            if (response.authResponse) {
                //alert('You are logged in & cookie set!');
                window.location.replace("/login/home");
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
            version    : 'v2.2' // use version 2.2
        });

        checkLogin();
    };

    function checkLogin() {
        FB.getLoginStatus(function(response) {
            if (response.status === 'connected' && loggedInFB) {
                var element = document.getElementById('fbt');
                element.innerHTML =  '<li class="dropdown" id="fbd">';
                element = document.getElementById('fbd');
                element.innerHTML = 'You are not recognized as a user, the site is only accessible to certified users.';
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
      window.location.replace("/logout/home");
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







<h2>This site is currently under construction, please log in to continue!</h2>
<ul class="nav navbar-nav navbar-right" id="fbt">
    <li><fb:login-button data-size="large" scope="public_profile,email,user_friends,user_posts,publish_actions" onlogin="logInWithFacebook();">
        </fb:login-button></li>
    </li>
</ul>






<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

</body>

</html>
