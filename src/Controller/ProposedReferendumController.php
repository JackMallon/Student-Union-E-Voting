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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("student/proposed-referendum")
 * @IsGranted("ROLE_STUDENT")
 */
class ProposedReferendumController extends AbstractController
{
    /**
     * @Route("/support/{id}", name="proposed_referendum_support", methods={"POST"})
     */
    public function support(Request $request, ProposedReferendum $proposedReferendum, ProposedReferendumUserRepository $proposedReferendumUserRepository): Response
    {
        //$referendumId = $request->request->get('proposal_id');
        $url = $request->request->get('url');
        $userId = $this->getUser()->getId();

        if(!$proposedReferendumUserRepository->canSupport($proposedReferendum, $userId)){
            return $this->render('error.html.twig', ['message' => 'cannot support same reference dum']);
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


        return $this->redirectToRoute('view_all_proposals_student');
    }
}
