<?php

namespace App\Repository;

use App\Entity\ProposedReferendumUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProposedReferendumUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProposedReferendumUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProposedReferendumUser[]    findAll()
 * @method ProposedReferendumUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProposedReferendumUserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProposedReferendumUser::class);
    }

    public function findReferendumUser($referendumId, $userId)
    {
        $recordExists = $this->findOneBy([
            'ProposedReferendum' => $referendumId,
            'User' => $userId,
        ]);
        if(isset($recordExists)){
            return false;
        }
        return true;
    }


    // /**
    //  * @return ProposedReferendumUser[] Returns an array of ProposedReferendumUser objects
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
    public function findOneBySomeField($value): ?ProposedReferendumUser
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
