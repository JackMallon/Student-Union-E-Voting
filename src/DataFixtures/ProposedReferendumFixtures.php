<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\ProposedReferendum;

class ProposedReferendumFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $referendum = new ProposedReferendum();
        $referendum->setPublisher("B00096918");
        $referendum->setDetails('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.');
        $referendum->setSupport(30);
        $manager->persist($referendum);

        $manager->flush();
    }
}


