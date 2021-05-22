<?php

use app\models\Pult;

require_once __DIR__ . '/vendor/autoload.php';

$pultId = $_GET['id'];
$pult = new Pult($pultId);
$data = $pult->getJSON();

header('Content-Type: application/json');
header('Content-Length: ' . strlen($data));

echo $data;
