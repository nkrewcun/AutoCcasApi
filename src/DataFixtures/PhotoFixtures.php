<?php

namespace App\DataFixtures;

use App\Entity\Photo;
use App\Repository\AnnonceRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class PhotoFixtures extends Fixture implements DependentFixtureInterface
{
    private $annonceRepository;

    public function __construct(AnnonceRepository $annonceRepository)
    {
        $this->annonceRepository = $annonceRepository;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $annonces = $this->annonceRepository->findAll();
        $nbAnnonces = count($annonces);
        for ($i = 0; $i < $nbAnnonces; $i++) {
            $photo = new Photo();
            $photo->setAnnonce($annonces[$i]);
            $photo->setLabel($faker->words(2, true));
            $photo->setSource('photo' . $i . '.jpg');;
            $manager->persist($photo);

            $photo = new Photo();
            $photo->setAnnonce($annonces[$i]);
            $photo->setLabel($faker->words(2, true));
            $photo->setSource('picture' . $i . '.jpg');
            $manager->persist($photo);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [AnnonceFixtures::class];
    }
}
