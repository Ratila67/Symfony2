<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Music;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $Faker = Factory::create();

        for ($i=0; $i <= 10; $i++){
            $music = new Music();
            $music->setName("Music" . $i);
            $music->setUrl("url" . $i);
            $music->setAuthor($Faker->name());

            $manager->persist($music);

        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
