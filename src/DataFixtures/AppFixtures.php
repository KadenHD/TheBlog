<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr_FR');

        for($i=0;$i<10;$i++){
            $user = new User();
            $user->setUsername($faker->userName())
                ->setPassword($faker->password())
                ->setEmail($faker->email())
                ->setDateCreation($faker->dateTimeBetween('-3 months'))
                ->setDateModif($faker->dateTimeBetween('-3 months'));
            $user->setRoles(['ROLE_USER']);

            $manager->persist($user);

            $article = new Article();
            $article->setTitre($faker->sentence(2,true))
                ->setAuteur($user)
                ->setContenu($faker->sentence(10,true))
                ->setDate($faker->dateTimeBetween('-3 months'));

            $manager->persist($article);
        }

        $manager->flush();
    }
}
