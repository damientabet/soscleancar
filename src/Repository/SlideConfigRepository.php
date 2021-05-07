<?php

namespace App\Repository;

use App\Entity\SlideConfig;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SlideConfig|null find($id, $lockMode = null, $lockVersion = null)
 * @method SlideConfig|null findOneBy(array $criteria, array $orderBy = null)
 * @method SlideConfig[]    findAll()
 * @method SlideConfig[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SlideConfigRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SlideConfig::class);
    }

    // /**
    //  * @return SlideConfig[] Returns an array of SlideConfig objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SlideConfig
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
