<?php

namespace App\Repository;

use App\Entity\HomeEditor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HomeEditor|null find($id, $lockMode = null, $lockVersion = null)
 * @method HomeEditor|null findOneBy(array $criteria, array $orderBy = null)
 * @method HomeEditor[]    findAll()
 * @method HomeEditor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HomeEditorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HomeEditor::class);
    }

    // /**
    //  * @return HomeEditor[] Returns an array of HomeEditor objects
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
    public function findOneBySomeField($value): ?HomeEditor
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
