<?php

namespace App\DataFixtures;

use App\Entity\Commentator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class CommentatorFixtures extends Fixture
{
    const REF = 'commentator_%s';

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 200; $i++) {
            $commentator = new Commentator();
            $commentator
                ->setFirstname($faker->firstName)
                ->setLastname($faker->lastName)
                ->setUsername($faker->userName)
                ->setEmail($faker->email)
                ->setDateOfBirth($faker->dateTimeBetween('-35 years', '-16 years'))
                ->setAvatar("https://randomuser.me/api/portraits/women/" . mt_rand(80, 89) . ".jpg");
            $manager->persist($commentator);
            $this->setReference(sprintf(self::REF, $i), $commentator);
        }

        $manager->flush();
    }
}
