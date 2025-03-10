<?php

namespace App\Entity;

class Bicycle implements Vehicle {
    private $costPerKm;
    private $fuelType;
    private $maxWeight;

    public function __construct() {
        $this->costPerKm = 0.1; // 0.1€ par km
        $this->fuelType = "human";
        $this->maxWeight = 20; // 20kg max
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