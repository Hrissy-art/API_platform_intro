<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Car;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Provider\Fakecar;



class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {  

        $faker = Factory::create ('bg_BG');
        $faker ->addProvider(new Fakecar($faker));
        
        $brands = [];
        for ($i = 0; $i < 30; $i++)
        {

            $brand = new Brand;
            $brand-> setName ($faker ->realTextBetween(3,10));
            $manager->persist($brand);
            $brands[] = $brand;

            $manager->flush();
        }
            
        $cars = [];
        for ($i = 0; $i < 30; $i++){

            $car = new Car;
            $car-> setName ($faker ->realTextBetween(3,10));
            $car->setYear($faker-> year());
            $car->setType($faker->vehicleType());
            $car->setNbKm($faker -> randomNumber());
            $car->setBrand($brands[$faker->numberBetween(0, count($brands) - 1)]);
            $car->setDoorCount($faker->vehicleDoorCount());
            $car->setFuelType($faker->vehicleFuelType());

            $manager->persist($car);
            $cars[] = $car;
        }
        $manager->flush();
    


}
}
