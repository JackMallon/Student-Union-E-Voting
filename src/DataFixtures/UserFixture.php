<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('B00096918');

        $user->setEmail('B00096918@student.itb.ie');

        $plainTextPassword = 'secret';
        $encodedPassword = $this->passwordEncoder->encodePassword($user, $plainTextPassword);
        $user->setPassword($encodedPassword);

        $manager->persist($user);

        $manager->flush();
    }
}
