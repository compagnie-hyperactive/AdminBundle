<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 02/03/17
 * Time: 16:18
 */

namespace Lch\AdminBundle\Listener\Menu;


use Lch\AdminBundle\Event\GenerateAdminMenuEvent;
use Lch\AdminBundle\Menu\MenuBuilder;
use Lch\ComponentsBundle\Model\AdminIcons;
use Symfony\Component\Translation\TranslatorInterface;

class AdminMenuListener
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * AdminMenuListener constructor.
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator) {
        $this->translator = $translator;
    }

    /**
     * @param GenerateAdminMenuEvent $event
     */
    public function onAdminMenuGeneration(GenerateAdminMenuEvent $event)
    {
        $menu = $event->getMenu();

        /**********************************************************
         * Menus
         */
        $menuChild = $menu->addChild(
            $this->translator->trans('lch.admin.menu.main.title'), [
            'route' => 'lch_admin_menu_list',
        ]);
        $menuChild->setExtra(MenuBuilder::ICON, AdminIcons::HAMBURGER);

        $addMenuChild = $menuChild->addChild($this->translator->trans('lch.admin.menu.add.title'), [
            'route' => 'lch_admin_menu_add',
        ]);
        $addMenuChild->setExtra(MenuBuilder::ICON, AdminIcons::PENCIL);

        /**********************************************************
         * Medias
         */
        $mediaChild = $menu->addChild(
            $this->translator->trans('lch.admin.media.library.title'), [
            'route' => 'lch_admin_media_library',
        ]);
        $mediaChild->setExtra(MenuBuilder::ICON, AdminIcons::HDD);
    }
}