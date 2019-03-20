<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/admin/upcoming", name="admin_upcoming")
     */
    public function upcoming()
    {
        return $this->render('admin/upcoming.html.twig');
    }

    /**
     * @Route("/admin/create-referendum", name="create_referendum")
     */
    public function create_referendum()
    {
        return $this->render('admin/create-referendum.html.twig');
    }

    /**
     * @Route("/admin/past-referendums", name="past_referendums")
     */
    public function past_referendum()
    {
        return $this->render('admin/past-referendums.html.twig');
    }

    /**
     * @Route("/admin/manage-administrators", name="manage_admins")
     */
    public function manage_administrators()
    {
        return $this->render('admin/manage-admins.html.twig');
    }
}
