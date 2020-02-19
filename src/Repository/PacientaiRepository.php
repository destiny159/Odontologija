<?php

namespace App\Repository;

use App\Entity\Pacientai;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Pacientai|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pacientai|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pacientai[]    findAll()
 * @method Pacientai[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PacientaiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pacientai::class);
    }

    // /**
    //  * @return Pacientai[] Returns an array of Pacientai objects
    //  */

    public function findByStatus($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.status = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Pacientai
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
