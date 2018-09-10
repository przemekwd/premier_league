<?php
/**
 * Created by PhpStorm.
 * User: Przemek
 * Date: 08.09.2018
 * Time: 09:39
 */

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class Menu
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param RequestStack $requestStack
     * @return ItemInterface
     */
    public function createMain(RequestStack $requestStack): ItemInterface
    {
        $childAttribute = [
            'class' => 'nav-item'
        ];
        $menu = $this->factory->createItem('root', [
            'childrenAttributes' => ['class' => 'navbar-nav']
        ]);
        $menu->addChild('Home', [
            'route' => 'nation_index',
            'attributes' => [
                'class' => 'nav-item nav-logo'
            ]
        ]);
        $menu->addChild('Nations', [
            'route' => 'nation_index',
            'attributes' => $childAttribute
        ]);
        $menu->addChild('Players', [
            'route' => 'player_index',
            'attributes' => $childAttribute
        ]);
        $menu['Nations']->setLinkAttribute('class', 'nav-link');
        $menu['Players']->setLinkAttribute('class', 'nav-link');

        return $menu;
    }
}
