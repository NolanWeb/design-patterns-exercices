<?php
require('../vendor/autoload.php');

use App\Factory\VehicleFactory;

# Essayer d'utiliser votre factory ici

// Création de la factory
$factory = new VehicleFactory();

echo "=== Test de création par type ===\n";

// Création des véhicules par type
$bicycle = $factory->createVehicle('bicycle');
echo "Vélo créé : \n";
echo "- Coût par km : " . $bicycle->getCostPerKm() . "€\n";
echo "- Type de carburant : " . $bicycle->getFuelType() . "\n\n";

$car = $factory->createVehicle('car');
echo "Voiture créée : \n";
echo "- Coût par km : " . $car->getCostPerKm() . "€\n";
echo "- Type de carburant : " . $car->getFuelType() . "\n\n";

$truck = $factory->createVehicle('truck');
echo "Camion créé : \n";
echo "- Coût par km : " . $truck->getCostPerKm() . "€\n";
echo "- Type de carburant : " . $truck->getFuelType() . "\n\n";

echo "=== Test de création par besoins ===\n";

// Test avec différentes distances et poids
$scenarios = [
    ['distance' => 10, 'weight' => 15, 'description' => 'Courte distance, poids léger'],
    ['distance' => 25, 'weight' => 15, 'description' => 'Longue distance, poids léger'],
    ['distance' => 10, 'weight' => 50, 'description' => 'Courte distance, poids moyen'],
    ['distance' => 5, 'weight' => 250, 'description' => 'Courte distance, poids lourd']
];

foreach ($scenarios as $scenario) {
    $vehicle = $factory->createVehicleByRequirements($scenario['distance'], $scenario['weight']);
    echo "\nScénario : " . $scenario['description'] . "\n";
    echo "- Distance : " . $scenario['distance'] . " km\n";
    echo "- Poids : " . $scenario['weight'] . " kg\n";
    echo "- Véhicule choisi : " . get_class($vehicle) . "\n";
    echo "- Coût par km : " . $vehicle->getCostPerKm() . "€\n";
}