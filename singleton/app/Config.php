<?php

namespace App;

class Config
{
    private static ?Config $instance = null;
    private array $settings;

    private function __construct()
    {
        // Charge la configuration depuis le fichier
        $this->settings = require __DIR__ . '/../config/config.php';
    }

    // Empêche le clonage de l'instance
    private function __clone() {}

    // Empêche la désérialisation de l'instance
    private function __wakeup() {}

    public static function getInstance(): Config
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function get(string $key)
    {
        // Gestion des clés imbriquées (ex: "db.host")
        $keys = explode('.', $key);
        $value = $this->settings;

        foreach ($keys as $k) {
            if (!isset($value[$k])) {
                return null;
            }
            $value = $value[$k];
        }

        return $value;
    }

    // Méthode utilitaire pour les tests
    public function getAllSettings(): array
    {
        return $this->settings;
    }
}