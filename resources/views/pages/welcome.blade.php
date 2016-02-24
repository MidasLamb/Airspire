<!DOCTYPE html>
<html>
    <head>
        <title>{{ $Ploegnaam }}</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

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
                font-family: 'Lato';
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
                font-size: 96px;
                opacity: 0;
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
                <div class="title" id="title" >{{ $Ploegnaam }}</div>
                <div class="subtitle" id="subtitle">Click to continue</div>
            </div>
        </div>


    </body>
</html>
