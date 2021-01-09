<?php


namespace app\models;


use PhpOffice\PhpSpreadsheet\Reader\Exception;

class SnackModel extends MenuModel
{
    /**
     * SnackModel constructor.
     * @param string $language
     * @throws Exception
     */
    public function __construct(string $language)
    {
        parent::__construct($language);
        $this->type = "Snack";
    }

    public function getCoordinates(int $pult): ?array
    {
        $path = './snack_coordinates.json';
        $str = file_get_contents($path);
        $coordinates = json_decode($str, true);

        return ["main" => $coordinates[$pult][$this->TODAY]["main"],
            "price" => $coordinates[$pult][$this->TODAY]["price"]];
    }
}