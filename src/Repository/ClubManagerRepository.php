<?php

namespace App\Repository;

use App\Entity\ClubManager;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ClubManager|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClubManager|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClubManager[]    findAll()
 * @method ClubManager[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClubManagerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ClubManager::class);
    }

//    /**
//     * @return ClubManager[] Returns an array of ClubManager objects
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
    public function findOneBySomeField($value): ?ClubManager
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
