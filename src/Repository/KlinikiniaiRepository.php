<?php

namespace App\Repository;

use App\Entity\Klinikiniai;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Klinikiniai|null find($id, $lockMode = null, $lockVersion = null)
 * @method Klinikiniai|null findOneBy(array $criteria, array $orderBy = null)
 * @method Klinikiniai[]    findAll()
 * @method Klinikiniai[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KlinikiniaiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Klinikiniai::class);
    }

    // /**
    //  * @return Klinikiniai[] Returns an array of Klinikiniai objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Klinikiniai
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
