<?php

namespace app\models;

class Menu
{
    private ?string $name;
    private ?int $price;
    private string $type;
    private string $day;
    private string $language;
    private int $counter;

    /**
     * Menu constructor.
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


}