<?php

namespace App\Repository;

use App\Entity\Eile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Eile|null find($id, $lockMode = null, $lockVersion = null)
 * @method Eile|null findOneBy(array $criteria, array $orderBy = null)
 * @method Eile[]    findAll()
 * @method Eile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Eile::class);
    }

    // /**
    //  * @return Eile[] Returns an array of Eile objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Eile
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
