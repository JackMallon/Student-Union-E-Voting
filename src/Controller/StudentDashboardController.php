<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StudentDashboardController extends AbstractController
{
    /**
     * @Route("/student/dashboard", name="student_dashboard")
     */
    public function index()
    {
        return $this->render('student_dashboard/index.html.twig', [
            'controller_name' => 'StudentDashboardController',
        ]);
    }
}
