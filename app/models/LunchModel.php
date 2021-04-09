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
    public function __construct(string $language, bool $isPre = false)
    {
        parent::__construct($language, $isPre);
        $this->type = 'Lunch';
        $this->coordinateFile = 'lunch_coordinates.json';
    }

}