<?php

namespace App\Repository;

use App\Entity\Nation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Nation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nation[]    findAll()
 * @method Nation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Nation::class);
    }

    /**
     * @param string $sort
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findAllSortSelect($sort = 'ASC')
    {
        return $this->createQueryBuilder('n')
            ->orderBy('n.name', $sort);
    }

    /**
     * @param array $orderBy
     * @return Nation[]
     */
    public function findAllSort(array $orderBy = []): array
    {
        $result = $this->createQueryBuilder('n');

        foreach ($orderBy as $sort => $order) {
            $result->addOrderBy("n.$sort", $order);
        }

        return $result->getQuery()->getResult();
    }

//    /**
//     * @return Nation[] Returns an array of Nation objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Nation
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
