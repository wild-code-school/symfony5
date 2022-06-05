<?php

namespace App\DataFixtures;


use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const SERIES = [
        ['title' => "Les feux de l'amour", "synopsis" => "Bobby est branda ?", "reference" => "category_Action"],
        ['title' => "Ash vs EvilDead", "synopsis" => "BOOUUUUUUUh les méchants démons", "reference" => "category_Horreur"],
        ['title' => "La roue du temps", "synopsis" => "Je me drogue et je suis la réincarnation d'un dragon", "reference" => "category_Fantastique"],
        ['title' => "Flash", "synopsis" => "En zentai je cours plus vite", "reference" => "category_Aventure"],
        ['title' => "Castelvania", "synopsis" => "OLALALALA les vampires je les fouettent", "reference" => "category_Animation"]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SERIES as $key => $programName) {
            $key = $key + 1;

            $program = new Program();
        $program->setTitle($programName['title']);
        $program->setSynopsis($programName['synopsis']);
        $program->setCategory($this->getReference($programName['reference']));

            $this->addReference('program_' . $key, $program);
            $manager->persist($program);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
