<?php

namespace App\Repository;

use App\Entity\Legends;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Legends|null find($id, $lockMode = null, $lockVersion = null)
 * @method Legends|null findOneBy(array $criteria, array $orderBy = null)
 * @method Legends[]    findAll()
 * @method Legends[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LegendsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Legends::class);
    }

    /*public function findAll()
    {
        return $this->findBy(array(), array('createdAt' => 'DESC'));
    }*/

    // /**
    //  * @return Legends[] Returns an array of Legends objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Legends
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
