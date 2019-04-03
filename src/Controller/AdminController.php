<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Repository\ProposedReferendumRepository;


class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(ProposedReferendumRepository $proposedReferendumRepository)
    {
        $proposedReferendums = $proposedReferendumRepository->findTopThreeBySupport();

        $username = $roles = $this->getUser()->getUsername();
        $template = 'admin/index.html.twig';

        $args = [
            'username' => $username,
            'proposed_referendums' => $proposedReferendums
        ];

        return $this->render($template, $args);
    }

    /**
     * @Route("/admin/upcoming", name="admin_upcoming")
     */
    public function upcoming()
    {
        $username = $roles = $this->getUser()->getUsername();
        $template = 'admin/upcoming.html.twig';

        $args = [
            'username' => $username
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
    public function past_referendum()
    {
        $username = $roles = $this->getUser()->getUsername();
        $template = 'admin/past-referendums.html.twig';

        $args = [
            'username' => $username
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
