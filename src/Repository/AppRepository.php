<?php
/**
 * Author: Przemysław Mincewicz
 * Date: 2018-10-11
 * Time: 08:47
 */

namespace App\Repository;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class AppRepository extends ServiceEntityRepository
{
    private $alias;

    /**
     * @param RegistryInterface $registry
     * @param string $entityClass
     * @param string $alias
     */
    public function __construct(RegistryInterface $registry, $entityClass, string $alias)
    {
        $this->alias = $alias;
        parent::__construct($registry, $entityClass);
    }

    /**
     * @param   array   $where
     * @param   array   $orderBy
     * @return  array
     */
    public function findAllBySort(array $where = [], array $orderBy = []): array
    {
        $result = $this->createQueryBuilder($this->alias);

        foreach ($where as $field => $is) {
            $result->andWhere("$this->alias.$field = $is");
        }

        foreach ($orderBy as $sort => $order) {
            $result->addOrderBy("$this->alias.$sort", $order);
        }

        return $result->getQuery()->getResult();
    }
}