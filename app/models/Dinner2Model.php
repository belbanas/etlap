<?php


namespace app\models;


use PhpOffice\PhpSpreadsheet\Reader\Exception;

class Dinner2Model extends MenuModel
{
    /**
     * SnackModel constructor.
     * @param string $language
     * @throws Exception
     */
    public function __construct(string $language)
    {
        parent::__construct($language);
        $this->type = "Late Dinner";
        $this->coordinateFile = './dinner2_coordinates.json';
    }

}