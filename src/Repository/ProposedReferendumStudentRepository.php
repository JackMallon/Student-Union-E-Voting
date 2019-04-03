<?php

namespace App\Repository;

use App\Entity\ProposedReferendumStudent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProposedReferendumStudent|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProposedReferendumStudent|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProposedReferendumStudent[]    findAll()
 * @method ProposedReferendumStudent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProposedReferendumStudentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProposedReferendumStudent::class);
    }

    // /**
    //  * @return ProposedReferendumStudent[] Returns an array of ProposedReferendumStudent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProposedReferendumStudent
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
