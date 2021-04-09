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
    public function __construct(string $language, bool $isPre = false)
    {
        parent::__construct($language, $isPre);
        $this->type = "Dinner";
        $this->coordinateFile = 'dinner_coordinates.json';
    }

}