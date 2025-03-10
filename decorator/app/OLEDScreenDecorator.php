<?php

namespace App;

class OLEDScreenDecorator extends ComputerDecorator
{
    public function getPrice(): int
    {
        return $this->computer->getPrice() + 300; // OLED screen adds 300 to the price
    }

    public function getDescription(): string
    {
        return $this->computer->getDescription() . ", with OLED screen";
    }
}
