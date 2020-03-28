<?php

namespace App\DataFixtures;

use App\Entity\Club;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class ClubFixtures extends Fixture implements DependentFixtureInterface
{
    const REF = 'club_%s';

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 22; $i++) {
            $name = $faker->city;

            $club = new Club();
            $club
                ->setName('FC ' . $name)
                ->setLogo("https://via.placeholder.com/150/CCCCCC/FFFFFF/?text=FC" . substr($name, 0, 1))
                ->setCreationDate($faker->dateTimeBetween('-100 years', '-50 years'))
                ->addPresident($this->getReference(sprintf(PresidentFixtures::REF, $i)))
                ->addSeason($this->getReference(sprintf(SeasonFixtures::REF, 0)));

            $start = $i * 22;
            for ($j = $start; $j < $start + 23; $j++) {
                $club->addPlayer($this->getReference(sprintf(PlayerFixtures::REF, $j)));
            }

            $manager->persist($club);

            $this->setReference(sprintf(self::REF, $i), $club);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PresidentFixtures::class,
            PlayerFixtures::class,
            SeasonFixtures::class
        ];
    }
}
