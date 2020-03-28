<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    const REF = 'comment_%s';

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 2000; $i++) {
            $comment = new Comment();
            $comment
                ->setTitle($faker->sentence(mt_rand(3, 6)))
                ->setContent($faker->paragraph(mt_rand(6, 10)))
                ->setCreatedBy($this->getReference(sprintf(CommentatorFixtures::REF, mt_rand(0, 199))))
                ->setArticle($this->getReference(sprintf(ArticleFixtures::REF, mt_rand(0, 499))));

            $manager->persist($comment);

            $this->setReference(sprintf(self::REF, $i), $comment);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ArticleFixtures::class,
            CommentatorFixtures::class
        ];
    }
}
