<?php

namespace App\DataFixtures;

use App\Entity\Garage;
use App\Repository\AdresseRepository;
use App\Repository\ProfessionnelRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class GarageFixtures extends Fixture implements DependentFixtureInterface
{
    private $adresseRepository;
    private $professionnelRepository;

    public function __construct(AdresseRepository $adresseRepository, ProfessionnelRepository $professionnelRepository)
    {
        $this->adresseRepository = $adresseRepository;
        $this->professionnelRepository = $professionnelRepository;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $adresses = $this->adresseRepository->findAll();
        $professionnels = $this->professionnelRepository->findAll();
        for ($i = 0; $i < 10; $i++) {
            $garage = new Garage();
            $garage->setNom($faker->company);
            $garage->setNumeroTel($faker->regexify('[0]{1}[1234569]{1}[0-9]{8}'));
            $garage->setAdresse($adresses[random_int(0, count($adresses)-1)]);
            $garage->setProfessionnel($professionnels[random_int(0, count($professionnels)-1)]);
            $manager->persist($garage);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [AdresseFixtures::class, ProfessionnelFixtures::class];
    }
}
