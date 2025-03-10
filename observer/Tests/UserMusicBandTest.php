<?php

namespace Test;

use PHPUnit\Framework\TestCase;

use App\User;
use App\MusicBand;

class UserMusicBandTest extends TestCase
{
    public function testUserNotificationWhenBandAddsDate()
    {
        // Création des utilisateurs
        $albert = new User('Albert Mudhat');
        $michelle = new User('Michelle Ectron');
        $yves = new User('Yves Haigé');

        // Création du groupe
        $band = new MusicBand('Daft PHPunk');

        // Albert et Michelle suivent le groupe, mais pas Yves
        $band->attach($albert);
        $band->attach($michelle);
        // Yves ne suit pas le groupe

        // Le groupe ajoute une date de concert
        $band->addNewConcertDate('19/11/2027', 'Bercy');

        // Albert et Michelle doivent être notifiés, mais pas Yves
        $this->assertTrue($albert->isNotified(), "Albert devrait être notifié car il suit le groupe");
        $this->assertTrue($michelle->isNotified(), "Michelle devrait être notifiée car elle suit le groupe");
        $this->assertFalse($yves->isNotified(), "Yves ne devrait pas être notifié car il ne suit pas le groupe");
    }

    public function testUserStopsFollowingBand()
    {
        // Création des utilisateurs et du groupe
        $user = new User('Bob Dylan');
        $band = new MusicBand('The Beatles');

        // Bob commence à suivre le groupe
        $band->attach($user);

        // Le groupe ajoute un concert
        $band->addNewConcertDate('01/01/2025', 'London');
        $this->assertTrue($user->isNotified(), "Bob devrait être notifié du premier concert");

        // Bob arrête de suivre le groupe
        $band->detach($user);
        $user->resetNotification(); // On réinitialise la notification

        // Le groupe ajoute un autre concert
        $band->addNewConcertDate('02/01/2025', 'Paris');
        $this->assertFalse($user->isNotified(), "Bob ne devrait pas être notifié car il ne suit plus le groupe");
    }

    public function testMultipleConcertNotifications()
    {
        $user = new User('John Doe');
        $band = new MusicBand('Pink Floyd');

        $band->attach($user);

        // Premier concert
        $band->addNewConcertDate('01/03/2025', 'New York');
        $this->assertTrue($user->isNotified(), "L'utilisateur devrait être notifié du premier concert");

        // Réinitialisation de la notification
        $user->resetNotification();
        $this->assertFalse($user->isNotified(), "La notification devrait être réinitialisée");

        // Deuxième concert
        $band->addNewConcertDate('02/03/2025', 'Los Angeles');
        $this->assertTrue($user->isNotified(), "L'utilisateur devrait être notifié du deuxième concert");
    }
}