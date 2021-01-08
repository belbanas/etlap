<?php

namespace app\models;

use JsonSerializable;

class Food implements JsonSerializable
{
    private ?string $mainCourse;
    private ?string $soup;
    private ?int $price;
    private string $type;
    private string $day;
    private string $language;
    private int $pult;
    private ?string $soupPicture;
    private ?string $mainCoursePicture;

    /**
     * Food constructor.
     * @param string|null $soup
     * @param string|null $mainCourse
     * @param int|null $price
     * @param string $type
     * @param string $day
     * @param string $language
     * @param int $pult
     */
    public function __construct(?string $soup, ?string $mainCourse, ?int $price, string $type, string $day, string $language, int $pult)
    {
        $this->mainCourse = $mainCourse;
        $this->soup = $soup;
        $this->price = $price;
        $this->type = $type;
        $this->day = $day;
        $this->language = $language;
        $this->pult = $pult;
        $this->mainCoursePicture = "";
        $this->soupPicture = "";
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
    public function getPrice(): ?int
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
    public function getSoupPicture(): ?string
    {
        return $this->soupPicture;
    }

    /**
     * @param string|null $soupPicture
     */
    public function setSoupPicture(?string $soupPicture): void
    {
        $this->soupPicture = $soupPicture;
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


    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
        return [
            "main" => $this->mainCourse,
            "soup" => $this->soup,
            "price" => $this->price,
            "type" => $this->type,
            "day" => $this->day,
            "language" => $this->language,
            "pult" => $this->pult,
            "mainPic" => $this->mainCoursePicture,
            "soupPic" => $this->soupPicture
        ];
    }
}