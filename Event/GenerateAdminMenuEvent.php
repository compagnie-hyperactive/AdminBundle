<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 18/05/15
 * Time: 16:01
 */
namespace Lch\AdminBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class GenerateAdminMenuEvent extends Event
{
    /**
     * @var FactoryInterface Interface implemented by the factory to create items
     */
    private $factory;

    /**
     * @var ItemInterface The menu item
     */
    private $menu;

    /**
     * @var UserInterface
     */
    private $user;

    /**
     * @param FactoryInterface $factory
     * @param ItemInterface $menu
     * @param UserInterface|string $user user is well known as we are on admin part
     */
    public function __construct(FactoryInterface $factory, ItemInterface $menu, $user) {
        $this->factory = $factory;
        $this->menu = $menu;
        $this->user = $user;
    }

    /**
     * @return FactoryInterface
     */
    public function getFactory()
    {
        return $this->factory;
    }

    /**
     * @return ItemInterface
     */
    public function getMenu()
    {
        return $this->menu;
    }

}