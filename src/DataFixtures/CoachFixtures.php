<?php

namespace App\DataFixtures;

use App\Entity\Coach;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class CoachFixtures extends Fixture
{
    const REF = 'coach_%s';

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 22; $i++) {
            $coach = new Coach();
            $coach
                ->setFirstname($faker->firstName('male'))
                ->setLastname($faker->lastName)
                ->setUsername($faker->userName)
                ->setEmail($faker->email)
                ->setDateOfBirth($faker->dateTimeBetween('-60 years', '-40 years'))
                ->setAvatar("https://randomuser.me/api/portraits/women/" . mt_rand(90, 99) . ".jpg");
            $manager->persist($coach);
            $this->setReference(sprintf(self::REF, $i), $coach);
        }

        $manager->flush();
    }
}
