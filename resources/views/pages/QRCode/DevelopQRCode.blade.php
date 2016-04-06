<!DOCTYPE html>
<html lang="en">
<head>
  <style>
  html {
    position: relative;
    min-height: 100%;
  }

  body {
    /* Margin bottom by footer height */
    margin-bottom: 0px;
  }
  </style>
</head>

<body>

<div style="position: absolute;top: 50%;left: 50%; transform: translate(-50%, -50%); height: 500px; width: 500px;">
  <img id="qr" src="" alt="QR code" >
</div>
<script>
function loadImage(){

  var beginString = "https://chart.googleapis.com/chart?chs=500x500&cht=qr&chl=www.ploegairspire.be/events/{{ $event->hash}}/";
  var endString = "&choe=UTF-8";
  var d = new Date();
  var time = d.getTime();
  var hextime = time.toString(16);

  document.getElementById("qr").src= beginString.concat(hextime).concat(endString);
}

loadImage();

</script>
</body>
