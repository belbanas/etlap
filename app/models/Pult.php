<?php


namespace app\models;


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
        $hour = date('H');
        switch ($hour) {
            case $hour >= $this->intervals["breakfast"]["start"] && $hour < $this->intervals["breakfast"]["end"]:
                $modelHU = new BreakfastModel("HU");
                $modelDE = new BreakfastModel("DE");
                break;
            case $hour >= $this->intervals["lunch"]["start"] && $hour < $this->intervals["lunch"]["end"]:
                $modelHU = new LunchModel('HU');
                $modelDE = new LunchModel('DE');
                break;
            case $hour >= $this->intervals["snack"]["start"] && $hour < $this->intervals["snack"]["end"]:
                // TODO
                $modelHU = new SnackModel("HU");
                $modelDE = new SnackModel("DE");
                break;
            case $hour >= $this->intervals["dinner"]["start"] && $hour < $this->intervals["dinner"]["end"]:
                // TODO
                $modelHU = new DinnerModel("HU");
                $modelDE = new DinnerModel("DE");
                break;
            default:
                // TODO
        }

        $slide = [
            "HU" => $modelHU->getFood($this->id),
            "DE" => $modelDE->getFood($this->id),
        ];

        return $slide;
    }
}