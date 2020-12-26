<?php

require_once __DIR__ . '/vendor/autoload.php';

use app\models\MenuModel;
use app\models\Pult;
use app\models\Food;

$pult = new Pult(2);
$slide = $pult->getSlide();

$nameHU = $slide["HU"]->getName();
$nameDE = $slide["DE"]->getName();
$price = $slide["HU"]->getPrice();

var_dump($slide);
$valami = "kaki";

?>

<div id="container">
    <p><?php echo $nameHU ?></p><p><?php echo $price ?></p>
</div>

<script type="text/javascript">
    let container = document.querySelector('#container');
    let nameHU = `<p><?php echo $nameHU ?></p><p><?php echo $price ?></p>`
    let nameDE = `<p><?php echo $nameDE ?></p><p><?php echo $price ?></p>`
    let count = 0;
    setInterval(function () {
        container.innerHTML = container.innerHTML === nameDE ? nameHU : nameDE;
    }, 3000)
</script>

