<?php

namespace App;

class GPUDecorator extends ComputerDecorator
{
    public function getPrice(): int
    {
        return $this->computer->getPrice() + 400; // GPU adds 400 to the price
    }

    public function getDescription(): string
    {
        return $this->computer->getDescription() . ", with dedicated GPU";
    }
}
