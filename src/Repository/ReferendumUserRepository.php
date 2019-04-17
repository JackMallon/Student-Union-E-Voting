<?php

namespace App\Repository;

use App\Entity\ReferendumUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ReferendumUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReferendumUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReferendumUser[]    findAll()
 * @method ReferendumUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReferendumUserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ReferendumUser::class);
    }

    public function voteFor($userId, $referendumId)
    {

    }

    // /**
    //  * @return ReferendumUser[] Returns an array of ReferendumUser objects
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
    public function findOneBySomeField($value): ?ReferendumUser
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
