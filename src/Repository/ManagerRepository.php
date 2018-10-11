<?php

namespace App\Repository;

use App\Entity\Manager;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Manager|null find($id, $lockMode = null, $lockVersion = null)
 * @method Manager|null findOneBy(array $criteria, array $orderBy = null)
 * @method Manager[]    findAll()
 * @method Manager[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ManagerRepository extends AppRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Manager::class, 'm');
    }

}
