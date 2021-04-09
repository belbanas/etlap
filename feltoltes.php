<?php

use app\models\Upload;

require_once __DIR__ . '/vendor/autoload.php';

if (isset($_FILES['etlap'])) {
    $upload = new Upload();
    $upload->uploadFile($_FILES, $_POST);
}

?>

<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="static/css/feltoltes.css">
    <title>Étlap feltöltése</title>
</head>
<body>
<img id="logo" src="static/images/eurest_logo_nagy.png" alt="eurest_logo_nagy"/>
<div class="header">
    <p id="pult-name">Étlap feltöltése</p>
</div>
<div class="upload-container">
    <div class="upload-success">
        <?php if (isset($_FILES['etlap'])): ?>
            <h1>Sikeres feltöltés!</h1><br>
        <?php endif; ?>
    </div>
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