<?php

namespace App\Repository;

use App\Entity\ChampionShip;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ChampionShip|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChampionShip|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChampionShip[]    findAll()
 * @method ChampionShip[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChampionShipRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChampionShip::class);
    }

    // /**
    //  * @return ChampionShip[] Returns an array of ChampionShip objects
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
    public function findOneBySomeField($value): ?ChampionShip
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
