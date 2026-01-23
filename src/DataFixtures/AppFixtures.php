<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    // Injecte la dépendance UserPasswordHasherInterface pour instancier la classe 'User'
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Instancie Faker pour des données fictives
        $faker = Factory::create();
        // Instancie 20 objets de type 'User'
        for ($i = 0; $i < 20; $i++) {
            $user = new User($this->passwordHasher);
            // Email fictif
            $user->setEmail($faker->email());
            // Rôle par défaut
            $user->setRoles(["ROLE_USER"]);
            // Mot de passe simple à retenir
            $user->setPassword("123456");
            // Ajouter à l'entity Manager
            $manager->persist($user);
        }
        // Synchronise avec la BDD
        $manager->flush();
    }
}
