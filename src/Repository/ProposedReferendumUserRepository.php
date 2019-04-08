<?php

namespace App\Repository;

use App\Entity\ProposedReferendumUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\ProposedReferendum;

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

    public function canSupport(ProposedReferendum $proposedReferendum, int $userId)
    {
        $referendumId = $proposedReferendum->getId();

        if($this->hasSupported($referendumId, $userId)){
            return false;
        }

        // if get here - then not previously supported, so create new user support record
        // (1) update support TOTAL
        $support = $proposedReferendum->getSupport();
        $proposedReferendum->setSupport($support + 1);
        $this->getEntityManager()->persist($proposedReferendum);
        $this->getEntityManager()->flush();

        // create new Referednum USer record
        $this->newReferendumUser($userId, $referendumId);

        return true;

    }

    public function newReferendumUser(int $userId, int $referendumId)
    {
        $proposedReferendumUser = new ProposedReferendumUser();
        $proposedReferendumUser->setProposedReferendum($referendumId);
        $proposedReferendumUser->setUser($userId);

        $this->getEntityManager()->persist($proposedReferendumUser);
        $this->getEntityManager()->flush();
    }

    public function hasSupported($referendumId, $userId)
    {
        $recordExists = $this->findOneBy([
            'ProposedReferendum' => $referendumId,
            'User' => $userId,
        ]);

        return isset($recordExists);

//        if(isset($recordExists)){
//            return false;
//        }
//        return true;
    }

    public function findAllSupportedByUser($userId)
    {
        $supportedReferendums = $this->findBy(array('User' => $userId ));

        $supportedIds = array();

        for($x = 0; $x < count($supportedReferendums); $x++) {
            $supportedIds[$x] = $supportedReferendums[$x]->getProposedReferendum();
        }

        return $supportedIds;
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
