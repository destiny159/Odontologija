<?php

namespace App\Repository;

use App\Entity\Atsiliepimai;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Atsiliepimai|null find($id, $lockMode = null, $lockVersion = null)
 * @method Atsiliepimai|null findOneBy(array $criteria, array $orderBy = null)
 * @method Atsiliepimai[]    findAll()
 * @method Atsiliepimai[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AtsiliepimaiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Atsiliepimai::class);
    }

    // /**
    //  * @return Atsiliepimai[] Returns an array of Atsiliepimai objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Atsiliepimai
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
