<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Config;

class ConfigTest extends TestCase
{
    public function testSingletonInstance()
    {
        // Vérifie que nous obtenons la même instance
        $config1 = Config::getInstance();
        $config2 = Config::getInstance();
        
        $this->assertSame($config1, $config2, "Les deux instances devraient être identiques");
    }

    public function testConfigValues()
    {
        $config = Config::getInstance();

        // Test des valeurs simples
        $this->assertTrue($config->get('debug'), "La valeur de debug devrait être true");
        $this->assertEquals(
            "hh9nfvs6pqsSEpwJynJgNnx4aYAydXrEBzBJFFxvhFpPEjbNn",
            $config->get('apiKey'),
            "La clé API ne correspond pas"
        );

        // Test des valeurs imbriquées
        $this->assertEquals("localhost", $config->get('db.host'), "L'hôte de la base de données ne correspond pas");
        $this->assertEquals("root", $config->get('db.user'), "L'utilisateur de la base de données ne correspond pas");
        $this->assertEquals("test", $config->get('db.name'), "Le nom de la base de données ne correspond pas");
    }

    public function testNonExistentKey()
    {
        $config = Config::getInstance();
        
        // Test d'une clé qui n'existe pas
        $this->assertNull($config->get('nonexistent'), "Une clé inexistante devrait retourner null");
        $this->assertNull($config->get('db.nonexistent'), "Une clé imbriquée inexistante devrait retourner null");
    }

    public function testAllSettings()
    {
        $config = Config::getInstance();
        $settings = $config->getAllSettings();

        // Vérifie que nous avons toutes les sections principales
        $this->assertArrayHasKey('db', $settings, "Les paramètres devraient contenir une section 'db'");
        $this->assertArrayHasKey('debug', $settings, "Les paramètres devraient contenir une clé 'debug'");
        $this->assertArrayHasKey('apiKey', $settings, "Les paramètres devraient contenir une clé 'apiKey'");

        // Vérifie la structure de la section db
        $this->assertArrayHasKey('host', $settings['db'], "La section db devrait contenir un paramètre 'host'");
        $this->assertArrayHasKey('user', $settings['db'], "La section db devrait contenir un paramètre 'user'");
        $this->assertArrayHasKey('pass', $settings['db'], "La section db devrait contenir un paramètre 'pass'");
        $this->assertArrayHasKey('name', $settings['db'], "La section db devrait contenir un paramètre 'name'");
    }
}
