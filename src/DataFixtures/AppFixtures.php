<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use App\Entity\Product;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $fake = Factory::create();

        //List of possibles product values
        $arrayOfName = ["à vendre", "d'occasion", "pas cher", "de collection", "en bon etat"];
        $arrayOfBrand = ["Almost", "Antiz Skateboards", "Anti Hero", "Baker", "Blind", "Creature", "Chocolate", "Deathwish", "DGK Skateboards", "Element", "Enjoi", "Flip", "Girl", "Jart Skateboards", "PALACE SKATEBOARDS", "Plan B", "Polar Skateboards", "Primitive"];
        $arrayOfModel = ["Ingot", "Team Bold", "HKD Faded", "Sanbongi Queen", "Provost Nihon", "Crusyberghs Nihon", "Way Dodo", "Jamal Pro", "Lucas Pro", "Gonzales Two Tone", "Oliveira Blast", "Dressen Good Dog", "Classic Dot", "Abstarct", "Chroma", "Team Eyes", "Blue Pills"];
        $arrayOfType = ["Street", "Longboard", "Cruiser", "Street"];
        $arrayOfSize = [7.25, 7.5, 7.75, 8, 8.25, 8.5, 8.75, 9, 9.25];
        $arrayOfDescription = ["Super planche en état impec", "Board d'occasion", "Etat moyen mais encore skatable", "Contactez moi sur mon email pour plus d'informations", "Pas très usée, bon pop !"];

        for ($u = 0; $u < 10; $u++) {

            $user = new User();

            $passHash = $this->encoder->encodePassword($user, 'password');

            $user->setEmail($fake->email)
                ->setPassword($passHash);

            $manager->persist($user);

            for ($p = 0; $p < random_int(0,3); $p++) {

                $brand = $arrayOfBrand[random_int(0, count($arrayOfBrand)-1)];
                $model = $arrayOfModel[random_int(0, count($arrayOfModel)-1)];
                $type = $arrayOfType[random_int(0, count($arrayOfType)-1)];
                $size = $arrayOfSize[random_int(0, count($arrayOfSize)-1)];

                $productRandomInfos = random_int(0,4);
                $name = $type." ".$arrayOfName[$productRandomInfos];
                $description = $arrayOfDescription[$productRandomInfos];

                // $product = new Product();

                $product = (new Product())->setVendor($user)
                    ->setName($name)
                    ->setModel($model)
                    ->setBrand($brand)
                    ->setType($type)
                    ->setSize($size)
                    ->setgripped((bool)random_int(0,1))
                    ->setPrice(random_int(15*100, 80*100) / 100)
                    ->setDescription($description);

                $manager->persist($product);
            }
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
