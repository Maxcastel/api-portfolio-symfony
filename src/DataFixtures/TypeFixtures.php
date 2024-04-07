<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Type;

class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $type1 = new Type();
        $type1->setName("Scolaire");
        $manager->persist($type1);
        $this->addReference('Scolaire', $type1);

        $type2 = new Type();
        $type2->setName("Personnel");
        $manager->persist($type2);
        $this->addReference('Personnel', $type2);

        $type3 = new Type();
        $type3->setName("Professionnel");
        $manager->persist($type3);
        $this->addReference('Professionnel', $type3);

        $manager->flush();
    }
}
