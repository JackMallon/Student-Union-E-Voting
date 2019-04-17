<?php

namespace App\Controller;

use App\Entity\Referendum;
use App\Form\ReferendumType;
use App\Repository\ReferendumRepository;
use App\Repository\ReferendumUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/referendum")
 * @IsGranted("ROLE_STUDENT")
 */
class ReferendumController extends AbstractController
{
    /**
     * @Route("/new", name="referendum_new", methods={"GET","POST"})
     */
    public function new(Request $request, ReferendumRepository $referendumRepository): Response
    {
        $referendumRepository->addReferendum($request);
        var_dump($myDate = date('m/d/Y')); exit;
    }

    /**
     * @Route("/{id}", name="referendum_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Referendum $referendum): Response
    {
        if ($this->isCsrfTokenValid('delete'.$referendum->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($referendum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('referendum_index');
    }

    /**
     * @Route("/student/vote-for", name="vote_for", methods={"POST"})
     */
    public function voteFor(Request $request, ReferendumUserRepository $referendumUserRepository): Response
    {
        $userId = $roles = $this->getUser()->getId();
        $referendumId = $request->request->get('id');

        return $this->redirectToRoute('student');
    }

    /**
     * @Route("/student/vote-against", name="vote_against", methods={"POST"})
     */
    public function voteAgainst(Request $request, ReferendumUserRepository $referendumUserRepository): Response
    {
        $userId = $roles = $this->getUser()->getId();
        $referendumId = $request->request->get('id');

        $referendumUserRepository->voteFor($userId, $referendumId);

        return $this->redirectToRoute('student');
    }
}
