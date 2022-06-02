<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\ORM\Propel\Populator;

class EpisodeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for($i=0; $i < 250; $i++) {

            $populator = new Populator($faker);
            $episode = new Episode();
            $populator->addEntity('number', 10);
            $episode->setSynopsis($faker->paragraph(3, true));
            $episode->setTitle($faker->word(1, true));
            $episode->setSaison($this->getReference('saison_' . $faker->numberBetween(0, 25)));
            $manager->persist($episode);

        }

        $manager->flush();

    }

    public function getDependencies()

    {

        return [

            SaisonFixtures::class,

        ];

    }
}
