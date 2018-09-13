<?php

namespace App\Repository;

use App\Entity\Player;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Player|null find($id, $lockMode = null, $lockVersion = null)
 * @method Player|null findOneBy(array $criteria, array $orderBy = null)
 * @method Player[]    findAll()
 * @method Player[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerRepository extends ServiceEntityRepository implements AppRepositoryInterface
{
    /**
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Player::class);
    }

    /**
     * @param   array       $where
     * @param   array       $orderBy
     * @return  Player[]
     */
    public function findAllBySort(array $where = [], array $orderBy = []): array
    {
        $result = $this->createQueryBuilder('p');

        foreach ($where as $field => $is) {
            $result->andWhere("p.$field = $is");
        }

        foreach ($orderBy as $sort => $order) {
            $result->addOrderBy("p.$sort", $order);
        }

        return $result->getQuery()->getResult();
    }

}
