<?php

namespace App\Repository;

use App\Entity\HomeReinsurance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HomeReinsurance|null find($id, $lockMode = null, $lockVersion = null)
 * @method HomeReinsurance|null findOneBy(array $criteria, array $orderBy = null)
 * @method HomeReinsurance[]    findAll()
 * @method HomeReinsurance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HomeReinsuranceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HomeReinsurance::class);
    }

    // /**
    //  * @return HomeReinsurance[] Returns an array of HomeReinsurance objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HomeReinsurance
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
