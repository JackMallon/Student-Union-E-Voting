<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('Jack');
        $user->setEmail('jack.mallonk@gmail.com');
        $user->setRole('ROLE_ADMIN');
        $plainTextPassword = 'secret';
        $encodedPassword = $this->passwordEncoder->encodePassword($user, $plainTextPassword);
        $user->setPassword($encodedPassword);
        $manager->persist($user);

        $user2 = new User();
        $user2->setUsername('B00096918');
        $user2->setEmail('jack.mallonk@gmail.com');
        $user2->setRole('ROLE_STUDENT');
        $plainTextPassword = 'secret';
        $encodedPassword = $this->passwordEncoder->encodePassword($user2, $plainTextPassword);
        $user2->setPassword($encodedPassword);
        $manager->persist($user2);

        $manager->flush();
    }
}
