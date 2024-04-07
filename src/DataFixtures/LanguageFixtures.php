<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Language;

class LanguageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $language1 = new Language();
        $language1->setName('HTML');
        $manager->persist($language1);
        $this->addReference("HTML", $language1);

        $language2 = new Language();
        $language2->setName('CSS');
        $manager->persist($language2);
        $this->addReference("CSS", $language2);

        $language3 = new Language();
        $language3->setName('PHP');
        $manager->persist($language3);
        $this->addReference("PHP", $language3);

        $language4 = new Language();
        $language4->setName('JavaScript');
        $manager->persist($language4);
        $this->addReference("JavaScript", $language4);

        $language5 = new Language();
        $language5->setName('TypeScript');
        $manager->persist($language5);
        $this->addReference("TypeScript", $language5);

        $language6 = new Language();
        $language6->setName('Java');
        $manager->persist($language6);
        $this->addReference("Java", $language6);

        $manager->flush();
    }
}
