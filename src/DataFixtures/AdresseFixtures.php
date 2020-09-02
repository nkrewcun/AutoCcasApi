<?php

namespace App\DataFixtures;

use App\Entity\Adresse;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AdresseFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $adresse = new Adresse();
            $adresse->setCodePostal(str_replace(' ', '', $faker->postcode));
            $adresse->setCommune($faker->city);
            $adresse->setLigne1($faker->streetAddress);
            $manager->persist($adresse);
        }
        $manager->flush();
    }
}
