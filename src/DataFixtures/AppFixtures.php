<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture

{
    //  Creation de variable mdp pour pouvoir hasher le mdp
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        //creation des comptes utilisateurs
        for ($i = 1; $i <= 10; $i++) {
            $utilisateur = new Utilisateur;

            $utilisateur
                ->setEmail('user' . $i . '@mail.fr')
                ->setPassword($this->passwordEncoder->encodePassword($utilisateur, 'user' . $i))
                ->setSpeudo($faker->userName)
                ->setPrenom($faker->firstName)
                ->setNom($faker->lastName)
                ->setTelephone($faker->phoneNumber)
                ->setInscription($faker->dateTime);

            $manager->persist($utilisateur);
        }


        // creation des moderateurs
        for ($i = 1; $i <= 5; $i++) {
            $moderateur = new Utilisateur;

            $moderateur
                ->setEmail('mode' . $i . '@mail.fr')
                ->setPassword($this->passwordEncoder->encodePassword($moderateur, 'mode' . $i))
                ->setSpeudo($faker->userName)
                ->setPrenom($faker->firstName)
                ->setNom($faker->lastName)
                ->setTelephone($faker->phoneNumber)
                ->setInscription($faker->dateTime)
                ->setRoles(['ROLE_MODERATEUR']);

            $manager->persist($moderateur);
        }


        //creation administrateur
        for ($i = 0; $i <= 2; $i++) {
            $administrateur = new Utilisateur;

            $administrateur
                ->setEmail('admin' . $i . '@mail.fr')
                ->setPassword($this->passwordEncoder->encodePassword($administrateur, 'admin' . $i))
                ->setSpeudo($faker->userName)
                ->setPrenom($faker->firstName)
                ->setNom($faker->lastName)
                ->setTelephone($faker->phoneNumber)
                ->setInscription($faker->dateTime)
                ->setRoles(['ROLE_ADMINISTRATEUR']);

            $manager->persist($administrateur);
        }


        $manager->flush();
    }
}
