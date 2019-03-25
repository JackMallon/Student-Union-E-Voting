<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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
    public function index()
    {
        $username = $roles = $this->getUser()->getUsername();
        $template = 'student/index.html.twig';

        $args = [
            'username' => $username
        ];

        return $this->render($template, $args);
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
}
