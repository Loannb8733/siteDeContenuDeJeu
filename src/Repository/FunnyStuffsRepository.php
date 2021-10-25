<?php

namespace App\Repository;

use App\Entity\FunnyStuffs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FunnyStuffs|null find($id, $lockMode = null, $lockVersion = null)
 * @method FunnyStuffs|null findOneBy(array $criteria, array $orderBy = null)
 * @method FunnyStuffs[]    findAll()
 * @method FunnyStuffs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FunnyStuffsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FunnyStuffs::class);
    }

    public function findAll()
    {
        return $this->findBy(array(), array('createdAt' => 'DESC'));
    }

    // /**
    //  * @return FunnyStuffs[] Returns an array of FunnyStuffs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FunnyStuffs
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
