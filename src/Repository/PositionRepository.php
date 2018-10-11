<?php

namespace App\Repository;

use App\Entity\Position;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Position|null find($id, $lockMode = null, $lockVersion = null)
 * @method Position|null findOneBy(array $criteria, array $orderBy = null)
 * @method Position[]    findAll()
 * @method Position[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PositionRepository extends AppRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Position::class, 'p');
    }

    /**
     * @return  \Doctrine\ORM\QueryBuilder
     */
    public function findAllSortSelect()
    {
        return $this->createQueryBuilder('p');
    }

}
