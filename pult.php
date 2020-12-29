<?php

require_once __DIR__ . '/vendor/autoload.php';

use app\models\Pult;

$pultId = $_GET['id'];

$pult = new Pult($pultId);
$slide = $pult->getSlide();
var_dump($slide);

$json = json_encode($slide, JSON_UNESCAPED_UNICODE);
echo "json: " . $json;

if (date("s") === "00") {
    header("Refresh: 0");
}

$imageFileName = "placeholder_image.png";


?>
<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pult <?php echo $pultId; ?></title>
</head>
<body>
<?php if (sizeof($slide) != 0) { ?>
    <div id="container">
        <p id="soup-name"><?php echo $slide['HU']->getSoup() ?></p>
        <p id="food-name"><?php echo $slide['HU']->getMainCourse() ?></p>
        <p><?php echo $slide['HU']->getPrice() ?> HUF</p>
        <!--        <img src="images\--><?php //echo $imageFileName ?><!--" alt="-->
        <?php //echo $slide['HU']->getName() ?><!-- képe">-->
    </div>
    <script type="text/javascript">
        //const json = `<?php ////echo $json ?>////`;
        //const parsedJson = JSON.parse(json);
        //console.log(parsedJson);
        // TODO
        const soupHU = "<?php echo $slide['HU']->getSoup() ?>"
        const soupUA = "<?php echo $slide['UA']->getSoup() ?>"
        const soupKR = "<?php echo $slide['KR']->getSoup() ?>"
        const soupEN = "<?php echo $slide['EN']->getSoup() ?>"
        const soupSlide = [soupUA, soupKR, soupEN, soupHU];
        const foodHU = "<?php echo $slide['HU']->getMainCourse() ?>"
        const foodUA = "<?php echo $slide['UA']->getMainCourse() ?>"
        const foodKR = "<?php echo $slide['KR']->getMainCourse() ?>"
        const foodEN = "<?php echo $slide['EN']->getMainCourse() ?>"
        const foodSlide = [foodUA, foodKR, foodEN, foodHU];

        let soupContainer = document.querySelector('#soup-name');
        let foodContainer = document.querySelector('#food-name');

        setInterval(() => {
            let now = new Date();
            console.log(now.getSeconds())
            switch (now.getSeconds()) {
                case 0:
                    location.reload();
                    break;
                case 15:
                    soupContainer.innerHTML = soupEN
                    foodContainer.innerHTML = foodEN
                    break;
                case 30:
                    soupContainer.innerHTML = soupUA
                    foodContainer.innerHTML = foodUA
                    break;
                case 45:
                    soupContainer.innerHTML = soupKR
                    foodContainer.innerHTML = foodKR
                    break;

            }
        }, 1000)

        // let i = 0;
        //
        // function nextLanguage() {
        //     soupContainer.innerHTML = soupSlide[i]
        //     foodContainer.innerHTML = foodSlide[i]
        //     if (i < soupSlide.length - 1) {
        //         i++
        //     } else {
        //         i = 0
        //         location.reload();
        //     }
        // }
        //
        // setInterval(nextLanguage, 3000)
    </script>
<?php } else { ?>
    <div id="container">
        <p id="close-sign">ZÁRVA</p>
    </div>
    <script type="text/javascript">
        const closedHU = "ZÁRVA";
        const closedUA = "ЗАЧИНЕНО";
        const closedKR = "닫은";
        const closedEN = "CLOSED";
        const closedSlide = [closedUA, closedKR, closedEN, closedHU];

        let closedContainer = document.querySelector('#close-sign');
        let i = 0;

        setInterval(() => {
            let now = new Date();
            console.log(now.getSeconds())
            switch (now.getSeconds()) {
                case 15:
                    closedContainer.innerHTML = closedHU
                    break;
                case 30:
                    closedContainer.innerHTML = closedUA
                    break;
                case 45:
                    closedContainer.innerHTML = closedKR
                    break;
                case 0:
                    closedContainer.innerHTML = closedEN
                    break;
            }
        }, 1000)
    </script>
<?php } ?>
</body>
</html>



