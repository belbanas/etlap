<?php

use app\models\Pult;

require_once __DIR__ . '/vendor/autoload.php';

$pultId = $_GET['id'];
$pult = new Pult($pultId);
header('Content-Type: application/json');
echo $pult->getJSON();
