<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 20; $i++) {
            $product = new Product();
            $product->setDescription($faker->text());
            $product->setName($faker->name());
            $product->setPrice($faker->randomNumber());
            $product->setExpirationDate($faker->dateTime());
            $manager->persist($product);
        }

        $manager->flush();
    }
}
