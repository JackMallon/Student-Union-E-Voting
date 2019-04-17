<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ReferendumRepository;

class PublicController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ReferendumRepository $referendumRepository)
    {
        $referendums = $referendumRepository->findThree();
        $refArrayLength = count($referendums) - 1;

        $template = 'public/index.html.twig';

        $args = [
            'referendums' => $referendums,
            'refArrayLength' => $refArrayLength,
        ];

        return $this->render($template, $args);
    }

    /**
     * @Route("/about", name="about")
     */
    public function about()
    {
        return $this->render('public/about.html.twig');
    }

    /**
     * @Route("/upcoming", name="upcoming")
     */
    public function upcoming()
    {
        return $this->render('public/upcoming.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('public/contact.html.twig');
    }
}
