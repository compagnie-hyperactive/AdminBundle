<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 09/03/17
 * Time: 11:15
 */

namespace Lch\AdminBundle\Listener\Menu;


use Lch\ComponentsBundle\Event\RenderListRowActionsEvent;
use Lch\ComponentsBundle\LchComponentsEvents;
use Lch\ComponentsBundle\Listener\ListListener;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Translation\TranslatorInterface;

class TagsListSubscriber extends ListListener implements EventSubscriberInterface
{
    const ENTITY = "Tag";

    /**
     * @var TranslatorInterface $translator
     */
    protected $translator;


    public function __construct(TranslatorInterface $translator){
        $this->translator = $translator;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            LchComponentsEvents::RENDER_ACTIONS_PREFIX.self::ENTITY   => 'onTagsListActionsGathering',
        );
    }

    /**
     * @param RenderListRowActionsEvent $actionsEvent
     */
    public function onTagsListActionsGathering(RenderListRowActionsEvent $actionsEvent) {
        // Add common actions
        $this->addCommonActions($actionsEvent);
    }
}