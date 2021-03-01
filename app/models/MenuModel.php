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
    protected string $coordinateFile;


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

        $currentTime = date('H:i:s');
        $yesterday = date("l", strtotime("yesterday"));
        $prevWeek = date("W", strtotime("yesterday"));
        if ($currentTime < "01:30:00") {
            $this->TODAY = $yesterday;
            $this->WEEK = $prevWeek;
        }

        $this->filename = './etlapok/' . $this->WEEK . '_Het_HU.xls';
        $inputFileType = IOFactory::identify($this->filename);
        $this->reader = IOFactory::createReader($inputFileType);
    }

    /**
     * @param int $pult a pult sorszáma
     * @return string[]
     */
    public function getCoordinates(int $pult): ?array
    {
        $str = file_get_contents($this->coordinateFile);
        $coordinates = json_decode($str, true);

        return [
            "start" => $coordinates[$pult][$this->TODAY]["start"],
            "end" => $coordinates[$pult][$this->TODAY]["end"],
        ];
    }

    /**
     * @param int $pult
     * @return Food|null
     */
    public function getFood(int $pult): ?Food
    {
        try {
            $spreadsheet = $this->reader->load($this->filename);
        } catch (InvalidArgumentException $e) {
            echo $e->getMessage() . ' Nem található adat';
            return new Food("Missing Soup", "Missing Main Course", "Missing second course", 0, $this->type, $this->TODAY, $this->language, $pult);
        }

        $soup = "";
        $main = "";
        $second = "";

        $startCoordinate = $this->getCoordinates($pult)["start"];
        $endCoordinate = $this->getCoordinates($pult)["end"];
        try {
            $foodArray = $spreadsheet->getSheet(2)->rangeToArray($startCoordinate . ":" . $endCoordinate, null, true, true, false)[0];
        } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
            $foodArray = [];
        }

        if ($this->language === "HU") {
            $soup = $foodArray[0];
            $main = $foodArray[1];
            $second = $foodArray[2];
        } else if ($this->language === "EN") {
            $soup = $foodArray[5];
            $main = $foodArray[6];
            $second = $foodArray[7];
        } else if ($this->language === "UA") {
            $soup = $foodArray[8];
            $main = $foodArray[9];
            $second = $foodArray[10];
        } else if ($this->language === "KR") {
            $soup = $foodArray[11];
            $main = $foodArray[12];
            $second = $foodArray[13];
        }

        $price = $foodArray[3];
        $picture = $foodArray[4];

        if ($soup == null || $soup === 0 || $soup === '#N/A') {
            $soup = "";
        }
        if ($main === null || $main === 0 || $main === '#N/A') {
            $main = "";
        }
        if ($second === null || $second === 0 || $second === '#N/A') {
            $second = "";
        }

        $food = new Food($soup, $main, $second, $price, $this->type, $this->TODAY, $this->language, $pult);
        $food->setMainCoursePicture($picture);

        return $food;
    }
}