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

    private $childAttribute;

    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
        $this->childAttribute = [
            'class' => 'nav-item'
        ];
    }

    /**
     * @param RequestStack $requestStack
     * @return ItemInterface
     */
    public function createMain(RequestStack $requestStack): ItemInterface
    {
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
            'attributes' => $this->childAttribute
        ]);
        $menu->addChild('Players', [
            'route' => 'player_index',
            'attributes' => $this->childAttribute
        ]);
        $this->setLinkClassToChild($menu);

        return $menu;
    }

    /**
     * @param ItemInterface $menu
     */
    private function setLinkClassToChild(ItemInterface &$menu)
    {
        foreach ($menu as $name => $child) {
            if (!in_array($name, ['Home'])) {
                $child->setLinkAttribute('class', 'nav-link');
            }
        }
    }
}
