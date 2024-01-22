<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;



use App\Entity\User;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use Faker;

class UserFixtures extends Fixture
{
    public const USER_REFERENCE = 'admin_user';
    private UserPasswordHasherInterface $hash;
    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface) {
        $this->hash = $userPasswordHasherInterface;
    }

    public function load(ObjectManager $manager): void
    {
            $faker = Faker\Factory::create("fr_FR");

        for ($i = 1; $i < 15; $i++) {
            $user = new User();
            $user->setPrenom($faker->firstName);
            $user->setNom($faker->lastName);
            $user->setEmail($faker->email);
            $user->setPassword($this->hash->hashPassword($user, "test123"));
            $user->setTelephone($faker->phoneNumber);

            $manager->persist($user);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
        $this->addReference(self::USER_REFERENCE, $user);
    }
}
