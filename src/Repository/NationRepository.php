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
class NationRepository extends ServiceEntityRepository implements AppRepositoryInterface
{
    /**
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Nation::class);
    }

    /**
     * @param   string                      $sort
     * @return  \Doctrine\ORM\QueryBuilder
     */
    public function findAllSortSelect($sort = 'ASC')
    {
        return $this->createQueryBuilder('n')
            ->orderBy('n.name', $sort);
    }

    /**
     * @param   array       $orderBy
     * @return  Nation[]
     */
    public function findAllBySort(array $where = [], array $orderBy = []): array
    {
        $result = $this->createQueryBuilder('n');

        foreach ($orderBy as $sort => $order) {
            $result->addOrderBy("n.$sort", $order);
        }

        return $result->getQuery()->getResult();
    }

}
