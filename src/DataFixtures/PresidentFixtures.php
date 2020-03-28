<?php

namespace App\DataFixtures;

use App\Entity\President;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class PresidentFixtures extends Fixture
{
    const REF = 'president_%s';

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 22; $i++) {
            $president = new President();
            $president
                ->setFirstname($faker->firstName('male'))
                ->setLastname($faker->lastName)
                ->setUsername($faker->userName)
                ->setEmail($faker->email)
                ->setDateOfBirth($faker->dateTimeBetween('-60 years', '-40 years'))
                ->setAvatar("https://randomuser.me/api/portraits/women/" . mt_rand(90, 99) . ".jpg");
            $manager->persist($president);
            $this->setReference(sprintf(self::REF, $i), $president);
        }

        $manager->flush();
    }
}
