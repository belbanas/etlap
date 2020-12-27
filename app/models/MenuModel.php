<?php


namespace app\models;

use InvalidArgumentException;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Reader\IReader;


class MenuModel
{
    protected string $TODAY;
    protected int $WEEK;
    protected ?string $filename;
    private IReader $reader;
    protected string $type;
    protected string $language;


    /**
     * MenuModel constructor.
     * @param string $language
     * @throws Exception
     */
    public function __construct(string $language)
    {
        $this->language = $language;
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
        try {
            $spreadsheet = $this->reader->load($this->filename);
        } catch (InvalidArgumentException $e) {
            echo $e->getMessage().' Nem található az excel fájl a következőhöz: '.$this->type;
        }
        $nameCoordinate = $this->getCoordinates($pult)["name"];
        $priceCoordinate = $this->getCoordinates($pult)["price"];
        try {
            $name = $spreadsheet->getActiveSheet()->getCell($nameCoordinate)->getCalculatedValue();
        } catch (\PhpOffice\PhpSpreadsheet\Calculation\Exception $e) {
            echo $e->getMessage().'. Hiba a beolvasott excel koordinátában! (NÉV) ';
        } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
            echo $e->getMessage().'. Hiba a beolvasott excel koordinátában! (NÉV) ';
        }
        try {
            $price = $spreadsheet->getActiveSheet()->getCell($priceCoordinate)->getCalculatedValue();
        } catch (\PhpOffice\PhpSpreadsheet\Calculation\Exception $e) {
            echo $e->getMessage().'. Hiba a beolvasott excel koordinátában! (ÁR) ';
        } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
            echo $e->getMessage().'. Hiba a beolvasott excel koordinátában! (ÁR) ';
        }

        return new Food($name, $price, $this->type, $this->TODAY, $this->language, $pult);
    }
}