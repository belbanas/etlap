<?php

namespace app\models;

use JsonSerializable;

class Food implements JsonSerializable
{
    private ?string $soup;
    private ?string $mainCourse;
    private ?string $secondCourse;
    private ?string $price;
    private string $type;
    private string $day;
    private string $language;
    private int $pult;
    private ?string $mainCoursePicture;

    /**
     * Food constructor.
     * @param string|null $soup
     * @param string|null $mainCourse
     * @param string|null $secondCourse
     * @param string|null $price
     * @param string $type
     * @param string $day
     * @param string $language
     * @param int $pult
     */
    public function __construct(?string $soup, ?string $mainCourse, ?string $secondCourse, ?string $price, string $type, string $day, string $language, int $pult)
    {
        $this->soup = $soup;
        $this->mainCourse = $mainCourse;
        $this->secondCourse = $secondCourse;
        $this->price = $price;
        $this->type = $type;
        $this->day = $day;
        $this->language = $language;
        $this->pult = $pult;
        $this->mainCoursePicture = "";
    }

    /**
     * @return string|null
     */
    public function getMainCourse(): ?string
    {
        return $this->mainCourse;
    }

    /**
     * @return string|null
     */
    public function getSoup(): ?string
    {
        return $this->soup;
    }


    /**
     * @return int|null
     */
    public function getPrice(): ?string
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }


    /**
     * @return string
     */
    public function getDay(): string
    {
        return $this->day;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @return int
     */
    public function getPult(): int
    {
        return $this->pult;
    }

    /**
     * @param string|null $mainCourse
     */
    public function setMainCourse(?string $mainCourse): void
    {
        $this->mainCourse = $mainCourse;
    }

    /**
     * @param string|null $soup
     */
    public function setSoup(?string $soup): void
    {
        $this->soup = $soup;
    }

    /**
     * @return string|null
     */
    public function getMainCoursePicture(): ?string
    {
        return $this->mainCoursePicture;
    }

    /**
     * @param string|null $mainCoursePicture
     */
    public function setMainCoursePicture(?string $mainCoursePicture): void
    {
        $this->mainCoursePicture = $mainCoursePicture;
    }

    /**
     * @return string|null
     */
    public function getSecondCourse(): ?string
    {
        return $this->secondCourse;
    }

    /**
     * @param string|null $secondCourse
     */
    public function setSecondCourse(?string $secondCourse): void
    {
        $this->secondCourse = $secondCourse;
    }



    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
        return [
            "soup" => $this->soup,
            "main" => $this->mainCourse,
            "second" => $this->secondCourse,
            "price" => $this->price,
            "type" => $this->type,
            "day" => $this->day,
            "language" => $this->language,
            "pult" => $this->pult,
            "mainPic" => $this->mainCoursePicture,
        ];
    }
}