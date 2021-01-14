<?php


namespace app\models;


use PhpOffice\PhpSpreadsheet\Reader\Exception;

class DinnerModel extends MenuModel
{
    /**
     * SnackModel constructor.
     * @param string $language
     * @throws Exception
     */
    public function __construct(string $language)
    {
        parent::__construct($language);
        $this->type = "Dinner";
    }

    public function getCoordinates(int $pult): ?array
    {
        $path = './dinner_coordinates.json';
        $str = file_get_contents($path);
        $coordinates = json_decode($str, true);

        return ["soup" => $coordinates[$pult][$this->TODAY]["soup"],
            "main" => $coordinates[$pult][$this->TODAY]["main"],
            "price" => $coordinates[$pult][$this->TODAY]["price"]];
    }


}