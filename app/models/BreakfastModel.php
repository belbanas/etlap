<?php


namespace app\models;


use PhpOffice\PhpSpreadsheet\Reader\Exception;

class BreakfastModel extends MenuModel
{
    private string $language;

    /**
     * BreakfastModel constructor.
     * @param string $language
     * @throws Exception
     */
    public function __construct(string $language)
    {
        parent::__construct();
        $this->language = $language;
        $this->filename = './' . $this->WEEK . '_Het_Reggeli.xls';
        $this->type = 'Breakfast';
    }

    public function getCoordinates(int $pult): array
    {
        $nameCoordinate = null;
        $priceCoordinate = null;

        $coordinates = ["HU" => [
            "Monday" => ["B2", "L2"],
            "Tuesday" => ["B3", "L3"],
            "Wednesday" => ["B4", "L4"],
            "Thursday" => ["B5", "L5"],
            "Friday" => ["B6", "L6"],
            "Saturday" => ["B7", "L7"],
            "Sunday" => ["B8", "L8"]
        ], "DE" => [
            "Monday" => ["G2", "L2"],
            "Tuesday" => ["G3", "L3"],
            "Wednesday" => ["G4", "L4"],
            "Thursday" => ["G5", "L5"],
            "Friday" => ["G6", "L6"],
            "Saturday" => ["G7", "L7"],
            "Sunday" => ["G8", "L8"]
        ]];

        return ["name" => $coordinates[$this->language][$this->TODAY][0],
            "price" => $coordinates[$this->language][$this->TODAY][1]];
    }

}