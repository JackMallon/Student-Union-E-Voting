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
        $referendum->set()
        $referendum->setDetails('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.');
        $referendum->setTitle('Future referendum');
        $manager->persist($referendum);

        $referendum2 = new Referendum();
        $referendum2->setStartDate(date('m/d/Y'));
        $referendum2->setDetails('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.');
        $referendum2->setTitle('Todays referendum');
        $manager->persist($referendum2);

        $referendum3 = new Referendum();
        $referendum3->setStartDate('05/25/2019');
        $referendum3->setDetails('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.');
        $referendum3->setTitle('Another future referendum');
        $manager->persist($referendum3);

        $referendum6 = new Referendum();
        $referendum6->setStartDate('05/26/2019');
        $referendum6->setDetails('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.');
        $referendum6->setTitle('Yet another referendum in the future');
        $manager->persist($referendum6);

        $referendum4 = new Referendum();
        $referendum4->setStartDate('04/15/2019');
        $referendum4->setDetails('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.');
        $referendum4->setTitle('Past referendum');
        $manager->persist($referendum4);

        $referendum5 = new Referendum();
        $referendum5->setStartDate('03/12/2019');
        $referendum5->setDetails('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.');
        $referendum5->setTitle('Another past referendum');
        $manager->persist($referendum5);

        $referendum7 = new Referendum();
        $referendum7->setStartDate('03/28/2019');
        $referendum7->setDetails('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.');
        $referendum7->setTitle('Yet another referendum in the past');
        $manager->persist($referendum7);

        $manager->flush();
    }
}


