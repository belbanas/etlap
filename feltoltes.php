<?php

use app\models\Upload;

require_once __DIR__ . '/vendor/autoload.php';

$upload = new Upload();
$upload->uploadFile($_FILES, $_POST);
//var_dump($_POST);
//var_dump($_FILES);

?>

<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="static/css/style.css">
    <title>Étlap feltöltése</title>
</head>
<body>
<div class="upload-container">
    <h1>Étlap feltöltése</h1>
    <form action="feltoltes.php" method="post" enctype="multipart/form-data">
        <label for="etlap">Étlap kiválasztása:</label>
        <input type="file" name="etlap" id="etlap"><br><br>
        <!--        Ez csak akkor fog működni ha chrome-al használja          -->
        <label for="week">Melyik hétre akarod az étlapot?</label>
        <input type="week" name="week" id="week"><br><br>
        <button type="submit" name="submit">Feltölt</button>
    </form>
</div>
</body>
</html>