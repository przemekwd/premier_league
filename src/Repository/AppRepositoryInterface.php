<?php
/**
 * Author: Przemysław Mincewicz
 * Date: 2018-09-13
 * Time: 08:55
 */

namespace App\Repository;

interface AppRepositoryInterface
{
    /**
     * @param   array   $where
     * @param   array   $orderBy
     * @return  array
     */
    public function findAllBySort(array $where = [], array $orderBy = []): array;
}