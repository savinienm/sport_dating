<?php

namespace App\Repository;

use App\Entity\SportPracticeBySportsman;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SportPracticeBySportsman|null find($id, $lockMode = null, $lockVersion = null)
 * @method SportPracticeBySportsman|null findOneBy(array $criteria, array $orderBy = null)
 * @method SportPracticeBySportsman[]    findAll()
 * @method SportPracticeBySportsman[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SportPracticeBySportsmanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SportPracticeBySportsman::class);
    }

    // /**
    //  * @return SportPracticeBySportsman[] Returns an array of SportPracticeBySportsman objects
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
      public function findOneBySomeField($value): ?SportPracticeBySportsman
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
