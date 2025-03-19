<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Music;
use App\Entity\Category;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $Faker = Factory::create();

        //Creation de catégories
        $categories = [];
        $categoryNames = ['Pop', 'Rock', 'Jazz', 'Classique', 'Hip-Hop'];

        foreach ($categoryNames as $name) {
            $category = new Category();
            $category->setName($name);
            $category->setDescription("Musique " . strtolower($name));
            $manager->persist($category);
            $categories[] = $category;
        }

        $manager->flush();

        for ($i=0; $i <= 10; $i++){
            $music = new Music();
            $music->setName("Music" . $i);
            $music->setUrl("url" . $i);
            $music->setAuthor($Faker->name());

            //on initialise les dates
            $now = new \DateTimeImmutable();
            $music->setCreatedAt($now);
            $music->setUpdatedAt($now);

            //Attribution d'une catégories aléatoire à chaque musique
            $randomCategory = $categories[array_rand($categories)];
            $manager->persist($music);

        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }  
}
