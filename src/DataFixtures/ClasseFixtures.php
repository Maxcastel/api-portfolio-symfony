<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Classe;

class ClasseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $sio1 = new Classe();
        $sio1->setName("SIO 1");
        $manager->persist($sio1);
        $this->addReference('sio1', $sio1);

        $sio2 = new Classe();
        $sio2->setName("SIO 2");
        $manager->persist($sio2);
        $this->addReference('sio2', $sio2);

        $BUT3 = new Classe();
        $BUT3->setName("BUT 3");
        $manager->persist($BUT3);
        $this->addReference('but3', $BUT3);

        $manager->flush();
    }
}
