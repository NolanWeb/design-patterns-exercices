<?php

namespace App\Entity;

class Truck implements Vehicle {
    private $costPerKm;
    private $fuelType;
    private $maxWeight;

    public function __construct() {
        $this->costPerKm = 1.0; // 1€ par km
        $this->fuelType = "diesel";
        $this->maxWeight = 1000; // 1000kg max
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