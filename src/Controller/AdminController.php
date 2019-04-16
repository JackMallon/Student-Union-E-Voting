<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Repository\ProposedReferendumRepository;
use App\Repository\ReferendumRepository;
use App\Repository\ProposedReferendumUserRepository;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(ProposedReferendumRepository $proposedReferendumRepository, ProposedReferendumUserRepository $proposedReferendumUserRepository, ReferendumRepository $referendumRepository)
    {
        $proposedReferendums = $proposedReferendumRepository->findTopThreeBySupport();
        $todaysReferendums = $referendumRepository->findTodaysReferendums();
        $referendums = $referendumRepository->findThree();
        $userId = $this->getUser()->getId();
        $supportedReferendums = $proposedReferendumUserRepository->findAllSupportedByUser($userId);

        $refArrayLength = count($referendums) - 1;
        $propArrayLength = count($proposedReferendums) - 1;
        $todayArrayLength = count($todaysReferendums) - 1;

        $username = $roles = $this->getUser()->getUsername();
        $template = 'admin/index.html.twig';
        $url = "student";


        $args = [
            'username' => $username,
            'proposed_referendums' => $proposedReferendums,
            'supported_referendums' => $supportedReferendums,
            'referendums' => $referendums,
            'refArrayLength' => $refArrayLength,
            'propArrayLength' => $propArrayLength,
            'todaysReferendums' => $todaysReferendums,
            'todayArrayLength' => $todayArrayLength,
            'url' => $url
        ];


        return $this->render($template, $args);
    }

    /**
     * @Route("/admin/upcoming", name="admin_upcoming")
     */
    public function upcoming(ReferendumRepository $referendumRepository)
    {
        $username = $roles = $this->getUser()->getUsername();
        $template = 'admin/upcoming.html.twig';
        $referendums = $referendumRepository->findUpcoming();
        $refArrayLength = count($referendums) - 1;


        $args = [
            'username' => $username,
            'referendums' => $referendums,
            'refArrayLength' => $refArrayLength

        ];

        return $this->render($template, $args);
    }

    /**
     * @Route("/admin/create-referendum", name="create_referendum")
     */
    public function create_referendum()
    {
        $username = $roles = $this->getUser()->getUsername();
        $template = 'admin/create-referendum.html.twig';

        $args = [
            'username' => $username
        ];

        return $this->render($template, $args);
    }

    /**
     * @Route("/admin/past-referendums", name="past_referendums")
     */
    public function past_referendum(ReferendumRepository $referendumRepository)
    {
        $username = $roles = $this->getUser()->getUsername();
        $template = 'admin/past-referendums.html.twig';

        $referendums = $referendumRepository->findPast();
        $refArrayLength = count($referendums) - 1;


        $args = [
            'username' => $username,
            'referendums' => $referendums,
            'refArrayLength' => $refArrayLength
        ];

        return $this->render($template, $args);
    }

    /**
     * @Route("/admin/manage-administrators", name="manage_admins")
     */
    public function manage_administrators()
    {
        $username = $roles = $this->getUser()->getUsername();
        $template = 'admin/manage-admins.html.twig';

        $args = [
            'username' => $username
        ];

        return $this->render($template, $args);
    }
}
