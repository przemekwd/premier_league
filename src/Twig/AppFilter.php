<?php
/**
 * Author: Przemysław Mincewicz
 * Date: 2018-10-11
 * Time: 10:26
 */

namespace App\Twig;


use DateTime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppFilter extends AbstractExtension
{
    /**
     * @return array|\Twig_Filter[]
     */
    public function getFilters()
    {
        return [
            new TwigFilter('years_old', [$this, 'yearsOld']),
        ];
    }

    /**
     * @param   DateTime $date
     * @return  string
     */
    public function yearsOld(DateTime $date)
    {
        $diff = $date->diff(new DateTime());

        return $diff->format('%y');
    }
}