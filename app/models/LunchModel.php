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
        $this->type = 'Lunch';
    }

    /**
     * @param int $pult
     * @return string[]
     */
    public function getCoordinates(int $pult): array
    {
        $path = './lunch_coordinates.json';
        $str = file_get_contents($path);
        $coordinates = json_decode($str, true);

        return [
            "start" => $coordinates[$pult][$this->TODAY]["start"],
            "end" => $coordinates[$pult][$this->TODAY]["end"],
        ];
    }


}