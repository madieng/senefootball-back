<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    const REF = 'article_%s';

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 500; $i++) {
            $article = new Article();
            $article
                ->setTitle($faker->sentence(mt_rand(3, 6)))
                ->setDescription($faker->paragraph())
                ->setContent($faker->paragraph(mt_rand(6, 10)))
                ->setCaption('https://via.placeholder.com/600x300')
                ->setCreatedBy($this->getReference(sprintf(AdminFixtures::REF, mt_rand(0, 9))));

            $manager->persist($article);

            $this->setReference(sprintf(self::REF, $i), $article);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AdminFixtures::class
        ];
    }
}
