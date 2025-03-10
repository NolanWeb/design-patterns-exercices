<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Factory\VehicleFactory;
use App\Entity\Bicycle;
use App\Entity\Car;
use App\Entity\Truck;

class VehicleFactoryTest extends TestCase
{
    private VehicleFactory $factory;

    protected function setUp(): void
    {
        $this->factory = new VehicleFactory();
    }

    public function testCreateVehicleByType()
    {
        // Test création vélo
        $bicycle = $this->factory->createVehicle('bicycle');
        $this->assertInstanceOf(Bicycle::class, $bicycle);
        $this->assertEquals(0.1, $bicycle->getCostPerKm());
        $this->assertEquals("human", $bicycle->getFuelType());

        // Test création voiture
        $car = $this->factory->createVehicle('car');
        $this->assertInstanceOf(Car::class, $car);
        $this->assertEquals(0.5, $car->getCostPerKm());
        $this->assertEquals("gasoline", $car->getFuelType());

        // Test création camion
        $truck = $this->factory->createVehicle('truck');
        $this->assertInstanceOf(Truck::class, $truck);
        $this->assertEquals(1.0, $truck->getCostPerKm());
        $this->assertEquals("diesel", $truck->getFuelType());
    }

    public function testCreateVehicleByRequirements()
    {
        // Test pour petite distance et poids léger -> vélo
        $vehicle1 = $this->factory->createVehicleByRequirements(10, 15);
        $this->assertInstanceOf(Bicycle::class, $vehicle1);

        // Test pour grande distance mais poids léger -> voiture
        $vehicle2 = $this->factory->createVehicleByRequirements(25, 15);
        $this->assertInstanceOf(Car::class, $vehicle2);

        // Test pour petite distance mais poids moyen -> voiture
        $vehicle3 = $this->factory->createVehicleByRequirements(10, 25);
        $this->assertInstanceOf(Car::class, $vehicle3);

        // Test pour poids lourd -> camion
        $vehicle4 = $this->factory->createVehicleByRequirements(10, 250);
        $this->assertInstanceOf(Truck::class, $vehicle4);
    }

    public function testCreateVehicleWithInvalidType()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->factory->createVehicle('invalid');
    }
}
