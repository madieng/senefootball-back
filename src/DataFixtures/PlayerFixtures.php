<?php

namespace App\DataFixtures;

use App\Entity\Player;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class PlayerFixtures extends Fixture implements DependentFixtureInterface
{
    const REF = 'player_%s';

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 1000; $i++) {
            $player = new Player();
            $player
                ->setFirstname($faker->firstName('male'))
                ->setLastname($faker->lastName)
                ->setUsername($faker->userName)
                ->setEmail($faker->email)
                ->setDateOfBirth($faker->dateTimeBetween('-35 years', '-16 years'))
                ->setAvatar("https://randomuser.me/api/portraits/women/" . $i . ".jpg")
                ->addSeason($this->getReference(sprintf(SeasonFixtures::REF, 0)));

            $manager->persist($player);

            $this->setReference(sprintf(self::REF, $i), $player);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SeasonFixtures::class
        ];
    }
}
