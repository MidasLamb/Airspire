<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Airspire|Ban notice</title>

    <meta property="og:url"                content="http://www.ploegairspire.be" />
    <meta property="og:type"               content="website" />
    <meta property="og:title"              content="Ploeg Airspire" />
    <meta property="og:description"        content="De website van Ploeg Airspire!" />
    <meta property="og:image"              content="http://www.ploegairspire.be/images/Airspire_wit.png" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/scripts/bootstrap/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>

<body>

<div class="alert alert-danger" role="alert">
  <strong>Je bent geband!</strong><br> Reden: {{ session('message') }}
</div>
</body>
