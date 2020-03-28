<?php

namespace App\DataFixtures;

use App\Entity\ChampionShip;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ChampionShipFixtures extends Fixture implements DependentFixtureInterface
{
    const REF = 'champion_ship_%s';

    public function load(ObjectManager $manager)
    {
        $names = [
            'Ligue 1',
        ];
        foreach ($names as $key => $name) {
            $championShip = new ChampionShip();
            $championShip
                ->setName($name)
                ->setCountry($this->getReference(sprintf(CountryFixtures::REF, 0)));

            $manager->persist($championShip);

            $this->setReference(sprintf(self::REF, $key), $championShip);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CountryFixtures::class
        ];
    }
}
