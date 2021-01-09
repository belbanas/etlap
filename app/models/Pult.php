<?php


namespace app\models;


use Exception;

class Pult
{
    private ?int $id;
    private ?array $intervals;

    /**
     * Pult constructor.
     * @param int|null $id
     */
    public function __construct(?int $id)
    {
        $this->id = $id;
        $this->setTimeIntervals();
    }

    public function setTimeIntervals(): void
    {
        $path = './time_intervals.json';
        $str = file_get_contents($path);
        $this->intervals = json_decode($str, true);
    }

    public function getSlide(): array
    {
        $currentDay = date('N');
        $currentTime = date('H:i:s');
        $breakfastEnd = $this->intervals['breakfast']['end'];
        if ($currentDay === "6" || $currentDay === "7") {
            $breakfastEnd = $this->intervals['breakfast']['weekend'];
        }
        switch ($currentTime) {
            case $currentTime >= $this->intervals["breakfast"]["start"] && $currentTime < $breakfastEnd:
                $modelHU = new BreakfastModel("HU");
                $modelUA = new BreakfastModel("UA");
                $modelKR = new BreakfastModel("KR");
                $modelEN = new BreakfastModel("EN");
                break;
            case $currentTime >= $this->intervals["lunch"]["start"] && $currentTime < $this->intervals["lunch"]["end"]:
                $modelHU = new LunchModel('HU');
                $modelUA = new LunchModel('UA');
                $modelKR = new LunchModel('KR');
                $modelEN = new LunchModel('EN');
                break;
            case $currentTime >= $this->intervals["dinner1"]["start"] && $currentTime < $this->intervals["dinner1"]["end"]:
                $modelHU = new DinnerModel("HU");
                $modelUA = new DinnerModel("UA");
                $modelKR = new DinnerModel("KR");
                $modelEN = new DinnerModel("EN");
                break;
            case $currentTime >= $this->intervals["dinner2"]["start"] && $currentTime < $this->intervals["dinner2"]["end"]:
                $modelHU = new Dinner2Model("HU");
                $modelUA = new Dinner2Model("UA");
                $modelKR = new Dinner2Model("KR");
                $modelEN = new Dinner2Model("EN");
                break;
            case $currentTime >= $this->intervals["snack"]["start"] && $currentTime < $this->intervals["snack"]["end"]:
                $modelHU = new SnackModel("HU");
                $modelUA = new SnackModel("UA");
                $modelKR = new SnackModel("KR");
                $modelEN = new SnackModel("EN");
                break;
            default:
                return [];
        }


        if ($modelHU != null && $modelUA != null && $modelKR != null && $modelEN != null) {
            if ($modelHU->getFood($this->id)->getMainCourse() != null) {
                return [
                    "HU" => $modelHU->getFood($this->id),
                    "UA" => $modelUA->getFood($this->id),
                    "KR" => $modelKR->getFood($this->id),
                    "EN" => $modelEN->getFood($this->id),
                ];
            } else {
                echo "ez";
                return [];
            }
        }
        return [];
    }

    public function getJSON()
    {
        return json_encode($this->getSlide(), JSON_UNESCAPED_UNICODE);
    }
}