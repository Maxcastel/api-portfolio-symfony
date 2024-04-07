<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Project;
use Faker\Factory;

class ProjectFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $projet1 = new Project();
        $projet1->setTitle("CashCash");
        $projet1->setDescription($faker->sentence($faker->numberBetween(6, 15)));
        $projet1->setDate(date_create($faker->date()));
        $projet1->addFramework($this->getReference("NodeJS"));
        $projet1->addFramework($this->getReference("React"));
        $projet1->addLanguage($this->getReference("JavaScript"));
        $projet1->addLanguage($this->getReference("TypeScript"));
        $projet1->setType($this->getReference("Scolaire"));
        $projet1->setCategory($this->getReference("Web"));
        $projet1->setClasse($this->getReference("sio2"));
        $manager->persist($projet1);

        $projet2 = new Project();
        $projet2->setTitle("CashCash React Native");
        $projet2->setDescription($faker->sentence($faker->numberBetween(6, 15)));
        $projet2->setDate(date_create($faker->date()));
        $projet2->addFramework($this->getReference("NodeJS"));
        $projet2->addFramework($this->getReference("React Native"));
        $projet2->addLanguage($this->getReference("JavaScript"));
        $projet2->addLanguage($this->getReference("TypeScript"));
        $projet2->setType($this->getReference("Scolaire"));
        $projet2->setCategory($this->getReference("Mobile"));
        $projet2->setClasse($this->getReference("sio2"));
        $manager->persist($projet2);

        $projet3 = new Project();
        $projet3->setTitle("Portfolio");
        $projet3->setDescription($faker->sentence($faker->numberBetween(6, 15)));
        $projet3->setDate(date_create($faker->date()));
        $projet3->addFramework($this->getReference("Symfony"));
        $projet3->addFramework($this->getReference("React"));
        $projet3->addLanguage($this->getReference("PHP"));
        $projet3->addLanguage($this->getReference("TypeScript"));
        $projet3->setType($this->getReference("Personnel"));
        $projet3->setCategory($this->getReference("Web"));
        $manager->persist($projet3);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            FrameworkFixtures::class,
            LanguageFixtures::class,
            TypeFixtures::class,
            CategoryFixtures::class,
            ClasseFixtures::class,
        ];
    }
}
