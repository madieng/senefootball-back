<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AdminFixtures extends Fixture
{
    const REF = 'admin_%s';

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
            $admin = new Admin();
            $admin
                ->setFirstname($faker->firstName('male'))
                ->setLastname($faker->lastName)
                ->setUsername($faker->userName)
                ->setEmail($faker->email)
                ->setDateOfBirth($faker->dateTimeBetween('-35 years', '-16 years'))
                ->setAvatar("https://randomuser.me/api/portraits/women/" . mt_rand(90, 99) . ".jpg");

            $manager->persist($admin);

            $this->setReference(sprintf(self::REF, $i), $admin);
        }

        $manager->flush();
    }
}
