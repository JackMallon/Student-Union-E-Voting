<?php

namespace App\Controller;

use App\Entity\ProposedReferendum;
use App\Entity\ProposedReferendumUser;
use App\Form\ProposedReferendumType;
use App\Repository\ProposedReferendumRepository;
use App\Repository\ProposedReferendumUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use App\Controller\StudentController;

/**
 * @Route("student/proposed-referendum")
 */
class ProposedReferendumController extends AbstractController
{
    /**
     * @Route("/", name="proposed_referendum_index", methods={"GET"})
     */
    public function index(ProposedReferendumRepository $proposedReferendumRepository): Response
    {
        return $this->render('proposed_referendum/index.html.twig', [
            'proposed_referendums' => $proposedReferendumRepository->findAll(),
        ]);
    }

    /**
     * @Route("/support/{id}", name="proposed_referendum_support", methods={"POST"})
     */
    public function support(Request $request, ProposedReferendumUserRepository $proposedReferendumUserRepository): Response
    {
        $referendumId = $request->request->get('proposal_id');
        $url = $request->request->get('url');
        $userId = $this->getUser()->getId();

        if($proposedReferendumUserRepository->findReferendumUser($referendumId, $userId)){
            $manager = $this->getDoctrine()->getManager();
            $proposedReferendum = $manager->getRepository('App:ProposedReferendum')->find((int)$referendumId);
            $support = $proposedReferendum->getSupport();
            $proposedReferendum->setSupport($support + 1);

            $proposedReferendumUser = new ProposedReferendumUser();
            $proposedReferendumUser->setProposedReferendum($referendumId);
            $proposedReferendumUser->setUser($userId);

            $manager->persist($proposedReferendumUser);
            $manager->flush();
        }

        return $this->redirectToRoute($url);
    }

    /**
     * @Route("/", name="proposed_referendum_new", methods={"POST"})
     */
    public function new(Request $request, ObjectManager $manager): Response
    {
        $publisher = $roles = $this->getUser()->getUsername();
        $details = $request->request->get('proposal');
        $support = 0;


        $proposal = new ProposedReferendum();
        $proposal->setPublisher($publisher);
        $proposal->setDetails($details);
        $proposal->setSupport($support);

        $manager->persist($proposal);
        $manager->flush();


        return new Response(
            '<html><body><p>New controller method over there in the other controller<br>User: ' . $publisher . '<br>Proposal: ' . $details . '<br>Support: ' . $support . '</body></html>'
        );
    }

    /**
     * @Route("/{id}/edit", name="proposed_referendum_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ProposedReferendum $proposedReferendum): Response
    {
        $form = $this->createForm(ProposedReferendumType::class, $proposedReferendum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('proposed_referendum_index', [
                'id' => $proposedReferendum->getId(),
            ]);
        }

        return $this->render('proposed_referendum/edit.html.twig', [
            'proposed_referendum' => $proposedReferendum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="proposed_referendum_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ProposedReferendum $proposedReferendum): Response
    {
        if ($this->isCsrfTokenValid('delete'.$proposedReferendum->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($proposedReferendum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('proposed_referendum_index');
    }
}
