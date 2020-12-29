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

    public function getFood(int $pult): ?Food
    {
        try {
            $spreadsheet = $this->reader->load($this->filename);
        } catch (InvalidArgumentException $e) {
            echo $e->getMessage() . ' Nem található az excel fájl a következőhöz: ' . $this->type . $this->language . " ";
            return new Food("Missing Soup", "Missign Main Course", 0, $this->type, $this->TODAY, $this->language, $pult);
        }
        $soupCoordinate = $this->getCoordinates($pult)["soup"];
        $mainCoordinate = $this->getCoordinates($pult)["main"];
        $priceCoordinate = $this->getCoordinates($pult)["price"];
        $soup = "";
        $main = "";
        $price = 0;
        try {
            $soup = $spreadsheet->getActiveSheet()->getCell($soupCoordinate)->getCalculatedValue();
        } catch (\PhpOffice\PhpSpreadsheet\Calculation\Exception $e) {
//            echo $e->getMessage() . '. Hiba a beolvasott excel koordinátában! (LEVES) ';
        } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
//            echo $e->getMessage() . '. Hiba a beolvasott excel koordinátában! (LEVES) ';
        }
        try {
            $main = $spreadsheet->getActiveSheet()->getCell($mainCoordinate)->getCalculatedValue();
        } catch (\PhpOffice\PhpSpreadsheet\Calculation\Exception $e) {
            echo $e->getMessage() . '. Hiba a beolvasott excel koordinátában! (FŐÉTEL) ';
        } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
            echo $e->getMessage() . '. Hiba a beolvasott excel koordinátában! (FŐÉTEL) ';
        }
        try {
            $price = $spreadsheet->getActiveSheet()->getCell($priceCoordinate)->getCalculatedValue();
        } catch (\PhpOffice\PhpSpreadsheet\Calculation\Exception $e) {
            echo $e->getMessage() . '. Hiba a beolvasott excel koordinátában! (ÁR) ';
        } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
            echo $e->getMessage() . '. Hiba a beolvasott excel koordinátában! (ÁR) ';
        }


        if ($soup == null) {
            $soup = "";
        }
        if ($soupCoordinate === null || $priceCoordinate === null) {
            $soup = null;
        }

        return new Food($soup, $main, $price, $this->type, $this->TODAY, $this->language, $pult);
    }
}