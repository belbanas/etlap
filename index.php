<?php

use app\controllers\Route;
use app\models\Upload;
use app\models\Pult;

require_once __DIR__ . '/vendor/autoload.php';

Route::add('/upload', function () {
    include('upload.html');
}, 'get');

Route::add('/upload', function () {
    $upload = new Upload();
    $upload->uploadFile($_FILES, $_POST);
    var_dump($_POST);
    var_dump($_FILES);
    Header('Location: /upload');
}, 'post');

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