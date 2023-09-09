<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $brand_1 = new Brand();
        $brand_1->setName('BMW');
        $manager->persist($brand_1);

        $brand_2 = new Brand();
        $brand_2->setName('Mercedes-Benz');
        $manager->persist($brand_2);

        $brand_3 = new Brand();
        $brand_3->setName('Ford');
        $manager->persist($brand_3);

        $manager->flush();

        $this->addReference('brand_1',$brand_1);
        $this->addReference('brand_2',$brand_2);
        $this->addReference('brand_3',$brand_3);
    }
}
