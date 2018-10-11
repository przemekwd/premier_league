<?php
/**
 * Author: Przemysław Mincewicz
 * Date: 2018-09-13
 * Time: 10:56
 */

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppFunction extends AbstractExtension
{
    /**
     * @return array|\Twig_Function[]
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('icon', [$this, 'materialIcon'], ['is_safe' => ['html']]),
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