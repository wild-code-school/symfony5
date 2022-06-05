<?php

namespace App\DataFixtures;

use App\Entity\Saison;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SaisonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($p = 1; $p <= 5; $p++) {
            for ($s = 1; $s <= 5; $s++) {
                $saison = new Saison();
                $saison
                    ->setAnnee($faker->year())
                    ->setDescription($faker->paragraphs(3, true))
                    ->setProgram($this->getReference('program_' . $p))
                    ->setNombre($s);

                $manager->persist($saison);
                $this->addReference('program_' . $p . '_saison_' . $s, $saison);
            }
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProgramFixtures::class,
        ];
    }
}