<?php

namespace App\DataFixtures;

use App\Entity\Season;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    const REF = 'season_%s';

    public function load(ObjectManager $manager)
    {
        $dates = [
            [
                'startDate' => new \DateTime('2019-09-01'),
                'endDate'   => new \DateTime('2020-05-31')
            ],
        ];
        foreach ($dates as $k => ['startDate' => $startDate, 'endDate' => $endDate]) {
            $season = new Season();
            $season
                ->setStartDate($startDate)
                ->setEndDate($endDate)
                ->setChampionShip($this->getReference(sprintf(ChampionShipFixtures::REF, 0)));

            $manager->persist($season);

            $this->setReference(sprintf(self::REF, $k), $season);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ChampionShipFixtures::class
        ];
    }
}
