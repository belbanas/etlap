<?php


namespace app\models;

use app\models\Menu;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReader;


class Model
{
    private string $TODAY;
    private int $WEEK;
    private string $filenameHU;
    private IReader $reader;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->TODAY = date('l');
        $this->WEEK = date('W');
        $this->filenameHU = './' . $this->WEEK . '_Het_HU.xls';
        $this->reader = IOFactory::createReader("Xlsx");
    }


    public function getLunch(): Menu
    {
        $spreadsheet = $this->reader->load($this->filenameHU);

        switch ($this->TODAY) {
            case 'Monday':
                $name = $spreadsheet->getActiveSheet()->getCell('B4')->getCalculatedValue();
                $price = $spreadsheet->getActiveSheet()->getCell('D5')->getCalculatedValue();
                break;
            case 'Tuesday':
                $name = $spreadsheet->getActiveSheet()->getCell('H4')->getCalculatedValue();
                $price = $spreadsheet->getActiveSheet()->getCell('J5')->getCalculatedValue();
                break;
            case 'Wednesday':
                $name = $spreadsheet->getActiveSheet()->getCell('N4')->getCalculatedValue();
                $price = $spreadsheet->getActiveSheet()->getCell('P5')->getCalculatedValue();
                break;
            case 'Thursday':
                $name = $spreadsheet->getActiveSheet()->getCell('T4')->getCalculatedValue();
                $price = $spreadsheet->getActiveSheet()->getCell('V5')->getCalculatedValue();
                break;
            case 'Friday':
                $name = $spreadsheet->getActiveSheet()->getCell('Z4')->getCalculatedValue();
                $price = $spreadsheet->getActiveSheet()->getCell('AB5')->getCalculatedValue();
                break;
            case 'Saturday':
                $name = $spreadsheet->getActiveSheet()->getCell('AF4')->getCalculatedValue();
                $price = $spreadsheet->getActiveSheet()->getCell('AH5')->getCalculatedValue();
                break;
            case 'Sunday':
                $name = $spreadsheet->getActiveSheet()->getCell('AL4')->getCalculatedValue();
                $price = $spreadsheet->getActiveSheet()->getCell('AN5')->getCalculatedValue();
                break;
        }

        return new Menu($name, $price, 'Lunch', $this->TODAY, 'HU', 1);
    }
}