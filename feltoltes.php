<?php

use app\models\Upload;

require_once __DIR__ . '/vendor/autoload.php';

var_dump($_FILES, $_POST);

$uploadOK = 'semmi';

if (isset($_FILES['etlap'])) {
    $upload = new Upload();
    $uploadOK = $upload->uploadFile($_FILES, $_POST);
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
        <?php if ($uploadOK === 'semmi'): ?>

        <?php elseif ($uploadOK): ?>
            <h1>Sikeres feltöltés!</h1><br>
        <?php elseif (!$uploadOK): ?>
            <h1>Sikertelen feltöltés!</h1><br>
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
<div class="test-container">
    <h1>TESZT</h1><br>
    <form action="bejarat.html" method="get">
        <label for="pult">Válassz pultot:</label>
        <select name="id" id="pult">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select><br>
        <label for="day">Válassz napot:</label>
        <select name="day" id="day">
            <option value="Monday">Hétfő</option>
            <option value="Tuesday">Kedd</option>
            <option value="Wednesday">Szerda</option>
            <option value="Thursday">Csütörtök</option>
            <option value="Friday">Péntek</option>
            <option value="Saturday">Szombat</option>
            <option value="Sunday">Vasárnap</option>
        </select><br>
        <label for="time">Válassz napszakot:</label>
        <select name="time" id="time">
            <option value="05:00:12">Reggeli előtt</option>
            <option value="05:30:12">Reggeli</option>
            <option value="10:20:12">Ebéd előtt</option>
            <option value="10:50:12">Ebéd</option>
            <option value="16:20:12">Vacsora1 előtt</option>
            <option value="16:50:12">Vacsora1</option>
            <option value="19:20:12">Vacsora2 előtt</option>
            <option value="19:50:12">Vacsora2</option>
            <option value="23:00:12">Uzsonna előtt</option>
            <option value="23:30:12">Uzsonna</option>
        </select><br>
        <button type="submit">OK</button>
    </form>
</div>
</body>
</html>