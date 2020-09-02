<?php

namespace App\DataFixtures;

use App\Entity\Modele;
use App\Repository\MarqueRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ModeleFixtures extends Fixture implements DependentFixtureInterface
{
    private $marqueRepository;

    public function __construct(MarqueRepository $marqueRepository)
    {
        $this->marqueRepository = $marqueRepository;
    }

    public function load(ObjectManager $manager)
    {
        $marque = $this->marqueRepository->findOneBy(['nom' => 'Renault']);

        $modele = new Modele();
        $modele->setMarque($marque);
        $modele->setNom('Twingo');
        $manager->persist($modele);

        $modele = new Modele();
        $modele->setMarque($marque);
        $modele->setNom('Scenic');
        $manager->persist($modele);

        $modele = new Modele();
        $modele->setMarque($marque);
        $modele->setNom('Clio');
        $manager->persist($modele);

        $modele = new Modele();
        $modele->setMarque($marque);
        $modele->setNom('Kadjar');
        $manager->persist($modele);

        $modele = new Modele();
        $modele->setMarque($marque);
        $modele->setNom('Talisman');
        $manager->persist($modele);

        $marque = $this->marqueRepository->findOneBy(['nom' => 'Peugeot']);

        $modele = new Modele();
        $modele->setMarque($marque);
        $modele->setNom('308');
        $manager->persist($modele);

        $modele = new Modele();
        $modele->setMarque($marque);
        $modele->setNom('508');
        $manager->persist($modele);

        $modele = new Modele();
        $modele->setMarque($marque);
        $modele->setNom('3008');
        $manager->persist($modele);

        $modele = new Modele();
        $modele->setMarque($marque);
        $modele->setNom('5008');
        $manager->persist($modele);

        $modele = new Modele();
        $modele->setMarque($marque);
        $modele->setNom('Rifter');
        $manager->persist($modele);

        $marque = $this->marqueRepository->findOneBy(['nom' => 'Citroën']);

        $modele = new Modele();
        $modele->setMarque($marque);
        $modele->setNom('C1');
        $manager->persist($modele);

        $modele = new Modele();
        $modele->setMarque($marque);
        $modele->setNom('C3');
        $manager->persist($modele);

        $modele = new Modele();
        $modele->setMarque($marque);
        $modele->setNom('C4');
        $manager->persist($modele);

        $modele = new Modele();
        $modele->setMarque($marque);
        $modele->setNom('C5');
        $manager->persist($modele);

        $modele = new Modele();
        $modele->setMarque($marque);
        $modele->setNom('Berlingo');
        $manager->persist($modele);

        $marque = $this->marqueRepository->findOneBy(['nom' => 'Audi']);

        $modele = new Modele();
        $modele->setMarque($marque);
        $modele->setNom('A3');
        $manager->persist($modele);

        $modele = new Modele();
        $modele->setMarque($marque);
        $modele->setNom('A4');
        $manager->persist($modele);

        $modele = new Modele();
        $modele->setMarque($marque);
        $modele->setNom('Q7');
        $manager->persist($modele);

        $modele = new Modele();
        $modele->setMarque($marque);
        $modele->setNom('TT');
        $manager->persist($modele);

        $modele = new Modele();
        $modele->setMarque($marque);
        $modele->setNom('e-tron');
        $manager->persist($modele);

        $marque = $this->marqueRepository->findOneBy(['nom' => 'Volkswagen']);

        $modele = new Modele();
        $modele->setMarque($marque);
        $modele->setNom('Polo');
        $manager->persist($modele);

        $modele = new Modele();
        $modele->setMarque($marque);
        $modele->setNom('Golf');
        $manager->persist($modele);

        $modele = new Modele();
        $modele->setMarque($marque);
        $modele->setNom('Touran');
        $manager->persist($modele);

        $modele = new Modele();
        $modele->setMarque($marque);
        $modele->setNom('T-Roc');
        $manager->persist($modele);

        $modele = new Modele();
        $modele->setMarque($marque);
        $modele->setNom('Passat');
        $manager->persist($modele);

        $marque = $this->marqueRepository->findOneBy(['nom' => 'Opel']);

        $modele = new Modele();
        $modele->setMarque($marque);
        $modele->setNom('Corsa');
        $manager->persist($modele);

        $modele = new Modele();
        $modele->setMarque($marque);
        $modele->setNom('Astra');
        $manager->persist($modele);

        $modele = new Modele();
        $modele->setMarque($marque);
        $modele->setNom('Crossland');
        $manager->persist($modele);

        $modele = new Modele();
        $modele->setMarque($marque);
        $modele->setNom('Insignia');
        $manager->persist($modele);

        $modele = new Modele();
        $modele->setMarque($marque);
        $modele->setNom('Mokka');
        $manager->persist($modele);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [MarqueFixtures::class];
    }
}
