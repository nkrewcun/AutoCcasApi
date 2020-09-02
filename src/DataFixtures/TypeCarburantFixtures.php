<?php

namespace App\DataFixtures;

use App\Entity\TypeCarburant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeCarburantFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $carburant = new TypeCarburant();
        $carburant->setNom('Essence');
        $manager->persist($carburant);

        $carburant = new TypeCarburant();
        $carburant->setNom('Diesel');
        $manager->persist($carburant);

        $carburant = new TypeCarburant();
        $carburant->setNom('Électrique');
        $manager->persist($carburant);

        $carburant = new TypeCarburant();
        $carburant->setNom('Hybride');
        $manager->persist($carburant);

        $manager->flush();
    }
}
