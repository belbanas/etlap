<?php
    $randomNumber = mt_rand(0,100);
?>

<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="static/css/style.css">
    <title>Bejárat</title>
</head>
<body>
<img id="logo" src="static/images/eurest_logo_nagy.png" alt="eurest_logo_nagy"/>
<div class="header">
    <p id="pult-name"></p>
    <div id="close-container">
        <div id="close-flag"></div>
        <div id="close-sign"></div>
    </div>
</div>
<div class="main-content">
    <div class="pictures">
        <div id="proba">
            <img id="main-pic" src="">
        </div>
        <div class="line2"></div>
        <p id="food-price"></p>
    </div>
    <div class="container">
        <div id="main-flag" class="flag-container"></div>
        <div class="foods">
            <p id="default-language-soup" class="name"></p>
            <p id="default-language-food" class="name"></p>
            <p id="default-language-food2" class="name"></p>
        </div>
        <div class="line"></div>
        <div id="flag" class="flag-container"></div>
        <div class="foods2">
            <p id="soup-name" class="name"></p>
            <p id="food-name" class="name"></p>
            <p id="food-name2" class="name"></p>
        </div>
    </div>
</div>
<script src="static/js/polyfill.min.js" type="text/javascript"></script>
<script src="static/js/fetch.umd.min.js" type="text/javascript"></script>
<script src="static/js/script_static.js?v=<?php echo $randomNumber; ?>"></script>
</body>
</html>
