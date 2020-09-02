<?php

namespace App\DataFixtures;

use App\Entity\Marque;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MarqueFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $marque = new Marque();
        $marque->setNom('Renault');
        $manager->persist($marque);

        $marque = new Marque();
        $marque->setNom('Peugeot');
        $manager->persist($marque);

        $marque = new Marque();
        $marque->setNom('Citroën');
        $manager->persist($marque);

        $marque = new Marque();
        $marque->setNom('Audi');
        $manager->persist($marque);

        $marque = new Marque();
        $marque->setNom('Volkswagen');
        $manager->persist($marque);

        $marque = new Marque();
        $marque->setNom('Opel');
        $manager->persist($marque);

        $manager->flush();
    }
}
