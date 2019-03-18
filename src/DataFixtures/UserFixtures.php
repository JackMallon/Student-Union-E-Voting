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
        $user1 = new User();
        $user1->setStudentid('B00096918');
        $user1->setRoles(['ROLE_ADMIN']);
        $plainTextPassword = 'password';
        $encodedPassword = $this->passwordEncoder->encodePassword($user1, $plainTextPassword);
        $user1->setPassword($encodedPassword);
        $manager->persist($user1);
        $manager->flush();
    }
}
