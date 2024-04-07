<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $category1 = new Category();
        $category1->setName("Web");
        $manager->persist($category1);
        $this->addReference("Web", $category1);

        $category2 = new Category();
        $category2->setName("Mobile");
        $manager->persist($category2);
        $this->addReference("Mobile", $category2);

        $category3 = new Category();
        $category3->setName("Logiciel");
        $manager->persist($category3);
        $this->addReference("Logiciel", $category3);

        $manager->flush();
    }
}
