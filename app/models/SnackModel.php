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
    public function __construct(string $language, bool $isPre = false)
    {
        parent::__construct($language, $isPre);
        $this->type = "Snack";
        $this->coordinateFile = 'snack_coordinates.json';
    }

}