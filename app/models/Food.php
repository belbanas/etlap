<?php

namespace app\models;

use JsonSerializable;

class Food implements JsonSerializable
{
    private ?string $name;
    private ?int $price;
    private string $type;
    private string $day;
    private string $language;
    private int $pult;

    /**
     * Food constructor.
     * @param string|null $name
     * @param int|null $price
     * @param string $type
     * @param string $day
     * @param string $language
     * @param int $pult
     */
    public function __construct(?string $name, ?int $price, string $type, string $day, string $language, int $pult)
    {
        $this->name = $name;
        $this->price = $price;
        $this->type = $type;
        $this->day = $day;
        $this->language = $language;
        $this->pult = $pult;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
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


    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
        return [
            "name" => $this->name,
            "price" => $this->price,
            "type" => $this->type,
            "day" => $this->day,
            "language" => $this->language,
            "pult" => $this->pult
        ];
    }
}