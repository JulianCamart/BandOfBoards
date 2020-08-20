<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;



class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //Array of possible value for bdd
        $arrayOfBrand = ["Sk8mafia", "Almost", "Toy Machine", "Baker", "EMillion", "Sour", "Anti Hero", "Girl", "Flip", "Santa Cruz", "Polar", "Element", "Jart", "Palace", "Real"];
        $arrayOfType = ["Cruiser", "Street", "Longboard"];
        $arrayOfSize = [7.25, 7.5, 7.8, 8, 8.25, 8.5];
        $arrayOfGripped = [true, false];

        for($i = 0; $i < 100; $i++) {
            $product = new Product();

            //set random values for bdd
            $product->setBrand($arrayOfBrand[random_int(0,count($arrayOfBrand)-1)]);
            $product->setType($arrayOfType[random_int(0,count($arrayOfType)-1)]);
            $product->setSize($arrayOfSize[random_int(0,count($arrayOfSize)-1)]);
            $product->setGripped($arrayOfGripped[random_int(0,count($arrayOfGripped)-1)]);

            $manager->persist($product);
        }

        $manager->flush();
    }
}
