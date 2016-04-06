<!DOCTYPE html>
<html>
    <head>
        <title>Ploeg Airspire</title>

        <meta property="og:url"                content="http://www.ploegairspire.be" />
        <meta property="og:type"               content="website" />
        <meta property="og:title"              content="Ploeg Airspire" />
        <meta property="og:description"        content="De website van Ploeg Airspire!" />
        <meta property="og:image"              content="http://www.ploegairspire.be/images/Airspire_wit.png" />

        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Montserrat';
                cursor: pointer; cursor: hand;

            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
                color: #161717;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 80px;
                opacity: 0;
                color: #1351b7;
            }

            .subtitle {
                font-size: 32px;
                opacity: 0;
            }
        </style>
    </head>
    <body onclick="window.location.href='/home';">

    <script>

        var titleOp = 0.0;
        var subtitleOp = 0.0;

        var turnVis = false;
        function pulseSubtitle(){
            if (turnVis){
                subtitleOp += 0.01;
            } else {
                subtitleOp -= 0.01;
            }
            document.getElementById('subtitle').style.opacity = subtitleOp;
            if (subtitleOp >= 1){
                turnVis = false;
            }
            if (subtitleOp <= 0){
                turnVis = true;
            }

            window.setTimeout(pulseSubtitle, 20);
        }

        function turnTitleVisible(){
            titleOp += 0.01
            document.getElementById('title').style.opacity = titleOp;
            console.log(titleOp)
            if (titleOp < 1){
                window.setTimeout(turnTitleVisible, 10);
            } else {
                pulseSubtitle();
            }
        }





        window.setTimeout(turnTitleVisible, 1000);
    </script>


        <div class="container">
            <div class="content">
                <div class="title" id="title" ><img src='/images/Airspire_wit.png' style="max-width: 50%;"> </br> <div style= "position: relative; top:-100px;">Verwelkomt u!</div></div>
                <div class="subtitle" id="subtitle">Click anywhere to continue</div>
            </div>
        </div>


    </body>
</html>
