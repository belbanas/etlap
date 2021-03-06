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
        $this->coordinateFile = 'breakfast_coordinates.json';
    }

}