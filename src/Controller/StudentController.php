<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     * @IsGranted("ROLE_STUDENT")
     */
    public function index()
    {
        return $this->render('student/index.html.twig');
    }

    /**
     * @Route("/student/propose", name="propose_referendum")
     * @IsGranted("ROLE_STUDENT")
     */
    public function propose()
    {
        return $this->render('student/propose-referendum.html.twig');
    }
}
