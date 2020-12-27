<?php

require_once __DIR__ . '/vendor/autoload.php';

use app\models\Pult;

$pultId = $_GET['id'];

$pult = new Pult($pultId);
$slide = $pult->getSlide();

var_dump($slide);
$json = json_encode($slide, JSON_UNESCAPED_UNICODE);

?>

<div id="container">
    <p id="food-name"><?php echo $slide['HU']->getName() ?></p>
    <p><?php echo $slide['HU']->getPrice() ?></p>
    <img src="images\<?php echo $slide['HU']->getName() . '.png' ?>" alt="kaja">
</div>

<script type="text/javascript">
    const json = `<?php echo $json ?>`;
    const slide = JSON.parse(json);
    console.log(slide);
    // TODO
    let container = document.querySelector('#food-name');


</script>

