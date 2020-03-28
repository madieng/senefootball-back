<?php

namespace App\DataFixtures;

use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CountryFixtures extends Fixture
{
    const REF = 'country_%s';

    public function load(ObjectManager $manager)
    {
        $names = [
            ['name' => 'Sénégal', 'code' => 'SN'],
        ];
        foreach ($names as $key => ['name' => $name, 'code' => $code]) {
            $country = new Country();
            $country
                ->setName($name)
                ->setCode($code);

            $manager->persist($country);

            $this->setReference(sprintf(self::REF, $key), $country);
        }

        $manager->flush();
    }
}
