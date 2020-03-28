<?php

namespace App\Repository;

use App\Entity\Commentator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Commentator|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commentator|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commentator[]    findAll()
 * @method Commentator[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentatorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commentator::class);
    }

    // /**
    //  * @return Commentator[] Returns an array of Commentator objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Commentator
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
