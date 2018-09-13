<?php
/**
 * Author: Przemysław Mincewicz
 * Date: 2018-09-13
 * Time: 10:56
 */

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig_Function;

class AppFunction extends AbstractExtension
{
    /**
     * @return array|\Twig_Filter[]
     */
    public function getFunctions()
    {
        return [
            new Twig_Function('icon', [$this, 'materialIcon'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * @param   string  $name
     * @param   string  $class
     * @return  string
     */
    public function materialIcon(string $name, string $class = ''): string
    {
        return "<i class='material-icons $class'>$name</i>";
    }
}