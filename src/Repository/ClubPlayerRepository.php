<?php

namespace App\Repository;

use App\Entity\ClubPlayer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ClubPlayer|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClubPlayer|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClubPlayer[]    findAll()
 * @method ClubPlayer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClubPlayerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ClubPlayer::class);
    }

//    /**
//     * @return ClubPlayer[] Returns an array of ClubPlayer objects
//     */
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
    public function findOneBySomeField($value): ?ClubPlayer
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
