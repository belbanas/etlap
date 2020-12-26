<?php

namespace app\models;

class Food
{
    private ?string $name;
    private ?int $price;
    private string $type;
    private string $day;
    private string $language;
    private int $counter;

    /**
     * Food constructor.
     * @param string|null $name
     * @param int|null $price
     * @param string $type
     * @param string $day
     * @param string $language
     * @param int $counter
     */
    public function __construct(?string $name, ?int $price, string $type, string $day, string $language, int $counter)
    {
        $this->name = $name;
        $this->price = $price;
        $this->type = $type;
        $this->day = $day;
        $this->language = $language;
        $this->counter = $counter;
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
    public function getCounter(): int
    {
        return $this->counter;
    }


}