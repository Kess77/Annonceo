<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr_fr');

        for ($i = 0; $i < 3; $i++) {
            $categorie = new Categorie;
            $categorie->setNom($faker->lastName);
            $reference = 'categorie_' . $i;
            $this->addReference($reference, $categorie);
            $manager->persist($categorie);
        }

        $manager->flush();
    }
}
