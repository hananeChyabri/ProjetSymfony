<?php
namespace App\DataFixtures;

use Faker;
use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserFixtures extends Fixture
{
    
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
         $this->passwordHasher = $passwordHasher;
    }
    
    public function load(ObjectManager $manager)
    { $faker = Factory::create();
        for ($i = 0; $i < 2 ; $i++){
            $user = new User();
            $user->setEmail ("user".$i."@lala.com");
            $user->setPassword($this->passwordHasher->hashPassword(
                 $user,
                 'lePassword'.$i
             ));

            
             $user->setNom($faker->lastName());
           
             




            $manager->persist ($user);
        }
        $manager->flush();
    }
}