<?php

require_once __DIR__ . '/vendor/autoload.php';

use app\models\Pult;

$pultId = $_GET['id'];

$pult = new Pult($pultId);
$slide = $pult->getSlide();

$json = json_encode($slide, JSON_UNESCAPED_UNICODE);

if (sizeof($slide) === 0) {
    echo "Jelenleg nincs étkeztetés";
}

?>

<style>

</style>

<div id="container">
    <p id="food-name"><?php echo $slide['HU']->getName() ?></p>
    <p><?php echo $slide['HU']->getPrice() ?> HUF</p>
    <img src="images\<?php echo $slide['HU']->getName() . '.png' ?>" alt="kaja">
</div>

<script type="text/javascript">
    //const json = `<?php //echo $json ?>//`;
    //const slide = JSON.parse(json);
    // TODO
    const nameHU = "<?php echo $slide['HU']->getName() ?>"
    const nameDE = "<?php echo $slide['DE']->getName() ?>"
    const slide = [nameDE, nameHU]

    let container = document.querySelector('#food-name');
    let i = 0;
    function nextLanguage() {
        container.innerHTML = slide[i]
        i < slide.length - 1 ? i++ : i = 0;
    }
    setInterval(nextLanguage, 3000)


</script>

