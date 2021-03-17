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
        $this->coordinateFile = 'dinner_coordinates.json';
    }

}