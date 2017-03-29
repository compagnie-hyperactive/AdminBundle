<?php

namespace Lch\AdminBundle\Menu;

use Knp\Menu\ItemInterface;
use Lch\UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Lch\AdminBundle\LchAdminEvents;
use Lch\AdminBundle\Event\GenerateAdminMenuEvent;
use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class MenuBuilder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    const DATA_MENU_ROOT = "data-menu-root";

    const ICON = 'icon';

    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @var TokenStorage
     */
    private $token;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @param FactoryInterface $factory
     * @param TokenStorage $token
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(FactoryInterface $factory, TokenStorage $token, EventDispatcherInterface $eventDispatcher)
    {
        $this->factory = $factory;
        $this->token = $token;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param array $options
     * @return ItemInterface the menu items nested
     */
    public function adminMainMenu(array $options)
    {

        $user = $this->token->getToken()->getUser();

        // Options passed to ensure bootstrap tabs
        $menu = $this->factory->createItem('root', [
            'childrenAttributes' => array(
//                'class' => 'nav nav-tabs',
            ),
        ]);


        $menuEvent = new GenerateAdminMenuEvent($this->factory, $menu, $user);

        // TODO set cache for menu generation
        $this->eventDispatcher->dispatch(
            LchAdminEvents::GENERATE_ADMIN_MENU,
            $menuEvent
        );

//        $this->iterate($menu);

        return $menu;
    }

//    /**
//     * Used to iterate on all child items in order to add common stuff or item-specific.
//     *
//     * @param $menu ItemInterface the menu to iterate
//     */
//    private function iterate($menu)
//    {
//
//        // Add common stuff if needed
//        foreach ($menu as $child) {
//            // Set role for Bootstrap
//            $child->setAttribute('role', 'presentation');
//
//            // Look for route parts in order to set current tag
//            $childRouteParts = explode('_', $child->getExtras()['routes'][0]['route']);
//            $currentRouteParts = explode('_', $this->container->get('request')->get('_route'));
////            array_pop($childRouteParts);
////            array_pop($currentRouteParts);
//
//            if ($childRouteParts === $currentRouteParts) {
//                $child->setCurrent(true);
//            }
//        }
//    }
}
