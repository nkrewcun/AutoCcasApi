<?php

namespace App\DataFixtures;

use App\Entity\Annonce;
use App\Repository\GarageRepository;
use App\Repository\ModeleRepository;
use App\Repository\TypeCarburantRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AnnonceFixtures extends Fixture implements DependentFixtureInterface
{
    private $modeleRepository;
    private $carburantRepository;
    private $garageRepository;

    public function __construct(ModeleRepository $modeleRepository, TypeCarburantRepository $carburantRepository, GarageRepository $garageRepository)
    {
        $this->modeleRepository = $modeleRepository;
        $this->carburantRepository = $carburantRepository;
        $this->garageRepository = $garageRepository;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $modeles = $this->modeleRepository->findAll();
        $carburants = $this->carburantRepository->findAll();
        $garages = $this->garageRepository->findAll();
        for ($i = 0; $i < 200; $i++)
        {
            $annonce = new Annonce();
            $annonce->setReference($faker->regexify('[A-Z0-9]{10}'));
            $annonce->setTitre($faker->realText(50));
            $annonce->setDescriptionCourte($faker->realText(255));
            $annonce->setDescription($faker->paragraphs(5, true));
            $annonce->setAnneeMiseCirculation(random_int(1990, 2020));
            $annonce->setKilometrage(random_int(2000, 200000));
            $annonce->setPrix(random_int(500, 20000));
            $annonce->setDatePublication($faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now', $timezone = 'Europe/Paris'));
            $annonce->setCarburant($carburants[random_int(0, count($carburants)-1)]);
            $annonce->setModele($modeles[random_int(0, count($modeles)-1)]);
            $annonce->setGarage($garages[random_int(0, count($garages)-1)]);
            $manager->persist($annonce);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [ModeleFixtures::class, TypeCarburantFixtures::class, GarageFixtures::class];
    }
}
