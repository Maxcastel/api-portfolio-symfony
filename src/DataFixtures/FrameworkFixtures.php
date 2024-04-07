<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Framework;

class FrameworkFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $framework1 = new Framework();
        $framework1->setName('Symfony');
        $manager->persist($framework1);
        $this->addReference("Symfony", $framework1);

        $framework2 = new Framework();
        $framework2->setName('NodeJS');
        $manager->persist($framework2);
        $this->addReference("NodeJS", $framework2);

        $framework3 = new Framework();
        $framework3->setName('ExpressJS');
        $manager->persist($framework3);
        $this->addReference("ExpressJS", $framework3);

        $framework4 = new Framework();
        $framework4->setName('React');
        $manager->persist($framework4);
        $this->addReference("React", $framework4);

        $framework5 = new Framework();
        $framework5->setName('React Native');
        $manager->persist($framework5);
        $this->addReference("React Native", $framework5);

        $framework6 = new Framework();
        $framework6->setName('Laravel');
        $manager->persist($framework6);
        $this->addReference("Laravel", $framework6);

        $framework7 = new Framework();
        $framework7->setName('Spring');
        $manager->persist($framework7);
        $this->addReference("Spring", $framework7);
        
        $framework8 = new Framework();
        $framework8->setName('JavaFX');
        $manager->persist($framework8);
        $this->addReference("JavaFX", $framework8);

        $manager->flush();
    }
}
