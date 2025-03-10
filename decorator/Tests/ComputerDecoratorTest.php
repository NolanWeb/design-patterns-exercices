<?php

namespace Test;

use PHPUnit\Framework\TestCase;

use App\Laptop;
use App\GPUDecorator;
use App\OLEDScreenDecorator;

class ComputerDecoratorTest extends TestCase
{
    public function testBasicLaptop()
    {
        $laptop = new Laptop();
        
        $this->assertSame(400, $laptop->getPrice());
        $this->assertSame("A laptop computer", $laptop->getDescription());
    }

    public function testLaptopWithGPU()
    {
        $laptop = new Laptop();
        $laptopWithGPU = new GPUDecorator($laptop);
        
        $this->assertSame(800, $laptopWithGPU->getPrice()); // 400 (base) + 400 (GPU)
        $this->assertSame("A laptop computer, with dedicated GPU", $laptopWithGPU->getDescription());
    }

    public function testLaptopWithOLEDScreen()
    {
        $laptop = new Laptop();
        $laptopWithOLED = new OLEDScreenDecorator($laptop);
        
        $this->assertSame(700, $laptopWithOLED->getPrice()); // 400 (base) + 300 (OLED)
        $this->assertSame("A laptop computer, with OLED screen", $laptopWithOLED->getDescription());
    }

    public function testLaptopWithBothUpgrades()
    {
        $laptop = new Laptop();
        $laptopWithGPU = new GPUDecorator($laptop);
        $laptopWithBoth = new OLEDScreenDecorator($laptopWithGPU);
        
        $this->assertSame(1100, $laptopWithBoth->getPrice()); // 400 (base) + 400 (GPU) + 300 (OLED)
        $this->assertSame("A laptop computer, with dedicated GPU, with OLED screen", $laptopWithBoth->getDescription());
    }
}