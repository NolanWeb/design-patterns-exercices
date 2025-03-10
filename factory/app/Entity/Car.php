<?php

namespace App\Entity;

class Car implements Vehicle {
    private $costPerKm;
    private $fuelType;
    private $maxWeight;

    public function __construct() {
        $this->costPerKm = 0.5; // 0.5€ par km
        $this->fuelType = "gasoline";
        $this->maxWeight = 200; // 200kg max
    }

    public function getCostPerKm() {
        return $this->costPerKm;
    }

    public function getFuelType() {
        return $this->fuelType;
    }

    public function getMaxWeight() {
        return $this->maxWeight;
    }
}