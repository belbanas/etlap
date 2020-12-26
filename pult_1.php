<?php

require_once __DIR__ . '/vendor/autoload.php';

use app\models\Model;

// TODO: külön fájlba ezeket
$lunchStart = 11;
$lunchEnd = 13;
//

$model = new Model();
$hour = date('H');

if ($hour >= $lunchStart && $hour <= $lunchEnd) {
    $lunch = $model->getLunch();
    var_dump($lunch);
}



