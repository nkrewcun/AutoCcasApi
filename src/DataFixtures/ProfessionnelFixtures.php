<?php

namespace App\DataFixtures;

use App\Entity\Professionnel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;

class ProfessionnelFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1; $i <= 5; $i++) {
            $professionnel = new Professionnel();
            $professionnel->setPrenom($faker->firstName);
            $professionnel->setNom($faker->lastName);
            $professionnel->setEmail($faker->email);
            $professionnel->setRoles(['ROLE_USER']);
            $professionnel->setNumeroSiret($faker->numerify('##############'));
            $professionnel->setPassword($this->encoder->encodePassword(
                $professionnel,
                'professionnel' . $i
            ));
            $manager->persist($professionnel);
        }

        $manager->flush();
    }
}
