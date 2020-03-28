<?php

namespace App\DataFixtures;

use App\Entity\Match;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class MatchFixtures extends Fixture implements DependentFixtureInterface
{
    const REF = 'match_%s';

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 1000; $i++) {
            $match = new Match();
            $match
                ->setHost($this->getReference(sprintf(ClubFixtures::REF, mt_rand(0, 21))))
                ->setVisitor($this->getReference(sprintf(ClubFixtures::REF, mt_rand(0, 21))))
                ->setDate($faker->dateTimeBetween('now', '+1 years'))
                ->setHour($faker->dateTimeAD())
                ->setStatus('A VENIR');

            $manager->persist($match);
            $this->setReference(sprintf(self::REF, $i), $match);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ClubFixtures::class
        ];
    }
}
