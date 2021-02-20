<?php

namespace App\Repository;

use App\Entity\Sportsman;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sportsman|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sportsman|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sportsman[]    findAll()
 * @method Sportsman[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SportsmanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sportsman::class);
    }

    // /**
    //  * @return Sportsman[] Returns an array of Sportsman objects
    //  */
    /*
      public function findByExampleField($value)
      {
      return $this->createQueryBuilder('t')
      ->andWhere('t.exampleField = :val')
      ->setParameter('val', $value)
      ->orderBy('t.id', 'ASC')
      ->setMaxResults(10)
      ->getQuery()
      ->getResult()
      ;
      }
     */

    /*
      public function findOneBySomeField($value): ?Sportsman
      {
      return $this->createQueryBuilder('t')
      ->andWhere('t.exampleField = :val')
      ->setParameter('val', $value)
      ->getQuery()
      ->getOneOrNullResult()
      ;
      }
     */
}
