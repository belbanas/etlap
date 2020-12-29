<?php


namespace app\models;


use PhpOffice\PhpSpreadsheet\Reader\Exception;

class LunchModel extends MenuModel
{

    /**
     * LunchModel constructor.
     * @param string $language
     * @throws Exception
     */
    public function __construct(string $language)
    {
        parent::__construct($language);
        $this->filename = './' . $this->WEEK . '_Het_' . $language . '.xls';
        $this->type = 'Lunch';
    }

    /**
     * @param int $pult
     * @return string[]
     */
    public function getCoordinates(int $pult): array
    {
        $soupCoordinate = null;
        $priceCoordinate = null;

        $coordinates = [1 => [
            "Monday" => ["B4", "B8", "D5"],
            "Tuesday" => ["H4", "H8", "J5"],
            "Wednesday" => ["N4", "N8", "P5"],
            "Thursday" => ["T4", "T8", "V5"],
            "Friday" => ["Z4", "Z8", "AB5"],
            "Saturday" => ["AF4", "AF8", "AH5"],
            "Sunday" => ["AL4", "AL8", "AN5"]
        ], 2 => [
            "Monday" => ["B6", "B12", "D7"],
            "Tuesday" => ["H6", "H12", "J7"],
            "Wednesday" => ["N6", "N12", "P7"],
            "Thursday" => ["T6", "T12", "V7"],
            "Friday" => ["Z6", "Z12", "AB7"],
            "Saturday" => ["AF6", "AF12", "AH7"],
            "Sunday" => ["AL6", "AL12", "AN7"]
        ], 3 => [
            "Monday" => ["B8", "D9"],
            "Tuesday" => ["H8", "J9"],
            "Wednesday" => ["N8", "P9"],
            "Thursday" => ["T8", "V9"],
            "Friday" => ["Z8", "AB9"],
            "Saturday" => ["AF8", "AH9"],
            "Sunday" => ["AL8", "AN9"]
        ], 4 => [
            "Monday" => ["B10", "D11"],
            "Tuesday" => ["H10", "J11"],
            "Wednesday" => ["N10", "P11"],
            "Thursday" => ["T10", "V11"],
            "Friday" => ["Z10", "AB11"],
            "Saturday" => ["AF10", "AH11"],
            "Sunday" => ["AL10", "AN11"]
        ]];

        return ["soup" => $coordinates[$pult][$this->TODAY][0],
            "main" => $coordinates[$pult][$this->TODAY][1],
            "price" => $coordinates[$pult][$this->TODAY][2]];
    }


}