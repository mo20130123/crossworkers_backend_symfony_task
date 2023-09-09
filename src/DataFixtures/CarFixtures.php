<?php

namespace App\DataFixtures;

use App\Entity\Car;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CarFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       /* *************** START BMW ******************/
        $car_1 = new Car();
        $car_1->setBrand($this->getReference('brand_1'));
        $car_1->setName('x1');
        $car_1->setGasEconomyRate(3);
        $manager->persist($car_1);

        $car_2 = new Car();
        $car_2->setName('XM');
        $car_2->setBrand($this->getReference('brand_1'));
        $car_2->setGasEconomyRate(5);
        $manager->persist($car_2);
       /* *************** END BMW ******************/

       /* *************** START Mercedes-Benz ******************/
        $car_3 = new Car();
        $car_3->setBrand($this->getReference('brand_2'));
        $car_3->setName('C Class');
        $car_3->setGasEconomyRate(3);
        $manager->persist($car_3);

        $car_4 = new Car();
        $car_4->setName('S Class');
        $car_4->setBrand($this->getReference('brand_2'));
        $car_4->setGasEconomyRate(2);
        $manager->persist($car_4);

        $car_5 = new Car();
        $car_5->setName('C Class');
        $car_5->setBrand($this->getReference('brand_2'));
        $car_5->setGasEconomyRate(3);
        $manager->persist($car_5);
       /* *************** END Mercedes-Benz ******************/

       /* *************** START Ford ******************/
        $car_6 = new Car();
        $car_6->setBrand($this->getReference('brand_3'));
        $car_6->setName('Focus');
        $car_6->setGasEconomyRate(3);
        $manager->persist($car_6);

        $car_7 = new Car();
        $car_7->setName('Fiesta');
        $car_7->setBrand($this->getReference('brand_3'));
        $car_7->setGasEconomyRate(2);
        $manager->persist($car_7);

        $car_8 = new Car();
        $car_8->setName('Edge');
        $car_8->setBrand($this->getReference('brand_3'));
        $car_8->setGasEconomyRate(3);
        $manager->persist($car_8);
       /* *************** END Ford ******************/


        $manager->flush();
    }
}
