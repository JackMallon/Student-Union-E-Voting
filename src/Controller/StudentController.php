<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Repository\ProposedReferendumRepository;
use App\Repository\ReferendumRepository;
use App\Repository\ProposedReferendumUserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\ProposedReferendum;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     * @IsGranted("ROLE_STUDENT")
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
        $template = 'student/index.html.twig';
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
        #var_dump($todaysReferendums); exit;
    }

    /**
     * @Route("/student/propose", name="propose_referendum")
     * @IsGranted("ROLE_STUDENT")
     */
    public function propose()
    {
        $username = $roles = $this->getUser()->getUsername();
        $template = 'student/propose-referendum.html.twig';

        $args = [
            'username' => $username
        ];

        return $this->render($template, $args);
    }

    /**
     * @Route("/student/create-proposal", name="create_proposal")
     * @IsGranted("ROLE_STUDENT")
     */
    public function create_proposal(Request $request, ObjectManager $manager)
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
            '<html><body><p>User: ' . $publisher . '<br>Proposal: ' . $details . '<br>Support: ' . $support . '</body></html>'
        );
    }

    /**
     * @Route("/student/proposals", name="view_all_proposals_student")
     * @IsGranted("ROLE_STUDENT")
     */
    public function viewAllProposals(ProposedReferendumRepository $proposedReferendumRepository, ProposedReferendumUserRepository $proposedReferendumUserRepository)
    {
        $proposedReferendums = $proposedReferendumRepository->findAllOrderedBySupport();
        $userId = $this->getUser()->getId();
        $supportedReferendums = $proposedReferendumUserRepository->findAllSupportedByUser($userId);
        $url = "view_all_proposals_student";

        $arrayLength = count($proposedReferendums) - 1;

        $username = $roles = $this->getUser()->getUsername();
        $template = 'student/all-proposed-referendums.html.twig';

        $args = [
            'username' => $username,
            'proposed_referendums' => $proposedReferendums,
            'supported_referendums' => $supportedReferendums,
            'array_length' => $arrayLength,
            'url' => $url
        ];

        return $this->render($template, $args);
        #var_dump($supportedReferendums); exit;
    }

    /**
     * @Route("/student/upcoming", name="view_all_upcoming_student")
     * @IsGranted("ROLE_STUDENT")
     */
    public function viewAllUpcoming(ReferendumRepository $referendumRepository)
    {
        $username = $roles = $this->getUser()->getUsername();
        $template = 'student/upcoming-referendums.html.twig';
        $referendums = $referendumRepository->findUpcoming();
        $refArrayLength = count($referendums) - 1;


        $args = [
            'username' => $username,
            'referendums' => $referendums,
            'refArrayLength' => $refArrayLength
        ];

        return $this->render($template, $args);
        #var_dump($referendums); exit;
    }

    /**
     * @Route("/student/vote", name="vote_referendum")
     * @IsGranted("ROLE_STUDENT")
     */
    public function voteReferendum(ReferendumRepository $referendumRepository, Request $request)
    {
        $username = $roles = $this->getUser()->getUsername();
        $template = 'student/vote.html.twig';
        $referendumId = $request->request->get('id');

        $referendum = $referendumRepository->find($referendumId);

        $args = [
            'username' => $username,
            'referendum' => $referendum
        ];

        return $this->render($template, $args);
        #var_dump($referendum); exit;
    }
}
