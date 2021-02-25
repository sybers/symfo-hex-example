<?php

namespace App\Infrastructure\DataFixtures;

use App\Domain\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setEmail("admin@example.com");
        // eclipse

        $admin->setPassword($this->passwordEncoder->encodePassword($admin, "eclipse"));
        
        $manager->persist($admin);

        $user = new User();
        $user->setEmail("user@example.com");
        $user->setPassword($this->passwordEncoder->encodePassword($user, "eclipse"));

        $manager->persist($user);

        $manager->flush();
    }
}
