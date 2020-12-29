<?php

use app\controllers\Route;
use app\models\Pult;

require_once __DIR__ . '/vendor/autoload.php';

Route::add('/json-output', function () {
    $pultId = $_GET['id'];
    $pult = new Pult($pultId);
    header('Content-Type: application/json');
    echo $pult->getJSON();
}, 'get');

Route::add('/bejarat', function () {
    include('bejarat.html');
}, 'get');

Route::run('/');