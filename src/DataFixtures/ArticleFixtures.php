<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use App\DataFixtures\UserFixtures;
use App\Entity\Article;


use Faker;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{


    public function load(ObjectManager $manager): void
    {
            $faker = Faker\Factory::create("fr_FR");

        for ($i = 0; $i < 15; $i++) {
         $article = new Article;
            $article->setTitre($faker->realText($maxNbChars = 20, $indexSize = 2));
            $article->setResume($faker->realText($maxNbChars = 200, $indexSize = 2));
            $article->setDescription($faker->realText($maxNbChars = 400, $indexSize = 2));
            $article->setCreatedAt(new \DateTimeImmutable());
            $article->setImage('blogIt.png');

            
            $article->setUser($this->getReference(UserFixtures::USER_REFERENCE));

            $manager->persist($article);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }

        public function getDependencies()
        {
            return [
                UserFixtures::class,
            ];
        }
    
    }


