<?php


namespace app\models;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Reader\IReader;


class MenuModel
{
    protected string $TODAY;
    protected int $WEEK;
    protected string $filename;
    private IReader $reader;
    protected string $type;

    /**
     * MenuModel constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->TODAY = date('l');
        $this->WEEK = date('W');
        $this->reader = IOFactory::createReader("Xlsx");
    }

    /**
     * @param int $pult a pult sorszáma
     * @return string[]
     * az első koordináta az étel neve a második pedig az ára az excel táblában,
     * külön definiálva minden étkezéshez
     */
    public function getCoordinates(int $pult): ?array
    {
        return null;
    }

    public function getFood(int $pult): Food
    {
        $spreadsheet = $this->reader->load($this->filename);
        $nameCoordinate = $this->getCoordinates($pult)["name"];
        $priceCoordinate = $this->getCoordinates($pult)["price"];
        $name = $spreadsheet->getActiveSheet()->getCell($nameCoordinate)->getCalculatedValue();
        $price = $spreadsheet->getActiveSheet()->getCell($priceCoordinate)->getCalculatedValue();

        return new Food($name, $price, $this->type, $this->TODAY, 'HU', 1);
    }
}