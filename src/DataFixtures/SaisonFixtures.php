<?php

namespace App\DataFixtures;

use App\Entity\Saison;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use faker\factory;
use Faker\ORM\Propel\Populator;

class SaisonFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for($i=0; $i < 25; $i++) {

        $saison = new Saison();
        $populator = new Populator($faker);

        $populator->addEntity('nombre', 5);
        $saison->setAnnee($faker->year());
        $saison->setDescription($faker->paragraphs(3, true));

        $saison->setProgram($this->getReference('program_' . $faker->numberBetween(0, 5)));

        $manager->persist($saison);
        }

        $manager->flush();
    }

    public function getDependencies()

    {

        return [

            ProgramFixtures::Fixtures::class,

        ];

    }
}
