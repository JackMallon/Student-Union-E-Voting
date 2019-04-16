<?php

namespace App\Repository;

use App\Entity\Referendum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Referendum|null find($id, $lockMode = null, $lockVersion = null)
 * @method Referendum|null findOneBy(array $criteria, array $orderBy = null)
 * @method Referendum[]    findAll()
 * @method Referendum[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReferendumRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Referendum::class);
    }

    public function addReferendum($formRequest)
    {
        $referendum = new Referendum();
        $referendum->setTitle($formRequest->request->get('title'));
        $referendum->setDetails($formRequest->request->get('details'));
        $referendum->setStartDate($formRequest->request->get('start-date'));
        $this->getEntityManager()->persist($referendum);
        $this->getEntityManager()->flush();
    }

    public function findThree()
    {
        $all = $this->findAll();

        $topThree = array();
        $arrLength = count($all);
        if($arrLength > 3){ $arrLength = 3; }

        for($x = 0; $x < $arrLength; $x++) {
            $topThree[$x] = $all[$x];
        }

        return $topThree;
    }

    public function findTodaysReferendums(){
        $all = $this->findAll();

        $todays = array();
        $arrLength = count($all);

        for($x = 0; $x < $arrLength; $x++) {
            $stage = $this->pastPresFut($all[$x]->getStartDate());
            if($stage == "today"){
                $todays[$x] = $all[$x];
            }
        }

        return $todays;
    }

    public function findUpcoming(){
        $all = $this->findAll();

        $todays = array();
        $arrLength = count($all);

        for($x = 0; $x < $arrLength; $x++) {
            $stage = $this->pastPresFut($all[$x]->getStartDate());
            if($stage == "future"){
                $todays[$x] = $all[$x];
            }
        }

        return $todays;

    }

    public function findPast(){
        $all = $this->findAll();

        $todays = array();
        $arrLength = count($all);

        for($x = 0; $x < $arrLength; $x++) {
            $stage = $this->pastPresFut($all[$x]->getStartDate());
            if($stage == "past"){
                $todays[$x] = $all[$x];
            }
        }

        return $todays;

    }

    public function pastPresFut($referendumDate){
        $todaysDate = date('m/d/Y');

        $time = strtotime($referendumDate);
        $formattedRefDate = date('Y-m-d',$time);

        $time = strtotime($todaysDate);
        $formattedTodayDate = date('Y-m-d',$time);

        if($formattedRefDate < $formattedTodayDate) {
            return "past";
        }
        if($formattedRefDate > $formattedTodayDate) {
            return "future";
        }
        if($formattedRefDate == $formattedTodayDate) {
            return "today";
        }
    }

    // /**
    //  * @return Referendum[] Returns an array of Referendum objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Referendum
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
