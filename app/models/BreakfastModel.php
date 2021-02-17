<?php


namespace app\models;


use PhpOffice\PhpSpreadsheet\Reader\Exception;

class BreakfastModel extends MenuModel
{

    /**
     * BreakfastModel constructor.
     * @param string $language
     * @throws Exception
     */
    public function __construct(string $language)
    {
        parent::__construct($language);
        $this->type = 'Breakfast';
    }

    public function getCoordinates(int $pult): array
    {
        $path = './breakfast_coordinates.json';
        $str = file_get_contents($path);
        $coordinates = json_decode($str, true);

        return [
            "soup" => $coordinates[$pult][$this->TODAY]["soup"],
            "main" => $coordinates[$pult][$this->TODAY]["main"],
            "second" => $coordinates[$pult][$this->TODAY]["second"],
            "price" => $coordinates[$pult][$this->TODAY]["price"],
        ];
    }

}