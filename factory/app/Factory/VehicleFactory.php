<?php

namespace App\Factory;

use App\Entity\Vehicle;
use App\Entity\Bicycle;
use App\Entity\Car;
use App\Entity\Truck;

class VehicleFactory
{
    // Méthode pour obtenir un véhicule par son type
    public function createVehicle(string $type): Vehicle
    {
        return match (strtolower($type)) {
            'bicycle' => new Bicycle(),
            'car' => new Car(),
            'truck' => new Truck(),
            default => throw new \InvalidArgumentException("Unknown vehicle type: $type"),
        };
    }

    // Méthode pour obtenir un véhicule en fonction de la distance et du poids
    public function createVehicleByRequirements(float $distance, float $weight): Vehicle
    {
        // Si le poids est supérieur à 200kg, on prend un camion
        if ($weight > 200) {
            return new Truck();
        }
        
        // Si le poids est supérieur à 20kg ou la distance supérieure à 20km, on prend une voiture
        if ($weight > 20 || $distance > 20) {
            return new Car();
        }
        
        // Pour les petites distances et poids légers, on prend un vélo
        return new Bicycle();
    }
}
