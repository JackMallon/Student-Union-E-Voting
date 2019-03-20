<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboard()
    {
        $roles = $this->getUser()->getRole();

        if ($roles == "ROLE_ADMIN") {
            return $this->redirectToRoute('admin');
        } elseif ($roles == "ROLE_STUDENT") {
            return $this->redirectToRoute('student');
        } else {
            return $this->redirectToRoute('home');
        }
    }

    /**
     * @Route("/role_route", name="role_route")
     */
    public function role_route()
    {
        $roles = $this->getUser()->getRole();

        if ($roles == "ROLE_ADMIN") {
            return $this->redirectToRoute('admin');
        } elseif ($roles == "ROLE_STUDENT") {
            return $this->redirectToRoute('student');
        } else {
            return $this->redirectToRoute('home');
        }
    }
}
