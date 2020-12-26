<?php


namespace app\models;


class Pult
{
    private ?int $pult;
    private int $lunchStart;
    private int $lunchEnd;

    /**
     * Pult constructor.
     * @param int|null $pult
     */
    public function __construct(?int $pult)
    {
        $this->pult = $pult;
        $this->setTimeIntervals();
    }

    public function setTimeIntervals(): void
    {
        $path = './time_intervals.json';
        $str = file_get_contents($path);
        $params = json_decode($str, true);

        $this->lunchStart = $params["lunch"][0];
        $this->lunchEnd = $params["lunch"][1];
    }

    public function getSlide(): array
    {
        $hour = date('H');
        if ($hour >= $this->lunchStart && $hour <= $this->lunchEnd) {
            $modelHU = new LunchModel('HU');
            $modelDE = new LunchModel('DE');
        } else {
            $modelHU = new BreakfastModel("HU");
            $modelDE = new BreakfastModel("DE");
        }
        $slide = [
            "HU" => $modelHU->getFood($this->pult),
            "DE" => $modelDE->getFood($this->pult),
        ];

        return $slide;
    }
}