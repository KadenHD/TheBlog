<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct( UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr_FR');

        //Formateurs
        for($i=0;$i<5;$i++){
            $user = new User();
            $user->setUsername($faker->userName())
                ->setPassword($this->encoder->encodePassword($user, $faker->password()))
                ->setEmail($faker->email())
                ->setDateCreation($faker->dateTimeBetween('-3 months'))
                ->setDateModif($faker->dateTimeBetween('-3 months'))
                ->setDescription($faker->text($maxNbChars = 200))
                ->setRoles(['ROLE_FORMATEUR']);
            $manager->persist($user);
            
            $article = new Article();
            $article->setTitre($faker->sentence(2,true))
                ->setAuteur($user)
                ->setContenu($faker->sentence(10,true))
                ->setDate($faker->dateTimeBetween('-3 months'))
                ->setImage($faker->imageUrl($width = 150, $height = 150));
            $manager->persist($article);
        }

        //Responsable de formation
        for($i=0;$i<5;$i++){
            $user = new User();
            $user->setUsername($faker->userName())
                ->setPassword($this->encoder->encodePassword($user, $faker->password()))
                ->setEmail($faker->email())
                ->setDateCreation($faker->dateTimeBetween('-3 months'))
                ->setDateModif($faker->dateTimeBetween('-3 months'))
                ->setDescription($faker->text($maxNbChars = 200))
                ->setRoles(['ROLE_RESPONSABLE']);
            $manager->persist($user);
            
            $article = new Article();
            $article->setTitre($faker->sentence(2,true))
                ->setAuteur($user)
                ->setContenu($faker->sentence(10,true))
                ->setDate($faker->dateTimeBetween('-3 months'))
                ->setImage($faker->imageUrl($width = 150, $height = 150));
            $manager->persist($article);
        }

        //Assistant
        for($i=0;$i<5;$i++){
            $user = new User();
            $user->setUsername($faker->userName())
                ->setPassword($this->encoder->encodePassword($user, $faker->password()))
                ->setEmail($faker->email())
                ->setDateCreation($faker->dateTimeBetween('-3 months'))
                ->setDateModif($faker->dateTimeBetween('-3 months'))
                ->setDescription($faker->text($maxNbChars = 200))
                ->setRoles(['ROLE_ASSISTANT']);
            $manager->persist($user);
            
            $article = new Article();
            $article->setTitre($faker->sentence(2,true))
                ->setAuteur($user)
                ->setContenu($faker->sentence(10,true))
                ->setDate($faker->dateTimeBetween('-3 months'))
                ->setImage($faker->imageUrl($width = 150, $height = 150));
            $manager->persist($article);
        }

        //Admin
        for($i=0;$i<5;$i++){
            $user = new User();
            $user->setUsername($faker->userName())
                ->setPassword($this->encoder->encodePassword($user, $faker->password()))
                ->setEmail($faker->email())
                ->setDateCreation($faker->dateTimeBetween('-3 months'))
                ->setDateModif($faker->dateTimeBetween('-3 months'))
                ->setDescription($faker->text($maxNbChars = 200))
                ->setRoles(['ROLE_ADMIN']);
            $manager->persist($user);
            
            $article = new Article();
            $article->setTitre($faker->sentence(2,true))
                ->setAuteur($user)
                ->setContenu($faker->sentence(10,true))
                ->setDate($faker->dateTimeBetween('-3 months'))
                ->setImage($faker->imageUrl($width = 150, $height = 150));
            $manager->persist($article);
        }

        //Super Admin
        for($i=0;$i<5;$i++){
            $user = new User();
            $user->setUsername($faker->userName())
                ->setPassword($this->encoder->encodePassword($user, $faker->password()))
                ->setEmail($faker->email())
                ->setDateCreation($faker->dateTimeBetween('-3 months'))
                ->setDateModif($faker->dateTimeBetween('-3 months'))
                ->setDescription($faker->text($maxNbChars = 200))
                ->setRoles(['ROLE_SUPER_ADMIN']);
            $manager->persist($user);
            
            $article = new Article();
            $article->setTitre($faker->sentence(2,true))
                ->setAuteur($user)
                ->setContenu($faker->sentence(10,true))
                ->setDate($faker->dateTimeBetween('-3 months'))
                ->setImage($faker->imageUrl($width = 150, $height = 150));
            $manager->persist($article);
        }

        //Product tests
        for($i=0;$i<1;$i++){
            $user = new User();
            $user->setUsername("formateur")
                ->setPassword($this->encoder->encodePassword($user, 'formateur'))
                ->setEmail("formateur@formateur.formateur")
                ->setDateCreation($faker->dateTimeBetween('-3 months'))
                ->setDateModif($faker->dateTimeBetween('-3 months'))
                ->setDescription("formateur")
                ->setRoles(['ROLE_FORMATEUR']);
            $manager->persist($user);
        }

        for($i=0;$i<1;$i++){
            $user = new User();
            $user->setUsername("admin")
                ->setPassword($this->encoder->encodePassword($user, 'admin'))
                ->setEmail("admin@admin.admin")
                ->setDateCreation($faker->dateTimeBetween('-3 months'))
                ->setDateModif($faker->dateTimeBetween('-3 months'))
                ->setDescription("admin")
                ->setRoles(['ROLE_ADMIN']);
            $manager->persist($user);
        }

        for($i=0;$i<1;$i++){
            $user = new User();
            $user->setUsername("sadmin")
                ->setPassword($this->encoder->encodePassword($user, 'sadmin'))
                ->setEmail("sadmin@sadmin.sadmin")
                ->setDateCreation($faker->dateTimeBetween('-3 months'))
                ->setDateModif($faker->dateTimeBetween('-3 months'))
                ->setDescription("superadmin")
                ->setRoles(['ROLE_SUPER_ADMIN']);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
