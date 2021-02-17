<?php


namespace app\models;

use InvalidArgumentException;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Reader\IReader;


class MenuModel
{
    protected string $TODAY;
    protected ?string $WEEK;
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
        $this->filename = './etlapok/' . $this->WEEK . '_Het_HU.xls';
    }

    /**
     * @param int $pult a pult sorszáma
     * @return string[]
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
            return new Food("Missing Soup", "Missing Main Course", "Missing second course", 0, $this->type, $this->TODAY, $this->language, $pult);
        }
        $soupCoordinate = $this->getCoordinates($pult)["soup"];
        $mainCoordinate = $this->getCoordinates($pult)["main"];
        $secondCoordinate = $this->getCoordinates($pult)["second"];
        $priceCoordinate = $this->getCoordinates($pult)["price"];
        $pictureCoordinate = $this->getCoordinates($pult)["picture"];
        $soup = "";
        $main = "";
        $second = "";
        $price = "";
        $picture = "";
        try {
            $soup = $spreadsheet->getSheet(0)->getCell($soupCoordinate)->getCalculatedValue();
        } catch (\PhpOffice\PhpSpreadsheet\Calculation\Exception $e) {
//            echo $e->getMessage() . '. Hiba a beolvasott excel koordinátában! (LEVES) ';
        } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
//            echo $e->getMessage() . '. Hiba a beolvasott excel koordinátában! (LEVES) ';
        }
        try {
            $main = $spreadsheet->getSheet(0)->getCell($mainCoordinate)->getCalculatedValue();
        } catch (\PhpOffice\PhpSpreadsheet\Calculation\Exception $e) {
//            echo $e->getMessage() . '. Hiba a beolvasott excel koordinátában! (FŐÉTEL) ';
        } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
//            echo $e->getMessage() . '. Hiba a beolvasott excel koordinátában! (FŐÉTEL) ';
        }
        try {
            $second = $spreadsheet->getSheet(0)->getCell($secondCoordinate)->getCalculatedValue();
        } catch (\PhpOffice\PhpSpreadsheet\Calculation\Exception $e) {
//            echo $e->getMessage() . '. Hiba a beolvasott excel koordinátában! (ÁR) ';
        } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
//            echo $e->getMessage() . '. Hiba a beolvasott excel koordinátában! (ÁR) ';
        }
        try {
            $price = $spreadsheet->getSheet(0)->getCell($priceCoordinate)->getCalculatedValue();
        } catch (\PhpOffice\PhpSpreadsheet\Calculation\Exception $e) {
//            echo $e->getMessage() . '. Hiba a beolvasott excel koordinátában! (ÁR) ';
        } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
//            echo $e->getMessage() . '. Hiba a beolvasott excel koordinátában! (ÁR) ';
        }
        try {
            $picture = $spreadsheet->getSheet(0)->getCell($pictureCoordinate)->getCalculatedValue();
        } catch (\PhpOffice\PhpSpreadsheet\Calculation\Exception $e) {
//            echo $e->getMessage() . '. Hiba a beolvasott excel koordinátában! (ÁR) ';
        } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
//            echo $e->getMessage() . '. Hiba a beolvasott excel koordinátában! (ÁR) ';
        }


        if ($soup == null) {
            $soup = "";
        } else if ($main === null) {
            $main = "";
        } else if ($second === null) {
            $second = "";
        }
        if ($soupCoordinate === null || $priceCoordinate === null) {
            $soup = null;
        }

        $food = new Food($soup, $main, $second, $price, $this->type, $this->TODAY, $this->language, $pult);
        $food->setMainCoursePicture($picture);

//        $this->setPictureFilename($food);

        if ($this->language != "HU") {
            $this->translateFood($food);
            return $food;
        } else {
            return $food;
        }

//        return $food;
    }

    public function setPictureFilename(Food $food)
    {
        $soup = $food->getSoup();
        $main = $food->getMainCourse();
        $translateTable = "./etlapok/forditotabla.xlsx";
        $spreadsheet = $this->reader->load($translateTable);
        $dataArray = $spreadsheet->getSheet(0)->rangeToArray('A1:E60', null, true, true, false);

        foreach ($dataArray as $key => $value) {
            if ($value[0] === $soup) {
                $food->setSoupPicture($value[4]);
            }
            if ($value[0] === $main) {
                $food->setMainCoursePicture($value[4]);
            }
        }
    }

    public function translateFood(Food $food)
    {
        $soup = $food->getSoup();
        $main = $food->getMainCourse();
//        $translateTable = "./etlapok/forditotabla.xlsx";
        $translateTable = $this->filename;

        $spreadsheet = $this->reader->load($translateTable);
        $dataArray = $spreadsheet->getSheet(1)->rangeToArray('B2:E60', null, true, true, false);


        foreach ($dataArray as $key => $value) {
            if ($value[0] === $soup) {
                if ($this->language === "EN") {
                    $food->setSoup($value[1]);
                } else if ($this->language === "UA") {
                    $food->setSoup($value[2]);
                } else if ($this->language === "KR") {
                    $food->setSoup($value[3]);
                }
            }
            if ($value[0] === $main) {
                if ($this->language === "EN") {
                    $food->setMainCourse($value[1]);
                } else if ($this->language === "UA") {
                    $food->setMainCourse($value[2]);
                } else if ($this->language === "KR") {
                    $food->setMainCourse($value[3]);
                }
            }
        }
    }
}